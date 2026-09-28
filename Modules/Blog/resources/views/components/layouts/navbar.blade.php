{{-- resources/views/components/navbar.blade.php --}}
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 border-b border-[#CBCAD7]"
    x-data="{ open: false, scrolled: false }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
    :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-sm border-b border-gray-100' : 'bg-transparent'">
    <div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-18">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-0.5 flex-shrink-0">
                <span class="text-[20px] sm:text-[24px] font-bold text-gray-900">Creavibe<span class="text-[#06b6d4]">.</span></span>
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden lg:flex items-center gap-8">
                <a href="{{ route('home') }}"
                    class="text-sm font-medium {{ request()->routeIs('home') ? 'text-[#06b6d4]' : 'text-[#686677] hover:text-[#06b6d4]' }} transition-colors duration-200">Home</a>
                <a href="{{ route('about') }}"
                    class="text-sm font-medium {{ request()->routeIs('about') ? 'text-[#06b6d4]' : 'text-[#686677] hover:text-[#06b6d4]' }} transition-colors duration-200">About</a>
                <a href="{{ route('services.index') }}"
                    class="text-sm font-medium {{ request()->routeIs('services.*') ? 'text-[#06b6d4]' : 'text-[#686677] hover:text-[#06b6d4]' }} transition-colors duration-200">Services</a>
                <a href="{{ route('blog.index') }}"
                    class="text-sm font-medium {{ request()->routeIs('blog.*') ? 'text-[#06b6d4]' : 'text-[#686677] hover:text-[#06b6d4]' }} transition-colors duration-200">Blog</a>
                <a href="{{ route('contact') }}"
                    class="text-sm font-medium {{ request()->routeIs('contact') ? 'text-[#06b6d4]' : 'text-[#686677] hover:text-[#06b6d4]' }} transition-colors duration-200">Contact</a>
            </div>

            {{-- CTAs & Mobile Hamburger --}}
            <div class="flex items-center gap-2">
                {{-- Desktop CTAs --}}
                <div class="hidden lg:flex items-center gap-2">
                    <a href="{{ route('contact') }}"
                        class="text-sm font-medium text-white bg-[#06b6d4] hover:bg-[#0891b2] transition-colors duration-200 px-5 py-2 rounded-lg">
                        Get in Touch
                    </a>
                </div>

                {{-- Mobile Contact Button --}}
                <a href="{{ route('contact') }}"
                    class="lg:hidden text-[13px] font-semibold text-white bg-[#06b6d4] hover:bg-[#0891b2] px-3.5 py-1.5 rounded-lg transition-colors">
                    Contact
                </a>

                {{-- Mobile Hamburger --}}
                <button @click="open = !open"
                    class="lg:hidden p-1.5 rounded-lg text-[#686677] hover:text-[#06b6d4] transition-colors"
                    aria-label="Toggle menu">
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <line x1="3" y1="6" x2="21" y2="6" />
                        <line x1="3" y1="12" x2="21" y2="12" />
                        <line x1="3" y1="18" x2="21" y2="18" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" style="display:none;">
                        <path d="M18 6L6 18M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu (Slide-over) --}}
        <div x-show="open"
             class="fixed inset-0 z-[60] lg:hidden"
             style="display: none;">

            {{-- Backdrop --}}
            <div x-show="open"
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="open = false"
                 class="fixed inset-0 bg-gray-900/40 backdrop-blur-[2px]"></div>

            {{-- Drawer --}}
            <div x-show="open"
                 x-transition:enter="transition ease-in-out duration-300 transform"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in-out duration-300 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full"
                 class="fixed inset-y-0 right-0 w-full max-w-[280px] bg-white shadow-2xl flex flex-col">

                {{-- Drawer Header --}}
                <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
                    <a href="{{ route('home') }}" class="flex items-center gap-0.5">
                        <span class="text-xl font-bold text-gray-900">Creavibe<span class="text-[#06b6d4]">.</span></span>
                    </a>
                    <button @click="open = false" class="p-1 rounded-lg text-gray-400 hover:text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                </div>

                {{-- Drawer Links --}}
                @php
                    $mobileLinks = [
                        ['label' => 'Home', 'href' => route('home'), 'active' => request()->routeIs('home')],
                        ['label' => 'About', 'href' => route('about'), 'active' => request()->routeIs('about')],
                        ['label' => 'Services', 'href' => route('services.index'), 'active' => request()->routeIs('services.*')],
                        ['label' => 'Blog', 'href' => route('blog.index'), 'active' => request()->routeIs('blog.*')],
                        ['label' => 'Contact Us', 'href' => route('contact'), 'active' => request()->routeIs('contact')],
                        ['label' => 'Privacy Policy', 'href' => route('privacy'), 'active' => request()->routeIs('privacy')],
                        ['label' => 'Terms & Conditions', 'href' => route('terms'), 'active' => request()->routeIs('terms')],
                    ];
                @endphp

                <div class="flex-1 overflow-y-auto py-8 space-y-6">
                    @foreach ($mobileLinks as $link)
                        <div class="relative px-6">
                            @if ($link['active'])
                                <div
                                    class="absolute left-0 top-1/2 h-8 w-1.5 -translate-y-1/2 rounded-r-full bg-[#E97A37]">
                                </div>
                            @endif
                            <a href="{{ $link['href'] }}"
                                class="block text-[16px] {{ $link['active'] ? 'font-semibold text-[#E97A37]' : 'font-medium text-gray-600 hover:text-[#E97A37]' }} transition-colors">
                                {{ $link['label'] }}
                            </a>
                        </div>
                    @endforeach
                </div>

                {{-- Drawer Footer --}}
                <div class="p-6 border-t border-gray-100">
                    <a href="#" class="block w-full text-center py-3 px-4 rounded-lg border border-[#686677] text-[15px] font-semibold text-gray-700 hover:bg-gray-50 transition-all">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
