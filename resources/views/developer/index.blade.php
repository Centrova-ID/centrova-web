@extends('developer.layouts.main')

@section('title', 'Centrova Developer')

@section('content')

<!-- Hero Section -->
<section class="pt-24 pb-20 bg-gradient-to-b from-[#E3F2FD] to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-[#0B3C70] leading-tight mb-6">Selamat Datang di Centrova Developer</h1>
        <p class="text-lg md:text-xl text-neutral-600 max-w-3xl mx-auto mb-8">
            Dokumentasi, API, dan berita terbaru seputar ekosistem Centrova. Bangun solusi terbaik untuk UMKM bersama kami.
        </p>
        <div class="flex justify-center gap-4">
            <a href="#" class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-semibold px-6 py-3 rounded-full transition">Mulai Dokumentasi</a>
            <a href="#" class="text-[#128AEB] font-semibold hover:underline px-6 py-3">Lihat API</a>
        </div>
    </div>
</section>

<!-- Features / Kategori -->
<section class="py-16 bg-white border-t border-b border-neutral-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl font-bold text-slate-800 mb-10">Pusat Sumber Daya</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            <div class="bg-[#F5FAFE] hover:bg-[#E3F2FD] rounded-2xl p-6 transition shadow-sm border border-[#128AEB]/10">
                <h3 class="text-xl font-bold mb-2 text-[#128AEB]">Dokumentasi</h3>
                <p class="text-slate-600 mb-3">Panduan lengkap integrasi dan penggunaan sistem Centrova.</p>
                <a href="#" class="text-blue-600 hover:underline font-medium">Buka Dokumentasi →</a>
            </div>
            <div class="bg-[#F5FAFE] hover:bg-[#E3F2FD] rounded-2xl p-6 transition shadow-sm border border-[#128AEB]/10">
                <h3 class="text-xl font-bold mb-2 text-[#128AEB]">API</h3>
                <p class="text-slate-600 mb-3">Integrasikan fitur POS Centrova ke dalam aplikasi Anda dengan API publik kami.</p>
                <a href="#" class="text-blue-600 hover:underline font-medium">Lihat API →</a>
            </div>
            <div class="bg-[#F5FAFE] hover:bg-[#E3F2FD] rounded-2xl p-6 transition shadow-sm border border-[#128AEB]/10">
                <h3 class="text-xl font-bold mb-2 text-[#128AEB]">Status Sistem</h3>
                <p class="text-slate-600 mb-3">Lihat status terkini server dan layanan cloud Centrova.</p>
                <a href="#" class="text-blue-600 hover:underline font-medium">Cek Status →</a>
            </div>
        </div>
    </div>
</section>
@endsection
