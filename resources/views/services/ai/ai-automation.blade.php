@extends('partials.layouts.main')

@section('title', 'AI Automation Agency Indonesia - Otomasi AI untuk Bisnis | Centrova')

@section('seoMetaTags')
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta name="robots" content="index, follow, max-image-preview:large"/>
    <meta name="description" content="Centrova — AI Automation Agency Indonesia. Kami mengaudit bisnismu, merampingkan operasional, dan membangun sistem otomasi AI yang menghilangkan pekerjaan manual serta melipatgandakan produktivitas tim."/>
    <meta name="keywords" content="AI Automation Agency Indonesia, otomasi AI bisnis, AI agency Jakarta, workflow automation, intelligent automation Indonesia, jasa AI untuk bisnis"/>
    <meta name="language" content="id"/>
    <meta name="geo.region" content="ID-JK"/>
    <meta name="geo.placename" content="Jakarta, Indonesia"/>
    <meta property="og:title" content="AI Automation Agency Indonesia - Otomasi AI untuk Bisnis | Centrova"/>
    <meta property="og:description" content="Centrova — AI Automation Agency Indonesia. Bangun sistem otomasi AI yang menghilangkan kerja manual dan melipatgandakan produktivitas tim."/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ url('/services/ai/automation') }}"/>
    <meta property="og:site_name" content="Centrova"/>
    <meta property="og:locale" content="id_ID"/>
    <meta property="og:image" content="{{ config('app.url') }}/thumbnail.png"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:title" content="AI Automation Agency Indonesia | Centrova"/>
    <meta name="twitter:description" content="Otomasi AI untuk bisnis yang ingin berkembang dengan profit lebih tinggi."/>
    <meta name="twitter:image" content="{{ config('app.url') }}/thumbnail.png"/>
    <link rel="canonical" href="{{ url('/services/ai/automation') }}"/>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Service",
        "name": "AI Automation",
        "description": "Layanan otomasi AI untuk bisnis: audit proses, workflow engineering, AI agents, dan integrasi sistem.",
        "provider": {
            "@type": "Organization",
            "name": "Centrova",
            "url": "{{ config('app.url') }}"
        },
        "areaServed": {
            "@type": "Country",
            "name": "Indonesia"
        },
        "serviceType": "AI Automation & Business Process Automation"
    }
    </script>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "Apa itu AI Automation Agency?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Partner yang merancang dan membangun sistem otomasi berbasis AI untuk bisnismu, dari audit proses, integrasi tools, hingga AI agent dan workflow otomatis, sehingga pekerjaan manual berkurang drastis dan tim bisa fokus ke pekerjaan bernilai tinggi."
                }
            },
            {
                "@type": "Question",
                "name": "Bisnis seperti apa yang cocok menggunakan AI automation?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Bisnis apa pun dengan proses manual berulang, dari UMKM hingga perusahaan besar. Industri seperti edukasi, kesehatan, jasa keuangan, ritel, logistik, dan produksi konten semua mendapat manfaat signifikan."
                }
            },
            {
                "@type": "Question",
                "name": "Berapa lama implementasinya?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Tergantung kompleksitas workflow dan kebutuhan integrasi. Otomasi sederhana bisa live dalam 1-2 minggu, sementara sistem enterprise mungkin butuh 4-8 minggu. Kami selalu mulai dengan audit menyeluruh."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah AI akan menggantikan tim saya?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Tidak. Tujuan kami adalah menghilangkan tugas repetitif agar tim Anda bisa fokus pada pekerjaan kreatif, strategis, dan bernilai tinggi. AI menangani pekerjaan rutin, manusia menangani pemikiran."
                }
            },
            {
                "@type": "Question",
                "name": "Tools dan teknologi apa yang digunakan?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Kami bekerja dengan OpenAI, Anthropic Claude, Google Gemini, n8n, Zapier, Make, serta pengembangan kustom Python/Node.js dan berbagai integrasi CRM/ERP yang disesuaikan dengan kebutuhan."
                }
            },
            {
                "@type": "Question",
                "name": "Berapa biaya sistem otomasi AI?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Biaya bervariasi tergantung kompleksitas, integrasi, dan kustomisasi. Kami memberikan harga transparan setelah audit awal. Sebagian besar klien melihat ROI dalam 2-4 bulan setelah implementasi."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah ada dukungan setelah implementasi?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Tentu. Kami menawarkan paket monitoring, maintenance, dan optimasi berkelanjutan untuk memastikan sistem otomasi Anda tetap stabil, efisien, dan terus memberikan nilai maksimal."
                }
            }
        ]
    }
    </script>
@endsection

@section('style-css')
<style>
    @keyframes marquee {
        from { transform: translateX(0); }
        to   { transform: translateX(-50%); }
    }
    .animate-marquee {
        animation: marquee 30s linear infinite;
    }
    .animate-marquee:hover {
        animation-play-state: paused;
    }
    .mask-edges {
        -webkit-mask: linear-gradient(to right, transparent 0%, black 5%, black 95%, transparent 100%);
                mask: linear-gradient(to right, transparent 0%, black 5%, black 95%, transparent 100%);
    }
</style>
@endsection

@section('content')

