@push('styles')
    <style>
        /* Hero Section */
        .features-hero {
            padding: 5rem 0;
            background: var(--accent-gradient);
            color: white;
            text-align: center;
            border-radius: 0 0 40px 40px;
            margin-bottom: 4rem;
            position: relative;
            overflow: hidden;
        }

        .features-hero::after {
            content: "";
            position: absolute;
            width: 200%;
            height: 200%;
            top: -50%;
            left: -50%;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 20%, transparent 70%);
            animation: rotateBg 15s linear infinite;
        }

        /* Features Grid */
        .features-section {
            margin-bottom: 5rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: rgba(255,255,255,0.08);
            border-radius: var(--border-radius);
            padding: 2.5rem 2rem;
            text-align: center;
            transition: var(--transition-slow);
            box-shadow: 0 10px 25px var(--shadow);
            border: 1px solid rgba(255,255,255,0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.9s ease forwards;
        }

        .feature-card:hover {
            transform: translateY(-12px) scale(1.04);
            box-shadow: 0 25px 50px rgba(0,0,0,0.25);
            border-color: var(--primary);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            border-radius: 50%;
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .feature-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 0.7rem;
        }

        .feature-desc {
            font-size: 0.98rem;
            color: var(--text-light);
            line-height: 1.6;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* CTA Section */
        .cta-section {
            text-align: center;
            padding: 4rem 2rem;
            background: linear-gradient(135deg, #ff416c, #ff4b2b, #ff6a00);
            border-radius: 20px;
            color: #fff;
            margin-bottom: 5rem;
        }

        .cta-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .cta-btn {
            margin-top: 1.5rem;
            padding: 14px 32px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            background: #fff;
            color: #ff416c;
            transition: all 0.3s ease;
        }

        .cta-btn:hover {
            background: #ffe1eb;
            transform: translateY(-3px);
        }
    </style>
@endpush

<x-blog::layouts.master>
    <!-- Hero Section -->
    <section class="hero features-hero">
        <div class="container hero-content">
            <h1 class="hero-title">Features of Our Blog</h1>
            <p class="hero-subtitle">Discover what makes our blogging platform powerful, engaging, and easy to use.</p>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <h2 class="section-title text-center">What We Offer</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-layer-group"></i></div>
                    <h3 class="feature-title">Organized Categories</h3>
                    <p class="feature-desc">Browse content effortlessly with well-structured categories and tags that make discovery easier.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-search"></i></div>
                    <h3 class="feature-title">Smart Search</h3>
                    <p class="feature-desc">Quickly find the articles you need using our powerful search functionality.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-pencil-alt"></i></div>
                    <h3 class="feature-title">Easy Writing Tools</h3>
                    <p class="feature-desc">Publish blogs with a distraction free editor designed for writers.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-comments"></i></div>
                    <h3 class="feature-title">Engaging Comments</h3>
                    <p class="feature-desc">Readers can share their thoughts and engage with your posts through a modern comment system.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-bell"></i></div>
                    <h3 class="feature-title">Email Notifications</h3>
                    <p class="feature-desc">Stay updated with instant alerts when new blogs are published in your favorite categories.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                    <h3 class="feature-title">Reader Analytics</h3>
                    <p class="feature-desc">Track views, likes, and reader engagement to understand your audience better.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section container">
        <h2 class="cta-title">Ready to Start Reading & Writing?</h2>
        <p>Join our blogging community and share your voice with the world.</p>
        <button class="cta-btn">Get Started</button>
    </section>
</x-blog::layouts.master>
