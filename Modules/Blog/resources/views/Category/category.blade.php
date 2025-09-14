@push('styles')
    <style>
        /* Category Hero */
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
            background: radial-gradient(circle, rgba(255,255,255,0.15) 20%, transparent 70%);
            animation: rotateBg 15s linear infinite;
        }

        @keyframes rotateBg {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Categories Section */
        .categories-section {
            margin-bottom: 4rem;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
        }

        .category-card {
            background: rgba(255,255,255,0.08);
            border-radius: var(--border-radius);
            text-align: center;
            padding: 2rem 1.5rem;
            box-shadow: 0 10px 25px var(--shadow);
            transition: var(--transition-slow);
            position: relative;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.2);
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.9s ease forwards;
        }

        .category-card:hover {
            transform: translateY(-12px) scale(1.05);
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            border-color: var(--primary);
        }

        .category-image {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 1rem;
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
        }

        /* Load More Button */
        .load-more-btn {
            display: inline-block;
            margin: 3rem auto 0;
            padding: 14px 32px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            background: linear-gradient(135deg, #ff416c, #ff4b2b, #ff6a00);
            color: #fff;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .load-more-btn:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }

        .load-more-btn::before {
            content: "";
            position: absolute;
            top: 0; left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.3);
            transition: left 0.4s ease;
        }

        .load-more-btn:hover::before {
            left: 100%;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
@endpush


<x-blog::layouts.master>
    <!-- Hero Section -->
    <section class="hero category-hero">
        <div class="container hero-content">
            <h1 class="hero-title">Explore Categories</h1>
            <p class="hero-subtitle">Browse through different topics to find stories, tutorials, and insights you love.</p>
        </div>
    </section>

    <!-- Categories Grid -->
    <section class="categories-section">
        <div class="container">
            <h2 class="section-title">All Categories</h2>
            <div class="categories-grid">
                <!-- Category Card -->
                <a href="#" class="category-card">
                    <img src="https://picsum.photos/400/200?random=1" alt="Web Design" loading="lazy" class="category-image">
                    <h3 class="category-title">Web Design</h3>
                    <p class="category-desc">12 Articles</p>
                </a>

                <a href="#" class="category-card">
                    <img src="https://picsum.photos/400/200?random=2" alt="Development" loading="lazy" class="category-image">
                    <h3 class="category-title">Development</h3>
                    <p class="category-desc">24 Articles</p>
                </a>

                <a href="#" class="category-card">
                    <img src="https://picsum.photos/400/200?random=3" alt="UX / UI" loading="lazy" class="category-image">
                    <h3 class="category-title">UX / UI</h3>
                    <p class="category-desc">8 Articles</p>
                </a>

                <a href="#" class="category-card">
                    <img src="https://picsum.photos/400/200?random=4" alt="JavaScript" loading="lazy" class="category-image">
                    <h3 class="category-title">JavaScript</h3>
                    <p class="category-desc">16 Articles</p>
                </a>

                <a href="#" class="category-card">
                    <img src="https://picsum.photos/400/200?random=5" alt="Productivity" loading="lazy" class="category-image">
                    <h3 class="category-title">Productivity</h3>
                    <p class="category-desc">7 Articles</p>
                </a>

                <a href="#" class="category-card">
                    <img src="https://picsum.photos/400/200?random=6" alt="Tools" loading="lazy" class="category-image">
                    <h3 class="category-title">Tools</h3>
                    <p class="category-desc">11 Articles</p>
                </a>

                <a href="#" class="category-card">
                    <img src="https://picsum.photos/400/200?random=7" alt="Tutorials" loading="lazy" class="category-image">
                    <h3 class="category-title">Tutorials</h3>
                    <p class="category-desc">19 Articles</p>
                </a>
            </div>

            <!-- Load More Button -->
            <div class="text-center">
                <button class="load-more-btn">Load More Categories</button>
            </div>
        </div>
    </section>
</x-blog::layouts.master>
