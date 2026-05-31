{{-- resources/views/components/home/testimonials.blade.php --}}
<section class="py-16 lg:py-24 bg-[#FAF8F5] overflow-hidden">

    <style>
        @keyframes t-left {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        @keyframes t-right {
            0% {
                transform: translateX(-50%);
            }

            100% {
                transform: translateX(0);
            }
        }

        .t-scroll-left {
            animation: t-left 38s linear infinite;
        }

        .t-scroll-right {
            animation: t-right 32s linear infinite;
        }

        .t-track:hover .t-scroll-left,
        .t-track:hover .t-scroll-right {
            animation-play-state: paused;
        }
    </style>

    <div class="text-center mb-14 px-4">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-3">What Our Client Says</h2>
        <p class="text-gray-500 text-base">We have been working with clients around the world</p>
    </div>

    @php
        $row1 = [
            [
                'name' => 'Ghulam Ali',
                'role' => 'CEO, GMS Digitals',
                'img' => 'https://i.pravatar.cc/100?img=11',
                'text' =>
                    '"The placement of the link is very fast. Great communication and professional service. Thank you!"',
            ],
            [
                'name' => 'Kashif Jutt',
                'role' => 'CEO of Utilities Deals',
                'img' => 'https://i.pravatar.cc/100?img=12',
                'text' =>
                    '"The placement of the link is very fast. Great communication and professional service. Thank you!"',
            ],
            [
                'name' => 'Sarah Mills',
                'role' => 'VP of Marketing',
                'img' => 'https://i.pravatar.cc/100?img=47',
                'text' =>
                    '"Outstanding platform for link building. Publisher quality is unmatched and the process is seamless."',
            ],
            [
                'name' => 'Ahsan Raza',
                'role' => 'Digital Marketing Lead',
                'img' => 'https://i.pravatar.cc/100?img=13',
                'text' =>
                    '"PubWhizz transformed how we handle backlink campaigns. Highly recommend to any SEO professional."',
            ],
        ];

        $row2 = [
            [
                'name' => 'James Carter',
                'role' => 'CEO at ABC Corporation',
                'img' => 'https://i.pravatar.cc/100?img=52',
                'text' =>
                    '"The placement of the link is very fast. Great communication and professional service. Thank you!"',
            ],
            [
                'name' => 'Noman Mazhar',
                'role' => 'CEO of Image Editor',
                'img' => 'https://i.pravatar.cc/100?img=14',
                'text' =>
                    '"The placement of the link is very fast. Great communication and professional service. Thank you!"',
            ],
            [
                'name' => 'Mudassir Ali',
                'role' => 'E-Commerce Owner',
                'img' => 'https://i.pravatar.cc/100?img=15',
                'text' =>
                    '"Fantastic service! Links went live quickly and our search rankings improved noticeably within weeks."',
            ],
            [
                'name' => 'Priya Sharma',
                'role' => 'SEO Lead, TechCorp',
                'img' => 'https://i.pravatar.cc/100?img=48',
                'text' =>
                    '"Best marketplace for link building. Transparent pricing and real results for our clients every time."',
            ],
        ];
    @endphp

    <!-- Desktop: keep current auto-scroll rows -->
    <div class="relative t-track hidden sm:block">
        <div
            class="absolute left-0 top-0 bottom-0 w-20 lg:w-40 bg-linear-to-r from-[#FAF8F5] to-transparent z-10 pointer-events-none">
        </div>
        <div
            class="absolute right-0 top-0 bottom-0 w-20 lg:w-40 bg-linear-to-l from-[#FAF8F5] to-transparent z-10 pointer-events-none">
        </div>
        <!-- Row 1: scrolls left -->
        <div class="flex mb-6">
            <div class="flex gap-5 t-scroll-left" style="width: max-content;">
                @foreach ([...$row1, ...$row1] as $item)
                    <div class="shrink-0 flex items-center gap-4 bg-white rounded-full shadow-sm pl-2 pr-6 py-2"
                        style="width: 600px; border-width: 0.6px; border-style: solid; border-color: #e5e7eb;">
                        <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}"
                            class="w-28 h-28 rounded-full object-cover shrink-0 shadow-md select-none" loading="lazy">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-3 mb-2">
                                <span class="font-bold text-gray-900 text-base leading-tight">{{ $item['name'] }}</span>
                                <span class="text-xs text-gray-400 shrink-0 mt-0.5">{{ $item['role'] }}</span>
                            </div>
                            <div class="flex gap-0.5 mb-3 text-brand">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                                        <polygon
                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                    </svg>
                                @endfor
                            </div>
                            <p class="text-gray-500 text-sm leading-relaxed">{{ $item['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Row 2: scrolls right -->
        <div class="flex">
            <div class="flex gap-5 t-scroll-right" style="width: max-content;">
                @foreach ([...$row2, ...$row2] as $item)
                    <div class="shrink-0 flex items-center gap-5 bg-white rounded-full shadow-sm pl-3 pr-8 py-3"
                        style="width: 600px; border-width: 0.6px; border-style: solid; border-color: #e5e7eb;">
                        <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}"
                            class="w-28 h-28 rounded-full object-cover shrink-0 shadow-md select-none" loading="lazy">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-3 mb-2">
                                <span class="font-bold text-gray-900 text-base leading-tight">{{ $item['name'] }}</span>
                                <span class="text-xs text-gray-400 shrink-0 mt-0.5">{{ $item['role'] }}</span>
                            </div>
                            <div class="flex gap-0.5 mb-3 text-brand">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                                        <polygon
                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                    </svg>
                                @endfor
                            </div>
                            <p class="text-gray-500 text-sm leading-relaxed">{{ $item['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Mobile: single rectangular card with avatar top-left, name/role right, stars/message below -->
    <div x-data="testimonialsSlider()" class="block sm:hidden">
        <template x-if="testimonials.length > 0">
            <div class="flex flex-col items-center">
                <div
                    class="bg-white rounded-[48px] shadow-md px-4 pt-4 pb-4 mb-6 w-11/12 mx-auto max-w-md border border-gray-200">
                    <div class="flex items-start gap-3 mb-2">
                        <img :src="testimonials[idx].img" :alt="testimonials[idx].name"
                            class="w-16 h-16 rounded-full object-cover shadow-md select-none mt-1" loading="lazy">
                        <div class="flex flex-col justify-center flex-1 min-w-0">
                            <div class="font-bold text-gray-900 text-base leading-tight truncate">
                                <span x-text="testimonials[idx].name"></span>
                            </div>
                            <div class="text-xs text-gray-400 mt-0.5 truncate" x-text="testimonials[idx].role"></div>
                        </div>
                    </div>
                    <div class="flex justify-center gap-0.5 mb-2 text-brand">
                        <template x-for="i in 5" :key="i">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                            </svg>
                        </template>
                    </div>
                    <div class="text-gray-500 text-base leading-relaxed mt-1 ml-1" x-text="testimonials[idx].text">
                    </div>
                </div>
                <div class="flex justify-center gap-4">
                    <button @click="prev()"
                        class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 bg-white text-gray-500 hover:bg-gray-100 transition">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M19 12H5" />
                            <path d="M12 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button @click="next()"
                        class="w-10 h-10 flex items-center justify-center rounded-full border border-brand bg-brand text-white hover:bg-brand-dark transition">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M5 12h14" />
                            <path d="M12 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </template>
    </div>

    <script>
        function testimonialsSlider() {
            return {
                idx: 0,
                testimonials: @json(array_values(array_merge($row1, $row2))),
                prev() {
                    this.idx = this.idx === 0 ? this.testimonials.length - 1 : this.idx - 1;
                },
                next() {
                    this.idx = this.idx === this.testimonials.length - 1 ? 0 : this.idx + 1;
                }
            }
        }
    </script>
</section>
