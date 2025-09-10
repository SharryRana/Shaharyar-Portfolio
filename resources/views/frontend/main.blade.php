@extends('frontend.layouts.master')
@section('main-content')
    <main id="main-content">
        <section class="hero" id="home" aria-labelledby="home-title">
            <div class="container hero-grid">
                <div class="hero-content">
                    <h1 id="home-title">Full-Stack Web Developer</h1>
                    <p>Hey! I'm Shaharyar, a full-stack web developer with 4+ years of experience. I specialize in
                        Laravel
                        with Vue.js, Inertia.js, and React.js, and also work with Node.js and Django. From sleek
                        websites to
                        complex web apps, I deliver clean, scalable solutions.</p>
                    <div class="hero-buttons">
                        <a href="#projects" class="btn">View My Work</a>
                        <a href="#contact" class="btn btn-outline">Contact Me</a>
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
                            <div class="code-content" style="margin-bottom: 3%; margin-left: 2%;">
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
                        </div>
                    </div>
                    <div class="tech-badges">
                        <span class="chip">Laravel</span>
                        <span class="chip">Vue.js</span>
                        <span class="chip">React</span>
                        <span class="chip">Node.js</span>
                        <span class="chip">Django</span>
                        <span class="chip">MySQL</span>
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
        <section class="skills" id="skills" aria-labelledby="skills-title">
            <div class="container">
                <h2 class="text-center" id="skills-title">My Skills</h2>

                <div class="skills-grid">
                    <div class="skill-card">
                        <div class="skill-icon">
                            <i class="fab fa-laravel"></i>
                        </div>
                        <h3>Laravel Development</h3>
                        <p>Building robust, scalable backend solutions with Laravel framework and MySQL databases.</p>
                    </div>

                    <div class="skill-card">
                        <div class="skill-icon">
                            <i class="fab fa-vuejs"></i>
                        </div>
                        <h3>Vue.js & Inertia.js</h3>
                        <p>Creating dynamic, responsive frontend interfaces with Vue.js and seamless integration with
                            Laravel.</p>
                    </div>

                    <div class="skill-card">
                        <div class="skill-icon">
                            <i class="fab fa-react"></i>
                        </div>
                        <h3>React.js Development</h3>
                        <p>Building modern, interactive user interfaces with React.js and related ecosystem.</p>
                    </div>

                    <div class="skill-card">
                        <div class="skill-icon">
                            <i class="fab fa-node-js"></i>
                        </div>
                        <h3>Node.js & Express</h3>
                        <p>Developing server-side applications and RESTful APIs with Node.js and Express framework.</p>
                    </div>

                    <div class="skill-card">
                        <div class="skill-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <h3>Database Design</h3>
                        <p>Designing efficient database schemas and optimized queries for high-performance applications.
                        </p>
                    </div>

                    <div class="skill-card">
                        <div class="skill-icon">
                            <i class="fas fa-cloud"></i>
                        </div>
                        <h3>VPS & Cloud Hosting</h3>
                        <p>Deploying and managing applications on VPS and cloud platforms for optimal performance.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Projects Section -->
        <section class="projects" id="projects" aria-labelledby="projects-title">
            <div class="container">
                <h2 class="text-center" id="projects-title">Featured Projects</h2>

                <div class="projects-grid">
                    <!-- Existing Projects -->
                    <div class="project-card">
                        <div class="project-img">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="project-content">
                            <h3>E-Commerce Platform</h3>
                            <p>Complete e-commerce solution with Laravel, Vue.js, and MySQL with payment integration.</p>
                            <div class="project-tags">
                                <span class="project-tag">Laravel</span>
                                <span class="project-tag">Vue.js</span>
                                <span class="project-tag">MySQL</span>
                            </div>
                            {{-- {{-- <a href="#" class="btn btn-outline">View Project</a> --}}
                        </div>
                    </div>

                    <div class="project-card">
                        <div class="project-img">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="project-content">
                            <h3>Project Management App</h3>
                            <p>Task management system with real-time updates using Laravel, Inertia.js and WebSockets.</p>
                            <div class="project-tags">
                                <span class="project-tag">Laravel</span>
                                <span class="project-tag">Inertia.js</span>
                                <span class="project-tag">WebSockets</span>
                            </div>
                            {{-- <a href="#" class="btn btn-outline">View Project</a> --}}
                        </div>
                    </div>

                    <div class="project-card">
                        <div class="project-img">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div class="project-content">
                            <h3>Fitness Tracking App</h3>
                            <p>Mobile fitness application with React Native and Firebase backend for real-time data sync.
                            </p>
                            <div class="project-tags">
                                <span class="project-tag">React Native</span>
                                <span class="project-tag">Firebase</span>
                                <span class="project-tag">Node.js</span>
                            </div>
                            {{-- <a href="#" class="btn btn-outline">View Project</a> --}}
                        </div>
                    </div>

                    <!-- New Advanced Projects -->
                    <div class="project-card">
                        <div class="project-img">
                            <i class="fas fa-brain"></i>
                        </div>
                        <div class="project-content">
                            <h3>AI Chatbot Assistant</h3>
                            <p>Conversational AI chatbot built with Python, NLP, and OpenAI API, integrated into a customer
                                support system.</p>
                            <div class="project-tags">
                                <span class="project-tag">Python</span>
                                <span class="project-tag">OpenAI API</span>
                                <span class="project-tag">NLP</span>
                            </div>
                            {{-- <a href="#" class="btn btn-outline">View Project</a> --}}
                        </div>
                    </div>

                    <div class="project-card">
                        <div class="project-img">
                            <i class="fas fa-cloud"></i>
                        </div>
                        <div class="project-content">
                            <h3>Cloud File Storage</h3>
                            <p>Secure cloud storage system with file sharing, encryption, and AWS S3 integration.</p>
                            <div class="project-tags">
                                <span class="project-tag">Laravel</span>
                                <span class="project-tag">AWS S3</span>
                                <span class="project-tag">Docker</span>
                            </div>
                            {{-- <a href="#" class="btn btn-outline">View Project</a> --}}
                        </div>
                    </div>

                    <div class="project-card">
                        <div class="project-img">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="project-content">
                            <h3>Stock Market Analyzer</h3>
                            <p>Real-time stock analysis platform with predictive analytics using Machine Learning and
                                Node.js APIs.</p>
                            <div class="project-tags">
                                <span class="project-tag">Node.js</span>
                                <span class="project-tag">Machine Learning</span>
                                <span class="project-tag">MongoDB</span>
                            </div>
                            {{-- <a href="#" class="btn btn-outline">View Project</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Clients Section -->
        <section class="clients" id="clients" aria-labelledby="clients-title">
            <div class="container">
                <h2 class="text-center" id="clients-title">Client Work</h2>

                <div class="clients-grid">
                    <div class="client-card">
                        <div class="client-logo">
                            <i class="fas fa-building"></i>
                        </div>
                    </div>

                    <div class="client-card">
                        <div class="client-logo">
                            <i class="fas fa-utensils"></i>
                        </div>
                    </div>

                    <div class="client-card">
                        <div class="client-logo">
                            <i class="fas fa-tshirt"></i>
                        </div>
                    </div>

                    <div class="client-card">
                        <div class="client-logo">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>

                    <div class="client-card">
                        <div class="client-logo">
                            <i class="fas fa-gem"></i>
                        </div>
                    </div>

                    <div class="client-card">
                        <div class="client-logo">
                            <i class="fas fa-plane"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
                            <a href="https://x.com/ShaharyarRana12" aria-label="Twitter" rel="noopener"><i class="fab fa-twitter"
                                    aria-hidden="true"></i></a>
                            <a href="https://www.linkedin.com/in/rana-shaharyar-848620200/" aria-label="LinkedIn" rel="noopener"><i class="fab fa-linkedin-in"
                                    aria-hidden="true"></i></a>
                            <a href="https://github.com/SharryRana" aria-label="GitHub" rel="noopener"><i class="fab fa-github"
                                    aria-hidden="true"></i></a>
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
                                <input type="email" id="email" name="email" class="form-control"
                                    autocomplete="email">
                            </div>

                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" id="subject" name="subject" class="form-control"
                                    autocomplete="on">
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
