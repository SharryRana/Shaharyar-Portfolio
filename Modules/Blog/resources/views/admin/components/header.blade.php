<!-- Top Header Component -->
@php
    $notifications = $notifications ?? collect();
    $unreadNotificationsCount = $unreadNotificationsCount ?? 0;
@endphp

<header class="flex items-center justify-between h-16 px-4 sm:px-6 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 shrink-0 z-20 shadow-sm">

    <!-- Mobile Menu Button & Search -->
    <div class="flex items-center flex-1">
        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden mr-4 dark:text-gray-400">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>

        <button type="button"
                @click="toggleSidebarCollapsed()"
                class="mr-4 hidden rounded-lg p-2 text-gray-500 transition hover:bg-gray-100 hover:text-brand-accent focus:outline-none focus:ring-2 focus:ring-brand-accent/30 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-brand-accent lg:inline-flex"
                :aria-label="sidebarCollapsed ? 'Expand sidebar' : 'Collapse sidebar'"
                :title="sidebarCollapsed ? 'Expand sidebar' : 'Collapse sidebar'">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>

        <div class="w-full max-w-md hidden sm:block">
            <form action="#" method="GET" class="relative text-gray-400 focus-within:text-gray-500">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input class="block w-full h-10 pl-10 pr-3 py-2 border border-transparent rounded-lg leading-5 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:bg-white dark:focus:bg-gray-800 focus:border-brand-accent focus:ring-brand-accent/30 sm:text-sm transition-colors" placeholder="Search admin panel..." type="search" name="search">
            </form>
        </div>
    </div>

    <!-- Right Actions -->
    <div class="flex items-center gap-4">

        <!-- Dark Mode Toggle -->
        <button @click="$store.theme.toggle()" class="p-2 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 focus:outline-none bg-gray-50 dark:bg-gray-700 rounded-full transition">
            <span class="sr-only">Toggle Dark Mode</span>
            <svg x-show="$store.theme.isDark" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <svg x-show="!$store.theme.isDark" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
        </button>

        <!-- Notifications -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" @click.away="open = false" class="p-2 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 focus:outline-none relative transition rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                <span class="sr-only">View notifications</span>
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                @if($unreadNotificationsCount > 0)
                    <span class="absolute top-1.5 right-1.5 flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500 ring-2 ring-white dark:ring-gray-800"></span>
                    </span>
                @endif
            </button>

            <!-- Notifications Dropdown -->
            <div x-show="open"
                 x-transition.origin.top.right
                 class="origin-top-right absolute right-0 mt-2 w-80 sm:w-96 rounded-xl shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none z-50 border border-gray-100 dark:border-gray-700"
                 style="display: none;">

                <!-- Header -->
                <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <h3 class="text-sm font-bold text-gray-900 dark:text-white">Notifications</h3>
                    @if($unreadNotificationsCount > 0)
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                            {{ $unreadNotificationsCount }} new
                        </span>
                    @endif
                </div>

                <!-- Notifications List -->
                <div class="max-h-96 overflow-y-auto">
                    @forelse($notifications as $notification)
                        <a href="{{ $notification['link'] }}"
                           class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition border-b border-gray-50 dark:border-gray-700/50 last:border-0 {{ $notification['unread'] ? 'bg-blue-50/50 dark:bg-blue-900/10' : '' }}">
                            <div class="flex gap-3">
                                <!-- Icon -->
                                <div class="flex-shrink-0 mt-0.5">
                                    @if($notification['icon'] === 'mail')
                                        <div class="h-8 w-8 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                            <svg class="h-4 w-4 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @elseif($notification['icon'] === 'eye')
                                        <div class="h-8 w-8 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                                            <svg class="h-4 w-4 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </div>
                                    @else
                                        <div class="h-8 w-8 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                                            <svg class="h-4 w-4 text-gray-600 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $notification['title'] }}
                                        @if($notification['unread'])
                                            <span class="inline-block w-2 h-2 bg-blue-600 rounded-full ml-2"></span>
                                        @endif
                                    </p>
                                    @if($notification['description'])
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $notification['description'] }}</p>
                                    @endif
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                        {{ $notification['time']->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="px-4 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No notifications</p>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">You're all caught up!</p>
                        </div>
                    @endforelse
                </div>

                <!-- Footer -->
                @if($notifications->count() > 0)
                    <div class="px-4 py-3 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 rounded-b-xl">
                        <a href="{{ route('blog-admin.dashboard') }}" class="text-xs font-semibold text-brand-accent hover:text-orange-600 dark:hover:text-orange-400 flex items-center justify-center gap-1">
                            View all activity
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Profile Dropdown (Static Mock) -->
        <div class="relative ml-2" x-data="{ open: false }">
            <button @click="open = !open" @click.away="open = false" class="flex items-center max-w-xs text-sm focus:outline-none gap-2" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                <img class="h-8 w-8 rounded-full border-2 border-brand-accent/20 object-cover" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Admin Profile">
                <div class="hidden sm:block text-left">
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-200">{{ auth()->user()->name }}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 hidden sm:block" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
            </button>

            <div x-show="open" x-transition.origin.top.right class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none z-50 border border-gray-100 dark:border-gray-700" style="display: none;">
                <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700 mb-1">
                    <p class="text-sm dark:text-white">Signed in as</p>
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-300 truncate">{{ auth()->user()->email }}</p>
                </div>
                <a href="{{ route('blog-admin.profile') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Your Profile</a>
                <a href="{{ route('blog-admin.settings') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Settings</a>
                <div class="border-t border-gray-100 dark:border-gray-700 mt-1 pt-1">
                    <form action="{{ route('blog-admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">Sign out</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</header>
