@extends('frontend.layouts.master')

@section('title', 'Privacy Policy | Creavibe')
@section('meta_description', 'Creavibe Privacy Policy. Learn how we handle data, protect visitor information, and maintain privacy compliance for our software engineering services and SaaS applications.')
@section('canonical_url', route('privacy'))
@section('og_title', 'Privacy Policy | Creavibe')
@section('og_description', 'Creavibe Privacy Policy. Transparent information handling and privacy standards.')
@section('twitter_title', 'Privacy Policy | Creavibe')
@section('twitter_description', 'Creavibe Privacy Policy.')

@section('main-content')
<main id="main-content">
    @include('frontend.partials.breadcrumb', ['crumbs' => [
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Privacy Policy']
    ]])

    <section class="page-hero" aria-labelledby="privacy-heading">
        <div class="container">
            <span class="page-hero-eyebrow">Legal &amp; Privacy</span>
            <h1 id="privacy-heading">Privacy Policy</h1>
            <p class="lead">Last updated: {{ date('F Y') }}</p>
        </div>
    </section>

    <section class="page-section" aria-label="Privacy Policy content">
        <div class="container" style="max-width: 840px; color: var(--gray-light); line-height: 1.8;">
            <div style="background: var(--card-bg); border: 1px solid var(--card-border); padding: 36px; border-radius: 16px;">
                <h2 style="color: var(--light); font-size: 1.4rem; margin-bottom: 16px;">1. Information We Collect</h2>
                <p>Creavibe collects information that you provide directly to us when contacting us through our website form, requesting consulting services, or interacting with our SaaS products. This information may include your name, email address, phone number, and project details.</p>

                <h2 style="color: var(--light); font-size: 1.4rem; margin-top: 32px; margin-bottom: 16px;">2. How We Use Information</h2>
                <p>We use the collected information solely to:</p>
                <ul style="padding-left: 20px; margin-bottom: 20px;">
                    <li>Respond to client enquiries and project requests</li>
                    <li>Provide, operate, and maintain software services and SaaS platforms</li>
                    <li>Send technical notices, updates, and administrative communications</li>
                    <li>Prevent fraudulent activity and maintain security compliance</li>
                </ul>

                <h2 style="color: var(--light); font-size: 1.4rem; margin-top: 32px; margin-bottom: 16px;">3. Data Protection &amp; Security</h2>
                <p>We implement industry-standard technical and organizational security measures to protect your personal data against unauthorized access, loss, or alteration. All database connections and data transfers are protected using encrypted protocols.</p>

                <h2 style="color: var(--light); font-size: 1.4rem; margin-top: 32px; margin-bottom: 16px;">4. Analytics &amp; Cookies</h2>
                <p>Our website may use essential cookies and privacy-respecting analytics tools (such as Google Analytics or Microsoft Clarity) to monitor anonymous traffic patterns and improve performance. No personal tracking data is sold to third parties.</p>

                <h2 style="color: var(--light); font-size: 1.4rem; margin-top: 32px; margin-bottom: 16px;">5. Third-Party Links</h2>
                <p>Our website may contain links to external third-party sites (such as GitHub or LinkedIn). Creavibe is not responsible for the privacy practices or content of external web platforms.</p>

                <h2 style="color: var(--light); font-size: 1.4rem; margin-top: 32px; margin-bottom: 16px;">6. Contact Us</h2>
                <p>If you have any questions regarding this Privacy Policy or wish to exercise your data rights, please contact us at <a href="mailto:ranashaharyar625@gmail.com" style="color: var(--primary);">ranashaharyar625@gmail.com</a>.</p>
            </div>
        </div>
    </section>
</main>
@endsection
