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
                    <div class="relative max-md:h-[250px] h-[560px] -mt-1 md:-mt-[60px] md:py-[60px] bg-white lg:bg-gradient-to-b from-neutral-100 to-neutral-50 overflow-hidden">
                        <div class="absolute inset-0"></div>
                        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center" data-aos="fade-up">
                            <div class="flex w-full h-full gap-8 items-center relative">
                                <div class="text-slate-800 max-lg:hidden">
                                    <h1 class="text-4xl md:text-5xl tracking-tight font-medium mb-4">${getName()}</h1>
                                    <p class="text-3xl md:text-2xl mb-4">${getPosition()}</p>
                                </div>
                                <div class="flex-1 w-full justify-center lg:justify-end h-full relative flex items-end pt-8">
                                    <img src="${getHeroImage()}" class="h-full object-cover bg-neutral-200 lg:aspect-[8/6] lg:rounded-3xl flex-shrink-0" alt="${getName()}" onerror="this.src='/images/default-profile.jpg'">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Bio Section --}}
                    <div class="pt-5 pb-12 lg:py-12 bg-white">
                        <div class="max-w-4xl gap-x-8 max-lg:gap-y-4 flex max-lg:flex-col mx-auto px-4 sm:px-8 lg:px-8 text-neutral-800 text-lg">
                            <div class="text-slate-700 lg:hidden">
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
