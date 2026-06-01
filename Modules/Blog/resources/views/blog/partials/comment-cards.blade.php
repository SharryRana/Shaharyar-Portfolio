@php
    use Illuminate\Support\Str;
@endphp

@forelse ($comments as $comment)
    @php
        $commentInitials = collect(explode(' ', trim($comment->name)))
            ->filter()
            ->take(2)
            ->map(fn ($part) => Str::upper(Str::substr($part, 0, 1)))
            ->join('') ?: 'R';
    @endphp
    <article class="comment-card" data-comment-card>
        <div class="comment-head">
            <div class="comment-author">
                <span class="comment-avatar">{{ $commentInitials }}</span>
                <div>
                    <h3 class="post-title" style="font-size: 1rem; margin-bottom: .15rem;">{{ $comment->name }}</h3>
                    <p class="about-text" style="font-size: .86rem;">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
        <p class="about-text" style="margin-bottom: 1rem;">{{ $comment->message }}</p>
        <div class="comment-actions">
            <button type="button" class="comment-reaction-btn" data-comment-id="{{ $comment->id }}" data-comment-reaction="like" data-reaction-url="{{ route('blog.comments.react', $comment) }}">
                <i class="fas fa-thumbs-up"></i> <span data-like-count>{{ $comment->likes_count }}</span>
            </button>
            <button type="button" class="comment-reaction-btn" data-comment-id="{{ $comment->id }}" data-comment-reaction="dislike" data-reaction-url="{{ route('blog.comments.react', $comment) }}">
                <i class="fas fa-thumbs-down"></i> <span data-dislike-count>{{ $comment->dislikes_count }}</span>
            </button>
        </div>
    </article>
@empty
    <p class="about-text" data-comments-empty-message>No comments yet. Be the first to share a thoughtful note.</p>
@endforelse
