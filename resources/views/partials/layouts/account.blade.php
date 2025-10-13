<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- Hotwire Turbo Configuration --}}
    <meta name="turbo-cache-control" content="no-preview">
    <meta name="turbo-root" content="{{ url('/') }}">
    <meta name="turbo-refresh-method" content="morph">
    <meta name="turbo-refresh-scroll" content="preserve">
    
    <link rel="website icon" href="{{ asset('/assets/brand/favicon.svg') }}">

    <title>
        @hasSection('title')
            @yield('title')
        @else
            Akun Centrova
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

        body {
            font-family: 'Inter', 'Helvetica Neue', Helvetica, 'Noto Sans', Arial, sans-serif;
        }
        
        /* Force Helvetica-style fonts */
        .font-helvetica {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif !important;
        }
        
        /* Apply to common elements */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Inter', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
    @yield('style-css')
    @stack('styles')

</head>
<body class="font-sans antialiased bg-neutral-50 min-h-screen"
      data-turbo-track="reload" 
      data-turbo-cache="true"
      data-turbo-preview="true">
    {{-- Header --}}
    @include('partials.navbar.mainAccount')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Account Switcher Modal --}}
    @auth
        @include('auth.components.account-switcher')
    @endauth

    @include('partials.footer')
    
    {{-- Scripts Section --}}
    @stack('scripts')
    @yield('scripts')
    
    {{-- Hotwire Turbo for SPA-like Navigation --}}
    <script type="module">
        import { Turbo } from "https://cdn.skypack.dev/@hotwired/turbo@^8.0.0";
        
        // Turbo Configuration
        Turbo.session.drive = true;
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
</body>
</html>
