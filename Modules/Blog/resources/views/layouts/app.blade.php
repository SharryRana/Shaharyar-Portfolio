<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ trim($__env->yieldContent('title', 'Creavibe Blog')) }}</title>
    <meta name="description" content="{{ trim($__env->yieldContent('meta_description', 'Creavibe Blog - insights about web development, design, and technology')) }}">
    @include('blog::partials.favicons')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="@yield('font_href', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap')" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="{{ asset('blog-dashboard/build/assets/app-B3mLPOOi.css') }}">
    <script type="module" src="{{ asset('blog-dashboard/build/assets/app-B9C9Ze5j.js') }}"></script>
</head>

<body class="@yield('body_class', 'font-sans antialiased text-[#1C1412] bg-white selection:bg-brand selection:text-white')">
    <x-blog::layouts.navbar />

    <main>
        @yield('content')
    </main>

    @hasSection('footer')
        @yield('footer')
    @else
        <x-blog::layouts.footer />
    @endif
</body>

</html>
