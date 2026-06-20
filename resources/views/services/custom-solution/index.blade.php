{{-- Layout --}}
@extends('partials.layouts.main')

{{-- Title --}}
@section('title', 'Custom Software Solution - Sistem Bisnis Tailor-Made | Centrova')

{{-- Navbar --}}
@section('navbar')
    @include('partials.navbar.services')
    @include('partials.navbar.subnavbar.services', [
        'servicesLinkText' => 'Custom Solution',
        'servicesLinkUrl' => route('services.custom-solution.index'),
        'menuItems' => [
            ['text' => 'Solusi', 'url' => url('#solusi')],
            ['text' => 'Keunggulan', 'url' => url('#keunggulan')],
            ['text' => 'Harga', 'url' => url('#harga')],
            ['text' => 'Konsultasi', 'url' => url('#konsultasi')],
        ],
    ])
@endsection

{{-- SEO & Meta Tags --}}
@section('seoMetaTags')
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta name="robots" content="index, follow, max-image-preview:large"/>
    <meta property="og:description" content="Centrova menyediakan custom software solution untuk bisnis - ERP, CRM, Accounting, HR, Workflow Automation yang disesuaikan 100% dengan kebutuhan Anda!"/>
    <meta name="twitter:site" content="@centrovaid"/>
    <meta property="og:title" content="Custom Software Solution - ERP, CRM, HR System | Centrova"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta property="og:site_name" content="Centrova Indonesia"/>
    <meta property="og:image" content="https://centrova.id/assets/image/services/custom-solution/og-image.jpg"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="https://centrova.id/services/custom-solution"/>
    <meta name="description" content="Jasa pembuatan custom software solution untuk ERP, CRM, Accounting, HR Management, dan Workflow Automation. Solusi bisnis yang tailor-made sesuai kebutuhan perusahaan Anda!"/>
    <link rel="canonical" href="https://centrova.id/services/custom-solution"/>
@endsection

