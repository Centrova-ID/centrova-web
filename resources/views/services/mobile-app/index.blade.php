{{-- Layout --}}
@extends('partials.layouts.main')

{{-- Title --}}
@section('title', 'Jasa Pembuatan Aplikasi Mobile Profesional - Centrova')

{{-- Navbar --}}
@section('navbar')
    @include('partials.navbar.services')
    @include('partials.navbar.subnavbar.services', [
        'servicesLinkText' => 'Mobile App Development',
        'servicesLinkUrl' => route('services.mobile-app-development'),
        'menuItems' => [
            ['text' => 'Layanan', 'url' => url('#layanan')],
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
    <meta property="og:description" content="Centrova menyediakan jasa pembuatan aplikasi mobile Android & iOS profesional. Aplikasi hybrid dan native yang powerful untuk kebutuhan bisnis modern!"/>
    <meta name="twitter:site" content="@centrovaid"/>
    <meta property="og:title" content="Jasa Pembuatan Aplikasi Mobile Android & iOS | Centrova"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta property="og:site_name" content="Centrova"/>
    <meta property="og:image" content="{{ config('app.url') }}/assets/image/services/mobile-app-development/og-image.jpg"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ url('/services/mobile-app-development') }}"/>
    <meta name="description" content="Jasa pembuatan aplikasi mobile iOS & Android profesional dengan teknologi hybrid atau native. Siap publish ke Play Store & App Store!"/>
    <link rel="canonical" href="{{ url('/services/mobile-app-development') }}"/>
@endsection

{{-- Structured Data: Service Schema — SEO untuk halaman jasa --}}
@push('structured-data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Service",
    "@id": "{{ url()->current() }}#service",
    "name": "Jasa Pembuatan Aplikasi Mobile Android & iOS Profesional",
    "description": "Centrova menyediakan jasa pembuatan aplikasi mobile Android & iOS profesional. Aplikasi hybrid dan native yang powerful untuk kebutuhan bisnis modern.",
    "provider": {
        "@type": "Organization",
        "@id": "{{ url('/') }}#organization",
        "name": "Centrova",
        "url": "{{ url('/') }}"
    },
    "serviceType": "Mobile App Development",
    "areaServed": {
        "@type": "Country",
        "name": "Indonesia"
    },
    "offers": {
        "@type": "Offer",
        "availability": "https://schema.org/InStock",
        "priceCurrency": "IDR"
    }
}
</script>
@endpush

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

{{-- Non-critical CSS --}}
@push('styles')
@once
<style>
    .swiper{padding-bottom:0}
    .swiper-button-next,.swiper-button-prev{display:none}
    .swiper-button-prev-custom,.swiper-button-next-custom{cursor:pointer}
    .swiper-button-prev-custom:active,.swiper-button-next-custom:active{transform:scale(.95)}
    .swiper-pagination-bullet-active{background:#128AEB!important}
</style>
@endonce
@endpush

@section('content')
    {{-- Hero Section --}}
    <section class="w-full bg-white py-16 pt-32">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="max-w-3xl">
                <h1 class="text-[3.6rem] max-lg:text-[3rem] max-md:text-[2.6rem] leading-snug font-bold mb-6 text-slate-900">Aplikasi Mobile yang Menjangkau Jutaan Pengguna</h1>
                <p class="text-xl max-md:text-lg leading-snug text-neutral-700 mb-6">Kembangkan aplikasi mobile Android dan iOS yang powerful dengan teknologi hybrid atau native. Dari konsep hingga publish di Play Store dan App Store, kami siap mewujudkan aplikasi mobile impian Anda.</p>
                <a href="#konsultasi" 
                aria-label="Hubungi kami untuk konsultasi aplikasi mobile gratis"
                class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 min-h-[44px]">
                    Hubungi Sekarang
                </a>
            </div>
        </div>
    </section>

    <section id="keunggulan" class="w-full bg-neutral-100 py-16">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="max-w-7xl mx-auto text-left mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-3xl font-bold text-neutral-900 mb-3 leading-snug">
                    Kenapa Memilih Aplikasi Mobile dari Centrova?
                </h2>
            </div>

            <div class="grid grid-cols-3 max-lg:grid-cols-1 text-slate-900 gap-12">
                <div class="flex flex-col items-start">
                    <h1 class="font-medium text-xl mb-5">Cross-Platform Development</h1>
                    <p class="text-gray-600 text-lg">Dengan teknologi hybrid seperti React Native atau Flutter, kami develop sekali untuk Android dan iOS sekaligus. Hemat biaya, lebih cepat, dengan performa mendekati native.</p>
                </div>
                <div class="flex flex-col items-start">
                    <h1 class="font-medium text-xl mb-5">UI/UX yang Intuitif & Menarik</h1>
                    <p class="text-gray-600 text-lg">Interface yang user-friendly mengikuti design guidelines iOS dan Android. Pengalaman pengguna yang smooth dan enjoyable meningkatkan engagement dan retention rate.</p>
                </div>
                <div class="flex flex-col items-start">
                    <h1 class="font-medium text-xl mb-5">Ready for App Store</h1>
                    <p class="text-gray-600 text-lg">Kami bantu proses submission hingga aplikasi Anda live di Google Play Store dan Apple App Store. Lengkap dengan dokumentasi, asset requirements, dan compliance guidelines.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Separator --}}
    <div class="w-full h-[6px] flex"><div class="w-full bg-[#128AEB] h-full"></div><div class="w-full bg-sky-500 h-full"></div><div class="w-[30%] bg-sky-300 h-full"></div></div>

    {{-- Jenis Aplikasi Mobile --}}
    <section id="layanan" class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8 py-16" x-data="mobileAppSection">
        <div class="text-left mb-8">
            <h2 class="text-2xl sm:text-3xl md:text-3xl font-bold text-neutral-900 mb-3 leading-snug">
                Jenis Aplikasi Mobile yang Kami Kembangkan
            </h2>
            <p class="text-base text-lg text-slate-700 md:max-w-4xl">
                Dari aplikasi bisnis hingga social media, kami siap mewujudkan ide aplikasi mobile Anda
            </p>
        </div>
        
        <div class="w-full max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <template x-for="(item, idx) in services" :key="idx">
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
                Alpine.data('mobileAppSection', () => ({
                    services: [
                        {
                            title: 'E-Commerce & Marketplace',
                            description: 'Aplikasi toko online mobile-first dengan fitur product catalog, shopping cart, payment gateway, order tracking, push notification untuk promo, dan review system.',
                            icon: 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'
                        },
                        {
                            title: 'Social Media & Community',
                            description: 'Platform social networking dengan fitur posting, commenting, messaging, feed algorithm, user profiles, media sharing, dan real-time notifications.',
                            icon: 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'
                        },
                        {
                            title: 'Food Delivery & Restaurant',
                            description: 'Aplikasi pesan-antar makanan dengan menu digital, real-time order tracking, multiple payment options, rating & review, loyalty program, dan driver app.',
                            icon: 'M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7'
                        },
                        {
                            title: 'On-Demand Services & Booking',
                            description: 'Platform booking layanan seperti salon, spa, home service, konsultasi online dengan fitur appointment scheduling, payment integrated, dan service provider management.',
                            icon: 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'
                        },
                        {
                            title: 'Learning Management System (LMS)',
                            description: 'Aplikasi e-learning dengan video courses, quiz & assignments, progress tracking, certificates, discussion forums, dan gamification untuk engaging learning experience.',
                            icon: 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'
                        },
                        {
                            title: 'Health & Fitness Tracker',
                            description: 'Aplikasi kesehatan dengan activity tracking, calorie counter, workout plans, medication reminders, health metrics dashboard, dan integration dengan wearable devices.',
                            icon: 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'
                        }
                    ]
                }));
            });
        </script>
        @endonce
        @endpush
    </section>

    {{-- Why Mobile App --}}
    <section class="w-full overflow-hidden py-32 max-md:py-16">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 flex flex-col items-center">
            <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                    Mengapa Bisnis Anda Butuh Aplikasi Mobile?
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                    Di era mobile-first, aplikasi mobile bukan lagi opsional tapi kebutuhan untuk pertumbuhan bisnis.
                </p>
            </div>

            <div class="w-full mt-10 md:mt-16 flex flex-col-reverse md:flex-row items-center justify-between gap-10 md:gap-16">
                <div class="text-center md:text-left max-w-xl">
                    <h2 class="text-slate-900 font-medium text-2xl sm:text-3xl mb-4 sm:mb-6 leading-snug">Jangkau Customer di Mana Pun Mereka Berada</h2>
                    <p class="text-base sm:text-lg text-slate-600">Lebih dari 70% pengguna internet Indonesia mengakses melalui smartphone. Dengan aplikasi mobile, bisnis Anda hadir langsung di smartphone pelanggan - meningkatkan engagement, loyalty, dan conversion rate. Push notification memungkinkan komunikasi real-time, sementara fitur offline-first memastikan customer tetap dapat mengakses layanan bahkan tanpa koneksi internet. Aplikasi mobile juga memberikan brand presence yang lebih kuat dan customer experience yang superior dibanding website mobile.</p>
                </div>

                <img src="{{ asset('/assets/image/services/mobile-app-development/section_1.png') }}"
                    alt="Ilustrasi aplikasi mobile profesional"
                    class="w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-lg flex-shrink-0" loading="lazy"
                    decoding="async" />
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- Tech Stack --}}
    <section class="w-full overflow-hidden py-32 max-md:py-16">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="max-w-4xl mx-auto text-center mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                    Teknologi yang Kami Gunakan
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                    Framework dan tools modern untuk menghasilkan aplikasi mobile berkualitas tinggi
                </p>            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
                <div class="bg-white border border-neutral-200 rounded-2xl p-8 shadow hover:shadow-md transition-all">
                    <h3 class="text-2xl font-semibold text-slate-900 mb-4">Hybrid Development</h3>
                    <ul class="space-y-3 list-check">
                        <li>React Native - JavaScript framework dari Facebook</li>
                        <li>Flutter - Dart framework dari Google</li>
                        <li>Ionic - HTML5 hybrid framework</li>
                        <li>One codebase untuk iOS & Android</li>
                        <li>Faster development & lower cost</li>
                    </ul>
                </div>

                <div class="bg-white border border-neutral-200 rounded-2xl p-8 shadow hover:shadow-md transition-all">
                    <h3 class="text-2xl font-semibold text-slate-900 mb-4">Native Development</h3>
                    <ul class="space-y-3 list-check">
                        <li>Swift untuk iOS development</li>
                        <li>Kotlin untuk Android development</li>
                        <li>Maximum performance & native feel</li>
                        <li>Full access ke device features</li>
                        <li>Best user experience</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- Paket & Harga --}}
    <section id="harga" x-data="pricingSection" class="py-32 max-md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-slate-900 mb-4">Paket & Estimasi Harga</h2>
                <p class="text-xl text-slate-700 max-w-3xl mx-auto">
                    Pilih paket development yang sesuai dengan kompleksitas dan kebutuhan aplikasi mobile Anda
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
                            Pilih Paket
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
        </div>

        @push('scripts')
        @once
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('pricingSection', () => ({
                    plans: [
                        {
                            name: 'MVP Starter',
                            price: 'Rp 15.000.000',
                            description: 'Perfect untuk validasi konsep dan launch cepat dengan fitur essential.',
                            features: [
                                'Hybrid development (React Native/Flutter)',
                                'Basic UI/UX design',
                                '5-8 screens/pages',
                                'User authentication',
                                'Basic API integration',
                                'Android & iOS apps',
                                '2 bulan timeline',
                                '3 bulan support'
                            ]
                        },
                        {
                            name: 'Professional',
                            price: 'Rp 35.000.000',
                            description: 'Aplikasi production-ready dengan fitur lengkap untuk bisnis berkembang.',
                            features: [
                                'Semua fitur MVP',
                                'Custom UI/UX design',
                                '12-20 screens',
                                'Push notifications',
                                'Payment gateway integration',
                                'Analytics & crashlytics',
                                'Admin dashboard web',
                                '3-4 bulan timeline',
                                '6 bulan support'
                            ],
                            featured: true
                        },
                        {
                            name: 'Enterprise',
                            price: 'Mulai Rp 75jt',
                            description: 'Solusi enterprise-grade dengan fitur advanced dan scalability tinggi.',
                            features: [
                                'Native atau hybrid',
                                'Premium UI/UX design',
                                'Unlimited screens',
                                'Real-time features',
                                'Advanced security',
                                'Cloud infrastructure setup',
                                'DevOps & CI/CD',
                                'Wearable integration',
                                '5-8 bulan timeline',
                                '12 bulan premium support'
                            ]
                        }
                    ],
                    selectPlan(plan) {
                        const phoneNumber = '6285817909560';
                        let message = `Halo, saya tertarik dengan paket *${plan.name}* untuk layanan Mobile App Development.\n\n`;
                        message += `Detail Paket:\n• Harga: ${plan.price}\n• Deskripsi: ${plan.description}\n\nMohon informasi lebih lanjut. Terima kasih!`;
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
    <section class="py-32 max-md:py-16 bg-neutral-50" x-data="faqSection">
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
                Alpine.data('faqSection', () => ({
                    openFaq: null,
                    faqs: [
                        {
                            question: 'Hybrid atau Native, mana yang lebih baik?',
                            answer: 'Hybrid (React Native/Flutter) cocok untuk MVP dan budget terbatas dengan development lebih cepat. Native (Swift/Kotlin) untuk aplikasi kompleks yang butuh performa maksimal. Kami akan rekomendasikan yang paling sesuai dengan kebutuhan Anda.'
                        },
                        {
                            question: 'Berapa lama waktu pengembangan aplikasi mobile?',
                            answer: 'MVP sederhana: 2-3 bulan. Aplikasi standard dengan fitur lengkap: 3-5 bulan. Enterprise complex app: 6-12 bulan. Timeline bisa bervariasi tergantung scope dan kompleksitas fitur.'
                        },
                        {
                            question: 'Apakah harga sudah termasuk publish ke App Store & Play Store?',
                            answer: 'Ya, kami bantu proses submission hingga aplikasi live di kedua platform. Developer account fee (Apple $99/tahun, Google $25 sekali bayar) ditanggung klien. Kami handle semua technical requirements dan compliance.'
                        },
                        {
                            question: 'Apakah bisa update fitur setelah aplikasi launch?',
                            answer: 'Tentu! Kami menyediakan layanan maintenance dan feature enhancement berkelanjutan. Aplikasi dirancang modular untuk memudahkan penambahan fitur atau update di kemudian hari tanpa rebuild dari nol.'
                        },
                        {
                            question: 'Bagaimana sistem pembayaran untuk project mobile app?',
                            answer: 'Payment term: 30% DP, 30% saat prototype/design approved, 30% saat pre-launch testing, 10% setelah publish live. Atau bisa disesuaikan dengan agreement di proposal.'
                        },
                        {
                            question: 'Apakah source code akan diberikan kepada klien?',
                            answer: 'Ya, setelah project selesai dan pelunasan, seluruh source code, documentation, dan asset menjadi milik penuh klien. Anda memiliki full ownership dan dapat melanjutkan development sendiri jika diperlukan.'
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
                Konsultasi Gratis Ide Aplikasi Mobile Anda
            </h3>
            <p class="text-slate-600 text-base sm:text-lg mb-6">
                Diskusikan konsep dan requirement aplikasi Anda bersama tim expert kami. Dapatkan estimasi dan roadmap yang jelas.
            </p>
            <button onclick="window.open('{{ route('service.consult') }}', '_blank')"
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
                        { text: "Konsultasi Gratis", url: "{{ route('service.consult') }}", target: "_blank" },
                        { text: "Pusat Bantuan", url: "{{ route('service.consult') }}", target: "_self" },
                        { text: "Pembatalan Layanan", url: "{{ route('services.cancellation.index') }}", target: "_self" },
                    ]
                }));
            });
        </script>
        @endonce
        @endpush
    </section>
@endsection
