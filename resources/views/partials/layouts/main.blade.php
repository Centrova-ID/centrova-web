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
    {{-- Additional SEO Meta Tags --}}
    @yield('seoMetaTags')
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
    
    {{-- Favicon and App Icons --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('/assets/brand/favicon.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('/assets/brand/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('/assets/brand/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    
    {{-- Preconnect / DNS Prefetch for Performance (faster TLS & early connection) --}}
    <link rel="preconnect" href="https://cdn.tailwindcss.com">
    <link rel="dns-prefetch" href="https://cdn.tailwindcss.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://unpkg.com">
    <link rel="preconnect" href="https://cdn.skypack.dev">
    <link rel="dns-prefetch" href="https://cdn.skypack.dev">

    {{-- Preload Fonts --}}
    <link rel="preload" 
          href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Noto+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" 
          as="style" 
          onload="this.onload=null;this.rel='stylesheet'">

    <noscript>
        <link rel="stylesheet" 
              href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Noto+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap">
    </noscript>

    {{-- Preload AOS Animation CSS --}}
    {{-- <link rel="preload" href="https://unpkg.com/aos@2.3.4/dist/aos.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
    </noscript> --}}

    {{-- Additional Links from Views --}}
    @yield('link-head')

    {{-- External JavaScript Libraries (defer non-critical JS to reduce render-blocking) --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- TailwindCSS CDN - Non-blocking load with immediate stylesheet --}}
    <script src="{{ asset('cdn/tailwindcss.min.js') }}"></script>
    
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
        
        // Prefetch optimization: preload likely navigation targets
        document.addEventListener('DOMContentLoaded', () => {
            // Prefetch high-priority navigation links after page load
            const prefetchLinks = document.querySelectorAll('a[data-turbo-prefetch]');
            prefetchLinks.forEach(link => {
                if ('IntersectionObserver' in window) {
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                const href = entry.target.getAttribute('href');
                                if (href && !href.startsWith('#')) {
                                    const prefetchLink = document.createElement('link');
                                    prefetchLink.rel = 'prefetch';
                                    prefetchLink.href = href;
                                    document.head.appendChild(prefetchLink);
                                }
                                observer.unobserve(entry.target);
                            }
                        });
                    });
                    observer.observe(link);
                }
            });
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

        {{-- Account Switcher Modal - Disabled --}}
        {{-- @auth
            @include('auth.components.account-switcher')
        @endauth --}}

        {{-- Footer - Persistent across pages --}}
        @include('partials.footer')
    </div>

    {{-- View-specific Scripts --}}
    @stack('scripts')
    
    {{-- Hotwire Turbo for SPA-like Navigation --}}
    <script type="module">
        import { Turbo } from "https://cdn.skypack.dev/@hotwired/turbo@^8.0.0";
        
        // Turbo Configuration - Enhanced for instant navigation
        Turbo.session.drive = true;
        
        // Enable aggressive prefetching on hover
        document.addEventListener('turbo:load', () => {
            const links = document.querySelectorAll('a[href^="/"]');
            links.forEach(link => {
                link.addEventListener('mouseenter', () => {
                    if (!link.hasAttribute('data-turbo-prefetch-disabled')) {
                        Turbo.visit(link.href, { action: 'prefetch' });
                    }
                }, { once: true, passive: true });
            });
        });
        
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
