@extends('frontend.layouts.master')

@section('title', $product->meta_title ?: $product->title . ' | SaaS Product')
@section('meta_description', $product->meta_description ?: Str::limit(strip_tags($product->overview), 155))
@section('meta_keywords', $product->meta_keywords ?: $product->focus_keyword)
@section('canonical_url', $product->canonical_url ?: route('projects.show', $product->slug))
@section('og_type', 'product')
@section('og_title', $product->og_title ?: $product->meta_title ?: $product->title)
@section('og_description', $product->og_description ?: $product->meta_description ?: Str::limit(strip_tags($product->overview), 155))
@section('og_image', $product->og_image ? asset($product->og_image) : ($product->thumbnail ? asset($product->thumbnail) : asset('assets/og-image.png')))
@section('og_image_alt', $product->thumbnail_alt ?: $product->title)
@section('twitter_title', $product->twitter_title ?: $product->og_title ?: $product->title)
@section('twitter_description', $product->twitter_description ?: $product->og_description ?: Str::limit(strip_tags($product->overview), 155))
@section('twitter_image', $product->twitter_image ? asset($product->twitter_image) : ($product->og_image ? asset($product->og_image) : ($product->thumbnail ? asset($product->thumbnail) : asset('assets/og-image.png'))))

@push('head')
    @if($product->product_schema_json)
        <script type="application/ld+json">{!! $product->product_schema_json !!}</script>
    @else
        <script type="application/ld+json">
            {
                "@@context": "https://schema.org",
                "@type": "SoftwareApplication",
                "name": @json($product->title),
                "description": @json($product->meta_description ?: Str::limit(strip_tags($product->overview), 155)),
                "applicationCategory": @json($product->category ?: 'BusinessApplication'),
                "url": @json(route('projects.show', $product->slug)),
                "image": @json($product->thumbnail ? asset($product->thumbnail) : null)
            }
        </script>
    @endif
@endpush

