@extends('frontend.layouts.master')

@section('title', 'SaaS Products | Creavibe')
@section('meta_description', 'SaaS products and software applications built by Creavibe  scalable web platforms for FinTech, business management, marketing, and more.')
@section('canonical_url', route('saas.index'))
@if(request()->filled('category') || request()->filled('search'))
@section('robots', 'noindex, follow')
@endif
@section('og_title', 'SaaS Products | Creavibe')
@section('og_description', 'Scalable SaaS products and software applications built by Creavibe for businesses worldwide.')
@section('twitter_title', 'SaaS Products | Creavibe')
@section('twitter_description', 'SaaS products and software applications by Creavibe.')

@section('main-content')
<main id="main-content">
    @include('frontend.partials.breadcrumb', ['crumbs' => [
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'SaaS Products'],
    ]])

    <section class="page-hero" aria-labelledby="saas-index-heading">
        <div class="container">
            <span class="page-hero-eyebrow">Software Products</span>
            <h1 id="saas-index-heading">SaaS Products by Creavibe</h1>
            <p class="lead">Scalable, production-ready software products built for real business needs.</p>
        </div>
    </section>

    <section class="page-section" aria-label="SaaS products listing">
        <div class="container">
            @if($categories->isNotEmpty())
            <nav class="filter-bar" aria-label="Filter by category">
                <a href="{{ route('saas.index') }}"
                   class="filter-btn {{ !request('category') ? 'active' : '' }}">All</a>
                @foreach($categories as $cat)
                <a href="{{ route('saas.index', ['category' => $cat]) }}"
                   class="filter-btn {{ request('category') === $cat ? 'active' : '' }}">{{ $cat }}</a>
                @endforeach
            </nav>
            @endif

            @if($products->isEmpty())
            <div class="empty-state text-center">
                <i class="fas fa-rocket" style="font-size:3rem;color:var(--primary);margin-bottom:1rem;" aria-hidden="true"></i>
                <h2>Products Coming Soon</h2>
                <p>SaaS products are being prepared for launch.</p>
                <a href="{{ route('contact') }}" class="btn btn-outline" style="margin-top:16px;">Get Early Access</a>
            </div>
            @else
            <div class="projects-grid">
                @foreach($products as $product)
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
                        <p>{{ $product->tagline ?: \Illuminate\Support\Str::limit($product->overview, 140) }}</p>
                        @if(!empty($product->tech_stack))
                        <div class="project-tags">
                            @foreach(array_slice($product->tech_stack, 0, 4) as $tech)
                                <span class="project-tag">{{ $tech }}</span>
                            @endforeach
                        </div>
                        @endif
                        <span class="project-card-link">View Product <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                    </div>
                </a>
                @endforeach
            </div>
            <div style="margin-top:40px;">{{ $products->links() }}</div>
            @endif
        </div>
    </section>

    <section class="page-section saas-final-cta" aria-label="Build your SaaS CTA">
        <div class="container text-center">
            <h2>Building a SaaS product?</h2>
            <p>Creavibe specialises in SaaS architecture, development, and launch.</p>
            <a href="{{ route('services.show', 'saas-development') }}" class="btn">SaaS Development Services</a>
        </div>
    </section>
</main>
@endsection
