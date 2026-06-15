@extends('partials.layouts.main')

@section('title', 'AI Strategy untuk Bisnis - Roadmap Adopsi AI yang Terukur | Centrova')

@section('seoMetaTags')
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta name="robots" content="index, follow, max-image-preview:large"/>
    <meta name="description" content="Layanan AI Strategy dari Centrova membantu bisnis menyusun roadmap adopsi AI yang realistis, aman, dan berdampak langsung pada efisiensi operasional dan pertumbuhan."/>
    <meta property="og:title" content="AI Strategy untuk Bisnis | Centrova"/>
    <meta property="og:description" content="Audit kesiapan AI, prioritas use case, desain roadmap implementasi, dan governance untuk adopsi AI yang terukur."/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="https://centrova.id/services/ai/ai-strategy"/>
    <meta property="og:site_name" content="Centrova"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <link rel="canonical" href="https://centrova.id/services/ai/ai-strategy"/>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "FAQPage",
            "mainEntity": [
                {
                    "@type": "Question",
                    "name": "Apa itu AI Strategy dan mengapa perusahaan membutuhkannya?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "AI Strategy adalah kerangka kerja untuk memilih, merencanakan, dan mengimplementasikan solusi AI yang selaras dengan tujuan bisnis sehingga investasi memberikan dampak terukur."
                    }
                },
                {
                    "@type": "Question",
                    "name": "Berapa lama proses penyusunan roadmap AI biasanya?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Tergantung skala organisasi dan ketersediaan data; umumnya kami mulai dengan assessment 2–4 minggu, lalu roadmap 4–8 minggu untuk deliverable awal."
                    }
                },
                {
                    "@type": "Question",
                    "name": "Apakah Centrova menyediakan implementasi teknis setelah strategi disetujui?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Ya — selain menyusun strategi, Centrova dapat membantu prototyping, integrasi, dan pendampingan adopsi teknologi sesuai roadmap."
                    }
                }
            ]
        }
    </script>

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "LocalBusiness",
            "name": "Centrova",
            "url": "https://centrova.id",
            "logo": "https://centrova.id/assets/image/logo.png",
            "telephone": "+62895397633012",
            "email": "adm.centrova@gmail.com",
            "address": {
                "@type": "PostalAddress",
                "addressLocality": "Jakarta",
                "addressRegion": "DKI Jakarta",
                "addressCountry": "ID"
            },
            "geo": {
                "@type": "GeoCoordinates",
                "latitude": -6.200000,
                "longitude": 106.816666
            },
            "sameAs": [
                "https://www.linkedin.com/company/centrova",
                "https://www.instagram.com/centrova"
            ]
        }
    </script>
@endsection

@section('content')
{{-- Split Hero Section --}}
<section class="relative overflow-hidden border-b border-gray-200">
    <div class="max-w-7xl px-8 mx-auto flex items-center max-lg:flex-col-reverse py-10">
        <div class="w-full flex flex-col justify-center">
            <h1 class="text-4xl md:text-7xl font-semibold tracking-tighter mb-8 text-neutral-900">Strategi AI & Transformasi</h1>
            <p class="text-lg w-full max-w-2xl text-neutral-950 tracking-tight mb-8">
                AI Strategy adalah pondasi sebelum perusahaan Anda mengimplementasikan teknologi AI. Ini bukan soal mengikuti tren, tetapi memastikan AI dipakai di area yang benar untuk mendorong efisiensi, pertumbuhan, dan hasil yang terukur.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <button class="py-4 px-6 rounded-full bg-primary-500 hover:bg-primary-600 transition text-white font-medium">
                    Hubungi Tim Kami
                </button>
            </div>
        </div>

        <div class="w-full">
            <img src="{{ asset('assets/image/2g30b8u24fg.webp') }}" alt="AI Strategy & Transformation" class="w-full max-md:h-56 object-contain">
        </div>
    </div>
</section>

