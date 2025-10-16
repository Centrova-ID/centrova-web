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
    
    <link rel="website icon" href="/assets/brand/favicon.svg">

    <title>
        @hasSection('title')
            Legal - @yield('title') - Centrova
        @else
            Legal - Centrova
        @endif
    </title>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Scripts and Styles -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

    @include('partials.components.font')
</head>

<body class="font-sans antialiased max-w-[2560px] mx-auto"
      data-turbo-track="reload" 
      data-turbo-cache="true"
      data-turbo-preview="true">    
    @include('partials.navbar.legal')
    @include('partials.navbar.subnavbar.legal')

    @hasSection('space-top')
        @yield('space-top')
    @else
        <div class="h-[120px]"></div>
    @endif

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
        });
        
        // Handle form submissions dengan CSRF
        document.addEventListener("turbo:before-fetch-request", function(event) {
            const token = document.querySelector('meta[name="csrf-token"]');
            if (token) {
                event.detail.fetchOptions.headers["X-CSRF-TOKEN"] = token.getAttribute("content");
            }
        });
    </script>
    
    <!-- Footer -->
    @include('partials.footer')
</body>

</html>