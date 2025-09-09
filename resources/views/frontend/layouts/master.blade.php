<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Shaharyar is a full-stack web developer specializing in Laravel, Vue.js, React.js, Node.js and Django.">
    <meta name="robots" content="index,follow">
    <meta name="theme-color" content="#0f172a">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Shaharyar | Full-Stack Developer">
    <meta property="og:description"
        content="Full-stack developer building clean, scalable web apps with Laravel, Vue.js, React.js, Node.js, and Django.">
    <meta property="og:image" content="assets/og-image.png">
    <meta property="og:image:alt" content="Shaharyar portfolio preview">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Shaharyar | Full-Stack Developer">
    <meta name="twitter:description"
        content="Full-stack developer building clean, scalable web apps with Laravel, Vue.js, React.js, Node.js, Inertia.js and Django.">
    <meta name="twitter:image" content="assets/og-image.png">
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <title>Shaharyar | Full-Stack Developer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
</head>

<body>
    <a class="skip-link" href="#home">Skip to content</a>
    <!-- Header & Navigation -->
    @include('frontend.layouts.navbar')

    <!-- Hero Section -->
    @yield('main-content')

    <!-- Footer -->
    @include('frontend.layouts.footer')

    <noscript>JavaScript is disabled. Some animations and interactions are unavailable.</noscript>
    <script src="{{ asset('frontend/assets/js/script.js') }}"></script>
</body>

</html>
