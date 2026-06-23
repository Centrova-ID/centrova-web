@extends('partials.layouts.main')

@section('title', 'AI Automation - Otomatisasi Proses Bisnis dengan Kecerdasan Buatan | Centrova')

@section('seoMetaTags')
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta name="robots" content="index, follow, max-image-preview:large"/>
    <meta name="description" content="AI Automation dari Centrova membantu bisnis menghilangkan pekerjaan manual repetitif dengan menggabungkan AI, workflow automation, dan integrasi sistem — lebih cepat, konsisten, dan scalable."/>
    <meta name="keywords" content="AI Automation, otomatisasi bisnis, workflow automation Indonesia, business process automation, RPA, integrasi sistem Jakarta"/>
    <meta name="language" content="id"/>
    <meta name="geo.region" content="ID-JK"/>
    <meta name="geo.placename" content="Jakarta, Indonesia"/>
    <meta property="og:title" content="AI Automation - Otomatisasi Proses Bisnis | Centrova"/>
    <meta property="og:description" content="Automate repetitive work. Scale operations faster. Centrova membantu merancang sistem otomatis yang mengurangi pekerjaan manual dan mempercepat proses operasional."/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ url('/services/ai/ai-automation') }}"/>
    <meta property="og:site_name" content="Centrova"/>
    <meta property="og:locale" content="id_ID"/>
    <meta property="og:image" content="{{ config('app.url') }}/thumbnail.png"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:title" content="AI Automation | Centrova"/>
    <meta name="twitter:description" content="Otomatisasi pekerjaan repetitif bisnis Anda dengan AI — lebih cepat, lebih akurat, lebih scalable."/>
    <meta name="twitter:image" content="{{ config('app.url') }}/thumbnail.png"/>
    <link rel="canonical" href="{{ url('/services/ai/ai-automation') }}"/>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Service",
        "name": "AI Automation",
        "description": "Layanan AI Automation untuk mengotomatisasi proses bisnis repetitif dengan integrasi AI, workflow automation, dan multi-system integration.",
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
                "name": "Apa perbedaan AI Automation dan AI Agent?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "AI Automation berfokus pada mengotomatisasi workflow dan proses bisnis yang berulang. AI Agent berfungsi sebagai pekerja digital yang dapat memahami konteks, mengambil keputusan, dan menjalankan tugas secara mandiri."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah AI Automation hanya untuk perusahaan besar?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Tidak. Banyak UKM hingga perusahaan enterprise dapat memperoleh manfaat dari AI Automation, terutama untuk mengurangi pekerjaan administratif dan meningkatkan efisiensi operasional."
                }
            },
            {
                "@type": "Question",
                "name": "Sistem apa saja yang bisa diintegrasikan?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "AI Automation dapat dihubungkan dengan CRM, ERP, website, WhatsApp Business, email, database, Google Workspace, Microsoft 365, dan berbagai platform bisnis lainnya."
                }
            },
            {
                "@type": "Question",
                "name": "Berapa lama implementasi AI Automation?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Durasi implementasi bergantung pada kompleksitas workflow dan integrasi sistem. Umumnya proyek dapat berjalan mulai dari beberapa minggu hingga beberapa bulan."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah AI Automation bisa menggantikan karyawan?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Tujuan AI Automation bukan menggantikan manusia, tetapi menghilangkan pekerjaan repetitif sehingga tim dapat fokus pada aktivitas yang membutuhkan kreativitas, strategi, dan pengambilan keputusan."
                }
            },
            {
                "@type": "Question",
                "name": "Bagaimana mengukur keberhasilan AI Automation?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Keberhasilan biasanya diukur melalui pengurangan waktu proses, efisiensi operasional, peningkatan produktivitas, pengurangan error, dan penghematan biaya operasional."
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
            <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-700 text-sm font-medium px-4 py-1.5 rounded-full mb-6 w-fit">
                <span class="material-symbols-outlined text-sm">bolt</span>
                AI Automation
            </div>
            <h1 class="text-4xl md:text-6xl font-semibold tracking-tighter mb-6 text-neutral-900 leading-tight">
                Automate Repetitive Work.<br class="hidden md:block"/> Scale Operations Faster.
            </h1>
            <p class="text-lg w-full max-w-2xl text-neutral-600 tracking-tight mb-8 leading-relaxed">
                Centrova membantu perusahaan merancang dan membangun sistem otomatis yang mengurangi pekerjaan manual, mempercepat proses operasional, meningkatkan akurasi data, dan memungkinkan tim fokus pada pekerjaan yang benar-benar bernilai.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('service.consult') }}" class="inline-flex items-center justify-center gap-2 py-3.5 px-7 rounded-full bg-primary-500 hover:bg-primary-600 transition-all text-white font-medium shadow-sm">
                    <span class="material-symbols-outlined text-base">calendar_month</span>
                    Jadwalkan Konsultasi
                </a>
                <a href="#solutions" class="inline-flex items-center justify-center gap-2 py-3.5 px-7 rounded-full border border-neutral-300 hover:border-neutral-400 hover:bg-neutral-50 transition-all text-neutral-800 font-medium">
                    <span class="material-symbols-outlined text-base">explore</span>
                    Lihat Solusi Kami
                </a>
            </div>
        </div>
        <div class="w-full flex justify-center">
            <div class="relative w-full max-w-md">
                <div class="bg-gradient-to-br from-blue-50 to-primary-50 rounded-3xl p-8 border border-blue-100 space-y-3">
                    {{-- Animated flow visualization --}}
                    <div class="flex items-center gap-3 bg-white rounded-2xl px-4 py-3 shadow-sm">
                        <span class="material-symbols-outlined text-blue-500">input</span>
                        <div class="flex-1">
                            <p class="text-xs font-semibold text-neutral-700">Lead masuk dari website</p>
                        </div>
                        <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full font-medium">Trigger</span>
                    </div>
                    <div class="flex justify-center">
                        <span class="material-symbols-outlined text-neutral-300">arrow_downward</span>
                    </div>
                    <div class="flex items-center gap-3 bg-white rounded-2xl px-4 py-3 shadow-sm">
                        <span class="material-symbols-outlined text-primary-500">psychology</span>
                        <div class="flex-1">
                            <p class="text-xs font-semibold text-neutral-700">AI menganalisis kualitas lead</p>
                        </div>
                        <span class="text-xs bg-primary-100 text-primary-700 px-2 py-0.5 rounded-full font-medium">AI</span>
                    </div>
                    <div class="flex justify-center">
                        <span class="material-symbols-outlined text-neutral-300">arrow_downward</span>
                    </div>
                    <div class="flex items-center gap-3 bg-white rounded-2xl px-4 py-3 shadow-sm">
                        <span class="material-symbols-outlined text-green-500">send</span>
                        <div class="flex-1">
                            <p class="text-xs font-semibold text-neutral-700">Follow-up email terkirim otomatis</p>
                        </div>
                        <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-medium">Action</span>
                    </div>
                    <div class="flex justify-center">
                        <span class="material-symbols-outlined text-neutral-300">arrow_downward</span>
                    </div>
                    <div class="flex items-center gap-3 bg-white rounded-2xl px-4 py-3 shadow-sm">
                        <span class="material-symbols-outlined text-violet-500">dashboard</span>
                        <div class="flex-1">
                            <p class="text-xs font-semibold text-neutral-700">Dashboard diperbarui real-time</p>
                        </div>
                        <span class="text-xs bg-violet-100 text-violet-700 px-2 py-0.5 rounded-full font-medium">Update</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="bg-gray-50">

    {{-- What is AI Automation --}}
    <section class="py-20 md:py-24 border-b border-neutral-200 bg-white">
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <div class="lg:col-span-5 lg:sticky lg:top-32">
                <h2 class="text-4xl font-semibold tracking-tighter text-neutral-900 mb-4">Apa Itu AI Automation?</h2>
                <p class="text-lg text-neutral-700 leading-relaxed">Menggunakan Artificial Intelligence untuk menjalankan proses bisnis secara otomatis tanpa intervensi manual terus-menerus.</p>
            </div>
            <div class="lg:col-span-7 space-y-6">
                <p class="text-lg text-neutral-700 leading-relaxed">
                    AI Automation adalah penggunaan Artificial Intelligence untuk menjalankan proses bisnis secara otomatis tanpa perlu intervensi manusia secara terus-menerus.
                </p>
                <p class="text-lg text-neutral-700 leading-relaxed">
                    Berbeda dengan automation tradisional yang hanya mengikuti aturan tetap, AI Automation mampu memahami data, mengenali pola, menganalisis informasi, dan mengambil tindakan berdasarkan konteks yang diberikan.
                </p>
                <div class="p-5 bg-blue-50 border border-blue-100 rounded-2xl">
                    <p class="text-sm font-semibold text-neutral-500 uppercase tracking-wide mb-3">Contoh Alur Otomatis</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        @foreach ([
                            'Lead masuk dari website', 'AI menganalisis kualitas lead',
                            'Data otomatis masuk CRM', 'Email follow-up terkirim otomatis',
                            'Tim sales menerima notifikasi prioritas', 'Dashboard diperbarui secara real-time',
                        ] as $step)
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-500 text-base">check_circle</span>
                            <span class="text-sm text-neutral-700">{{ $step }}</span>
                        </div>
                        @endforeach
                    </div>
                    <p class="text-sm font-semibold text-neutral-800 mt-4">Semua proses tersebut berjalan tanpa pekerjaan manual.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Why Businesses Need It --}}
    <section class="py-20 md:py-24 border-b border-neutral-200 bg-white">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-semibold tracking-tighter text-neutral-900 mb-4">Mengapa Bisnis Membutuhkan AI Automation?</h2>
                <p class="text-lg text-neutral-600 max-w-2xl mx-auto">Banyak proses bisnis yang terlihat sederhana ternyata menghabiskan biaya operasional yang besar.</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="rounded-xl border border-red-100 bg-red-50 p-6">
                    <p class="text-sm font-semibold text-red-600 uppercase tracking-wide mb-4">Masalah yang sering ditemukan</p>
                    <div class="space-y-3">
                        @foreach ([
                            'Input data berulang', 'Follow-up pelanggan yang terlambat', 'Proses approval yang lambat',
                            'Human error dalam pengolahan data', 'Laporan yang membutuhkan waktu lama',
                            'Tim menghabiskan waktu untuk pekerjaan administratif',
                        ] as $problem)
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-red-400 text-base">cancel</span>
                            <span class="text-neutral-700">{{ $problem }}</span>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-5 pt-5 border-t border-red-200">
                        <p class="text-sm text-red-700 font-medium">Akibatnya produktivitas menurun dan pertumbuhan bisnis menjadi terhambat.</p>
                    </div>
                </div>
                <div class="rounded-xl border border-green-100 bg-green-50 p-6">
                    <p class="text-sm font-semibold text-green-600 uppercase tracking-wide mb-4">Dengan AI Automation</p>
                    <div class="space-y-3">
                        @foreach ([
                            'Proses berjalan otomatis tanpa input manual', 'Follow-up terkirim tepat waktu setiap saat',
                            'Approval dipercepat dengan workflow cerdas', 'Data diproses akurat dan konsisten',
                            'Laporan dihasilkan otomatis real-time', 'Tim fokus pada pekerjaan strategis',
                        ] as $solution)
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-green-500 text-base">check_circle</span>
                            <span class="text-neutral-700">{{ $solution }}</span>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-5 pt-5 border-t border-green-200">
                        <p class="text-sm text-green-700 font-medium">Ciptakan proses kerja yang lebih cepat, konsisten, dan scalable.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Who Needs It --}}
    <section class="py-20 md:py-24 border-b border-neutral-200 bg-white">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-semibold tracking-tighter text-neutral-900 mb-4">Siapa yang Membutuhkan AI Automation?</h2>
                <p class="text-lg text-neutral-600 max-w-2xl mx-auto">AI Automation dapat diterapkan pada berbagai tim dan fungsi di seluruh organisasi.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" x-data="{tab: 'sales'}">
                @foreach ([
                    ['key' => 'sales', 'icon' => 'trending_up', 'color' => 'primary', 'title' => 'Sales Team', 'items' => ['Lead qualification otomatis', 'Follow-up otomatis', 'CRM automation', 'Sales reporting']],
                    ['key' => 'cs', 'icon' => 'headset_mic', 'color' => 'blue', 'title' => 'Customer Service', 'items' => ['Ticket routing otomatis', 'AI response assistant', 'FAQ automation', 'Customer onboarding']],
                    ['key' => 'marketing', 'icon' => 'campaign', 'color' => 'violet', 'title' => 'Marketing Team', 'items' => ['Lead nurturing', 'Email automation', 'Content workflow', 'Campaign reporting']],
                    ['key' => 'hr', 'icon' => 'groups', 'color' => 'amber', 'title' => 'Human Resources', 'items' => ['Candidate screening', 'Employee onboarding', 'Leave management', 'Internal knowledge assistant']],
                    ['key' => 'ops', 'icon' => 'settings_applications', 'color' => 'green', 'title' => 'Operations Team', 'items' => ['Workflow approval', 'Data processing', 'Inventory monitoring', 'Reporting automation']],
                    ['key' => 'finance', 'icon' => 'account_balance', 'color' => 'rose', 'title' => 'Finance Team', 'items' => ['Invoice processing', 'Expense management', 'Financial reporting', 'Budget monitoring']],
                ] as $team)
                <div class="rounded-xl border border-neutral-200 bg-white p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="w-12 h-12 bg-{{ $team['color'] }}-50 rounded-xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-{{ $team['color'] }}-600">{{ $team['icon'] }}</span>
                    </div>
                    <h3 class="text-lg font-semibold text-neutral-900 mb-3">{{ $team['title'] }}</h3>
                    <ul class="space-y-2">
                        @foreach ($team['items'] as $item)
                        <li class="flex items-center gap-2 text-sm text-neutral-600">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary-400 flex-shrink-0"></span>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- How It Works --}}
    <section class="py-20 md:py-24 border-b border-neutral-200 bg-white">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-semibold tracking-tighter text-neutral-900 mb-4">Bagaimana AI Automation Bekerja?</h2>
                <p class="text-lg text-neutral-600 max-w-2xl mx-auto">Lima tahap proses yang berjalan secara otomatis untuk mengubah data menjadi tindakan nyata.</p>
            </div>
            <div class="relative">
                <div class="hidden lg:block absolute top-8 left-0 right-0 h-0.5 bg-neutral-100 z-0"></div>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 relative z-10">
                    @foreach ([
                        ['step' => '1', 'icon' => 'download', 'title' => 'Data Collection', 'desc' => 'AI menerima data dari website, CRM, ERP, email, WhatsApp, dan database.'],
                        ['step' => '2', 'icon' => 'psychology', 'title' => 'Data Understanding', 'desc' => 'Membaca, memahami, dan mengekstrak informasi penting dari data yang masuk.'],
                        ['step' => '3', 'icon' => 'rule', 'title' => 'Decision Making', 'desc' => 'Berdasarkan aturan dan konteks bisnis, AI menentukan tindakan yang harus dilakukan.'],
                        ['step' => '4', 'icon' => 'play_circle', 'title' => 'Workflow Execution', 'desc' => 'Mengirim email, membuat task, memperbarui database, notifikasi, dan laporan.'],
                        ['step' => '5', 'icon' => 'autorenew', 'title' => 'Continuous Improvement', 'desc' => 'Workflow terus disempurnakan berdasarkan data dan performa yang dihasilkan.'],
                    ] as $item)
                    <div class="flex flex-col items-center text-center p-4">
                        <div class="w-14 h-14 bg-primary-500 rounded-2xl flex items-center justify-center mb-4 shadow-md shadow-primary-200">
                            <span class="material-symbols-outlined text-white text-2xl">{{ $item['icon'] }}</span>
                        </div>
                        <p class="text-xs font-bold text-primary-500 mb-1">STEP {{ $item['step'] }}</p>
                        <h3 class="font-semibold text-neutral-900 mb-2">{{ $item['title'] }}</h3>
                        <p class="text-neutral-600 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Solutions --}}
    <section id="solutions" class="py-20 md:py-24 border-b border-neutral-200 bg-white">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-semibold tracking-tighter text-neutral-900 mb-4">Yang Kami Kerjakan</h2>
                <p class="text-lg text-neutral-600 max-w-2xl mx-auto">Solusi AI Automation yang kami rancang untuk berbagai kebutuhan bisnis.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ([
                    ['icon' => 'account_tree', 'title' => 'Workflow Automation', 'desc' => 'Mengotomatisasi proses bisnis lintas departemen untuk mengurangi pekerjaan manual dan meningkatkan efisiensi.'],
                    ['icon' => 'psychology', 'title' => 'AI-Powered Business Process', 'desc' => 'Mengintegrasikan AI ke dalam alur kerja operasional agar sistem mampu memahami dan memproses informasi secara cerdas.'],
                    ['icon' => 'trending_up', 'title' => 'CRM & Sales Automation', 'desc' => 'Mengelola lead, follow-up, scoring, dan pipeline sales secara otomatis tanpa intervensi tim.'],
                    ['icon' => 'headset_mic', 'title' => 'Customer Support Automation', 'desc' => 'Meningkatkan kecepatan respons pelanggan dengan workflow berbasis AI yang cerdas dan konsisten.'],
                    ['icon' => 'description', 'title' => 'Document Processing Automation', 'desc' => 'Membaca, mengklasifikasikan, dan mengekstrak data dari dokumen secara otomatis dengan akurasi tinggi.'],
                    ['icon' => 'analytics', 'title' => 'Reporting Automation', 'desc' => 'Menghasilkan laporan bisnis secara otomatis dan real-time tanpa perlu pekerjaan manual dari tim.'],
                    ['icon' => 'hub', 'title' => 'Multi-System Integration', 'desc' => 'Menghubungkan berbagai aplikasi dan platform menjadi satu workflow yang terintegrasi dan terpusat.'],
                ] as $item)
                <div class="rounded-xl border border-neutral-200 bg-white p-6 hover:shadow-md hover:shadow-black/10 transition-shadow duration-200">
                    <div class="w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-blue-600">{{ $item['icon'] }}</span>
                    </div>
                    <h3 class="font-semibold text-neutral-900 mb-2">{{ $item['title'] }}</h3>
                    <p class="text-neutral-600 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Use Cases --}}
    <section class="py-20 md:py-24 border-b border-neutral-200 bg-white">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-semibold tracking-tighter text-neutral-900 mb-4">Studi Kasus Nyata</h2>
                <p class="text-lg text-neutral-600 max-w-2xl mx-auto">Bagaimana AI Automation mengubah operasional bisnis di berbagai industri.</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                @foreach ([
                    [
                        'gradient' => 'from-primary-500 to-blue-600', 'icon' => 'trending_up',
                        'title' => 'Lead Management Automation',
                        'problem' => 'Perusahaan menerima lebih dari 300 lead setiap minggu dengan input manual yang lambat dan banyak lead terlewat.',
                        'results' => ['Lead masuk otomatis ke CRM', 'AI melakukan lead scoring', 'Sales menerima prioritas follow-up', 'Email otomatis terkirim'],
                        'outcomes' => ['Waktu respons lebih cepat', 'Conversion rate meningkat', 'Beban administratif berkurang'],
                    ],
                    [
                        'gradient' => 'from-blue-500 to-violet-600', 'icon' => 'description',
                        'title' => 'Invoice Processing Automation',
                        'problem' => 'Tim finance harus memproses ratusan invoice setiap bulan secara manual dengan risiko kesalahan tinggi.',
                        'results' => ['AI membaca invoice otomatis', 'Mengekstrak informasi penting', 'Memvalidasi data', 'Data masuk sistem otomatis'],
                        'outcomes' => ['Proses lebih cepat', 'Akurasi meningkat', 'Efisiensi operasional lebih tinggi'],
                    ],
                    [
                        'gradient' => 'from-violet-500 to-rose-500', 'icon' => 'headset_mic',
                        'title' => 'Customer Service Automation',
                        'problem' => 'Perusahaan menerima ribuan pertanyaan pelanggan setiap bulan dengan SLA yang sulit dipenuhi.',
                        'results' => ['AI mengklasifikasikan tiket', 'Routing otomatis ke tim terkait', 'Respon awal otomatis', 'Escalation management otomatis'],
                        'outcomes' => ['SLA meningkat', 'Waktu respons menurun', 'Kepuasan pelanggan meningkat'],
                    ],
                ] as $case)
                <div class="bg-white rounded-xl border border-neutral-200 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="bg-gradient-to-br {{ $case['gradient'] }} p-6">
                        <span class="material-symbols-outlined text-white text-4xl">{{ $case['icon'] }}</span>
                        <h3 class="text-xl font-semibold text-white mt-3">{{ $case['title'] }}</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <p class="text-neutral-600 text-sm">{{ $case['problem'] }}</p>
                        <div>
                            <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wide mb-2">Setelah Implementasi</p>
                            <ul class="space-y-1.5">
                                @foreach ($case['results'] as $r)
                                <li class="flex items-center gap-2 text-sm text-neutral-700">
                                    <span class="material-symbols-outlined text-green-500 text-base">check_circle</span>
                                    {{ $r }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="pt-3 border-t border-neutral-100">
                            <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wide mb-2">Hasil</p>
                            <ul class="space-y-1">
                                @foreach ($case['outcomes'] as $o)
                                <li class="flex items-center gap-2 text-sm font-medium text-neutral-800">
                                    <span class="material-symbols-outlined text-primary-500 text-base">arrow_upward</span>
                                    {{ $o }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Why Centrova --}}
    <section class="py-20 md:py-24 border-b border-neutral-200 bg-white">
        <div class="max-w-7xl mx-auto px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl font-semibold tracking-tighter text-neutral-900 mb-4">Mengapa Centrova?</h2>
                    <p class="text-lg text-neutral-600 mb-8 leading-relaxed">
                        Centrova tidak hanya membangun workflow automation. Kami merancang solusi yang selaras dengan proses bisnis, sistem yang sudah digunakan perusahaan, serta target pertumbuhan jangka panjang.
                    </p>
                    <div class="space-y-4">
                        @foreach ([
                            ['icon' => 'search', 'title' => 'Process Analysis', 'desc' => 'Memahami proses bisnis secara mendalam sebelum merancang solusi.'],
                            ['icon' => 'account_tree', 'title' => 'Workflow Design', 'desc' => 'Merancang alur kerja yang optimal dan selaras dengan kebutuhan tim.'],
                            ['icon' => 'psychology', 'title' => 'AI Integration', 'desc' => 'Mengintegrasikan kemampuan AI yang tepat ke dalam setiap workflow.'],
                            ['icon' => 'hub', 'title' => 'System Integration', 'desc' => 'Menghubungkan semua platform yang sudah digunakan bisnis Anda.'],
                            ['icon' => 'monitoring', 'title' => 'Monitoring & Optimization', 'desc' => 'Pemantauan berkelanjutan dan peningkatan performa secara rutin.'],
                        ] as $item)
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-primary-50 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5">
                                <span class="material-symbols-outlined text-primary-600 text-base">{{ $item['icon'] }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-neutral-900">{{ $item['title'] }}</p>
                                <p class="text-neutral-600 text-sm">{{ $item['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="bg-gradient-to-br from-blue-50 via-primary-50 to-white rounded-3xl p-8 border border-blue-100">
                    <p class="text-2xl font-semibold text-neutral-900 tracking-tight mb-3 text-center">Siap Mengotomatisasi Bisnis Anda?</p>
                    <p class="text-neutral-600 text-center mb-6">Konsultasikan workflow mana yang paling perlu diotomatisasi bersama tim ahli kami.</p>
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
            <h2 class="text-3xl md:text-4xl font-medium tracking-tighter mb-4 leading-tight">"Tujuannya bukan sekadar membuat proses otomatis, tetapi menciptakan operasi bisnis yang lebih efisien, scalable, dan siap menghadapi pertumbuhan."</h2>
            <p class="text-primary-100 mb-8 text-lg">— Pendekatan Centrova dalam AI Automation</p>
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
                <p class="text-neutral-600">Jawaban atas pertanyaan yang paling sering kami terima seputar layanan AI Automation.</p>
            </div>
            <div x-data="{open: null}" class="space-y-4 max-w-3xl mx-auto">
                @foreach ([
                    ['q' => 'Apa perbedaan AI Automation dan AI Agent?', 'a' => 'AI Automation berfokus pada mengotomatisasi workflow dan proses bisnis yang berulang. AI Agent berfungsi sebagai pekerja digital yang dapat memahami konteks, mengambil keputusan, dan menjalankan tugas secara mandiri.'],
                    ['q' => 'Apakah AI Automation hanya untuk perusahaan besar?', 'a' => 'Tidak. Banyak UKM hingga perusahaan enterprise dapat memperoleh manfaat dari AI Automation, terutama untuk mengurangi pekerjaan administratif dan meningkatkan efisiensi operasional.'],
                    ['q' => 'Sistem apa saja yang bisa diintegrasikan?', 'a' => 'AI Automation dapat dihubungkan dengan CRM, ERP, website, WhatsApp Business, email, database, Google Workspace, Microsoft 365, dan berbagai platform bisnis lainnya.'],
                    ['q' => 'Berapa lama implementasi AI Automation?', 'a' => 'Durasi implementasi bergantung pada kompleksitas workflow dan integrasi sistem. Umumnya proyek dapat berjalan mulai dari beberapa minggu hingga beberapa bulan.'],
                    ['q' => 'Apakah AI Automation bisa menggantikan karyawan?', 'a' => 'Tujuan AI Automation bukan menggantikan manusia, tetapi menghilangkan pekerjaan repetitif sehingga tim dapat fokus pada aktivitas yang membutuhkan kreativitas, strategi, dan pengambilan keputusan.'],
                    ['q' => 'Bagaimana mengukur keberhasilan AI Automation?', 'a' => 'Keberhasilan biasanya diukur melalui pengurangan waktu proses, efisiensi operasional, peningkatan produktivitas, pengurangan error, dan penghematan biaya operasional.'],
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
