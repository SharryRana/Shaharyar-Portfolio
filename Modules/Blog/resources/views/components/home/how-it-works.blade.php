{{-- resources/views/components/how-it-works.blade.php --}}
<section class="py-20 lg:py-28 bg-gradient-to-br from-gray-50 to-orange-50/30">
    <div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <div
                class="inline-flex items-center gap-2 bg-[#E97A37]-light border border-orange-200 rounded-full px-4 py-1.5 mb-4">
                <span class="text-xs font-semibold text-[#cf6b2d] uppercase tracking-wider">Simple Process</span>
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4 leading-tight">
                Get Backlinks in <span class="text-[#E97A37]">3 Simple Steps</span>
            </h2>
            <p class="text-lg text-gray-500">From browsing to live link — the entire process takes less than 5 minutes.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 lg:gap-10">
            @php
                $steps = [
                    [
                        'num' => '1',
                        'icon' => '<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>',
                        'title' => 'Browse & Filter',
                        'desc' =>
                            'Search 35,000+ verified publishers. Filter by niche, DA, DR, traffic, price, country and language to find the perfect fit for your campaign.',
                        'tags' => ['DA Filter', 'Niche', 'Traffic', 'Price'],
                    ],
                    [
                        'num' => '2',
                        'icon' =>
                            '<rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/>',
                        'title' => 'Place Your Order',
                        'desc' =>
                            'Pick your package, add your URL and anchor text. Secure checkout in seconds. Our system instantly routes the order to the publisher.',
                        'tags' => ['Secure Payment', 'Instant Routing'],
                    ],
                    [
                        'num' => '3',
                        'icon' =>
                            '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><polyline points="9 15 12 18 15 15"/><line x1="12" y1="12" x2="12" y2="18"/>',
                        'title' => 'Get Published',
                        'desc' =>
                            'Your content goes live within 48 hours. Track all links from your dashboard and download white-label reports for clients.',
                        'tags' => ['48hr Turnaround', 'Live Tracking'],
                    ],
                ];
            @endphp

            @foreach ($steps as $i => $step)
                <div class="relative flex flex-col items-center text-center group">
                    {{-- Arrow between steps --}}
                    @if ($i < 2)
                        <div class="hidden md:block absolute top-16 -right-5 z-10">
                            <svg width="40" height="24" viewBox="0 0 40 24" fill="none">
                                <path d="M0 12 Q20 0 40 12" stroke="#E97A37" stroke-width="2" stroke-dasharray="5 3"
                                    fill="none" />
                                <path d="M33 8 L40 12 L33 16" stroke="#E97A37" stroke-width="2" fill="none"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                    @endif

                    {{-- Circle icon --}}
                    <div class="relative mb-6">
                        <div
                            class="w-28 h-28 rounded-full bg-white border-2 border-orange-100 group-hover:border-[#E97A37] flex items-center justify-center shadow-md group-hover:shadow-xl transition-all duration-300 group-hover:-translate-y-1">
                            <div
                                class="w-18 h-18 rounded-full bg-[#E97A37]-light group-hover:bg-[#E97A37] flex items-center justify-center transition-colors duration-300 w-16 h-16">
                                <svg class="text-[#E97A37] group-hover:text-white transition-colors duration-300"
                                    xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">{!! $step['icon'] !!}</svg>
                            </div>
                        </div>
                        <div
                            class="absolute -top-1 -right-1 w-7 h-7 bg-[#E97A37] text-white text-xs font-bold rounded-full flex items-center justify-center shadow-md">
                            {{ $step['num'] }}</div>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $step['title'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4 max-w-xs">{{ $step['desc'] }}</p>

                    <div class="flex flex-wrap gap-2 justify-center">
                        @foreach ($step['tags'] as $tag)
                            <span
                                class="text-xs bg-white border border-gray-200 text-[#686677] px-3 py-1 rounded-full">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-14">
            <a href="#"
                class="inline-flex items-center gap-2 bg-[#E97A37] hover:bg-[#E97A37]-dark text-white font-bold px-10 py-4 rounded-2xl transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                Start Building Links Today
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</section>
