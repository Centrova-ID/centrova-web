<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        @yield('style')
    </style>

    @include('partials.components.font')
</head>

<body class="font-sans antialiased max-w-[2560px] mx-auto">    
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
    <!-- Footer -->
    @include('partials.footer')
</body>

</html>