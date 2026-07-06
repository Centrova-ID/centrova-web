<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- Meta Tags --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- Additional SEO Meta Tags --}}
    @yield('seoMetaTags')
    {{-- SEO Meta Tags - Powered by SEOTools --}}
    {{-- {!! SEO::generate() !!} --}}

    {{-- Title --}}
    <title>@yield('title')</title>
    
    {{-- JSON-LD Structured Data --}}
    @stack('structured-data')
    
    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('/assets/brand/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    
    {{-- Preconnect / DNS Prefetch --}}
    <link rel="preconnect" href="https://cdn.tailwindcss.com">
    <link rel="dns-prefetch" href="https://cdn.tailwindcss.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://unpkg.com">

    {{-- Icons: Material Symbols (Outlined, Rounded, Sharp) --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL@20..48,100..700,0..1&family=Material+Symbols+Rounded:opsz,wght,FILL@20..48,100..700,0..1&family=Material+Symbols+Sharp:opsz,wght,FILL@20..48,100..700,0..1&display=swap" rel="stylesheet"/>

    {{-- Additional Links from Views --}}
    @yield('link-head')

    {{-- Vite Assets: Include Tailwind CSS dan Alpine.js (bundled) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Google Analytics / GA4 --}}
    @if(config('services.google.analytics_id'))
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google.analytics_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ config('services.google.analytics_id') }}');
        </script>
    @endif

    {{-- Microsoft Clarity --}}
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "xf2ndgele8");
    </script>
    
    {{-- Application initialization --}}
    <script>
        document.addEventListener('alpine:init', () => {
            // Alpine configuration if needed
        });
    </script>
    
    {{-- Head Scripts from Views --}}
    @yield('scripts-head')

    {{-- Font Component --}}
    @include('partials.components.font')

    {{-- Color Palletes --}}
    @include('partials.components.color')

    {{-- View-specific Styles --}}
    @yield('style-css')
</head>

<body class="font-sans antialiased bg-white text-neutral-900" x-data="{ mobileMenuOpen: false }">
    {{-- Main Application Wrapper --}}
    <div id="app">
        {{-- Navigation Bar --}}
        @hasSection('navbar')
            @yield('navbar')
        @else
            @include('partials.navbar.main')
        @endif

        {{-- Main Content Area --}}
        <main id="main-content">
            @yield('content')
        </main>

        {{-- Cookie Consent Banner - Persistent component --}}
        @include('components.cookie-consent')

        {{-- Footer - Persistent across pages --}}
        @include('partials.footer.main')

        {{-- Floating Customer Service Icon --}}
        @include('partials.components.floating-cs')
    </div>
    
    {{-- Preline UI JS (via CDN) --}}
    <script src="https://cdn.jsdelivr.net/npm/preline@4.2.0/dist/preline.js"></script>

    {{-- Editor Scripts --}}
    @yield('scripts-body')
</body>

</html>