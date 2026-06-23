@extends('partials.layouts.main')

@php
$member = [
    'name' => 'Syahied Ramadhan',
    'position' => 'Marketing & Relations',
    'email' => 'syahied@centrova.id',
    'linkedin' => 'https://linkedin.com/in/syahied-ramadhan',
    'heroImage' => '/assets/image/team/syahied_image_small.jpg',
    'bio' => [
        'intro' => 'Praktisi marketing dan hubungan publik yang berfokus pada strategi pertumbuhan merek dan pengembangan jaringan bisnis. Syahied memiliki pengalaman luas dalam membangun komunikasi yang efektif antara perusahaan dan klien.',
        'content' => [
            'Dengan latar belakang di bidang komunikasi dan pemasaran digital, Syahied bertanggung jawab atas pengembangan strategi brand, pengelolaan media sosial, serta hubungan dengan mitra dan klien Centrova. Ia percaya bahwa hubungan yang baik adalah fondasi dari setiap kolaborasi yang sukses.',
            'Syahied aktif dalam merancang kampanye pemasaran berbasis data, mengelola konten digital, serta membangun kemitraan strategis yang mendukung pertumbuhan bisnis. Pendekatannya yang humanis dan analitis membuatnya mampu menjembatani kebutuhan teknis dengan kebutuhan pasar.',
            'Di luar pekerjaan, Syahied gemar mengeksplorasi tren pemasaran terbaru, menghadiri forum industri, dan terus mengembangkan keterampilan di bidang negosiasi dan hubungan masyarakat.',
        ],
    ],
    'education' => [
        ['degree' => 'S1 Ilmu Komunikasi', 'institution' => 'Universitas Padjadjaran', 'period' => '2017 � 2021', 'description' => 'Fokus pada komunikasi pemasaran, hubungan masyarakat, dan media digital.'],
    ],
    'certifications' => [
        ['name' => 'Google Digital Marketing Certificate', 'issuer' => 'Google', 'year' => '2023', 'status' => 'Active'],
        ['name' => 'HubSpot Social Media Marketing', 'issuer' => 'HubSpot Academy', 'year' => '2024', 'status' => 'Active'],
    ],
];
$hasEducation = !empty($member['education']);
$hasCertifications = !empty($member['certifications']);
@endphp

@section('title', $member['name'] . ' - ' . $member['position'] . ' | Centrova')

@section('meta')
    <meta name="title" content="{{ $member['name'] }} - {{ $member['position'] }} | Centrova">
    <meta name="description" content="{{ Str::limit(strip_tags($member['bio']['intro']), 160) }}">
    <meta name="keywords" content="{{ $member['name'] }}, {{ $member['position'] }}, tim centrova, teknologi indonesia">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Indonesian">
    <meta name="author" content="Centrova">
    <meta property="og:type" content="profile">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $member['name'] }} - {{ $member['position'] }} | Centrova">
    <meta property="og:description" content="{{ Str::limit(strip_tags($member['bio']['intro']), 160) }}">
    <meta property="og:image" content="{{ asset($member['heroImage']) }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Centrova">
    <meta property="og:locale" content="id_ID">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $member['name'] }} - {{ $member['position'] }} | Centrova">
    <meta property="twitter:description" content="{{ Str::limit(strip_tags($member['bio']['intro']), 160) }}">
    <meta property="twitter:image" content="{{ asset($member['heroImage']) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#128AEB">
    <link rel="canonical" href="{{ url()->current() }}">
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": "{{ $member['name'] }}",
        "jobTitle": "{{ $member['position'] }}",
        "worksFor": {"@type":"Organization","name":"Centrova","url":"{{ route('home') }}"},
        "url": "{{ url()->current() }}",
        "image": "{{ asset($member['heroImage']) }}",
        "description": "{{ Str::limit(strip_tags($member['bio']['intro']), 200) }}",
        "email": "{{ $member['email'] }}",
        "sameAs": ["{{ $member['linkedin'] }}"]
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {"@type":"ListItem","position":1,"name":"Home","item":"{{ route('home') }}"},
            {"@type":"ListItem","position":2,"name":"{{ $member['name'] }}","item":"{{ url()->current() }}"}
        ]
    }
    </script>
