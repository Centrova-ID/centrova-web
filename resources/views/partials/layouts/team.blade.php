<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="website icon" href="/assets/brand/favicon.svg">

    {{-- SEO Meta Tags - Powered by SEOTools --}}
    {!! SEO::generate() !!}
    
    {{-- Additional SEO Meta Tags --}}
    @yield('seoMetaTags')

    <title>
        @yield('title')
    </title>
    
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
    
    {{-- Favicon and App Icons --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('/assets/brand/favicon.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('/assets/brand/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('/assets/brand/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    
    {{-- DNS Prefetch for Performance --}}
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//unpkg.com">
    <link rel="dns-prefetch" href="//cdn.skypack.dev">

    {{-- Preload Fonts --}}
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Noto+Sans:wght@400;500;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Noto+Sans:wght@400;500;700&display=swap">
    </noscript>

    {{-- Preload AOS Animation CSS --}}
    <link rel="preload" href="https://unpkg.com/aos@2.3.4/dist/aos.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
    </noscript>

    {{-- Additional Links from Views --}}
    @yield('link-head')

    {{-- External JavaScript Libraries --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    
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
    
    {{-- Turbo-compatible initialization --}}
    <script>
        // Ensure Alpine.js works with Turbo navigation
        document.addEventListener('alpine:init', () => {
            // Alpine configuration if needed
        });
    </script>
    
    {{-- Head Scripts from Views --}}
    @yield('scripts-head')

    {{-- Font Component --}}
    @include('partials.components.font')

    {{-- View-specific Styles --}}
    @yield('style-css')
</head>

<body class="font-sans antialiased max-w-[2560px] mx-auto">

    <div>
        {{-- Navigation Bar --}}
        @include('partials.navbar.team')
        @include('partials.navbar.subnavbar.team')

        @hasSection('space-top')
            <div class="h-[0px]">@yield('space-top')</div>
        @else
            <div class="h-[60px]"></div>
        @endif

        {{-- Main Content Area - Turbo-ready structure --}}
        <main class="min-h-screen tracking-[-0.020em]" id="main-content">
            @yield('content')
        </main>

        {{-- Cookie Consent Banner - Persistent component --}}
        @include('components.cookie-consent')

        {{-- Account Switcher Modal - Dynamic content for authenticated users --}}
        @auth
            @include('auth.components.account-switcher')
        @endauth

        {{-- Footer - Persistent across pages --}}
        @include('partials.footer')
    </div>

    {{-- Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            {{-- Disable klik kanan pada gambar --}}
            document.addEventListener('contextmenu', function (e) {
                if (e.target.tagName.toLowerCase() === 'img') {
                    e.preventDefault();
                }
            });

            {{-- Atur semua gambar --}}
            const images = document.querySelectorAll('img');
            images.forEach(function (img) {
                {{-- Anti drag dan seleksi --}}
                img.setAttribute('draggable', 'false');
                img.style.userSelect = 'none';
                img.style.pointerEvents = 'auto';
                img.style.webkitUserDrag = 'none';
                img.style.userDrag = 'none';

                img.addEventListener('dragstart', function (e) {
                    e.preventDefault();
                });

                img.addEventListener('mousedown', function (e) {
                    e.preventDefault();
                });
            });
        });
    </script>

    {{-- View-specific Scripts --}}
    @stack('scripts')

    {{-- Core Application Scripts --}}
    <script src="{{ asset('js/disable-image-copy.js') }}" defer></script>
    {{-- <script src="{{ asset('js/hashing-attribute.js') }}" defer></script> --}}
    
    {{-- AOS Animation Library - Optimized Loading --}}
    <script src="{{ asset('js/aos-init.js') }}" defer></script>
</body>

</html>