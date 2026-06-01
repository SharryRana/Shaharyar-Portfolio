<!-- Sidebar Component -->
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
       :data-sidebar-collapsed="sidebarCollapsed"
       class="admin-sidebar fixed inset-y-0 left-0 z-30 flex h-[100dvh] w-64 flex-col border-r border-gray-100 bg-white transition-[width,transform] duration-300 ease-in-out dark:border-gray-700 dark:bg-gray-800 lg:static lg:h-screen lg:w-64 lg:data-[sidebar-collapsed=true]:w-20">

    <!-- Logo -->
    <div class="h-16 flex items-center px-6 border-b border-gray-100 dark:border-gray-700 shrink-0">
        <a href="{{ route('blog-admin.dashboard') }}" class="flex items-center gap-3">
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-brand-accent text-sm font-black text-white shadow-sm">C</span>
            <div class="admin-sidebar-logo-text flex flex-col">
                <span class="text-sm font-bold text-gray-900 dark:text-white">Creavibe</span>
                <span class="text-xs text-gray-500 dark:text-gray-400 font-semibold">ADMIN</span>
            </div>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1">

        <p class="admin-sidebar-section px-3 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-2">Overview</p>

        <a href="{{ route('blog-admin.dashboard') }}" class="admin-sidebar-link {{ request()->routeIs('blog-admin.dashboard') ? 'bg-brand-accent/10 text-brand-accent dark:bg-brand-accent/20 font-bold' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group" title="Dashboard">
            <svg class="{{ request()->routeIs('blog-admin.dashboard') ? 'text-brand-accent' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-300' }} mr-3 h-5 w-5 shrink-0 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            <span class="admin-sidebar-label">Dashboard</span>
        </a>

        <div class="pt-4">
            <p class="admin-sidebar-section px-3 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-2">Management</p>

            <a href="{{ route('blog-admin.users.index') }}" class="admin-sidebar-link {{ request()->routeIs('blog-admin.users.*') ? 'bg-brand-accent/10 text-brand-accent dark:bg-brand-accent/20 font-bold' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group mt-1" title="Users Listing">
                <svg class="{{ request()->routeIs('blog-admin.users.*') ? 'text-brand-accent' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-300' }} mr-3 h-5 w-5 shrink-0 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span class="admin-sidebar-label">Users Listing</span>
            </a>

            <a href="{{ route('blog-admin.articles.index') }}" class="admin-sidebar-link {{ request()->routeIs('blog-admin.articles.*') ? 'bg-brand-accent/10 text-brand-accent dark:bg-brand-accent/20 font-bold' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group mt-1" title="Editorial Articles">
                <svg class="{{ request()->routeIs('blog-admin.articles.*') ? 'text-brand-accent' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-300' }} mr-3 h-5 w-5 shrink-0 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
                <span class="admin-sidebar-label">Editorial Articles</span>
            </a>

            <a href="{{ route('blog-admin.authors.index') }}" class="admin-sidebar-link {{ request()->routeIs('blog-admin.authors.*') ? 'bg-brand-accent/10 text-brand-accent dark:bg-brand-accent/20 font-bold' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group mt-1" title="Authors">
                <svg class="{{ request()->routeIs('blog-admin.authors.*') ? 'text-brand-accent' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-300' }} mr-3 h-5 w-5 shrink-0 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A8.966 8.966 0 0112 15c2.21 0 4.236.8 5.799 2.128M15 11a3 3 0 10-6 0 3 3 0 006 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21a7 7 0 10-14 0" />
                </svg>
                <span class="admin-sidebar-label">Authors</span>
            </a>

            <a href="{{ route('blog-admin.blog-categories.index') }}" class="admin-sidebar-link {{ request()->routeIs('blog-admin.blog-categories.*') ? 'bg-brand-accent/10 text-brand-accent dark:bg-brand-accent/20 font-bold' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group mt-1" title="Blog Categories">
                <svg class="{{ request()->routeIs('blog-admin.blog-categories.*') ? 'text-brand-accent' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-300' }} mr-3 h-5 w-5 shrink-0 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z" />
                </svg>
                <span class="admin-sidebar-label">Blog Categories</span>
            </a>

            <a href="{{ route('blog-admin.faqs.index') }}" class="admin-sidebar-link {{ request()->routeIs('blog-admin.faqs.*') ? 'bg-brand-accent/10 text-brand-accent dark:bg-brand-accent/20 font-bold' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group mt-1" title="FAQs">
                <svg class="{{ request()->routeIs('blog-admin.faqs.*') ? 'text-brand-accent' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-300' }} mr-3 h-5 w-5 shrink-0 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="admin-sidebar-label">FAQs</span>
            </a>

            <a href="{{ route('blog-admin.descriptions.index') }}" class="admin-sidebar-link {{ request()->routeIs('blog-admin.descriptions.*') ? 'bg-brand-accent/10 text-brand-accent dark:bg-brand-accent/20 font-bold' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group mt-1" title="Descriptions">
                <svg class="{{ request()->routeIs('blog-admin.descriptions.*') ? 'text-brand-accent' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-300' }} mr-3 h-5 w-5 shrink-0 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <span class="admin-sidebar-label">Descriptions</span>
            </a>

            <a href="{{ route('blog-admin.pages.index') }}" class="admin-sidebar-link {{ request()->routeIs('blog-admin.pages.*') ? 'bg-brand-accent/10 text-brand-accent dark:bg-brand-accent/20 font-bold' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group mt-1" title="Pages">
                <svg class="{{ request()->routeIs('blog-admin.pages.*') ? 'text-brand-accent' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-300' }} mr-3 h-5 w-5 shrink-0 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span class="admin-sidebar-label">Pages</span>
            </a>

            @php $unreadCount = \Modules\Blog\Models\ContactMessage::where('is_read', false)->count(); @endphp
            <a href="{{ route('blog-admin.messages.index') }}" class="admin-sidebar-link {{ request()->routeIs('blog-admin.messages.*') ? 'bg-brand-accent/10 text-brand-accent dark:bg-brand-accent/20 font-bold' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group mt-1" title="Messages">
                <span class="flex items-center">
                    <svg class="{{ request()->routeIs('blog-admin.messages.*') ? 'text-brand-accent' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-300' }} mr-3 h-5 w-5 shrink-0 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="admin-sidebar-label">Messages</span>
                </span>
                @if($unreadCount > 0)
                    <span class="admin-sidebar-badge inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold leading-none text-white bg-red-500 rounded-full">{{ $unreadCount }}</span>
                @endif
            </a>

            <a href="{{ route('blog-admin.comments.index') }}" class="admin-sidebar-link {{ request()->routeIs('blog-admin.comments.*') ? 'bg-brand-accent/10 text-brand-accent dark:bg-brand-accent/20 font-bold' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group mt-1" title="Comments">
                <svg class="{{ request()->routeIs('blog-admin.comments.*') ? 'text-brand-accent' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-300' }} mr-3 h-5 w-5 shrink-0 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h6m-8 8 4-4h8a4 4 0 004-4V7a4 4 0 00-4-4H7a4 4 0 00-4 4v5a4 4 0 004 4z" />
                </svg>
                <span class="admin-sidebar-label">Comments</span>
            </a>

            <a href="{{ route('blog-admin.newsletter.index') }}" class="admin-sidebar-link {{ request()->routeIs('blog-admin.newsletter.*') ? 'bg-brand-accent/10 text-brand-accent dark:bg-brand-accent/20 font-bold' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group mt-1" title="Newsletter">
                <svg class="{{ request()->routeIs('blog-admin.newsletter.*') ? 'text-brand-accent' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-300' }} mr-3 h-5 w-5 shrink-0 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 8.25V18a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18V8.25m18 0A2.25 2.25 0 0018.75 6H5.25A2.25 2.25 0 003 8.25m18 0v.243a2.25 2.25 0 01-1.07 1.916l-6.75 4.02a2.25 2.25 0 01-2.36 0l-6.75-4.02A2.25 2.25 0 013 8.493V8.25" />
                </svg>
                <span class="admin-sidebar-label">Newsletter</span>
            </a>
        </div>

        <div class="pt-4">
            <p class="admin-sidebar-section px-3 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-2">System</p>

            <a href="{{ route('blog-admin.analytics') }}" class="admin-sidebar-link {{ request()->routeIs('blog-admin.analytics') ? 'bg-brand-accent/10 text-brand-accent dark:bg-brand-accent/20 font-bold' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group mb-1" title="Analytics & Reports">
                <svg class="{{ request()->routeIs('blog-admin.analytics') ? 'text-brand-accent' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-300' }} mr-3 h-5 w-5 shrink-0 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <span class="admin-sidebar-label">Analytics & Reports</span>
            </a>

            <a href="{{ route('blog-admin.traffic.index') }}" class="admin-sidebar-link {{ request()->routeIs('blog-admin.traffic.*') ? 'bg-brand-accent/10 text-brand-accent dark:bg-brand-accent/20 font-bold' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group mb-1" title="Traffic History">
                <svg class="{{ request()->routeIs('blog-admin.traffic.*') ? 'text-brand-accent' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-300' }} mr-3 h-5 w-5 shrink-0 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <span class="admin-sidebar-label">Traffic History</span>
            </a>
            <a href="{{ route('blog-admin.settings') }}" class="admin-sidebar-link {{ request()->routeIs('blog-admin.settings') ? 'bg-brand-accent/10 text-brand-accent dark:bg-brand-accent/20 font-bold' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group" title="Settings">
                <svg class="{{ request()->routeIs('blog-admin.settings') ? 'text-brand-accent' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-300' }} mr-3 h-5 w-5 shrink-0 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="admin-sidebar-label">Settings</span>
            </a>
        </div>

    </nav>

    <!-- Bottom Actions -->
    <div class="mt-auto border-t border-gray-100 px-4 py-3 pb-[calc(0.75rem+env(safe-area-inset-bottom))] dark:border-gray-700">
        <a href="{{ url('/') }}" target="_blank" class="admin-sidebar-link flex items-center text-sm font-medium text-gray-500 transition hover:text-brand-accent dark:text-gray-400 dark:hover:text-brand-accent" title="View Site">
            <svg class="mr-2 h-4 w-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span class="admin-sidebar-label">View Site</span>
        </a>
    </div>
</aside>
