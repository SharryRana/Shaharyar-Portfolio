@extends('frontend.layouts.master')

@section('title', 'Software Engineering Services | Creavibe')
@section('meta_description', 'Creavibe offers expert software engineering services: backend development, full-stack development, SaaS development, API development, and FinTech systems.')
@section('canonical_url', route('services.index'))
@section('og_title', 'Software Engineering Services | Creavibe')
@section('og_description', 'Expert software engineering services: backend, full-stack, SaaS, API, and FinTech development.')
@section('twitter_title', 'Services | Creavibe')
@section('twitter_description', 'Software engineering services: backend, SaaS, FinTech, and API development.')

@section('main-content')
<main id="main-content">
    @include('frontend.partials.breadcrumb', ['crumbs' => [
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Services'],
    ]])

    {{-- ─── HERO ─────────────────────────────────────────────── --}}
    <section class="svc-index-hero" aria-labelledby="services-heading">
        <div class="container">
            <span class="page-hero-eyebrow"><i class="fas fa-bolt" aria-hidden="true"></i> &nbsp;What We Build</span>
            <h1 id="services-heading">Production-Ready Engineering Services</h1>
            <p class="lead">From backend APIs to complete SaaS products every engagement is scoped, architected, and delivered with clean code and measurable results.</p>
            <div class="svc-hero-actions">
                <a href="{{ route('contact') }}" class="btn">Start a Project</a>
                <a href="{{ route('saas.index') }}" class="btn btn-outline">View SaaS Products</a>
            </div>
        </div>
    </section>

    {{-- ─── TRUST STRIP ───────────────────────────────────────── --}}
    <div class="svc-trust-strip">
        <div class="container">
            <div class="svc-trust-row">
                <div class="svc-trust-item">
                    <i class="fas fa-check-circle" aria-hidden="true"></i>
                    <span>Clean Architecture</span>
                </div>
                <div class="svc-trust-item">
                    <i class="fas fa-check-circle" aria-hidden="true"></i>
                    <span>100% Remote Delivery</span>
                </div>
                <div class="svc-trust-item">
                    <i class="fas fa-check-circle" aria-hidden="true"></i>
                    <span>Scalable by Design</span>
                </div>
                <div class="svc-trust-item">
                    <i class="fas fa-check-circle" aria-hidden="true"></i>
                    <span>5+ Years Experience</span>
                </div>
                <div class="svc-trust-item">
                    <i class="fas fa-check-circle" aria-hidden="true"></i>
                    <span>Full-Cycle Delivery</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ─── SERVICE CARDS ──────────────────────────────────────── --}}
    <section class="page-section" aria-label="Services listing">
        <div class="container">
            <div class="section-header-centered">
                <h2>Core Capabilities</h2>
                <p>Every service is backed by real production experience not just theoretical knowledge.</p>
            </div>

            @php
            $servicesData = $services->isEmpty() ? collect([
                (object)['icon'=>'fas fa-server',           'name'=>'Backend Development',    'short_description'=>'Scalable, production-ready backend systems with Go, Laravel, Node.js, and PostgreSQL.', 'slug'=>'backend-development',    'skill_label'=>'Core Service'],
                (object)['icon'=>'fas fa-laptop-code',      'name'=>'Full-Stack Development', 'short_description'=>'End-to-end web application development using Vue.js, React, Laravel, and Go.',            'slug'=>'full-stack-development',  'skill_label'=>'Core Service'],
                (object)['icon'=>'fas fa-layer-group',      'name'=>'SaaS Development',       'short_description'=>'Complete SaaS MVP development multi-tenant architecture, auth, billing, dashboards.',    'slug'=>'saas-development',        'skill_label'=>'Specialization'],
                (object)['icon'=>'fas fa-plug',             'name'=>'API Development',         'short_description'=>'Clean, well-documented REST & GraphQL APIs. Performance-optimized and secure by default.', 'slug'=>'api-development',         'skill_label'=>'Core Service'],
                (object)['icon'=>'fas fa-building-columns', 'name'=>'FinTech Development',    'short_description'=>'Financial systems, payment integrations, transaction engines, and compliance dashboards.',   'slug'=>'fintech-development',     'skill_label'=>'Specialization'],
            ]) : $services;
            @endphp

            <div class="svc-cards-grid">
                @foreach($servicesData as $svc)
                <article class="svc-card">
                    <div class="svc-card-inner">
                        <div class="svc-card-top">
                            <div class="svc-card-icon">
                                <i class="{{ $svc->icon ?? 'fas fa-code' }}" aria-hidden="true"></i>
                            </div>
                            @if(isset($svc->skill_label))
                            <span class="svc-card-label">{{ $svc->skill_label }}</span>
                            @endif
                        </div>
                        <h3 class="svc-card-title">{{ $svc->name }}</h3>
                        <p class="svc-card-desc">{{ $svc->short_description }}</p>
                        <a href="{{ route('services.show', $svc->slug) }}" class="svc-card-link" aria-label="Learn more about {{ $svc->name }}">
                            Learn more <i class="fas fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─── PROCESS STRIP ──────────────────────────────────────── --}}
    <section class="svc-process-strip services-section-bg" aria-label="How we work">
        <div class="container">
            <div class="section-header-centered">
                <h2>How Every Engagement Works</h2>
                <p>A consistent, transparent process from first call to production deploy.</p>
            </div>
            <div class="svc-process-row">
                <div class="svc-process-step">
                    <div class="svc-process-num">01</div>
                    <h4>Discovery Call</h4>
                    <p>We align on goals, constraints, tech choices, and timelines before writing a single line of code.</p>
                </div>
                <div class="svc-process-connector" aria-hidden="true"><i class="fas fa-chevron-right"></i></div>
                <div class="svc-process-step">
                    <div class="svc-process-num">02</div>
                    <h4>Architecture & Scope</h4>
                    <p>A clear technical plan, stack decision, and milestone breakdown delivered before work begins.</p>
                </div>
                <div class="svc-process-connector" aria-hidden="true"><i class="fas fa-chevron-right"></i></div>
                <div class="svc-process-step">
                    <div class="svc-process-num">03</div>
                    <h4>Build & Iterate</h4>
                    <p>Async-first development with regular demos, PR reviews, and transparent progress updates.</p>
                </div>
                <div class="svc-process-connector" aria-hidden="true"><i class="fas fa-chevron-right"></i></div>
                <div class="svc-process-step">
                    <div class="svc-process-num">04</div>
                    <h4>Deploy & Handoff</h4>
                    <p>CI/CD setup, documentation, and a smooth handoff everything you need to own it confidently.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ─── TECH STACK ─────────────────────────────────────────── --}}
    <section class="page-section" aria-label="Technology stack">
        <div class="container">
            <div class="section-header-centered">
                <h2>Technologies I Work With</h2>
                <p>Battle-tested tools chosen for performance, maintainability, and scalability.</p>
            </div>
            <div class="svc-tech-categories">
                <div class="svc-tech-group">
                    <h4 class="svc-tech-group-label"><i class="fas fa-server" aria-hidden="true"></i> Backend</h4>
                    <div class="svc-tech-chips">
                        <span class="svc-tech-chip">Laravel</span>
                        <span class="svc-tech-chip">Go (Golang)</span>
                        <span class="svc-tech-chip">Node.js</span>
                        <span class="svc-tech-chip">PHP 8.x</span>
                    </div>
                </div>
                <div class="svc-tech-group">
                    <h4 class="svc-tech-group-label"><i class="fas fa-laptop-code" aria-hidden="true"></i> Frontend</h4>
                    <div class="svc-tech-chips">
                        <span class="svc-tech-chip">Vue.js</span>
                        <span class="svc-tech-chip">React</span>
                        <span class="svc-tech-chip">Inertia.js</span>
                        <span class="svc-tech-chip">Tailwind CSS</span>
                    </div>
                </div>
                <div class="svc-tech-group">
                    <h4 class="svc-tech-group-label"><i class="fas fa-database" aria-hidden="true"></i> Database</h4>
                    <div class="svc-tech-chips">
                        <span class="svc-tech-chip">PostgreSQL</span>
                        <span class="svc-tech-chip">MySQL</span>
                        <span class="svc-tech-chip">Redis</span>
                        <span class="svc-tech-chip">MongoDB</span>
                    </div>
                </div>
                <div class="svc-tech-group">
                    <h4 class="svc-tech-group-label"><i class="fas fa-cloud" aria-hidden="true"></i> DevOps</h4>
                    <div class="svc-tech-chips">
                        <span class="svc-tech-chip">Docker</span>
                        <span class="svc-tech-chip">GitHub Actions</span>
                        <span class="svc-tech-chip">AWS / DigitalOcean</span>
                        <span class="svc-tech-chip">Nginx</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ─── CTA ────────────────────────────────────────────────── --}}
    <section class="page-section saas-final-cta" aria-label="Start a project CTA">
        <div class="container text-center">
            <h2>Have a project in mind?</h2>
            <p>Let's talk requirements, timeline, and the best tech approach for your goals.</p>
            <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin-top:28px;">
                <a href="{{ route('contact') }}" class="btn">Start a Conversation</a>
                <a href="{{ route('about') }}" class="btn btn-outline">About Shaharyar</a>
            </div>
        </div>
    </section>
</main>
@endsection
