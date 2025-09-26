<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="website icon" href="/assets/brand/favicon.svg">

    <title>Centrova Developer</title>

    <!-- Scripts and Styles -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="css/button.css">
</head>

<body class="font-sans antialiased max-w-[2560px] mx-auto">
    @include('developer.components.navbar')

    <main class="min-h-screen">
        @yield('content')
    </main>

    @stack('scripts')
    <!-- Footer -->
    @include('partials.footer')
</body>

</html>