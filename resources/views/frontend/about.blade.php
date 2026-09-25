@extends('frontend.layouts.master')

@section('title', 'About Shaharyar Shafiq | Founder & Lead Software Engineer at Creavibe')
@section('meta_description', 'Meet Shaharyar Shafiq Full-Stack Software Engineer and Founder of Creavibe. 5+ years building scalable SaaS platforms, FinTech software, and high-performance backend systems.')
@section('canonical_url', route('about'))
@section('og_title', 'About Shaharyar Shafiq | Founder & Lead Software Engineer at Creavibe')
@section('og_description', 'Meet Shaharyar Shafiq Full-Stack Software Engineer and Founder of Creavibe. 5+ years building scalable SaaS platforms, FinTech software, and modern web applications.')
@section('twitter_title', 'About Shaharyar Shafiq | Founder & Lead Software Engineer at Creavibe')
@section('twitter_description', 'Meet Shaharyar Shafiq Full-Stack Software Engineer and Founder of Creavibe.')

@push('head')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@graph": [
        {
            "@@type": "Person",
            "name": "Shaharyar Shafiq",
            "jobTitle": "Founder & Lead Software Engineer",
            "worksFor": {
                "@@type": "Organization",
                "name": "Creavibe"
            },
            "url": "{{ route('about') }}",
            "email": "ranashaharyar625@gmail.com",
            "sameAs": [
                "https://github.com/SharryRana",
                "https://www.linkedin.com/in/rana-shaharyar-848620200/",
                "https://x.com/ShaharyarRana12"
            ],
            "knowsAbout": [
                "Go (Golang)",
                "Laravel",
                "PostgreSQL",
                "Vue.js",
                "React",
                "Node.js",
                "SaaS Architecture",
                "FinTech Systems",
                "API Development",
                "System Design"
            ]
        },
        {
            "@@type": "Organization",
            "name": "Creavibe",
            "url": "{{ route('home') }}",
            "founder": {
                "@@type": "Person",
                "name": "Shaharyar Shafiq"
            },
            "description": "Software engineering studio specializing in SaaS development, FinTech software, and modern web applications."
        }
    ]
}
</script>
@endpush

