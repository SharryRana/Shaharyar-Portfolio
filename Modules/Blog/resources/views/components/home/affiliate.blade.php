{{-- resources/views/components/affiliate.blade.php --}}
<section class="py-20 bg-white">
    <div class="max-w-450 mx-auto px-4 sm:px-6 lg:px-8">

        <div
            class="relative rounded-[2.5rem] bg-linear-to-br from-gray-50 to-white border border-gray-100 shadow-xl overflow-hidden p-8 lg:p-16 flex flex-col lg:flex-row items-center justify-between gap-12">

            {{-- Content --}}
            <div class="lg:w-1/2 z-10">
                <div class="inline-block text-brand font-bold text-sm tracking-wider uppercase mb-4">
                    Partner With Us
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
                    Join Our <span class="text-[#E97A37]">Affiliate Program</span>
                </h2>
                <p class="text-lg text-[#686677] mb-8 max-w-lg">
                    Earn passive income by referring clients to PubWhizz. Get industry-leading commissions on every
                    order your referrals make — for life.
                </p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center gap-3 text-gray-700 font-medium">
                        <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                stroke-linejoin="round"8 <polyline points="20 6 9 17 4 12" />
                            </svg>
                        </div>
                        Up to 15% Lifetime Commission
                    </li>
                    <li class="flex items-center gap-3 text-gray-700 font-medium">
                        <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                        </div>
                        Fast Monthly Payouts
                    </li>
                    <li class="flex items-center gap-3 text-gray-700 font-medium">
                        <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                        </div>
                        Real-time Tracking Dashboard
                    </li>
                </ul>
                <a href="#"
                    class="inline-flex items-center gap-2 bg-[#E97A37] hover:bg-[#E97A37]-dark text-white font-bold px-8 py-4 rounded-xl transition-all duration-200 shadow-md hover:shadow-lg hover:-translate-y-0.5">
                    Become an Affiliate
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            {{-- Illustration/Graphic --}}
            <div class="lg:w-1/2 relative flex justify-center items-center w-full aspect-square max-w-md">

                {{-- Circles --}}
                <div class="absolute inset-0 border border-gray-200 rounded-full"></div>
                <div class="absolute inset-8 border border-gray-200 rounded-full"></div>
                <div class="absolute inset-16 border border-gray-200 rounded-full"></div>
                <div class="absolute inset-24 border border-[#E97A37]/30 rounded-full bg-[#E97A37]-light/20"></div>

                {{-- Center Icon --}}
                <div
                    class="absolute w-20 h-20 bg-[#E97A37] rounded-full flex items-center justify-center text-white shadow-xl shadow-brand/30 z-20">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23" />
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                    </svg>
                </div>

                {{-- Avatars (orbiting representation) --}}
                <div
                    class="absolute top-0 right-1/4 w-12 h-12 bg-blue-500 rounded-full border-4 border-white shadow-md z-10 flex items-center justify-center text-white font-bold text-xs">
                    US</div>
                <div
                    class="absolute bottom-1/4 left-0 w-14 h-14 bg-green-500 rounded-full border-4 border-white shadow-md z-10 flex items-center justify-center text-white font-bold text-xs">
                    UK</div>
                <div
                    class="absolute bottom-4 right-1/3 w-10 h-10 bg-purple-500 rounded-full border-4 border-white shadow-md z-10 flex items-center justify-center text-white font-bold text-xs">
                    CA</div>
                <div
                    class="absolute top-1/4 left-8 w-12 h-12 bg-orange-400 rounded-full border-4 border-white shadow-md z-10 flex items-center justify-center text-white font-bold text-xs">
                    AU</div>

            </div>

        </div>

    </div>
</section>
