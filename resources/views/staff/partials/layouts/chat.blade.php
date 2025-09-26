<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="website icon" href="{{ asset('/assets/brand/favicon.svg') }}">
    @yield('seoMetaTags')

    <title>Chat</title>

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
    </style>
    @yield('style-css')
    @stack('styles')
</head>

<body class="font-sans antialiased max-w-[2560px] mx-auto" style="font-family: 'Inter', 'Helvetica Neue', Helvetica, Arial, sans-serif;">

    <main class="h-screen tracking-[-0.020em]">
        @yield('content')
    </main>

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
</body>
</html>
