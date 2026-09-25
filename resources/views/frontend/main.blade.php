@extends('frontend.layouts.master')

@section('title', 'Creavibe | Software Engineering & SaaS Development')
@section('meta_description', 'Creavibe builds scalable SaaS platforms, FinTech software, enterprise applications, and modern web systems. Software engineering by Shaharyar.')
@section('canonical_url', route('home'))
@section('og_title', 'Creavibe | Software Engineering & SaaS Development')
@section('og_description', 'Creavibe builds scalable SaaS platforms, FinTech software, and modern web applications. High-performance software engineering worldwide.')
@section('twitter_title', 'Creavibe | Software Engineering & SaaS Development')
@section('twitter_description', 'Creavibe builds scalable SaaS platforms, FinTech software, and modern web applications.')

@push('head')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@graph": [
        {
            "@@type": "WebSite",
            "name": "Creavibe",
            "url": "{{ route('home') }}",
            "description": "Software Engineering & SaaS Development studio"
        },
        {
            "@@type": "Organization",
            "name": "Creavibe",
            "url": "{{ route('home') }}",
            "logo": "{{ asset('assets/og-image.png') }}",
            "founder": {
                "@@type": "Person",
                "name": "Shaharyar Shafiq"
            },
            "sameAs": [
                "https://github.com/SharryRana",
                "https://www.linkedin.com/in/rana-shaharyar-848620200/",
                "https://x.com/ShaharyarRana12"
            ]
        },
        {
            "@@type": "Person",
            "name": "Shaharyar Shafiq",
            "jobTitle": "Full-Stack Software Engineer",
            "worksFor": {
                "@@type": "Organization",
                "name": "Creavibe"
            },
            "url": "{{ route('about') }}",
            "sameAs": [
                "https://github.com/SharryRana",
                "https://www.linkedin.com/in/rana-shaharyar-848620200/",
                "https://x.com/ShaharyarRana12"
            ]
        }
    ]
}
</script>
@endpush

