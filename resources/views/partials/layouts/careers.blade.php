<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- Meta Tags --}}

    
    <link rel="icon" type="image/svg+xml" href="/assets/brand/favicon.svg">

    <title>
        @hasSection('title')
            @yield('title') - Karier di Centrova
        @else
            Karier di Centrova
        @endif
    </title>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Scripts and Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans antialiased max-w-[2560px] mx-auto"
    >    
    @include('partials.navbar.careers')
    @include('partials.navbar.subnavbar.careers')

    <main class="min-h-screen">
        @yield('content')
    </main>

    @stack('scripts')
    
    {{-- Scripts Section --}}
    @stack('scripts')
    
    <!-- Footer -->
    @include('partials.footer')
</body>

</html>