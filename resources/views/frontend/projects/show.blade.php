@extends('frontend.layouts.master')

@section('title', ($project->meta_title ?: $project->title . ' | Case Study | Creavibe'))
@section('meta_description', $project->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($project->summary ?: $project->overview), 155))
@section('canonical_url', route('projects.show', $project->slug))
@section('og_title', $project->title . ' | Creavibe')
@section('og_description', $project->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($project->summary ?: $project->overview), 155))
@section('og_image', $project->og_image ? asset($project->og_image) : ($project->thumbnail ? asset($project->thumbnail) : asset('assets/og-image.png')))
@section('twitter_title', $project->title . ' | Creavibe')
@section('twitter_description', $project->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($project->summary ?: $project->overview), 155))

@push('head')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "CreativeWork",
    "name": @json($project->title),
    "description": @json($project->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($project->summary ?: $project->overview), 155)),
    "url": @json(route('projects.show', $project->slug)),
    @if($project->thumbnail)"image": @json(asset($project->thumbnail)),@endif
    "author": {
        "@@type": "Person",
        "name": "Shaharyar",
        "worksFor": { "@@type": "Organization", "name": "Creavibe" }
    }
}
</script>
@endpush

@section('main-content')
<main id="main-content">
    @include('frontend.partials.breadcrumb', ['crumbs' => [
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Projects', 'url' => route('projects.index')],
        ['label' => $project->title],
    ]])

    <section class="saas-detail-hero visible" aria-labelledby="proj-detail-heading">
        <div class="container saas-detail-hero-grid">
            <div>
                @if($project->project_type)
                    <span class="project-category">{{ $project->project_type }}</span>
                @endif
                <h1 id="proj-detail-heading">{{ $project->title }}</h1>
                @if($project->tagline)
                    <p class="saas-detail-lead">{{ $project->tagline }}</p>
                @endif
                @if($project->summary)
                    <p>{{ $project->summary }}</p>
                @endif
                <div class="saas-detail-actions">
                    @if($project->demo_url)
                        <a class="btn" href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer">
                            <i class="fas fa-external-link-alt" aria-hidden="true"></i> Live Demo
                        </a>
                    @endif
                    @if($project->github_url)
                        <a class="btn btn-outline" href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-github" aria-hidden="true"></i> GitHub
                        </a>
                    @endif
                </div>
            </div>
            @if($project->thumbnail)
            <div class="saas-detail-preview">
                <img src="{{ asset($project->thumbnail) }}"
                     alt="{{ $project->thumbnail_alt ?: $project->title }}"
                     loading="eager">
            </div>
            @endif
        </div>
    </section>

    @if($project->overview)
    <section class="page-section visible" aria-labelledby="overview-heading">
        <div class="container">
            <h2 id="overview-heading">Project Overview</h2>
            <p>{{ $project->overview }}</p>
        </div>
    </section>
    @endif

    @if($project->problem || $project->solution)
    <section class="visible saas-info-band" aria-label="Problem and solution">
        <div class="container saas-two-col">
            @if($project->problem)
            <div>
                <h2>The Problem</h2>
                <p>{{ $project->problem }}</p>
            </div>
            @endif
            @if($project->solution)
            <div>
                <h2>The Solution</h2>
                <p>{{ $project->solution }}</p>
            </div>
            @endif
        </div>
    </section>
    @endif

    @if($project->my_role || $project->architecture)
    <section class="page-section visible" aria-label="Role and architecture">
        <div class="container saas-two-col">
            @if($project->my_role)
            <div>
                <h2>My Role</h2>
                <p>{{ $project->my_role }}</p>
            </div>
            @endif
            @if($project->architecture)
            <div>
                <h2>Architecture</h2>
                <p>{{ $project->architecture }}</p>
            </div>
            @endif
        </div>
    </section>
    @endif

    @if(!empty($project->tech_stack))
    <section class="visible saas-info-band" aria-labelledby="tech-stack-heading">
        <div class="container">
            <h2 id="tech-stack-heading">Technology Stack</h2>
            <div class="project-tags" style="margin-top:16px;">
                @foreach($project->tech_stack as $tech)
                    <span class="project-tag">{{ $tech }}</span>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if($project->challenges)
    <section class="page-section visible" aria-labelledby="challenges-heading">
        <div class="container">
            <h2 id="challenges-heading">Technical Challenges</h2>
            <p>{{ $project->challenges }}</p>
        </div>
    </section>
    @endif

    @if($project->results)
    <section class="visible saas-info-band" aria-labelledby="results-heading">
        <div class="container">
            <h2 id="results-heading">Results & Outcomes</h2>
            <p>{{ $project->results }}</p>
            @if(!empty($project->highlights))
            <ul class="saas-check-list" style="margin-top:16px;">
                @foreach($project->highlights as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
            @endif
        </div>
    </section>
    @endif

    @if($project->screenshots->isNotEmpty())
    <section class="page-section visible" aria-labelledby="screenshots-heading">
        <div class="container">
            <h2 id="screenshots-heading">Screenshots</h2>
            <div class="saas-gallery">
                @foreach($project->screenshots as $shot)
                <button class="saas-gallery-item"
                        type="button"
                        data-lightbox-src="{{ asset($shot->image) }}"
                        aria-label="Open {{ $shot->title ?: $project->title }} screenshot">
                    <img src="{{ asset($shot->image) }}"
                         alt="{{ $shot->alt_text ?: $project->title }}"
                         loading="lazy"
                         decoding="async">
                    @if($shot->title)
                        <span>{{ $shot->title }}</span>
                    @endif
                </button>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if($related->isNotEmpty())
    <section class="page-section" aria-labelledby="related-heading">
        <div class="container">
            <h2 id="related-heading">Related Projects</h2>
            <div class="projects-grid">
                @foreach($related as $rel)
                <a class="project-card saas-product-card" href="{{ route('projects.show', $rel->slug) }}">
                    <div class="project-img">
                        @if($rel->thumbnail)
                            <img src="{{ asset($rel->thumbnail) }}"
                                 alt="{{ $rel->thumbnail_alt ?: $rel->title }}"
                                 loading="lazy"
                                 decoding="async">
                        @else
                            <i class="fas fa-diagram-project" aria-hidden="true"></i>
                        @endif
                    </div>
                    <div class="project-content">
                        <h3>{{ $rel->title }}</h3>
                        <p>{{ $rel->summary ?: \Illuminate\Support\Str::limit($rel->overview, 100) }}</p>
                        <span class="project-card-link">View Case Study <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section class="visible saas-final-cta">
        <div class="container text-center">
            <h2>Have a similar project in mind?</h2>
            <p>Let's discuss your requirements and build something exceptional.</p>
            <a class="btn" href="{{ route('contact') }}">Contact Creavibe</a>
        </div>
    </section>

    {{-- Lightbox (reuses existing JS from script.js) --}}
    <div class="saas-lightbox" id="saasLightbox" aria-hidden="true">
        <button type="button" aria-label="Close preview">&times;</button>
        <img src="" alt="Screenshot preview">
    </div>
</main>
@endsection
