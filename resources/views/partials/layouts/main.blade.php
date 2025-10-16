<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- Meta Tags --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- Hotwire Turbo Configuration --}}
    <meta name="turbo-cache-control" content="no-preview">
    <meta name="turbo-root" content="{{ url('/') }}">
    <meta name="turbo-refresh-method" content="morph">
    <meta name="turbo-refresh-scroll" content="preserve">

    {{-- SEO Meta Tags - Powered by SEOTools --}}
    {!! SEO::generate() !!}
    
    {{-- Additional SEO Meta Tags --}}
    @yield('seoMetaTags')
    
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

<body class="font-sans antialiased max-w-[2560px] mx-auto" 
      data-turbo-track="reload" 
      data-turbo-cache="true"
      data-turbo-preview="true">
    {{-- Main Application Wrapper - Turbo Frame Target --}}
    <div id="app" data-turbo-permanent>
        {{-- Navigation Bar - Persistent across Turbo visits --}}
        @hasSection('navbar')
            @yield('navbar')
        @else
            @include('partials.navbar.main')
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

    {{-- View-specific Scripts --}}
    @stack('scripts')
    
    {{-- Hotwire Turbo for SPA-like Navigation --}}
    <script type="module">
        import { Turbo } from "https://cdn.skypack.dev/@hotwired/turbo@^8.0.0";
        
        // Turbo Configuration
        Turbo.session.drive = true;
        
        // CSRF Token untuk Request Turbo
        Turbo.setFormMode("optin");
        
        // Event Listeners untuk Turbo
        document.addEventListener("turbo:load", function() {
            // Reinitialize Alpine.js setelah Turbo navigation
            if (window.Alpine) {
                window.Alpine.initTree(document.body);
            }
            
            // Reinitialize AOS animations jika ada
            if (window.AOS) {
                window.AOS.refresh();
            }
        });
        
        // Handle form submissions dengan CSRF
        document.addEventListener("turbo:before-fetch-request", function(event) {
            const token = document.querySelector('meta[name="csrf-token"]');
            if (token) {
                event.detail.fetchOptions.headers["X-CSRF-TOKEN"] = token.getAttribute("content");
            }
        });
        
        // Preserve scroll position untuk navigasi back/forward
        document.addEventListener("turbo:before-visit", function(event) {
            if (event.detail.action === "restore") {
                event.detail.options.scroll = "restore";
            }
        });
    </script>
    
    {{-- Core Application Scripts --}}
    <script src="{{ asset('js/disable-image-copy.js') }}" defer></script>
    {{-- <script src="{{ asset('js/hashing-attribute.js') }}" defer></script> --}}
    
    {{-- AOS Animation Library - Optimized Loading --}}
    <script src="{{ asset('js/aos-init.js') }}" defer></script>

</body>
</html>
