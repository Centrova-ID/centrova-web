<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- Meta Tags --}}


    {{-- SEO Meta Tags --}}
    @yield('seoMetaTags')
    
    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('/assets/brand/favicon.svg') }}">
    
    <title>
        @hasSection('title')
            @yield('title')
        @else
            Akun Centrova
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
</head>
<body class="font-sans antialiased sm:bg-neutral-50 min-h-screen"
      x-data="{ mobileMenuOpen: false }">
    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Account Switcher Modal --}}
    @auth
        @include('auth.components.account-switcher')
    @endauth
    
    {{-- Scripts Section --}}
    @stack('scripts')
    {{-- Scripts Section --}}
    @stack('scripts')
    @yield('scripts')
</body>
</html>
