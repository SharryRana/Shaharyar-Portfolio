{{-- resources/views/components/integrations.blade.php --}}

{{-- White top space lets the phone overflow 20% above the orange section --}}
<section class="bg-white overflow-visible pt-20 lg:pt-28">

    {{-- Full-width orange CTA --}}
    <div class="w-full bg-brand overflow-visible">
        <div class="w-full overflow-visible">
            <div class="flex flex-col lg:flex-row items-center lg:min-h-80 overflow-visible">

                {{-- Phone column: -translate-y-[20%] makes 20% overflow above the orange bg --}}
                <div
                    class="w-full lg:w-[44%] shrink-0 flex justify-center lg:justify-start
                            lg:pl-10 xl:pl-20 overflow-visible">
                    <div class="relative overflow-visible pb-6 lg:pb-0">
                        <img src="{{ asset('assets/img/iMockup.svg') }}" alt="PubWhizz publisher link preview"
                            class="w-38 sm:w-46 lg:w-54 xl:w-72 object-contain select-none
                                    translate-y-[-20%]">
                    </div>
                </div>

                {{-- Text content --}}
                <div class="flex-1 px-8 pt-10 pb-7 lg:pt-12 lg:pb-9 lg:pr-16 lg:pl-8 text-center">
                    <div class="max-w-170 mx-auto flex flex-col items-center justify-center">
                        <h2
                            class="text-2xl sm:text-[28px] lg:text-[36px] font-bold text-white
                                   leading-tight mb-5">
                            <span class="block">Ready To Scale Digital PR Without</span>
                            <span class="block">Outreach?</span>
                        </h2>
                        <p
                            class="text-white/85 text-sm sm:text-base leading-relaxed mb-8
                                  max-w-155 mx-auto">
                            <span class="block">Launch Digital PR campaigns and secure placements on 35,000+
                                trusted</span>
                            <span class="block">without outreach, negotiations, or delays. No contracts. No
                                manual</span>
                            <span class="block">workflows. Built for scalable visibility and backlinks.</span>
                        </p>
                        <a href="#"
                            class="inline-flex items-center gap-2 border border-white/80 text-white
                                   px-6 py-3 rounded-sm text-sm font-semibold
                                   hover:bg-white hover:text-brand transition-all duration-200">
                            Start Your Digital PR Campaign
                            <x-blog::home.icons.arrow-up-right />
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Full-width integrations bar: #FFE5D1 --}}
    <div class="w-full bg-[#FFE5D1] py-6 lg:py-8">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 lg:gap-8 w-full">

                {{-- Heading --}}
                <div class="shrink-0 text-center lg:text-left lg:flex-none">
                    <p class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 leading-snug whitespace-nowrap">
                        Integrated With
                        <span class="relative inline-block mx-1">
                            <span class="text-brand">Most SEO</span>
                            <x-blog::home.icons.seo-underline />
                        </span>
                        Tools
                    </p>
                </div>

                {{-- Logo grid --}}
                <div class="grid grid-cols-8 justify-items-center gap-2 lg:flex lg:flex-wrap lg:justify-center lg:items-center lg:gap-4 lg:flex-1">

                    <div
                        class="col-span-2 flex items-center justify-center w-16 h-12 lg:w-25 lg:h-20 bg-[#FFE5D1]
                                border border-[#FFFFFF1A] rounded shadow-sm backdrop-blur-[1px]">
                        <x-blog::home.icons.semrush-logo class="w-8 h-9 lg:w-[52px] lg:h-14" />
                    </div>

                    <div
                        class="col-span-2 flex items-center justify-center w-16 h-12 lg:w-25 lg:h-20 bg-[#FFE5D1]
                                border border-[#FFFFFF1A] rounded shadow-sm backdrop-blur-[1px]">
                        <x-blog::home.icons.analytics-logo class="w-9 h-9 lg:w-14 lg:h-14" />
                    </div>

                    <div
                        class="col-span-2 flex items-center justify-center w-16 h-12 lg:w-25 lg:h-20 bg-[#FFE5D1]
                                border border-[#FFFFFF1A] rounded shadow-sm backdrop-blur-[1px]">
                        <x-blog::home.icons.screaming-frog-logo class="w-9 h-9 lg:w-14 lg:h-14" />
                    </div>

                    <div
                        class="col-span-2 flex items-center justify-center w-16 h-12 lg:w-25 lg:h-20 bg-[#FFE5D1]
                                border border-[#FFFFFF1A] rounded shadow-sm backdrop-blur-[1px]">
                        <x-blog::home.icons.serpstat-logo class="w-9 h-9 lg:w-14 lg:h-14" />
                    </div>

                    <div
                        class="col-span-2 col-start-2 flex items-center justify-center w-16 h-12 lg:w-25 lg:h-20 bg-[#FFE5D1]
                                border border-[#FFFFFF1A] rounded shadow-sm backdrop-blur-[1px]">
                        <x-blog::home.icons.ahrefs-logo class="w-12 h-auto lg:w-[76px]" />
                    </div>

                    <div
                        class="col-span-2 flex items-center justify-center w-16 h-12 lg:w-25 lg:h-20 bg-[#FFE5D1]
                                border border-[#FFFFFF1A] rounded shadow-sm backdrop-blur-[1px]">
                        <x-blog::home.icons.moz-logo class="w-12 h-auto lg:w-[76px]" />
                    </div>

                    <div
                        class="col-span-2 flex items-center justify-center w-16 h-12 lg:w-25 lg:h-20 bg-[#FFE5D1]
                                border border-[#FFFFFF1A] rounded shadow-sm backdrop-blur-[1px]">
                        <x-blog::home.icons.majestic-logo class="w-12 h-auto lg:w-[76px]" />
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>