@endsection

@section('content')

{{-- Hero: Oracle-style split layout --}}
<section class="bg-white border-b border-neutral-200">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col-reverse lg:flex-row">
            <div class="lg:w-1/2 bg-neutral-100 flex items-end justify-center overflow-hidden">
                <img src="{{ asset($member['heroImage']) }}" alt="{{ $member['name'] }}" class="w-full h-[400px] lg:h-[580px] object-contain object-bottom">
            </div>
            <div class="lg:w-1/2 flex flex-col justify-center px-8 lg:px-16 py-12 lg:py-0">
                <p class="text-sm font-semibold text-neutral-500 uppercase tracking-widest mb-4">Executive Profile</p>
                <h1 class="text-4xl lg:text-6xl font-light text-neutral-900 leading-tight mb-4">{{ $member['name'] }}</h1>
                <p class="text-xl lg:text-2xl text-neutral-600 font-light">{{ $member['position'] }}</p>
                <div class="mt-8 flex items-center gap-4">
                    <a href="mailto:{{ $member['email'] }}" class="inline-flex items-center gap-2 text-sm text-primary-600 hover:text-primary-700 font-medium transition">
                        <span class="material-symbols-outlined text-base">mail</span>
                        {{ $member['email'] }}
                    </a>
                    <a href="{{ $member['linkedin'] }}" target="_blank" class="inline-flex items-center gap-2 text-sm text-neutral-500 hover:text-primary-600 font-medium transition">
                        <span class="material-symbols-outlined text-base">linkedin</span>
                        LinkedIn
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Bio Section --}}
<section class="py-16 lg:py-20 bg-white">
    <div class="max-w-4xl mx-auto px-8">
        <div class="border-t border-neutral-200 pt-10">
            <p class="text-lg lg:text-xl text-neutral-700 leading-relaxed mb-6">{{ $member['bio']['intro'] }}</p>
            @if(!empty($member['bio']['content']))
                @foreach($member['bio']['content'] as $paragraph)
                    <p class="text-lg text-neutral-700 leading-relaxed mb-4">{{ $paragraph }}</p>
                @endforeach
            @endif
        </div>
    </div>
</section>

@if($hasEducation || $hasCertifications)
<section class="py-16 lg:py-20 bg-neutral-50 border-t border-neutral-200">
    <div class="max-w-7xl mx-auto px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            @if($hasEducation)
            <div>
                <h2 class="text-sm font-semibold text-neutral-500 uppercase tracking-widest mb-8">Pendidikan</h2>
                <div class="space-y-8">
                    @foreach($member['education'] as $edu)
                    <div>
                        <h3 class="text-xl font-semibold text-neutral-900 mb-1">{{ $edu['degree'] }}</h3>
                        <p class="text-primary-600 font-medium mb-0.5">{{ $edu['institution'] }}</p>
                        <p class="text-neutral-500 text-sm mb-2">{{ $edu['period'] }}</p>
                        <p class="text-neutral-700">{{ $edu['description'] }}</p>
                        @if(!empty($edu['grade']))
                        <p class="text-amber-600 text-sm font-medium mt-1">{{ $edu['grade'] }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            @if($hasCertifications)
            <div>
                <h2 class="text-sm font-semibold text-neutral-500 uppercase tracking-widest mb-8">Sertifikasi</h2>
                <div class="space-y-5">
                    @foreach($member['certifications'] as $cert)
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 bg-green-50 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="material-symbols-outlined text-green-600 text-base">verified</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-neutral-900">{{ $cert['name'] }}</h3>
                            <p class="text-neutral-600 text-sm">{{ $cert['issuer'] }} &middot; {{ $cert['year'] }}</p>
                            <span class="inline-block text-xs font-medium text-green-700 bg-green-50 px-2 py-0.5 rounded-full mt-1">{{ $cert['status'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endif

{{-- Back Link removed --}}

@endsection