@extends('partials.layouts.team')

@section('title', 'Profil Tim Centrova - ' . ucfirst($slug))

@section('seoMetaTags')
    {{-- Primary Meta Tags - Will be updated by JavaScript --}}
    <meta name="title" content="Profil Tim Centrova - {{ ucfirst($slug) }}">
    <meta name="description" content="Profil lengkap anggota tim Centrova Indonesia. Pelajari latar belakang, keahlian, dan kontribusi dalam mengembangkan solusi teknologi bisnis inovatif.">
    <meta name="keywords" content="profil tim centrova, {{ $slug }}, tim teknologi indonesia, ahli POS system, developer indonesia, startup team profile">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Indonesian">
    <meta name="author" content="Centrova Indonesia">
    
    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="profile">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Profil Tim Centrova - {{ ucfirst($slug) }}">
    <meta property="og:description" content="Profil lengkap anggota tim Centrova Indonesia. Pelajari latar belakang, keahlian, dan kontribusi dalam mengembangkan solusi teknologi bisnis inovatif.">
    <meta property="og:image" content="{{ asset('images/centrova-team-' . $slug . '-og.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Centrova Indonesia">
    <meta property="og:locale" content="id_ID">
    
    {{-- Twitter --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="Profil Tim Centrova - {{ ucfirst($slug) }}">
    <meta property="twitter:description" content="Profil lengkap anggota tim Centrova Indonesia. Pelajari latar belakang, keahlian, dan kontribusi dalam mengembangkan solusi teknologi bisnis inovatif.">
    <meta property="twitter:image" content="{{ asset('images/centrova-team-' . $slug . '-og.jpg') }}">
    <meta property="twitter:site" content="@centrova_id">
    <meta property="twitter:creator" content="@centrova_id">
    
    {{-- Additional SEO Meta Tags --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#128AEB">
    <meta name="msapplication-TileColor" content="#128AEB">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    
    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}">
    
    {{-- Preload critical resources --}}
    <link rel="preload" href="/data/team.js" as="script">
@endsection

@push('structured-data')
    {{-- Structured Data / JSON-LD - Will be updated by JavaScript --}}
    <script type="application/ld+json" id="person-schema">
        {
            "@context": "https://schema.org",
            "@type": "Person",
            "name": "{{ ucfirst($slug) }}",
            "worksFor": {
                "@type": "Organization",
                "name": "Centrova Indonesia",
                "url": "{{ route('home') }}"
            },
            "url": "{{ url()->current() }}",
            "image": "{{ asset('images/centrova-team-' . $slug . '.jpg') }}",
            "description": "Anggota tim Centrova Indonesia yang berkontribusi dalam pengembangan solusi teknologi bisnis",
            "knowsAbout": ["Technology", "Software Development", "Business Solutions", "Digital Innovation"],
            "memberOf": {
                "@type": "Organization",
                "name": "Centrova Indonesia"
            }
        }
    </script>

    {{-- Breadcrumb Schema --}}
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "name": "Home",
                    "item": "{{ route('home') }}"
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "name": "Tim Centrova",
                    "item": "{{ route('team.index') }}"
                },
                {
                    "@type": "ListItem",
                    "position": 3,
                    "name": "{{ ucfirst($slug) }}",
                    "item": "{{ url()->current() }}"
                }
            ]
        }
    </script>
@endpush

@section('space-top', ' ')

