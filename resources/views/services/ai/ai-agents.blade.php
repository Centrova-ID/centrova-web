@extends('partials.layouts.main')

@section('title', 'AI Agents - Anggota Tim Digital yang Bekerja 24/7 | Centrova')

@section('seoMetaTags')
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta name="robots" content="index, follow, max-image-preview:large"/>
    <meta name="description" content="AI Agents dari Centrova bekerja layaknya anggota tim digital yang mampu memahami konteks, mengambil keputusan, menjalankan tugas, dan mengotomatisasi workflow bisnis secara mandiri 24/7."/>
    <meta name="keywords" content="AI Agents, kecerdasan buatan, otomatisasi bisnis, AI automation Indonesia, digital team, workflow automation Jakarta"/>
    <meta name="language" content="id"/>
    <meta name="geo.region" content="ID-JK"/>
    <meta name="geo.placename" content="Jakarta, Indonesia"/>
    <meta property="og:title" content="AI Agents - Anggota Tim Digital yang Bekerja 24/7 | Centrova"/>
    <meta property="og:description" content="Deploy AI agents yang memahami konteks, membuat keputusan, menjalankan tugas, dan mengotomatisasi workflow bisnis di seluruh organisasi Anda."/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="https://centrova.id/services/ai/ai-agents"/>
    <meta property="og:site_name" content="Centrova Indonesia"/>
    <meta property="og:locale" content="id_ID"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:title" content="AI Agents | Centrova"/>
    <meta name="twitter:description" content="AI Agents yang bekerja layaknya anggota tim digital — otomatisasi workflow, pengambilan keputusan, dan integrasi sistem bisnis."/>
    <link rel="canonical" href="https://centrova.id/services/ai/ai-agents"/>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Service",
        "name": "AI Agents",
        "provider": {
            "@type": "LocalBusiness",
            "name": "Centrova",
            "url": "https://centrova.id",
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
            }
        },
        "description": "AI Agents yang bekerja layaknya anggota tim digital — memahami konteks, mengambil keputusan, menjalankan tugas, dan mengotomatisasi workflow bisnis 24/7.",
        "areaServed": {
            "@type": "Country",
            "name": "Indonesia"
        },
        "serviceType": "AI Agent Development"
    }
    </script>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "Apa perbedaan AI Agent dengan AI Chatbot?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "AI Chatbot umumnya hanya menjawab pertanyaan berdasarkan informasi yang tersedia. AI Agent tidak hanya memahami dan menjawab, tetapi juga dapat mengambil tindakan seperti membuat laporan, mengirim email, memperbarui CRM, atau menjalankan workflow bisnis."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah AI Agent bisa terhubung dengan sistem yang sudah kami gunakan?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Ya. AI Agent dapat diintegrasikan dengan berbagai platform seperti CRM, ERP, WhatsApp Business, email, database, Google Workspace, Microsoft 365, dan sistem internal perusahaan."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah AI Agent bisa menggantikan karyawan?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Tujuan AI Agent bukan menggantikan manusia, melainkan mengurangi pekerjaan repetitif sehingga tim dapat fokus pada aktivitas yang membutuhkan analisis, kreativitas, dan pengambilan keputusan strategis."
                }
            },
            {
                "@type": "Question",
                "name": "Berapa lama implementasi AI Agent?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Waktu implementasi bergantung pada kompleksitas kebutuhan dan integrasi sistem. Sebagian besar proyek dapat diselesaikan dalam beberapa minggu hingga beberapa bulan."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah AI Agent aman untuk data perusahaan?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Ya. Implementasi dilakukan dengan memperhatikan keamanan data, kontrol akses, dan kebutuhan kepatuhan perusahaan untuk memastikan informasi tetap terlindungi."
                }
            },
            {
                "@type": "Question",
                "name": "Bisakah AI Agent bekerja 24/7?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Ya. AI Agent dapat beroperasi tanpa henti dan memberikan respons secara konsisten kapan pun dibutuhkan."
                }
            }
        ]
    }
    </script>
@endsection

@section('content')

