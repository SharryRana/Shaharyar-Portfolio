@php
    use Illuminate\Support\Str;

    $categories = $categories ?? collect();
    $popularPosts = $popularPosts ?? collect();
    $relatedPosts = $relatedPosts ?? collect();
    $approvedComments = $approvedComments ?? collect();
    $commentsEnabled = $commentsEnabled ?? false;
    $helpfulEnabled = $helpfulEnabled ?? false;
    $helpfulCounts = $helpfulCounts ?? ['yes' => 0, 'no' => 0];

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

        .article-feedback,
        .comments-panel {
            margin-top: 2rem;
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: 0 10px 25px var(--shadow);
            padding: clamp(1.4rem, 4vw, 2.25rem);
        }

        .feedback-actions,
        .comment-actions {
            display: flex;
            flex-wrap: wrap;
            gap: .75rem;
            align-items: center;
        }

        .feedback-btn,
        .comment-reaction-btn {
            border: 1px solid var(--border);
            background: rgba(67, 97, 238, .06);
            color: var(--text);
            border-radius: 999px;
            padding: .7rem 1rem;
            font-weight: 800;
            cursor: pointer;
            transition: var(--transition);
        }

        .feedback-btn:hover,
        .comment-reaction-btn:hover,
        .feedback-btn.is-active,
        .comment-reaction-btn.is-active {
            transform: translateY(-2px);
            background: var(--primary-gradient);
            color: #fff;
            box-shadow: 0 10px 22px rgba(67, 97, 238, .22);
        }

        .comments-list {
            display: grid;
            gap: 1rem;
            margin: 1.5rem 0 2rem;
        }

        .comments-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            margin: 1.25rem 0 .5rem;
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: .85rem;
            background: rgba(255, 255, 255, .48);
        }

        body.dark-mode .comments-toolbar {
            background: rgba(255, 255, 255, .04);
        }

        .comments-count-pill {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            border-radius: 999px;
            background: rgba(67, 97, 238, .08);
            color: var(--text);
            padding: .7rem 1rem;
            font-weight: 800;
            font-size: .9rem;
        }

        .comments-filter-wrap {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: .55rem;
            border: 1px solid var(--border);
            border-radius: 999px;
            background: var(--card-bg);
            padding: .35rem;
            color: var(--text-light);
            font-weight: 800;
            box-shadow: 0 10px 24px var(--shadow);
        }

        .comments-filter-label {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding-left: .55rem;
        }

        .comments-filter-wrap select[data-comments-sort] {
            position: absolute;
            width: 1px;
            height: 1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        .comments-sort-custom {
            position: relative;
        }

        .comments-sort-toggle {
            border: 0;
            border-radius: 999px;
            background: rgba(67, 97, 238, .08);
            color: var(--text);
            padding: .62rem .8rem .62rem .95rem;
            font-weight: 900;
            outline: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            transition: var(--transition);
        }

        .comments-sort-toggle:hover,
        .comments-sort-custom.is-open .comments-sort-toggle {
            background: var(--primary-gradient);
            color: #fff;
            box-shadow: 0 10px 22px rgba(67, 97, 238, .18);
        }

        .comments-sort-menu {
            position: absolute;
            right: 0;
            top: calc(100% + .6rem);
            z-index: 30;
            min-width: 230px;
            border: 1px solid var(--border);
            border-radius: 18px;
            background: var(--bg-alt);
            padding: .45rem;
            box-shadow: 0 24px 60px rgba(15, 23, 42, .18);
            opacity: 0;
            transform: translateY(-8px) scale(.98);
            pointer-events: none;
            transition: opacity .18s ease, transform .18s ease;
        }

        body.dark-mode .comments-sort-menu {
            background: #1e1e1e;
            box-shadow: 0 24px 60px rgba(0, 0, 0, .38);
        }

        .comments-sort-custom.is-open .comments-sort-menu {
            opacity: 1;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        .comments-sort-option {
            width: 100%;
            border: 0;
            border-radius: 13px;
            background: transparent;
            color: var(--text);
            padding: .78rem .9rem;
            font-weight: 800;
            text-align: left;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .9rem;
            transition: var(--transition);
        }

        .comments-sort-option:hover,
        .comments-sort-option.is-active {
            background: rgba(67, 97, 238, .09);
            color: var(--primary);
        }

        .comments-sort-option.is-active::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: .82rem;
        }

        @media (max-width: 576px) {
            .comments-toolbar,
            .comments-filter-wrap {
                align-items: stretch;
            }

            .comments-filter-wrap,
            .comments-sort-custom,
            .comments-sort-toggle {
                width: 100%;
            }

            .comments-sort-toggle {
                justify-content: space-between;
            }

            .comments-sort-menu {
                left: 0;
                right: auto;
                width: 100%;
            }
        }

        .comments-load-more {
            margin: 0 auto 2rem;
            border: 0;
            border-radius: 999px;
            background: var(--primary-gradient);
            color: #fff;
            padding: .95rem 1.35rem;
            font-weight: 900;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .55rem;
            transition: var(--transition);
            box-shadow: 0 10px 22px rgba(67, 97, 238, .18);
        }

        .comments-load-more:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(67, 97, 238, .28);
        }

        .comments-load-more[hidden] {
            display: none !important;
        }

        .comments-loader {
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, .45);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .75s linear infinite;
        }

        .comments-loader[hidden] {
            display: none !important;
        }

        .comment-card {
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 1.1rem;
            background: rgba(255, 255, 255, .58);
            animation: fadeIn .28s ease both;
        }

        body.dark-mode .comment-card {
            background: rgba(255, 255, 255, .04);
        }

        .comment-head {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            align-items: flex-start;
            margin-bottom: .75rem;
        }

        .comment-author {
            display: flex;
            align-items: center;
            gap: .8rem;
        }

        .comment-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            color: #fff;
            background: var(--accent-gradient);
            font-weight: 900;
            flex: 0 0 44px;
        }

        .comment-form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
        }

        .comment-field,
        .comment-textarea {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: var(--card-bg);
            color: var(--text);
            padding: .9rem 1rem;
            outline: none;
            transition: var(--transition);
        }

        .comment-field:focus,
        .comment-textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, .16);
        }

        .comment-textarea {
            min-height: 140px;
            resize: vertical;
            margin-top: 1rem;
        }

        .comment-submit-btn {
            margin-top: 1rem;
            border: 0;
            border-radius: 999px;
            background: var(--primary-gradient);
            color: #fff;
            padding: .95rem 1.4rem;
            font-weight: 900;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: .55rem;
            transition: var(--transition);
        }

        .comment-submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(67, 97, 238, .24);
        }

        @media (max-width: 992px) {
            .article-hero-grid,
            .article-shell {
                grid-template-columns: 1fr;
            }

            .related-grid {
                grid-template-columns: 1fr;
            }

            .comment-form-grid {
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

            <section class="article-feedback" aria-labelledby="helpful-title">
                <h2 class="section-title" id="helpful-title">Did you find this helpful?</h2>
                <p class="about-text" style="margin-bottom: 1rem;">Your feedback helps us publish sharper, more useful articles.</p>
                <div data-helpful-status class="blog-inline-status"></div>
                @if($helpfulEnabled)
                    <div class="feedback-actions">
                        <button type="button" class="feedback-btn" data-helpful-vote="yes" data-article-id="{{ $article->id }}" data-helpful-url="{{ route('blog.articles.helpful', $article) }}">
                            <i class="fas fa-thumbs-up"></i> Yes <span data-helpful-yes-count>{{ $helpfulCounts['yes'] ?? 0 }}</span>
                        </button>
                        <button type="button" class="feedback-btn" data-helpful-vote="no" data-article-id="{{ $article->id }}" data-helpful-url="{{ route('blog.articles.helpful', $article) }}">
                            <i class="fas fa-thumbs-down"></i> No <span data-helpful-no-count>{{ $helpfulCounts['no'] ?? 0 }}</span>
                        </button>
                    </div>
                @else
                    <p class="about-text">Feedback voting will appear after the blog interaction migrations are run.</p>
                @endif
            </section>

            <section class="comments-panel" aria-labelledby="comments-title">
                <h2 class="section-title" id="comments-title">Reader Comments</h2>
                <p class="about-text" style="margin-bottom: 1.5rem;">Share your opinion below. Comments appear after admin approval.</p>

                @if($commentsEnabled)
                    @php
                        $commentsTotal = method_exists($approvedComments, 'total') ? $approvedComments->total() : $approvedComments->count();
                        $commentsShowing = method_exists($approvedComments, 'lastItem') ? ($approvedComments->lastItem() ?? 0) : $approvedComments->count();
                        $commentsNextPage = method_exists($approvedComments, 'hasMorePages') && $approvedComments->hasMorePages() ? 2 : '';
                    @endphp
                    <div class="comments-toolbar" data-comments-feed data-comments-url="{{ route('blog.comments.index', $article) }}" data-comments-page="1" data-comments-next-page="{{ $commentsNextPage }}">
                        <span class="comments-count-pill">
                            <i class="fas fa-comments"></i>
                            Showing <span data-comments-showing>{{ $commentsShowing }}</span> of <span data-comments-total>{{ $commentsTotal }}</span>
                        </span>
                        <div class="comments-filter-wrap">
                            <span class="comments-filter-label"><i class="fas fa-sliders"></i></span>
                            <select data-comments-sort aria-label="Sort comments">
                                <option value="latest">Latest</option>
                                <option value="oldest">Oldest</option>
                                <option value="positive">Highest positive</option>
                                <option value="negative">Highest negative</option>
                                <option value="popular">Most popular</option>
                            </select>
                            <div class="comments-sort-custom" data-comments-sort-custom>
                                <button type="button" class="comments-sort-toggle" data-comments-sort-toggle aria-haspopup="listbox" aria-expanded="false">
                                    <span data-comments-sort-label>Latest</span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <div class="comments-sort-menu" data-comments-sort-menu role="listbox">
                                    <button type="button" class="comments-sort-option is-active" data-comments-sort-option value="latest" role="option" aria-selected="true">Latest</button>
                                    <button type="button" class="comments-sort-option" data-comments-sort-option value="oldest" role="option" aria-selected="false">Oldest</button>
                                    <button type="button" class="comments-sort-option" data-comments-sort-option value="positive" role="option" aria-selected="false">Highest positive</button>
                                    <button type="button" class="comments-sort-option" data-comments-sort-option value="negative" role="option" aria-selected="false">Highest negative</button>
                                    <button type="button" class="comments-sort-option" data-comments-sort-option value="popular" role="option" aria-selected="false">Most popular</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="comments-list" data-comments-list>
                        @include('blog::blog.partials.comment-cards', ['comments' => $approvedComments])
                    </div>
                    <button type="button" class="comments-load-more" data-comments-load-more @if(!$commentsNextPage) hidden @endif>
                        <span data-comments-load-label>Load more comments</span>
                        <span class="comments-loader" data-comments-loader hidden></span>
                        <i class="fas fa-arrow-down"></i>
                    </button>

                    <div data-comment-status class="blog-inline-status"></div>
                    <form action="{{ route('blog.comments.store', $article) }}" method="POST" data-comment-form>
                        @csrf
                        <div class="comment-form-grid">
                            <input class="comment-field" type="text" name="name" placeholder="Your name" required>
                            <input class="comment-field" type="email" name="email" placeholder="Email address" required>
                        </div>
                        <textarea class="comment-textarea" name="message" placeholder="Write your comment..." required></textarea>
                        <button type="submit" class="comment-submit-btn">
                            <span data-comment-label>Submit Comment</span>
                            <span data-comment-spinner class="comment-spinner" hidden></span>
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                @else
                    <div class="comment-card">
                        <p class="about-text">The comment form will appear after the blog comment migrations are run.</p>
                    </div>
                @endif
            </section>

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
                <h3 class="widget-title">Newsletter</h3>
                <p class="about-text">Subscribe to get the latest Creavibe articles directly in your inbox.</p>
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

            <div class="sidebar-widget">
                <h3 class="widget-title">Need Custom Software?</h3>
                <p class="about-text">Creavibe builds SaaS platforms, dashboards, automation tools, and scalable web applications.</p>
                <a href="{{ url('/#contact') }}" class="newsletter-btn" style="display: inline-flex; justify-content: center; text-decoration: none;">Start a Project</a>
            </div>
        </aside>
    </div>
</x-blog::layouts.master>