@section('main-content')
    <main id="main-content">
        {{-- Hero Section --}}
        <section class="hero" id="home" aria-labelledby="home-title">
            <div class="container hero-grid">
                <div class="hero-content">
                    <span class="hero-eyebrow">Creavibe &mdash; Software Engineering &amp; SaaS Development</span>
                    <h1 id="home-title">Build Scalable SaaS &amp; Business Software That Drives Real Growth</h1>
                    <p>Creavibe helps startups, businesses, and enterprises build powerful SaaS platforms, FinTech applications, custom APIs, and backend architectures that scale with confidence.</p>
                    <p class="hero-support">We transform complex software requirements into secure, high-performing digital products with modern engineering practices.</p>
                    <div class="hero-services" aria-label="What Creavibe builds">
                        <span>SaaS Platforms</span>
                        <span>FinTech Systems</span>
                        <span>Backend &amp; APIs</span>
                    </div>
                    <div class="hero-buttons">
                        <a href="{{ route('contact') }}" class="btn">Start Your Project</a>
                        <a href="{{ route('saas.index') }}" class="btn btn-outline">Explore SaaS Products</a>
                    </div>
                </div>
                <div class="hero-visual" aria-hidden="true">
                    <div class="dev-illustration">
                        <div class="code-window">
                            <div class="code-window-header">
                                <span class="dot red"></span>
                                <span class="dot yellow"></span>
                                <span class="dot green"></span>
                            </div>
                            <div class="code-content">
                                <pre id="typed-code"></pre>
                                <span class="cursor"></span>
                            </div>
                        </div>
                        <div class="tech-badges">
                            <div class="chip-row">
                                <span class="chip"><i class="fab fa-golang" aria-hidden="true"></i> Go (Golang)</span>
                                <span class="chip"><i class="fab fa-laravel" aria-hidden="true"></i> Laravel</span>
                                <span class="chip"><i class="fab fa-vuejs" aria-hidden="true"></i> Vue.js</span>
                                <span class="chip"><i class="fab fa-react" aria-hidden="true"></i> React</span>
                                <span class="chip"><i class="fas fa-database" aria-hidden="true"></i> PostgreSQL</span>
                                <span class="chip"><i class="fab fa-docker" aria-hidden="true"></i> Docker</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Floating background elements -->
            <div class="parallax-layer layer-1" aria-hidden="true"></div>
            <div class="parallax-layer layer-2" aria-hidden="true"></div>
            <div class="parallax-layer layer-3" aria-hidden="true"></div>
            <div class="scroll-indicator" aria-hidden="true"></div>
        </section>

        {{-- Key Metrics / Impact Bar --}}
        <section class="stats-bar-section" aria-label="Creavibe key metrics">
            <div class="container">
                <div class="stats-bar-grid">
                    <div class="stat-bar-card">
                        <div class="stat-bar-icon"><i class="fas fa-code-branch" aria-hidden="true"></i></div>
                        <div>
                            <div class="stat-bar-number">5+</div>
                            <div class="stat-bar-label">Years Engineering</div>
                        </div>
                    </div>
                    <div class="stat-bar-card">
                        <div class="stat-bar-icon"><i class="fas fa-layer-group" aria-hidden="true"></i></div>
                        <div>
                            <div class="stat-bar-number">50+</div>
                            <div class="stat-bar-label">Production Deliveries</div>
                        </div>
                    </div>
                    <div class="stat-bar-card">
                        <div class="stat-bar-icon"><i class="fas fa-shield-alt" aria-hidden="true"></i></div>
                        <div>
                            <div class="stat-bar-number">99.9%</div>
                            <div class="stat-bar-label">System Reliability</div>
                        </div>
                    </div>
                    <div class="stat-bar-card">
                        <div class="stat-bar-icon"><i class="fas fa-globe" aria-hidden="true"></i></div>
                        <div>
                            <div class="stat-bar-number">100%</div>
                            <div class="stat-bar-label">Remote Worldwide</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Featured SaaS Products --}}
        @if(($featuredSaasProducts ?? collect())->isNotEmpty())
            <section class="projects" id="saas-products" aria-labelledby="saas-products-title">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                        <div>
                            <span class="hero-eyebrow" style="font-size: .8rem;">Software Products</span>
                            <h2 id="saas-products-title" style="margin-top: 4px;">Featured SaaS Products</h2>
                        </div>
                        <a href="{{ route('saas.index') }}" class="btn btn-outline">View All Products <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                    </div>

                    <div class="projects-grid">
                        @foreach($featuredSaasProducts as $product)
                            <a class="project-card saas-product-card" href="{{ route('saas.show', $product->slug) }}">
                                <div class="project-img">
                                    @if($product->thumbnail)
                                        <img src="{{ asset($product->thumbnail) }}"
                                             alt="{{ $product->thumbnail_alt ?: $product->title }}"
                                             loading="lazy"
                                             decoding="async">
                                    @else
                                        <i class="{{ $product->icon ?: 'fas fa-layer-group' }}" aria-hidden="true"></i>
                                    @endif
                                </div>
                                <div class="project-content">
                                    @if($product->category)
                                        <span class="project-category">{{ $product->category }}</span>
                                    @endif
                                    <h3>{{ $product->title }}</h3>
                                    <p>{{ $product->tagline ?: Str::limit($product->overview, 140) }}</p>
                                    @if(!empty($product->tech_stack))
                                        <div class="project-tags">
                                            @foreach(array_slice($product->tech_stack, 0, 4) as $tag)
                                                <span class="project-tag">{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    <span class="project-card-link">Explore SaaS <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Services Section --}}
        @if(($services ?? collect())->isNotEmpty())
            <section class="skills services-section-bg" id="services" aria-labelledby="services-title">
                <div class="container">
                    <div class="text-center mb-5">
                        <span class="hero-eyebrow" style="font-size: .8rem;">What We Do</span>
                        <h2 id="services-title" style="margin-top: 4px;">Software Engineering Services</h2>
                        <p style="color: var(--gray-light); max-width: 600px; margin: 8px auto 0;">Production-ready engineering services tailored to your digital product goals.</p>
                    </div>

                    <div class="skills-grid">
                        @foreach($services as $service)
                            <div class="skill-card">
                                <div class="skill-icon">
                                    <i class="{{ $service->icon ?: 'fas fa-cogs' }}" aria-hidden="true"></i>
                                </div>
                                <h3>{{ $service->name }}</h3>
                                <p>{{ $service->short_description }}</p>
                                <a href="{{ route('services.show', $service->slug) }}" class="project-card-link" style="margin-top:auto;">Learn More <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Engineering Process Section --}}
        <section class="process-section" id="process" aria-labelledby="process-title">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="hero-eyebrow" style="font-size: .8rem;">Development Workflow</span>
                    <h2 id="process-title" style="margin-top: 4px;">From Idea to High-Performance SaaS</h2>
                    <p style="color: var(--gray-light); max-width: 620px; margin: 8px auto 0;">A disciplined software engineering process designed for reliability, speed, and long-term maintainability.</p>
                </div>

                <div class="process-steps-grid">
                    <div class="process-step-card">
                        <div class="process-step-num">01</div>
                        <div class="process-step-icon"><i class="fas fa-sitemap" aria-hidden="true"></i></div>
                        <h3>Architecture & DB Schema</h3>
                        <p>Detailed database modeling, API domain boundaries, and selecting the optimal tech stack for high scalability.</p>
                    </div>

                    <div class="process-step-card">
                        <div class="process-step-num">02</div>
                        <div class="process-step-icon"><i class="fas fa-code" aria-hidden="true"></i></div>
                        <h3>Agile Full-Stack Build</h3>
                        <p>Clean modular code in Laravel, Go, Vue.js, or React. Incremental sprint releases with regular updates.</p>
                    </div>

                    <div class="process-step-card">
                        <div class="process-step-num">03</div>
                        <div class="process-step-icon"><i class="fas fa-user-shield" aria-hidden="true"></i></div>
                        <h3>Security & Quality Audit</h3>
                        <p>Rigorous test suite execution, rate-limiting, CSRF/XSS sanitization, and query optimization.</p>
                    </div>

                    <div class="process-step-card">
                        <div class="process-step-num">04</div>
                        <div class="process-step-icon"><i class="fas fa-cloud-upload-alt" aria-hidden="true"></i></div>
                        <h3>Deployment & Scaling</h3>
                        <p>Automated CI/CD pipelines, cloud server configuration, logging, health monitoring, and post-launch support.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Case Studies / Featured Projects --}}
        @if(($featuredProjects ?? collect())->isNotEmpty())
            <section class="projects" id="case-studies" aria-labelledby="case-studies-title">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                        <div>
                            <span class="hero-eyebrow" style="font-size: .8rem;">Engineering Work</span>
                            <h2 id="case-studies-title" style="margin-top: 4px;">Project Case Studies</h2>
                        </div>
                        <a href="{{ route('projects.index') }}" class="btn btn-outline">All Case Studies <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                    </div>

                    <div class="projects-grid">
                        @foreach($featuredProjects as $project)
                            <a class="project-card saas-product-card" href="{{ route('projects.show', $project->slug) }}">
                                <div class="project-img">
                                    @if($project->thumbnail)
                                        <img src="{{ asset($project->thumbnail) }}"
                                             alt="{{ $project->thumbnail_alt ?: $project->title }}"
                                             loading="lazy"
                                             decoding="async">
                                    @else
                                        <i class="fas fa-diagram-project" aria-hidden="true"></i>
                                    @endif
                                </div>
                                <div class="project-content">
                                    @if($project->project_type)
                                        <span class="project-category">{{ $project->project_type }}</span>
                                    @endif
                                    <h3>{{ $project->title }}</h3>
                                    <p>{{ $project->summary ?: Str::limit($project->overview, 140) }}</p>
                                    @if(!empty($project->tech_stack))
                                        <div class="project-tags">
                                            @foreach(array_slice($project->tech_stack, 0, 4) as $tag)
                                                <span class="project-tag">{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    <span class="project-card-link">View Case Study <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Technology Stack & Skills --}}
        @if(($skills ?? collect())->isNotEmpty())
            <section class="skills" id="skills" aria-labelledby="skills-title">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                        <div>
                            <span class="hero-eyebrow" style="font-size: .8rem;">Technical Expertise</span>
                            <h2 id="skills-title" style="margin-top: 4px;">Technology Stack</h2>
                        </div>
                        <a href="{{ route('skills') }}" class="btn btn-outline">Full Stack Details <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
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

        {{-- Client Work Capabilities --}}
        @if(($clientWorks ?? collect())->isNotEmpty())
            <section class="clients" id="clients" aria-labelledby="clients-title">
                <div class="container">
                    <h2 class="text-center" id="clients-title">Solutions We Build</h2>

                    <div class="clients-grid">
                        @foreach($clientWorks as $work)
                            <div class="client-card">
                                <div class="client-logo">
                                    @if($work->image)
                                        <img src="{{ asset($work->image) }}" alt="{{ $work->title }}" loading="lazy" decoding="async">
                                    @else
                                        <i class="{{ $work->icon ?: 'fas fa-building' }}" aria-hidden="true"></i>
                                    @endif
                                </div>
                                <h3>{{ $work->title }}</h3>
                                @if($work->category)
                                    <span>{{ $work->category }}</span>
                                @endif
                                @if($work->description)
                                    <p>{{ $work->description }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Testimonials Section --}}
        @if(($testimonials ?? collect())->isNotEmpty())
            <section class="testimonials-section services-section-bg" id="testimonials" aria-labelledby="testimonials-title">
                <div class="container">
                    <div class="section-header-centered">
                        <span class="page-hero-eyebrow">
                            <i class="fas fa-star" style="color: #f59e0b;" aria-hidden="true"></i>&nbsp; Client Endorsements
                        </span>
                        <h2 id="testimonials-title">What Leaders & Founders Say</h2>
                        <p>Direct feedback from startup founders, CTOs, and product directors who partnered with Creavibe to scale their platforms.</p>

                        <div class="testimonial-summary-bar">
                            <div class="t-summary-item">
                                <span class="t-summary-rating">5.0</span>
                                <div class="t-summary-stars" aria-label="5 out of 5 stars">
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                </div>
                                <span class="t-summary-label">Average Client Rating</span>
                            </div>
                            <div class="t-summary-sep" aria-hidden="true"></div>
                            <div class="t-summary-item">
                                <span class="t-summary-stat">100%</span>
                                <span class="t-summary-label">On-Time Delivery</span>
                            </div>
                            <div class="t-summary-sep" aria-hidden="true"></div>
                            <div class="t-summary-item">
                                <span class="t-summary-stat">50+</span>
                                <span class="t-summary-label">Deliveries Completed</span>
                            </div>
                        </div>
                    </div>

                    <div class="testimonials-grid">
                        @foreach($testimonials as $item)
                            <div class="testimonial-card">
                                <div class="testimonial-top">
                                    <div class="testimonial-rating-row">
                                        <div class="testimonial-stars" aria-label="{{ $item->rating }} out of 5 stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= $item->rating ? '' : '-o' }}" aria-hidden="true"></i>
                                            @endfor
                                        </div>
                                        <span class="testimonial-rating-tag">{{ number_format($item->rating, 1) }}</span>
                                    </div>
                                    @if($item->project_title)
                                        <span class="testimonial-project-pill" title="Project: {{ $item->project_title }}">
                                            <i class="fas fa-layer-group" aria-hidden="true"></i> {{ $item->project_title }}
                                        </span>
                                    @else
                                        <div class="testimonial-quote-badge" aria-hidden="true">
                                            <i class="fas fa-quote-right"></i>
                                        </div>
                                    @endif
                                </div>

                                <blockquote class="testimonial-text">
                                    {{ $item->review }}
                                </blockquote>

                                <div class="testimonial-client">
                                    <div class="testimonial-avatar-wrap">
                                        @if($item->client_avatar)
                                            <img src="{{ asset($item->client_avatar) }}" alt="{{ $item->client_name }}" class="testimonial-avatar" loading="lazy">
                                        @else
                                            <div class="testimonial-avatar-fallback" aria-hidden="true">
                                                {{ Str::substr($item->client_name, 0, 1) }}
                                            </div>
                                        @endif
                                        <span class="testimonial-verified-check" title="Verified Client" aria-hidden="true">
                                            <i class="fas fa-check"></i>
                                        </span>
                                    </div>
                                    <div class="testimonial-client-meta">
                                        <div class="testimonial-name-row">
                                            <span class="testimonial-name">{{ $item->client_name }}</span>
                                            <span class="testimonial-verified-badge"><i class="fas fa-shield-halved" aria-hidden="true"></i> Verified</span>
                                        </div>
                                        <div class="testimonial-role">
                                            <span>{{ $item->client_title }}</span>
                                            @if($item->company_name)
                                                <span class="testimonial-company-sep">&bull;</span>
                                                <span class="testimonial-company">{{ $item->company_name }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Dynamic Blog Section --}}
        @if(($latestArticles ?? collect())->isNotEmpty())
            <section class="blog" id="blog" aria-labelledby="blog-title">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                        <div>
                            <span class="hero-eyebrow" style="font-size: .8rem;">Technical Content</span>
                            <h2 id="blog-title" style="margin-top: 4px;">Latest Articles</h2>
                        </div>
                        <a href="{{ route('blog.index') }}" class="btn btn-outline">Visit Blog <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                    </div>

                    <div class="blog-grid">
                        @foreach($latestArticles as $article)
                            <div class="blog-card">
                                <div class="blog-img">
                                    @if(!empty($article->featured_image))
                                        <img src="{{ asset($article->featured_image) }}" alt="{{ $article->title }}" loading="lazy" decoding="async" style="width:100%;height:100%;object-fit:cover;">
                                    @else
                                        <i class="fas fa-newspaper" aria-hidden="true"></i>
                                    @endif
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <span><i class="far fa-calendar" aria-hidden="true"></i> {{ $article->published_at ? $article->published_at->format('M d, Y') : '' }}</span>
                                    </div>
                                    <h3>{{ $article->title }}</h3>
                                    <p>{{ Str::limit(strip_tags($article->summary ?: $article->content), 120) }}</p>
                                    <a href="{{ route('blog.show', $article->slug) }}" class="btn btn-outline">Read Article</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Contact Section --}}
        <section class="contact" id="contact" aria-labelledby="contact-title">
            <div class="container">
                <h2 class="text-center" id="contact-title">Get In Touch</h2>

                <div class="contact-container">
                    <div class="contact-info">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                            </div>
                            <div>
                                <h3>Location</h3>
                                <p>Remote Worldwide</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope" aria-hidden="true"></i>
                            </div>
                            <div>
                                <h3>Email</h3>
                                <p><a href="mailto:ranashaharyar625@gmail.com" class="contact-link">ranashaharyar625@gmail.com</a></p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone" aria-hidden="true"></i>
                            </div>
                            <div>
                                <h3>Phone</h3>
                                <p><a href="tel:+923057362625" class="contact-link">+92 (305) 7362625</a></p>
                                <p><a href="tel:+923359493868" class="contact-link">+92 (335) 9493868</a></p>
                            </div>
                        </div>

                        <div class="social-links">
                            <a href="https://x.com/ShaharyarRana12" aria-label="Twitter / X" rel="noopener noreferrer" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                            <a href="https://www.linkedin.com/in/rana-shaharyar-848620200/" aria-label="LinkedIn" rel="noopener noreferrer" target="_blank"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a>
                            <a href="https://github.com/SharryRana" aria-label="GitHub" rel="noopener noreferrer" target="_blank"><i class="fab fa-github" aria-hidden="true"></i></a>
                        </div>
                    </div>

                    <div class="contact-form">
                        <form action="{{ route('contact.submit') }}" id="contactForm" method="POST" autocomplete="on" novalidate>
                            @csrf
                            <div class="form-group">
                                <label for="name">Your Name <span aria-hidden="true">*</span></label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="John Smith">
                            </div>

                            <div class="form-group">
                                <label for="email">Your Email <span aria-hidden="true">*</span></label>
                                <input type="email" id="email" name="email" class="form-control" autocomplete="email" placeholder="john@company.com">
                            </div>

                            <div class="form-group">
                                <label for="subject">Subject <span aria-hidden="true">*</span></label>
                                <input type="text" id="subject" name="subject" class="form-control" placeholder="SaaS Project Enquiry">
                            </div>

                            <div class="form-group">
                                <label for="message">Your Message <span aria-hidden="true">*</span></label>
                                <textarea id="message" name="message" class="form-control" rows="5" placeholder="Describe your software project..."></textarea>
                            </div>

                            <button type="submit" class="btn">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
