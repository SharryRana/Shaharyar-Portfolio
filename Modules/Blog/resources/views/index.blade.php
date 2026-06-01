@php
    use Illuminate\Support\Str;

    $articles = $articles ?? collect();
    $categories = $categories ?? collect();
    $popularPosts = $popularPosts ?? collect();
    $selectedCategory = $selectedCategory ?? null;

    $fallbackImages = [
        'https://images.unsplash.com/photo-1581276879432-15e50529f34b?auto=format&fit=crop&w=900&q=80',
        'https://images.unsplash.com/photo-1555949963-aa79dcee981c?auto=format&fit=crop&w=900&q=80',
        'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?auto=format&fit=crop&w=900&q=80',
        'https://images.unsplash.com/photo-1542744094-3a31f272c490?auto=format&fit=crop&w=900&q=80',
    ];

    $imageUrl = function ($path, int $index = 0) use ($fallbackImages) {
        if (!$path) {
            return $fallbackImages[$index % count($fallbackImages)];
        }

        return Str::startsWith($path, ['http://', 'https://', '//']) ? $path : asset($path);
    };

    $authorName = fn ($article) => $article->author?->name ?: ($article->author_name ?: 'Creavibe Team');
    $authorAvatar = fn ($article, int $index = 0) => $article->author?->avatar ?: ($article->author_avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode($authorName($article)) . '&background=4f5ff6&color=fff');
@endphp

@push('styles')
    <style>
        .blog-pagination {
            margin-top: 2.5rem;
        }

        .blog-pagination nav > div:first-child {
            display: none;
        }

        .blog-pagination nav > div:last-child {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: center;
        }

        .blog-pagination .relative {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 42px;
            min-height: 42px;
            border-radius: 999px;
            border: 1px solid var(--border);
            background: var(--card-bg);
            color: var(--text-light);
            font-weight: 700;
            box-shadow: 0 8px 20px var(--shadow);
            margin: 0 0.15rem;
        }

        .blog-pagination span[aria-current="page"] .relative,
        .blog-pagination .bg-white {
            color: var(--primary);
        }

        .blog-pagination a.relative:hover {
            color: white;
            background: var(--accent-gradient);
            border-color: transparent;
        }

        .blog-pagination svg {
            width: 18px;
            height: 18px;
        }
    </style>
@endpush

<x-blog::layouts.master>
    <section class="hero">
        <div class="container hero-content">
            <h1 class="hero-title">{{ $selectedCategory ? $selectedCategory->name : 'Where Ideas Flow & Creativity Grows' }}</h1>
            <p class="hero-subtitle">
                {{ $selectedCategory?->description ?: 'Discover inspiring stories, practical tutorials, and innovative ideas across design, development, and technology.' }}
            </p>
            <a href="#articles" class="hero-cta">Explore Articles <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>

    <div class="container main-content" id="articles">
        <main>
            <h2 class="section-title">{{ $selectedCategory ? $selectedCategory->name . ' Articles' : 'Featured Stories' }}</h2>

            <div class="posts-grid">
                @forelse ($articles as $index => $article)
                    <article class="post-card">
                        <a href="{{ route('blog.show', $article->slug) }}" class="post-img-container">
                            <img src="{{ $imageUrl($article->image, $index) }}"
                                alt="{{ $article->image_alt_text ?: $article->title }}"
                                title="{{ $article->image_title ?: $article->title }}"
                                class="post-img" loading="lazy">
                            <span class="post-category">{{ $article->display_category }}</span>
                        </a>
                        <div class="post-content">
                            <h3 class="post-title">
                                <a href="{{ route('blog.show', $article->slug) }}">{{ $article->title }}</a>
                            </h3>
                            <p class="post-excerpt">
                                {{ $article->excerpt ?: Str::limit(strip_tags($article->content), 135) }}
                            </p>
                            <div class="post-meta">
                                <div class="post-author">
                                    <img src="{{ $authorAvatar($article, $index) }}" alt="{{ $authorName($article) }}" class="author-avatar">
                                    <span>{{ $authorName($article) }}</span>
                                </div>
                                <a href="{{ route('blog.show', $article->slug) }}" class="read-more">
                                    Read More <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <article class="post-card">
                        <div class="post-content">
                            <h3 class="post-title">No articles found</h3>
                            <p class="post-excerpt">Publish articles from the Blog admin dashboard and they will appear here automatically.</p>
                        </div>
                    </article>
                @endforelse
            </div>

            @if (method_exists($articles, 'links') && $articles->hasPages())
                <div class="blog-pagination">
                    {{ $articles->links() }}
                </div>
            @endif
        </main>

        <aside class="sidebar">
            <div class="sidebar-widget">
                <h3 class="widget-title">About Blog</h3>
                <p class="about-text">Creavibe Blog is a platform for sharing ideas, tutorials, and insights about web
                    development, design, and technology. We're passionate about helping creators build amazing digital
                    experiences.</p>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                </div>
            </div>

            <div class="sidebar-widget">
                <h3 class="widget-title">Categories</h3>
                <ul class="categories-list">
                    @forelse ($categories as $category)
                        <li class="category-item">
                            <a href="{{ route('blog.category.show', $category->slug) }}" class="category-link">{{ $category->name }}</a>
                            <span class="category-count">{{ $category->articles_count }}</span>
                        </li>
                    @empty
                        <li class="category-item">
                            <span class="category-link">No categories yet</span>
                            <span class="category-count">0</span>
                        </li>
                    @endforelse
                </ul>
            </div>

            <div class="sidebar-widget">
                <h3 class="widget-title">Popular Posts</h3>
                @forelse ($popularPosts as $index => $post)
                    <a href="{{ route('blog.show', $post->slug) }}" class="popular-post">
                        <img src="{{ $imageUrl($post->image, $index + 2) }}"
                            alt="{{ $post->image_alt_text ?: $post->title }}"
                            class="popular-post-img" loading="lazy">
                        <div class="popular-post-content">
                            <h4 class="popular-post-title">{{ $post->title }}</h4>
                            <span class="popular-post-date">{{ optional($post->published_at)->format('F j, Y') }}</span>
                        </div>
                    </a>
                @empty
                    <p class="about-text">Popular posts will appear after articles are published.</p>
                @endforelse
            </div>

            <div class="sidebar-widget">
                <h3 class="widget-title">Newsletter</h3>
                <p class="about-text">Subscribe to our newsletter to get the latest updates and articles directly in
                    your inbox.</p>
                <div class="newsletter-status" data-newsletter-status></div>
                <form class="newsletter-form" action="{{ route('blog.newsletter.submit') }}" method="POST" data-newsletter-form>
                    @csrf
                    <input type="email" name="email" class="newsletter-input" placeholder="Your email address" required>
                    <button type="submit" class="newsletter-btn">
                        <span data-newsletter-label>Subscribe</span>
                        <span data-newsletter-spinner class="newsletter-spinner" hidden></span>
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </aside>
    </div>
</x-blog::layouts.master>
