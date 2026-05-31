<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50 dark:bg-gray-900">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | Creavibe</title>
    @include('blog::partials.favicons')

    <link rel="stylesheet" href="{{ asset('blog-dashboard/build/assets/app-B3mLPOOi.css') }}">
    <script type="module" src="{{ asset('blog-dashboard/build/assets/app-B9C9Ze5j.js') }}"></script>

    <style>
        :root {
            --color-brand: #4f5ff6;
            --color-brand-accent: #4f5ff6;
            --color-brand-dark: #3f22b8;
            --color-brand-light: #eef2ff;
            --color-brand-muted: #7c8cff;
        }

        .hover\:bg-\[\#d66c2e\]:hover {
            background-color: #3f22b8;
        }
    </style>

    <script>
        // Apply dark mode only if explicitly set
        if (localStorage.theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body class="h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">

    <div
        class="max-w-md w-full space-y-8 bg-white dark:bg-gray-800 p-8 sm:p-10 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700">
        <div>
            <div class="flex justify-center">
                <span class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-brand-accent text-2xl font-black text-white shadow-sm">C</span>
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-white">
                Admin Portal
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
                Sign in to manage Creavibe contents.
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('blog-admin.login.submit') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div
                    class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-900 text-red-600 dark:text-red-400 px-4 py-3 rounded-lg text-sm font-medium">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="rounded-md shadow-sm space-y-4 p-4 bg-gray-50 dark:bg-gray-700">
                <div>
                    <label for="email-address"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email address</label>
                    <input id="email-address" name="email" type="email" autocomplete="email" required
                        class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg placeholder-gray-500 text-gray-900 dark:text-white bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-brand-accent focus:border-brand-accent sm:text-sm transition"
                        placeholder="admin@gmail.com">
                </div>
                <div>
                    <label for="password"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg placeholder-gray-500 text-gray-900 dark:text-white bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-brand-accent focus:border-brand-accent sm:text-sm transition"
                        placeholder="123456">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember-me" name="remember" type="checkbox" value="1"
                        class="h-4 w-4 text-brand-accent focus:ring-brand-accent border-gray-300 rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                        Remember me
                    </label>
                </div>
            </div>

            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-2.5 px-4 border border-transparent text-sm font-semibold rounded-lg text-white bg-brand-accent hover:bg-[#d66c2e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-accent shadow-md hover:shadow-lg transition">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-indigo-100 group-hover:text-white transition"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                    Sign in
                </button>
            </div>

            <div class="text-center mt-4 border-t border-gray-100 dark:border-gray-700 pt-4">
                <a href="{{ url('/') }}"
                    class="text-sm font-medium text-gray-500 hover:text-brand-accent dark:text-gray-400 transition">
                    &larr; Back to Website
                </a>
            </div>
        </form>
    </div>

</body>

</html>
