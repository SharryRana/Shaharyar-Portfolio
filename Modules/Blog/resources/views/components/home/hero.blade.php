{{-- resources/views/components/hero.blade.php --}}
<section class="relative flex items-center overflow-hidden bg-gradient-to-br from-white via-orange-50/30 to-white pt-16">

    {{-- Background blobs --}}
    <div class="absolute top-20 right-0 w-96 h-96 bg-orange-200/30 rounded-full blur-3xl animate-blob"
        style="animation-delay: 0s;"></div>
    <div class="absolute bottom-20 left-0 w-80 h-80 bg-orange-100/40 rounded-full blur-3xl animate-blob"
        style="animation-delay: 3s;"></div>
    <div class="absolute top-1/2 left-1/3 w-64 h-64 bg-amber-100/30 rounded-full blur-3xl animate-blob"
        style="animation-delay: 6s;"></div>

    <div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8 w-full pt-16 pb-0 lg:pt-24 lg:pb-0">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

            {{-- Left — Text Content --}}
            <div class="order-1 lg:order-1">

                {{-- Headline --}}
                <span class="text-3xl sm:text-4xl lg:text-5xl font-semibold text-gray-900 leading-tight mb-4 block">
                    Skip Outreach.<br>
                </span>
                <h1 class="text-xl sm:text-4xl lg:text-5xl font-semibold text-gray-900 leading-tight mb-6">
                    <span class="block whitespace-nowrap">Get High-Authority Backlinks</span>
                    <span class="block mt-3 whitespace-nowrap">From <span
                            class="relative inline-block px-4 py-1.5 text-[#E97A37] text-xl sm:text-3xl lg:text-4xl">
                            {{-- Tilted rect (back layer) --}}
                            <span
                                class="absolute inset-0 border-[1.5px] border-[#E97A37] rounded-xl rotate-[-3deg] origin-center pointer-events-none"></span>
                            {{-- Straight rect (front layer) --}}
                            <span
                                class="absolute inset-0 border-[1.5px] border-[#E97A37] rounded-xl pointer-events-none"></span>
                            <span class="relative z-10">35,000+ Trusted Sites.</span>
                        </span></span>
                </h1>
                {{-- Subtext --}}
                <p class="text-lg text-[#686677] leading-relaxed mb-8 max-w-xl">
                    Access verified publishers and secure powerful backlinks in days — without the headaches. No cold
                    emails, no negotiations — just results.
                </p>

                <div class="w-full sm:w-max">
                    {{-- Animated ticker badge --}}
                    <div class="flex items-center justify-center bg-[#FFE5D1] rounded-xl px-4 py-3 mb-6 w-full">
                        <span
                            class="text-[11px] sm:text-[13px] font-medium text-[#1C1412] flex items-center text-center">
                            <span>The&nbsp;</span>
                            <span id="badge-wrap"
                                style="display:inline-block; overflow:hidden; height:1.35em; vertical-align:middle; transition: width 0.18s ease;">
                                <span id="badge-ticker"
                                    style="display:inline-block; font-weight:700; color:#D66E2C; white-space:nowrap; line-height:1.35em; transition: transform 0.28s cubic-bezier(0.4,0,0.2,1), opacity 0.28s ease;">#1
                                    Backlink Marketplace</span>
                            </span>
                            <span>&nbsp;for SEO &amp; PR Teams.</span>
                        </span>
                    </div>



                    {{-- CTA Buttons --}}
                    <div class="flex flex-row gap-2 sm:gap-4 mb-10 w-full">
                        <a href="#"
                            class="flex-1 inline-flex items-center justify-center gap-1 sm:gap-2 bg-white hover:bg-[#E97A37] text-[#E97A37] hover:text-white font-bold px-3 sm:px-8 py-3 rounded-lg border-2 border-[#E97A37] transition-all duration-200 shadow-sm hover:shadow-lg text-sm sm:text-base whitespace-nowrap">
                            Buy Backlinks
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" sm:width="24"
                                sm:height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M7 17 17 7" />
                                <path d="M7 7h10v10" />
                            </svg>
                        </a>
                        <a href="#"
                            class="flex-1 inline-flex items-center justify-center gap-1 sm:gap-2 bg-white hover:bg-[#E97A37] text-[#E97A37] hover:text-white font-semibold px-3 sm:px-8 py-3 rounded-lg border-2 border-[#E97A37] transition-all duration-200 shadow-sm hover:shadow-lg text-sm sm:text-base whitespace-nowrap">
                            Sell Backlinks
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" sm:width="24"
                                sm:height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M7 17 17 7" />
                                <path d="M7 7h10v10" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Right — Mockup/Visual --}}
            <div class="order-2 lg:order-2 flex justify-center lg:justify-end relative -mx-4 sm:mx-0">
                <div
                    class="relative w-[130%] sm:w-full lg:w-[115%] lg:-mr-8 flex justify-center lg:justify-end animate-fade-up">
                    {{-- Mobile Image --}}
                    <img src="{{ asset('assets/img/hero_mobile.svg') }}" alt="PubWhizz Platform"
                        class="w-full h-auto object-contain drop-shadow-2xl block lg:hidden" loading="lazy">
                    {{-- Desktop Image --}}
                    <img src="{{ asset('assets/img/hero.svg') }}" alt="PubWhizz Platform"
                        class="w-full h-auto object-contain drop-shadow-2xl hidden lg:block" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    (function() {
        const phrases = [
            '#1 Backlink Marketplace',
            '#1 PR Marketplace',
        ];
        let current = 0;
        const el = document.getElementById('badge-ticker');
        const wrap = document.getElementById('badge-wrap');

        // Initialise wrapper width to first phrase
        wrap.style.width = el.scrollWidth + 'px';

        function tick() {
            el.style.transform = 'translateY(-115%)';
            el.style.opacity = '0';

            setTimeout(function() {
                current = (current + 1) % phrases.length;
                el.textContent = phrases[current];
                el.style.transition = 'none';
                el.style.transform = 'translateY(115%)';
                el.style.opacity = '0';

                // Resize wrapper to new phrase width
                wrap.style.width = el.scrollWidth + 'px';

                requestAnimationFrame(function() {
                    requestAnimationFrame(function() {
                        el.style.transition =
                            'transform 0.5s cubic-bezier(0.4,0,0.2,1), opacity 0.5s ease';
                        el.style.transform = 'translateY(0)';
                        el.style.opacity = '1';
                    });
                });
            }, 500);
        }

        setInterval(tick, 3000);
    })();
</script>
