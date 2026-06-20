@extends('partials.layouts.main')

@section('title', 'Tim Centrova - Profil Tim Ahli Teknologi & Inovasi Digital Indonesia')

@section('meta')
    <meta name="title" content="Tim Centrova - Profil Tim Ahli Teknologi & Inovasi Digital Indonesia">
    <meta name="description" content="Berkenalan dengan tim ahli Centrova Indonesia yang berdedikasi mengembangkan solusi teknologi bisnis inovatif. Temui founder, developer, dan profesional teknologi terbaik.">
    <meta name="keywords" content="tim centrova, team centrova indonesia, ahli teknologi, developer indonesia, startup team, teknologi bisnis, inovasi digital">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Indonesian">
    <meta name="author" content="Centrova Indonesia">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Tim Centrova - Profil Tim Ahli Teknologi & Inovasi Digital Indonesia">
    <meta property="og:description" content="Berkenalan dengan tim ahli Centrova Indonesia yang berdedikasi mengembangkan solusi teknologi bisnis inovatif.">
    <meta property="og:image" content="{{ asset('images/centrova-team-og.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Centrova Indonesia">
    <meta property="og:locale" content="id_ID">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="Tim Centrova - Profil Tim Ahli Teknologi & Inovasi Digital Indonesia">
    <meta property="twitter:description" content="Berkenalan dengan tim ahli Centrova Indonesia.">
    <meta property="twitter:image" content="{{ asset('images/centrova-team-og.jpg') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#128AEB">
    <link rel="canonical" href="{{ url()->current() }}">
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Centrova",
        "description": "Tim ahli teknologi Centrova yang mengembangkan solusi digitalisasi bisnis",
        "url": "{{ url()->current() }}",
        "employee": [
            {"@type":"Person","name":"Sultan Rahmatulloh","jobTitle":"System & Software Developer","url":"{{ route('team.profile','sultan-rahmatulloh') }}"},
            {"@type":"Person","name":"Syahied Ramadhan","jobTitle":"Marketing & Relations","url":"{{ route('team.profile','syahied-ramadhan') }}"},
            {"@type":"Person","name":"Muhammad Fadli","jobTitle":"Technical Support","url":"{{ route('team.profile','muhammad-fadli') }}"}
        ],
        "address": {"@type":"PostalAddress","addressLocality":"Jakarta","addressRegion":"DKI Jakarta","addressCountry":"Indonesia"}
    }
    </script>
@endsection

@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-medium text-neutral-800 mb-8">Profil Tim Kami</h1>
        <div class="w-full gap-6 max-md:gap-16 max-md:pb-32 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            <a href="{{ route('team.sultan') }}" class="w-full h-auto flex flex-col group cursor-pointer">
                <div class="w-full aspect-square bg-gradient-to-b from-neutral-500 to-neutral-700 rounded-md overflow-hidden relative border border-neutral-200 relative">
                    <img src="{{ asset('assets/image/team/sultan_image_1b2713t4.jpg') }}" alt="Sultan Rahmatulloh" class="w-full h-full object-cover object-top" loading="lazy">

                    <div class="w-full px-5 pb-3 absolute bottom-0 bg-gradient-to-b from-transparent to-black">
                        <h1 class="text-lg text-white font-bold">Sultan Rahmatulloh</h1>
                        <h2 class="text-lg text-white">AI Venture Engineering</h2>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
