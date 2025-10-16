@extends('partials.layouts.team')

@section('title', 'Tim Centrova - Profil Tim Ahli Teknologi & Inovasi Digital Indonesia')

@section('meta')
    {{-- Primary Meta Tags --}}
    <meta name="title" content="Tim Centrova - Profil Tim Ahli Teknologi & Inovasi Digital Indonesia">
    <meta name="description" content="Berkenalan dengan tim ahli Centrova Indonesia yang berdedikasi mengembangkan solusi teknologi bisnis inovatif. Temui founder, developer, dan profesional teknologi terbaik.">
    <meta name="keywords" content="tim centrova, team centrova indonesia, ahli teknologi, developer indonesia, startup team, teknologi bisnis, inovasi digital, POS system team">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Indonesian">
    <meta name="author" content="Centrova Indonesia">
    
    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Tim Centrova - Profil Tim Ahli Teknologi & Inovasi Digital Indonesia">
    <meta property="og:description" content="Berkenalan dengan tim ahli Centrova Indonesia yang berdedikasi mengembangkan solusi teknologi bisnis inovatif. Temui founder, developer, dan profesional teknologi terbaik.">
    <meta property="og:image" content="{{ asset('images/centrova-team-og.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Centrova Indonesia">
    <meta property="og:locale" content="id_ID">
    
    {{-- Twitter --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="Tim Centrova - Profil Tim Ahli Teknologi & Inovasi Digital Indonesia">
    <meta property="twitter:description" content="Berkenalan dengan tim ahli Centrova Indonesia yang berdedikasi mengembangkan solusi teknologi bisnis inovatif. Temui founder, developer, dan profesional teknologi terbaik.">
    <meta property="twitter:image" content="{{ asset('images/centrova-team-og.jpg') }}">
    <meta property="twitter:site" content="@centrova_id">
    <meta property="twitter:creator" content="@centrova_id">
    
    {{-- Additional SEO Meta Tags --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#128AEB">
    <meta name="msapplication-TileColor" content="#128AEB">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    
    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}">
    
    {{-- Structured Data / JSON-LD --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Centrova Indonesia",
        "description": "Tim ahli teknologi Centrova Indonesia yang mengembangkan solusi digitalisasi bisnis dan sistem POS inovatif",
        "url": "{{ url()->current() }}",
        "logo": "{{ asset('images/centrova-logo.png') }}",
        "sameAs": [
            "https://instagram.com/centrova.indonesia",
            "https://linkedin.com/company/centrova-indonesia",
            "https://github.com/centrova"
        ],
        "employee": [
            {
                "@type": "Person",
                "name": "Sultan Rahmatulloh",
                "jobTitle": "Founder",
                "worksFor": {
                    "@type": "Organization",
                    "name": "Centrova Indonesia"
                },
                "url": "{{ route('team.profile', 'sultan') }}"
            }
        ],
        "foundingDate": "2024",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Jakarta Barat",
            "addressRegion": "DKI Jakarta",
            "addressCountry": "Indonesia"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+62-858-1790-9560",
            "contactType": "customer service",
            "email": "centrova@gmail.com"
        }
    }
    </script>
@endsection

@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-medium text-slate-700 mb-8">Profil Tim Kami</h1>
        
        {{-- Loading State --}}
        <div id="loading-state" class="flex items-center justify-center py-20">
            <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-[#128AEB]"></div>
        </div>
        
        {{-- Team Grid --}}
        <div id="team-grid" class="w-full flex max-md:flex-col gap-6 max-md:gap-16 justify-start max-md:items-center max-md:pb-32 grid grid-cols-3" style="display: none;">
            {{-- Team members will be dynamically inserted here --}}
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        loadTeamMembers();
    });

    async function loadTeamMembers() {
        try {
            
            const response = await fetch('/data/team.js');
            const scriptText = await response.text();
            
            
            eval(scriptText);
            
            const teamMembers = getAllTeamMembers();
            renderTeamGrid(teamMembers);
            hideLoadingState();
            
        } catch (error) {
            console.error('Error loading team data:', error);
            document.getElementById('loading-state').innerHTML = `
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-slate-700 mb-4">Gagal Memuat Data Tim</h2>
                    <p class="text-slate-600">Silakan refresh halaman untuk mencoba lagi.</p>
                </div>
            `;
        }
    }

    function renderTeamGrid(teamMembers) {
        const container = document.getElementById('team-grid');
        
        container.innerHTML = teamMembers.map(member => `
            <a href="/team/${member.slug}" class="w-full h-auto flex-col group cursor-pointer">
                <div class="w-full aspect-[10/7] bg-gradient-to-b from-neutral-200 to-white rounded-3xl overflow-hidden relative">
                    <img src="${member.heroImage || '/images/default-profile.jpg'}" 
                         srcset="${member.heroImage || '/images/default-profile.jpg'} 1x, ${member.heroImage || '/images/default-profile.jpg'} 2x"
                         sizes="(max-width: 768px) 300px, (max-width: 1024px) 280px, 300px"
                         alt="${member.name}" 
                         class="w-full h-full object-contain object-top opacity-90 group-hover:opacity-100 transition-opacity"
                         onload="this.style.opacity='100'" loading="lazy"
                         onerror="this.src='/images/default-profile.jpg'; this.style.opacity='0.7';">
                    <!-- Fallback jika foto tidak ada -->
                    <div class="absolute inset-0 flex items-center justify-center text-neutral-400" style="display: none;" id="fallback-${member.slug}">
                        <svg class="w-28 h-28" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                </div>
                <div class="w-full pt-4">
                    <h1 class="text-lg text-blue-500 font-medium text-left group-hover:underline">${member.name}</h1>
                    <h2 class="text-lg text-neutral-600 text-left">${member.position}</h2>
                </div>
            </a>
        `).join('');
        
        
        teamMembers.forEach(member => {
            const img = container.querySelector(`img[alt="${member.name}"]`);
            if (img) {
                img.addEventListener('error', function() {
                    
                    this.style.display = 'none';
                    const fallback = document.getElementById(`fallback-${member.slug}`);
                    if (fallback) fallback.style.display = 'flex';
                });
            }
        });
    }

    function hideLoadingState() {
        document.getElementById('loading-state').style.display = 'none';
        document.getElementById('team-grid').style.display = 'flex';
    }
</script>
@endsection
