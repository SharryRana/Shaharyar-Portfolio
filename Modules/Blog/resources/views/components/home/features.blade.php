{{-- resources/views/components/features.blade.php --}}
<section class="pt-2 pb-20 lg:pt-14 lg:pb-28 bg-white">
    <div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header & How It Works Visual --}}
        <div class="relative hidden lg:flex justify-center">
            <div class="inline-flex items-center gap-2 bg-[#FFE5D1] rounded-t-3xl px-6 py-2">
                <span class="text-[13px] font-bold text-[#686677] uppercase tracking-wider">For Agencies and
                    Teams</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M7.99479 2.16927C4.77312 2.16927 2.16146 4.78094 2.16146 8.0026C2.16146 11.2243 4.77312 13.8359 7.99479 13.8359C11.2165 13.8359 13.8281 11.2243 13.8281 8.0026C13.8281 4.78094 11.2165 2.16927 7.99479 2.16927ZM1.32812 8.0026C1.32812 4.3206 4.31279 1.33594 7.99479 1.33594C11.6768 1.33594 14.6615 4.3206 14.6615 8.0026C14.6615 11.6846 11.6768 14.6693 7.99479 14.6693C4.31279 14.6693 1.32812 11.6846 1.32812 8.0026ZM7.99479 6.66927C8.22479 6.66927 8.41146 6.85594 8.41146 7.08594V11.2526C8.41146 11.3631 8.36756 11.4691 8.28942 11.5472C8.21128 11.6254 8.1053 11.6693 7.99479 11.6693C7.88428 11.6693 7.7783 11.6254 7.70016 11.5472C7.62202 11.4691 7.57812 11.3631 7.57812 11.2526V7.08594C7.57812 6.85594 7.76479 6.66927 7.99479 6.66927ZM7.99479 5.66927C8.1716 5.66927 8.34117 5.59903 8.4662 5.47401C8.59122 5.34898 8.66146 5.17941 8.66146 5.0026C8.66146 4.82579 8.59122 4.65622 8.4662 4.5312C8.34117 4.40618 8.1716 4.33594 7.99479 4.33594C7.81798 4.33594 7.64841 4.40618 7.52339 4.5312C7.39836 4.65622 7.32812 4.82579 7.32812 5.0026C7.32812 5.17941 7.39836 5.34898 7.52339 5.47401C7.64841 5.59903 7.81798 5.66927 7.99479 5.66927Z"
                        fill="#686677" />
                </svg>
            </div>
        </div>
        <div class="relative bg-white mb-20 overflow-hidden">

            <div class="flex flex-col lg:flex-row gap-8 lg:gap-6 items-center justify-between mt-2">
                {{-- Left: Advertiser Card --}}
                <div
                    class="bg-white rounded-[12px] p-2 lg:p-4 border-[0.8px] border-[#F1F1F5] shadow-sm hover:shadow-md transition-shadow flex-1 w-full max-w-[540px] min-h-[274px] flex flex-col items-start gap-3">
                    <img src="{{ asset('assets/img/advertiser.svg') }}" alt="Advertiser" class="w-32 lg:w-44 h-auto">
                    <div class="flex-1 flex flex-col w-full">
                        <h3 class="text-xl font-bold text-gray-900 mb-1.5 text-center">Advertiser</h3>
                        <p class="text-[#686677] text-sm leading-relaxed mb-4 text-center">
                            Get high-quality backlinks and digital PR to grow your SEO in the AI era.
                        </p>
                        <a href="#"
                            class="mt-auto inline-flex items-center gap-2 text-[#E97A37] font-bold hover:gap-3 transition-all text-sm">
                            Start Building Links
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Middle: Flow & Text --}}
                <div
                    class="text-center relative py-16 lg:py-20 w-full lg:w-64 flex-shrink-0 flex flex-col items-center justify-center">
                    <img src="{{ asset('assets/img/left_top_arrow.svg') }}" alt="Flow"
                        class="absolute top-0 left-10 lg:left-8 w-32 block translate-y-2">

                    <div class="relative z-10 text-center">
                        <h4
                            class="text-xl lg:text-2xl font-normal text-[#E97A37] mb-2 font-['Sedgwick_Ave_Display'] leading-none">
                            How<br>
                            <span class="text-2xl lg:text-3xl whitespace-nowrap">PubWhizz Works?</span>
                        </h4>
                        <p class="text-[#686677] text-xs leading-relaxed max-w-[200px] mx-auto text-center">
                            Start buying or selling backlinks<br>in just a few clicks
                        </p>
                    </div>

                    <img src="{{ asset('assets/img/left_bottom_arrow.svg') }}" alt="Flow"
                        class="absolute bottom-0 right-10 lg:right-8 w-32 block -translate-y-2">
                </div>

                {{-- Right: Publisher Card --}}
                <div
                    class="bg-white rounded-[12px] p-2 lg:p-4 border-[0.8px] border-[#F1F1F5] shadow-sm hover:shadow-md transition-shadow flex-1 w-full max-w-[540px] min-h-[274px] flex flex-col items-start gap-3">
                    <div class="relative inline-block group">
                        <img src="{{ asset('assets/img/publisher.svg') }}" alt="Publisher" class="w-32 lg:w-44 h-auto">
                        {{-- Dollar Badge --}}
                        <div
                            class="absolute bottom-[1px] right-[10px] w-6 h-6 lg:w-7 lg:h-7 bg-[#E97A37] rounded-full flex items-center justify-center shadow-[0px_0px_10px_0px_rgba(0,0,0,0.25)]">
                            <svg width="7" height="11" viewBox="0 0 9 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-1.5 h-auto lg:w-2">
                                <path
                                    d="M1.5 10.125H0C0 12.0675 1.815 13.215 3.75 13.455V15H5.25V13.4475C6.9375 13.2225 9 12.255 9 10.125C9 7.995 6.9375 7.0275 5.25 6.8025V3.075C6.2475 3.255 7.5 3.78 7.5 4.875H9C9 2.745 6.9375 1.7775 5.25 1.5525V0H3.75V1.5525C2.0625 1.7775 0 2.745 0 4.875C0 7.005 2.0025 7.9575 3.75 8.1975V11.925C2.6625 11.7375 1.5 11.16 1.5 10.125ZM7.5 10.125C7.5 11.22 6.2475 11.745 5.25 11.925V8.325C6.2475 8.505 7.5 9.03 7.5 10.125ZM1.5 4.875C1.5 3.78 2.7525 3.255 3.75 3.075V6.675C2.7225 6.4875 1.5 5.925 1.5 4.875Z"
                                    fill="white" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col w-full">
                        <h3 class="text-xl font-bold text-gray-900 mb-1.5 text-center">Publisher</h3>
                        <p class="text-[#686677] text-sm leading-relaxed mb-4 text-center">
                            Turn your website into revenue by selling backlinks to global advertisers.
                        </p>
                        <a href="#"
                            class="mt-auto inline-flex items-center gap-2 text-[#E97A37] font-bold hover:gap-3 transition-all text-sm">
                            List Your Website
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- Smart Marketplace Accordion Section --}}
<section class="py-16 lg:py-24">
    <div class="max-w-[1100px] mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center mb-12 lg:mb-16">
            <h2 class="text-[28px] sm:text-[36px] lg:text-[44px] font-bold text-gray-900 leading-tight mb-6">
                The Smart Marketplace For Scalable<br class="hidden sm:block"> Link Building
            </h2>
            <p class="text-[#686677] text-sm sm:text-base leading-relaxed max-w-[680px] mx-auto">
                We power hundreds of SEO campaigns every month, delivering high-authority backlinks and strategic
                placements across a global publisher network.<br class="hidden sm:block">
                From agencies to independent marketers, PubWhizz simplifies link building at scale — turning organic
                visibility into measurable growth, rankings, and revenue.
            </p>
        </div>

        {{-- Accordion Cards --}}
        <div x-data="{ active: 0 }" class="flex flex-col lg:flex-row gap-3 h-auto lg:h-[400px]">

            {{-- SEO Agencies --}}
            <div @click="active = 0"
                :class="active === 0 ? 'lg:flex-[3] bg-[#FFE5D1] border border-transparent min-h-[230px] lg:min-h-0' :
                    'lg:flex-[0.65] bg-white border border-[#F1F1F5] min-h-[92px] lg:min-h-0'"
                class="relative rounded-2xl p-5 lg:p-7 cursor-pointer transition-all duration-500 ease-in-out overflow-hidden flex flex-col outline-none focus:outline-none focus-visible:outline-none">
                <div class="flex justify-end shrink-0 mb-2">
                    <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                        :class="active === 0 ? 'text-[#1C1412]' : 'text-[#E97A37]'"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.94922 17.6791L17.3236 5.30469" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M17.6796 14.8492V4.94975H7.78009" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div x-show="active === 0" x-transition:enter="transition-opacity duration-300 delay-150"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    class="flex-1 flex flex-col justify-center">
                    <div>
                        <h3 class="text-[24px] lg:text-2xl font-bold text-[#1C1412] mb-3">SEO Agencies</h3>
                        <p class="text-[#686677] text-[16px] leading-relaxed">
                            Agencies use PubWhizz to scale link building campaigns for multiple clients.
                            Find relevant publishers, manage orders in one place, and deliver consistent
                            backlink growth.
                        </p>
                    </div>
                    <x-blog::home.icons.growth-corner class="absolute right-0 bottom-0" />
                </div>
                <div x-show="active !== 0" class="flex-1 flex items-center justify-start lg:justify-center">
                    <span
                        class="text-gray-900 font-bold text-[18px] lg:text-[24px] whitespace-nowrap select-none lg:[writing-mode:vertical-rl] lg:rotate-180">SEO Agencies</span>
                </div>
            </div>

            {{-- Digital Marketers --}}
            <div @click="active = 1"
                :class="active === 1 ? 'lg:flex-[3] bg-[#FFE5D1] border border-transparent min-h-[230px] lg:min-h-0' :
                    'lg:flex-[0.65] bg-white border border-[#F1F1F5] min-h-[92px] lg:min-h-0'"
                class="relative rounded-2xl p-5 lg:p-7 cursor-pointer transition-all duration-500 ease-in-out overflow-hidden flex flex-col outline-none focus:outline-none focus-visible:outline-none">
                <div class="flex justify-end shrink-0 mb-2">
                    <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                        :class="active === 1 ? 'text-[#1C1412]' : 'text-[#E97A37]'"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.94922 17.6791L17.3236 5.30469" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M17.6796 14.8492V4.94975H7.78009" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div x-show="active === 1" x-transition:enter="transition-opacity duration-300 delay-150"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    class="flex-1 flex flex-col justify-center">
                    <div>
                        <h3 class="text-[24px] lg:text-2xl font-bold text-[#1C1412] mb-3">Digital Marketers</h3>
                        <p class="text-[#686677] text-[16px] leading-relaxed">
                            Digital marketers use PubWhizz to boost domain authority and climb search rankings.
                            Access thousands of niche-relevant publishers with transparent pricing and real-time
                            reporting.
                        </p>
                    </div>
                    <x-blog::home.icons.growth-corner class="absolute right-0 bottom-0" />
                </div>
                <div x-show="active !== 1" class="flex-1 flex items-center justify-start lg:justify-center">
                    <span
                        class="text-gray-900 font-bold text-[18px] lg:text-[24px] whitespace-nowrap select-none lg:[writing-mode:vertical-rl] lg:rotate-180">Digital Marketers</span>
                </div>
            </div>

            {{-- SEO Freelancers --}}
            <div @click="active = 2"
                :class="active === 2 ? 'lg:flex-[3] bg-[#FFE5D1] border border-transparent min-h-[230px] lg:min-h-0' :
                    'lg:flex-[0.65] bg-white border border-[#F1F1F5] min-h-[92px] lg:min-h-0'"
                class="relative rounded-2xl p-5 lg:p-7 cursor-pointer transition-all duration-500 ease-in-out overflow-hidden flex flex-col outline-none focus:outline-none focus-visible:outline-none">
                <div class="flex justify-end shrink-0 mb-2">
                    <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                        :class="active === 2 ? 'text-[#1C1412]' : 'text-[#E97A37]'"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.94922 17.6791L17.3236 5.30469" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M17.6796 14.8492V4.94975H7.78009" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div x-show="active === 2" x-transition:enter="transition-opacity duration-300 delay-150"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    class="flex-1 flex flex-col justify-center">
                    <div>
                        <h3 class="text-[24px] lg:text-2xl font-bold text-[#1C1412] mb-3">SEO Freelancers</h3>
                        <p class="text-[#686677] text-[16px] leading-relaxed">
                            Freelancers use PubWhizz to deliver premium link building results for clients without
                            the overhead. Manage multiple campaigns efficiently with our streamlined dashboard.
                        </p>
                    </div>
                    <x-blog::home.icons.growth-corner class="absolute right-0 bottom-0" />
                </div>
                <div x-show="active !== 2" class="flex-1 flex items-center justify-start lg:justify-center">
                    <span
                        class="text-gray-900 font-bold text-[18px] lg:text-[24px] whitespace-nowrap select-none lg:[writing-mode:vertical-rl] lg:rotate-180">SEO Freelancers</span>
                </div>
            </div>

            {{-- E-Commerce Brands --}}
            <div @click="active = 3"
                :class="active === 3 ? 'lg:flex-[3] bg-[#FFE5D1] border border-transparent min-h-[230px] lg:min-h-0' :
                    'lg:flex-[0.65] bg-white border border-[#F1F1F5] min-h-[92px] lg:min-h-0'"
                class="relative rounded-2xl p-5 lg:p-7 cursor-pointer transition-all duration-500 ease-in-out overflow-hidden flex flex-col outline-none focus:outline-none focus-visible:outline-none">
                <div class="flex justify-end shrink-0 mb-2">
                    <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                        :class="active === 3 ? 'text-[#1C1412]' : 'text-[#E97A37]'"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.94922 17.6791L17.3236 5.30469" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M17.6796 14.8492V4.94975H7.78009" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div x-show="active === 3" x-transition:enter="transition-opacity duration-300 delay-150"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    class="flex-1 flex flex-col justify-center">
                    <div>
                        <h3 class="text-[24px] lg:text-2xl font-bold text-[#1C1412] mb-3">E-Commerce Brands</h3>
                        <p class="text-[#686677] text-[16px] leading-relaxed">
                            E-commerce brands use PubWhizz to drive organic traffic and increase product
                            visibility. Build authoritative backlinks from relevant publishers to outrank
                            competitors and grow revenue.
                        </p>
                    </div>
                    <x-blog::home.icons.growth-corner class="absolute right-0 bottom-0" />
                </div>
                <div x-show="active !== 3" class="flex-1 flex items-center justify-start lg:justify-center">
                    <span
                        class="text-gray-900 font-bold text-[18px] lg:text-[24px] whitespace-nowrap select-none lg:[writing-mode:vertical-rl] lg:rotate-180">E-Commerce Brands</span>
                </div>
            </div>
        </div>
    </div>
</section>