{{-- Hero Section --}}
<section class="relative overflow-hidden border-b border-gray-200 bg-white">
    <div class="max-w-7xl px-8 mx-auto flex items-center max-lg:flex-col-reverse py-16 gap-12">
        <div class="w-full flex flex-col justify-center">
            <div class="inline-flex items-center gap-2 bg-primary-50 border border-primary-100 text-primary-700 text-sm font-medium px-4 py-1.5 rounded-full mb-6 w-fit">
                <span class="material-symbols-outlined text-sm">smart_toy</span>
                AI Agents
            </div>
            <h1 class="text-4xl md:text-6xl font-semibold tracking-tighter mb-6 text-neutral-900 leading-tight">
                AI Agents That Work Like<br class="hidden md:block"/> Digital Team Members
            </h1>
            <p class="text-lg w-full max-w-2xl text-neutral-600 tracking-tight mb-8 leading-relaxed">
                Deploy intelligent AI agents yang dapat memahami konteks, membuat keputusan, menjalankan tugas, dan mengotomatisasi workflow bisnis di seluruh organisasi — bekerja 24/7 tanpa henti.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('service.consult') }}" class="inline-flex items-center justify-center gap-2 py-3.5 px-7 rounded-full bg-primary-500 hover:bg-primary-600 transition-all text-white font-medium shadow-sm">
                    <span class="material-symbols-outlined text-base">calendar_month</span>
                    Jadwalkan Konsultasi
                </a>
                <a href="#solutions" class="inline-flex items-center justify-center gap-2 py-3.5 px-7 rounded-full border border-neutral-300 hover:border-neutral-400 hover:bg-neutral-50 transition-all text-neutral-800 font-medium">
                    <span class="material-symbols-outlined text-base">explore</span>
                    Jelajahi Solusi
                </a>
            </div>
        </div>
        <div class="w-full flex justify-center">
            <div class="relative w-full max-w-md">
                <div class="bg-gradient-to-br from-primary-50 to-blue-50 rounded-3xl p-8 border border-primary-100">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3 bg-white rounded-2xl p-4 shadow-sm">
                            <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-primary-600">headset_mic</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-neutral-900">Customer Support Agent</p>
                                <p class="text-xs text-neutral-500">Merespons ribuan pertanyaan otomatis</p>
                            </div>
                            <span class="ml-auto w-2.5 h-2.5 rounded-full bg-green-400 flex-shrink-0 animate-pulse"></span>
                        </div>
                        <div class="flex items-center gap-3 bg-white rounded-2xl p-4 shadow-sm">
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-blue-600">trending_up</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-neutral-900">Sales Agent</p>
                                <p class="text-xs text-neutral-500">Kualifikasi & follow-up leads otomatis</p>
                            </div>
                            <span class="ml-auto w-2.5 h-2.5 rounded-full bg-green-400 flex-shrink-0 animate-pulse"></span>
                        </div>
                        <div class="flex items-center gap-3 bg-white rounded-2xl p-4 shadow-sm">
                            <div class="w-10 h-10 bg-violet-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-violet-600">menu_book</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-neutral-900">Knowledge Agent</p>
                                <p class="text-xs text-neutral-500">Menjawab pertanyaan tim secara instan</p>
                            </div>
                            <span class="ml-auto w-2.5 h-2.5 rounded-full bg-green-400 flex-shrink-0 animate-pulse"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="bg-gray-50">

    {{-- What Are AI Agents --}}
    <section class="py-20 md:py-24 border-b border-neutral-200 bg-white">
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <div class="lg:col-span-5 lg:sticky lg:top-32">
                <h2 class="text-4xl font-semibold tracking-tighter text-neutral-900 mb-4">Apa Itu AI Agents?</h2>
                <p class="text-lg text-neutral-700 leading-relaxed">Sistem AI yang mampu memahami tujuan, mengambil keputusan, dan menjalankan tugas secara mandiri.</p>
            </div>
            <div class="lg:col-span-7 space-y-6">
                <p class="text-lg text-neutral-700 leading-relaxed">
                    AI Agents adalah sistem berbasis Artificial Intelligence yang mampu memahami tujuan, mengambil keputusan, menjalankan tugas, dan berinteraksi dengan berbagai sistem untuk menyelesaikan pekerjaan secara mandiri.
                </p>
                <p class="text-lg text-neutral-700 leading-relaxed">
                    Berbeda dengan chatbot tradisional yang hanya menjawab pertanyaan, AI Agents dapat melakukan tindakan nyata seperti mencari data, membuat laporan, mengirim email, memperbarui CRM, memproses dokumen, hingga menjalankan workflow bisnis secara otomatis.
                </p>
                <div class="p-6 bg-primary-50 border border-primary-100 rounded-2xl">
                    <p class="text-neutral-900 font-semibold text-lg">AI Agents berfungsi layaknya anggota tim digital yang bekerja 24/7 untuk membantu operasional perusahaan menjadi lebih cepat, konsisten, dan efisien.</p>
                </div>

                {{-- Comparison Table --}}
                <div class="overflow-hidden rounded-xl border border-neutral-200">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-neutral-50">
                                <th class="text-left px-4 py-3 font-semibold text-neutral-700 border-b border-neutral-200">Traditional Chatbot</th>
                                <th class="text-left px-4 py-3 font-semibold text-primary-700 border-b border-neutral-200 bg-primary-50">AI Agent</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-100">
                            <tr>
                                <td class="px-4 py-3 text-neutral-600">Menjawab pertanyaan</td>
                                <td class="px-4 py-3 text-neutral-900 font-medium bg-primary-50/40">Menjawab dan melakukan tindakan</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 text-neutral-600">Berbasis script</td>
                                <td class="px-4 py-3 text-neutral-900 font-medium bg-primary-50/40">Berbasis reasoning</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 text-neutral-600">Flow terbatas</td>
                                <td class="px-4 py-3 text-neutral-900 font-medium bg-primary-50/40">Adaptif terhadap konteks</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 text-neutral-600">Tidak terintegrasi</td>
                                <td class="px-4 py-3 text-neutral-900 font-medium bg-primary-50/40">Terintegrasi dengan berbagai sistem</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 text-neutral-600">Pasif</td>
                                <td class="px-4 py-3 text-neutral-900 font-medium bg-primary-50/40">Proaktif menjalankan tugas</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    {{-- Why AI Agents Matter --}}
    <section class="py-20 md:py-24 border-b border-neutral-200 bg-white">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-semibold tracking-tighter text-neutral-900 mb-4">Mengapa AI Agents Dibutuhkan?</h2>
                <p class="text-lg text-neutral-600 max-w-2xl mx-auto">Banyak perusahaan masih menghabiskan waktu untuk pekerjaan administratif dan proses berulang yang sebenarnya dapat diotomatisasi.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ([
                    ['icon' => 'work_off', 'title' => 'Kurangi Beban Kerja Manual', 'desc' => 'Hilangkan tugas-tugas repetitif yang menghabiskan waktu tim.'],
                    ['icon' => 'speed', 'title' => 'Percepat Proses Bisnis', 'desc' => 'Proses yang tadinya memakan jam kini selesai dalam hitungan menit.'],
                    ['icon' => 'error_outline', 'title' => 'Kurangi Human Error', 'desc' => 'Konsistensi tinggi tanpa kesalahan yang disebabkan faktor manusia.'],
                    ['icon' => 'trending_up', 'title' => 'Tingkatkan Produktivitas', 'desc' => 'Tim bisa fokus pada pekerjaan strategis yang bernilai lebih tinggi.'],
                    ['icon' => 'support_agent', 'title' => 'Layanan Lebih Responsif', 'desc' => 'Pelanggan mendapat respons instan kapan pun mereka membutuhkan.'],
                    ['icon' => 'database', 'title' => 'Manfaatkan Data Real-time', 'desc' => 'Keputusan berbasis data terkini yang selalu tersedia dan akurat.'],
                    ['icon' => 'savings', 'title' => 'Hemat Biaya Operasional', 'desc' => 'Kurangi pengeluaran operasional tanpa mengorbankan kualitas.'],
                    ['icon' => 'bolt', 'title' => 'Skalabilitas Tanpa Batas', 'desc' => 'Tangani volume pekerjaan yang meningkat tanpa menambah sumber daya.'],
                ] as $item)
                <div class="p-6 rounded-xl border border-neutral-200 bg-white hover:shadow-md hover:shadow-black/10 transition-shadow duration-200">
                    <div class="w-11 h-11 bg-primary-50 rounded-xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-primary-600">{{ $item['icon'] }}</span>
                    </div>
                    <h3 class="font-semibold text-neutral-900 mb-2">{{ $item['title'] }}</h3>
                    <p class="text-neutral-600 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Who Needs AI Agents --}}
    <section class="py-20 md:py-24 border-b border-neutral-200 bg-white">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-semibold tracking-tighter text-neutral-900 mb-4">Siapa yang Membutuhkan AI Agents?</h2>
                <p class="text-lg text-neutral-600 max-w-2xl mx-auto">AI Agents dapat digunakan oleh berbagai jenis organisasi dan tim di seluruh perusahaan.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ([
                    ['icon' => 'business_center', 'color' => 'primary', 'title' => 'Business Owners', 'desc' => 'Mengurangi ketergantungan pada proses manual dan meningkatkan efisiensi operasional secara menyeluruh.'],
                    ['icon' => 'headset_mic', 'color' => 'blue', 'title' => 'Customer Service Teams', 'desc' => 'Menangani pertanyaan pelanggan secara otomatis dan konsisten tanpa membebani tim.'],
                    ['icon' => 'trending_up', 'color' => 'green', 'title' => 'Sales Teams', 'desc' => 'Mengelola leads, follow-up prospek, dan mempercepat proses penjualan secara otomatis.'],
                    ['icon' => 'settings_applications', 'color' => 'violet', 'title' => 'Operations Teams', 'desc' => 'Mengotomatisasi workflow internal dan pengelolaan data lintas departemen.'],
                    ['icon' => 'groups', 'color' => 'amber', 'title' => 'HR Teams', 'desc' => 'Membantu proses rekrutmen, onboarding, dan knowledge management secara efisien.'],
                    ['icon' => 'corporate_fare', 'color' => 'rose', 'title' => 'Enterprises', 'desc' => 'Membangun ekosistem AI yang terintegrasi dengan berbagai sistem bisnis skala besar.'],
                ] as $item)
                <div class="rounded-xl border border-neutral-200 bg-white p-6 hover:shadow-md hover:shadow-black/10 transition-shadow duration-200">
                    <div class="w-12 h-12 bg-{{ $item['color'] }}-50 rounded-xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-{{ $item['color'] }}-600">{{ $item['icon'] }}</span>
                    </div>
                    <h3 class="text-lg font-semibold text-neutral-900 mb-2">{{ $item['title'] }}</h3>
                    <p class="text-neutral-600 text-base leading-relaxed">{{ $item['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Solutions / Where Can Be Used --}}
    <section id="solutions" class="py-20 md:py-24 border-b border-neutral-200 bg-white">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-semibold tracking-tighter text-neutral-900 mb-4">Di Mana AI Agents Bisa Digunakan?</h2>
                <p class="text-lg text-neutral-600 max-w-2xl mx-auto">Solusi AI Agent kami dirancang untuk berbagai fungsi bisnis yang paling kritis.</p>
            </div>
            <div class="max-w-7xl mx-auto px-8">
                <img src="{{ asset('assets/image/bq87g87g3.png') }}" alt="" class="w-full">
            </div>
        </div>
    </section>

    {{-- Use Cases --}}
    <section class="py-20 md:py-24 border-b border-neutral-200 bg-white">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-semibold tracking-tighter text-neutral-900 mb-4">Studi Kasus Nyata</h2>
                <p class="text-lg text-neutral-600 max-w-2xl mx-auto">Contoh implementasi AI Agents di berbagai industri dan bagaimana hasilnya.</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl border border-neutral-200 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="bg-gradient-to-br from-primary-500 to-blue-600 p-6">
                        <span class="material-symbols-outlined text-white text-4xl">trending_up</span>
                        <h3 class="text-xl font-semibold text-white mt-3">Lead Qualification Agent</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <p class="text-neutral-600 text-sm">Perusahaan menerima ratusan leads setiap minggu dengan follow-up manual yang lambat.</p>
                        <div class="space-y-2">
                            <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wide">Setelah Implementasi</p>
                            <ul class="space-y-1.5">
                                <li class="flex items-center gap-2 text-sm text-neutral-700"><span class="material-symbols-outlined text-green-500 text-base">check_circle</span> Leads dianalisis otomatis</li>
                                <li class="flex items-center gap-2 text-sm text-neutral-700"><span class="material-symbols-outlined text-green-500 text-base">check_circle</span> Prospek dikategorikan berdasarkan kualitas</li>
                                <li class="flex items-center gap-2 text-sm text-neutral-700"><span class="material-symbols-outlined text-green-500 text-base">check_circle</span> Follow-up dikirim otomatis</li>
                                <li class="flex items-center gap-2 text-sm text-neutral-700"><span class="material-symbols-outlined text-green-500 text-base">check_circle</span> Data masuk ke CRM secara real-time</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-neutral-200 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="bg-gradient-to-br from-blue-500 to-violet-600 p-6">
                        <span class="material-symbols-outlined text-white text-4xl">headset_mic</span>
                        <h3 class="text-xl font-semibold text-white mt-3">Customer Support Agent</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <p class="text-neutral-600 text-sm">Bisnis e-commerce menerima ribuan pertanyaan pelanggan setiap bulan dengan tim yang terbatas.</p>
                        <div class="space-y-2">
                            <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wide">Setelah Implementasi</p>
                            <ul class="space-y-1.5">
                                <li class="flex items-center gap-2 text-sm text-neutral-700"><span class="material-symbols-outlined text-green-500 text-base">check_circle</span> Menjawab pertanyaan umum otomatis</li>
                                <li class="flex items-center gap-2 text-sm text-neutral-700"><span class="material-symbols-outlined text-green-500 text-base">check_circle</span> Mengecek status pesanan</li>
                                <li class="flex items-center gap-2 text-sm text-neutral-700"><span class="material-symbols-outlined text-green-500 text-base">check_circle</span> Membantu proses retur</li>
                                <li class="flex items-center gap-2 text-sm text-neutral-700"><span class="material-symbols-outlined text-green-500 text-base">check_circle</span> Membuat tiket support otomatis</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-neutral-200 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="bg-gradient-to-br from-violet-500 to-rose-500 p-6">
                        <span class="material-symbols-outlined text-white text-4xl">menu_book</span>
                        <h3 class="text-xl font-semibold text-white mt-3">Internal Knowledge Agent</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <p class="text-neutral-600 text-sm">Perusahaan memiliki ratusan SOP dan dokumen internal yang sulit diakses tim.</p>
                        <div class="space-y-2">
                            <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wide">Setelah Implementasi</p>
                            <ul class="space-y-1.5">
                                <li class="flex items-center gap-2 text-sm text-neutral-700"><span class="material-symbols-outlined text-green-500 text-base">check_circle</span> Membaca seluruh knowledge base</li>
                                <li class="flex items-center gap-2 text-sm text-neutral-700"><span class="material-symbols-outlined text-green-500 text-base">check_circle</span> Menjawab pertanyaan karyawan instan</li>
                                <li class="flex items-center gap-2 text-sm text-neutral-700"><span class="material-symbols-outlined text-green-500 text-base">check_circle</span> Menampilkan dokumen relevan</li>
                                <li class="flex items-center gap-2 text-sm text-neutral-700"><span class="material-symbols-outlined text-green-500 text-base">check_circle</span> Memberikan panduan operasional</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-8 mt-12">
            <img src="{{ asset('assets/image/qh3r98h293hr23.png') }}" alt="" class="w-full">
        </div>
    </section>

    {{-- How We Build --}}
    <section class="py-20 md:py-24 border-b border-neutral-200 bg-white">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-semibold tracking-tighter text-neutral-900 mb-4">Bagaimana AI Agent Bekerja?</h2>
                <p class="text-lg text-neutral-600 max-w-2xl mx-auto">Proses pengembangan yang terstruktur untuk memastikan AI Agent berfungsi sesuai kebutuhan bisnis Anda.</p>
            </div>
            <div class="max-w-7xl mx-auto px-8">
                <img src="{{ asset('assets/image/wh23r23.png') }}" alt="" class="w-full">
            </div>
        </div>
    </section>

    {{-- What You Get --}}
    <section class="py-20 md:py-24 border-b border-neutral-200 bg-white">
        <div class="max-w-7xl mx-auto px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl font-semibold tracking-tighter text-neutral-900 mb-4">Yang Anda Dapatkan</h2>
                    <p class="text-lg text-neutral-600 mb-8 leading-relaxed">Paket layanan AI Agents yang komprehensif dari strategi hingga implementasi dan monitoring berkelanjutan.</p>
                    <div class="space-y-3">
                        @foreach ([
                            'AI Agent Strategy', 'Workflow Assessment', 'Custom AI Agent Development',
                            'Multi-System Integration', 'Knowledge Base Integration',
                            'Testing & Deployment', 'Performance Monitoring', 'Ongoing Optimization'
                        ] as $item)
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-primary-600 text-sm">check</span>
                            </div>
                            <span class="text-neutral-800 font-medium">{{ $item }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="bg-gradient-to-br from-primary-50 via-blue-50 to-white rounded-3xl p-8 border border-primary-100">
                    <div class="text-center mb-6">
                        <p class="text-sm font-semibold text-neutral-500 uppercase tracking-widest mb-2">Mulai Sekarang</p>
                        <p class="text-2xl font-semibold text-neutral-900 tracking-tight">Siap Mendeploy AI Agents?</p>
                        <p class="text-neutral-600 mt-2">Konsultasikan kebutuhan spesifik bisnis Anda bersama tim kami.</p>
                    </div>
                    <a href="{{ route('service.consult') }}" class="flex items-center justify-center gap-2 w-full py-3.5 px-6 bg-primary-500 hover:bg-primary-600 text-white font-medium rounded-xl transition-all shadow-sm">
                        <span class="material-symbols-outlined text-base">calendar_month</span>
                        Jadwalkan Konsultasi Gratis
                    </a>
                    <p class="text-center text-xs text-neutral-500 mt-4">Tidak ada komitmen. Diskusi awal sepenuhnya gratis.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Banner --}}
    <section class="py-20 bg-primary-500 text-white text-center">
        <div class="max-w-3xl mx-auto px-8">
            <h2 class="text-3xl md:text-4xl font-medium tracking-tighter mb-4 leading-tight">"Dengan AI Agents yang tepat, tim Anda bisa fokus pada hal yang paling penting."</h2>
            <p class="text-primary-100 mb-8 text-lg">Biarkan AI menangani pekerjaan repetitif sementara tim Anda fokus pada inovasi dan strategi.</p>
            <a href="{{ route('service.consult') }}" class="inline-flex items-center gap-2 py-4 px-8 rounded-full bg-white hover:bg-neutral-100 transition text-primary-600 font-semibold shadow-lg">
                <span class="material-symbols-outlined">arrow_forward</span>
                Mulai Konsultasi
            </a>
        </div>
    </section>

    {{-- FAQ --}}
    <section id="faq" class="py-20 bg-white border-t border-neutral-200">
        <div class="max-w-7xl mx-auto px-8">
            <div class="max-w-3xl mx-auto text-center mb-12">
                <h2 class="text-3xl font-semibold text-neutral-900 mb-4">Pertanyaan Umum (FAQ)</h2>
                <p class="text-neutral-600">Jawaban atas pertanyaan yang paling sering kami terima seputar layanan AI Agents.</p>
            </div>
            <div x-data="{open: null}" class="space-y-4 max-w-3xl mx-auto">
                @foreach ([
                    ['q' => 'Apa perbedaan AI Agent dengan AI Chatbot?', 'a' => 'AI Chatbot umumnya hanya menjawab pertanyaan berdasarkan informasi yang tersedia. AI Agent tidak hanya memahami dan menjawab, tetapi juga dapat mengambil tindakan seperti membuat laporan, mengirim email, memperbarui CRM, atau menjalankan workflow bisnis.'],
                    ['q' => 'Apakah AI Agent bisa terhubung dengan sistem yang sudah kami gunakan?', 'a' => 'Ya. AI Agent dapat diintegrasikan dengan berbagai platform seperti CRM, ERP, WhatsApp Business, email, database, Google Workspace, Microsoft 365, dan sistem internal perusahaan.'],
                    ['q' => 'Apakah AI Agent bisa menggantikan karyawan?', 'a' => 'Tujuan AI Agent bukan menggantikan manusia, melainkan mengurangi pekerjaan repetitif sehingga tim dapat fokus pada aktivitas yang membutuhkan analisis, kreativitas, dan pengambilan keputusan strategis.'],
                    ['q' => 'Berapa lama implementasi AI Agent?', 'a' => 'Waktu implementasi bergantung pada kompleksitas kebutuhan dan integrasi sistem. Sebagian besar proyek dapat diselesaikan dalam beberapa minggu hingga beberapa bulan.'],
                    ['q' => 'Apakah AI Agent aman untuk data perusahaan?', 'a' => 'Ya. Implementasi dilakukan dengan memperhatikan keamanan data, kontrol akses, dan kebutuhan kepatuhan perusahaan untuk memastikan informasi tetap terlindungi.'],
                    ['q' => 'Bisakah AI Agent bekerja 24/7?', 'a' => 'Ya. AI Agent dapat beroperasi tanpa henti dan memberikan respons secara konsisten kapan pun dibutuhkan.'],
                ] as $i => $item)
                <div class="border border-neutral-200 rounded-xl overflow-hidden">
                    <button @click="open === {{ $i }} ? open = null : open = {{ $i }}" class="w-full text-left px-6 py-4 flex justify-between items-center gap-4 hover:bg-neutral-50 transition-colors">
                        <span class="font-medium text-neutral-900">{{ $item['q'] }}</span>
                        <span class="material-symbols-outlined text-neutral-400 flex-shrink-0 transition-transform duration-200" :class="open === {{ $i }} ? 'rotate-45' : ''">add</span>
                    </button>
                    <div x-show="open === {{ $i }}" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="px-6 pb-5 text-neutral-600 leading-relaxed border-t border-neutral-100">
                        <div class="pt-4">{{ $item['a'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

</div>
@endsection
