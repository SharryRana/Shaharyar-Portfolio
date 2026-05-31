<section class="pt-24 lg:pt-32">
    <div class="mx-auto max-w-[1500px] px-4 sm:px-6 lg:px-8">
        <div
            class="relative isolate flex min-h-[535px] items-center justify-center overflow-hidden rounded-[22px] bg-[#F3752F] px-6 py-20 text-center text-white sm:min-h-[390px] lg:min-h-[385px]">
            <div class="pointer-events-none absolute inset-0 overflow-hidden">
                <x-blog::shared.hero-pattern side="left"
                    class="absolute left-0 top-0 h-[245px] w-auto max-w-none lg:bottom-0 lg:top-auto lg:h-[333px] lg:w-[402px]" />
                <x-blog::shared.hero-pattern side="right"
                    class="absolute bottom-0 right-0 h-[245px] w-auto max-w-none lg:h-[333px] lg:w-[401px]" />
            </div>

            <div class="relative z-10">
                <span
                    class="inline-flex rounded-xl bg-white px-6 py-3 text-[22px] font-semibold uppercase tracking-[0] text-[#F3752F] lg:text-2xl">Write
                    To Us</span>
                <h1 class="mt-9 text-[34px] font-extrabold leading-tight sm:text-5xl lg:text-[54px]">Get In Touch</h1>
            </div>
        </div>
    </div>
</section>

