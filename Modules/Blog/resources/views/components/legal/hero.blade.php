@props(['eyebrow' => null, 'title', 'subtitle' => null])

<section class="pt-24 lg:pt-32">
    <div class="mx-auto max-w-[1500px] px-4 sm:px-6 lg:px-8">
        <div class="relative isolate flex min-h-[190px] items-center justify-center overflow-hidden rounded-[16px] bg-[#F3752F] px-6 py-12 text-center text-white sm:min-h-[250px] lg:min-h-[300px] lg:rounded-[22px]">
            <div class="pointer-events-none absolute inset-0 overflow-hidden">
                <x-blog::shared.hero-pattern side="left"
                    class="absolute left-0 top-0 h-[150px] w-auto max-w-none sm:h-[210px] lg:bottom-0 lg:top-auto lg:h-[333px] lg:w-[402px]" />
                <x-blog::shared.hero-pattern side="right"
                    class="absolute bottom-0 right-0 h-[150px] w-auto max-w-none sm:h-[210px] lg:h-[333px] lg:w-[401px]" />
            </div>

            <div class="relative z-10">
                @if ($eyebrow)
                    <p class="mb-4 text-sm font-extrabold text-white lg:text-lg">{{ $eyebrow }}</p>
                @endif
                <h1 class="text-[31px] font-extrabold leading-tight sm:text-5xl lg:text-[46px]">{{ $title }}</h1>
                @if ($subtitle)
                    <p class="mt-5 text-sm font-bold lg:text-base">{{ $subtitle }}</p>
                @endif
            </div>
        </div>
    </div>
</section>
