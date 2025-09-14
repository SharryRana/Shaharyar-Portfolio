@push('styles')
    <style>
        /* Fade-in animation */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up {
            opacity: 0;
            animation: fadeUp 1s ease forwards;
        }

        /* Hero Section */
        .about-hero {
            padding: 6rem 1rem;
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
            background: radial-gradient(circle, rgba(255,255,255,0.15) 20%, transparent 70%);
            animation: rotateBg 20s linear infinite;
        }

        /* About Content */
        .about-section {
            margin-bottom: 6rem;
            display: flex;
            align-items: center;
            gap: 3rem;
            flex-wrap: wrap;
        }

        .about-text {
            flex: 1 1 500px;
            animation-delay: 0.3s;
        }

        .about-text h2 {
            font-size: 2.3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text);
        }

        .about-text p {
            font-size: 1.05rem;
            color: var(--text-light);
            line-height: 1.7;
            margin-bottom: 1rem;
        }

        .about-img {
            flex: 1 1 400px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            transform: scale(1);
            transition: transform 0.5s ease;
            animation-delay: 0.6s;
        }

        .about-img:hover {
            transform: scale(1.05);
        }

        .about-img img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Mission / Vision Cards */
        .mission-vision {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin: 6rem 0;
        }

        .mv-card {
            background: rgba(255,255,255,0.08);
            padding: 2.5rem;
            border-radius: var(--border-radius);
            box-shadow: 0 10px 25px var(--shadow);
            text-align: center;
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.15);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .mv-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 45px rgba(0,0,0,0.25);
        }

        .mv-card h3 {
            font-size: 1.7rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text);
        }

        .mv-card p {
            font-size: 1rem;
            color: var(--text-light);
            line-height: 1.7;
        }

        /* Team Section */
        .team-section {
            margin-bottom: 6rem;
        }

        .team-section h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 3rem;
            color: var(--text);
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2.5rem;
        }

        .team-card {
            background: rgba(255,255,255,0.08);
            border-radius: var(--border-radius);
            text-align: center;
            padding: 2.5rem 1.5rem;
            box-shadow: 0 10px 25px var(--shadow);
            border: 1px solid rgba(255,255,255,0.15);
            transition: 0.4s ease;
            animation-delay: 0.3s;
        }

        .team-card:hover {
            transform: translateY(-12px) scale(1.03);
            box-shadow: 0 25px 45px rgba(0,0,0,0.25);
        }

        .team-card img {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 1rem;
            border: 3px solid var(--primary);
            transition: transform 0.4s ease;
        }

        .team-card:hover img {
            transform: scale(1.1);
        }

        .team-card h4 {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 0.5rem;
        }

        .team-card p {
            font-size: 1rem;
            color: var(--text-light);
        }
    </style>
@endpush

<x-blog::layouts.master>
    <!-- Hero Section -->
    <section class="hero about-hero fade-up">
        <div class="container hero-content">
            <h1 class="hero-title">About Us</h1>
            <p class="hero-subtitle">Discover who we are, what drives us, and our vision for blogging.</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section container">
        <div class="about-text fade-up">
            <h2>Who We Are</h2>
            <p>We are a passionate blogging community dedicated to sharing stories, tutorials, and knowledge with the world. Our goal is to provide a platform where readers can discover valuable insights and writers can express their creativity.</p>
            <p>From tech enthusiasts to lifestyle writers, our blog covers diverse categories, making it a hub for learning and inspiration.</p>
        </div>
        <div class="about-img fade-up">
            <img src="https://source.unsplash.com/600x400/?team,blog" alt="About Us" loading="lazy">
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="container mission-vision">
        <div class="mv-card fade-up">
            <h3>Our Mission</h3>
            <p>To empower readers and writers by providing engaging content, insightful resources, and a platform for free expression.</p>
        </div>
        <div class="mv-card fade-up">
            <h3>Our Vision</h3>
            <p>To become one of the most trusted and diverse blogging platforms, inspiring millions across the globe.</p>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section container fade-up">
        <h2 class="section-title text-center">Meet Our Team</h2>
        <div class="team-grid">
            <div class="team-card fade-up">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Ali Khan" loading="lazy">
                <h4>Ali Khan</h4>
                <p>Founder & Editor</p>
            </div>
            <div class="team-card fade-up">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sara Ahmed" loading="lazy">
                <h4>Sara Ahmed</h4>
                <p>Content Strategist</p>
            </div>
            <div class="team-card fade-up">
                <img src="https://randomuser.me/api/portraits/men/65.jpg" alt="Ahmed Raza" loading="lazy">
                <h4>Ahmed Raza</h4>
                <p>Lead Developer</p>
            </div>
            <div class="team-card fade-up">
                <img src="https://randomuser.me/api/portraits/women/21.jpg" alt="Fatima Noor" loading="lazy">
                <h4>Fatima Noor</h4>
                <p>Community Manager</p>
            </div>
        </div>
    </section>
</x-blog::layouts.master>
