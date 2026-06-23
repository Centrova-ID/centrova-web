@extends('partials.layouts.main')

@section('title', 'Layanan AI, Software Development & Digital Transformation - Centrova')

<meta charset=utf-8>
<meta name=description content="Centrova menyediakan layanan AI Strategy, AI Agents, AI Automation, Web & App Development, UI/UX Design, dan Mobile App Development untuk transformasi digital bisnis Anda.">
<meta name=viewport content="width=device-width, initial-scale=1">
<meta name="keywords" content="layanan AI Indonesia, AI Strategy, AI Agents, AI Automation, software development, web development, aplikasi bisnis, centrova, transformasi digital">

{{-- Navbar --}}
@section('navbar')
    @include('partials.navbar.main')
@endsection

{{-- Style CSS --}}
@section('style-css')
    <style>
        [x-cloak] { display: none !important; }
    </style>
@endsection

@section('content')
<div class="bg-white overflow-x-hidden">
    {{-- Hero Section --}}
    <div class="bg-neutral-100 relative z-0 overflow-hidden py-10 flex items-center">
        <div class="absolute inset-0">
            <img src="{{ asset('/assets/random/banner.jpg') }}"
                srcset="{{ asset('/assets/random/banner.jpg') }}"
                sizes="(max-width:768px) 600px, 1200px"
                width="1200" height="800"
                loading="lazy"
                alt="Digital Business Solutions"
                class="w-full h-full object-cover object-top opacity-70 max-md:opacity-30 max-md:object-right" />
        </div>

        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 flex justify-center items-center z-10">
            <div class="w-full text-left max-md:text-center text-slate-900">
                <h1 class="text-5xl leading-[54px] max-w-2xl font-medium max-md:text-3xl max-md:leading-snug mb-6">Kami menawarkan solusi terbaik untuk bisnis Anda</h1>
                <p class="text-xl text-neutral-700">Layanan pengembangan perangkat lunak yang efisien dan profesional.</p>
            </div>

            <div class="mr-10 flex-shrink-0">
               <div class="flex items-center max-md:hidden gap-x-2 flex-shrink-0">
                   <img src="{{ asset('assets/image/customer-profile/frisca.png') }}" srcset="{{ asset('assets/image/customer-profile/frisca.png') }}" class="h-[32px] aspect-square rounded-full">
                   <div class="flex flex-col items-center">
                       <span class="font-medium text-base -mb-1">Butuh Bantuan Kami?</span>
                       <button type="button" class="hover:underline text-[15px] text-blue-600 text-left w-full">Hubungi Spesialis</button>
                   </div>
               </div> 
            </div>
        </div>
    </div>

    <p class="text-lg text-neutral-600 text-center w-full max-w-3xl mx-auto px-8 mt-32">Our mission to make information universally accessible and useful starts with making our products safe. Explore our Transparency Center to understand the policies that keep users safe from harm and abuse, as well as information about how we develop and enforce those policies.</p>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 my-16 sm:my-20 md:my-24 mx-auto border-0">

    {{-- Jelajahi Semua Layanan Kami --}}
    <section id="layanan" class="w-full bg-white py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center mb-12">
            <h2 class="text-4xl font-bold text-slate-900 mb-4">Jelajahi Semua Layanan Kami</h2>
        </div>
        <div class="max-w-5xl mx-auto grid grid-cols-1 sm:grid-cols-2 gap-8">
            {{-- Web Development --}}
            <div class="service-card group bg-white rounded-2xl border border-neutral-200 p-8 flex flex-col items-start shadow-sm hover:shadow">
                <h3 class="text-2xl font-semibold mb-2">Web Development</h3>
                <p class="text-slate-700 mb-4">Website modern, cepat, dan responsif yang mempresentasikan bisnis Anda secara profesional.</p>
                <ul class="text-slate-600 text-base mb-6 space-y-1 pl-4 list-disc hidden">
                    <li>Custom & CMS Website</li>
                    <li>Integrasi API</li>
                    <li>SEO Optimization</li>
                </ul>
                <a href="{{ route('services.web-development') }}" class="inline-block mt-auto px-5 py-2 rounded-full bg-[#128AEB] text-white font-medium hover:bg-[#0F76C6] transition">Lihat Detail</a>
            </div>
            {{-- App Development --}}
            <div class="service-card group bg-white rounded-2xl border border-neutral-200 p-8 flex flex-col items-start shadow-sm hover:shadow">
                <h3 class="text-2xl font-semibold mb-2">App Development</h3>
                <p class="text-slate-700 mb-4">Aplikasi berbasis web atau desktop yang disesuaikan untuk meningkatkan produktivitas bisnis.</p>
                <ul class="text-slate-600 text-base mb-6 space-y-1 pl-4 list-disc hidden">
                    <li>Aplikasi Kustom</li>
                    <li>Sistem Manajemen Data</li>
                    <li>Dashboard Analitik</li>
                </ul>
                <a href="{{ route('services.app-development') }}" class="inline-block mt-auto px-5 py-2 rounded-full bg-[#128AEB] text-white font-medium hover:bg-[#0F76C6] transition">Lihat Detail</a>
            </div>
            {{-- UI/UX Design --}}
            <div class="service-card group bg-white rounded-2xl border border-neutral-200 p-8 flex flex-col items-start shadow-sm hover:shadow">
                <h3 class="text-2xl font-semibold mb-2">UI/UX Design</h3>
                <p class="text-slate-700 mb-4">Desain antarmuka yang estetis dan pengalaman pengguna yang intuitif.</p>
                <ul class="text-slate-600 text-base mb-6 space-y-1 pl-4 list-disc hidden">
                    <li>Prototype & Wireframe</li>
                    <li>User Flow Mapping</li>
                    <li>Design System</li>
                </ul>
                <a href="{{ route('services.uiux-design') }}" class="inline-block mt-auto px-5 py-2 rounded-full bg-[#128AEB] text-white font-medium hover:bg-[#0F76C6] transition">Lihat Detail</a>
            </div>
            {{-- Mobile App Development --}}
            <div class="service-card group bg-white rounded-2xl border border-neutral-200 p-8 flex flex-col items-start shadow-sm hover:shadow">
                <h3 class="text-2xl font-semibold mb-2">Mobile App Development</h3>
                <p class="text-slate-700 mb-4">Aplikasi mobile Android dan iOS yang canggih dan mudah digunakan.</p>
                <ul class="text-slate-600 text-base mb-6 space-y-1 pl-4 list-disc hidden">
                    <li>Native & Hybrid Apps</li>
                    <li>Integrasi API</li>
                    <li>Publikasi Store</li>
                </ul>
                <a href="{{ route('services.mobile-app-development') }}" class="inline-block mt-auto px-5 py-2 rounded-full bg-[#128AEB] text-white font-medium hover:bg-[#0F76C6] transition">Lihat Detail</a>
            </div>
            {{-- AI Strategy --}}
            <div class="service-card group bg-white rounded-2xl border border-neutral-200 p-8 flex flex-col items-start shadow-sm hover:shadow">
                <h3 class="text-2xl font-semibold mb-2">AI Strategy</h3>
                <p class="text-slate-700 mb-4">Konsultasi dan perencanaan strategi adopsi AI yang tepat untuk transformasi bisnis Anda.</p>
                <ul class="text-slate-600 text-base mb-6 space-y-1 pl-4 list-disc hidden">
                    <li>AI Readiness Assessment</li>
                    <li>Roadmap Implementasi AI</li>
                    <li>Use Case Identification</li>
                </ul>
                <a href="{{ route('services.ai-strategy') }}" class="inline-block mt-auto px-5 py-2 rounded-full bg-[#128AEB] text-white font-medium hover:bg-[#0F76C6] transition">Lihat Detail</a>
            </div>
            {{-- AI Agents --}}
            <div class="service-card group bg-white rounded-2xl border border-neutral-200 p-8 flex flex-col items-start shadow-sm hover:shadow">
                <h3 class="text-2xl font-semibold mb-2">AI Agents</h3>
                <p class="text-slate-700 mb-4">Bangun agen AI cerdas yang mampu mengeksekusi tugas kompleks secara otomatis dan mandiri.</p>
                <ul class="text-slate-600 text-base mb-6 space-y-1 pl-4 list-disc hidden">
                    <li>Autonomous AI Agents</li>
                    <li>Multi-Agent Systems</li>
                    <li>Agentic Workflow Automation</li>
                </ul>
                <a href="{{ route('services.ai-agents') }}" class="inline-block mt-auto px-5 py-2 rounded-full bg-[#128AEB] text-white font-medium hover:bg-[#0F76C6] transition">Lihat Detail</a>
            </div>
            {{-- AI Automation --}}
            <div class="service-card group bg-white rounded-2xl border border-neutral-200 p-8 flex flex-col items-start shadow-sm hover:shadow">
                <h3 class="text-2xl font-semibold mb-2">AI Automation</h3>
                <p class="text-slate-700 mb-4">Otomatisasi proses bisnis dengan AI untuk meningkatkan efisiensi, akurasi, dan skalabilitas operasional.</p>
                <ul class="text-slate-600 text-base mb-6 space-y-1 pl-4 list-disc hidden">
                    <li>Intelligent Process Automation</li>
                    <li>AI-Powered Workflows</li>
                    <li>Integrasi Sistem & Data</li>
                </ul>
                <a href="{{ route('services.ai-automation') }}" class="inline-block mt-auto px-5 py-2 rounded-full bg-[#128AEB] text-white font-medium hover:bg-[#0F76C6] transition">Lihat Detail</a>
            </div>
        </div>
        {{-- CTA bawah --}}
        <div class="max-w-2xl mx-auto text-center mt-16">
            <p class="text-lg md:text-xl text-slate-800 mb-6">Tidak yakin layanan mana yang sesuai kebutuhan Anda?</p>
            <a href="{{ route('service.consult') }}" class="inline-block px-8 py-3 rounded-full bg-[#128AEB] text-white font-semibold text-lg shadow hover:bg-[#0F76C6] transition">Konsultasi Gratis Sekarang</a>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">
</div>
@endsection