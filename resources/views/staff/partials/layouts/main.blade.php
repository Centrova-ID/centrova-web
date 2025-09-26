<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="website icon" href="{{ asset('/assets/brand/favicon.svg') }}">
    @yield('seoMetaTags')

    <title>
        @hasSection('title')
            @yield('title') - Centrova Staff Portal
        @else
            Centrova Staff Portal - Internal Management System
        @endif
    </title>

    {{-- Fonts: Helvetica via Google Fonts & Noto Sans fallback --}}
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Noto+Sans:wght@400;500;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Noto+Sans:wght@400;500;700&display=swap"></noscript>

    {{-- AOS Animation CSS --}}
    <link rel="preload" href="https://unpkg.com/aos@2.3.4/dist/aos.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css"></noscript>

    @yield('link-head')

    {{-- External Scripts --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- Tailwind Config for Custom Fonts --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'Helvetica Neue', 'Helvetica', 'Noto Sans', 'Arial', 'sans-serif'],
                        'helvetica': ['Helvetica Neue', 'Helvetica', 'Inter', 'Arial', 'sans-serif']
                    }
                }
            }
        }
    </script>

    @yield('scripts-head')

    {{-- Core Styles --}}
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
    @yield('style-css')
    @stack('styles')
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="flex w-full h-screen overflow-hidden">
        {{-- Side Navigation (Left Panel) --}}
        <div class="flex-shrink-0 w-[15rem] bg-white border-r border-gray-200 flex flex-col">
            @hasSection('sidebar')
                @yield('sidebar')
            @else
                @include('staff.partials.sidebar.main')
            @endif
        </div>

        {{-- Main content --}}
        <div class="flex flex-col flex-1">
            {{-- Main Content --}}
            <main class="flex-1 bg-gray-50 overflow-auto">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Cookie Consent Banner (untuk analytics dan tracking) --}}
    <div>
        @include('components.cookie-consent')
    </div>

    <div>
        @stack('scripts')
        
        {{-- Core Scripts --}}
        <script src="{{ asset('js/disable-image-copy.js') }}" defer></script>
        
        {{-- AOS Animation - Optimized Loading --}}
        <script>
            (function() {
                const script = document.createElement('script');
                script.src = 'https://unpkg.com/aos@2.3.4/dist/aos.js';
                script.async = true;
                script.onload = function() {
                    if (typeof AOS !== 'undefined') {
                        AOS.init({
                            duration: 700,
                            once: true,
                            offset: 50
                        });
                    }
                };
                document.head.appendChild(script);
            })();
        </script>
    </div>
</body>
</html>
