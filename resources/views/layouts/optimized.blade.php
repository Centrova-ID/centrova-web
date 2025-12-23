<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- DNS Prefetch for external domains --}}
    @foreach(config('performance.assets.dns_prefetch', []) as $domain)
    <link rel="dns-prefetch" href="{{ $domain }}">
    @endforeach
    
    {{-- Preconnect for critical resources --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <title>@yield('title', config('app.name'))</title>
    
    {{-- Critical CSS (inline for fastest render) --}}
    @if(config('performance.assets.critical_css_inline'))
    <style>
        /* Critical CSS - Inline untuk First Paint */
        body { margin: 0; font-family: system-ui, -apple-system, sans-serif; }
        .loading { opacity: 0; }
        .loaded { opacity: 1; transition: opacity 0.2s; }
    </style>
    @endif
    
    {{-- Preload critical assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Additional preloads --}}
    @stack('preloads')
    
    {{-- SEO Meta Tags --}}
    @yield('seoMetaTags')
    
    {{-- Page-specific styles --}}
    @stack('styles')
</head>
<body class="loading" x-data="{ loaded: false }" x-init="setTimeout(() => { loaded = true; $el.classList.remove('loading'); $el.classList.add('loaded'); }, 100)">
    
    {{-- Navbar --}}
    @yield('navbar', '@include("partials.navbar")')
    
    {{-- Main Content --}}
    <main id="main-content">
        @yield('content')
    </main>
    
    {{-- Footer --}}
    @yield('footer', '@include("partials.footer")')
    
    {{-- Page-specific scripts --}}
    @stack('scripts')
    
    {{-- Turbo progress bar --}}
    <script>
        // Turbo progress bar configuration
        document.addEventListener('turbo:load', () => {
            console.log('Turbo page loaded');
        });
        
        document.addEventListener('turbo:before-fetch-request', () => {
            // Show loading indicator if needed
        });
    </script>
</body>
</html>
