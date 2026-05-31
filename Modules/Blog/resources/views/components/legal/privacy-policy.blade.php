@props(['page' => null])

<x-blog::legal.hero title="Privacy Policy" subtitle="Last update: 24 May 2026" />

<section class="mx-auto max-w-[1500px] px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
    <article class="rounded-lg border border-[#E8E6EE] bg-white px-5 py-6 text-sm font-semibold leading-relaxed text-[#686677] shadow-sm sm:px-8 lg:px-9 lg:py-10 lg:text-[15px]">
        <div class="legal-content">
            @if($page)
                {!! $page->content !!}
            @else
                <h2>Privacy Policy</h2>
                <p>Privacy Policy content is not available right now.</p>
            @endif
        </div>
    </article>
</section>
