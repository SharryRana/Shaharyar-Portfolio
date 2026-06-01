<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ trim($__env->yieldContent('title', 'Creavibe Blog')) }}</title>

    <meta name="description" content="{{ trim($__env->yieldContent('meta_description', $description ?? 'Creavibe Blog shares practical ideas about development, design, and technology.')) }}">
    <meta name="keywords" content="{{ trim($__env->yieldContent('meta_keywords', $keywords ?? 'Creavibe Blog, web development, design, technology')) }}">
    <meta name="author" content="{{ trim($__env->yieldContent('meta_author', $author ?? 'Creavibe')) }}">
    @include('blog::partials.favicons')

    @stack('meta')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Vite CSS --}}
    @vite('Modules/Blog/resources/assets/css/app.css')

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')


</head>

<body>
    <x-blog::layouts.header />
    {{-- <x-blog::layouts.hero /> --}}

    {{ $slot }}

    <x-blog::layouts.footer />
    {{-- Vite JS --}}
    @vite('Modules/Blog/resources/assets/js/app.js')
    @stack('scripts')
</body>

</html>
