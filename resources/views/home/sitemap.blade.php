@extends('partials.layouts.main')

@section('title', 'Peta Situs')

@section('style-css')
    <style type="text/tailwindcss">
        .sites-links-container ul {
            @apply space-y-3 text-left text-base;
        }

        .sites-links-container h2 {
            @apply font-medium text-slate-800 mb-4;
        }

        .sites-links-container ul li a {
            @apply text-neutral-700/80 hover:text-neutral-700 font-medium;
        }
    </style>
@endsection

@section('content')
<div class="max-w-4xl mx-auto px-4 max-md:px-8 lg:px-8 text-center border-none border-neutral-300 pb-20 pt-28">
    <h1 class="text-4xl sm:text-5xl font-bold text-slate-900 mb-6">Peta Situs Centrova</h1>
    <p class="mt-8 text-lg text-neutral-900 max-w-3xl mx-auto font-medium">
        Temukan seluruh halaman utama Centrova di satu tempat. Jelajahi layanan, tim, legalitas, support, berita, developer, karier, dan akun dengan mudah.
    </p>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-y-16">
        <!-- Hardcoded sitemap: only user-facing, worth-visiting pages -->
        <div class="sites-links-container">
            <h2>Tentang Centrova</h2>
            <ul>
                {{-- <li><a href="{{ route('team.index') }}">Tim Centrova</a></li> --}}
                <li><a href="{{ route('careers.home') }}">Peluang Karir</a></li>
                <li><a href="{{ route('contact') }}">Kontak Centrova</a></li>
                <li><a href="{{ route('news.home') }}">Berita</a></li>
            </ul>
        </div>

        <div class="sites-links-container">
            <h2>Aplikasi</h2>
            <ul>
                <li><a href="{{ route('products.business.index') }}">Centrova Enterprise</a></li>
                <li><a href="{{ route('products.business.sales') }}">Aplikasi Sales</a></li>
                <li><a href="{{ route('products.business.crm') }}">Aplikasi CRM</a></li>
                <li><a href="{{ route('products.business.erp') }}">Aplikasi ERP</a></li>
            </ul>
        </div>

        <div class="sites-links-container">
            <h2>Akun</h2>
            <ul>
                <li><a href="{{ route(\App\Helpers\RouteHelper::getContextRoute('login', 'account.fallback.login')) }}">Masuk / Login</a></li>
                <li><a href="{{ route(\App\Helpers\RouteHelper::getContextRoute('register', 'account.fallback.register')) }}">Daftar / Buat Akun</a></li>
            </ul>
        </div>
        
        <div class="sites-links-container">
            <h2>Layanan</h2>
            <ul>
                <li><a href="{{ route('services.index') }}">Overview Layanan</a></li>
                <li><a href="{{ route('services.web.index') }}">Web Development</a></li>
                <li><a href="{{ route('services.app.index') }}">Aplikasi &amp; Mobile</a></li>
                <li><a href="{{ route('services.uiux.index') }}">UI / UX</a></li>
                <li><a href="{{ route('services.mobile-app.index') }}">Mobile App</a></li>
            </ul>
        </div>
        
        <div class="sites-links-container">
            <h2>Dukungan</h2>
            <ul>
                <li><a href="{{ route('support.home') }}">Halaman Dukungan</a></li>
                <li><a href="{{ route('support.services.home') }}">Layanan Dukungan</a></li>
                <li><a href="{{ route('support.web.chat') }}">Chat Dukungan</a></li>
                <li><a href="{{ route('support.web.consult') }}">Konsultasi / Jadwalkan</a></li>
                <li><a href="{{ route('support.help.home') }}">Pusat Bantuan</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection
