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
            Centrova - Komputasi, Produktivitas, Aplikasi dan Pemrograman
        @endif
    </title>

    {{-- Google Fonts: Noto Sans --}}
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    {{-- Alpine.js --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Custom Styles --}}
    <link rel="stylesheet" href="css/button.css">

    {{-- AOS Animation CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

    {{-- Styling --}}
    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Noto Sans', sans-serif;
        }
    </style>
</head>

<body class="font-sans antialiased max-w-[2560px] bg-neutral-100 mx-auto"
      data-turbo-track="reload" 
      data-turbo-cache="true"
      data-turbo-preview="true">

    <main class="min-h-screen">
        @yield('content')
    </main>

    @stack('scripts')
    
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
            
            // Reinitialize AOS animations
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
    </script>
    
    {{-- Script --}}
    <script src="{{ asset('js/disable-image-copy.js') }}"></script> 
    {{-- AOS Animation JS --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            AOS.init();
        });
    </script>
</body>
</html>
