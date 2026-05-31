@php
    use Illuminate\Support\Str;

    $categories = $categories ?? collect();
@endphp

@push('styles')
    <style>
        .category-hero {
            padding: 5rem 0;
            background: var(--accent-gradient);
            color: white;
            text-align: center;
            border-radius: 0 0 40px 40px;
            margin-bottom: 4rem;
            position: relative;
            overflow: hidden;
        }

        .category-hero::after {
            content: "";
            position: absolute;
            width: 200%;
            height: 200%;
            top: -50%;
            left: -50%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 20%, transparent 70%);
            animation: rotateBg 15s linear infinite;
        }

        @keyframes rotateBg {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .categories-section {
            margin-bottom: 4rem;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
        }

        .category-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            text-align: center;
            padding: 2rem 1.5rem;
            box-shadow: 0 10px 25px var(--shadow);
            transition: var(--transition-slow);
            border: 1px solid var(--border);
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.9s ease forwards;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px var(--shadow);
            border-color: var(--primary);
        }

        .category-icon {
            width: 74px;
            height: 74px;
            margin: 0 auto 1.25rem;
            border-radius: 24px;
            display: grid;
            place-items: center;
            background: var(--accent-gradient);
            color: white;
            font-size: 1.8rem;
            box-shadow: 0 14px 30px rgba(67, 97, 238, 0.28);
        }

        .category-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 0.5rem;
        }

        .category-desc {
            font-size: 0.95rem;
            color: var(--text-light);
            margin-bottom: 1rem;
        }

        .category-count-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.45rem 0.9rem;
            border-radius: 999px;
            background: rgba(67, 97, 238, 0.1);
            color: var(--primary);
            font-weight: 700;
            font-size: 0.85rem;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
@endpush

<x-blog::layouts.master>
    <section class="hero category-hero">
        <div class="container hero-content">
            <h1 class="hero-title">Explore Categories</h1>
            <p class="hero-subtitle">Browse real topics from your admin dashboard and discover articles by category.</p>
        </div>
    </section>

    <section class="categories-section">
        <div class="container">
            <h2 class="section-title">All Categories</h2>
            <div class="categories-grid">
                @forelse ($categories as $category)
                    <a href="{{ route('blog.category.show', $category->slug) }}" class="category-card">
                        <span class="category-icon"><i class="fas fa-folder-open"></i></span>
                        <h3 class="category-title">{{ $category->name }}</h3>
                        <p class="category-desc">{{ $category->description ?: 'Explore articles, tutorials, and insights in this topic.' }}</p>
                        <span class="category-count-pill">
                            <i class="fas fa-newspaper"></i>
                            {{ $category->articles_count }} {{ Str::plural('Article', $category->articles_count) }}
                        </span>
                    </a>
                @empty
                    <div class="category-card">
                        <span class="category-icon"><i class="fas fa-folder-plus"></i></span>
                        <h3 class="category-title">No categories yet</h3>
                        <p class="category-desc">Create active categories from the Blog admin dashboard and they will appear here.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-blog::layouts.master>
