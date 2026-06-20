@extends('partials.layouts.main')

@section('title', 'Sultan Rahmatulloh - System & Software Developer | Centrova')

@section('meta')
    <meta name="title" content="Sultan Rahmatulloh - System & Software Developer | Centrova">
    <meta name="description" content="Pengembang sistem dan perangkat lunak berpengalaman dengan fokus pada arsitektur backend yang scalable dan handal.">
    <meta name="keywords" content="Sultan Rahmatulloh, System & Software Developer, tim centrova, teknologi indonesia">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Indonesian">
    <meta name="author" content="Centrova">
    <meta property="og:type" content="profile">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Sultan Rahmatulloh - System & Software Developer | Centrova">
    <meta property="og:description" content="Pengembang sistem dan perangkat lunak berpengalaman dengan fokus pada arsitektur backend yang scalable dan handal.">
    <meta property="og:image" content="{{ asset('/assets/image/team/sultan_image_small.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Centrova Indonesia">
    <meta property="og:locale" content="id_ID">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="Sultan Rahmatulloh - System & Software Developer | Centrova">
    <meta property="twitter:description" content="Pengembang sistem dan perangkat lunak berpengalaman dengan fokus pada arsitektur backend yang scalable dan handal.">
    <meta property="twitter:image" content="{{ asset('/assets/image/team/sultan_image_small.jpg') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#128AEB">
    <link rel="canonical" href="{{ url()->current() }}">
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": "Sultan Rahmatulloh",
        "jobTitle": "System & Software Developer",
        "worksFor": {"@type":"Organization","name":"Centrova","url":"{{ route('home') }}"},
        "url": "{{ url()->current() }}",
        "image": "{{ asset('/assets/image/team/sultan_image_small.jpg') }}",
        "description": "Pengembang sistem dan perangkat lunak berpengalaman dengan fokus pada arsitektur backend yang scalable dan handal.",
        "email": "sultan@centrova.id",
        "sameAs": ["https://linkedin.com/in/sultan-rahmatulloh"]
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {"@type":"ListItem","position":1,"name":"Home","item":"{{ route('home') }}"},
            {"@type":"ListItem","position":2,"name":"Sultan Rahmatulloh","item":"{{ url()->current() }}"}
        ]
    }
    </script>
@endsection

@section('content')

{{-- Profile Hero Section (Forbes-style layout) --}}
<div class="bg-primary-500 pt-20">
    <div class="max-w-6xl mx-auto px-6 sm:px-8 lg:px-12 bg-white">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12 py-6 sm:py-8 lg:py-12">
            {{-- Left: Profile Image --}}
            <div class="order-2 lg:order-1">
                <img src="{{ asset('assets/image/team/sultan_image_o32hr3.jpg') }}" alt="Sultan Rahmatulloh" class="w-full h-auto">
            </div>
            {{-- Right: Name & Position --}}
            <div class="order-1 lg:order-2 col-span-2 flex flex-col justify-start tracking-tight">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-neutral-900 tracking-tighter mb-3">Sultan Rahmatulloh</h1>
                <h2 class="text-xl md:text-2xl text-neutral-600 font-medium mb-6">AI Native Engineering</h2>
                <p class="text-neutral-600 leading-relaxed">Pengembang sistem dan perangkat lunak berpengalaman dengan fokus pada arsitektur backend yang scalable dan handal.</p>
            </div>
        </div>
    </div>
</div>

{{-- Bio Section --}}
<div class="pb-10 pt-4 lg:pb-14 pt-8 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-8 lg:px-8">
        <div class="prose prose-lg max-w-none">
            <p class="text-neutral-800 leading-relaxed mb-4">Pengembang sistem dan perangkat lunak berpengalaman dengan fokus pada arsitektur backend yang scalable dan handal. Sultan memiliki komitmen tinggi terhadap kualitas kode, efisiensi sistem, dan keamanan aplikasi.</p>
            <p class="text-neutral-800 leading-relaxed mb-4">Dengan latar belakang yang kuat dalam pengembangan full-stack dan arsitektur sistem, Sultan telah berkontribusi dalam membangun berbagai solusi teknologi untuk bisnis — mulai dari sistem manajemen internal, platform e-commerce, hingga aplikasi mobile dan web skala enterprise.</p>
            <p class="text-neutral-800 leading-relaxed mb-4">Keahliannya meliputi PHP (Laravel), JavaScript, database relasional dan non-relasional, serta arsitektur cloud dan deployment. Sultan juga aktif menerapkan praktik DevOps dan CI/CD untuk memastikan setiap rilis berjalan mulus dan stabil.</p>
            <p class="text-neutral-800 leading-relaxed mb-4">Selain pengembangan, Sultan juga terlibat dalam perencanaan arsitektur sistem, code review, dan mentoring developer junior. Ia percaya bahwa fondasi teknis yang kuat adalah kunci dari produk digital yang sukses dan berkelanjutan.</p>
        </div>
    </div>
</div>

{{-- Back Link removed --}}
@endsection