{{-- Content Sections Wrapper --}}
<div class="bg-gray-100">
    {{-- Apa Itu AI Strategy --}}
    <section class="py-20 md:py-24 border-b border-neutral-200 bg-white">
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <div class="lg:col-span-5 lg:sticky lg:top-32">
                <h2 class="text-4xl max-w-4xl mx-auto font-semibold tracking-tighter text-neutral-900 mb-4">Apa Itu AI Strategy?</h2>
                <p class="text-lg text-neutral-700 font-normal leading-relaxed">Membangun roadmap yang jelas untuk transformasi digital yang terukur dan berdampak.</p>
            </div>
            <div class="lg:col-span-7">
                <p class="text-lg text-neutral-900 tracking-tight leading-relaxed mb-8">
                    AI Strategy adalah pondasi sebelum perusahaan Anda mengimplementasikan teknologi AI. Ini bukan tentang memilih tool AI terbaik, melainkan proses metodis untuk:
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-primary-500 mt-0.5">check</span>
                        <p class="text-neutral-900 font-medium">Memahami kebutuhan spesifik bisnis Anda</p>
                    </div>
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-primary-500 mt-0.5">check</span>
                        <p class="text-neutral-900 font-medium">Menilai kesiapan infrastruktur dan data yang ada</p>
                    </div>
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-primary-500 mt-0.5">check</span>
                        <p class="text-neutral-900 font-medium">Mengidentifikasi area operasional mana yang akan memberikan ROI (Return on Investment) tertinggi jika diotomatisasi dengan AI</p>
                    </div>
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-primary-500 mt-0.5">check</span>
                        <p class="text-neutral-900 font-medium">Memastikan AI terintegrasi secara mulus dengan proses yang sudah berjalan tanpa mengganggu stabilitas operasional.</p>
                    </div>
                </div>
                <div class="mt-8 p-6 bg-gray-500/5 rounded-2xl">
                    <p class="text-neutral-900 font-semibold">Intinya: Memastikan AI bukan sekadar "trend", melainkan solusi yang tepat untuk mencapai tujuan bisnis Anda.</p>
                </div>
            </div>
        </div>
    </section>
    {{-- Mengapa AI Strategy Penting (Grid) --}}
    <section class="py-20 md:py-24 border-b border-neutral-200 bg-white">
        <div class="max-w-7xl mx-auto px-8">
            <div class="mb-12 text-center lg:text-left">
                <h2 class="text-4xl max-w-4xl mx-auto font-semibold tracking-tighter text-neutral-900 mb-4 text-center">Mengapa AI Strategy Penting?</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 w-full max-w-6xl mx-auto gap-6">
                <div class="p-6 flex flex-col items-center text-center">
                    <span class="material-symbols-outlined bg-gradient-to-br from-primary-500 to-blue-700 bg-clip-text text-transparent text-6xl mb-4">auto_awesome</span>
                    <h3 class="font-semibold tracking-tight text-neutral-900 text-2xl mb-3">Mengidentifikasi peluang otomatisasi</h3>
                    <p class="text-neutral-700 text-lg">Menganalisis proses bisnis untuk menemukan aktivitas yang berulang, memakan waktu, atau rentan terhadap kesalahan manusia sehingga dapat diotomatisasi menggunakan teknologi AI dan workflow automation.</p>
                </div>
                <div class="p-6 flex flex-col items-center text-center">
                    <span class="material-symbols-outlined bg-gradient-to-br from-primary-500 to-blue-700 bg-clip-text text-transparent text-6xl mb-4">precision_manufacturing</span>
                    <h3 class="font-semibold tracking-tight text-neutral-900 text-2xl mb-3">Mengurangi pekerjaan manual</h3>
                    <p class="text-neutral-700 text-lg">Menghilangkan tugas-tugas administratif yang repetitif seperti input data, pengelolaan dokumen, dan pelaporan rutin agar tim dapat fokus pada pekerjaan yang memberikan nilai lebih besar bagi bisnis.</p>
                </div>
                <div class="p-6 flex flex-col items-center text-center">
                    <span class="material-symbols-outlined bg-gradient-to-br from-primary-500 to-blue-700 bg-clip-text text-transparent text-6xl mb-4">trending_up</span>
                    <h3 class="font-semibold tracking-tight text-neutral-900 text-2xl mb-3">Meningkatkan produktivitas tim</h3>
                    <p class="text-neutral-700 text-lg">Membantu karyawan menyelesaikan pekerjaan lebih cepat melalui otomatisasi, akses informasi yang lebih mudah, dan penggunaan AI sebagai asisten kerja yang mendukung aktivitas sehari-hari.</p>
                </div>
                <div class="p-6 flex flex-col items-center text-center">
                    <span class="material-symbols-outlined bg-gradient-to-br from-primary-500 to-blue-700 bg-clip-text text-transparent text-6xl mb-4">database</span>
                    <h3 class="font-semibold tracking-tight text-neutral-900 text-2xl mb-3">Memanfaatkan data secara lebih efektif</h3>
                    <p class="text-neutral-700 text-lg">Mengubah data yang tersebar menjadi informasi yang terstruktur dan mudah dianalisis sehingga perusahaan dapat memahami kondisi bisnis dengan lebih baik dan mengambil tindakan yang lebih tepat.</p>
                </div>
                <div class="p-6 flex flex-col items-center text-center">
                    <span class="material-symbols-outlined bg-gradient-to-br from-primary-500 to-blue-700 bg-clip-text text-transparent text-6xl mb-4">speed</span>
                    <h3 class="font-semibold tracking-tight text-neutral-900 text-2xl mb-3">Mempercepat pengambilan keputusan</h3>
                    <p class="text-neutral-700 text-lg">Memberikan insight, analisis, dan laporan secara real-time untuk membantu manajemen membuat keputusan yang lebih cepat, akurat, dan berdasarkan data.</p>
                </div>
                <div class="p-6 flex flex-col items-center text-center">
                    <span class="material-symbols-outlined bg-gradient-to-br from-primary-500 to-blue-700 bg-clip-text text-transparent text-6xl mb-4">support_agent</span>
                    <h3 class="font-semibold tracking-tight text-neutral-900 text-2xl mb-3">Meningkatkan pengalaman pelanggan</h3>
                    <p class="text-neutral-700 text-lg">Menghadirkan layanan yang lebih responsif, personal, dan konsisten melalui pemanfaatan AI seperti chatbot, customer support automation, dan sistem rekomendasi yang relevan.</p>
                </div>
            </div>
        </div>
    </section>
    {{-- Di Mana AI Bisa Diterapkan --}}
    <section class="py-20 md:py-24 border-b border-neutral-200 bg-white">
        <div class="relative z-10">
            <div class="mb-12 max-w-7xl mx-auto px-8">
                <h2 class="text-4xl max-w-4xl mx-auto font-semibold tracking-tighter text-neutral-900 mb-4 text-center">Di Mana AI Bisa Diterapkan?</h2>
            </div>
            
            <div id="carousel-container" class="flex overflow-x-auto gap-6 snap-x snap-mandatory scroll-smooth no-scrollbar md:grid md:grid-cols-2 lg:grid-cols-3 max-md:cursor-grab max-md:active:cursor-grabbing pb-4 max-w-7xl mx-auto px-8">
                
                <div class="min-w-[85%] sm:min-w-[50%] md:min-w-full snap-center rounded-md border border-neutral-200 bg-white p-8 hover:shadow-md hover:shadow-black/35 transition-shadow duration-150">
                    <div class="text-primary-500 mb-4"><span class="material-symbols-outlined text-5xl">headset_mic</span></div>
                    <h3 class="text-xl font-semibold text-neutral-900 mb-3 tracking-tight">Layanan Pelanggan</h3>
                    <p class="text-neutral-700 text-base tracking-tight">Chatbot cerdas, analisis sentimen pelanggan, otomatisasi tiket bantuan.</p>
                </div>
                
                <div class="min-w-[85%] sm:min-w-[50%] md:min-w-full snap-center rounded-md border border-neutral-200 bg-white p-8 hover:shadow-md hover:shadow-black/35 transition-shadow duration-150">
                    <div class="text-primary-500 mb-4"><span class="material-symbols-outlined text-5xl">campaign</span></div>
                    <h3 class="text-xl font-semibold text-neutral-900 mb-3 tracking-tight">Penjualan &amp; Pemasaran</h3>
                    <p class="text-neutral-700 text-base tracking-tight">Personalisasi kampanye, prediksi konversi lead, pembuatan konten otomatis.</p>
                </div>
                
                <div class="min-w-[85%] sm:min-w-[50%] md:min-w-full snap-center rounded-md border border-neutral-200 bg-white p-8 hover:shadow-md hover:shadow-black/35 transition-shadow duration-150">
                    <div class="text-primary-500 mb-4"><span class="material-symbols-outlined text-5xl">settings_applications</span></div>
                    <h3 class="text-xl font-semibold text-neutral-900 mb-3 tracking-tight">Operasional</h3>
                    <p class="text-neutral-700 text-base tracking-tight">Optimasi rantai pasok, pemeliharaan prediktif, otomatisasi proses rutin.</p>
                </div>
                
                <div class="min-w-[85%] sm:min-w-[50%] md:min-w-full snap-center rounded-md border border-neutral-200 bg-white p-8 hover:shadow-md hover:shadow-black/35 transition-shadow duration-150">
                    <div class="text-primary-500 mb-4"><span class="material-symbols-outlined text-5xl">groups</span></div>
                    <h3 class="text-xl font-semibold text-neutral-900 mb-3 tracking-tight">Sumber Daya Manusia</h3>
                    <p class="text-neutral-700 text-base tracking-tight">Penyaringan resume otomatis, prediksi retensi karyawan, asisten onboarding.</p>
                </div>
                
                <div class="min-w-[85%] sm:min-w-[50%] md:min-w-full snap-center rounded-md border border-neutral-200 bg-white p-8 hover:shadow-md hover:shadow-black/35 transition-shadow duration-150">
                    <div class="text-primary-500 mb-4"><span class="material-symbols-outlined text-5xl">account_balance</span></div>
                    <h3 class="text-xl font-semibold text-neutral-900 mb-3 tracking-tight">Keuangan</h3>
                    <p class="text-neutral-700 text-base tracking-tight">Deteksi penipuan, otomatisasi penagihan, prediksi arus kas.</p>
                </div>
                
                <div class="min-w-[85%] sm:min-w-[50%] md:min-w-full snap-center rounded-md border border-neutral-200 bg-white p-8 hover:shadow-md hover:shadow-black/35 transition-shadow duration-150">
                    <div class="text-primary-500 mb-4"><span class="material-symbols-outlined text-5xl">analytics</span></div>
                    <h3 class="text-xl font-semibold text-neutral-900 mb-3 tracking-tight">Data &amp; Analitik</h3>
                    <p class="text-neutral-700 text-base tracking-tight">Pengenalan pola data kompleks, pelaporan otomatis, wawasan prediktif.</p>
                </div>
                
            </div>

            <div id="carousel-dots" class="flex justify-center gap-5 mt-6 md:hidden">
                <button class="w-2 h-2 rounded-full bg-neutral-900 transition-colors duration-150" aria-label="Go to slide 1"></button>
                <button class="w-2 h-2 rounded-full bg-neutral-300 transition-colors duration-150" aria-label="Go to slide 2"></button>
                <button class="w-2 h-2 rounded-full bg-neutral-300 transition-colors duration-150" aria-label="Go to slide 3"></button>
                <button class="w-2 h-2 rounded-full bg-neutral-300 transition-colors duration-150" aria-label="Go to slide 4"></button>
                <button class="w-2 h-2 rounded-full bg-neutral-300 transition-colors duration-150" aria-label="Go to slide 5"></button>
                <button class="w-2 h-2 rounded-full bg-neutral-300 transition-colors duration-150" aria-label="Go to slide 6"></button>
            </div>
        </div>

        <style>
            .no-scrollbar::-webkit-scrollbar {
                display: none;
            }
            .no-scrollbar {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        </style>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const slider = document.getElementById("carousel-container");
                const dots = document.querySelectorAll("#carousel-dots button");
                let isDown = false;
                let startX;
                let scrollLeft;

                // 1. Fitur Drag to Scroll dengan Mouse
                slider.addEventListener("mousedown", (e) => {
                    isDown = true;
                    slider.classList.remove("scroll-smooth"); // Matikan smooth scroll saat drag agar responsif
                    startX = e.pageX - slider.offsetLeft;
                    scrollLeft = slider.scrollLeft;
                });

                slider.addEventListener("mouseleave", () => {
                    isDown = false;
                });

                slider.addEventListener("mouseup", () => {
                    isDown = true; 
                    setTimeout(() => { isDown = false; }, 50); // Mencegah trigger click tidak sengaja
                    slider.classList.add("scroll-smooth");
                });

                slider.addEventListener("mousemove", (e) => {
                    if (!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - slider.offsetLeft;
                    const walk = (x - startX) * 1.5; // Angka 1.5 menentukan sensitivitas tarikan
                    slider.scrollLeft = scrollLeft - walk;
                });

                // 2. Sinkronisasi Aktif Dot Berdasarkan Scroll Posisi
                const updateDots = () => {
                    const children = slider.children;
                    const containerWidth = slider.clientWidth;
                    const scrollLeftPos = slider.scrollLeft;
                    
                    for (let i = 0; i < children.length; i++) {
                        const child = children[i];
                        // Hitung posisi tengah tiap card relatif terhadap container
                        const childCenter = child.offsetLeft - slider.offsetLeft + (child.clientWidth / 2);
                        const viewLeft = scrollLeftPos;
                        const viewRight = scrollLeftPos + containerWidth;

                        if (childCenter >= viewLeft && childCenter <= viewRight) {
                            dots.forEach((dot, index) => {
                                if (index === i) {
                                    dot.classList.remove("bg-neutral-300");
                                    dot.classList.add("bg-neutral-900");
                                } else {
                                    dot.classList.remove("bg-neutral-900");
                                    dot.classList.add("bg-neutral-300");
                                }
                            });
                            break;
                        }
                    }
                };

                slider.addEventListener("scroll", updateDots);

                // 3. Navigasi Klik pada Dot
                dots.forEach((dot, index) => {
                    dot.addEventListener("click", () => {
                        slider.classList.add("scroll-smooth");
                        const targetCard = slider.children[index];
                        const offset = targetCard.offsetLeft - slider.offsetLeft - (slider.clientWidth - targetCard.clientWidth) / 2;
                        slider.scrollTo({
                            left: offset,
                            behavior: "smooth"
                        });
                    });
                });
            });
        </script>
    </section>
    {{-- When Should a Company Start & Process --}}
    <section class="py-20 md:py-24 border-b border-neutral-200 bg-white">
        <div class="mb-14 px-8">
            <h2 class="text-4xl max-w-4xl mx-auto font-semibold tracking-tighter text-neutral-900 mb-4 text-center">Bagaimana Kami Membangun Strategi AI?</h2>
            <p class="text-center w-full max-w-4xl mx-auto text-base text-neutral-800">Pendekatan strategis yang mengutamakan integrasi kebutuhan operasional dan tujuan bisnis, memastikan setiap implementasi teknologi kecerdasan buatan memberikan dampak nyata dan terukur.</p>
        </div>
        <div class="max-w-7xl mx-auto px-8">
            <img src="{{ asset('assets/image/w3yr9y283h872h8.png') }}" alt="" class="w-full">
        </div>
    </section>
    {{-- Closing CTA --}}
    <section class="py-20 bg-primary-500 text-white text-center">
        <div class="max-w-3xl mx-auto px-8">
            <h2 class="text-3xl md:text-4xl max-w-4xl mx-auto font-medium tracking-tighter mb-8 leading-tight">"AI bukan tentang menggantikan manusia, melainkan memperkuat kemampuan tim Anda untuk mencapai lebih banyak hal."</h2>
            <button class="py-4 px-6 rounded-full bg-white hover:bg-neutral-100 transition text-primary-600 font-semibold shadow-lg">
                Hubungi Tim Kami
            </button>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section id="faq" class="py-20 bg-white border-t border-neutral-200">
        <div class="max-w-7xl mx-auto px-8">
            <div class="max-w-3xl mx-auto text-center mb-12">
                <h2 class="text-4xl max-w-4xl mx-auto font-semibold tracking-tighter text-neutral-900 mb-4 text-center">Temukan jawaban yang Anda butuhkan</h2>
            </div>

            <div x-data="{ 
                openItems: [],
                totalItems: 3,
                toggleAll() {
                    if (this.openItems.length === this.totalItems) {
                        this.openItems = [];
                    } else {
                        this.openItems = [1, 2, 3];
                    }
                },
                isItemOpen(id) {
                    return this.openItems.includes(id);
                },
                toggleItem(id) {
                    if (this.isItemOpen(id)) {
                        this.openItems = this.openItems.filter(i => i !== id);
                    } else {
                        this.openItems.push(id);
                    }
                }
            }" class="max-w-3xl mx-auto font-sans">

                <div class="flex justify-end mb-6">
                    <button @click="toggleAll()" 
                            class="inline-flex items-center justify-center px-6 py-3 text-base hover:bg-primary-600/5 hover:text-primary-600 text-primary-500 font-medium rounded-full focus:outline-none focus:ring-2 focus:ring-primary-500"
                            :class="openItems.length === totalItems 
                                ? 'ring-primary-500' 
                                : 'ring-transparent'">
                        <span x-text="openItems.length === totalItems ? 'Ciutkan semua' : 'Luaskan semua'"></span>
                        
                        <svg class="w-4 h-4 ml-2 transition-transform duration-200" :class="openItems.length === totalItems ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>

                <div class="space-y-0 divide-y divide-gray-200 border-t border-b border-gray-200">
                    
                    <div class="py-4">
                        <button @click="toggleItem(1)" class="w-full text-left flex justify-between items-center py-4 group focus:outline-none">
                            <span class="text-lg md:text-xl font-normal text-neutral-800 font-semibold">
                                Apa itu AI Strategy dan mengapa perusahaan membutuhkannya?
                            </span>
                            <span class="ml-4 text-primary-500 transition-transform duration-300 transform flex-shrink-0" :class="isItemOpen(1) ? 'rotate-180' : ''">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div x-show="isItemOpen(1)" 
                             x-cloak 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             class="pt-2 pb-4 pr-12 text-base text-gray-600 leading-relaxed tracking-normal">
                            AI Strategy adalah kerangka kerja untuk memilih dan merencanakan solusi AI yang selaras dengan tujuan bisnis, sehingga investasi memberikan dampak terukur.
                        </div>
                    </div>

                    <div class="py-4">
                        <button @click="toggleItem(2)" class="w-full text-left flex justify-between items-center py-4 group focus:outline-none">
                            <span class="text-lg md:text-xl font-normal text-neutral-800 font-semibold">
                                Berapa lama proses assessment dan pembuatan roadmap?
                            </span>
                            <span class="ml-4 text-primary-500 transition-transform duration-300 transform flex-shrink-0" :class="isItemOpen(2) ? 'rotate-180' : ''">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div x-show="isItemOpen(2)" 
                             x-cloak 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             class="pt-2 pb-4 pr-12 text-base text-gray-600 leading-relaxed tracking-normal">
                            Durasi bergantung skala dan kompleksitas data; umumnya assessment 2–4 minggu, dengan roadmap awal 4–8 minggu.
                        </div>
                    </div>

                    <div class="py-4">
                        <button @click="toggleItem(3)" class="w-full text-left flex justify-between items-center py-4 group focus:outline-none">
                            <span class="text-lg md:text-xl font-normal text-neutral-800 font-semibold">
                                Apakah Centrova juga membantu implementasi teknis?
                            </span>
                            <span class="ml-4 text-primary-500 transition-transform duration-300 transform flex-shrink-0" :class="isItemOpen(3) ? 'rotate-180' : ''">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div x-show="isItemOpen(3)" 
                             x-cloak 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             class="pt-2 pb-4 pr-12 text-base text-gray-600 leading-relaxed tracking-normal">
                            Ya, kami menyediakan prototyping, integrasi, dan pendampingan implementasi sesuai roadmap yang disepakati.
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection