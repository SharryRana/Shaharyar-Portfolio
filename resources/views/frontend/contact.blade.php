@extends('frontend.layouts.master')

@section('title', 'Contact | Creavibe Software Engineering & SaaS Development')
@section('meta_description', 'Get in touch with Creavibe. Available for SaaS development, backend engineering, FinTech systems, API development, and software consulting projects worldwide.')
@section('canonical_url', route('contact'))
@section('og_title', 'Contact Creavibe')
@section('og_description', 'Available for SaaS development, backend engineering, FinTech systems, and software consulting. Remote worldwide.')
@section('twitter_title', 'Contact Creavibe')
@section('twitter_description', 'Get in touch for SaaS development, backend engineering, and FinTech systems.')

@push('head')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "ContactPage",
    "name": "Contact Creavibe",
    "url": "{{ route('contact') }}",
    "description": "Contact Creavibe for software engineering and SaaS development services"
}
</script>
@endpush

@section('main-content')
<main id="main-content">
    @include('frontend.partials.breadcrumb', ['crumbs' => [
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Contact'],
    ]])

    {{-- ─── HERO ─────────────────────────────────────────────── --}}
    <section class="contact-hero" aria-labelledby="contact-heading">
        <div class="container">
            <span class="page-hero-eyebrow"><i class="fas fa-paper-plane" aria-hidden="true"></i>&nbsp; Get in Touch</span>
            <h1 id="contact-heading">Let's Build Something Together</h1>
            <p class="lead">Available for SaaS development, backend engineering, FinTech systems, and software consulting remote worldwide.</p>
        </div>
    </section>

    {{-- ─── MAIN CONTACT GRID ──────────────────────────────────── --}}
    <section class="contact-page-section" aria-label="Contact form and info">
        <div class="container">
            <div class="contact-page-grid">

                {{-- LEFT: Info Column --}}
                <aside class="contact-info-col" aria-label="Contact information">

                    {{-- Availability badge --}}
                    <div class="contact-avail-badge">
                        <span class="contact-avail-dot" aria-hidden="true"></span>
                        <span>Available for new projects</span>
                    </div>

                    <p class="contact-info-intro">
                        The best way to reach me is via email or using the form. I typically respond within 24 hours on business days.
                    </p>

                    {{-- Contact cards --}}
                    <div class="contact-details-list">
                        <div class="contact-detail-card">
                            <div class="contact-detail-icon" aria-hidden="true">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-detail-body">
                                <h3>Location</h3>
                                <p>Remote Worldwide</p>
                            </div>
                        </div>

                        <div class="contact-detail-card">
                            <div class="contact-detail-icon" aria-hidden="true">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-detail-body">
                                <h3>Email</h3>
                                <a href="mailto:ranashaharyar625@gmail.com" class="contact-detail-link">ranashaharyar625@gmail.com</a>
                            </div>
                        </div>

                        <div class="contact-detail-card">
                            <div class="contact-detail-icon" aria-hidden="true">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="contact-detail-body">
                                <h3>Phone</h3>
                                <a href="tel:+923057362625" class="contact-detail-link">+92 (305) 7362625</a>
                                <a href="tel:+923359493868" class="contact-detail-link">+92 (335) 9493868</a>
                            </div>
                        </div>

                        <div class="contact-detail-card">
                            <div class="contact-detail-icon" aria-hidden="true">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="contact-detail-body">
                                <h3>Response Time</h3>
                                <p>Within 24 hours on weekdays</p>
                            </div>
                        </div>
                    </div>

                    {{-- Social links --}}
                    <div class="contact-social-row">
                        <span class="contact-social-label">Find me on</span>
                        <div class="contact-social-links">
                            <a href="https://x.com/ShaharyarRana12" aria-label="Twitter / X" rel="noopener noreferrer" target="_blank" class="contact-social-btn">
                                <i class="fab fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="https://www.linkedin.com/in/rana-shaharyar-848620200/" aria-label="LinkedIn" rel="noopener noreferrer" target="_blank" class="contact-social-btn">
                                <i class="fab fa-linkedin-in" aria-hidden="true"></i>
                            </a>
                            <a href="https://github.com/SharryRana" aria-label="GitHub" rel="noopener noreferrer" target="_blank" class="contact-social-btn">
                                <i class="fab fa-github" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>

                    {{-- What I can help with --}}
                    <div class="contact-services-mini">
                        <h4 class="contact-services-mini-title">I can help with</h4>
                        <ul class="contact-services-mini-list">
                            <li><i class="fas fa-check" aria-hidden="true"></i> SaaS Product Development</li>
                            <li><i class="fas fa-check" aria-hidden="true"></i> Backend & API Engineering</li>
                            <li><i class="fas fa-check" aria-hidden="true"></i> FinTech Systems</li>
                            <li><i class="fas fa-check" aria-hidden="true"></i> Full-Stack Applications</li>
                            <li><i class="fas fa-check" aria-hidden="true"></i> Technical Consulting</li>
                        </ul>
                    </div>
                </aside>

                {{-- RIGHT: Form Column --}}
                <div class="contact-form-col">
                    <div class="contact-form-card">
                        <div class="contact-form-card-header">
                            <h2>Send a Message</h2>
                            <p>Fill in the form and I'll get back to you as soon as possible.</p>
                        </div>

                        <form action="{{ route('contact.submit') }}" id="contactForm" autocomplete="on" novalidate>
                            @csrf

                            <div class="cf-row cf-row--two">
                                <div class="cf-group">
                                    <label class="cf-label" for="contact-name">
                                        Your Name <span class="cf-required" aria-hidden="true">*</span>
                                    </label>
                                    <div class="cf-input-wrap">
                                        <i class="fas fa-user cf-input-icon" aria-hidden="true"></i>
                                        <input type="text"
                                               id="contact-name"
                                               name="name"
                                               class="cf-input form-control"
                                               required
                                               autocomplete="name"
                                               placeholder="John Smith">
                                    </div>
                                </div>

                                <div class="cf-group">
                                    <label class="cf-label" for="contact-email">
                                        Email Address <span class="cf-required" aria-hidden="true">*</span>
                                    </label>
                                    <div class="cf-input-wrap">
                                        <i class="fas fa-envelope cf-input-icon" aria-hidden="true"></i>
                                        <input type="email"
                                               id="contact-email"
                                               name="email"
                                               class="cf-input form-control"
                                               required
                                               autocomplete="email"
                                               placeholder="john@company.com">
                                    </div>
                                </div>
                            </div>

                            <div class="cf-group">
                                <label class="cf-label" for="contact-subject">
                                    Subject <span class="cf-required" aria-hidden="true">*</span>
                                </label>
                                <div class="cf-input-wrap">
                                    <i class="fas fa-tag cf-input-icon" aria-hidden="true"></i>
                                    <input type="text"
                                           id="contact-subject"
                                           name="subject"
                                           class="cf-input form-control"
                                           required
                                           autocomplete="off"
                                           placeholder="SaaS Development Project">
                                </div>
                            </div>

                            <div class="cf-group">
                                <label class="cf-label" for="contact-message">
                                    Your Message <span class="cf-required" aria-hidden="true">*</span>
                                </label>
                                <textarea id="contact-message"
                                          name="message"
                                          class="cf-textarea form-control"
                                          rows="6"
                                          required
                                          placeholder="Tell me about your project, goals, and timeline..."></textarea>
                                <div class="cf-char-count" id="msg-char-count" aria-live="polite">0 / 15000</div>
                            </div>

                            <button type="submit" class="cf-submit-btn btn" id="contactSubmitBtn">
                                <i class="fas fa-paper-plane" aria-hidden="true"></i>
                                <span>Send Message</span>
                            </button>

                            <div id="contact-feedback" aria-live="polite"></div>
                        </form>
                    </div>
                </div>

            </div>{{-- /.contact-page-grid --}}
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
// Character counter for message textarea
(function() {
    const textarea = document.getElementById('contact-message');
    const counter  = document.getElementById('msg-char-count');
    if (!textarea || !counter) return;
    textarea.addEventListener('input', function() {
        const len = this.value.length;
        counter.textContent = len.toLocaleString() + ' / 15,000';
        counter.classList.toggle('cf-char-count--warn', len > 14000);
    });
})();
</script>
@endpush
