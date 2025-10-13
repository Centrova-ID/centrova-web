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
        @yield('title')
    </title>

    {{-- Alpine.js --}}
    <script defer src="{{ asset('/cdn/alpinejs.min.js') }}"></script>

    {{-- Scripts and Styles --}}
    <script src="{{ asset('/cdn/tailwindcss.min.js') }}"></script>
    <script src="{{ asset('/js/disable-image-copy.js') }}"></script>
    <style>
        img {
            -webkit-user-drag: none;
            user-drag: none;
            user-select: none;
            pointer-events: auto;
        }
    </style>
</head>

<body class="font-sans antialiased max-w-[2560px] mx-auto"
      data-turbo-track="reload" 
      data-turbo-cache="true"
      data-turbo-preview="true">    
    @include('partials.navbar.team')
    @include('partials.navbar.subnavbar.team')

    @hasSection('space-top')
        <div class="h-[0px]">@yield('space-top')</div>
    @else
        <div class="h-[60px]"></div>
    @endif

    <main class="min-h-screen">
        @yield('content')
    </main>

    @stack('scripts')
    {{-- Footer --}}
    @include('partials.footer')


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
</body>

</html>