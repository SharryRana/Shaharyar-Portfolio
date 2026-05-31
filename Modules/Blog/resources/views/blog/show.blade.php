@php
    use Illuminate\Support\Str;

    $categories = $categories ?? collect();
    $popularPosts = $popularPosts ?? collect();
    $relatedPosts = $relatedPosts ?? collect();

    $imageUrl = function ($path, string $fallback) {
        if (!$path) {
            return $fallback;
        }

        return Str::startsWith($path, ['http://', 'https://', '//']) ? $path : asset($path);
    };

    $heroImage = $imageUrl($article->image, 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1600&q=80');
    $imageTitle = $article->image_title ?: $article->title;
    $imageAlt = $article->image_alt_text ?: $article->title;
    $authorName = $article->author?->name ?: ($article->author_name ?: 'Creavibe Team');
    $authorAvatar = $article->author?->avatar ?: $article->author_avatar;
    $authorBio = $article->author?->bio ?: ($article->excerpt ?: 'Sharing practical ideas and technical insights from the Creavibe team.');
    $authorDesignation = $article->author?->designation ?: 'Author';
    $authorInitials = collect(explode(' ', trim($authorName)))->filter()->take(2)->map(fn ($part) => Str::upper(Str::substr($part, 0, 1)))->join('') ?: 'C';
    $keywords = collect(explode(',', (string) $article->meta_keywords))->map(fn ($tag) => trim($tag))->filter()->values();
    $content = $article->content ?: '<p>' . e($article->excerpt ?: 'Article content will appear here after it is added from the admin dashboard.') . '</p>';

    $videoEmbed = function (string $url): ?string {
        $url = html_entity_decode($url, ENT_QUOTES);
        $embedUrl = null;

        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/|youtube\.com\/shorts\/)([A-Za-z0-9_-]{6,})/', $url, $matches)) {
            $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
        } elseif (preg_match('/vimeo\.com\/(?:video\/)?([0-9]+)/', $url, $matches)) {
            $embedUrl = 'https://player.vimeo.com/video/' . $matches[1];
        }

        return $embedUrl
            ? '<div class="article-video"><iframe src="' . e($embedUrl) . '" title="Article video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>'
            : null;
    };

    $content = preg_replace_callback('/<figure[^>]*class=(["\'])(?=[^"\']*\bmedia\b)[^"\']*\1[^>]*>\s*<oembed[^>]*url=(["\'])(.*?)\2[^>]*><\/oembed>\s*<\/figure>/is', fn ($matches) => $videoEmbed($matches[3]) ?? $matches[0], $content);
    $content = preg_replace_callback('/<oembed[^>]*url=(["\'])(.*?)\1[^>]*><\/oembed>/is', fn ($matches) => $videoEmbed($matches[2]) ?? $matches[0], $content);

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $article->meta_title ?: $article->title,
        'description' => $article->meta_description ?: $article->excerpt,
        'image' => $heroImage,
        'datePublished' => optional($article->published_at)->toIso8601String(),
        'dateModified' => optional($article->updated_at)->toIso8601String(),
        'author' => [
            '@type' => 'Person',
            'name' => $authorName,
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Creavibe Blog',
        ],
    ];
@endphp

@section('title', $article->meta_title ?: $article->title . ' | Creavibe Blog')
@section('meta_description', $article->meta_description ?: $article->excerpt)
@section('meta_keywords', $article->meta_keywords ?: $article->display_category)
@section('meta_author', $authorName)

@push('meta')
    <meta property="og:title" content="{{ $article->meta_title ?: $article->title }}">
    <meta property="og:description" content="{{ $article->meta_description ?: $article->excerpt }}">
    <meta property="og:image" content="{{ $heroImage }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ route('blog.show', $article->slug) }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $article->meta_title ?: $article->title }}">
    <meta name="twitter:description" content="{{ $article->meta_description ?: $article->excerpt }}">
    <meta name="twitter:image" content="{{ $heroImage }}">
    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endpush

