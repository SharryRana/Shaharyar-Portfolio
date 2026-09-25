@extends('frontend.layouts.master')

@section('title', ($service->meta_title ?: $service->name . ' | Creavibe'))
@section('meta_description', $service->meta_description ?: $service->short_description)
@section('canonical_url', route('services.show', $service->slug))
@section('og_title', $service->name . ' | Creavibe')
@section('og_description', $service->meta_description ?: $service->short_description)
@section('og_image', $service->og_image ? asset($service->og_image) : asset('assets/og-image.png'))
@section('twitter_title', $service->name . ' | Creavibe')
@section('twitter_description', $service->meta_description ?: $service->short_description)

@push('head')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Service",
    "name": @json($service->name),
    "description": @json($service->meta_description ?: $service->short_description),
    "provider": { "@@type": "Organization", "name": "Creavibe" },
    "url": @json(route('services.show', $service->slug))
}
</script>
@endpush

@section('main-content')
<main id="main-content">
    @include('frontend.partials.breadcrumb', ['crumbs' => [
        ['label' => 'Home',     'url' => route('home')],
        ['label' => 'Services', 'url' => route('services.index')],
        ['label' => $service->name],
    ]])

    {{-- ─── HERO ─────────────────────────────────────────────── --}}
    <section class="svc-detail-hero" aria-labelledby="svc-heading">
        <div class="container">
            <div class="svc-detail-hero-inner">
                <div class="svc-detail-hero-content">
                    <span class="page-hero-eyebrow">
                        @if($service->icon)
                            <i class="{{ $service->icon }}" aria-hidden="true"></i>&nbsp;
                        @endif
                        Creavibe Services
                    </span>
                    <h1 id="svc-heading">{{ $service->headline ?: $service->name }}</h1>
                    <p class="svc-detail-lead">{{ $service->short_description }}</p>
                    <div class="svc-detail-hero-actions">
                        <a href="{{ route('contact') }}" class="btn">Get a Quote</a>
                        <a href="{{ route('services.index') }}" class="btn btn-outline">All Services</a>
                    </div>
                </div>
                <div class="svc-detail-hero-icon-wrap" aria-hidden="true">
                    <div class="svc-detail-hero-icon">
                        <i class="{{ $service->icon ?: 'fas fa-code' }}"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ─── KEY POINTS ─────────────────────────────────────────── --}}
    @if(!empty($service->key_points))
    <section class="svc-benefits-section services-section-bg" aria-labelledby="benefits-heading">
        <div class="container">
            <div class="section-header-centered">
                <h2 id="benefits-heading">What You Get</h2>
                <p>Concrete deliverables and outcomes with every {{ $service->name }} engagement.</p>
            </div>
            <div class="svc-benefits-grid">
                @foreach($service->key_points as $i => $point)
                <div class="svc-benefit-item">
                    <div class="svc-benefit-icon"><i class="fas fa-check" aria-hidden="true"></i></div>
                    <p>{{ $point }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ─── OVERVIEW / FULL CONTENT ───────────────────────────── --}}
    @if($service->full_content)
    <section class="page-section" aria-label="Service overview">
        <div class="container">
            <div class="svc-prose-wrap">
                <h2>Service Overview</h2>
                <div class="svc-prose-content">
                    {!! nl2br(e($service->full_content)) !!}
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ─── TECHNOLOGIES ───────────────────────────────────────── --}}
    @if(!empty($service->technologies))
    <section class="svc-tech-section services-section-bg" aria-labelledby="svc-tech-heading">
        <div class="container">
            <div class="section-header-centered">
                <h2 id="svc-tech-heading">Technology Stack</h2>
                <p>Tools and frameworks I use to deliver {{ $service->name }} solutions.</p>
            </div>
            <div class="svc-tech-chips svc-tech-chips--centered">
                @foreach($service->technologies as $tech)
                    <span class="svc-tech-chip svc-tech-chip--lg">{{ $tech }}</span>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ─── PROCESS STEPS ──────────────────────────────────────── --}}
    @if(!empty($service->process_steps))
    <section class="page-section" aria-labelledby="process-heading">
        <div class="container">
            <div class="section-header-centered">
                <h2 id="process-heading">My Process</h2>
                <p>How a {{ $service->name }} project typically unfolds from first call to delivery.</p>
            </div>
            <ol class="svc-process-list">
                @foreach($service->process_steps as $i => $step)
                <li class="svc-process-list-item">
                    <div class="svc-process-list-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
                    <div class="svc-process-list-text">{{ $step }}</div>
                </li>
                @endforeach
            </ol>
        </div>
    </section>
    @endif

    {{-- ─── FAQs ───────────────────────────────────────────────── --}}
    @if($service->faqs->isNotEmpty())
    <section class="svc-faq-section services-section-bg" aria-labelledby="faq-heading">
        <div class="container">
            <div class="section-header-centered">
                <h2 id="faq-heading">Frequently Asked Questions</h2>
                <p>Common questions about {{ $service->name }} engagements.</p>
            </div>
            <div class="svc-faq-list">
                @foreach($service->faqs as $faq)
                <details class="svc-faq-item">
                    <summary class="svc-faq-summary">
                        <span>{{ $faq->question }}</span>
                        <span class="svc-faq-icon" aria-hidden="true"><i class="fas fa-plus"></i></span>
                    </summary>
                    <div class="svc-faq-body">{{ $faq->answer }}</div>
                </details>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ─── OTHER SERVICES ─────────────────────────────────────── --}}
    @if($otherServices->isNotEmpty())
    <section class="page-section" aria-labelledby="other-svc-heading">
        <div class="container">
            <div class="section-header-centered">
                <h2 id="other-svc-heading">Other Services</h2>
                <p>Explore more of what Creavibe offers.</p>
            </div>
            <div class="svc-cards-grid">
                @foreach($otherServices as $other)
                <article class="svc-card">
                    <div class="svc-card-inner">
                        <div class="svc-card-top">
                            <div class="svc-card-icon">
                                <i class="{{ $other->icon ?: 'fas fa-code' }}" aria-hidden="true"></i>
                            </div>
                        </div>
                        <h3 class="svc-card-title">{{ $other->name }}</h3>
                        <p class="svc-card-desc">{{ $other->short_description }}</p>
                        <a href="{{ route('services.show', $other->slug) }}" class="svc-card-link">
                            Learn more <i class="fas fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ─── CTA ────────────────────────────────────────────────── --}}
    <section class="saas-final-cta" aria-label="Contact CTA">
        <div class="container text-center">
            <h2>Ready to build with Creavibe?</h2>
            <p>Let's discuss your project requirements and find the right approach.</p>
            <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin-top:28px;">
                <a class="btn" href="{{ route('contact') }}">Start the Conversation</a>
                <a class="btn btn-outline" href="{{ route('saas.index') }}">See Our SaaS Products</a>
            </div>
        </div>
    </section>
</main>
@endsection
