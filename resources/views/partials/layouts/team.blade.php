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

<body class="font-sans antialiased max-w-[2560px] mx-auto">    
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
</body>

</html>