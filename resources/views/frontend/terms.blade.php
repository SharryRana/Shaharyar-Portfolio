@extends('frontend.layouts.master')

@section('title', 'Terms & Conditions | Creavibe')
@section('meta_description', 'Creavibe Terms and Conditions. Terms of service for software development, SaaS products, consulting, and client engagement.')
@section('canonical_url', route('terms'))
@section('og_title', 'Terms & Conditions | Creavibe')
@section('og_description', 'Creavibe Terms and Conditions for software engineering services and SaaS platforms.')
@section('twitter_title', 'Terms & Conditions | Creavibe')
@section('twitter_description', 'Creavibe Terms and Conditions.')

@section('main-content')
<main id="main-content">
    @include('frontend.partials.breadcrumb', ['crumbs' => [
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Terms & Conditions']
    ]])

    <section class="page-hero" aria-labelledby="terms-heading">
        <div class="container">
            <span class="page-hero-eyebrow">Legal &amp; Terms</span>
            <h1 id="terms-heading">Terms &amp; Conditions</h1>
            <p class="lead">Last updated: {{ date('F Y') }}</p>
        </div>
    </section>

    <section class="page-section" aria-label="Terms and Conditions content">
        <div class="container" style="max-width: 840px; color: var(--gray-light); line-height: 1.8;">
            <div style="background: var(--card-bg); border: 1px solid var(--card-border); padding: 36px; border-radius: 16px;">
                <h2 style="color: var(--light); font-size: 1.4rem; margin-bottom: 16px;">1. Services Overview</h2>
                <p>Creavibe provides custom software engineering services, SaaS product development, backend API design, and digital consulting. By engaging our services or accessing our website, you agree to comply with these Terms &amp; Conditions.</p>

                <h2 style="color: var(--light); font-size: 1.4rem; margin-top: 32px; margin-bottom: 16px;">2. Intellectual Property &amp; Code Ownership</h2>
                <p>Unless explicitly agreed otherwise in a written project agreement, client custom software development deliverables and source code become the exclusive intellectual property of the client upon full payment of agreed project milestones. Pre-existing Creavibe software components and SaaS products remain the property of Creavibe.</p>

                <h2 style="color: var(--light); font-size: 1.4rem; margin-top: 32px; margin-bottom: 16px;">3. Client Responsibilities</h2>
                <p>Clients are responsible for providing clear project specifications, timely feedback, required third-party API credentials, and ensuring they hold rights to any content or assets provided to Creavibe during project execution.</p>

                <h2 style="color: var(--light); font-size: 1.4rem; margin-top: 32px; margin-bottom: 16px;">4. Limitation of Liability</h2>
                <p>Creavibe builds software following industry best practices for security and performance. Creavibe shall not be liable for indirect, incidental, or consequential damages resulting from third-party server outages, external API modifications, or client misuse of software systems.</p>

                <h2 style="color: var(--light); font-size: 1.4rem; margin-top: 32px; margin-bottom: 16px;">5. Revisions &amp; Scope</h2>
                <p>Project scope is defined in initial project agreements or statements of work. Scope changes or additions requested during development will be evaluated and quoted separately as project addendums.</p>

                <h2 style="color: var(--light); font-size: 1.4rem; margin-top: 32px; margin-bottom: 16px;">6. Contact Information</h2>
                <p>For any questions regarding these Terms &amp; Conditions, please email us at <a href="mailto:ranashaharyar625@gmail.com" style="color: var(--primary);">ranashaharyar625@gmail.com</a>.</p>
            </div>
        </div>
    </section>
</main>
@endsection
