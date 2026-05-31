@php
    $categories = [
        'Business & Finance',
        'Technology',
        'Marketing & SEO',
        'Health & Medicine',
        'Crypto',
        'Real Estate',
        'Fashion',
        'Education',
        'Entertainment',
        'Web Development',
        'Software',
        'News & Media',
        'Mobile Technology',
        'And many more',
    ];

    $registrations = [
        [
            'country' => 'United States',
            'flagAsset' => 'us.svg',
            'fields' => [
                ['label' => 'Company Name', 'value' => 'PUBWHIZZ LLC'],
                ['label' => 'Original ID', 'value' => '2025-001825149'],
                ['label' => 'Registered Address', 'value' => '30 N Gould St Ste R, Sheridan, WY 82801, USA'],
            ],
        ],
        [
            'country' => 'United Kingdom',
            'flagAsset' => 'uk.svg',
            'fields' => [
                ['label' => 'Company Name', 'value' => 'PUBWHIZZ LTD'],
                ['label' => 'Company Number', 'value' => '17044408'],
                ['label' => 'Registered Address', 'value' => 'Office 867, 85 Dunstall Hill, Wolverhampton, WV6 0SR'],
            ],
        ],
        [
            'country' => 'Pakistan',
            'flagAsset' => 'pk.svg',
            'fields' => [
                ['label' => 'Company Name', 'value' => 'PUBWHIZZ MEDIA (SMC-PRIVATE) LIMITED'],
                ['label' => 'CUIN', 'value' => '0289470'],
                ['label' => 'Registered Address', 'value' => 'Chak No. 19/9-R, Kacha Khuh, Khanewal, Punjab'],
            ],
        ],
    ];
@endphp

