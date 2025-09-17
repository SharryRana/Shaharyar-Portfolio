@push('styles')
    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #818cf8;
            --accent: #f472b6;
            --text: #1f2937;
            --text-light: #6b7280;
            --bg: #f9fafb;
            --bg-alt: #ffffff;
            --card-bg: rgba(255, 255, 255, 0.8);
            --glass-bg: rgba(255, 255, 255, 0.2);
            --glass-border: rgba(255, 255, 255, 0.5);
            --border: #e5e7eb;
            --border-radius: 16px;
            --shadow: rgba(0, 0, 0, 0.1);
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #818cf8 100%);
            --accent-gradient: linear-gradient(135deg, #f472b6 0%, #f9a8d4 100%);
            --success: #10b981;
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 2rem;
            position: relative;
            display: inline-block;
            color: var(--text);
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 4px;
            background: var(--primary-gradient);
            border-radius: 2px;
            animation: expandWidth 1s ease-out forwards;
        }

        /* Contact grid */
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
            animation: fadeIn 1s ease-out 0.3s both;
        }

        /* Card base with glassmorphism */
        .card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            box-shadow: 0 10px 25px var(--shadow);
            padding: 2.5rem;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            border: 1px solid var(--glass-border);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--primary-gradient);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .card:hover::before {
            transform: scaleX(1);
        }

        /* Form styles */
        .contact-form .form-group {
            margin-bottom: 1.5rem;
            display: flex;
            flex-direction: column;
            position: relative;
            animation: fadeIn 0.5s ease-out;
        }

        .contact-form label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text);
            transition: all 0.3s ease;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 1rem 1.2rem;
            border: 1px solid var(--border);
            border-radius: 12px;
            font-size: 1rem;
            background: var(--bg-alt);
            color: var(--text);
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2);
            transform: translateY(-2px);
        }

        /* Floating labels effect */
        .contact-form .form-group.focused label {
            transform: translateY(-10px);
            font-size: 0.85rem;
            color: var(--primary);
        }

        /* Button */
        .contact-form button.hero-cta {
            width: 100%;
            background: var(--primary-gradient);
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            padding: 1.2rem 1.5rem;
            cursor: pointer;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }

        .contact-form button.hero-cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: all 0.6s ease;
        }

        .contact-form button.hero-cta:hover {
            background: var(--accent-gradient);
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(244, 114, 182, 0.4);
        }

        .contact-form button.hero-cta:hover::before {
            left: 100%;
        }

        .contact-form button.hero-cta:active {
            transform: translateY(0);
        }



        /* Sidebar styles */
        .sidebar {
            animation: fadeInRight 0.8s ease-out 0.5s both;
        }

        .sidebar-widget {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            padding: 2rem;
            border: 1px solid var(--glass-border);
            box-shadow: 0 10px 25px var(--shadow);
            margin-bottom: 2rem;
            transition: all 0.4s ease;
        }

        .sidebar-widget:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px var(--shadow);
        }

        .widget-title {
            font-size: 1.4rem;
            margin-bottom: 1rem;
            color: var(--text);
            position: relative;
            display: inline-block;
        }

        .widget-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 30px;
            height: 3px;
            background: var(--primary-gradient);
            border-radius: 2px;
        }

        .newsletter-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .newsletter-input {
            padding: 1rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            background: var(--bg-alt);
            color: var(--text);
            transition: all 0.3s ease;
        }

        .newsletter-input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .newsletter-btn {
            background: var(--primary-gradient);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 1rem;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .newsletter-btn:hover {
            background: var(--accent-gradient);
            transform: translateY(-2px);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
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

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes expandWidth {
            from {
                width: 0;
            }

            to {
                width: 50px;
            }
        }

        @keyframes rotateSlow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .main-content {
                grid-template-columns: 1fr;
            }

            .hero-title {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            .contact-grid {
                grid-template-columns: 1fr;
            }

            .hero-title {
                font-size: 2rem;
            }

            .card {
                padding: 1.5rem;
            }
        }

        .map-container iframe {
            border-radius: 16px;
            /* same as --border-radius */
            box-shadow: 0 10px 25px var(--shadow);
        }
    </style>
@endpush

<x-blog::layouts.master>
    <!-- Hero Section -->
    <section class="hero">
        <div class="container hero-content">
            <h1 class="hero-title">Contact Us</h1>
            <p class="hero-subtitle">
                We'd love to hear from you! Please use the form below or reach out to us through our contact details.
            </p>
        </div>
    </section>

    <div class="container main-content">
        <!-- Contact Form Section -->
        <main>
            <h2 class="section-title">Get in Touch</h2>
            <div class="contact-grid">
                <!-- Contact Form -->
                <div class="contact-form-container card">
                    <form class="contact-form" action="#" method="POST">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="name" class="form-input"
                                placeholder="Enter your name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Your Email</label>
                            <input type="email" id="email" name="email" class="form-input"
                                placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-input"
                                placeholder="Enter subject">
                        </div>
                        <div class="form-group">
                            <label for="message">Your Message</label>
                            <textarea id="message" name="message" rows="5" class="form-textarea" placeholder="Write your message" required></textarea>
                        </div>
                        <button type="submit" class="hero-cta">Send Message <i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>



            </div>
            <div class="map-container card" style="margin-top:2rem;">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d34953.266218918935!2d71.4906!3d30.2353!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1695362453842!5m2!1sen!2s"
                    width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </main>

        <!-- Sidebar -->
        <aside class="sidebar">
            <!-- About Widget -->
            <div class="sidebar-widget">
                <h3 class="widget-title">About Blog</h3>
                <p class="about-text">Creavibe Blog is a platform for sharing ideas, tutorials, and insights about web
                    development, design, and technology. We're passionate about helping creators build amazing digital
                    experiences.</p>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                </div>
            </div>

            <!-- Newsletter Widget -->
            <div class="sidebar-widget">
                <h3 class="widget-title">Newsletter</h3>
                <p class="about-text">Subscribe to our newsletter to get the latest updates and articles directly in
                    your inbox.</p>
                <form class="newsletter-form">
                    <input type="email" class="newsletter-input" placeholder="Your email address">
                    <button type="submit" class="newsletter-btn">Subscribe <i class="fas fa-paper-plane"></i></button>
                </form>
            </div>

            <!-- Categories Widget -->
            <div class="sidebar-widget">
                <h3 class="widget-title">Categories</h3>
                <ul class="categories-list">
                    <li class="category-item">
                        <a href="#" class="category-link">Web Design</a>
                        <span class="category-count">12</span>
                    </li>
                    <li class="category-item">
                        <a href="#" class="category-link">Development</a>
                        <span class="category-count">24</span>
                    </li>
                    <li class="category-item">
                        <a href="#" class="category-link">UX/UI</a>
                        <span class="category-count">8</span>
                    </li>
                    <li class="category-item">
                        <a href="#" class="category-link">JavaScript</a>
                        <span class="category-count">16</span>
                    </li>
                    <li class="category-item">
                        <a href="#" class="category-link">Productivity</a>
                        <span class="category-count">7</span>
                    </li>
                    <li class="category-item">
                        <a href="#" class="category-link">Tools</a>
                        <span class="category-count">11</span>
                    </li>
                    <li class="category-item">
                        <a href="#" class="category-link">Tutorials</a>
                        <span class="category-count">19</span>
                    </li>
                </ul>
            </div>

            <!-- Popular Posts Widget -->
            <div class="sidebar-widget">
                <h3 class="widget-title">Popular Posts</h3>
                <div class="popular-post">
                    <img src="https://images.unsplash.com/photo-1547658719-da2b51169166?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80"
                        alt="Popular Post" class="popular-post-img">
                    <div class="popular-post-content">
                        <h4 class="popular-post-title">How to Build a Responsive Website from Scratch</h4>
                        <span class="popular-post-date">April 28, 2023</span>
                    </div>
                </div>
                <div class="popular-post">
                    <img src="https://images.unsplash.com/photo-1515879218367-8466d910aaa4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80"
                        alt="Popular Post" class="popular-post-img">
                    <div class="popular-post-content">
                        <h4 class="popular-post-title">VS Code Extensions for Web Developers</h4>
                        <span class="popular-post-date">April 25, 2023</span>
                    </div>
                </div>
                <div class="popular-post">
                    <img src="https://images.unsplash.com/photo-1581276879432-15e50529f34b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80"
                        alt="Popular Post" class="popular-post-img">
                    <div class="popular-post-content">
                        <h4 class="popular-post-title">React Performance Optimization Techniques</h4>
                        <span class="popular-post-date">April 20, 2023</span>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</x-blog::layouts.master>