{{-- ============================ HERO ============================ --}}
<section class="relative overflow-hidden bg-white py-16 md:py-24" data-aos="fade-up" data-aos-duration="700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12 lg:gap-16 items-center">
            <div>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-neutral-900 mb-5">
                    Otomasi AI yang Mengubah Cara Bisnismu Bekerja, dan <span class="text-primary-600">Profitmu Bertumbuh</span>
                </h1>
                <p class="text-base md:text-lg text-neutral-600 mb-6">
                    Centrova hadir untuk mengaudit bisnismu secara menyeluruh, merampingkan setiap proses yang selama ini menghabiskan waktu, dan membangun sistem otomasi AI yang bekerja tanpa henti di belakang layar. Hasilnya, pekerjaan manual hilang, tim lebih produktif, dan bisnis siap berkembang lebih cepat dari sebelumnya.
                </p>
                <p class="text-sm text-neutral-500 mb-6">Dibangun dengan teknologi n8n dan AI Workflow engine terkini, dirancang khusus untuk kebutuhan bisnis di Indonesia.</p>
                {{-- Meta-style dual-CTA: primary (filled black) + secondary (outlined ghost) --}}
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('service.consult') }}" class="py-3.5 px-7 inline-flex items-center text-sm font-bold rounded-full bg-primary-600 text-white hover:bg-primary-700 transition">
                        Konsultasi Gratis
                    </a>
                    <a href="#solutions" class="py-3 px-7 inline-flex items-center text-sm font-bold rounded-full border-2 border-primary-600 text-primary-600 hover:bg-primary-50 transition">
                        Lihat Solusi Kami
                    </a>
                </div>
                <div class="flex flex-wrap gap-6 mt-8">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-rounded text-xl text-[#0F9D58]">corporate_fare</span>
                        <span class="text-sm text-neutral-600">50+ Bisnis telah dilayani</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-rounded text-xl text-[#4285F4]">monitoring</span>
                        <span class="text-sm text-neutral-600">Monitoring sistem 24/7</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-rounded text-xl text-[#FBBC04]">psychology</span>
                        <span class="text-sm text-neutral-600">n8n · AI Workflow engine</span>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <div class="relative w-full max-w-lg">
                    <div class="bg-gradient-to-br from-primary-600 to-blue-700 rounded-[32px] p-1">
                        <div class="bg-white rounded-[32px] p-5 space-y-3">
                            <div class="flex items-center gap-3 bg-primary-50 rounded-lg px-4 py-3 border border-primary-100">
                                <span class="material-symbols-outlined text-primary-600 text-xl">input</span>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-neutral-800">Lead masuk dari website</p>
                                    <p class="text-xs text-neutral-500">Form kontak terisi otomatis</p>
                                </div>
                                <span class="text-xs font-semibold bg-primary-600 text-white px-2.5 py-1 rounded-full">Trigger</span>
                            </div>
                            <div class="flex justify-center">
                                <span class="material-symbols-outlined text-primary-300">arrow_downward</span>
                            </div>
                            <div class="flex items-center gap-3 bg-violet-50 rounded-lg px-4 py-3 border border-violet-100">
                                <span class="material-symbols-outlined text-violet-600 text-xl">psychology</span>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-neutral-800">AI menganalisis kualitas lead</p>
                                    <p class="text-xs text-neutral-500">Scoring & intent detection</p>
                                </div>
                                <span class="text-xs font-semibold bg-violet-600 text-white px-2.5 py-1 rounded-full">AI</span>
                            </div>
                            <div class="flex justify-center">
                                <span class="material-symbols-outlined text-primary-300">arrow_downward</span>
                            </div>
                            <div class="flex items-center gap-3 bg-green-50 rounded-lg px-4 py-3 border border-green-100">
                                <span class="material-symbols-outlined text-green-600 text-xl">send</span>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-neutral-800">Follow-up terkirim otomatis</p>
                                    <p class="text-xs text-neutral-500">Email/SMS/WhatsApp</p>
                                </div>
                                <span class="text-xs font-semibold bg-green-600 text-white px-2.5 py-1 rounded-full">Action</span>
                            </div>
                            <div class="flex justify-center">
                                <span class="material-symbols-outlined text-primary-300">arrow_downward</span>
                            </div>
                            <div class="flex items-center gap-3 bg-amber-50 rounded-lg px-4 py-3 border border-amber-100">
                                <span class="material-symbols-outlined text-amber-600 text-xl">dashboard</span>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-neutral-800">Dashboard real-time</p>
                                    <p class="text-xs text-neutral-500">Update otomatis & notifikasi</p>
                                </div>
                                <span class="text-xs font-semibold bg-amber-600 text-white px-2.5 py-1 rounded-full">Live</span>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -top-2 -right-2 w-4 h-4 bg-green-400 rounded-full animate-ping"></div>
                    <div class="absolute -top-2 -right-2 w-4 h-4 bg-green-500 rounded-full"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="border-y border-neutral-200 py-8 overflow-hidden" data-aos="fade-up" data-aos-duration="700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-sm font-semibold text-neutral-500 text-center tracking-wider uppercase mb-8">Partner & Klien yang Bekerja Sama</p>
        <div class="flex overflow-hidden mask-edges">
            <div class="flex items-center gap-x-12 md:gap-x-16 animate-marquee">
                @foreach (array_merge(
                ['808', 'AICO', 'AP', 'AXE', 'BI', 'Emrah', 'Halma', 'Innova', 'Jagoan Hosting', 'RBC', 'Ruangguru', 'SGD', 'Strada', 'Sukses Mandiri', 'TAAT'],
                ['808', 'AICO', 'AP', 'AXE', 'BI', 'Emrah', 'Halma', 'Innova', 'Jagoan Hosting', 'RBC', 'Ruangguru', 'SGD', 'Strada', 'Sukses Mandiri', 'TAAT']
            ) as $name)
                <span class="text-xl md:text-2xl font-bold text-neutral-300 hover:text-neutral-400 transition-all duration-300 select-none">{{ $name }}</span>
            @endforeach
        </div>
    </div>
</section>

<section class="py-16 lg:py-24 bg-neutral-50" data-aos="fade-up" data-aos-duration="700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Meta-style card-product-feature with rounded-[32px] --}}
        <div class="bg-white rounded-[32px] border border-neutral-200 p-8 sm:p-12 lg:p-16">
            <div class="grid lg:grid-cols-3 gap-8 lg:gap-16">
                <div>
                    <h2 class="text-2xl font-bold text-neutral-900 lg:text-3xl">
                        Tentang Kami
                    </h2>
                </div>
                <div class="lg:col-span-2 space-y-5 text-neutral-600">
                    <p>
                        Centrova adalah agensi otomasi AI yang membangun sistem kerja pintar untuk bisnis yang ingin tumbuh cepat, terorganisir, dan siap berskala. Kami memadukan strategi bisnis, <em>workflow engineering</em>, dan kecerdasan buatan menjadi satu sistem otomatis yang benar-benar bekerja di dunia nyata, bukan sekadar demo yang berhenti di presentasi.
                    </p>
                    <p>
                        Kami membantu <em>founder</em>, <em>startup</em>, dan perusahaan menyingkirkan kerja manual, mempercepat eksekusi, dan mendorong profit lewat sistem yang terstruktur, terukur, dan bisa dipertanggungjawabkan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 lg:py-24 bg-white" data-aos="fade-up" data-aos-duration="700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="max-w-2xl mx-auto mb-12 text-center" data-aos="fade-up" data-aos-duration="700">
            <h2 class="text-2xl font-bold text-neutral-900 lg:text-3xl mb-4">
                Layanan
            </h2>
            <p class="text-neutral-600 text-base md:text-lg">
                Dari strategi hingga eksekusi, kami membantu bisnismu menerapkan AI dengan dampak yang terukur pada efisiensi, produktivitas, dan pertumbuhan.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="border border-neutral-200 rounded-[16px] p-6 hover:border-neutral-300 transition-all duration-200 flex flex-col bg-blue-50 sm:col-span-2 lg:col-span-2" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
                <div>
                    <h3 class="text-lg font-semibold text-neutral-900 mb-2">
                        Strategi dan Konsultasi Otomasi AI
                    </h3>
                    <p class="text-sm md:text-base text-neutral-600">
                        Kami memetakan seluruh operasional bisnismu, menentukan proses mana yang memberi dampak terbesar jika diotomasi, lalu menyusun <em>roadmap</em> implementasi yang jelas dan terukur.
                    </p>
                </div>
            </div>

            <div class="border border-neutral-200 rounded-[16px] p-6 hover:border-neutral-300 transition-all duration-200 flex flex-col bg-green-50" data-aos="fade-up" data-aos-duration="700" data-aos-delay="150">
                <span class="material-symbols-outlined text-3xl text-green-700 mb-4">settings_suggest</span>
                <div>
                    <h3 class="text-lg font-semibold text-neutral-900 mb-2">
                        Otomasi Proses Bisnis
                    </h3>
                    <p class="text-sm md:text-base text-neutral-600">
                        Pekerjaan manual yang berulang setiap hari kami jalankan secara otomatis di balik layar, sehingga timmu bisa fokus pada hal yang benar-benar penting.
                    </p>
                </div>
            </div>

            <div class="border border-neutral-200 rounded-[16px] p-6 hover:border-neutral-300 transition-all duration-200 flex flex-col bg-red-50" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
                <span class="material-symbols-outlined text-3xl text-red-600 mb-4">smart_toy</span>
                <div>
                    <h3 class="text-lg font-semibold text-neutral-900 mb-2">
                        AI Assistant dan Agent
                    </h3>
                    <p class="text-sm md:text-base text-neutral-600">
                        Asisten AI yang siap menangani pertanyaan pelanggan, memproses data, dan mendukung pengambilan keputusan tim, bekerja tanpa lelah selama 24 jam sehari.
                    </p>
                </div>
            </div>

            <div class="border border-neutral-200 rounded-[16px] p-6 hover:border-neutral-300 transition-all duration-200 flex flex-col bg-purple-50 sm:col-span-2 lg:col-span-2" data-aos="fade-up" data-aos-duration="700" data-aos-delay="250">
                <span class="material-symbols-outlined text-3xl text-purple-600 mb-4">hub</span>
                <div>
                    <h3 class="text-lg font-semibold text-neutral-900 mb-2">
                        Integrasi Sistem dan Data
                    </h3>
                    <p class="text-sm md:text-base text-neutral-600">
                        Kami menghubungkan seluruh <em>tool</em> dan sistem yang kamu pakai agar data mengalir otomatis dalam satu <em>pipeline</em> yang rapi, tanpa lagi <em>input</em> berulang atau data yang tercecer.
                    </p>
                </div>
            </div>

            <div class="border border-neutral-200 rounded-[16px] p-6 hover:border-neutral-300 transition-all duration-200 flex flex-col bg-cyan-50 sm:col-span-2 lg:col-span-2" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
                <span class="material-symbols-outlined text-3xl text-cyan-600 mb-4">auto_stories</span>
                <div>
                    <h3 class="text-lg font-semibold text-neutral-900 mb-2">
                        Pelatihan AI untuk Perusahaan
                    </h3>
                    <p class="text-sm md:text-base text-neutral-600">
                        <em>Workshop</em> dan <em>coaching</em> praktis yang membuat timmu percaya diri menggunakan AI dalam pekerjaan sehari-hari.
                    </p>
                </div>
            </div>

            <div class="border border-neutral-200 rounded-[16px] p-6 hover:border-neutral-300 transition-all duration-200 flex flex-col bg-yellow-50" data-aos="fade-up" data-aos-duration="700" data-aos-delay="350">
                <span class="material-symbols-outlined text-3xl text-yellow-700 mb-4">monitoring</span>
                <div>
                    <h3 class="text-lg font-semibold text-neutral-900 mb-2">
                        Monitoring dan Skalabilitas
                    </h3>
                    <p class="text-sm md:text-base text-neutral-600">
                        Setelah sistem <em>live</em>, kami terus memantau performanya agar tetap optimal seiring bisnismu bertumbuh.
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>

<section class="py-16 lg:py-24 bg-neutral-50" data-aos="fade-up" data-aos-duration="700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="max-w-2xl mx-auto mb-12 text-center" data-aos="fade-up" data-aos-duration="700">
            <h2 class="text-2xl font-bold text-neutral-900 lg:text-3xl mb-4">
                Cara Kerja
            </h2>
            <p class="text-neutral-600 text-base md:text-lg">
                Dari strategi hingga implementasi, kami membangun otomasi AI yang siap dipakai.
            </p>
        </div>

        <div x-data="{ activeTab: 1 }" class="grid md:grid-cols-12 gap-10 items-center">
            
            <div class="md:col-span-5 flex flex-col space-y-5">
                
                <div @click="activeTab = 1" 
                     class="border-s-2 ps-5 cursor-pointer transition-all duration-300 group"
                     :class="activeTab === 1 ? 'border-primary-600' : 'border-neutral-200 hover:border-neutral-400'">
                    <h3 class="text-base font-semibold transition-colors duration-300"
                        :class="activeTab === 1 ? 'text-neutral-900' : 'text-neutral-500 group-hover:text-neutral-800'">
                        Fase Riset — Audit Bisnis
                    </h3>
                    <div x-show="activeTab === 1" 
                         x-collapse
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="text-sm text-neutral-600 mt-2 leading-relaxed">
                        Kami mendokumentasikan seluruh proses bisnismu, mengidentifikasi <em>bottleneck</em> dan peluang otomasi terbesar, lalu menyusun <em>blueprint</em> sistem yang sesuai kebutuhanmu.
                    </div>
                </div>
                <div x-show="activeTab === 1" x-transition:enter="transition ease-out duration-500" class="w-full md:hidden mt-2 mb-4">
                    <img src="https://lh3.googleusercontent.com/yS1WiF_6doH0xTuHw79XfIOuv3KbnjH1LWraAwgkdSfPDkd5Cw9mlkfyAitZVyoppYNiIXxc2bzN28XfhanwY1IvAyVzjuuXm6UT=e365-pa-nu-rw-w684" alt="Preview 1" class="w-full h-auto rounded-lg object-contain">
                </div>

                <div @click="activeTab = 2" 
                     class="border-s-2 ps-5 cursor-pointer transition-all duration-300 group"
                     :class="activeTab === 2 ? 'border-primary-600' : 'border-neutral-200 hover:border-neutral-400'">
                    <h3 class="text-base font-semibold transition-colors duration-300"
                        :class="activeTab === 2 ? 'text-neutral-900' : 'text-neutral-500 group-hover:text-neutral-800'">
                        Fase Arsitektur — Pembangunan Sistem
                    </h3>
                    <div x-show="activeTab === 2" 
                         x-collapse
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="text-sm md:text-base text-neutral-600 mt-2 leading-relaxed">
                        CRM, database, manajemen proyek, dan komunikasi disatukan dalam satu ekosistem yang rapi dan mudah dikontrol.
                    </div>
                </div>
                <div x-show="activeTab === 2" x-transition:enter="transition ease-out duration-500" class="w-full md:hidden mt-2 mb-4">
                    <img src="https://lh3.googleusercontent.com/avPnomN8M2gLQlnMK2eR7ItCvV6eiFZIdunC0oWHq-X6Xk2zSpAI-EbUO6nql85qJ14zJdtGAkVE7VkRmpYHcanVY_6v-tpwRoA=e365-pa-nu-rw-w684" alt="Preview 2" class="w-full h-auto rounded-lg object-contain">
                </div>

                <div @click="activeTab = 3" 
                     class="border-s-2 ps-5 cursor-pointer transition-all duration-300 group"
                     :class="activeTab === 3 ? 'border-primary-600' : 'border-neutral-200 hover:border-neutral-400'">
                    <h3 class="text-base font-semibold transition-colors duration-300"
                        :class="activeTab === 3 ? 'text-neutral-900' : 'text-neutral-500 group-hover:text-neutral-800'">
                        Fase Peluncuran — Otomasi dan AI
                    </h3>
                    <div x-show="activeTab === 3" 
                         x-collapse
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="text-sm md:text-base text-neutral-600 mt-2 leading-relaxed">
                        AI agent, n8n, integrasi API, dan logika kustom diimplementasikan, diuji, dan divalidasi hingga benar-benar stabil sebelum digunakan penuh.
                    </div>
                </div>
                <div x-show="activeTab === 3" x-transition:enter="transition ease-out duration-500" class="w-full md:hidden mt-2 mb-4">
                    <img src="https://lh3.googleusercontent.com/yS1WiF_6doH0xTuHw79XfIOuv3KbnjH1LWraAwgkdSfPDkd5Cw9mlkfyAitZVyoppYNiIXxc2bzN28XfhanwY1IvAyVzjuuXm6UT=e365-pa-nu-rw-w684" alt="Preview 3" class="w-full h-auto rounded-lg object-contain">
                </div>

                <div @click="activeTab = 4" 
                     class="border-s-2 ps-5 cursor-pointer transition-all duration-300 group"
                     :class="activeTab === 4 ? 'border-primary-600' : 'border-neutral-200 hover:border-neutral-400'">
                    <h3 class="text-base font-semibold transition-colors duration-300"
                        :class="activeTab === 4 ? 'text-neutral-900' : 'text-neutral-500 group-hover:text-neutral-800'">
                        Fase Iterasi — Training, Metrik, dan SOP
                    </h3>
                    <div x-show="activeTab === 4" 
                         x-collapse
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="text-sm md:text-base text-neutral-600 mt-2 leading-relaxed">
                        Tim dilatih, SOP disusun lengkap, dashboard KPI disiapkan, dan sistem terus kami pantau serta optimalkan.
                    </div>
                </div>
                <div x-show="activeTab === 4" x-transition:enter="transition ease-out duration-500" class="w-full md:hidden mt-2 mb-4">
                    <img src="https://lh3.googleusercontent.com/er3CWnoN2UWCO2C5FVuIj8xNkRoltmsW9_bnlppVxThtlQ0eGlYDzvpYQxyCiBeTudA0yscL0Oq17qRcRXsSqTXVh6nlsAn8R1rx=e365-pa-nu-rw-w684" alt="Preview 4" class="w-full h-auto rounded-lg object-contain">
                </div>

            </div>

            <div class="hidden md:flex md:col-span-7 items-center justify-center">
                <div x-show="activeTab === 1" x-transition:enter="transition ease-out duration-500" class="w-full">
                    <img src="https://lh3.googleusercontent.com/yS1WiF_6doH0xTuHw79XfIOuv3KbnjH1LWraAwgkdSfPDkd5Cw9mlkfyAitZVyoppYNiIXxc2bzN28XfhanwY1IvAyVzjuuXm6UT=e365-pa-nu-rw-w684" alt="Preview 1" class="w-full h-auto rounded-[16px] object-contain">
                </div>
                <div x-show="activeTab === 2" x-transition:enter="transition ease-out duration-500" class="w-full">
                    <img src="https://lh3.googleusercontent.com/avPnomN8M2gLQlnMK2eR7ItCvV6eiFZIdunC0oWHq-X6Xk2zSpAI-EbUO6nql85qJ14zJdtGAkVE7VkRmpYHcanVY_6v-tpwRoA=e365-pa-nu-rw-w684" alt="Preview 2" class="w-full h-auto rounded-[16px] object-contain">
                </div>
                <div x-show="activeTab === 3" x-transition:enter="transition ease-out duration-500" class="w-full">
                    <img src="https://lh3.googleusercontent.com/yS1WiF_6doH0xTuHw79XfIOuv3KbnjH1LWraAwgkdSfPDkd5Cw9mlkfyAitZVyoppYNiIXxc2bzN28XfhanwY1IvAyVzjuuXm6UT=e365-pa-nu-rw-w684" alt="Preview 3" class="w-full h-auto rounded-xl object-contain">
                </div>
                <div x-show="activeTab === 4" x-transition:enter="transition ease-out duration-500" class="w-full">
                    <img src="https://lh3.googleusercontent.com/er3CWnoN2UWCO2C5FVuIj8xNkRoltmsW9_bnlppVxThtlQ0eGlYDzvpYQxyCiBeTudA0yscL0Oq17qRcRXsSqTXVh6nlsAn8R1rx=e365-pa-nu-rw-w684" alt="Preview 4" class="w-full h-auto rounded-[16px] object-contain">
                </div>
            </div>

        </div>

    </div>
</section>

{{-- ============================ TRANSFORMASI ============================ --}}
<section class="py-16 lg:py-24 bg-white" data-aos="fade-up" data-aos-duration="700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center mb-12">
            <h2 class="text-2xl font-bold text-neutral-900 lg:text-3xl mb-4">Transformasi yang Bisa Kamu Dapatkan</h2>
            <p class="text-neutral-600 text-base md:text-lg">Pendekatan otomasi kami dirancang untuk mengatasi masalah yang paling sering dihadapi bisnis yang sedang bertumbuh.</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 max-w-5xl mx-auto">
            <div class="border border-neutral-200 rounded-[16px] p-5 bg-white">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-red-500 text-lg">trending_down</span>
                    <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Masalah</span>
                </div>
                <p class="text-sm md:text-base text-neutral-700 mb-3">Margin profit rendah</p>
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-amber-500 text-lg">arrow_forward</span>
                    <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Solusi</span>
                </div>
                <p class="text-sm text-neutral-700 mb-3">Menggantikan tenaga kerja manual lewat otomasi</p>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-500 text-lg">check_circle</span>
                    <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Hasil</span>
                </div>
                <p class="text-sm font-semibold text-primary-600">Margin profit tinggi</p>
            </div>
            <div class="border border-neutral-200 rounded-[16px] p-5 bg-white">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-red-500 text-lg">schedule</span>
                    <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Masalah</span>
                </div>
                <p class="text-sm text-neutral-700 mb-3">Keterlambatan layanan</p>
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-amber-500 text-lg">arrow_forward</span>
                    <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Solusi</span>
                </div>
                <p class="text-sm text-neutral-700 mb-3">Memutus ketergantungan pada proses lama yang lambat</p>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-500 text-lg">check_circle</span>
                    <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Hasil</span>
                </div>
                <p class="text-sm font-semibold text-primary-600">Layanan lebih cepat</p>
            </div>
            <div class="border border-neutral-200 rounded-[16px] p-5 bg-white">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-red-500 text-lg">competitive</span>
                    <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Masalah</span>
                </div>
                <p class="text-sm text-neutral-700 mb-3">Daya saing bisnis lemah</p>
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-amber-500 text-lg">arrow_forward</span>
                    <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Solusi</span>
                </div>
                <p class="text-sm text-neutral-700 mb-3">Menambahkan nilai lewat AI</p>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-500 text-lg">check_circle</span>
                    <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Hasil</span>
                </div>
                <p class="text-sm font-semibold text-primary-600">Layanan lebih baik</p>
            </div>
            <div class="border border-neutral-200 rounded-[16px] p-5 bg-white">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-red-500 text-lg">group_off</span>
                    <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Masalah</span>
                </div>
                <p class="text-sm text-neutral-700 mb-3">Beban kerja staf berlebihan</p>
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-amber-500 text-lg">arrow_forward</span>
                    <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Solusi</span>
                </div>
                <p class="text-sm text-neutral-700 mb-3">Otomasi tugas manual</p>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-500 text-lg">check_circle</span>
                    <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Hasil</span>
                </div>
                <p class="text-sm font-semibold text-primary-600">Tambah kapasitas tim</p>
            </div>
            <div class="border border-neutral-200 rounded-[16px] p-5 bg-white">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-red-500 text-lg">repeat</span>
                    <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Masalah</span>
                </div>
                <p class="text-sm text-neutral-700 mb-3">Redundansi kerja</p>
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-amber-500 text-lg">arrow_forward</span>
                    <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Solusi</span>
                </div>
                <p class="text-sm text-neutral-700 mb-3">Sinkronisasi <em>tools</em> dan data</p>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-500 text-lg">check_circle</span>
                    <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Hasil</span>
                </div>
                <p class="text-sm font-semibold text-primary-600">Efisiensi maksimal</p>
            </div>
            <div class="border border-neutral-200 rounded-[16px] p-5 bg-white">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-red-500 text-lg">visibility_off</span>
                    <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Masalah</span>
                </div>
                <p class="text-sm text-neutral-700 mb-3">Ketidakjelasan dan kurang kontrol</p>
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-amber-500 text-lg">arrow_forward</span>
                    <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Solusi</span>
                </div>
                <p class="text-sm text-neutral-700 mb-3">Satu sumber kebenaran terpusat</p>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-500 text-lg">check_circle</span>
                    <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Hasil</span>
                </div>
                <p class="text-sm font-semibold text-primary-600">Keputusan lebih baik</p>
            </div>
            <div class="border border-neutral-200 rounded-[16px] p-5 bg-white sm:col-span-2 lg:col-start-2 lg:col-span-1">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-red-500 text-lg">error_outline</span>
                    <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Masalah</span>
                </div>
                <p class="text-sm text-neutral-700 mb-3">Inkonsistensi dan <em>error</em></p>
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-amber-500 text-lg">arrow_forward</span>
                    <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Solusi</span>
                </div>
                <p class="text-sm text-neutral-700 mb-3">Otomasi untuk <em>output</em> yang bisa diprediksi</p>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-500 text-lg">check_circle</span>
                    <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Hasil</span>
                </div>
                <p class="text-sm font-semibold text-primary-600">Kualitas konsisten</p>
            </div>
        </div>
    </div>
</section>

{{-- ============================ PENDEKATAN KAMI ============================ --}}
<section class="py-16 lg:py-24 bg-neutral-50" data-aos="fade-up" data-aos-duration="700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center mb-12">
            <h2 class="text-2xl font-bold text-neutral-900 lg:text-3xl mb-4">Pendekatan Kami di Setiap Proyek</h2>
            <p class="text-neutral-600 text-base md:text-lg">Sebagai partner otomasi yang mengutamakan hasil nyata, kami membangun setiap sistem dengan standar yang sama.</p>
        </div>
        <div class="grid sm:grid-cols-3 gap-6 max-w-4xl mx-auto">
            <div class="border border-neutral-200 rounded-[16px] p-6 bg-white text-center" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
                <span class="material-symbols-outlined text-3xl text-primary-600 mb-4 block mx-auto">assignment_turned_in</span>
                <h3 class="text-base font-semibold text-neutral-900 mb-2">Onboarding Efisien</h3>
                <p class="text-sm md:text-base text-neutral-600">Proses <em>onboarding</em> yang efisien, <em>workflow</em> teruji sebelum digunakan penuh.</p>
            </div>
            <div class="border border-neutral-200 rounded-[16px] p-6 bg-white text-center" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
                <span class="material-symbols-outlined text-3xl text-primary-600 mb-4 block mx-auto">description</span>
                <h3 class="text-base font-semibold text-neutral-900 mb-2">Dokumentasi Lengkap</h3>
                <p class="text-sm md:text-base text-neutral-600">Dokumentasi lengkap agar timmu bisa mengoperasikan sistem dengan percaya diri.</p>
            </div>
            <div class="border border-neutral-200 rounded-[16px] p-6 bg-white text-center" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
                <span class="material-symbols-outlined text-3xl text-primary-600 mb-4 block mx-auto">bar_chart</span>
                <h3 class="text-base font-semibold text-neutral-900 mb-2">Hasil Terukur</h3>
                <p class="text-sm md:text-base text-neutral-600">Target dan metrik dibahas di awal kerja sama, hasilnya bisa diukur sejak proyek pertama.</p>
            </div>
        </div>
    </div>
</section>

{{-- ============================ HASIL NYATA (STATS) ============================ --}}
<section class="py-16 lg:py-24 bg-white" data-aos="fade-up" data-aos-duration="700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center mb-12">
            <h2 class="text-2xl font-bold text-neutral-900 lg:text-3xl mb-4">Hasil Nyata</h2>
        </div>
        <div class="grid sm:grid-cols-3 gap-6 max-w-3xl mx-auto">
            <div class="border border-neutral-200 rounded-[16px] p-8 bg-white text-center">
                <span class="text-4xl font-bold text-primary-600 block mb-2">50+</span>
                <p class="text-sm md:text-base text-neutral-600">Kreatif per hari diotomasi</p>
            </div>
            <div class="border border-neutral-200 rounded-[16px] p-8 bg-white text-center">
                <span class="text-4xl font-bold text-primary-600 block mb-2">100+</span>
                <p class="text-sm md:text-base text-neutral-600">Workflow di-<em>deploy</em></p>
            </div>
            <div class="border border-neutral-200 rounded-[16px] p-8 bg-white text-center">
                <span class="text-4xl font-bold text-primary-600 block mb-2">24/7</span>
                <p class="text-sm md:text-base text-neutral-600">Monitoring dan <em>support</em></p>
            </div>
        </div>
    </div>
</section>

{{-- ============================ MENGAPA MEMILIH CENTROVA ============================ --}}
<section class="py-16 lg:py-24 bg-neutral-50" data-aos="fade-up" data-aos-duration="700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-start max-w-5xl mx-auto">
            <div>
                <h2 class="text-2xl font-bold text-neutral-900 lg:text-3xl mb-5">Mengapa Memilih Centrova</h2>
                <p class="text-neutral-600 text-base md:text-lg">
                    Kami menggabungkan kekuatan AI dengan rekayasa sistem bisnis yang praktis dan terukur. Setiap solusi kami rancang agar benar-benar dipakai sehari-hari, tetap stabil dalam jangka panjang, dan memberi dampak langsung pada performa bisnismu. Bagi kami, AI bukan untuk menggantikan manusia, melainkan mempercepat kerja dan memperkuat setiap pengambilan keputusan.
                </p>
            </div>
            <div class="grid sm:grid-cols-2 gap-5">
                <div class="border border-neutral-200 rounded-[16px] p-5 bg-white">
                    <span class="material-symbols-outlined text-2xl text-primary-600 mb-3 block">bolt</span>
                    <h3 class="text-sm md:text-base font-semibold text-neutral-900 mb-1">Cepat</h3>
                    <p class="text-xs md:text-sm text-neutral-600">Proses <em>deployment</em> kami percepat tanpa mengorbankan stabilitas dan kualitas.</p>
                </div>
                <div class="border border-neutral-200 rounded-[16px] p-5 bg-white">
                    <span class="material-symbols-outlined text-2xl text-primary-600 mb-3 block">verified</span>
                    <h3 class="text-sm md:text-base font-semibold text-neutral-900 mb-1">Stabil</h3>
                    <p class="text-xs md:text-sm text-neutral-600">Performa sistem kami rancang agar terjaga di setiap skala pertumbuhan bisnismu.</p>
                </div>
                <div class="border border-neutral-200 rounded-[16px] p-5 bg-white">
                    <span class="material-symbols-outlined text-2xl text-primary-600 mb-3 block">tune</span>
                    <h3 class="text-sm md:text-base font-semibold text-neutral-900 mb-1">Personalisasi</h3>
                    <p class="text-xs md:text-sm text-neutral-600">Setiap otomasi kami rancang khusus sesuai struktur tim, alur data, dan tujuan bisnismu.</p>
                </div>
                <div class="border border-neutral-200 rounded-[16px] p-5 bg-white">
                    <span class="material-symbols-outlined text-2xl text-primary-600 mb-3 block">support_agent</span>
                    <h3 class="text-sm md:text-base font-semibold text-neutral-900 mb-1">Dukungan Teknis</h3>
                    <p class="text-xs md:text-sm text-neutral-600">Sistem kami pantau secara aktif berdasarkan pola penggunaan dan beban kerja bisnismu yang sesungguhnya.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================ KEAHLIAN TEKNOLOGI ============================ --}}
<section class="py-16 lg:py-24 bg-white" data-aos="fade-up" data-aos-duration="700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center mb-12">
            <h2 class="text-2xl font-bold text-neutral-900 lg:text-3xl mb-4">Keahlian Teknologi</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 max-w-5xl mx-auto">
            <div class="border border-neutral-200 rounded-[16px] p-5 bg-white">
                <h3 class="text-sm md:text-base font-semibold text-neutral-900 mb-4">Platform AI</h3>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4d/OpenAI_Logo.svg/1280px-OpenAI_Logo.svg.png" alt="OpenAI" class="h-5 w-auto object-contain">
                        <span class="text-sm md:text-base text-neutral-600">OpenAI</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/10/Anthropic_logo.svg/1280px-Anthropic_logo.svg.png" alt="Anthropic" class="h-5 w-auto object-contain">
                        <span class="text-sm md:text-base text-neutral-600">Anthropic</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8a/Google_Gemini_logo.svg/1280px-Google_Gemini_logo.svg.png" alt="Google Gemini" class="h-5 w-auto object-contain">
                        <span class="text-sm md:text-base text-neutral-600">Google Gemini</span>
                    </div>
                </div>
            </div>
            <div class="border border-neutral-200 rounded-[16px] p-5 bg-white">
                <h3 class="text-sm md:text-base font-semibold text-neutral-900 mb-4">Sistem CRM</h3>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f9/Salesforce.com_logo.svg/1280px-Salesforce.com_logo.svg.png" alt="Salesforce" class="h-5 w-auto object-contain">
                        <span class="text-sm md:text-base text-neutral-600">Salesforce</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ab/HubSpot_Logo.svg/1280px-HubSpot_Logo.svg.png" alt="HubSpot" class="h-5 w-auto object-contain">
                        <span class="text-sm md:text-base text-neutral-600">HubSpot</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/Zoho_Corporation_Logo.svg/1280px-Zoho_Corporation_Logo.svg.png" alt="Zoho" class="h-5 w-auto object-contain">
                        <span class="text-sm md:text-base text-neutral-600">Zoho</span>
                    </div>
                </div>
            </div>
            <div class="border border-neutral-200 rounded-[16px] p-5 bg-white">
                <h3 class="text-sm md:text-base font-semibold text-neutral-900 mb-4">Tools Otomasi</h3>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f9/Zapier_logo.svg/1280px-Zapier_logo.svg.png" alt="Zapier" class="h-5 w-auto object-contain">
                        <span class="text-sm md:text-base text-neutral-600">Zapier</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4e/Make_Logo.svg/1280px-Make_Logo.svg.png" alt="Make" class="h-5 w-auto object-contain">
                        <span class="text-sm md:text-base text-neutral-600">Make</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/N8n-logo-new.svg/1280px-N8n-logo-new.svg.png" alt="n8n" class="h-5 w-auto object-contain">
                        <span class="text-sm md:text-base text-neutral-600">n8n</span>
                    </div>
                </div>
            </div>
            <div class="border border-neutral-200 rounded-[16px] p-5 bg-white">
                <h3 class="text-sm md:text-base font-semibold text-neutral-900 mb-4">Pengembangan Kustom</h3>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Python-logo-notext.svg/1280px-Python-logo-notext.svg.png" alt="Python" class="h-5 w-auto object-contain">
                        <span class="text-sm md:text-base text-neutral-600">Python</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d9/Node.js_logo.svg/1280px-Node.js_logo.svg.png" alt="Node.js" class="h-5 w-auto object-contain">
                        <span class="text-sm md:text-base text-neutral-600">Node.js</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-neutral-400 text-lg">api</span>
                        <span class="text-sm md:text-base text-neutral-600">API Integration</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================ FAQ ============================ --}}
