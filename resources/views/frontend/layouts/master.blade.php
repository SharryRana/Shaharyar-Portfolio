<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <script>
        (function() {
            var theme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Creavibe  Shaharyar">
    <meta name="description" content="@yield('meta_description', 'Creavibe builds scalable SaaS, FinTech, and web applications. Full-stack software engineering by Shaharyar  Laravel, Go, Vue.js, React, PostgreSQL.')">
    @hasSection('meta_keywords')
        <meta name="keywords" content="@yield('meta_keywords')">
    @endif
    <meta name="robots" content="@yield('robots', 'index,follow')">
    <meta name="theme-color" content="#0f172a">
    <link rel="canonical" href="@yield('canonical_url', url()->current())">

    {{-- Open Graph --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="Creavibe">
    <meta property="og:url" content="@yield('canonical_url', url()->current())">
    <meta property="og:title" content="@yield('og_title', 'Creavibe | Software Engineering & SaaS Development')">
    <meta property="og:description" content="@yield('og_description', 'Creavibe builds scalable SaaS, FinTech, and modern web applications. Expert software engineering by Shaharyar.')">
    <meta property="og:image" content="@yield('og_image', asset('assets/og-image.png'))">
    <meta property="og:image:alt" content="@yield('og_image_alt', 'Creavibe  Software Engineering & SaaS Development')">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    {{-- Twitter / X Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@@ShaharyarRana12">
    <meta name="twitter:creator" content="@@ShaharyarRana12">
    <meta name="twitter:title" content="@yield('twitter_title', 'Creavibe | Software Engineering & SaaS Development')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Creavibe builds scalable SaaS, FinTech, and modern web applications.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('assets/og-image.png'))">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Analytics (injected from .env, empty by default) --}}
    @if(config('app.google_analytics_id'))
    <!-- Google Analytics: GA4 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('app.google_analytics_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ config('app.google_analytics_id') }}');
    </script>
    @endif
    @if(config('app.microsoft_clarity_id'))
    <!-- Microsoft Clarity -->
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "{{ config('app.microsoft_clarity_id') }}");
    </script>
    @endif
    @if(config('app.google_site_verification'))
    <meta name="google-site-verification" content="{{ config('app.google_site_verification') }}">
    @endif

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}" />

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"></noscript>

    <title>@yield('title', 'Creavibe | Software Engineering & SaaS Development')</title>

    {{-- Styles --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    @stack('head')
</head>
<body>
    <a class="skip-link" href="#main-content">Skip to main content</a>
    @include('frontend.layouts.navbar')
    @yield('main-content')
    @include('frontend.layouts.footer')
    <noscript>JavaScript is disabled. Some animations and interactions may be unavailable.</noscript>
    <script src="{{ asset('frontend/assets/js/script.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
