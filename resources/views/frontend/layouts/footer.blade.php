<footer role="contentinfo">
    <div class="container">
        <div class="footer-container">
            <div class="footer-col footer-col--brand">
                <a href="{{ route('home') }}" class="logo" aria-label="Creavibe home">Creavibe<span>.</span></a>
                <p>Building scalable SaaS, FinTech, and modern web applications. Software engineering by Shaharyar, a full-stack developer with 5+ years of experience.</p>
                <div class="social-links">
                    <a href="https://x.com/ShaharyarRana12" aria-label="Twitter / X" rel="noopener noreferrer" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                    <a href="https://www.linkedin.com/in/rana-shaharyar-848620200/" aria-label="LinkedIn" rel="noopener noreferrer" target="_blank"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a>
                    <a href="https://github.com/SharryRana" aria-label="GitHub" rel="noopener noreferrer" target="_blank"><i class="fab fa-github" aria-hidden="true"></i></a>
                </div>
            </div>

            <div class="footer-col">
                <h3>Company</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Shaharyar Shafiq</a></li>
                    <li><a href="{{ route('saas.index') }}">SaaS Products</a></li>
                    <li><a href="{{ route('projects.index') }}">Projects</a></li>
                    <li><a href="{{ route('blog.index') }}">Blog</a></li>
                    <li><a href="{{ route('faqs') }}">FAQs</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>Services</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('services.show', 'backend-development') }}">Backend Development</a></li>
                    <li><a href="{{ route('services.show', 'full-stack-development') }}">Full-Stack Development</a></li>
                    <li><a href="{{ route('services.show', 'saas-development') }}">SaaS Development</a></li>
                    <li><a href="{{ route('services.show', 'api-development') }}">API Development</a></li>
                    <li><a href="{{ route('services.show', 'fintech-development') }}">FinTech Development</a></li>
                    <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}">Terms &amp; Conditions</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>Get in Touch</h3>
                <ul class="footer-links">
                    <li>
                        <a href="mailto:ranashaharyar625@gmail.com">
                            <i class="fas fa-envelope" aria-hidden="true"></i> ranashaharyar625@gmail.com
                        </a>
                    </li>
                    <li>
                        <a href="tel:+923057362625">
                            <i class="fas fa-phone" aria-hidden="true"></i> +92 (305) 7362625
                        </a>
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt" aria-hidden="true"></i> Remote Worldwide
                    </li>
                </ul>
            </div>
        </div>

        <div class="copyright">
            <p>&copy; {{ date('Y') }} <a href="{{ route('home') }}">Creavibe</a>. All rights reserved. | Founded &amp; Engineered by <a href="{{ route('about') }}">Shaharyar Shafiq</a></p>
        </div>
    </div>
</footer>
