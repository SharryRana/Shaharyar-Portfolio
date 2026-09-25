@extends('frontend.layouts.master')

@section('title', 'Technology Stack & Skills | Creavibe')
@section('meta_description', 'Creavibe\'s full technology stack  Go, Laravel, Vue.js, React, PostgreSQL, Node.js, Docker, and more. Expert software engineering for SaaS, FinTech, and web applications.')
@section('canonical_url', route('skills'))
@section('og_title', 'Technology Stack | Creavibe')
@section('og_description', 'Full technical expertise: Go, Laravel, Vue.js, React, PostgreSQL, Node.js, and more.')
@section('twitter_title', 'Technology Stack | Creavibe')
@section('twitter_description', 'Full technical expertise: Go, Laravel, Vue.js, React, PostgreSQL, and more.')

@section('main-content')
<main id="main-content">
    @include('frontend.partials.breadcrumb', ['crumbs' => [
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Technology Stack'],
    ]])

    <section class="page-hero" aria-labelledby="skills-heading">
        <div class="container">
            <span class="page-hero-eyebrow">Technical Expertise</span>
            <h1 id="skills-heading">Technology Stack & Skills</h1>
            <p class="lead">The tools and technologies Creavibe uses to build scalable, production-ready software.</p>
        </div>
    </section>

    @if($skills->isNotEmpty())
    <section class="page-section" aria-label="Skills by category">
        <div class="container">
            @php $grouped = $skills->groupBy('label') @endphp
            @foreach($grouped as $group => $groupSkills)
                @if($group)
                <h2 class="skills-group-heading" id="group-{{ \Illuminate\Support\Str::slug($group) }}">
                    {{ $group }}
                </h2>
                @endif
                <div class="skills-grid" style="margin-top:24px;margin-bottom:60px;">
                    @foreach($groupSkills as $skill)
                    <div class="skill-card">
                        <div class="skill-icon">
                            <i class="{{ $skill->icon ?: 'fas fa-code' }}" aria-hidden="true"></i>
                        </div>
                        @if($skill->label)
                            <span class="skill-label">{{ $skill->label }}</span>
                        @endif
                        <h3>{{ $skill->title }}</h3>
                        <p>{{ $skill->description }}</p>
                    </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>
    @endif

    <section class="page-section saas-final-cta" aria-label="Work together CTA">
        <div class="container text-center">
            <h2>Need a specific technology?</h2>
            <p>Let's discuss your project requirements and find the best technical approach.</p>
            <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('services.index') }}" class="btn">View Services</a>
                <a href="{{ route('contact') }}" class="btn btn-outline">Get in Touch</a>
            </div>
        </div>
    </section>
</main>
@endsection
