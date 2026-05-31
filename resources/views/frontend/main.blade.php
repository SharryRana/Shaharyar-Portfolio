@extends('frontend.layouts.master')
@section('main-content')
    <main id="main-content">
        <section class="hero" id="home" aria-labelledby="home-title">
            <div class="container hero-grid">
                <div class="hero-content">
                    <span class="hero-eyebrow">Creavibe Software Agency</span>
                    <h1 id="home-title">Build Scalable SaaS & Business Software That Drives Real Growth</h1>
                    <p>We help startups, agencies, and enterprises build powerful SaaS platforms, business management
                        systems, fintech applications, and automation software that scale with confidence.</p>
                    <p class="hero-support">We transform complex business ideas into secure, high-performing digital
                        products with premium UI/UX.</p>
                    <div class="hero-services" aria-label="What Creavibe builds">
                        <span>Fintech Software</span>
                        <span>CRM & ERP Platforms</span>
                        <span>Enterprise Dashboards</span>
                    </div>
                    <div class="hero-buttons">
                        <a href="#contact" class="btn">Start Your Project</a>
                        <a href="#projects" class="btn btn-outline">View Our Work</a>
                        {{-- <a href="#contact" class="btn btn-outline">Schedule a Consultation</a> --}}
                    </div>
                    {{-- <div class="hero-trust-stack" aria-label="Trusted technology stack">
                        Laravel &bull; Golang &bull; PostgreSQL &bull; Vue.js &bull; React.js &bull; Node.js &bull; AWS
                        &bull; Docker
                    </div> --}}
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
                        <div class="stack-icons">
                            <span class="stack-icon" title="Laravel"><i class="fab fa-laravel"></i></span>
                            <span class="stack-icon" title="Vue.js"><i class="fab fa-vuejs"></i></span>
                            <span class="stack-icon" title="React"><i class="fab fa-react"></i></span>
                            <span class="stack-icon" title="Node.js"><i class="fab fa-node-js"></i></span>
                            <span class="stack-icon" title="Django"><i class="fas fa-leaf"></i></span>
                            <span class="stack-icon" title="Golang"><i class="fas fa-code"></i></span>
                            <span class="stack-icon" title="PostgreSQL"><i class="fas fa-database"></i></span>
                        </div>
                    </div>
                    <div class="tech-badges">
                        <div class="chip-row">
                            <span class="chip">Laravel</span>
                            <span class="chip">Vue.js</span>
                            <span class="chip">React</span>
                            <span class="chip">Node.js</span>
                            <span class="chip">Django</span>
                            <span class="chip">Golang</span>
                        </div>
                        {{-- <span class="chip">PostgreSQL</span> --}}
                        {{-- <span class="chip">MySQL</span> --}}
                    </div>
                </div>
            </div>

            <!-- Floating elements for background animation -->
            <div class="parallax-layer layer-1" aria-hidden="true"></div>
            <div class="parallax-layer layer-2" aria-hidden="true"></div>
            <div class="parallax-layer layer-3" aria-hidden="true"></div>
            <div class="floating-element"></div>
            <div class="floating-element"></div>
            <div class="floating-element"></div>
            <div class="scroll-indicator" aria-hidden="true"></div>
        </section>

        <!-- Skills Section -->
        @if(($skills ?? collect())->isNotEmpty())
            <section class="skills" id="skills" aria-labelledby="skills-title">
                <div class="container">
                    <h2 class="text-center" id="skills-title">My Skills</h2>

                    <div class="skills-grid">
                        @foreach($skills as $skill)
                            <div class="skill-card">
                                <div class="skill-icon">
                                    <i class="{{ $skill->icon ?: 'fas fa-code' }}"></i>
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

        <!-- Projects Section -->
        @if(($saasProducts ?? collect())->isNotEmpty())
            <section class="projects" id="projects" aria-labelledby="projects-title">
                <div class="container">
                    <h2 class="text-center" id="projects-title">Featured Projects</h2>

                    <div class="projects-grid">
                        @foreach($saasProducts as $project)
                            <a class="project-card saas-product-card" href="{{ route('projects.show', $project->slug) }}">
                                <div class="project-img">
                                    @if($project->thumbnail)
                                        <img src="{{ asset($project->thumbnail) }}"
                                            alt="{{ $project->thumbnail_alt ?: $project->title }}">
                                    @else
                                        <i class="{{ $project->icon ?: 'fas fa-layer-group' }}"></i>
                                    @endif
                                </div>
                                <div class="project-content">
                                    @if($project->category)
                                        <span class="project-category">{{ $project->category }}</span>
                                    @endif
                                    <h3>{{ $project->title }}</h3>
                                    <p>{{ $project->tagline ?: Str::limit($project->overview, 140) }}</p>
                                    @if(!empty($project->tech_stack))
                                        <div class="project-tags">
                                            @foreach($project->tech_stack as $tag)
                                                <span class="project-tag">{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    <span class="project-card-link">View product <i class="fas fa-arrow-right"></i></span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif


        <!-- Clients Section -->
        @if(($clientWorks ?? collect())->isNotEmpty())
            <section class="clients" id="clients" aria-labelledby="clients-title">
                <div class="container">
                    <h2 class="text-center" id="clients-title">Client Work</h2>

                    <div class="clients-grid">
                        @foreach($clientWorks as $work)
                            <div class="client-card">
                                <div class="client-logo">
                                    @if($work->image)
                                        <img src="{{ asset($work->image) }}" alt="{{ $work->title }}">
                                    @else
                                        <i class="{{ $work->icon ?: 'fas fa-building' }}"></i>
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

        <!-- Team Section -->
        @if(($teamMembers ?? collect())->isNotEmpty())
            <section class="team" id="team" aria-labelledby="team-title">
                <div class="container">
                    <div class="team-heading text-center">
                        <h2 id="team-title">My Team</h2>
                        <p>Meet the people behind the work - skilled, reliable, and focused on delivering high-quality digital
                            solutions.</p>
                    </div>

                    <div class="team-grid">
                        @foreach($teamMembers as $member)
                            <article class="team-card">
                                <div class="team-card-top">
                                    <div class="team-avatar-wrap">
                                        @if($member->profile_image)
                                            <img class="team-avatar" src="{{ asset($member->profile_image) }}"
                                                alt="{{ $member->name }}">
                                        @else
                                            <div class="team-avatar team-avatar-fallback" aria-hidden="true">
                                                {{ collect(explode(' ', $member->name))->filter()->map(fn($part) => Str::substr($part, 0, 1))->take(2)->implode('') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h3>{{ $member->name }}</h3>
                                        <p class="team-role">{{ $member->role }}</p>
                                    </div>
                                </div>

                                <div class="team-labels">
                                    @if($member->experience_label)
                                        <span><i class="fas fa-award"></i>{{ $member->experience_label }}</span>
                                    @endif
                                    @if($member->projects_label)
                                        <span><i class="fas fa-diagram-project"></i>{{ $member->projects_label }}</span>
                                    @endif
                                </div>

                                @if(!empty($member->tags))
                                    <div class="team-tags">
                                        @foreach($member->tags as $tag)
                                            <span>{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif

                                <p class="team-description">{{ $member->description }}</p>

                                @if($member->mission)
                                    <div class="team-mission">
                                        <i class="fas fa-bullseye"></i>
                                        <p>{{ $member->mission }}</p>
                                    </div>
                                @endif

                                @if(!empty($member->expertise))
                                    <div class="team-expertise">
                                        <h4><i class="fas fa-layer-group"></i> Core Expertise</h4>
                                        <ul>
                                            @foreach($member->expertise as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if(!empty($member->stats))
                                    <div class="team-stats">
                                        @foreach($member->stats as $stat)
                                            <div>
                                                <i
                                                    class="{{ Str::contains(Str::lower($stat), ['satisfaction', 'quality']) ? 'fas fa-face-smile' : 'fas fa-briefcase' }}"></i>
                                                <span>{{ $stat }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="team-contact">
                                    @if($member->phone)
                                        <a href="tel:{{ preg_replace('/\s+/', '', $member->phone) }}"><i
                                                class="fas fa-phone"></i>{{ $member->phone }}</a>
                                    @endif
                                    @if($member->email)
                                        <a href="mailto:{{ $member->email }}"><i class="fas fa-envelope"></i>{{ $member->email }}</a>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- Blog Section -->
        <section class="blog" id="blog" aria-labelledby="blog-title">
            <div class="container">
                <h2 class="text-center" id="blog-title">Latest Articles</h2>

                <div class="blog-grid">
                    <div class="blog-card">
                        <div class="blog-img">
                            <i class="fas fa-code"></i>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span><i class="far fa-calendar"></i> June 15, 2023</span>
                                <span><i class="far fa-clock"></i> 5 min read</span>
                            </div>
                            <h3>Laravel API Development Best Practices</h3>
                            <p>Learn how to build robust and secure APIs with Laravel following industry best practices.
                            </p>
                            <a href="#" class="btn btn-outline">Read More</a>
                        </div>
                    </div>

                    <div class="blog-card">
                        <div class="blog-img">
                            <i class="fas fa-paint-brush"></i>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span><i class="far fa-calendar"></i> May 28, 2023</span>
                                <span><i class="far fa-clock"></i> 7 min read</span>
                            </div>
                            <h3>Vue.js Composition API Guide</h3>
                            <p>Complete guide to using Vue.js Composition API for better code organization and
                                reusability.
                            </p>
                            <a href="#" class="btn btn-outline">Read More</a>
                        </div>
                    </div>

                    <div class="blog-card">
                        <div class="blog-img">
                            <i class="fas fa-server"></i>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span><i class="far fa-calendar"></i> April 10, 2023</span>
                                <span><i class="far fa-clock"></i> 6 min read</span>
                            </div>
                            <h3>Deploying Laravel on VPS</h3>
                            <p>Step-by-step guide to deploying Laravel applications on VPS with Nginx and SSL.</p>
                            <a href="#" class="btn btn-outline">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="contact" id="contact" aria-labelledby="contact-title">
            <div class="container">
                <h2 class="text-center" id="contact-title">Get In Touch</h2>

                <div class="contact-container">
                    <div class="contact-info">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h3>Location</h3>
                                <p>Remote Worldwide</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h3>Email</h3>
                                <p>ranashaharyar625@gmail.com</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <h3>Phone</h3>
                                <p>+92 (305) 7362625</p>
                                <p>+92 (335) 9493868</p>
                            </div>
                        </div>

                        <div class="social-links">
                            <a href="https://x.com/ShaharyarRana12" aria-label="Twitter" rel="noopener"><i
                                    class="fab fa-twitter" aria-hidden="true"></i></a>
                            <a href="https://www.linkedin.com/in/rana-shaharyar-848620200/" aria-label="LinkedIn"
                                rel="noopener"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a>
                            <a href="https://github.com/SharryRana" aria-label="GitHub" rel="noopener"><i
                                    class="fab fa-github" aria-hidden="true"></i></a>
                            <a href="#" aria-label="Dribbble" rel="noopener"><i class="fab fa-dribbble"
                                    aria-hidden="true"></i></a>
                        </div>
                    </div>

                    <div class="contact-form">
                        <form action="{{ route('contact.submit') }}" id="contactForm" autocomplete="on">
                            <div class="form-group">
                                <label for="name">Your Name</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="email">Your Email</label>
                                <input type="email" id="email" name="email" class="form-control" autocomplete="email">
                            </div>

                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" id="subject" name="subject" class="form-control" autocomplete="on">
                            </div>

                            <div class="form-group">
                                <label for="message">Your Message</label>
                                <textarea id="message" name="message" class="form-control"></textarea>
                            </div>

                            <button type="submit" class="btn">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