<section class="mx-auto max-w-[1500px] px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
    <div class="grid gap-6 lg:grid-cols-2">
        <div class="bg-white p-0 lg:rounded-[4px] lg:p-9 lg:shadow-[0_12px_45px_rgba(28,20,18,0.04)]">
            <h2 class="text-[28px] font-extrabold leading-tight text-[#1C1412] sm:text-4xl">Let&apos;s Talk</h2>
            <p class="mt-4 max-w-xl text-base font-medium leading-relaxed text-[#686677] sm:text-xl">
                Get in touch with us using the inquiry from or contact details below
            </p>
            <div class="mt-5 hidden h-px max-w-xl bg-[#CBCAD7] lg:block"></div>

            @if(session('success'))
                <div class="mt-6 rounded-lg border border-green-200 bg-green-50 px-5 py-4 text-sm font-semibold text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div data-contact-status class="mt-6 hidden rounded-lg border px-5 py-4 text-sm font-semibold"></div>

            <form class="mt-7 space-y-6" action="{{ route('blog.contact-us.submit') }}" method="POST" data-contact-form novalidate>
                @csrf
                <div class="grid gap-6 sm:grid-cols-2">
                    <label class="block">
                        <span class="text-sm font-bold text-[#686677] sm:text-base">First Name</span>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" required data-contact-field
                            class="mt-3 h-14 w-full rounded-lg border border-[#CBCAD7] px-5 text-base font-bold text-[#1C1412] outline-none transition focus:border-[#F3752F] focus:ring-2 focus:ring-[#F3752F]/20">
                        <span data-contact-error-for="first_name" class="mt-2 hidden text-sm font-semibold text-red-600"></span>
                        @error('first_name')
                            <span class="mt-2 block text-sm font-semibold text-red-600">{{ $message }}</span>
                        @enderror
                    </label>
                    <label class="block">
                        <span class="text-sm font-bold text-[#686677] sm:text-base">Last Name</span>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" data-contact-field
                            class="mt-3 h-14 w-full rounded-lg border border-[#CBCAD7] px-5 text-base font-bold text-[#1C1412] outline-none transition focus:border-[#F3752F] focus:ring-2 focus:ring-[#F3752F]/20">
                        <span data-contact-error-for="last_name" class="mt-2 hidden text-sm font-semibold text-red-600"></span>
                        @error('last_name')
                            <span class="mt-2 block text-sm font-semibold text-red-600">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <label class="block">
                    <span class="text-sm font-bold text-[#686677] sm:text-base">Email</span>
                    <input type="email" name="email" value="{{ old('email') }}" required data-contact-field
                        class="mt-3 h-14 w-full rounded-lg border border-[#CBCAD7] px-5 text-base font-bold text-[#1C1412] outline-none transition focus:border-[#F3752F] focus:ring-2 focus:ring-[#F3752F]/20">
                    <span data-contact-error-for="email" class="mt-2 hidden text-sm font-semibold text-red-600"></span>
                    @error('email')
                        <span class="mt-2 block text-sm font-semibold text-red-600">{{ $message }}</span>
                    @enderror
                </label>

                <label class="block">
                    <span class="text-sm font-bold text-[#686677] sm:text-base">Subject</span>
                    <input type="text" name="subject" value="{{ old('subject') }}" data-contact-field
                        class="mt-3 h-14 w-full rounded-lg border border-[#CBCAD7] px-5 text-base font-bold text-[#1C1412] outline-none transition focus:border-[#F3752F] focus:ring-2 focus:ring-[#F3752F]/20">
                    <span data-contact-error-for="subject" class="mt-2 hidden text-sm font-semibold text-red-600"></span>
                    @error('subject')
                        <span class="mt-2 block text-sm font-semibold text-red-600">{{ $message }}</span>
                    @enderror
                </label>

                <label class="block">
                    <span class="text-sm font-bold text-[#686677] sm:text-base">Message</span>
                    <textarea rows="6" name="message" placeholder="Type something..." required data-contact-field
                        class="mt-3 min-h-32 w-full resize-none rounded-lg border border-[#CBCAD7] px-5 py-5 text-sm font-medium text-[#1C1412] outline-none transition placeholder:text-[#A4A2AE] focus:border-[#F3752F] focus:ring-2 focus:ring-[#F3752F]/20 lg:min-h-36">{{ old('message') }}</textarea>
                    <span data-contact-error-for="message" class="mt-2 hidden text-sm font-semibold text-red-600"></span>
                    @error('message')
                        <span class="mt-2 block text-sm font-semibold text-red-600">{{ $message }}</span>
                    @enderror
                </label>

                <button type="submit"
                    class="flex h-14 w-full items-center justify-center rounded-lg bg-[#F3752F] text-base font-bold text-white transition hover:bg-[#d4651f] disabled:cursor-not-allowed disabled:opacity-70">
                    <span data-contact-spinner class="mr-3 hidden h-5 w-5 animate-spin rounded-full border-2 border-white/50 border-t-white"></span>
                    <span data-contact-submit-label>Submit</span>
                </button>
            </form>
        </div>

        <div class="hidden overflow-hidden rounded-[24px] bg-[#FFE5D1] lg:block">
            <div class="relative h-full min-h-[680px] overflow-hidden">
                <div class="pointer-events-none absolute inset-0 z-0 overflow-hidden">
                    <svg class="absolute left-0 top-[58px] h-[404px] w-[225px]" width="225" height="404"
                        viewBox="0 0 225 404" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M76.3438 179.934V243.486C76.3438 250.789 67.836 254.829 62.2672 250.012L-66.8969 139.223C-68.7531 137.514 -69.8359 135.183 -69.8359 132.697L-69.3719 67.1248C-69.3719 59.8217 -60.7094 55.9371 -55.1406 60.754L73.7141 173.719C75.5703 175.272 76.6531 177.759 76.6531 180.245L76.3438 179.934Z"
                            fill="#E97A37" fill-opacity="0.07" />
                        <path
                            d="M171.631 89.656L129.401 55.4714C124.915 51.8975 118.263 53.6068 116.098 58.8899L82.0665 144.662C78.9728 152.431 87.79 159.734 94.7509 154.918L171.012 103.33C175.807 100.067 176.117 93.2299 171.631 89.5006V89.656Z"
                            fill="#E97A37" fill-opacity="0.07" />
                        <path
                            d="M-188.478 306.262C-109.742 263.22 88.5675 273.786 140.697 310.302C166.375 329.725 147.039 356.14 121.052 344.02C24.3722 313.565 -72.3075 312.477 -168.678 344.02C-201.626 359.093 -218.487 327.239 -188.323 306.262H-188.478Z"
                            fill="#E97A37" fill-opacity="0.07" />
                    </svg>
                    <svg class="absolute right-0 top-[58px] h-[404px] w-[240px]" width="240" height="404"
                        viewBox="0 0 240 404" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M205.892 163.154V238.205C205.892 245.508 197.384 249.548 191.816 244.731L67.1375 137.36C65.2813 135.806 64.1984 133.32 64.1984 130.834L63.7344 56.8711C63.7344 49.568 72.2422 45.528 77.8109 50.3449L202.953 156.628C204.809 158.182 206.047 160.668 206.047 163.154H205.892Z"
                            fill="#E97A37" fill-opacity="0.07" />
                        <path
                            d="M346.344 179.934V243.486C346.344 250.789 337.836 254.829 332.267 250.012L203.103 139.223C201.247 137.514 200.164 135.183 200.164 132.697L200.628 67.1248C200.628 59.8217 209.291 55.9371 214.859 60.754L343.714 173.719C345.57 175.272 346.653 177.759 346.653 180.245L346.344 179.934Z"
                            fill="#E97A37" fill-opacity="0.07" />
                        <path
                            d="M81.5222 306.262C160.258 263.22 358.567 273.786 410.697 310.302C436.375 329.725 417.039 356.14 391.052 344.02C294.372 313.565 197.692 312.477 101.322 344.02C68.3737 359.093 51.5128 327.239 81.6769 306.262H81.5222Z"
                            fill="#E97A37" fill-opacity="0.07" />
                    </svg>
                </div>

                <img src="{{ asset('assets/img/contactus_form.svg') }}" alt="PubWhizz support contact"
                    class="absolute bottom-[198px] left-1/2 z-10 h-[430px] w-[360px] -translate-x-1/2 object-cover object-top">

                <div class="absolute bottom-5 left-5 right-5 z-30 rounded-[24px] bg-[#F3752F] px-6 py-8">
                    <div class="mx-auto flex max-w-[430px] flex-col items-center gap-5">
                        <a href="mailto:support@pubwhizz.com"
                            class="inline-flex min-h-14 w-fit items-center gap-3 rounded-lg bg-white px-4 text-base font-extrabold text-[#1C1412]">
                            <span
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded bg-[#F3752F] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="14" x="3" y="5" rx="2" />
                                    <path d="m3 7 9 6 9-6" />
                                </svg>
                            </span>
                            <span class="whitespace-nowrap">Email: <span
                                    class="font-semibold text-[#686677]">support@pubwhizz.com</span></span>
                        </a>
                        <a href="https://wa.me/447988578435"
                            class="inline-flex min-h-14 w-fit items-center gap-3 rounded-lg bg-white px-4 text-base font-extrabold text-[#1C1412]">
                            <span
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded bg-[#F3752F] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 21l1.6-4.8A8.5 8.5 0 1 1 7.8 19L3 21Z" />
                                    <path d="M9.5 8.8c.2 2.7 2 4.5 4.7 4.7l1-1.2c.3-.3.8-.4 1.2-.2l1.5.8" />
                                </svg>
                            </span>
                            <span class="whitespace-nowrap">What&apos;s App: <span
                                    class="font-semibold text-[#686677]">+447988578435</span></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-[#FFE5D1] px-4 py-10 lg:hidden mb-5">
    <div class="mx-auto flex max-w-[360px] flex-col items-center gap-4">
        <a href="mailto:support@Pubwhizz.Com"
            class="inline-flex min-h-12 w-fit items-center gap-2 rounded-lg bg-white px-2 text-[13px] font-extrabold text-[#1C1412]">
            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded bg-[#F3752F] text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"
                    stroke-linejoin="round">
                    <rect width="18" height="14" x="3" y="5" rx="2" />
                    <path d="m3 7 9 6 9-6" />
                </svg>
            </span>
            <span class="whitespace-nowrap">Email: <span class="text-[#686677]">support@Pubwhizz.Com</span></span>
        </a>
        <a href="https://wa.me/447988578435"
            class="inline-flex min-h-12 w-fit items-center gap-2 rounded-lg bg-white px-2 text-[13px] font-extrabold text-[#1C1412]">
            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded bg-[#F3752F] text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M3 21l1.6-4.8A8.5 8.5 0 1 1 7.8 19L3 21Z" />
                    <path d="M9.5 8.8c.2 2.7 2 4.5 4.7 4.7l1-1.2c.3-.3.8-.4 1.2-.2l1.5.8" />
                </svg>
            </span>
            <span class="whitespace-nowrap">What&apos;s App: <span class="text-[#686677]">+447988578435</span></span>
        </a>
    </div>
</section>

<a href="#top"
    class="fixed bottom-10 right-10 z-40 hidden h-14 w-14 items-center justify-center rounded-full bg-[#F3752F] text-white shadow-lg lg:flex"
    aria-label="Back to top">
    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M13.5373 19.6984L13.5253 19.6704C13.345 19.6211 13.1663 19.5664 12.9893 19.5064L12.9759 19.501C11.134 18.8708 9.53525 17.6805 8.40343 16.0965C7.27162 14.5126 6.6634 12.6144 6.66394 10.6677C6.66334 8.27851 7.57901 5.98006 9.22232 4.24578C10.8656 2.5115 13.1115 1.47345 15.4972 1.34545C17.883 1.21744 20.227 2.00923 22.0464 3.55772C23.8659 5.10622 25.0222 7.29349 25.2773 9.66903C25.3359 10.2184 24.8826 10.6677 24.3306 10.6677C23.7786 10.6677 23.3373 10.217 23.2639 9.67036C23.0866 8.38005 22.5689 7.16024 21.764 6.13629C20.9591 5.11234 19.896 4.32118 18.6841 3.84413C17.4722 3.36708 16.1551 3.22134 14.8682 3.4219C13.5813 3.62245 12.371 4.16207 11.3617 4.98528C10.3524 5.80849 9.5805 6.8856 9.12535 8.10593C8.67021 9.32625 8.54821 10.6458 8.77191 11.9288C8.99561 13.2119 9.55693 14.4123 10.3982 15.4066C11.2394 16.4009 12.3303 17.1533 13.5586 17.5864C13.806 17.0271 14.2382 16.5698 14.7827 16.2913C15.3272 16.0127 15.9508 15.9298 16.5492 16.0563C17.1475 16.1829 17.6842 16.5113 18.0692 16.9865C18.4542 17.4617 18.6642 18.0548 18.6639 18.6664C18.6639 19.4637 18.3146 20.1784 17.7613 20.6664C17.2743 21.0965 16.647 21.334 15.9973 21.3344C15.4712 21.3362 14.9565 21.1817 14.5185 20.8904C14.0805 20.5991 13.739 20.1842 13.5373 19.6984ZM10.6599 20.6677C9.67723 20.1426 8.77732 19.4754 7.98927 18.6877C7.25879 18.7727 6.58497 19.123 6.09581 19.6721C5.60666 20.2213 5.33624 20.931 5.33594 21.6664V22.437C5.33594 23.6264 5.75994 24.7784 6.53327 25.6837C8.62127 28.129 11.8026 29.337 15.9973 29.337C20.1919 29.337 23.3746 28.129 25.4666 25.6837C26.2418 24.778 26.6678 23.6251 26.6679 22.433V21.6664C26.6679 20.8712 26.3522 20.1085 25.7902 19.546C25.2282 18.9834 24.4658 18.6671 23.6706 18.6664H20.6639C20.6639 19.3837 20.5039 20.061 20.2146 20.6664H23.6706C23.9354 20.6671 24.189 20.7727 24.376 20.9602C24.563 21.1477 24.6679 21.4016 24.6679 21.6664V22.433C24.6682 23.1483 24.4128 23.8401 23.9479 24.3837C22.2719 26.341 19.6493 27.3357 15.9973 27.3357C12.3453 27.3357 9.72527 26.341 8.0546 24.385C7.59004 23.8418 7.33471 23.1505 7.3346 22.4357V21.6664C7.3346 21.4011 7.43996 21.1468 7.6275 20.9593C7.81503 20.7717 8.06939 20.6664 8.3346 20.6664L10.6599 20.6677ZM10.6639 10.6677C10.6642 9.74776 10.9024 8.84353 11.3554 8.04286C11.8084 7.24219 12.4608 6.57231 13.2492 6.09829C14.0376 5.62428 14.9352 5.36226 15.8548 5.33768C16.7744 5.3131 17.6847 5.52681 18.4973 5.95803C19.3099 6.38926 19.9972 7.02334 20.4923 7.79868C20.9874 8.57401 21.2735 9.46422 21.3229 10.3828C21.3723 11.3014 21.1832 12.2172 20.7741 13.0411C20.3649 13.8651 19.7496 14.5692 18.9879 15.085C18.1488 14.3846 17.0903 14.001 15.9973 14.001C16.8813 14.001 17.7292 13.6498 18.3543 13.0247C18.9794 12.3996 19.3306 11.5518 19.3306 10.6677C19.3306 9.78364 18.9794 8.93579 18.3543 8.31067C17.7292 7.68555 16.8813 7.33436 15.9973 7.33436C15.1132 7.33436 14.2654 7.68555 13.6402 8.31067C13.0151 8.93579 12.6639 9.78364 12.6639 10.6677C12.6639 11.5518 13.0151 12.3996 13.6402 13.0247C14.2654 13.6498 15.1132 14.001 15.9973 14.001C14.8586 14.001 13.8159 14.409 13.0079 15.085C12.2851 14.5972 11.6933 13.9392 11.2846 13.1689C10.8758 12.3987 10.6627 11.5397 10.6639 10.6677Z"
            fill="white" />
    </svg>

</a>
