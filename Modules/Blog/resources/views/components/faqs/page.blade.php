@props(['initialTab' => 'general', 'faqGroups' => []])

@php
    $initialTab = in_array($initialTab, ['general', 'advertiser', 'publisher'], true) ? $initialTab : 'general';

    $faqGroups = array_replace([
        'general' => [],
        'advertiser' => [],
        'publisher' => [],
    ], $faqGroups);
@endphp

<section class="pt-24 lg:pt-32">
    <div class="relative overflow-hidden pb-16 pt-14 text-center lg:pb-26 lg:pt-20">
        <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-[#FFE5D1]/70 to-transparent"></div>
        <div class="relative mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <span
                class="inline-flex rounded-full bg-[#FFE5D1] px-5 py-2.5 text-sm font-extrabold text-[#F3752F]">FAQs</span>
            <h1 class="mt-6 text-[30px] font-extrabold leading-tight text-[#1C1412] sm:text-5xl lg:text-[54px]">
                Frequently Asked Questions</h1>
            <p class="mx-auto mt-5 max-w-2xl text-base font-semibold leading-relaxed text-[#686677] sm:text-lg">
                These are the most commonly asked questions about Untitled UI. Can&apos;t find what you&apos;re looking
                for?
                <a href="{{ route('blog.contact-us') }}" class="text-[#F3752F] underline">Chat to our friendly team.</a>
            </p>
        </div>
    </div>
</section>

<section class="mx-auto max-w-[930px] px-4 py-8 sm:px-6 lg:py-12" x-data="{ tab: @js($initialTab), open: 0 }">
    <div class="mx-auto mb-10 flex w-max max-w-full gap-2">
        <button type="button" @click="tab = 'general'; open = 0"
            :class="tab === 'general' ? 'bg-[#F3752F] text-white border-[#F3752F]' : 'bg-white text-[#686677] border-[#686677]'"
            class="rounded-md border px-5 py-3 text-sm font-extrabold transition sm:min-w-32">General</button>
        <button type="button" @click="tab = 'advertiser'; open = 0"
            :class="tab === 'advertiser' ? 'bg-[#F3752F] text-white border-[#F3752F]' :
                'bg-white text-[#686677] border-[#686677]'"
            class="rounded-md border px-5 py-3 text-sm font-extrabold transition sm:min-w-40">For Advertisers</button>
        <button type="button" @click="tab = 'publisher'; open = 0"
            :class="tab === 'publisher' ? 'bg-[#F3752F] text-white border-[#F3752F]' :
                'bg-white text-[#686677] border-[#686677]'"
            class="rounded-md border px-5 py-3 text-sm font-extrabold transition sm:min-w-40">For Publishers</button>
    </div>

    <div>
        @foreach ($faqGroups as $group => $faqs)
            <div x-show="tab === '{{ $group }}'" class="space-y-4">
                @forelse ($faqs as $index => $faq)
                    <div
                        class="rounded-sm bg-white px-5 shadow-[0_6px_25px_rgba(28,20,18,0.03)] lg:px-6 {{ $index === 0 ? 'py-6 lg:py-7' : 'py-5' }}">
                        <button type="button"
                            class="flex w-full justify-between gap-4 text-left {{ $index === 0 ? 'items-start' : 'items-center' }}"
                            @click="open = open === {{ $index }} ? null : {{ $index }}">
                            <span
                                class="font-extrabold text-[#1C1412] {{ $index === 0 ? 'text-lg' : '' }}">{{ $faq['question'] }}</span>
                            <span class="flex items-center gap-4 text-[#686677]">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6 4.9635V3.5C6 3.10218 6.15804 2.72064 6.43934 2.43934C6.72064 2.15804 7.10218 2 7.5 2H20.5C20.8978 2 21.2794 2.15804 21.5607 2.43934C21.842 2.72064 22 3.10218 22 3.5V16.5C22 16.8978 21.842 17.2794 21.5607 17.5607C21.2794 17.842 20.8978 18 20.5 18H19.0085"
                                        stroke="#686677" stroke-width="1.4" />
                                    <path
                                        d="M17.5 5H3.5C2.67157 5 2 5.67157 2 6.5V20.5C2 21.3284 2.67157 22 3.5 22H17.5C18.3284 22 19 21.3284 19 20.5V6.5C19 5.67157 18.3284 5 17.5 5Z"
                                        stroke="#686677" stroke-width="1.4" stroke-linejoin="round" />
                                    <path
                                        d="M9.21996 11.5546L11.866 8.79961C12.5915 8.07411 13.7845 8.08961 14.53 8.83561C15.2755 9.58161 15.2915 10.7741 14.566 11.4996L13.611 12.5111M6.73296 14.3731C6.47796 14.6281 5.95046 15.1381 5.95046 15.1381C5.22446 15.8636 5.20446 17.1571 5.95046 17.9031C6.69546 18.6481 7.88846 18.6646 8.61446 17.9386L11.1965 15.5946"
                                        stroke="#686677" stroke-width="1.4" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M9.32811 14.164C8.99586 13.8341 8.79488 13.3946 8.76261 12.9275C8.74363 12.6655 8.78112 12.4025 8.87255 12.1562C8.96399 11.9099 9.10724 11.6861 9.29261 11.5M11.1571 12.9305C11.9026 13.676 11.9186 14.869 11.1931 15.595"
                                        stroke="#686677" stroke-width="1.4" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <svg x-show="open === {{ $index }}" xmlns="http://www.w3.org/2000/svg"
                                    width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F3752F"
                                    stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6" />
                                </svg>
                            </span>
                        </button>
                        <div x-show="open === {{ $index }}"
                            class="{{ $index === 0 ? 'mt-5' : 'mt-4' }} text-base font-medium leading-relaxed text-[#686677]">
                            <p>{!! nl2br(e($faq['answer'])) !!}</p>
                        </div>
                    </div>
                @empty
                    <div class="rounded-sm bg-white px-5 py-8 text-center shadow-[0_6px_25px_rgba(28,20,18,0.03)] lg:px-6">
                        <p class="text-base font-semibold text-[#686677]">No FAQs are available in this category yet.</p>
                    </div>
                @endforelse
            </div>
        @endforeach
    </div>
</section>

<div class="pb-16 lg:pb-24"></div>