{{-- Critical CSS --}}
@section('style-css')
    <style>
        [x-cloak]{display:none!important}
        .scrollbar-hide{scrollbar-width:none;-ms-overflow-style:none}
        .scrollbar-hide::-webkit-scrollbar{display:none}
        .lazy-bg{background-color:#f3f4f6}
        .list-check{list-style:none;margin:0;padding:0}
        .list-check li{position:relative;padding-left:32px}
        .list-check li::before{content:"";position:absolute;left:4px;top:12px;transform:translateY(-50%);width:15px;height:11px;background-repeat:no-repeat;background-size:15px 11px;background-image:url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='15' height='11' viewBox='0 0 15 11' fill='none'><path d='M13.7319 0.295798C13.639 0.20207 13.5284 0.127675 13.4065 0.0769067C13.2846 0.026138 13.1539 0 13.0219 0C12.8899 0 12.7592 0.026138 12.6373 0.0769067C12.5155 0.127675 12.4049 0.20207 12.3119 0.295798L4.86192 7.7558L1.73192 4.6158C1.6354 4.52256 1.52146 4.44925 1.3966 4.40004C1.27175 4.35084 1.13843 4.32671 1.00424 4.32903C0.870064 4.33135 0.737655 4.36008 0.614576 4.41357C0.491498 4.46706 0.380161 4.54428 0.286922 4.6408C0.193684 4.73732 0.12037 4.85126 0.0711659 4.97612C0.0219619 5.10097 -0.00216855 5.2343 0.000152918 5.36848C0.00247438 5.50266 0.0312022 5.63507 0.0846957 5.75814C0.138189 5.88122 0.215401 5.99256 0.311922 6.0858L4.15192 9.9258C4.24489 10.0195 4.35549 10.0939 4.47735 10.1447C4.59921 10.1955 4.72991 10.2216 4.86192 10.2216C4.99393 10.2216 5.12464 10.1955 5.2465 10.1447C5.36836 10.0939 5.47896 10.0195 5.57192 9.9258L13.7319 1.7658C13.8334 1.67216 13.9144 1.5585 13.9698 1.432C14.0252 1.30551 14.0539 1.1689 14.0539 1.0308C14.0539 0.892697 14.0252 0.756091 13.9698 0.629592C13.9144 0.503092 13.8334 0.389441 13.7319 0.295798Z' fill='%23128AEB'/></svg>");}
    </style>
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="w-full bg-white py-16 pt-32">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="max-w-3xl">
                <h1 class="text-[3.6rem] max-lg:text-[3rem] max-md:text-[2.6rem] leading-snug font-bold mb-6 text-slate-900">Custom Software Solution untuk Bisnis Modern</h1>
                <p class="text-xl max-md:text-lg leading-snug text-neutral-700 mb-6">Solusi software tailor-made yang dirancang khusus untuk kebutuhan bisnis Anda. Dari ERP, CRM, HR Management, hingga Workflow Automation - kami bangun sistem yang benar-benar fit dengan proses bisnis perusahaan Anda.</p>
                <a href="#konsultasi" 
                aria-label="Konsultasi custom software gratis"
                class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 min-h-[44px]">
                    Konsultasi Gratis
                </a>
            </div>
        </div>
    </section>

    <section id="keunggulan" class="w-full bg-neutral-100 py-16">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="max-w-7xl mx-auto text-left mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-3xl font-bold text-neutral-900 mb-3 leading-snug">
                    Mengapa Pilih Custom Solution?
                </h2>
            </div>

            <div class="grid grid-cols-3 max-lg:grid-cols-1 text-slate-900 gap-12">
                <div class="flex flex-col items-start">
                    <h1 class="font-medium text-xl mb-5">100% Sesuai Kebutuhan Bisnis</h1>
                    <p class="text-gray-600 text-lg">Bukan one-size-fits-all. Setiap fitur dan workflow dirancang spesifik untuk proses bisnis perusahaan Anda. Tidak ada fitur yang tidak terpakai atau workflow yang dipaksakan.</p>
                </div>
                <div class="flex flex-col items-start">
                    <h1 class="font-medium text-xl mb-5">Scalable & Future-Proof</h1>
                    <p class="text-gray-600 text-lg">Arsitektur sistem modular yang dapat berkembang seiring pertumbuhan bisnis. Mudah untuk menambah modul, fitur, atau integrasi baru tanpa rebuild dari awal.</p>
                </div>
                <div class="flex flex-col items-start">
                    <h1 class="font-medium text-xl mb-5">Source Code Ownership</h1>
                    <p class="text-gray-600 text-lg">Full ownership atas source code dan database. Bebas dari vendor lock-in dan bisa melanjutkan development sendiri atau dengan developer lain di masa depan.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Separator --}}
    <div class="w-full h-[6px] flex"><div class="w-full bg-[#128AEB] h-full"></div><div class="w-full bg-sky-500 h-full"></div><div class="w-[30%] bg-sky-300 h-full"></div></div>

    {{-- Jenis Custom Solution --}}
    <section id="solusi" class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8 py-16" x-data="customSolutionSection">
        <div class="text-left mb-8">
            <h2 class="text-2xl sm:text-3xl md:text-3xl font-bold text-neutral-900 mb-3 leading-snug">
                Jenis Custom Software yang Kami Kembangkan
            </h2>
            <p class="text-base text-lg text-slate-700 md:max-w-4xl">
                Dari sistem ERP enterprise hingga workflow automation, kami siap membangun solusi yang Anda butuhkan
            </p>
        </div>
        
        <div class="w-full max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <template x-for="(item, idx) in solutions" :key="idx">
                <div class="bg-white rounded-2xl border border-neutral-200 shadow hover:shadow-md transition-all duration-300 p-6">
                    <div class="flex items-start mb-4">
                        <div class="w-12 h-12 bg-[#128AEB]/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x-html="item.icon"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-2" x-text="item.title"></h3>
                    <p class="text-gray-600 text-base" x-text="item.description"></p>
                </div>
            </template>
        </div>

        @push('scripts')
        @once
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('customSolutionSection', () => ({
                    solutions: [
                        {
                            title: 'ERP (Enterprise Resource Planning)',
                            description: 'Sistem terintegrasi untuk mengelola finance, inventory, production, HR, dan sales dalam satu platform. Real-time reporting dan centralized data management.',
                            icon: 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'
                        },
                        {
                            title: 'CRM (Customer Relationship Management)',
                            description: 'Platform manajemen customer dengan sales pipeline tracking, lead scoring, email automation, customer analytics, dan integration dengan marketing tools.',
                            icon: 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'
                        },
                        {
                            title: 'HR Management System (HRMS)',
                            description: 'Sistem HR lengkap dengan employee database, attendance & leave management, payroll calculation, performance appraisal, recruitment, dan training management.',
                            icon: 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'
                        },
                        {
                            title: 'Accounting & Finance System',
                            description: 'Software akuntansi dengan general ledger, accounts payable/receivable, cash flow management, budgeting, tax calculation, dan financial reporting sesuai standar akuntansi.',
                            icon: 'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z'
                        },
                        {
                            title: 'Inventory Management System',
                            description: 'Sistem inventory dengan stock tracking, warehouse management, barcode/RFID integration, reorder automation, supplier management, dan multi-location support.',
                            icon: 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'
                        },
                        {
                            title: 'Workflow Automation & BPM',
                            description: 'Business Process Management system untuk automasi approval workflow, document management, task assignment, SLA monitoring, dan process optimization analytics.',
                            icon: 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15'
                        }
                    ]
                }));
            });
        </script>
        @endonce
        @endpush
    </section>

    {{-- Process Section --}}
    <section class="w-full overflow-hidden py-32 max-md:py-16">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="max-w-4xl mx-auto text-center mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                    Bagaimana Kami Membangun Custom Solution?
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                    Metodologi development yang terstruktur dari requirement analysis hingga deployment & maintenance
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white border border-neutral-200 rounded-2xl p-6 shadow hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-[#128AEB] text-white rounded-full flex items-center justify-center font-semibold text-xl mb-4">1</div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-3">Discovery & Analysis</h3>
                    <p class="text-gray-600 text-base">Business process mapping, requirement gathering, stakeholder interviews, dan feasibility study untuk memahami kebutuhan secara menyeluruh.</p>
                </div>

                <div class="bg-white border border-neutral-200 rounded-2xl p-6 shadow hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-[#128AEB] text-white rounded-full flex items-center justify-center font-semibold text-xl mb-4">2</div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-3">Design & Architecture</h3>
                    <p class="text-gray-600 text-base">System architecture design, database modeling, UI/UX design, dan technical specification documentation dengan approval dari stakeholder.</p>
                </div>

                <div class="bg-white border border-neutral-200 rounded-2xl p-6 shadow hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-[#128AEB] text-white rounded-full flex items-center justify-center font-semibold text-xl mb-4">3</div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-3">Development & Deployment</h3>
                    <p class="text-gray-600 text-base">Agile development dengan sprint iterations, QA testing, user acceptance testing (UAT), deployment, training, dan ongoing support.</p>
                </div>
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- Why Custom vs Off-the-Shelf --}}
    <section class="w-full overflow-hidden py-32 max-md:py-16">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 flex flex-col items-center">
            <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                    Custom Software vs Off-the-Shelf Solution
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                    Kapan Anda butuh custom software dibanding solusi ready-made?
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full">
                <div class="bg-gradient-to-br from-[#128AEB]/5 to-blue-50 border border-[#128AEB]/20 rounded-2xl p-8">
                    <h3 class="text-2xl font-semibold text-slate-900 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Pilih Custom Solution Jika:
                    </h3>
                    <ul class="space-y-3 list-check">
                        <li>Proses bisnis Anda unique dan tidak standard</li>
                        <li>Butuh integrasi dengan sistem legacy existing</li>
                        <li>Compliance & security requirements yang spesifik</li>
                        <li>Scalability dan customization adalah prioritas</li>
                        <li>Mau full control dan ownership atas sistem</li>
                        <li>Long-term investment untuk competitive advantage</li>
                    </ul>
                </div>

                <div class="bg-white border border-neutral-200 rounded-2xl p-8">
                    <h3 class="text-2xl font-semibold text-slate-900 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        Off-the-Shelf Cocok Jika:
                    </h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start"><span class="mr-2">•</span>Proses bisnis standard dan tidak kompleks</li>
                        <li class="flex items-start"><span class="mr-2">•</span>Budget terbatas dan butuh launch cepat</li>
                        <li class="flex items-start"><span class="mr-2">•</span>Bisa adapt workflow ke software existing</li>
                        <li class="flex items-start"><span class="mr-2">•</span>Tidak butuh customization mendalam</li>
                        <li class="flex items-start"><span class="mr-2">•</span>OK dengan subscription model jangka panjang</li>
                        <li class="flex items-start"><span class="mr-2">•</span>Vendor support dan updates penting</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- Paket & Harga --}}
    <section id="harga" x-data="customPricingSection" class="py-32 max-md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-slate-900 mb-4">Estimasi Investasi Custom Software</h2>
                <p class="text-xl text-slate-700 max-w-3xl mx-auto">
                    Harga disesuaikan dengan kompleksitas requirements dan scope project
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <template x-for="(plan, index) in plans" :key="index">
                    <div class="relative bg-white text-slate-900 border border-slate-200 rounded-3xl p-8 hover:shadow-sm transition-all duration-500">
                        <div class="text-center mb-4">
                            <h3 class="text-3xl font-bold mb-4" x-text="plan.name"></h3>
                            <div class="mb-4">
                                <span class="text-3xl font-semibold" x-text="plan.price"></span>
                            </div>
                            <p class="text-slate-600" x-text="plan.description"></p>
                        </div>

                        <button @click="selectPlan(plan)" 
                            class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-semibold px-6 py-2 rounded-full transition flex items-center w-full justify-center text-center mb-8">
                            Konsultasi Project
                        </button>

                        <ul class="space-y-3">
                            <template x-for="feature in plan.features" :key="feature">
                                <li class="flex items-start text-sm">
                                    <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0 text-[#128AEB]" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span x-text="feature"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </template>
            </div>

            <div class="mt-12 bg-blue-50 border border-blue-200 rounded-2xl p-6 text-center">
                <p class="text-slate-700 text-lg mb-2"><strong>Note:</strong> Harga final ditentukan setelah requirement analysis & scope definition.</p>
                <p class="text-slate-600">Kami provide detailed proposal dengan breakdown cost, timeline, dan deliverables yang jelas.</p>
            </div>
        </div>

        @push('scripts')
        @once
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('customPricingSection', () => ({
                    plans: [
                        {
                            name: 'Small Business',
                            price: 'Rp 25-50 Juta',
                            description: 'Sistem untuk UKM dengan fitur core business essentials.',
                            features: [
                                'Single module system (CRM/Inventory/Accounting)',
                                'Up to 20 users',
                                'Web-based application',
                                'Basic reporting & analytics',
                                'Cloud deployment',
                                '3-4 bulan development',
                                '6 bulan support & maintenance',
                                'Training untuk admin & user'
                            ]
                        },
                        {
                            name: 'Mid Corporate',
                            price: 'Rp 50-150 Juta',
                            description: 'Solusi terintegrasi untuk perusahaan menengah dengan multiple departments.',
                            features: [
                                'Multi-module integrated system',
                                'Up to 100 users',
                                'Web + mobile app (optional)',
                                'Advanced reporting & dashboard',
                                'Role-based access control',
                                'API integration dengan sistem lain',
                                '5-8 bulan development',
                                '12 bulan support & maintenance',
                                'Comprehensive training & documentation'
                            ],
                            featured: true
                        },
                        {
                            name: 'Enterprise',
                            price: 'Rp 150+ Juta',
                            description: 'Full enterprise solution dengan kompleksitas tinggi dan high scalability.',
                            features: [
                                'Complete ERP/CRM suite',
                                'Unlimited users',
                                'Web, mobile, desktop apps',
                                'AI/ML integration',
                                'Real-time analytics & BI',
                                'Multi-tenant architecture',
                                'Advanced security & compliance',
                                'Microservices architecture',
                                'DevOps & CI/CD setup',
                                '8-18 bulan development',
                                '24 bulan premium support',
                                'Dedicated technical team'
                            ]
                        }
                    ],
                    selectPlan(plan) {
                        const phoneNumber = '6285817909560';
                        let message = `Halo, saya tertarik dengan paket *${plan.name}* untuk Custom Software Solution.\n\n`;
                        message += `Detail Paket:\n• Estimasi: ${plan.price}\n• Deskripsi: ${plan.description}\n\nMohon informasi lebih lanjut dan requirement analysis. Terima kasih!`;
                        const encodedMessage = encodeURIComponent(message);
                        window.open(`https://wa.me/${phoneNumber}?text=${encodedMessage}`, '_blank');
                    }
                }));
            });
        </script>
        @endonce
        @endpush
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- FAQ --}}
    <section class="py-32 max-md:py-16 bg-neutral-50" x-data="customFaqSection">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-semibold text-slate-900 mb-4">
                    Pertanyaan yang Sering Diajukan
                </h3>
            </div>

            <div>
                <template x-for="(faq, index) in faqs" :key="index">
                    <div class="py-0 border-b border-neutral-300 focus-within:border-b-2 focus-within:border-[#128AEB] transition">
                        <button @click="toggleFaq(index)" class="w-full py-4 text-left flex items-center justify-between focus:z-20 my-0.5 transition-colors gap-2">
                            <span class="font-semibold text-sky-700 text-xl sm:text-2xl leading-snug sm:leading-normal flex-wrap sm:flex-nowrap max-w-[80%]" x-text="faq.question"></span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300 flex-shrink-0" :class="{ 'rotate-180': openFaq === index }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="openFaq === index"
                            x-transition:enter="transition-[max-height] duration-[600ms] ease-in"
                            x-transition:leave="transition-[max-height] duration-[600ms] ease-out"
                            x-transition:enter-start="max-h-0" x-transition:enter-end="max-h-[300px]"
                            x-transition:leave-start="max-h-[300px]" x-transition:leave-end="max-h-0"
                            class="overflow-hidden">
                            <div class="pb-6 pt-2 text-slate-700 text-base sm:text-lg leading-relaxed max-w-full sm:max-w-[90%]" x-text="faq.answer"></div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        @push('scripts')
        @once
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('customFaqSection', () => ({
                    openFaq: null,
                    faqs: [
                        {
                            question: 'Berapa lama waktu development untuk custom software?',
                            answer: 'Timeline bervariasi tergantung kompleksitas: Simple system 3-4 bulan, Mid-level 5-8 bulan, Complex enterprise 8-18 bulan. Kami gunakan Agile methodology dengan sprint delivery setiap 2-3 minggu untuk progress yang terukur.'
                        },
                        {
                            question: 'Apakah saya mendapat source code dan database setelah project selesai?',
                            answer: 'Ya, absolutely! Setelah final payment, Anda mendapat full ownership atas source code, database, documentation, dan semua intellectual property. Tidak ada vendor lock-in - Anda bebas maintain sendiri atau hire developer lain.'
                        },
                        {
                            question: 'Bagaimana kalau requirement berubah di tengah development?',
                            answer: 'Kami anticipate ini dengan Agile approach. Change requests bisa diakomodasi setiap sprint dengan approval dan adjustment timeline/budget jika diperlukan. Kami maintain change log yang transparan untuk tracking scope updates.'
                        },
                        {
                            question: 'Apakah bisa integrasi dengan sistem existing yang sudah ada?',
                            answer: 'Yes, kami berpengalaman integrate dengan berbagai sistem - ERP lama, payment gateway, email service, accounting software, dll. Support REST API, SOAP, database direct connection, file exchange, dan integration methods lainnya.'
                        },
                        {
                            question: 'Bagaimana sistem pembayaran untuk project custom software?',
                            answer: 'Typical payment terms: 30% DP setelah contract, 40% progress payment (bisa split per milestone), 20% setelah UAT approved, 10% setelah deployment & training complete. Negotiable based on project scale.'
                        },
                        {
                            question: 'Apakah include training untuk user dan maintenance setelah launch?',
                            answer: 'Ya, semua paket include user training, admin training, dan documentation. Plus support period (6-24 bulan tergantung paket) untuk bug fixes dan minor updates. Maintenance contract bisa dilanjutkan setelah periode awal.'
                        },
                        {
                            question: 'Teknologi apa yang digunakan untuk development?',
                            answer: 'Kami select tech stack based on requirements - Laravel/Node.js untuk backend, React/Vue untuk frontend, MySQL/PostgreSQL untuk database, AWS/GCP untuk cloud. Prioritas pada teknologi yang mature, well-supported, dan easy to maintain.'
                        }
                    ],
                    toggleFaq(index) {
                        this.openFaq = this.openFaq === index ? null : index;
                    }
                }));
            });
        </script>
        @endonce
        @endpush
    </section>

    {{-- CTA Konsultasi --}}
    <div id="konsultasi" class="text-center py-32 max-md:py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <h3 class="text-2xl sm:text-3xl lg:text-4xl font-semibold text-slate-900 mb-4">
                Konsultasi Gratis Custom Software Solution Anda
            </h3>
            <p class="text-slate-600 text-base sm:text-lg mb-6">
                Diskusikan requirement dan business process Anda. Kami bantu analisis kebutuhan dan berikan estimasi yang detail.
            </p>
            <button onclick="window.open('{{ route('support.web.consult') }}', '_blank')"
                class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-semibold px-6 py-3 rounded-full transition flex items-center justify-center mx-auto">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                Hubungi Kami
            </button>
        </div>
    </div>

    {{-- Quick Links --}}
    <section class="w-full pt-10 bg-neutral-100" x-data="quickLinksSection">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <h1 class="font-semibold text-2xl mb-4">Quick Links</h1>
            <div class="flex justify-start gap-3 items-center w-full border-b border-neutral-300 pb-10 flex-wrap">
                <template x-for="(link, index) in quickLinks" :key="index">
                    <a :href="link.url" :target="link.target || '_self'"
                        class="px-4 py-1 font-normal border border-neutral-700 rounded-full hover:bg-neutral-700 hover:text-white hover:underline transition-colors duration-200"
                        x-text="link.text">
                    </a>
                </template>
            </div>
        </div>

        @push('scripts')
        @once
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('quickLinksSection', () => ({
                    quickLinks: [
                        { text: "Konsultasi Gratis", url: "{{ route('support.web.consult') }}", target: "_blank" },
                        { text: "Pusat Bantuan", url: "{{ route('support.services.home') }}", target: "_self" },
                        { text: "Pembatalan Layanan", url: "{{ route('services.cancellation.index') }}", target: "_self" },
                    ]
                }));
            });
        </script>
        @endonce
        @endpush
    </section>
@endsection