<div class="bg-white pt-20 lg:pt-24">
    <section class="mx-auto max-w-[1500px] px-4 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-[22px] bg-[#FFF4EE] px-5 py-8 sm:px-9 lg:min-h-[930px] lg:px-10 lg:py-10 xl:min-h-[960px]">
            <div class="relative z-10 max-w-[650px]">
                <span class="inline-flex rounded-full bg-white px-5 py-2 text-sm font-semibold text-[#F3752F]">About Pubwhizz</span>
                <h1 class="mt-5 text-[34px] font-extrabold leading-tight tracking-normal text-[#1C1412] sm:text-5xl lg:text-[48px]">
                    What Is <span class="relative inline-block px-2 py-1 text-[#F3752F]">
                        <span
                            class="absolute inset-0 rounded-xl border-[1.5px] border-[#F3752F] rotate-[-3deg] origin-center pointer-events-none"></span>
                        <span
                            class="absolute inset-0 rounded-xl border-[1.5px] border-[#F3752F] pointer-events-none"></span>
                        <span class="relative z-10">PubWhizz?</span>
                    </span>
                </h1>

                <div class="mt-6 space-y-6 text-[15px] font-medium leading-relaxed text-[#1C1412] sm:text-base">
                    <p>PubWhizz (pubwhizz.com) is a digital PR and link building platform that helps businesses publish content on high-quality websites to improve SEO, brand authority, and online visibility.</p>
                    <p>We make content publication simple by connecting brands, agencies, and marketers with trusted publishers across multiple industries and niches.</p>
                    <p>Whether you want to build authority backlinks, improve keyword rankings, promote your business, or scale outreach campaigns, PubWhizz provides a streamlined solution for acquiring contextual and niche-relevant placements.</p>
                    <div>
                        <p>Our platform supports content publication opportunities in categories including:</p>
                        <ul class="mt-1 list-disc pl-5 text-[14px] leading-snug sm:text-[15px]">
                            @foreach ($categories as $category)
                                <li>{{ $category }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <p class="text-[13px] font-semibold text-[#8F8A9B]">Unlike low-quality backlink marketplaces, PubWhizz focuses on real websites, manual quality control, and long-term SEO value.</p>
                </div>
            </div>

            <div class="relative -mx-5 -mb-8 mt-8 h-[260px] overflow-hidden sm:-mx-9 lg:hidden">
                <img src="{{ asset('assets/img/top_hero_mobile.svg') }}" alt="PubWhizz website category cards"
                    class="absolute bottom-0 left-0 h-[275px] w-auto max-w-none">
                <img src="{{ asset('assets/img/middle_hero_mobile.svg') }}" alt="PubWhizz publisher categories"
                    class="absolute bottom-0 -left-2 h-[275px] w-auto max-w-none">
                <img src="{{ asset('assets/img/bottom_hero_mobile.svg') }}" alt="PubWhizz additional content categories"
                    class="absolute bottom-0 left-[150px] h-[262px] w-auto max-w-none">
                <div
                    class="pointer-events-none absolute inset-x-0 top-0 h-12 bg-gradient-to-b from-[#FFF4EE] to-[#FFF4EE]/0">
                </div>
                <div
                    class="pointer-events-none absolute inset-x-0 bottom-0 h-10 bg-gradient-to-t from-[#FFF4EE] to-[#FFF4EE]/0">
                </div>
            </div>

            <div
                class="pointer-events-none absolute -right-4 bottom-0 top-0 mt-0 hidden w-[720px] items-start justify-end gap-0 lg:flex xl:-right-2">
                <img src="{{ asset('assets/img/top_hero_img.svg') }}" alt="PubWhizz website category cards"
                    class="h-auto w-full lg:h-[930px] lg:w-auto lg:max-w-none xl:h-[960px]">
                <img src="{{ asset('assets/img/middle_hero_img.svg') }}" alt="PubWhizz publisher categories"
                    class="h-auto w-full lg:-ml-[265px] lg:h-[930px] lg:w-auto lg:max-w-none xl:-ml-[272px] xl:h-[960px]">
                <img src="{{ asset('assets/img/bottom_hero_img.svg') }}" alt="PubWhizz additional content categories"
                    class="h-auto w-full lg:mt-auto lg:-ml-[170px] lg:h-[632px] lg:w-auto lg:max-w-none xl:-ml-[176px] xl:h-[652px]">
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-[760px] px-4 py-16 text-center sm:px-6 lg:py-24">
        <h2 class="text-[26px] font-extrabold leading-tight text-[#1C1412] sm:text-[34px]">Content Publication Made Easy</h2>
        <p class="mx-auto mt-5 max-w-[620px] text-sm font-medium leading-relaxed text-[#686677] sm:text-base">
            From guest posting and editorial placements to authority backlinks and digital PR campaigns, PubWhizz helps businesses grow through smarter and safer SEO strategies.
            <span class="block">Built for agencies, SEO professionals, and growing brands that need safer, scalable, and results-driven link building.</span>
        </p>
    </section>

    <section class="mx-auto max-w-[1500px] px-4 pb-14 sm:px-6 lg:px-8 lg:pb-24">
        <div class="mb-6 overflow-hidden text-[#E97A37]">
            <svg class="h-12 w-full sm:h-[65px]" viewBox="0 0 1324 65" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" aria-hidden="true">
                <path d="M0 64.4999L270.854 64.4999C300.439 64.4999 329.511 56.7793 355.198 42.1013L388.802 22.8986C414.489 8.22054 443.561 0.499927 473.146 0.499932L830.854 0.499994C860.439 0.499999 889.511 8.22062 915.198 22.8987L948.802 42.1014C974.489 56.7794 1003.56 64.5001 1033.15 64.5001L1324 64.5001" stroke="currentColor"/>
            </svg>
        </div>

        <div class="text-center">
            <h2 class="text-[28px] font-extrabold leading-tight text-[#1C1412] sm:text-[36px]">Global Company Registration</h2>
            <p class="mx-auto mt-4 max-w-[760px] text-sm font-medium leading-relaxed text-[#686677] sm:text-base">
                PubWhizz operates through registered business entities across the United States, United Kingdom, and Pakistan, strengthening international credibility, operational transparency, and trust with clients, agencies, publishers, and partners worldwide.
            </p>
        </div>

        <div class="mt-12 grid gap-5 lg:grid-cols-3">
            @foreach ($registrations as $registration)
                <article class="rounded-[18px] border border-[#EFE5DE] bg-white px-7 py-8 shadow-[0_18px_50px_rgba(28,20,18,0.04)]">
                    <div class="flex items-center gap-5">
                        <img src="{{ asset('assets/img/flags/' . $registration['flagAsset']) }}"
                            alt="{{ $registration['country'] }} flag" class="h-10 w-10 rounded-full object-cover">
                        <h3 class="text-[22px] font-extrabold text-[#1C1412]">{{ $registration['country'] }}</h3>
                    </div>
                    <div class="mt-8 space-y-5">
                        @foreach ($registration['fields'] as $field)
                            <div>
                                <p class="text-[13px] font-extrabold text-[#1C1412]">{{ $field['label'] }}</p>
                                <p class="mt-1 text-[13px] font-semibold leading-relaxed text-[#686677]">{{ $field['value'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-8 text-right text-sm font-semibold text-[#686677] sm:text-base">
            CEO / Organizer: <span class="ml-3 font-extrabold text-[#1C1412]">Safdar Ali</span>
        </div>

        <div class="mt-6 overflow-hidden text-[#E97A37]">
            <svg class="h-12 w-full sm:h-[65px]" viewBox="0 0 1324 65" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" aria-hidden="true">
                <path d="M0 0.500087L270.854 0.500111C300.439 0.500113 329.511 8.22068 355.198 22.8987L388.802 42.1014C414.489 56.7794 443.561 64.4999 473.146 64.4999L830.854 64.4999C860.439 64.4999 889.511 56.7794 915.198 42.1014L948.802 22.8987C974.489 8.22066 1003.56 0.500115 1033.15 0.500115L1324 0.500116" stroke="currentColor"/>
            </svg>
        </div>
    </section>

    <section class="mx-auto max-w-[1500px] px-4 py-10 sm:px-6 lg:px-8 lg:py-20">
        <div class="rounded-[22px] bg-[#F3752F] px-5 py-12 text-center text-white sm:px-8 lg:py-20">
            <h2 class="hidden text-[38px] font-extrabold leading-tight lg:block">Ready To Grow Your Brand Authority?</h2>
            <h2 class="text-[32px] font-extrabold leading-tight lg:hidden">Ready To Get Started?</h2>
            <p class="mx-auto mt-5 max-w-[560px] text-sm font-medium leading-relaxed text-white/90">
                Explore quality publishers and start building high-value backlinks with PubWhizz.
            </p>
            <a href="#" class="mt-8 inline-flex h-12 min-w-40 items-center justify-center gap-2 rounded-[5px] bg-white px-6 text-sm font-bold text-[#F3752F] transition hover:bg-[#FFF1E8]">
                <span class="hidden lg:inline">Get Started</span>
                <span class="lg:hidden">Start as Advertiser</span>
                <span aria-hidden="true">-></span>
            </a>
        </div>
    </section>
</div>
