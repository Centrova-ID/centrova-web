<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="website icon" href="/assets/brand/favicon.svg">

    <title>Centrova - Komputasi, Produktivitas, Aplikasi dan Pemrograman</title>

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

<body class="font-sans antialiased max-w-[2560px] mx-auto">
    @hasSection('navbar')
        @yield('navbar')
    @else
        @include('partials.navbar.services')
    @endif

    <main class="min-h-screen">
        @yield('content')
    </main>

    @stack('scripts')

    @include('partials.footer')
    
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
