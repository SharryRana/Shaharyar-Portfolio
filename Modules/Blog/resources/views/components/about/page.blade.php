@php
    $values = [
        [
            'title' => 'Clarity First',
            'copy' => 'We believe fees, processes, and promises should be plain from the start. No hidden layers.',
        ],
        [
            'title' => 'Real Relationships',
            'copy' =>
                'We connect advertisers with real publishers and keep long-term trust above one-off transactions.',
        ],
        [
            'title' => 'White-Hot Approach',
            'copy' => 'We are focused, practical, and quality led, so every placement has purpose.',
        ],
        [
            'title' => 'Simplicity By Design',
            'copy' => 'PubWhizz is shaped around clear communication, simple orders, and easy relationship management.',
        ],
    ];

    $workSteps = [
        [
            'label' => 'For Advertisers',
            'items' => [
                'Find relevant websites',
                'View real metrics and pricing',
                'Direct publisher communication',
                'Simple order management',
            ],
        ],
        [
            'label' => 'For Publishers',
            'items' => [
                'Earn from your content',
                'Set your own pricing',
                'Approve content first',
                'Streamlined workflow',
            ],
        ],
        [
            'label' => 'Built Different',
            'items' => [
                'No middlemen complications',
                'Everything in one place',
                'Transparent communication',
                'Results you can trust',
            ],
        ],
    ];

    $stats = [
        ['value' => '8+ Years', 'label' => 'Industry Experience'],
        ['value' => '60,000+', 'label' => 'Publishers Connected'],
        ['value' => '10k+', 'label' => 'PR Delivered'],
        ['value' => '100%', 'label' => 'White-Hat Ethical'],
    ];
@endphp

<section class="pt-24 lg:pt-32">
    <div class="mx-auto max-w-[1500px] px-4 sm:px-6 lg:px-8">
        <div
            class="relative isolate min-h-[780px] overflow-hidden rounded-[22px] bg-[#FFF1E8] px-5 pb-0 pt-10 text-center sm:min-h-[760px] sm:px-8 lg:min-h-[620px] lg:px-12 lg:pt-28">
            <div class="relative z-10 mx-auto max-w-4xl">
                <span class="inline-flex rounded-full bg-white px-5 py-2 text-sm font-bold text-[#E97A37]">About Our
                    Story</span>
                <h1 class="mt-6 text-[24px] font-extrabold leading-tight text-[#1C1412] sm:text-5xl lg:text-[56px]">
                    <span class="block whitespace-nowrap sm:inline">Connecting Advertisers</span>
                    <span class="block sm:inline">&amp; Publishers</span>
                </h1>
                <p class="mx-auto mt-4 max-w-2xl text-sm font-medium leading-relaxed text-[#686677] sm:text-base">
                    Building real backlinks without unnecessary complexity. PubWhizz is a transparent platform for
                    authentic link building.
                </p>
                <div class="mt-8 flex flex-row items-center justify-center gap-3">
                    <a href="#"
                        class="inline-flex h-12 min-w-0 flex-1 items-center justify-center rounded-[5px] bg-[#E97A37] px-4 text-sm font-bold text-white transition hover:bg-[#d4651f] sm:min-w-40 sm:flex-none sm:px-6">Explore
                        Platform</a>
                    <a href="#how-pubwhizz-works"
                        class="inline-flex h-12 min-w-0 flex-1 items-center justify-center rounded-[5px] border border-[#CBCAD7] bg-white px-4 text-sm font-bold text-[#686677] transition hover:border-[#E97A37] hover:text-[#E97A37] sm:min-w-40 sm:flex-none sm:px-6">Learn
                        More</a>
                </div>
            </div>

            <div
                class="absolute bottom-0 left-1/2 z-10 w-[250px] max-w-[450px] -translate-x-1/2 sm:w-[300px] lg:relative lg:bottom-auto lg:left-auto lg:mx-auto lg:mt-8 lg:w-full lg:translate-x-0">
                <img src="{{ asset('assets/img/about_us_hero_section.svg') }}" alt="PubWhizz outreach dashboard"
                    class="mx-auto h-auto w-full">
            </div>

            <div class="pointer-events-none absolute inset-0 z-20 text-left lg:inset-x-12 lg:bottom-8 lg:top-[300px]">
                <div
                    class="absolute left-0 top-[535px] flex w-36 flex-col items-center justify-center rounded-lg bg-[#E97A371A] p-4 text-center sm:top-[500px] lg:bottom-0 lg:left-[120px] lg:top-auto lg:w-52">
                    <p class="text-xl font-extrabold text-[#1C1412] lg:text-2xl">60,000+</p>
                    <p class="mt-1 text-xs font-semibold text-[#9B928E]">Publishers Connected</p>
                </div>
                <div
                    class="absolute bottom-0 right-0 flex w-32 flex-col items-center justify-center rounded-lg bg-[#E97A371A] p-4 text-center lg:bottom-auto lg:left-[-48px] lg:right-auto lg:top-0 lg:w-52">
                    <p class="text-xl font-extrabold text-[#1C1412] lg:text-2xl">100%</p>
                    <p class="mt-1 text-xs font-semibold text-[#9B928E]">Transparent Pricing</p>
                </div>
                <div
                    class="absolute right-0 top-[430px] flex w-32 flex-col items-center justify-center rounded-lg bg-[#E97A371A] p-4 text-center sm:top-[405px] lg:bottom-0 lg:right-[120px] lg:top-auto lg:w-44">
                    <p class="text-xl font-extrabold text-[#1C1412] lg:text-2xl">8+ Years</p>
                    <p class="mt-1 text-xs font-semibold text-[#9B928E]">Industry Experience</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mx-auto max-w-[1500px] px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
    <div class="text-center">
        <h2 class="text-[44px] font-extrabold leading-tight sm:text-5xl">Our Mission &amp; Values</h2>
        <p class="mx-auto mt-4 max-w-2xl text-[16px] font-medium leading-relaxed text-[#686677] sm:text-base">
            <span class="block"></span>Built on the belief that guest posting should be simple, transparent, and</span>
            <span class="block">focused on real value.</span>
        </p>
    </div>

    <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($values as $value)
            <article class="rounded-[8px] border border-[#CBCAD7] bg-white p-5">
                <div class="mb-4 flex items-center gap-2">
                    <x-blog::about.icons.check-circle class="text-[#1C1412]" />
                    <h3 class="text-base font-extrabold text-[#1C1412]">{{ $value['title'] }}</h3>
                </div>
                <p class="text-sm font-medium leading-relaxed text-[#686677]">{{ $value['copy'] }}</p>
            </article>
        @endforeach
    </div>
