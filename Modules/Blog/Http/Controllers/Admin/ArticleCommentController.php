<?php

namespace Modules\Blog\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Blog\Models\ArticleComment;

class ArticleCommentController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'in:pending,approved,rejected'],
        ]);

        $comments = ArticleComment::with('article')
            ->when($filters['search'] ?? null, function ($query, string $search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where('name', 'like', '%'.$search.'%')
                        ->orWhere('email', 'like', '%'.$search.'%')
                        ->orWhere('message', 'like', '%'.$search.'%')
                        ->orWhereHas('article', fn ($query) => $query->where('title', 'like', '%'.$search.'%'));
                });
            })
            ->when($filters['status'] ?? null, fn ($query, string $status) => $query->where('status', $status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('blog::admin.comments.index', [
            'comments' => $comments,
            'filters' => $filters,
            'pendingTotal' => ArticleComment::where('status', 'pending')->count(),
        ]);
    }

    public function approve(ArticleComment $comment)
    {
        $comment->update(['status' => 'approved']);

        return back()->with('success', 'Comment accepted and published.');
    }

    public function reject(ArticleComment $comment)
    {
        $comment->update(['status' => 'rejected']);

        return back()->with('success', 'Comment rejected.');
    }

    public function destroy(ArticleComment $comment)
    {
        $comment->delete();

        return back()->with('success', 'Comment deleted.');
    }
}
