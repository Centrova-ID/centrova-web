<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- Meta Tags --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- Additional SEO Meta Tags --}}
    @yield('seoMetaTags')
    {{-- Canonical URL fallback --}}
    <link rel="canonical" href="{{ url()->current() }}">
    {{-- SEO Meta Tags - Powered by SEOTools --}}
    {{-- {!! SEO::generate() !!} --}}

    {{-- Title --}}
    <title>@yield('title')</title>
    
    {{-- JSON-LD Structured Data --}}
    @stack('structured-data')
    
    {{-- Global Structured Data --}}
    @if(isset($organizationSchema))
    <script type="application/ld+json">
        {!! $organizationSchema !!}
    </script>
    @endif
    
    @if(isset($websiteSchema))
    <script type="application/ld+json">
        {!! $websiteSchema !!}
    </script>
    @endif
    
    {{-- Favicon and App Icons (single icon to prevent double request) --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('/assets/brand/favicon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('/assets/brand/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    
    {{-- Preconnect / DNS Prefetch --}}
    <link rel="preconnect" href="https://cdn.tailwindcss.com">
    <link rel="dns-prefetch" href="https://cdn.tailwindcss.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://unpkg.com">

    {{-- Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>

    {{-- Additional Links from Views --}}
    @yield('link-head')

    {{-- TailwindCSS via local copy (suppress production warning) --}}
    <script>
        // Suppress Tailwind Play CDN production warning
        const origWarn = console.warn;
        console.warn = function(msg) {
            if (typeof msg === 'string' && msg.includes('cdn.tailwindcss.com should not be used')) return;
            origWarn.apply(console, arguments);
        };
    </script>
    <script src="{{ asset('cdn/tailwindcss.min.js') }}"></script>
    {{-- Vite Assets: Alpine.js with Collapse plugin --}}
    @vite(['resources/js/app.js'])
    
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

<body class="font-sans antialiased max-w-[2560px] mx-auto" x-data="{ mobileMenuOpen: false }">
    {{-- Main Application Wrapper --}}
    <div id="app">
        {{-- Navigation Bar --}}
        @hasSection('navbar')
            @yield('navbar')
        @else
            @include('partials.navbar.main')
        @endif

        {{-- Main Content Area --}}
        <main class="min-h-screen tracking-[-0.020em]" id="main-content">
            @yield('content')
        </main>

        {{-- Cookie Consent Banner - Persistent component --}}
        @include('components.cookie-consent')

        {{-- Account Switcher Modal - Disabled --}}
        {{-- @auth
            @include('auth.components.account-switcher')
        @endauth --}}

        {{-- Footer - Persistent across pages --}}
        @include('partials.footer.main')
    </div>

    
    {{-- Core Application Scripts --}}
    <script src="{{ asset('js/disable-image-copy.js') }}" defer></script>
    {{-- <script src="{{ asset('js/hashing-attribute.js') }}" defer></script> --}}
    
    {{-- AOS Animation Library - Optimized Loading --}}
    <script src="{{ asset('js/aos-init.js') }}" defer></script>
</body>

</html>