@section('main-content')
    <main id="main-content">
        <section class="saas-detail-hero visible">
            <div class="container saas-detail-hero-grid">
                <div>
                    @if($product->category)
                        <span class="project-category">{{ $product->category }}</span>
                    @endif
                    <h1>{{ $product->title }}</h1>
                    @if($product->tagline)
                        <p class="saas-detail-lead">{{ $product->tagline }}</p>
                    @endif
                    <p>{{ $product->overview }}</p>
                    <div class="saas-detail-actions">
                        @if($product->demo_url)
                            <a class="btn" href="{{ $product->demo_url }}" target="_blank" rel="noopener">Open Demo</a>
                        @endif
                        <a class="btn btn-outline" href="#pricing">View Pricing</a>
                    </div>
                </div>
                <div class="saas-detail-preview">
                    @if($product->thumbnail)
                        <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->thumbnail_alt ?: $product->title }}">
                    @else
                        <i class="{{ $product->icon ?: 'fas fa-layer-group' }}"></i>
                    @endif
                </div>
            </div>
        </section>

        @if($product->features->isNotEmpty())
            <section class="visible">
                <div class="container">
                    <h2>Main Features</h2>
                    <div class="saas-feature-grid">
                        @foreach($product->features as $feature)
                            <div class="skill-card">
                                <div class="skill-icon"><i class="{{ $feature->icon ?: 'fas fa-check' }}"></i></div>
                                <h3>{{ $feature->title }}</h3>
                                <p>{{ $feature->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <section class="visible saas-info-band">
            <div class="container saas-two-col">
                <div>
                    <h2>How It Works</h2>
                    <p>{{ $product->how_it_works ?: 'The product turns business workflows into a focused web application with clean dashboards, role-based actions, and reliable automation.' }}</p>
                </div>
                <div>
                    <h2>How To Use</h2>
                    <p>{{ $product->access_instructions ?: 'Request access, review the product demo, choose a plan, and onboard your team with the configured workflows.' }}</p>
                </div>
            </div>
        </section>

        @if($product->screenshots->isNotEmpty())
            <section class="visible">
                <div class="container">
                    <h2>Screenshots</h2>
                    <div class="saas-gallery">
                        @foreach($product->screenshots as $shot)
                            <button class="saas-gallery-item" type="button" data-lightbox-src="{{ asset($shot->image) }}" aria-label="Open {{ $shot->title ?: $product->title }} screenshot">
                                <img src="{{ asset($shot->image) }}" alt="{{ $shot->alt_text ?: $product->title }}">
                                @if($shot->title)
                                    <span>{{ $shot->title }}</span>
                                @endif
                            </button>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if($product->video_embed_url)
            <section class="visible saas-info-band">
                <div class="container">
                    <h2>Demo Video</h2>
                    <div class="saas-video">
                        <iframe src="{{ $product->video_embed_url }}" title="{{ $product->title }} demo video" allowfullscreen></iframe>
                    </div>
                </div>
            </section>
        @endif

        <section class="visible">
            <div class="container saas-three-col">
                @if(!empty($product->benefits))
                    <div>
                        <h2>Benefits</h2>
                        <ul class="saas-check-list">
                            @foreach($product->benefits as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(!empty($product->use_cases))
                    <div>
                        <h2>Use Cases</h2>
                        <ul class="saas-check-list">
                            @foreach($product->use_cases as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(!empty($product->tech_stack))
                    <div>
                        <h2>Tech Stack</h2>
                        <div class="project-tags">
                            @foreach($product->tech_stack as $item)
                                <span class="project-tag">{{ $item }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </section>

        @php($activePricingPlans = $product->pricingPlans->where('status', 'active'))
        @if($activePricingPlans->isNotEmpty())
            @php($hasLocalizedPrice = collect($localizedPrices ?? [])->contains('is_localized', true))
            <section class="visible saas-info-band" id="pricing">
                <div class="container">
                    <div class="saas-pricing-heading">
                        <div>
                            <h2>Pricing Plans</h2>
                            <p>
                                @if($hasLocalizedPrice && $pricingContext['detected'] && ($pricingContext['country_name'] || $pricingContext['country_code']))
                                    Pricing adjusted for {{ $pricingContext['country_name'] ?: $pricingContext['country_code'] }} when a local price is available.
                                @elseif($pricingContext['detected'] && ($pricingContext['country_name'] || $pricingContext['country_code']))
                                    No local pricing is configured for {{ $pricingContext['country_name'] ?: $pricingContext['country_code'] }}, so default USD pricing is shown.
                                @else
                                    Country detection is unavailable, so default USD pricing is shown.
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="saas-pricing-grid">
                        @foreach($activePricingPlans as $plan)
                            @php($displayPrice = $localizedPrices[$plan->id] ?? [
                                'currency' => $plan->currency,
                                'price' => $plan->price,
                                'country_name' => null,
                                'country_code' => null,
                                'is_localized' => false,
                            ])
                            <div class="saas-pricing-card {{ $plan->is_popular ? 'is-popular' : '' }}">
                                @if($plan->is_popular)
                                    <span class="saas-popular-badge">Popular</span>
                                @endif
                                <h3>{{ $plan->title }}</h3>
                                <div class="saas-price">{{ $displayPrice['currency'] }} {{ number_format((float) $displayPrice['price'], 0) }}</div>
                                <div class="saas-price-note">
                                    @if($displayPrice['is_localized'])
                                        Local pricing for {{ $displayPrice['country_name'] ?: $displayPrice['country_code'] }}
                                    @else
                                        Default {{ $plan->currency }} pricing
                                    @endif
                                </div>
                                @if($plan->duration)
                                    <p>{{ $plan->duration }}</p>
                                @endif
                                @if($plan->description)
                                    <p>{{ $plan->description }}</p>
                                @endif
                                <ul class="saas-check-list">
                                    @foreach($plan->features ?? [] as $feature)
                                        <li>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                                <a class="btn btn-outline mt-5" href="{{ $product->demo_url ?: route('home') . '#contact' }}">{{ $plan->cta_label ?: 'Get Started' }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if($product->faqs->isNotEmpty())
            <section class="visible">
                <div class="container">
                    <h2>FAQs</h2>
                    <div class="saas-faqs">
                        @foreach($product->faqs as $faq)
                            <details>
                                <summary>{{ $faq->question }}</summary>
                                <p>{{ $faq->answer }}</p>
                            </details>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <section class="visible saas-final-cta">
            <div class="container">
                <h2>Ready to see {{ $product->title }} in action?</h2>
                <p>Book a demo or start with a plan that fits your team.</p>
                <div class="saas-detail-actions">
                    @if($product->demo_url)
                        <a class="btn" href="{{ $product->demo_url }}" target="_blank" rel="noopener">Open Demo</a>
                    @endif
                    <a class="btn btn-outline" href="{{ route('home') }}#contact">Contact Me</a>
                </div>
            </div>
        </section>

        <div class="saas-lightbox" id="saasLightbox" aria-hidden="true">
            <button type="button" aria-label="Close preview">&times;</button>
            <img src="" alt="Screenshot preview">
        </div>
    </main>
@endsection