<section class="py-16 lg:py-24 bg-white" data-aos="fade-up" data-aos-duration="700">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold text-neutral-900 lg:text-3xl mb-4">Pertanyaan yang Sering Diajukan</h2>
            </div>

            <div class="space-y-3" x-data="{ activeFaq: null }">
                
                {{-- Meta-style faq-accordion-item with rounded-[16px] --}}
                <div class="border border-neutral-200 rounded-[16px] overflow-hidden" 
                     :class="activeFaq === 1 ? 'border-primary-200' : ''">
                    <button @click="activeFaq = activeFaq === 1 ? null : 1" 
                            class="w-full flex justify-between items-center gap-x-3 px-5 py-4 text-left transition" 
                            :class="activeFaq === 1 ? 'bg-primary-50/50' : 'bg-white hover:bg-neutral-50'">
                        <span class="text-base md:text-lg font-semibold text-neutral-900">Apa itu Centrova?</span>
                        <svg class="w-5 h-5 text-neutral-500 shrink-0 transition-transform duration-200" 
                             :class="activeFaq === 1 ? 'rotate-180' : ''"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="activeFaq === 1" x-collapse>
                        <div class="px-5 pb-5 text-neutral-600 text-sm md:text-base leading-relaxed">
                            Centrova adalah perusahaan teknologi asal Indonesia yang fokus pada otomasi AI dan venture engineering. Centrova berperan sebagai technology partner bagi bisnis yang ingin menghilangkan pekerjaan manual, merapikan alur kerja, dan membangun sistem otomatis berbasis AI yang benar-benar dipakai sehari-hari, bukan sekadar demo.
                        </div>
                    </div>
                </div>

                <div class="border border-neutral-200 rounded-[16px] overflow-hidden"
                     :class="activeFaq === 2 ? 'border-primary-200' : ''">
                    <button @click="activeFaq = activeFaq === 2 ? null : 2" 
                            class="w-full flex justify-between items-center gap-x-3 px-5 py-4 text-left transition"
                            :class="activeFaq === 2 ? 'bg-primary-50/50' : 'bg-white hover:bg-neutral-50'">
                        <span class="text-base md:text-lg font-semibold text-neutral-900">Jenis bisnis apa yang cocok menggunakan layanan Centrova?</span>
                        <svg class="w-5 h-5 text-neutral-500 shrink-0 transition-transform duration-200"
                             :class="activeFaq === 2 ? 'rotate-180' : ''"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="activeFaq === 2" x-collapse>
                        <div class="px-5 pb-5 text-neutral-600 text-sm md:text-base leading-relaxed">
                            Layanan Centrova cocok untuk bisnis dari berbagai skala, mulai dari UMKM, startup, hingga perusahaan yang sudah punya tim dan proses operasional tetap tapi masih mengandalkan banyak pekerjaan manual. Bisnis yang paling merasakan manfaat biasanya punya proses berulang seperti follow up pelanggan, input data, pembuatan laporan, atau koordinasi antar tim yang selama ini masih dikerjakan satu per satu secara manual.
                        </div>
                    </div>
                </div>

                <div class="border border-neutral-200 rounded-[16px] overflow-hidden"
                     :class="activeFaq === 3 ? 'border-primary-200' : ''">
                    <button @click="activeFaq = activeFaq === 3 ? null : 3" 
                            class="w-full flex justify-between items-center gap-x-3 px-5 py-4 text-left transition"
                            :class="activeFaq === 3 ? 'bg-primary-50/50' : 'bg-white hover:bg-neutral-50'">
                        <span class="text-base md:text-lg font-semibold text-neutral-900">Berapa lama waktu implementasi otomasi AI di Centrova?</span>
                        <svg class="w-5 h-5 text-neutral-500 shrink-0 transition-transform duration-200"
                             :class="activeFaq === 3 ? 'rotate-180' : ''"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="activeFaq === 3" x-collapse>
                        <div class="px-5 pb-5 text-neutral-600 text-sm md:text-base leading-relaxed">
                            Lama implementasi tergantung kompleksitas proses yang diotomasi. Sistem sederhana seperti chatbot atau otomasi satu alur kerja biasanya bisa dibangun dan live dalam hitungan hari hingga dua minggu. Untuk sistem yang lebih kompleks dan melibatkan banyak integrasi antar tools, prosesnya dimulai dari audit bisnis terlebih dahulu sehingga estimasi waktu disesuaikan setelah kebutuhan spesifik teridentifikasi.
                        </div>
                    </div>
                </div>

                <div class="border border-neutral-200 rounded-[16px] overflow-hidden"
                     :class="activeFaq === 4 ? 'border-primary-200' : ''">
                    <button @click="activeFaq = activeFaq === 4 ? null : 4" 
                            class="w-full flex justify-between items-center gap-x-3 px-5 py-4 text-left transition"
                            :class="activeFaq === 4 ? 'bg-primary-50/50' : 'bg-white hover:bg-neutral-50'">
                        <span class="text-base md:text-lg font-semibold text-neutral-900">Apakah AI akan menggantikan peran tim saya?</span>
                        <svg class="w-5 h-5 text-neutral-500 shrink-0 transition-transform duration-200"
                             :class="activeFaq === 4 ? 'rotate-180' : ''"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="activeFaq === 4" x-collapse>
                        <div class="px-5 pb-5 text-neutral-600 text-sm md:text-base leading-relaxed">
                            Tidak. Pendekatan Centrova bersifat human-centered, artinya AI dan otomasi dirancang untuk mengambil alih pekerjaan repetitif dan memakan waktu, bukan menggantikan peran strategis manusia. Tujuannya agar tim bisa fokus pada pekerjaan yang membutuhkan pengambilan keputusan, kreativitas, dan interaksi langsung dengan pelanggan, sementara tugas rutin berjalan otomatis di balik layar.
                        </div>
                    </div>
                </div>

                <div class="border border-neutral-200 rounded-[16px] overflow-hidden"
                     :class="activeFaq === 5 ? 'border-primary-200' : ''">
                    <button @click="activeFaq = activeFaq === 5 ? null : 5" 
                            class="w-full flex justify-between items-center gap-x-3 px-5 py-4 text-left transition"
                            :class="activeFaq === 5 ? 'bg-primary-50/50' : 'bg-white hover:bg-neutral-50'">
                        <span class="text-base md:text-lg font-semibold text-neutral-900">Tools dan teknologi apa saja yang digunakan Centrova?</span>
                        <svg class="w-5 h-5 text-neutral-500 shrink-0 transition-transform duration-200"
                             :class="activeFaq === 5 ? 'rotate-180' : ''"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="activeFaq === 5" x-collapse>
                        <div class="px-5 pb-5 text-neutral-600 text-sm md:text-base leading-relaxed">
                            Centrova menggunakan kombinasi platform AI seperti OpenAI, Anthropic, dan Google Gemini, tools otomasi seperti n8n, Zapier, dan Make, serta pengembangan kustom dengan Python dan Node.js untuk kebutuhan yang lebih spesifik. Pemilihan tools disesuaikan dengan sistem yang sudah dipakai klien agar integrasi berjalan mulus tanpa perlu mengganti seluruh infrastruktur yang ada.
                        </div>
                    </div>
                </div>

                <div class="border border-neutral-200 rounded-[16px] overflow-hidden"
                     :class="activeFaq === 6 ? 'border-primary-200' : ''">
                    <button @click="activeFaq = activeFaq === 6 ? null : 6" 
                            class="w-full flex justify-between items-center gap-x-3 px-5 py-4 text-left transition"
                            :class="activeFaq === 6 ? 'bg-primary-50/50' : 'bg-white hover:bg-neutral-50'">
                        <span class="text-base md:text-lg font-semibold text-neutral-900">Berapa biaya sistem otomasi AI dari Centrova?</span>
                        <svg class="w-5 h-5 text-neutral-500 shrink-0 transition-transform duration-200"
                             :class="activeFaq === 6 ? 'rotate-180' : ''"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="activeFaq === 6" x-collapse>
                        <div class="px-5 pb-5 text-neutral-600 text-sm md:text-base leading-relaxed">
                            Biaya bervariasi tergantung kompleksitas proses, jumlah integrasi, dan skala otomasi yang dibutuhkan. Centrova menyediakan sesi konsultasi gratis di awal untuk memahami kebutuhan bisnis, memetakan proses yang paling berdampak jika diotomasi, dan memberikan estimasi biaya yang jelas sebelum pekerjaan dimulai.
                        </div>
                    </div>
                </div>

                <div class="border border-neutral-200 rounded-[16px] overflow-hidden"
                     :class="activeFaq === 7 ? 'border-primary-200' : ''">
                    <button @click="activeFaq = activeFaq === 7 ? null : 7" 
                            class="w-full flex justify-between items-center gap-x-3 px-5 py-4 text-left transition"
                            :class="activeFaq === 7 ? 'bg-primary-50/50' : 'bg-white hover:bg-neutral-50'">
                        <span class="text-base md:text-lg font-semibold text-neutral-900">Apakah Centrova sudah punya pengalaman menangani klien sebelumnya?</span>
                        <svg class="w-5 h-5 text-neutral-500 shrink-0 transition-transform duration-200"
                             :class="activeFaq === 7 ? 'rotate-180' : ''"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="activeFaq === 7" x-collapse>
                        <div class="px-5 pb-5 text-neutral-600 text-sm md:text-base leading-relaxed">
                            Centrova adalah agensi otomasi AI yang baru membuka layanan ini secara resmi. Meski begitu, tim Centrova sudah terbiasa membangun berbagai produk berbasis AI dan otomasi, termasuk platform SaaS, sistem manajemen berbasis workflow, dan tools automation lainnya. Pendekatan kerja Centrova dibangun dari pengalaman tersebut, dengan standar proses yang sama diterapkan di setiap proyek baru.
                        </div>
                    </div>
                </div>

                <div class="border border-neutral-200 rounded-[16px] overflow-hidden"
                     :class="activeFaq === 8 ? 'border-primary-200' : ''">
                    <button @click="activeFaq = activeFaq === 8 ? null : 8" 
                            class="w-full flex justify-between items-center gap-x-3 px-5 py-4 text-left transition"
                            :class="activeFaq === 8 ? 'bg-primary-50/50' : 'bg-white hover:bg-neutral-50'">
                        <span class="text-base md:text-lg font-semibold text-neutral-900">Apa yang membedakan Centrova dari agensi otomasi AI lainnya?</span>
                        <svg class="w-5 h-5 text-neutral-500 shrink-0 transition-transform duration-200"
                             :class="activeFaq === 8 ? 'rotate-180' : ''"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="activeFaq === 8" x-collapse>
                        <div class="px-5 pb-5 text-neutral-600 text-sm md:text-base leading-relaxed">
                            Centrova tidak menjual satu jenis sistem yang sama ke semua klien. Setiap otomasi dirancang khusus berdasarkan struktur tim, alur data, dan tujuan bisnis masing-masing klien, dimulai dari audit proses yang mendalam. Centrova juga menekankan transparansi sejak awal kerja sama, termasuk soal metrik keberhasilan yang akan diukur bersama klien.
                        </div>
                    </div>
                </div>

                <div class="border border-neutral-200 rounded-[16px] overflow-hidden"
                     :class="activeFaq === 9 ? 'border-primary-200' : ''">
                    <button @click="activeFaq = activeFaq === 9 ? null : 9" 
                            class="w-full flex justify-between items-center gap-x-3 px-5 py-4 text-left transition"
                            :class="activeFaq === 9 ? 'bg-primary-50/50' : 'bg-white hover:bg-neutral-50'">
                        <span class="text-base md:text-lg font-semibold text-neutral-900">Bagaimana cara memulai kerja sama dengan Centrova?</span>
                        <svg class="w-5 h-5 text-neutral-500 shrink-0 transition-transform duration-200"
                             :class="activeFaq === 9 ? 'rotate-180' : ''"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="activeFaq === 9" x-collapse>
                        <div class="px-5 pb-5 text-neutral-600 text-sm md:text-base leading-relaxed">
                            Langkah pertama adalah menjadwalkan sesi konsultasi gratis. Dalam sesi ini, Centrova akan memahami proses bisnis yang sedang berjalan, mengidentifikasi peluang otomasi yang paling relevan, dan menjelaskan pendekatan kerja yang akan digunakan sebelum proyek dimulai.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- ============================ CTA (Meta-style card-promo-strip) ============================ --}}
<section class="py-16 lg:py-24 bg-neutral-50" data-aos="fade-up" data-aos-duration="700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-neutral-900 rounded-[32px] p-8 sm:p-12 lg:p-16 text-center max-w-4xl mx-auto">
            <h2 class="text-2xl font-bold text-white lg:text-3xl mb-4">Saatnya Bertindak</h2>
            <p class="text-neutral-300 text-base md:text-lg mb-6 max-w-xl mx-auto">
                Tanpa Centrova, waktu terbuang percuma, proses tetap berantakan, adopsi teknologi rendah, dan peluang besar terlewat begitu saja.
            </p>
            <p class="text-neutral-300 text-base md:text-lg mb-8 max-w-xl mx-auto font-semibold text-primary-400">
                Bersama Centrova, masalah nyata bisa terselesaikan, kecepatan kerja bisa meningkat signifikan, dan timmu akan mencintai cara kerja yang baru.
            </p>
            <a href="{{ route('service.consult') }}" class="py-3.5 px-7 inline-flex items-center text-sm font-bold rounded-full bg-primary-600 text-white hover:bg-primary-700 transition">
                Jadwalkan Konsultasi Gratis Sekarang
            </a>
        </div>
    </div>
</section>
@endsection
