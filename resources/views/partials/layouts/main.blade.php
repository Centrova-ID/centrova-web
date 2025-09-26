<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- Meta Tags --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta Tags --}}
    @yield('seoMetaTags')
    
    {{-- Favicon --}}
    <link rel="website icon" href="{{ asset('/assets/brand/favicon.svg') }}">
    
    {{-- Page Title --}}
    <title>
        @hasSection('title')
            @yield('title')
        @else
            Centrova - Komputasi, Produktivitas, Aplikasi dan Pemrograman
        @endif
    </title>

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
        @hasSection('navbar')
            @yield('navbar')
        @else
            @include('partials.navbar.main')
        @endif

        {{-- Main Content --}}
        <main class="min-h-screen tracking-[-0.020em]">
            @yield('content')
        </main>

        {{-- Cookie Consent Banner --}}
        @include('components.cookie-consent')

        {{-- Account Switcher Modal (Authenticated Users Only) --}}
        @auth
            @include('auth.components.account-switcher')
        @endauth

        {{-- Footer --}}
        @include('partials.footer')
    </div>

    {{-- View-specific Scripts --}}
    @stack('scripts')
    
    {{-- Core Application Scripts --}}
    <script src="{{ asset('js/disable-image-copy.js') }}" defer></script>
    
    {{-- AOS Animation Library - Optimized Loading --}}
    <script src="{{ asset('js/aos-init.js') }}" defer></script>
</body>
</html>
