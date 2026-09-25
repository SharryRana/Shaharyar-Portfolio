@extends('frontend.layouts.master')

@section('title', 'Frequently Asked Questions (FAQs) | Creavibe')
@section('meta_description', 'Find answers to common questions about Creavibe software engineering services, SaaS development process, pricing, tech stack, and project delivery.')
@section('canonical_url', route('faqs'))
@section('og_title', 'Frequently Asked Questions (FAQs) | Creavibe')
@section('og_description', 'Common questions about Creavibe software development services, SaaS products, tech stack, and client collaboration.')
@section('twitter_title', 'Frequently Asked Questions | Creavibe')
@section('twitter_description', 'Answers to common questions about Creavibe services and SaaS development.')

@push('head')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
        {
            "@@type": "Question",
            "name": "What technologies does Creavibe specialize in?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Creavibe specializes in Go (Golang) and Laravel for backend development, PostgreSQL and Redis for databases, Vue.js and React for frontend SPAs, and Docker for containerized deployment."
            }
        },
        {
            "@@type": "Question",
            "name": "How does Creavibe handle project development and communication?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "We follow agile development practices with regular milestone updates, asynchronous communication via Slack or email, Git version control, and clear documentation throughout the project lifecycle."
            }
        },
        {
            "@@type": "Question",
            "name": "Who owns the source code upon project completion?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "You own 100% of the custom source code, database schemas, and intellectual property developed for your project upon final delivery."
            }
        },
        {
            "@@type": "Question",
            "name": "Can Creavibe build multi-tenant SaaS applications?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Yes, SaaS architecture is one of Creavibe's primary core specialties  including multi-tenancy models, Stripe billing integrations, usage metering, and team management."
            }
        }
    ]
}
</script>
<style>
    .faq-accordion { display: flex; flex-direction: column; gap: 14px; margin-top: 24px; }
    .faq-item { background: var(--card-bg); border: 1px solid var(--card-border); border-radius: 12px; overflow: hidden; transition: all 0.25s ease; }
    .faq-item summary { padding: 18px 24px; font-weight: 600; font-size: 1.05rem; cursor: pointer; color: var(--light); display: flex; justify-content: space-between; align-items: center; list-style: none; }
    .faq-item summary::-webkit-details-marker { display: none; }
    .faq-item summary::after { content: '\f078'; font-family: 'Font Awesome 6 Free'; font-weight: 900; font-size: 0.85rem; color: var(--primary); transition: transform 0.25s ease; }
    .faq-item[open] summary::after { transform: rotate(180deg); }
    .faq-answer { padding: 0 24px 20px; color: var(--gray-light); font-size: 0.95rem; line-height: 1.7; border-top: 1px solid rgba(148, 163, 184, 0.08); margin-top: 10px; padding-top: 16px; }
    .faq-category-title { font-size: 1.4rem; margin-top: 40px; margin-bottom: 16px; color: var(--primary); border-bottom: 1px solid var(--card-border); padding-bottom: 10px; }
</style>
@endpush

@section('main-content')
<main id="main-content">
    @include('frontend.partials.breadcrumb', ['crumbs' => [
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'FAQs']
    ]])

    <section class="page-hero" aria-labelledby="faqs-heading">
        <div class="container">
            <span class="page-hero-eyebrow">Help &amp; Information</span>
            <h1 id="faqs-heading">Frequently Asked Questions</h1>
            <p class="lead">Find answers to common questions about working with Creavibe, our software engineering services, and SaaS development.</p>
        </div>
    </section>

    <section class="page-section" aria-label="FAQ sections">
        <div class="container" style="max-width: 860px;">

            {{-- General Creavibe FAQs --}}
            <h2 class="faq-category-title"><i class="fas fa-cubes" aria-hidden="true"></i> General &amp; Working Process</h2>
            <div class="faq-accordion">
                <details class="faq-item" open>
                    <summary>What technologies does Creavibe specialize in?</summary>
                    <div class="faq-answer">
                        We focus on core modern backend technologies: <strong>Go (Golang)</strong> for high-throughput microservices, <strong>Laravel</strong> for robust web backends, <strong>PostgreSQL</strong> for primary data storage, <strong>Redis</strong> for caching, and <strong>Vue.js / React</strong> for modern frontend user interfaces.
                    </div>
                </details>

                <details class="faq-item">
                    <summary>How does project engagement and communication work?</summary>
                    <div class="faq-answer">
                        We work asynchronously and remotely with clients worldwide. Communication is managed through Slack, email, or scheduled video consultations. Code is tracked in Git, and milestone progress is demonstrated on staging environments.
                    </div>
                </details>

                <details class="faq-item">
                    <summary>Who owns the intellectual property and source code?</summary>
                    <div class="faq-answer">
                        You retain 100% ownership of all custom source code, database architectures, and digital assets developed for your project upon final completion and handover.
                    </div>
                </details>

                <details class="faq-item">
                    <summary>Do you offer ongoing software maintenance and support?</summary>
                    <div class="faq-answer">
                        Yes, we provide ongoing maintenance, performance optimization, feature extensions, and infrastructure management agreements for production software.
                    </div>
                </details>
            </div>

            {{-- SaaS Product FAQs if present --}}
            @if(($saasProductsWithFaqs ?? collect())->isNotEmpty())
                <h2 class="faq-category-title"><i class="fas fa-layer-group" aria-hidden="true"></i> SaaS Products FAQs</h2>
                @foreach($saasProductsWithFaqs as $product)
                    <h3 style="font-size: 1.1rem; color: var(--light); margin-top: 24px;">{{ $product->title }}</h3>
                    <div class="faq-accordion">
                        @foreach($product->faqs as $faq)
                            <details class="faq-item">
                                <summary>{{ $faq->question }}</summary>
                                <div class="faq-answer">{{ $faq->answer }}</div>
                            </details>
                        @endforeach
                    </div>
                @endforeach
            @endif

            {{-- Service FAQs if present --}}
            @if(($servicesWithFaqs ?? collect())->isNotEmpty())
                <h2 class="faq-category-title"><i class="fas fa-briefcase" aria-hidden="true"></i> Software Services FAQs</h2>
                @foreach($servicesWithFaqs as $service)
                    <h3 style="font-size: 1.1rem; color: var(--light); margin-top: 24px;">{{ $service->name }}</h3>
                    <div class="faq-accordion">
                        @foreach($service->faqs as $faq)
                            <details class="faq-item">
                                <summary>{{ $faq->question }}</summary>
                                <div class="faq-answer">{{ $faq->answer }}</div>
                            </details>
                        @endforeach
                    </div>
                @endforeach
            @endif

        </div>
    </section>

    <section class="page-section saas-final-cta" aria-label="Still have questions CTA">
        <div class="container text-center">
            <h2>Have a question not answered here?</h2>
            <p>Feel free to reach out directly to discuss your project requirements.</p>
            <a href="{{ route('contact') }}" class="btn" style="margin-top: 14px;">Contact Us</a>
        </div>
    </section>
</main>
@endsection