@section('content')
    {{-- Dynamic Content Container --}}
    <div id="team-profile-container">
        {{-- Loading State --}}
        <div id="loading-state" class="flex items-center justify-center min-h-screen">
            <div class="animate-spin rounded-full h-32 w-32 border-b-2 border-[#128AEB]"></div>
        </div>
        
        {{-- Profile Content (Will be populated by JavaScript) --}}
        <div id="profile-content" style="display: none;">
            {{-- Content will be dynamically inserted here --}}
        </div>
        
        {{-- Error State --}}
        <div id="error-state" style="display: none;" class="flex items-center justify-center min-h-screen">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-slate-700 mb-4">Tim Member Tidak Ditemukan</h1>
                <p class="text-xl text-slate-600 mb-8">Maaf, profil yang Anda cari tidak tersedia.</p>
                <a href="{{ route('team.index') }}" class="inline-block bg-[#128AEB] text-white font-bold px-8 py-3 rounded-full shadow-lg hover:bg-[#0d6bb8] transition">
                    Kembali ke Tim
                </a>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Get team member slug from Laravel
                const slug = '{{ $slug }}';
                
                // Load team data
                loadTeamMember(slug);
            });

            async function loadTeamMember(slug) {
                try {
                    // Load team data from external file
                    const response = await fetch('/data/team.js');
                    const scriptText = await response.text();
                    
                    // Execute the script to get teamData
                    eval(scriptText);
                    
                    const member = getTeamMember(slug);
                    
                    if (!member) {
                        showErrorState();
                        return;
                    }
                    
                    renderProfile(member);
                    updatePageTitle(member);
                    hideLoadingState();
                    
                } catch (error) {
                    console.error('Error loading team data:', error);
                    showErrorState();
                }
            }

            function renderProfile(member) {
                const container = document.getElementById('profile-content');
                
                // Store gallery data globally for Alpine.js with null check
                window.currentMemberGallery = (member && member.gallery) ? member.gallery : [];
                
                // Helper function to safely get member data
                const getName = () => (member && member.name) ? member.name : 'Tim Member';
                const getPosition = () => (member && member.position) ? member.position : 'Posisi tidak tersedia';
                const getHeroImage = () => (member && member.heroImage) ? member.heroImage : '/images/default-profile.jpg';
                
                container.innerHTML = `
                    {{-- Hero Section --}}
                    <div class="relative max-md:h-[250px] h-[560px] -mt-1 md:-mt-[60px] md:py-[60px] bg-gradient-to-b from-neutral-100 to-neutral-50 overflow-hidden">
                        <div class="absolute inset-0"></div>
                        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center" data-aos="fade-up">
                            <div class="flex w-full h-full gap-8 items-center relative">
                                <div class="text-slate-800 max-md:hidden">
                                    <h1 class="text-4xl md:text-5xl tracking-tight font-medium mb-4">${getName()}</h1>
                                    <p class="text-3xl md:text-2xl mb-4">${getPosition()}</p>
                                </div>
                                <div class="flex-1 w-full justify-end h-full relative flex items-end pt-8">
                                    <img src="${getHeroImage()}" class="h-full object-cover bg-neutral-200 aspect-[8/6] rounded-3xl flex-shrink-0" alt="${getName()}" onerror="this.src='/images/default-profile.jpg'">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Bio Section --}}
                    <div class="py-12 md:py-24 bg-white">
                        <div class="max-w-4xl gap-x-8 max-md:gap-y-4 flex max-md:flex-col mx-auto px-4 sm:px-8 lg:px-8 text-neutral-800 text-lg">
                            <div class="text-slate-700 md:hidden">
                                <h1 class="text-4xl md:text-5xl font-semibold mb-4">${getName()}</h1>
                                <p class="text-2xl mb-4">${getPosition()}</p>
                            </div>
                            <div class="prose prose-lg ${getBioColumnClass(member && member.bio ? member.bio : {})}">
                                ${member && member.bio && member.bio.intro ? `<p class="leading-relaxed mb-4">${member.bio.intro}</p>` : ''}
                                ${member && member.bio && member.bio.content && Array.isArray(member.bio.content) ? 
                                    member.bio.content.map(paragraph => `<p class="mb-4">${paragraph}</p>`).join('') : 
                                    '<p class="mb-6">Bio sedang dalam proses pembaruan.</p>'
                                }
                            </div>
                        </div>
                    </div>

                    {{-- Leadership Highlights --}}
                    ${member && member.highlights && Array.isArray(member.highlights) && member.highlights.length > 0 ? `
                        <div class="py-16 bg-gradient-to-br from-white to-[#128AEB]/10">
                            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                                <h2 class="text-3xl font-bold text-[#004E8D] text-center mb-12">Highlight & Pencapaian</h2>
                                
                                <div class="grid md:grid-cols-3 gap-8">
                                    ${member.highlights.map(highlight => `
                                        <div class="bg-white/25 backdrop-blur-lg rounded-xl p-8 border-2 border-white/30 shadow-lg hover:scale-105 transition-transform">
                                            <div class="bg-gradient-to-tr from-[#004E8D] to-[#128AEB] w-12 h-12 rounded-full flex items-center justify-center mb-4">
                                                ${getHighlightIcon(highlight && highlight.icon ? highlight.icon : 'innovation')}
                                            </div>
                                            <h3 class="text-xl font-bold text-[#004E8D] mb-2">${highlight && highlight.title ? highlight.title : 'Highlight'}</h3>
                                            <p class="text-[#004E8D]/80">${highlight && highlight.description ? highlight.description : 'Deskripsi akan segera tersedia.'}</p>
                                        </div>
                                    `).join('')}
                                </div>
                            </div>
                        </div>
                    ` : ''}

                    {{-- Skills Section --}}
                    ${member && member.skills && (member.skills.technical || member.skills.leadership) ? `
                        <section class="py-20 bg-white">
                            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                                <div class="text-center mb-16">
                                    <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Keahlian & Kompetensi</h2>
                                    <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                                        Pengalaman dan keahlian yang mendukung kesuksesan dalam kontribusi di Centrova
                                    </p>
                                </div>

                                <div class="grid md:grid-cols-2 gap-12">
                                    {{-- Technical Skills --}}
                                    ${member.skills.technical && Array.isArray(member.skills.technical) && member.skills.technical.length > 0 ? `
                                        <div class="space-y-8">
                                            <h3 class="text-2xl font-semibold text-slate-900 mb-6 flex items-center">
                                                Keahlian Teknis
                                            </h3>
                                            
                                            <div class="space-y-6">
                                                ${member.skills.technical.map(skill => `
                                                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl hover:bg-slate-100 transition-colors">
                                                        <div class="flex items-center space-x-4">
                                                            <div class="bg-[#128AEB]/10 p-2 rounded-lg">
                                                                <svg class="w-6 h-6 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                                </svg>
                                                            </div>
                                                            <span class="font-medium text-slate-800">${skill && skill.name ? skill.name : 'Skill'}</span>
                                                        </div>
                                                        <div class="flex space-x-1">
                                                            ${Array.from({length: 5}, (_, i) => 
                                                                `<div class="w-2 h-2 ${i < (skill && skill.level ? skill.level : 3) ? 'bg-[#128AEB]' : 'bg-slate-300'} rounded-full"></div>`
                                                            ).join('')}
                                                        </div>
                                                    </div>
                                                `).join('')}
                                            </div>
                                        </div>
                                    ` : ''}

                                    {{-- Leadership Skills --}}
                                    ${member.skills.leadership && Array.isArray(member.skills.leadership) && member.skills.leadership.length > 0 ? `
                                        <div class="space-y-8">
                                            <h3 class="text-2xl font-semibold text-slate-900 mb-6 flex items-center">
                                                Kepemimpinan
                                            </h3>
                                            
                                            <div class="space-y-6">
                                                ${member.skills.leadership.map(skill => `
                                                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl hover:bg-slate-100 transition-colors">
                                                        <div class="flex items-center space-x-4">
                                                            <div class="bg-[#0F76C6]/10 p-2 rounded-lg">
                                                                <svg class="w-6 h-6 text-[#0F76C6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                                </svg>
                                                            </div>
                                                            <span class="font-medium text-slate-800">${skill && skill.name ? skill.name : 'Skill'}</span>
                                                        </div>
                                                        <div class="flex space-x-1">
                                                            ${Array.from({length: 5}, (_, i) => 
                                                                `<div class="w-2 h-2 ${i < (skill && skill.level ? skill.level : 3) ? 'bg-[#0F76C6]' : 'bg-slate-300'} rounded-full"></div>`
                                                            ).join('')}
                                                        </div>
                                                    </div>
                                                `).join('')}
                                            </div>
                                        </div>
                                    ` : ''}
                                </div>
                            </div>
                        </section>
                    ` : ''}

                    {{-- Career Journey Section --}}
                    ${member && member.career && Array.isArray(member.career) && member.career.length > 0 ? `
                        <section class="py-20 bg-gradient-to-br from-slate-50 to-white">
                            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                                <div class="text-center mb-16">
                                    <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Perjalanan Karir</h2>
                                    <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                                        Milestone penting dalam perjalanan profesional yang membentuk pengalaman dan visi saat ini
                                    </p>
                                </div>

                                <div class="relative">
                                    {{-- Timeline line --}}
                                    <div class="absolute left-8 md:left-1/2 transform md:-translate-x-1/2 top-0 bottom-0 w-0.5 bg-gradient-to-b from-[#128AEB] to-[#0F76C6]"></div>
                                    
                                    <div class="space-y-12">
                                        ${member.career.map((job, index) => `
                                            <div class="relative flex items-center md:justify-center">
                                                <div class="absolute left-8 md:left-1/2 transform md:-translate-x-1/2 w-4 h-4 rounded-full border-4 border-white shadow-lg z-10" style="background-color: ${job && job.color ? job.color : '#128AEB'}"></div>
                                                <div class="ml-16 md:ml-0 md:grid md:grid-cols-2 md:gap-8 w-full">
                                                    ${index % 2 === 0 ? `
                                                        <div class="md:text-right md:pr-8">
                                                            <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-100 hover:shadow-xl transition-all duration-300">
                                                                <div class="text-sm font-semibold mb-2" style="color: ${job && job.color ? job.color : '#128AEB'}">${job && job.period ? job.period : 'Periode tidak tersedia'}</div>
                                                                <h3 class="text-xl font-bold text-slate-900 mb-3">${job && job.title ? job.title : 'Posisi tidak tersedia'}</h3>
                                                                <p class="text-slate-600 leading-relaxed">${job && job.description ? job.description : 'Deskripsi akan segera tersedia.'}</p>
                                                                <div class="flex flex-wrap gap-2 mt-4">
                                                                    ${job && job.skills && Array.isArray(job.skills) ? job.skills.map(skill => `
                                                                        <span class="px-3 py-1 text-xs font-medium rounded-full" style="background-color: ${job.color || '#128AEB'}20; color: ${job.color || '#128AEB'}">${skill}</span>
                                                                    `).join('') : ''}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="md:pl-8 hidden md:block"></div>
                                                    ` : `
                                                        <div class="md:pr-8 hidden md:block"></div>
                                                        <div class="md:pl-8">
                                                            <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-100 hover:shadow-xl transition-all duration-300">
                                                                <div class="text-sm font-semibold mb-2" style="color: ${job && job.color ? job.color : '#128AEB'}">${job && job.period ? job.period : 'Periode tidak tersedia'}</div>
                                                                <h3 class="text-xl font-bold text-slate-900 mb-3">${job && job.title ? job.title : 'Posisi tidak tersedia'}</h3>
                                                                <p class="text-slate-600 leading-relaxed">${job && job.description ? job.description : 'Deskripsi akan segera tersedia.'}</p>
                                                                <div class="flex flex-wrap gap-2 mt-4">
                                                                    ${job && job.skills && Array.isArray(job.skills) ? job.skills.map(skill => `
                                                                        <span class="px-3 py-1 text-xs font-medium rounded-full" style="background-color: ${job.color || '#128AEB'}20; color: ${job.color || '#128AEB'}">${skill}</span>
                                                                    `).join('') : ''}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    `}
                                                </div>
                                            </div>
                                        `).join('')}
                                    </div>
                                </div>
                            </div>
                        </section>
                    ` : ''}

                    {{-- Achievements Section --}}
                    ${member.achievements && member.achievements.length > 0 ? `
                        <section class="py-20 bg-white">
                            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                                <div class="text-center mb-16">
                                    <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Penghargaan & Pengakuan</h2>
                                    <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                                        Apresiasi atas kontribusi dalam industri teknologi dan pengembangan ekosistem startup Indonesia
                                    </p>
                                </div>

                                <div class="grid md:grid-cols-2 gap-12">
                                    ${member.achievements.map(achievement => `
                                        <div class="group relative bg-gradient-to-br rounded-2xl p-8 border transition-all duration-300 hover:shadow-xl" style="background: linear-gradient(135deg, ${achievement && achievement.color ? achievement.color : '#128AEB'}10 0%, ${achievement && achievement.color ? achievement.color : '#128AEB'}05 100%); border-color: ${achievement && achievement.color ? achievement.color : '#128AEB'}30;">
                                            <div class="absolute inset-0 bg-gradient-to-br rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: linear-gradient(135deg, ${achievement && achievement.color ? achievement.color : '#128AEB'}10 0%, transparent 100%);"></div>
                                            <div class="relative z-10">
                                                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300" style="background: linear-gradient(135deg, ${achievement && achievement.color ? achievement.color : '#128AEB'} 0%, ${achievement && achievement.color ? achievement.color : '#128AEB'}CC 100%);">
                                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                                    </svg>
                                                </div>
                                                <h3 class="text-xl font-bold text-slate-900 mb-3">${achievement && achievement.title ? achievement.title : 'Penghargaan'}</h3>
                                                <p class="text-slate-600 leading-relaxed mb-4">${achievement && achievement.description ? achievement.description : 'Deskripsi akan segera tersedia.'}</p>
                                                <div class="text-sm font-medium" style="color: ${achievement && achievement.color ? achievement.color : '#128AEB'}">${achievement && achievement.organization ? achievement.organization : 'Organisasi'}</div>
                                            </div>
                                        </div>
                                    `).join('')}
                                </div>
                            </div>
                        </section>
                    ` : ''}

                    {{-- Photo Gallery Section --}}
                    ${window.currentMemberGallery && window.currentMemberGallery.length > 0 ? `
                        <section class="py-24 bg-gradient-to-b from-slate-50 hidden to-white" x-data="gallerySection" x-init="initGallery()">
                            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                                <div class="text-center mb-16">
                                    <h2 class="text-4xl font-semibold text-slate-900 mb-4">Galeri Foto</h2>
                                    <p class="text-xl text-slate-700 max-w-3xl mx-auto hidden">
                                        Momen-momen berharga dalam perjalanan berkontribusi di Centrova dan industri teknologi
                                    </p>
                                </div>

                                {{-- Photo Grid --}}
                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                    <template x-for="(photo, index) in photos" :key="index">
                                        <div 
                                            class="group relative aspect-square overflow-hidden rounded-2xl cursor-pointer transition-all duration-500"
                                            @click="openPhotoModal(index)">
                                            
                                            <img 
                                                :src="photo && photo.thumbnail ? photo.thumbnail : '/images/default-gallery.jpg'" 
                                                :alt="photo && photo.caption ? photo.caption : 'Foto galeri'"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                                onerror="this.src='/images/default-gallery.jpg'">
                                            
                                            {{-- Overlay on hover --}}
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-end p-4">
                                                <p class="text-white text-sm font-medium" x-text="photo && photo.caption ? photo.caption : 'Foto galeri'"></p>
                                            </div>
                                        </div>
                                    </template>
                                </div>

                                {{-- Photo Modal --}}
                                <div x-show="showModal" 
                                    x-cloak
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    class="fixed inset-0 z-50 flex"
                                    @keydown.escape="closeModal()"
                                    @click.self="closeModal()">
                                    
                                    {{-- Main Image Container --}}
                                    <div class="flex-1 relative bg-black flex items-center justify-center">
                                        <img :src="selectedPhoto && selectedPhoto.fullsize ? selectedPhoto.fullsize : (selectedPhoto && selectedPhoto.thumbnail ? selectedPhoto.thumbnail : '/images/default-gallery.jpg')" 
                                            :alt="selectedPhoto && selectedPhoto.caption ? selectedPhoto.caption : 'Foto galeri'"
                                            class="max-w-full h-full w-auto object-contain">

                                        {{-- Close Button --}}
                                        <button @click="closeModal()" 
                                                class="absolute top-4 right-4 z-20 bg-white rounded-full p-2 shadow-lg hover:bg-gray-100 transition-colors">
                                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>

                                        {{-- Photo Counter --}}
                                        <div class="absolute top-4 left-4 z-20 bg-black/60 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm">
                                            <span x-text="currentIndex + 1"></span> / <span x-text="photos.length"></span>
                                        </div>
                                        
                                        {{-- Navigation Buttons --}}
                                        <button @click="prevPhoto()" 
                                                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/80 backdrop-blur-sm rounded-full p-3 shadow-lg hover:bg-white transition-colors z-10">
                                            <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                            </svg>
                                        </button>
                                        
                                        <button @click="nextPhoto()" 
                                                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/80 backdrop-blur-sm rounded-full p-3 shadow-lg hover:bg-white transition-colors z-10">
                                            <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </button>
                                        
                                        {{-- Image Info --}}
                                        <div class="absolute bottom-0 left-0 right-0 w-full p-8 px-20 bg-gradient-to-t from-black/80 via-black/40 to-transparent text-white">
                                            <h3 class="text-xl font-bold mb-2" x-text="selectedPhoto && selectedPhoto.caption ? selectedPhoto.caption : 'Foto galeri'"></h3>
                                            <p class="mb-2" x-text="selectedPhoto && selectedPhoto.description ? selectedPhoto.description : ''"></p>
                                            <p class="text-sm opacity-75 mb-4" x-text="selectedPhoto && selectedPhoto.date ? selectedPhoto.date : ''"></p>
                                        </div>
                                    </div>

                                    {{-- Thumbnails Navigation --}}
                                    <div class="hidden md:flex w-[200px] h-full flex-col gap-4 space-x-2 bg-white/70 backdrop-blur-lg p-4 shadow-lg max-w-md overflow-y-auto scroll-smooth" x-ref="thumbnailContainer">
                                        <template x-for="(photo, index) in photos" :key="index">
                                            <button @click="goToPhoto(index)" 
                                                    :class="currentIndex === index ? 'ring-2 ring-[#128AEB] opacity-100' : 'opacity-60 hover:opacity-100'"
                                                    class="flex-shrink-0 w-[90%] aspect-square rounded-lg overflow-hidden transition-all duration-200"
                                                    :x-ref="'thumbnail_' + index">
                                                <img :src="photo && photo.thumbnail ? photo.thumbnail : '/images/default-gallery.jpg'" 
                                                    :alt="photo && photo.caption ? photo.caption : 'Foto galeri'" 
                                                    class="w-full h-full object-cover">
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </section>
                    ` : ''}

                    {{-- Contact Section --}}
                    <section class="py-24 bg-gradient-to-r from-[#128AEB] to-[#0F76C6] hidden" x-data="contactSection">
                        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="text-center text-white mb-16">
                                <h2 class="text-4xl md:text-5xl font-bold mb-6">Mari Terhubung</h2>
                                <p class="text-xl text-white/90 max-w-2xl mx-auto">
                                    Ingin berdiskusi tentang teknologi, bisnis, atau kolaborasi? Jangan ragu untuk menghubungi saya
                                </p>
                            </div>

                            <div class="grid md:grid-cols-2 gap-12">
                                {{-- Contact Info --}}
                                <div class="space-y-8">
                                    <h3 class="text-2xl font-semibold text-white mb-6">Informasi Kontak</h3>
                                    
                                    {{-- Email --}}
                                    <div class="flex items-center space-x-4 group">
                                        <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3 group-hover:bg-white/30 transition-colors">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-white/80 text-sm">Email</p>
                                            <a href="mailto:${member && member.email ? member.email : 'contact@centrova.com'}" class="text-white font-semibold hover:text-white/80 transition-colors">
                                                ${member && member.email ? member.email : 'contact@centrova.com'}
                                            </a>
                                        </div>
                                    </div>

                                    {{-- Phone --}}
                                    ${member && member.phone ? `
                                        <div class="flex items-center space-x-4 group">
                                            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3 group-hover:bg-white/30 transition-colors">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-white/80 text-sm">WhatsApp</p>
                                                <a href="${member.whatsapp || '#'}" class="text-white font-semibold hover:text-white/80 transition-colors">
                                                    ${member.phone}
                                                </a>
                                            </div>
                                        </div>
                                    ` : ''}

                                    {{-- LinkedIn --}}
                                    ${member && member.linkedin ? `
                                        <div class="flex items-center space-x-4 group">
                                            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3 group-hover:bg-white/30 transition-colors">
                                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-white/80 text-sm">LinkedIn</p>
                                                <a href="${member.linkedin}" class="text-white font-semibold hover:text-white/80 transition-colors">
                                                    LinkedIn Profile
                                                </a>
                                            </div>
                                        </div>
                                    ` : ''}
                                </div>

                                {{-- Quick Contact Form --}}
                                <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20">
                                    <h3 class="text-2xl font-semibold text-white mb-6">Kirim Pesan Cepat</h3>
                                    
                                    <form @submit.prevent="submitForm()" class="space-y-6">
                                        <div>
                                            <label class="block text-white/90 text-sm font-medium mb-2">Nama</label>
                                            <input type="text" 
                                                x-model="form.name"
                                                class="w-full px-4 py-3 bg-white/20 border border-white/30 rounded-xl text-white placeholder-white/60 focus:border-white focus:outline-none focus:ring-2 focus:ring-white/20 transition-all duration-300"
                                                placeholder="Nama Anda">
                                        </div>
                                        
                                        <div>
                                            <label class="block text-white/90 text-sm font-medium mb-2">Email</label>
                                            <input type="email" 
                                                x-model="form.email"
                                                class="w-full px-4 py-3 bg-white/20 border border-white/30 rounded-xl text-white placeholder-white/60 focus:border-white focus:outline-none focus:ring-2 focus:ring-white/20 transition-all duration-300"
                                                placeholder="email@example.com">
                                        </div>
                                        
                                        <div>
                                            <label class="block text-white/90 text-sm font-medium mb-2">Pesan</label>
                                            <textarea x-model="form.message"
                                                    rows="4"
                                                    class="w-full px-4 py-3 bg-white/20 border border-white/30 rounded-xl text-white placeholder-white/60 focus:border-white focus:outline-none focus:ring-2 focus:ring-white/20 transition-all duration-300 resize-none"
                                                    placeholder="Tulis pesan Anda di sini..."></textarea>
                                        </div>
                                        
                                        <button type="submit" 
                                                :disabled="isSubmitting"
                                                :class="isSubmitting ? 'opacity-50 cursor-not-allowed' : 'hover:bg-white hover:text-[#128AEB] transform hover:scale-105'"
                                                class="w-full bg-white/20 backdrop-blur-sm border-2 border-white text-white font-semibold px-8 py-4 rounded-xl transition-all duration-300">
                                            <span x-show="!isSubmitting">Kirim Pesan</span>
                                            <span x-show="isSubmitting" class="flex items-center justify-center">
                                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                                Mengirim...
                                            </span>
                                        </button>
                                    </form>

                                    {{-- Success Message --}}
                                    <div x-show="showSuccess" 
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 transform scale-95"
                                        x-transition:enter-end="opacity-100 transform scale-100"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0"
                                        class="mt-4 p-4 bg-green-500/20 border border-green-500/30 rounded-xl">
                                        <p class="text-white text-center">✅ Pesan berhasil dikirim! Terima kasih.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                `;
                
                // Initialize Alpine.js components
                initializeAlpineComponents();
            }

            function hideLoadingState() {
                document.getElementById('loading-state').style.display = 'none';
                document.getElementById('profile-content').style.display = 'block';
            }

            function showErrorState() {
                document.getElementById('loading-state').style.display = 'none';
                document.getElementById('error-state').style.display = 'block';
            }

            function updatePageTitle(member) {
                if (member && member.name) {
                    document.title = `${member.name} - ${member.position || 'Tim Centrova'} | Centrova Indonesia`;
                    
                    // Update meta description
                    const description = member.bio && member.bio.intro ? 
                        member.bio.intro.substring(0, 160) + '...' : 
                        `Profil ${member.name}, ${member.position || 'anggota tim'} Centrova Indonesia. Pelajari kontribusi dalam pengembangan solusi teknologi bisnis.`;
                    
                    updateMetaTag('name', 'description', description);
                    updateMetaTag('property', 'og:title', `${member.name} - ${member.position || 'Tim Centrova'}`);
                    updateMetaTag('property', 'og:description', description);
                    updateMetaTag('property', 'twitter:title', `${member.name} - ${member.position || 'Tim Centrova'}`);
                    updateMetaTag('property', 'twitter:description', description);
                    
                    // Update keywords
                    const keywords = `${member.name}, ${member.position || ''}, tim centrova, teknologi indonesia, ${member.skills ? Object.keys(member.skills).join(', ') : ''}`.toLowerCase();
                    updateMetaTag('name', 'keywords', keywords);
                    
                    // Update structured data
                    updateStructuredData(member);
                }
            }

            function updateMetaTag(attribute, name, content) {
                let meta = document.querySelector(`meta[${attribute}="${name}"]`);
                if (meta) {
                    meta.setAttribute('content', content);
                } else {
                    meta = document.createElement('meta');
                    meta.setAttribute(attribute, name);
                    meta.setAttribute('content', content);
                    document.head.appendChild(meta);
                }
            }

            function updateStructuredData(member) {
                const script = document.getElementById('person-schema');
                if (script && member) {
                    const structuredData = {
                        "@context": "https://schema.org",
                        "@type": "Person",
                        "name": member.name || 'Tim Member',
                        "jobTitle": member.position || 'Team Member',
                        "worksFor": {
                            "@type": "Organization",
                            "name": "Centrova Indonesia",
                            "url": window.location.origin
                        },
                        "url": window.location.href,
                        "image": member.heroImage || '/images/default-profile.jpg',
                        "description": member.bio && member.bio.intro ? member.bio.intro : `${member.name} adalah anggota tim Centrova Indonesia`,
                        "email": member.email || 'centrova@gmail.com',
                        "knowsAbout": getKnowsAbout(member),
                        "memberOf": {
                            "@type": "Organization",
                            "name": "Centrova Indonesia"
                        }
                    };
                    
                    // Add additional properties if available
                    if (member.linkedin) {
                        structuredData.sameAs = [member.linkedin];
                    }
                    
                    if (member.skills) {
                        structuredData.hasSkill = getSkillsArray(member.skills);
                    }
                    
                    script.textContent = JSON.stringify(structuredData, null, 2);
                }
            }

            function getKnowsAbout(member) {
                const knowsAbout = ["Technology", "Software Development", "Business Solutions"];
                
                if (member.skills) {
                    if (member.skills.technical) {
                        member.skills.technical.forEach(skill => {
                            if (skill.name) knowsAbout.push(skill.name);
                        });
                    }
                    if (member.skills.leadership) {
                        member.skills.leadership.forEach(skill => {
                            if (skill.name) knowsAbout.push(skill.name);
                        });
                    }
                }
                
                return [...new Set(knowsAbout)]; // Remove duplicates
            }

            function getSkillsArray(skills) {
                const skillsArray = [];
                
                if (skills.technical) {
                    skills.technical.forEach(skill => {
                        if (skill.name) {
                            skillsArray.push({
                                "@type": "DefinedTerm",
                                "name": skill.name,
                                "description": `Technical skill with proficiency level ${skill.level || 'intermediate'}`
                            });
                        }
                    });
                }
                
                if (skills.leadership) {
                    skills.leadership.forEach(skill => {
                        if (skill.name) {
                            skillsArray.push({
                                "@type": "DefinedTerm",
                                "name": skill.name,
                                "description": `Leadership skill with proficiency level ${skill.level || 'intermediate'}`
                            });
                        }
                    });
                }
                
                return skillsArray;
            }

            function getBioColumnClass(bio) {
                // Calculate total text length with null checks
                const introLength = (bio && bio.intro) ? bio.intro.length : 0;
                const contentLength = (bio && bio.content && Array.isArray(bio.content)) ? bio.content.join(' ').length : 0;
                const totalLength = introLength + contentLength;
                
                // If content is long enough (more than 1000 characters), use 2 columns on desktop
                if (totalLength > 1000) {
                    return 'md:columns-2 md:gap-8 md:column-fill-balance';
                }
                
                return '';
            }

            function getHighlightIcon(iconType) {
                const icons = {
                    innovation: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />',
                    people: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />',
                    security: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />',
                    code: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />',
                    team: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a4 4 0 11-8 0 4 4 0 018 0z" />'
                };
                return `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">${icons[iconType] || icons.innovation}</svg>`;
            }

            function initializeAlpineComponents() {
                // Re-initialize Alpine components for the dynamically added content
                if (window.Alpine) {
                    window.Alpine.initTree(document.getElementById('profile-content'));
                }
            }

            // Alpine.js components (similar to existing ones)
            document.addEventListener('alpine:init', () => {
                Alpine.data('gallerySection', () => ({
                    showModal: false,
                    currentIndex: 0,
                    selectedPhoto: null,
                    photos: [],
                    initGallery() {
                        const galleryData = window.currentMemberGallery || [];
                        this.photos = Array.isArray(galleryData) ? galleryData : [];
                    },
                    openPhotoModal(index) {
                        this.currentIndex = index;
                        this.selectedPhoto = this.photos[index];
                        this.showModal = true;
                        document.body.style.overflow = 'hidden';
                        this.scrollToActiveThumbnail();
                    },
                    closeModal() {
                        this.showModal = false;
                        this.selectedPhoto = null;
                        document.body.style.overflow = 'auto';
                    },
                    nextPhoto() {
                        this.currentIndex = (this.currentIndex + 1) % this.photos.length;
                        this.selectedPhoto = this.photos[this.currentIndex];
                        this.scrollToActiveThumbnail();
                    },
                    prevPhoto() {
                        this.currentIndex = this.currentIndex === 0 ? this.photos.length - 1 : this.currentIndex - 1;
                        this.selectedPhoto = this.photos[this.currentIndex];
                        this.scrollToActiveThumbnail();
                    },
                    goToPhoto(index) {
                        this.currentIndex = index;
                        this.selectedPhoto = this.photos[index];
                        this.scrollToActiveThumbnail();
                    },
                    scrollToActiveThumbnail() {
                        this.$nextTick(() => {
                            const thumbnailContainer = this.$refs.thumbnailContainer;
                            const activeThumbnail = this.$refs['thumbnail_' + this.currentIndex];
                            
                            if (thumbnailContainer && activeThumbnail) {
                                const containerRect = thumbnailContainer.getBoundingClientRect();
                                const thumbnailRect = activeThumbnail.getBoundingClientRect();
                                
                                const isVisible = thumbnailRect.top >= containerRect.top && 
                                                thumbnailRect.bottom <= containerRect.bottom;
                                
                                if (!isVisible) {
                                    const scrollTop = activeThumbnail.offsetTop - thumbnailContainer.offsetTop - 
                                                    (thumbnailContainer.clientHeight / 2) + (activeThumbnail.offsetHeight / 2);
                                    
                                    thumbnailContainer.scrollTo({
                                        top: scrollTop,
                                        behavior: 'smooth'
                                    });
                                }
                            }
                        });
                    },
                    init() {
                        this.showModal = false;
                        this.selectedPhoto = null;
                        this.currentIndex = 0;
                        this.photos = [];
                    }
                }));

                Alpine.data('contactSection', () => ({
                    form: {
                        name: '',
                        email: '',
                        message: ''
                    },
                    isSubmitting: false,
                    showSuccess: false,
                    async submitForm() {
                        if (!this.form.name || !this.form.email || !this.form.message) {
                            alert('Mohon lengkapi semua field');
                            return;
                        }

                        this.isSubmitting = true;
                        
                        // Simulate API call
                        try {
                            await new Promise(resolve => setTimeout(resolve, 2000));
                            
                            // Reset form
                            this.form = { name: '', email: '', message: '' };
                            this.showSuccess = true;
                            
                            // Hide success message after 5 seconds
                            setTimeout(() => {
                                this.showSuccess = false;
                            }, 5000);
                            
                        } catch (error) {
                            alert('Terjadi kesalahan. Silakan coba lagi.');
                        } finally {
                            this.isSubmitting = false;
                        }
                    },
                    init() {
                        this.isSubmitting = false;
                        this.showSuccess = false;
                    }
                }));
            });
        </script>
    @endpush
@endsection