</section>

<section id="how-pubwhizz-works" class="mx-auto max-w-[1500px] px-4 py-8 sm:px-6 lg:px-8 lg:py-20">
    <div class="grid items-center gap-10 rounded-[22px] p-6 lg:grid-cols-[1.05fr_1fr] lg:p-16">
        <div>
            <h2 class="text-[32px] font-extrabold leading-tight sm:text-5xl">How PubWhizz Works</h2>
            <img src="{{ asset('assets/img/becoming-rich.svg') }}" alt="Creator earning through PubWhizz"
                class="mx-auto mt-8 hidden h-auto w-full max-w-[460px] lg:mt-12 lg:block">
        </div>

        <div class="relative lg:pl-24">
            <x-blog::about.icons.work-curve class="absolute left-0 top-[-64px] hidden h-[520px] w-[120px] lg:block" />
            <div class="space-y-8 lg:space-y-10">
                @foreach ($workSteps as $index => $step)
                    <div
                        class="relative overflow-hidden rounded-[8px] bg-white p-5 text-center shadow-[0_10px_30px_rgba(28,20,18,0.04)] lg:overflow-visible lg:bg-transparent lg:p-0 lg:text-left lg:shadow-none {{ $index === 1 ? 'lg:ml-28' : 'lg:ml-6' }}">
                        <x-blog::about.icons.work-mobile-curve :index="$index"
                            class="absolute left-1/2 top-2 h-16 w-[130%] -translate-x-1/2 lg:hidden" />
                        <span
                            class="absolute left-1/2 top-2 z-10 flex h-6 w-6 -translate-x-1/2 items-center justify-center rounded-full border-2 border-white bg-[#E97A37] text-xs font-extrabold text-white shadow-[0_0_0_3px_#E97A37] lg:top-auto lg:mx-0 lg:h-8 lg:w-8 lg:translate-x-0 lg:text-sm {{ ['lg:left-[-76px]', 'lg:left-[-126px]', 'lg:left-[-72px]'][$index] }}">{{ $index + 1 }}</span>
                        <h3 class="mt-12 text-lg font-extrabold text-[#1C1412] lg:mt-0">{{ $step['label'] }}</h3>
                        <ul class="mt-3 space-y-2">
                            @foreach ($step['items'] as $item)
                                <li
                                    class="flex justify-center gap-2 text-sm font-medium leading-relaxed text-[#686677] lg:justify-start">
                                    <span class="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-[#686677]"></span>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>

        <img src="{{ asset('assets/img/becoming-rich.svg') }}" alt="Creator earning through PubWhizz"
            class="mx-auto h-auto w-full max-w-[300px] lg:hidden">
    </div>
</section>

<section class="mx-auto max-w-[1500px] px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
    <div class="grid items-center gap-10 lg:grid-cols-[0.95fr_1.05fr]">
        <div class="relative mx-auto w-full max-w-[520px] pb-16 pr-10">
            <div class="rounded-[18px] border-8 border-[#E97A37] bg-white p-2">
                <img src="{{ asset('assets/img/safder.svg') }}" alt="Safdar Ali, founder of PubWhizz"
                    class="h-auto w-full rounded-[8px] bg-[#F89319]">
            </div>
            <div
                class="absolute bottom-8 right-0 w-40 rounded-[8px] border border-[#CBCAD7] bg-white p-4 shadow-[0_16px_40px_rgba(28,20,18,0.12)] sm:right-[-4px] lg:bottom-0">
                <p class="text-lg font-extrabold">Safdar Ali</p>
                <p class="mt-1 text-xs font-bold text-[#E97A37]">Founder &amp; CEO</p>
                <img src="{{ asset('assets/img/SAFDAR_signature.svg') }}" alt="Safdar Ali signature"
                    class="mt-2 h-auto w-full">
                <span class="absolute bottom-0 left-1/2 h-1 w-12 -translate-x-1/2 rounded-t-full bg-[#E97A37]"></span>
            </div>
        </div>

        <div>
            <p class="text-sm font-extrabold uppercase text-[#E97A37]">
                <span
                    class="relative inline-block after:absolute after:bottom-[-6px] after:left-0 after:h-1 after:w-[60px] after:rounded after:bg-[#E97A37] after:content-['']">Meet</span>
                The Founder
            </p>
            <h2 class="mt-3 text-[36px] font-extrabold leading-tight sm:text-5xl">Safdar Ali</h2>
            <p class="mt-1 text-sm font-bold text-[#E97A37]">Founder &amp; CEO</p>
            <p class="mt-6 text-base font-medium leading-relaxed text-[#686677]">
                Safdar is an SEO strategist and digital marketer with over <strong
                    class="font-extrabold text-[#1C1412]">8 years of hands-on experience</strong> in guest posting,
                outreach, and white-hat SEO.
            </p>
            <p class="mt-4 text-base font-medium leading-relaxed text-[#686677]">
                He has personally worked with <strong class="font-extrabold text-[#1C1412]">6,000+ publishers</strong>
                and built long-term relationships throughout the industry, giving him deep insight into what advertisers
                and publishers really need.
            </p>

            <blockquote class="mt-6 rounded-lg bg-[#E97A371A] p-3 text-base font-bold leading-relaxed text-[#1C1412]">
                "I built PubWhizz because I&apos;ve experienced the challenges of finding genuine websites, real
                publishers, and clear pricing. The goal is simple: help clients get real links that deliver real value
                without confusion."
            </blockquote>

            <h3 class="mt-7 text-lg font-extrabold">Background</h3>
            <div class="mt-4 grid gap-3 sm:grid-cols-2">
                @foreach ([['label' => 'Kashmiri entrepreneur', 'icon' => 'about.icons.background-mountains'], ['label' => 'Father of a daughter', 'icon' => 'about.icons.background-family'], ['label' => 'Passionate about transparency in digital marketing', 'icon' => 'about.icons.background-transparency'], ['label' => 'Support ethical, white-hat SEO practices', 'icon' => 'about.icons.background-seo']] as $item)
                    <div
                        class="flex min-h-14 items-center gap-3 rounded-lg bg-[#FFE5D1] px-4 text-sm font-bold text-[#1C1412]">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center text-[#1C1412]">
                            <x-dynamic-component :component="$item['icon']" />
                        </span>
                        {{ $item['label'] }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="relative mt-10 rounded-[22px] bg-[#FFE5D1] p-5 pb-12">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($stats as $stat)
                <div class="rounded-lg bg-white p-5 text-center">
                    <span
                        class="mx-auto mb-3 flex h-9 w-9 items-center justify-center rounded-full bg-[#FFE5D1] text-[#1C1412]">
                        <x-blog::about.icons.stat-icon :label="$stat['label']" />
                    </span>
                    <p class="text-xl font-extrabold">{{ $stat['value'] }}</p>
                    <p class="mt-1 text-xs font-semibold text-[#9B928E]">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>

        <div
            class="absolute bottom-0 left-1/2 flex w-[calc(100%-2rem)] max-w-md -translate-x-1/2 translate-y-1/2 justify-center gap-3">
            <a href="#"
                class="inline-flex h-11 flex-1 items-center justify-center gap-2 rounded-sm border-b border-brand bg-[#FFE5D1] px-2 text-sm font-bold text-[#1C1412] shadow-sm">
                <x-blog::about.icons.mail class="text-[#1C1412]" />

                Get in touch
            </a>
            <a href="#"
                class="inline-flex h-11 flex-1 items-center justify-center gap-2 rounded-sm border-b border-brand bg-[#FFE5D1] px-2 text-sm font-bold text-[#1C1412] shadow-sm">
                <x-blog::about.icons.linkedin class="text-[#1C1412]" />

                Linkedin
            </a>
        </div>
    </div>
</section>

<section class="mx-auto max-w-[1500px] px-4 py-12 sm:px-6 lg:px-8 lg:py-24">
    <h2 class="text-center text-[22px] font-extrabold leading-tight sm:text-5xl">Our Approach</h2>
    <div
        class="relative mx-auto mt-10 lg:left-1/2 lg:w-screen lg:max-w-[1500px] lg:-translate-x-1/2 lg:overflow-hidden lg:px-0 lg:mt-12">
        <div class="absolute left-4 top-0 h-full w-px bg-[#E97A37]/45 lg:left-1/2"></div>
        <div class="grid gap-8 lg:gap-14">
            @foreach ([['No Unnecessary Middle Layers', 'Direct communication between advertisers and publishers. No hidden brokers or complex hierarchies.'], ['No Complicated Workflows', 'Simple, intuitive processes. Everything from discovery to completion happens in one unified platform.'], ['Focus On Clarity & Usability', 'Clear metrics, transparent pricing, and straightforward communication. We remove the guesswork.']] as $index => $item)
                <div class="relative pl-10 lg:grid lg:grid-cols-2 lg:gap-0 lg:pl-0">
                    <span
                        class="absolute left-4 top-1 h-5 w-5 -translate-x-1/2 rounded-full bg-[#E97A37] lg:left-1/2 lg:top-9 lg:h-7 lg:w-7"></span>
                    <div
                        class="{{ $index % 2 === 1 ? 'lg:col-start-2 lg:mr-0 lg:ml-20 lg:rounded-l-full lg:rounded-r-none lg:border-r-0 lg:pl-20 lg:pr-16' : 'lg:mr-20 lg:ml-0 lg:rounded-l-none lg:rounded-r-full lg:border-l-0 lg:pl-16 lg:pr-20' }} bg-white py-0 text-left lg:border lg:border-[#CBCAD7] lg:px-8 lg:py-8 lg:text-center">
                        <h3 class="text-sm font-extrabold lg:text-base">{{ $item[0] }}</h3>
                        <p
                            class="mt-2 max-w-sm text-xs font-medium leading-relaxed text-[#686677] lg:mx-auto lg:text-sm">
                            {{ $item[1] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <p
        class="mx-auto mt-10 max-w-3xl rounded-[8px] bg-[#FFF1E8] px-6 py-5 text-center text-sm font-bold leading-relaxed text-[#1C1412] lg:mt-12 lg:text-base">
        "PubWhizz is built to keep things simple and reliable for both advertisers and publishers. Not on big promises,
        but on a clear system where work gets done properly."
    </p>
</section>

<section class="mx-auto max-w-[1500px] px-4 py-12 sm:px-6 lg:px-8 lg:py-20">
    <div class="overflow-hidden rounded-[22px] bg-[#E97A37] px-5 py-12 text-center text-white lg:px-8">
        <h2 class="text-[32px] font-extrabold leading-tight sm:text-5xl">Ready To Get Started?</h2>
        <p class="mx-auto mt-4 max-w-2xl text-sm font-medium leading-relaxed text-white/90 sm:text-base">
            Join thousands of advertisers and publishers building real relationships and authentic backlinks.
        </p>
        <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
            <a href="#"
                class="inline-flex h-12 min-w-44 items-center justify-center gap-2 rounded-[5px] bg-white px-6 text-sm font-bold text-[#E97A37] transition hover:bg-[#FFF1E8]">Start
                as Advertiser <span aria-hidden="true">-></span></a>
            <a href="#"
                class="inline-flex h-12 min-w-44 items-center justify-center gap-2 rounded-[5px] border border-white/60 px-6 text-sm font-bold text-white transition hover:bg-white/10">Join
                as Publisher <span aria-hidden="true">-></span></a>
        </div>
        <div class="mx-auto mt-10 grid max-w-6xl overflow-hidden rounded-full bg-white/25 sm:grid-cols-3">
            <div class="px-6 py-6">
                <p class="text-xl font-extrabold text-[#1C1412]">24/7</p>
                <p class="mt-1 text-xs font-semibold text-[#1C1412]">Support Available</p>
            </div>
            <div class="border-y border-white/35 px-6 py-6 sm:border-x sm:border-y-0">
                <p class="text-xl font-extrabold text-[#0099FF]">0%</p>
                <p class="mt-1 text-xs font-semibold text-[#1C1412]">Setup fee</p>
            </div>
            <div class="px-6 py-6">
                <p class="text-xl font-extrabold text-[#1C1412]">Instant</p>
                <p class="mt-1 text-xs font-semibold text-[#1C1412]">Account Activation</p>
            </div>
        </div>
    </div>
</section>