@section('main-content')
<main id="main-content">
    @include('frontend.partials.breadcrumb', ['crumbs' => [
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'About Shaharyar Shafiq']
    ]])

    {{-- Page Hero --}}
    <section class="page-hero" aria-labelledby="about-heading">
        <div class="container">
            <span class="page-hero-eyebrow">Founder &amp; Lead Software Engineer</span>
            <h1 id="about-heading">Shaharyar Shafiq</h1>
            <p class="lead">Architecting scalable SaaS platforms, high-performance backends, and modern software systems at Creavibe.</p>
        </div>
    </section>

    {{-- Founder Bio & Story Grid --}}
    <section class="page-section" aria-label="Shaharyar Shafiq biography">
        <div class="container">
            <div class="about-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 40px; align-items: start;">
                <div class="about-text">
                    <div>
                        <span class="about-hero-badge">Engineering Background</span>
                    </div>
                    <h2 style="font-size: clamp(1.6rem, 3vw, 2.2rem); font-weight: 700; margin-bottom: 18px; color: var(--light);">Hi, I'm Shaharyar Shafiq.</h2>

                    <p class="about-intro-text">I am a full-stack software engineer and the founder of <strong>Creavibe</strong>. With over 5 years of hands-on experience in software engineering, I specialize in building complex, production-grade applications that scale seamlessly under load.</p>

                    <p class="about-intro-text">My technical focus centers around backend systems built with <strong>Go (Golang)</strong> and <strong>Laravel</strong>, resilient database architecture using <strong>PostgreSQL</strong>, and modern frontend interfaces crafted with <strong>Vue.js</strong> and <strong>React</strong>.</p>

                    <p class="about-intro-text">Over the past five years, I have architected and delivered multi-tenant SaaS applications, FinTech transaction engines, business automation systems, custom RESTful APIs, and administrative control centers for clients worldwide.</p>

                    <ul class="about-highlights-list">
                        <li><i class="fas fa-check-circle" aria-hidden="true"></i> Architected 50+ production systems with 99.9% uptime reliability.</li>
                        <li><i class="fas fa-check-circle" aria-hidden="true"></i> Specialized in microservices, REST APIs, and database performance tuning.</li>
                        <li><i class="fas fa-check-circle" aria-hidden="true"></i> Full lifecycle engineering ownership from initial schema to cloud deployment.</li>
                    </ul>

                    <div class="about-ctas" style="display: flex; gap: 14px; flex-wrap: wrap; margin-top: 24px;">
                        <a href="{{ route('contact') }}" class="btn">Get in Touch</a>
                        <a href="{{ route('saas.index') }}" class="btn btn-outline">Explore SaaS Products</a>
                        <a href="{{ route('projects.index') }}" class="btn btn-outline">View Case Studies</a>
                    </div>
                </div>

                <div class="about-card-widget">
                    <div class="about-profile-header">
                        <div class="about-avatar-badge">SS</div>
                        <div>
                            <h3 style="font-size: 1.15rem; font-weight: 700; margin: 0; color: var(--light);">Shaharyar Shafiq</h3>
                            <span style="font-size: 0.85rem; color: var(--primary); font-weight: 600;">Founder &amp; Lead Engineer</span>
                        </div>
                    </div>

                    <div class="about-stats" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; margin-bottom: 24px;">
                        <div class="stat-card" style="background: rgba(34, 211, 238, 0.05); border: 1px solid var(--card-border); padding: 18px; border-radius: 12px; text-align: center;">
                            <span class="stat-number" style="font-size: 1.8rem; font-weight: 700; color: var(--primary); display: block; line-height: 1;">5+</span>
                            <span class="stat-label" style="font-size: 0.8rem; color: var(--gray-light); margin-top: 4px; display: block;">Years Exp.</span>
                        </div>
                        <div class="stat-card" style="background: rgba(34, 211, 238, 0.05); border: 1px solid var(--card-border); padding: 18px; border-radius: 12px; text-align: center;">
                            <span class="stat-number" style="font-size: 1.8rem; font-weight: 700; color: var(--secondary); display: block; line-height: 1;">50+</span>
                            <span class="stat-label" style="font-size: 0.8rem; color: var(--gray-light); margin-top: 4px; display: block;">Deliveries</span>
                        </div>
                        <div class="stat-card" style="background: rgba(34, 211, 238, 0.05); border: 1px solid var(--card-border); padding: 18px; border-radius: 12px; text-align: center;">
                            <span class="stat-number" style="font-size: 1.8rem; font-weight: 700; color: var(--primary); display: block; line-height: 1;">10+</span>
                            <span class="stat-label" style="font-size: 0.8rem; color: var(--gray-light); margin-top: 4px; display: block;">Stack Tools</span>
                        </div>
                        <div class="stat-card" style="background: rgba(34, 211, 238, 0.05); border: 1px solid var(--card-border); padding: 18px; border-radius: 12px; text-align: center;">
                            <span class="stat-number" style="font-size: 1.8rem; font-weight: 700; color: var(--secondary); display: block; line-height: 1;">100%</span>
                            <span class="stat-label" style="font-size: 0.8rem; color: var(--gray-light); margin-top: 4px; display: block;">Worldwide</span>
                        </div>
                    </div>

                    <h4 style="font-size: 0.95rem; font-weight: 700; margin-bottom: 14px; color: var(--light); display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-address-card" aria-hidden="true" style="color:var(--primary);"></i> Direct Contact
                    </h4>

                    <ul class="about-contact-list">
                        <li class="about-contact-item">
                            <i class="fas fa-envelope" aria-hidden="true"></i>
                            <a href="mailto:ranashaharyar625@gmail.com">ranashaharyar625@gmail.com</a>
                        </li>
                        <li class="about-contact-item">
                            <i class="fas fa-phone" aria-hidden="true"></i>
                            <a href="tel:+923057362625">+92 (305) 7362625</a>
                        </li>
                        <li class="about-contact-item">
                            <i class="fab fa-github" aria-hidden="true"></i>
                            <a href="https://github.com/SharryRana" target="_blank" rel="noopener noreferrer">github.com/SharryRana</a>
                        </li>
                        <li class="about-contact-item">
                            <i class="fab fa-linkedin" aria-hidden="true"></i>
                            <a href="https://www.linkedin.com/in/rana-shaharyar-848620200/" target="_blank" rel="noopener noreferrer">LinkedIn Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Engineering Principles Section --}}
    <section class="page-section services-section-bg" aria-labelledby="principles-heading">
        <div class="container">
            <div class="text-center mb-5">
                <div>
                    <span class="about-hero-badge">Engineering Standards</span>
                </div>
                <h2 id="principles-heading" style="margin-top: 4px;">Core Technical Principles</h2>
                <p style="color: var(--gray-light); max-width: 600px; margin: 8px auto 0;">How Shaharyar Shafiq approaches software engineering at Creavibe.</p>
            </div>

            <div class="skills-grid">
                <div class="skill-card">
                    <div class="skill-icon"><i class="fas fa-code-branch" aria-hidden="true"></i></div>
                    <h3>Clean &amp; Maintainable Architecture</h3>
                    <p>Writing modular, self-documenting code following SOLID principles, domain-driven design, and structured design patterns so your codebase stays easy to extend.</p>
                </div>
                <div class="skill-card">
                    <div class="skill-icon"><i class="fas fa-tachometer-alt" aria-hidden="true"></i></div>
                    <h3>High Performance &amp; Scalability</h3>
                    <p>Leveraging Go for concurrent high-throughput services and Laravel for structured backends, backed by PostgreSQL query optimization and Redis caching strategies.</p>
                </div>
                <div class="skill-card">
                    <div class="skill-icon"><i class="fas fa-shield-alt" aria-hidden="true"></i></div>
                    <h3>Security &amp; Data Integrity</h3>
                    <p>Implementing rigorous authentication (OAuth2, JWT, Sanctum), strict input validation, transaction isolation, and compliance-ready data handling.</p>
                </div>
                <div class="skill-card">
                    <div class="skill-icon"><i class="fas fa-rocket" aria-hidden="true"></i></div>
                    <h3>Product-Driven Execution</h3>
                    <p>Combining technical execution with product intuition to turn business requirements into fast, intuitive, and reliable digital products.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Technical Expertise Stack --}}
    @if(($skills ?? collect())->isNotEmpty())
    <section class="page-section" aria-labelledby="tech-heading">
        <div class="container">
            <div class="text-center mb-5">
                <div>
                    <span class="about-hero-badge">Technology Stack</span>
                </div>
                <h2 id="tech-heading" style="margin-top: 4px;">Tools &amp; Technologies</h2>
                <p style="color: var(--gray-light); max-width: 600px; margin: 8px auto 0;">The modern tech stack used to build production applications at Creavibe.</p>
            </div>

            <div class="skills-grid">
                @foreach($skills->take(8) as $skill)
                    <div class="skill-card">
                        <div class="skill-icon">
                            <i class="{{ $skill->icon ?: 'fas fa-code' }}" aria-hidden="true"></i>
                        </div>
                        @if($skill->label)
                            <span class="skill-label">{{ $skill->label }}</span>
                        @endif
                        <h3>{{ $skill->title }}</h3>
                        <p>{{ $skill->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Call to Action --}}
    <section class="page-section saas-final-cta" aria-label="Contact CTA">
        <div class="container text-center">
            <h2>Have a project or SaaS idea?</h2>
            <p>Work directly with Shaharyar Shafiq to build your next digital product.</p>
            <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; margin-top: 20px;">
                <a href="{{ route('contact') }}" class="btn">Start a Conversation</a>
                <a href="{{ route('services.index') }}" class="btn btn-outline">Explore Services</a>
            </div>
        </div>
    </section>
</main>
@endsection
