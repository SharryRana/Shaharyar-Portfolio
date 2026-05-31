<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') | Creavibe</title>
    @include('blog::partials.favicons')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('blog-dashboard/build/assets/app-B3mLPOOi.css') }}">
    <script type="module" src="{{ asset('blog-dashboard/build/assets/app-B9C9Ze5j.js') }}"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --color-brand: #4f5ff6;
            --color-brand-accent: #4f5ff6;
            --color-brand-dark: #3f22b8;
            --color-brand-light: #eef2ff;
            --color-brand-muted: #7c8cff;
        }

        * {
            scrollbar-color: #4f5ff6 #eef2ff;
        }

        ::-webkit-scrollbar-track {
            background: #eef2ff;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #20c6e8, #4f5ff6, #3f22b8);
            border-color: #eef2ff;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #4f5ff6, #3f22b8);
        }

        .dark * {
            scrollbar-color: #7c8cff #111827;
        }

        .from-orange-500,
        .from-brand-accent {
            --tw-gradient-from: #20c6e8 var(--tw-gradient-from-position);
            --tw-gradient-to: rgb(32 198 232 / 0) var(--tw-gradient-to-position);
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
        }

        .to-orange-600 {
            --tw-gradient-to: #3f22b8 var(--tw-gradient-to-position);
        }

        .bg-gradient-to-br.from-brand-accent.to-orange-600,
        .bg-gradient-to-br.from-orange-500.to-orange-600 {
            background-image: linear-gradient(to bottom right, #20c6e8, #4f5ff6, #3f22b8) !important;
            color: #ffffff !important;
        }

        .hover\:bg-\[\#d66c2e\]:hover {
            background-color: #3f22b8;
        }

        .hover\:text-orange-600:hover,
        .dark\:hover\:text-orange-400:hover:is(.dark *) {
            color: #3f22b8;
        }

        .bg-orange-100,
        .bg-\[\#FFE5D1\] {
            background-color: #eef2ff;
        }

        .dark\:bg-orange-900\/30:is(.dark *) {
            background-color: rgb(49 46 129 / 0.35);
        }

        .text-orange-700,
        .text-orange-300,
        .text-\[\#E97A37\],
        .hover\:text-\[\#E97A37\]:hover,
        .dark\:text-orange-300:is(.dark *) {
            color: #4f5ff6;
        }

        .from-\[\#FFE5D1\] {
            --tw-gradient-from: #eef2ff var(--tw-gradient-from-position);
            --tw-gradient-to: rgb(238 242 255 / 0) var(--tw-gradient-to-position);
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
        }

        .via-\[\#F5A876\] {
            --tw-gradient-via: #7c8cff var(--tw-gradient-via-position);
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-via), var(--tw-gradient-to);
        }

        .to-\[\#E97A37\] {
            --tw-gradient-to: #4f5ff6 var(--tw-gradient-to-position);
        }

        .hover\:bg-\[\#FFE5D1\]:hover {
            background-color: #eef2ff;
        }

        .shadow-orange-500\/20 {
            --tw-shadow-color: rgb(79 95 246 / 0.2);
        }
    </style>

    <script>
        const savedAdminTheme = localStorage.getItem('admin-theme') || 'light';
        document.documentElement.classList.toggle('dark', savedAdminTheme === 'dark');

        document.addEventListener('alpine:init', () => {
            Alpine.store('theme', {
                isDark: savedAdminTheme === 'dark',
                toggle() {
                    this.isDark = !this.isDark;
                    document.documentElement.classList.toggle('dark', this.isDark);
                    localStorage.setItem('admin-theme', this.isDark ? 'dark' : 'light');
                }
            });
        });
    </script>
</head>
<body class="bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100 flex h-[100dvh] overflow-hidden transition-colors duration-200 lg:h-screen"
      x-data="{
          sidebarOpen: false,
          sidebarCollapsed: @js(request()->routeIs('blog-admin.articles.create', 'blog-admin.articles.edit')) || localStorage.getItem('admin-sidebar-collapsed') === 'true',
          toggleSidebarCollapsed() {
              this.sidebarCollapsed = !this.sidebarCollapsed;
              localStorage.setItem('admin-sidebar-collapsed', this.sidebarCollapsed ? 'true' : 'false');
          }
      }">

    <!-- Mobile sidebar backdrop -->
    <div x-show="sidebarOpen" class="fixed inset-0 z-20 bg-gray-900/50 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false" x-transition.opacity></div>

    <!-- Sidebar -->
    @include('blog::admin.components.sidebar')

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col w-full h-full overflow-hidden">

        <!-- Header -->
        @include('blog::admin.components.header')

        <!-- Scrollable Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 pb-[calc(1rem+env(safe-area-inset-bottom))] dark:bg-gray-900 sm:p-6 lg:p-8">
            @yield('content')
        </main>

    </div>

    @include('blog::admin.components.confirm-modal')

</body>
</html>
