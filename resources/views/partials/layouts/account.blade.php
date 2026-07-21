<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- Meta Tags --}}

    
    <link rel="icon" type="image/svg+xml" href="{{ asset('/assets/brand/favicon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('/assets/brand/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

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
    {{-- Guard untuk mencegah ReferenceError jika CDN gagal dimuat --}}
    <script>
        if (typeof tailwind !== 'undefined') {
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
        }
    </script>

    {{-- Microsoft Clarity --}}
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "xf2ndgele8");
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
      x-data="{ mobileMenuOpen: false }">
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
    {{-- Scripts Section --}}
    @stack('scripts')
    @yield('scripts')
</body>
</html>
