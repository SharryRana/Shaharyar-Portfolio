@extends('frontend.layouts.master')

@section('title', 'Projects & Case Studies | Creavibe')
@section('meta_description', 'Engineering projects and case studies by Creavibe  SaaS platforms, FinTech systems, CRM/ERP applications, and full-stack web development work.')
@section('canonical_url', route('projects.index'))
@if(request()->filled('type') || request()->filled('search'))
@section('robots', 'noindex, follow')
@endif
@section('og_title', 'Projects & Case Studies | Creavibe')
@section('og_description', 'Creavibe engineering projects: SaaS platforms, FinTech systems, CRM/ERP, and web applications.')
@section('twitter_title', 'Projects & Case Studies | Creavibe')
@section('twitter_description', 'Engineering projects: SaaS, FinTech, CRM/ERP, and web applications.')

@section('main-content')
<main id="main-content">
    @include('frontend.partials.breadcrumb', ['crumbs' => [
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Projects'],
    ]])

    <section class="page-hero" aria-labelledby="projects-heading">
        <div class="container">
            <span class="page-hero-eyebrow">Case Studies</span>
            <h1 id="projects-heading">Projects & Engineering Work</h1>
            <p class="lead">A selection of engineering projects, case studies, and technical work by Creavibe.</p>
        </div>
    </section>

    <section class="page-section" aria-label="Projects listing">
        <div class="container">
            @if($projectTypes->isNotEmpty())
            <nav class="filter-bar" aria-label="Filter by project type">
                <a href="{{ route('projects.index') }}"
                   class="filter-btn {{ !request('type') ? 'active' : '' }}">All</a>
                @foreach($projectTypes as $type)
                <a href="{{ route('projects.index', ['type' => $type]) }}"
                   class="filter-btn {{ request('type') === $type ? 'active' : '' }}">{{ $type }}</a>
                @endforeach
            </nav>
            @endif

            @if($projects->isEmpty())
            <div class="empty-state text-center">
                <i class="fas fa-folder-open" style="font-size:3rem;color:var(--primary);margin-bottom:1rem;" aria-hidden="true"></i>
                <h2>Projects Coming Soon</h2>
                <p>Case studies and project documentation are being prepared.</p>
                <a href="{{ route('saas.index') }}" class="btn btn-outline" style="margin-top:16px;">View SaaS Products</a>
            </div>
            @else
            <div class="projects-grid">
                @foreach($projects as $project)
                <a class="project-card saas-product-card" href="{{ route('projects.show', $project->slug) }}">
                    <div class="project-img">
                        @if($project->thumbnail)
                            <img src="{{ asset($project->thumbnail) }}"
                                 alt="{{ $project->thumbnail_alt ?: $project->title }}"
                                 loading="lazy"
                                 decoding="async">
                        @else
                            <i class="fas fa-diagram-project" aria-hidden="true"></i>
                        @endif
                    </div>
                    <div class="project-content">
                        @if($project->project_type)
                            <span class="project-category">{{ $project->project_type }}</span>
                        @endif
                        <h3>{{ $project->title }}</h3>
                        <p>{{ $project->summary ?: \Illuminate\Support\Str::limit($project->overview, 140) }}</p>
                        @if(!empty($project->tech_stack))
                        <div class="project-tags">
                            @foreach(array_slice($project->tech_stack, 0, 4) as $tech)
                                <span class="project-tag">{{ $tech }}</span>
                            @endforeach
                        </div>
                        @endif
                        <span class="project-card-link">View Case Study <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                    </div>
                </a>
                @endforeach
            </div>
            <div style="margin-top:40px;">{{ $projects->links() }}</div>
            @endif
        </div>
    </section>
</main>
@endsection
