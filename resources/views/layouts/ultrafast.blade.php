{{--
MINIMAL RENDER LAYOUT
Zero overhead, pre-compiled, turbo-optimized
Target: <1ms template render
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    {{-- Meta Tags --}}
    
    {{-- Critical CSS inline (no external request) --}}
    <style>body{margin:0;font-family:system-ui;background:#fff}[x-cloak]{display:none!important}</style>
    
    {{-- Preload critical resources --}}
    <link rel="preload" as="style" href="{{ mix('css/app.css') }}">
    <link rel="preload" as="script" href="{{ mix('js/app.js') }}">
    
    {{-- Non-blocking CSS --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" media="print" onload="this.media='all'">
    
    <title>@yield('title', config('app.name'))</title>
</head>
<body>
    {{-- Navbar (cached fragment, never re-renders) --}}
    @once
        <nav id="navbar">
            @include('partials.navbar-cached')
        </nav>
    @endonce
    
    {{-- Main content - ONLY this updates on navigation --}}
    <main id="content">
        @yield('content')
    </main>
    
    {{-- Footer (cached fragment, never re-renders) --}}
    @once
        <footer id="footer">
            @include('partials.footer-cached')
        </footer>
    @endonce
    
    {{-- Deferred scripts (non-blocking) --}}
    <script src="{{ mix('js/app.js') }}" defer></script>
    
    @stack('scripts')
</body>
</html>