@push('styles')
    <style>
        .article-hero {
            padding: 4.5rem 0 3rem;
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.08), rgba(114, 9, 183, 0.08));
        }

        .article-hero-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(320px, 0.86fr);
            gap: 3rem;
            align-items: center;
        }

        .article-kicker {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.55rem 1rem;
            border-radius: 999px;
            background: rgba(67, 97, 238, 0.1);
            color: var(--primary);
            font-weight: 700;
            font-size: 0.9rem;
            margin-bottom: 1.25rem;
        }

        .article-title {
            color: var(--text);
            font-family: 'Poppins', sans-serif;
            font-size: clamp(2.25rem, 5vw, 4.5rem);
            line-height: 1.06;
            margin-bottom: 1.25rem;
        }

        .article-excerpt {
            color: var(--text-light);
            font-size: 1.15rem;
            line-height: 1.8;
            max-width: 760px;
        }

        .article-meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
            margin-top: 1.75rem;
            color: var(--text-light);
            font-weight: 600;
        }

        .article-author-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.55rem 1rem 0.55rem 0.55rem;
            border-radius: 999px;
            background: var(--card-bg);
            box-shadow: 0 10px 25px var(--shadow);
        }

        .article-author-pill img,
        .article-author-initials {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
        }

        .article-author-initials {
            display: grid;
            place-items: center;
            color: white;
            background: var(--accent-gradient);
            font-weight: 800;
        }

        .article-hero-image {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 60px var(--shadow);
        }

        .article-hero-image img {
            width: 100%;
            aspect-ratio: 4 / 3;
            object-fit: cover;
        }

        .article-shell {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 3rem;
            margin-top: 4rem;
            margin-bottom: 5rem;
        }

        .article-panel {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: 0 10px 25px var(--shadow);
            padding: clamp(1.4rem, 4vw, 3rem);
        }

        .article-body {
            color: var(--text-light);
            font-size: 1.05rem;
            line-height: 1.85;
        }

        .article-body h1,
        .article-body h2,
        .article-body h3,
        .article-body h4 {
            color: var(--text);
            font-family: 'Poppins', sans-serif;
            line-height: 1.25;
            margin: 2rem 0 1rem;
        }

        .article-body h1 { font-size: 2.25rem; }
        .article-body h2 { font-size: 1.85rem; }
        .article-body h3 { font-size: 1.45rem; }
        .article-body p,
        .article-body ul,
        .article-body ol,
        .article-body blockquote,
        .article-body figure {
            margin-bottom: 1.25rem;
        }

        .article-body ul,
        .article-body ol {
            padding-left: 1.35rem;
        }

        .article-body ul { list-style: disc; }
        .article-body ol { list-style: decimal; }

        .article-body img {
            border-radius: 18px;
            box-shadow: 0 16px 35px var(--shadow);
            margin: 1.5rem 0;
        }

        .article-body blockquote {
            border-left: 4px solid var(--primary);
            background: rgba(67, 97, 238, 0.08);
            border-radius: 12px;
            padding: 1.2rem 1.4rem;
            color: var(--text);
            font-weight: 600;
        }

        .article-video {
            position: relative;
            aspect-ratio: 16 / 9;
            border-radius: 18px;
            overflow: hidden;
            background: #111827;
            box-shadow: 0 16px 35px var(--shadow);
            margin: 1.5rem 0;
        }

        .article-video iframe {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        .article-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border);
        }

        .article-tag {
            border-radius: 999px;
            padding: 0.55rem 0.9rem;
            background: rgba(67, 97, 238, 0.1);
            color: var(--primary);
            font-weight: 700;
            font-size: 0.86rem;
        }

        .author-box {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
            align-items: flex-start;
            border-radius: 18px;
            background: rgba(67, 97, 238, 0.07);
            padding: 1.25rem;
        }

        .author-box img,
        .author-box .article-author-initials {
            flex: 0 0 64px;
            width: 64px;
            height: 64px;
        }

        .detail-sidebar {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .detail-sidebar .sidebar-widget {
            margin-bottom: 0;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        @media (max-width: 992px) {
            .article-hero-grid,
            .article-shell {
                grid-template-columns: 1fr;
            }

            .related-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

<x-blog::layouts.master>
    <section class="article-hero">
        <div class="container article-hero-grid">
            <div>
                <span class="article-kicker">
                    <i class="fas fa-folder-open"></i>
                    {{ $article->display_category }}
                </span>
                <h1 class="article-title">{{ $article->title }}</h1>
                @if ($article->excerpt)
                    <p class="article-excerpt">{{ $article->excerpt }}</p>
                @endif
                <div class="article-meta-row">
                    <span class="article-author-pill">
                        @if ($authorAvatar)
                            <img src="{{ $imageUrl($authorAvatar, '') }}" alt="{{ $authorName }}">
                        @else
                            <span class="article-author-initials">{{ $authorInitials }}</span>
                        @endif
                        {{ $authorName }}
                    </span>
                    <span><i class="far fa-calendar"></i> {{ optional($article->published_at)->format('F j, Y') }}</span>
                    <span><i class="far fa-eye"></i> {{ number_format($article->view_count) }} views</span>
                </div>
            </div>
            <div class="article-hero-image">
                <img src="{{ $heroImage }}" alt="{{ $imageAlt }}" title="{{ $imageTitle }}">
            </div>
        </div>
    </section>

    <div class="container article-shell">
        <main>
            <article class="article-panel">
                <div class="article-body">
                    {!! $content !!}
                </div>

                <div class="article-tags">
                    <a href="{{ $article->blogCategory ? route('blog.category.show', $article->blogCategory->slug) : route('blog.index') }}" class="article-tag">
                        #{{ $article->display_category }}
                    </a>
                    @foreach ($keywords as $keyword)
                        <span class="article-tag">#{{ $keyword }}</span>
                    @endforeach
                </div>

                <div class="author-box">
                    @if ($authorAvatar)
                        <img src="{{ $imageUrl($authorAvatar, '') }}" alt="{{ $authorName }}">
                    @else
                        <span class="article-author-initials">{{ $authorInitials }}</span>
                    @endif
                    <div>
                        <h3 class="post-title" style="margin-bottom: .25rem;">{{ $authorName }}</h3>
                        <p class="about-text" style="margin-bottom: .75rem;">{{ $authorDesignation }}</p>
                        <p class="about-text">{{ $authorBio }}</p>
                    </div>
                </div>
            </article>

            @if ($relatedPosts->isNotEmpty())
                <section style="margin-top: 3rem;">
                    <h2 class="section-title">Related Articles</h2>
                    <div class="related-grid">
                        @foreach ($relatedPosts as $index => $post)
                            <article class="post-card">
                                <a href="{{ route('blog.show', $post->slug) }}" class="post-img-container">
                                    <img src="{{ $imageUrl($post->image, 'https://images.unsplash.com/photo-1581276879432-15e50529f34b?auto=format&fit=crop&w=900&q=80') }}"
                                        alt="{{ $post->image_alt_text ?: $post->title }}" class="post-img" loading="lazy">
                                    <span class="post-category">{{ $post->display_category }}</span>
                                </a>
                                <div class="post-content">
                                    <h3 class="post-title"><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h3>
                                    <p class="post-excerpt">{{ Str::limit($post->excerpt ?: strip_tags($post->content), 110) }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif
        </main>

        <aside class="detail-sidebar">
            <div class="sidebar-widget">
                <h3 class="widget-title">Categories</h3>
                <ul class="categories-list">
                    @foreach ($categories as $category)
                        <li class="category-item">
                            <a href="{{ route('blog.category.show', $category->slug) }}" class="category-link">{{ $category->name }}</a>
                            <span class="category-count">{{ $category->articles_count }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="sidebar-widget">
                <h3 class="widget-title">Popular Posts</h3>
                @forelse ($popularPosts as $post)
                    <a href="{{ route('blog.show', $post->slug) }}" class="popular-post">
                        <img src="{{ $imageUrl($post->image, 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?auto=format&fit=crop&w=300&q=80') }}"
                            alt="{{ $post->image_alt_text ?: $post->title }}" class="popular-post-img" loading="lazy">
                        <div class="popular-post-content">
                            <h4 class="popular-post-title">{{ $post->title }}</h4>
                            <span class="popular-post-date">{{ optional($post->published_at)->format('F j, Y') }}</span>
                        </div>
                    </a>
                @empty
                    <p class="about-text">Popular posts will appear after more articles are viewed.</p>
                @endforelse
            </div>

            <div class="sidebar-widget">
                <h3 class="widget-title">Need Custom Software?</h3>
                <p class="about-text">Creavibe builds SaaS platforms, dashboards, automation tools, and scalable web applications.</p>
                <a href="{{ url('/#contact') }}" class="newsletter-btn" style="display: inline-flex; justify-content: center; text-decoration: none;">Start a Project</a>
            </div>
        </aside>
    </div>
</x-blog::layouts.master>
