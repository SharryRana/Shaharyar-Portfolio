<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\ArticleComment;
use Modules\Blog\Models\ArticleCommentReaction;
use Modules\Blog\Models\ArticleHelpfulVote;

class ArticleInteractionController extends Controller
{
    public function listComments(Request $request, Article $article): JsonResponse
    {
        abort_unless($article->status === 'Published' && $article->published_at, 404);

        $validated = $request->validate([
            'sort' => ['nullable', 'in:latest,oldest,positive,negative,popular'],
            'page' => ['nullable', 'integer', 'min:1'],
        ]);

        $sort = $validated['sort'] ?? 'latest';
        $comments = $this->approvedCommentsQuery($article, $sort)
            ->paginate(5)
            ->withQueryString();

        return response()->json([
            'html' => view('blog::blog.partials.comment-cards', ['comments' => $comments])->render(),
            'next_page' => $comments->hasMorePages() ? $comments->currentPage() + 1 : null,
            'current_page' => $comments->currentPage(),
            'total' => $comments->total(),
            'showing' => $comments->firstItem() ? $comments->lastItem() : 0,
        ]);
    }

    public function storeComment(Request $request, Article $article): JsonResponse
    {
        abort_unless($article->status === 'Published' && $article->published_at, 404);

        $visitorKey = $this->visitorKey($request);

        if (ArticleComment::where('article_id', $article->id)->where('visitor_key', $visitorKey)->exists()) {
            return response()->json([
                'message' => 'You have already submitted a comment on this article. Our team will review it shortly.',
            ], 422);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:3', 'max:2000'],
        ]);

        try {
            ArticleComment::create([
                'article_id' => $article->id,
                'name' => strip_tags($validated['name']),
                'email' => strtolower(trim($validated['email'])),
                'message' => trim(strip_tags($validated['message'])),
                'status' => 'pending',
                'ip_address' => $this->clientIp($request),
                'user_agent' => $request->userAgent(),
                'visitor_key' => $visitorKey,
            ]);
        } catch (QueryException) {
            return response()->json([
                'message' => 'You have already submitted a comment on this article. Our team will review it shortly.',
            ], 422);
        }

        return response()->json([
            'message' => 'Thanks for sharing your thoughts. Your comment is awaiting approval.',
        ]);
    }

    public function reactToComment(Request $request, ArticleComment $comment): JsonResponse
    {
        abort_unless($comment->status === 'approved', 404);

        $validated = $request->validate([
            'reaction' => ['required', 'in:like,dislike'],
        ]);

        ArticleCommentReaction::updateOrCreate(
            [
                'article_comment_id' => $comment->id,
                'fingerprint' => $this->fingerprint($request),
            ],
            ['reaction' => $validated['reaction']]
        );

        return response()->json($this->commentReactionCounts($comment));
    }

    public function helpfulVote(Request $request, Article $article): JsonResponse
    {
        abort_unless($article->status === 'Published' && $article->published_at, 404);

        $validated = $request->validate([
            'vote' => ['required', 'in:yes,no'],
        ]);

        ArticleHelpfulVote::updateOrCreate(
            [
                'article_id' => $article->id,
                'fingerprint' => $this->fingerprint($request),
            ],
            ['vote' => $validated['vote']]
        );

        return response()->json([
            'message' => 'Thank you. Your feedback helps us improve future articles.',
            'counts' => $this->helpfulCounts($article),
        ]);
    }

    private function commentReactionCounts(ArticleComment $comment): array
    {
        $counts = $comment->reactions()
            ->select('reaction', DB::raw('COUNT(*) as total'))
            ->groupBy('reaction')
            ->pluck('total', 'reaction');

        return [
            'likes' => (int) ($counts['like'] ?? 0),
            'dislikes' => (int) ($counts['dislike'] ?? 0),
        ];
    }

    private function approvedCommentsQuery(Article $article, string $sort)
    {
        $query = $article->approvedComments()
            ->withCount([
                'reactions as likes_count' => fn ($query) => $query->where('reaction', 'like'),
                'reactions as dislikes_count' => fn ($query) => $query->where('reaction', 'dislike'),
            ]);

        return match ($sort) {
            'oldest' => $query->oldest(),
            'positive' => $query->orderByDesc('likes_count')->latest(),
            'negative' => $query->orderByDesc('dislikes_count')->latest(),
            'popular' => $query->orderByDesc('likes_count')->orderByDesc('dislikes_count')->latest(),
            default => $query->latest(),
        };
    }

    private function helpfulCounts(Article $article): array
    {
        $counts = $article->helpfulVotes()
            ->select('vote', DB::raw('COUNT(*) as total'))
            ->groupBy('vote')
            ->pluck('total', 'vote');

        return [
            'yes' => (int) ($counts['yes'] ?? 0),
            'no' => (int) ($counts['no'] ?? 0),
        ];
    }

    private function fingerprint(Request $request): string
    {
        return hash('sha256', ($this->clientIp($request) ?: 'unknown').'|'.($request->userAgent() ?: 'unknown'));
    }

    private function visitorKey(Request $request): string
    {
        $sessionId = $request->hasSession() ? $request->session()->getId() : null;

        return hash('sha256', ($sessionId ?: 'no-session').'|'.($this->clientIp($request) ?: 'unknown').'|'.($request->userAgent() ?: 'unknown'));
    }

    private function clientIp(Request $request): ?string
    {
        foreach (['CF-Connecting-IP', 'True-Client-IP', 'X-Real-IP'] as $header) {
            $ip = $request->headers->get($header);

            if ($ip && filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }

        $forwardedFor = $request->headers->get('X-Forwarded-For');

        if ($forwardedFor) {
            foreach (explode(',', $forwardedFor) as $ip) {
                $ip = trim($ip);

                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $ip;
                }
            }
        }

        return $request->ip();
    }
}
