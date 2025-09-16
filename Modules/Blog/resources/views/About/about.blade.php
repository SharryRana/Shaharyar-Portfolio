@push('styles')
    <style>
        /* Hero */
        .about-hero {
            padding: 5rem 0;
            background: var(--accent-gradient);
            color: white;
            text-align: center;
            border-radius: 0 0 40px 40px;
            margin-bottom: 4rem;
            position: relative;
            overflow: hidden;
        }

        .about-hero::after {
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
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Generic sections */
        .about-section {
            padding: 4rem 0;
        }

        .about-section h2 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 2rem;
        }

        .about-section p {
            max-width: 800px;
            margin: 0 auto 1.5rem;
            line-height: 1.8;
        }

        /* Grid (team / values) */
        .about-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
        }

        .about-card {
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.06);
            text-align: center;
            animation: fadeInUp 1s ease forwards;
        }

        .about-card img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 1rem;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush

<x-blog::layouts.master>
    <!-- Hero Section -->
    <section class="hero about-hero">
        <div class="container hero-content">
            <h1 class="hero-title">About Us</h1>
            <p class="hero-subtitle">Discover who we are, what drives us, and our vision for the future.</p>
        </div>
    </section>

    <!-- Our Story -->
    <section class="about-section">
        <div class="container">
            <h2>Our Story</h2>
            <p>
                We started our blogging journey with a simple idea: to create a space where people can discover
                authentic stories, practical tips, and creative inspiration. Over the years, our team has grown
                into a vibrant community of writers, designers, and thinkers passionate about making a difference.
            </p>
            <p>
                From humble beginnings to a recognized platform, we continue to innovate and adapt, always keeping
                our readers at the heart of what we do.
            </p>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="about-section">
        <div class="container">
            <h2>Our Mission & Vision</h2>

            <p>
                <strong>Mission:</strong> Empower individuals through meaningful content and build a community of
                lifelong learners.
                We strive to create a platform that educates, informs, and inspires our audience to grow personally and
                professionally.
                By delivering well-researched and easy-to-understand resources, we aim to bridge knowledge gaps and
                ignite curiosity in every visitor.
            </p>

            <p>
                <strong>Vision:</strong> To become a go-to destination for insightful, trustworthy, and inspiring
                articles worldwide.
                Our vision is to foster an inclusive digital space where people from diverse backgrounds can exchange
                ideas, share stories, and gain valuable perspectives.
                We aspire to be recognized not only as an information hub but also as a catalyst for positive change and
                innovation.
            </p>
            <p>
                <strong>What We Do:</strong> We bring together expert writers, researchers, and industry leaders to produce high-impact articles,
                guides, and resources.
                Whether you’re looking to develop new skills, stay updated on trends, or simply explore new ideas, our
                platform offers a rich library designed to help you grow.
            </p>
        </div>
    </section>


    <!-- Core Values -->
    <section class="about-section">
        <div class="container">
            <h2>Our Core Values</h2>
            <div class="about-grid">
                <div class="about-card">
                    <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?crop=faces&fit=crop&w=80&h=80" alt="Value 1">
                    <h3>Integrity</h3>
                    <p>We believe in honesty and transparency in every piece of content we publish.</p>
                </div>
                <div class="about-card">
                    <img src="https://images.unsplash.com/photo-1607746882042-944635dfe10e?crop=faces&fit=crop&w=80&h=80" alt="Value 2">
                    <h3>Creativity</h3>
                    <p>We encourage innovative thinking to deliver fresh and engaging ideas.</p>
                </div>
                <div class="about-card">
                    <img src="https://images.unsplash.com/photo-1554151228-14d9def656e4?crop=faces&fit=crop&w=80&h=80" alt="Value 3">
                    <h3>Community</h3>
                    <p>We foster a supportive environment where everyone’s voice matters.</p>
                </div>
                <div class="about-card">
                    <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?crop=faces&fit=crop&w=80&h=80" alt="Value 2">
                    <h3>Creativity</h3>
                    <p>We encourage innovative thinking to deliver fresh and engaging ideas.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Meet the Team -->
    <section class="about-section">
        <div class="container">
            <h2>Meet the Team</h2>
            <div class="about-grid">
                <div class="about-card">
                    <img src="https://images.unsplash.com/photo-1544723795-3fb6469f5b39?crop=faces&fit=crop&w=200&h=200" alt="Team Member">
                    <h3>John Smith</h3>
                    <p>Lead Designer</p>
                </div>
                <div class="about-card">
                    <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?crop=faces&fit=crop&w=200&h=200" alt="Team Member">
                    <h3>Mary Johnson</h3>
                    <p>Community Manager</p>
                </div>
                <div class="about-card">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?crop=faces&fit=crop&w=200&h=200" alt="Team Member">
                    <h3>Jane Doe</h3>
                    <p>Founder & Editor-in-Chief</p>
                </div>
                <div class="about-card">
                    <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?crop=faces&fit=crop&w=200&h=200" alt="Team Member">
                    <h3>John Smith</h3>
                    <p>Lead Designer</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="about-section">
        <div class="container" style="text-align:center;">
            <h2>Join Our Journey</h2>
            <p>Be part of our growing community. Follow us, contribute your stories, and help shape the future of our
                platform.</p>
        </div>
    </section>
</x-blog::layouts.master>
