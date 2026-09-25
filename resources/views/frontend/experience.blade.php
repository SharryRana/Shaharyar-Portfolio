@extends('frontend.layouts.master')

@section('title', 'Professional Experience | Creavibe')
@section('meta_description', 'Professional experience of Creavibe\'s founder Shaharyar  full-stack software engineer specializing in SaaS, FinTech, and enterprise web application development.')
@section('canonical_url', route('experience'))
@section('og_title', 'Professional Experience | Creavibe')
@section('og_description', 'Full-stack software engineering experience across SaaS, FinTech, and enterprise application development.')
@section('twitter_title', 'Professional Experience | Creavibe')
@section('twitter_description', 'Software engineering experience: SaaS, FinTech, and enterprise applications.')

@section('main-content')
<main id="main-content">
    @include('frontend.partials.breadcrumb', ['crumbs' => [
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Experience'],
    ]])

    <section class="page-hero" aria-labelledby="exp-heading">
        <div class="container">
            <span class="page-hero-eyebrow">Work History</span>
            <h1 id="exp-heading">Professional Experience</h1>
            <p class="lead">5+ years building production software across SaaS, FinTech, and enterprise domains.</p>
        </div>
    </section>

    <section class="page-section" aria-label="Experience timeline">
        <div class="container">
            @if($experiences->isEmpty())
            <div class="empty-state text-center">
                <i class="fas fa-briefcase" style="font-size:3rem;color:var(--primary);margin-bottom:1rem;" aria-hidden="true"></i>
                <h2>Experience Coming Soon</h2>
                <p>Work history is being documented. Check back shortly.</p>
                <a href="{{ route('about') }}" class="btn btn-outline" style="margin-top:16px;">Learn About Creavibe</a>
            </div>
            @else
            <div class="experience-timeline">
                @foreach($experiences as $exp)
                <article class="experience-card">
                    <div class="experience-marker" aria-hidden="true"></div>
                    <div class="experience-content">
                        <div class="experience-header">
                            <div>
                                <h2 class="experience-role">{{ $exp->role }}</h2>
                                <div class="experience-company">
                                    @if($exp->company_url)
                                        <a href="{{ $exp->company_url }}" target="_blank" rel="noopener noreferrer">
                                            {{ $exp->company }}
                                        </a>
                                    @else
                                        <span>{{ $exp->company }}</span>
                                    @endif
                                    @if($exp->location)
                                        <span class="experience-location">
                                            <i class="fas fa-map-marker-alt" aria-hidden="true"></i>{{ $exp->location }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="experience-meta">
                                @if($exp->employment_type)
                                    <span class="experience-type">{{ $exp->employment_type }}</span>
                                @endif
                                <span class="experience-dates">
                                    {{ $exp->start_date->format('M Y') }}
                                    {{ $exp->is_current ? 'Present' : ($exp->end_date ? $exp->end_date->format('M Y') : '') }}
                                </span>
                                @if($exp->duration)
                                    <span class="experience-duration">({{ $exp->duration }})</span>
                                @endif
                            </div>
                        </div>

                        @if($exp->description)
                            <p class="experience-description">{{ $exp->description }}</p>
                        @endif

                        @if(!empty($exp->highlights))
                        <ul class="experience-highlights">
                            @foreach($exp->highlights as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                        @endif

                        @if(!empty($exp->technologies))
                        <div class="project-tags" style="margin-top:12px;">
                            @foreach($exp->technologies as $tech)
                                <span class="project-tag">{{ $tech }}</span>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </article>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    <section class="page-section saas-final-cta" aria-label="Hire CTA">
        <div class="container text-center">
            <h2>Looking to work with Creavibe?</h2>
            <p>Available for new projects, consulting, and partnerships.</p>
            <a href="{{ route('contact') }}" class="btn">Start a Conversation</a>
        </div>
    </section>
</main>
@endsection
