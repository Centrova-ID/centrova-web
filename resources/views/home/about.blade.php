@extends('partials.layouts.main')

@section('seoMetaTags')
    @include('partials.seo.meta-tags', [
        'title' => 'Tentang Centrova — Platform Inovasi & Layanan Digital Terpercaya',
        'description' => 'Centrova membantu bisnis dan wirausahawan mengadopsi teknologi efisien dan terintegrasi. Pelajari visi, misi, dan nilai kami untuk pemberdayaan digital di Indonesia.',
        'keywords' => 'Centrova, platform digital, layanan digital, web development, app development, transformasi digital, solusi bisnis',
        'canonical_url' => url()->current(),
        'og_image' => asset('assets/image/services/web-development/og-image.jpg'),
        'page_type' => 'website',
        // Provide simple structured data: breadcrumb and FAQ about Centrova
        'structured_data' => [
            [
                "@context" => "https://schema.org",
                "@type" => "BreadcrumbList",
                "itemListElement" => [
                    [
                        "@type" => "ListItem",
                        "position" => 1,
                        "name" => "Beranda",
                        "item" => url('/')
                    ],
                    [
                        "@type" => "ListItem",
                        "position" => 2,
                        "name" => "Tentang",
                        "item" => url()->current()
                    ]
                ]
            ],
            [
                "@context" => "https://schema.org",
                "@type" => "FAQPage",
                "mainEntity" => [
                    [
                        "@type" => "Question",
                        "name" => "Apa itu Centrova?",
                        "acceptedAnswer" => [
                            "@type" => "Answer",
                            "text" => "Centrova adalah platform yang berfokus pada inovasi dan layanan digital untuk membantu bisnis mengadopsi teknologi efisien dan terintegrasi."
                        ]
                    ],
                    [
                        "@type" => "Question",
                        "name" => "Layanan apa yang disediakan Centrova?",
                        "acceptedAnswer" => [
                            "@type" => "Answer",
                            "text" => "Kami menawarkan solusi perangkat lunak, pengembangan web dan aplikasi, integrasi sistem, infrastruktur yang dapat diskalakan, serta dukungan pelatihan adopsi digital."
                        ]
                    ]
                ]
            ]
        ]
    ])
@endsection

@section('content')
    <div class="max-w-4xl mx-auto px-4 max-md:px-8 lg:px-8 text-center border-none border-neutral-300 pb-20 pt-28">
        <h1 class="text-4xl sm:text-5xl font-bold text-slate-900 mb-6">Tentang Centrova</h1>
        <p class="mt-8 text-xl text-neutral-900 w-full max-w-3xl mx-auto font-medium">
        Centrova adalah platform yang berfokus pada inovasi dan layanan digitalisasi. Kami membantu berbagai sektor—dari wirausahawan hingga perusahaan—mengadopsi teknologi yang efisien, terintegrasi, dan relevan dengan kebutuhan lokal, untuk mempercepat transformasi menuju bisnis yang lebih produktif dan berdaya saing.
        </p>
    </div>

    {{-- <img src="https://images.ctfassets.net/kftzwdyauwt9/32cmTSUIF5POX5FMuoHJwO/be8b42b8016957ca28e07274f05f1d3d/stangel-2022-0527.webp?w=1920&q=90&fm=webp" class="w-full max-w-[1920px] mx-auto hidden"> --}}
    <img src="https://www.gstatic.com/marketing-cms/assets/images/0b/d4/e6516d32418884386205621ad689/about-companyinfo-hero.jpg=n-w2000-h625-fcrop64=1,0000051ffffffae1-rw" class="w-full max-w-[1920px] mx-auto">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <p class="text-center mx-auto text-[44px] max-lg:text-2xl max-md:text-2xl max-sm:text-lg leading-snug text-slate-800 my-4 tracking-tight max-w-6xl max-lg:max-w-3xl max-md:max-w-2xl px-0">
        Visi Kami menjadi salah satu 
        <span class="text-[#4285f4]">platform teknologi terbaik</span>
        <br />
        dengan menghadirkan <span class="text-[#34a853]">inovasi dan layanan terbaik</span>
        <br />
        serta <span class="text-[#e37400]">memberdayakan setiap orang di dunia</span>
        <br />
        melalui <span class="text-[#fbbc05]">program gerakan digitalisasi</span>
        </p>

        <!-- Missions Section -->
        <div class="py-16 pt-12" id="produk">
            <div class="max-w-7xl mx-auto">
                <div class="grid max-sm:grid-cols-1 max-lg:grid-cols-2 grid-cols-4 gap-6">
                    <div class="rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150 flex flex-col">
                        <img src="https://plus.unsplash.com/premium_photo-1721080251127-76315300cc5c?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Layanan Web Development" loading="lazy" class="w-full aspect-video object-cover">
                        <div class="px-6 py-4 pb-6 flex-1 flex flex-col justify-between">
                            <p class="text-base font-medium mb-2">Menyediakan solusi perangkat lunak yang mudah digunakan dan terintegrasi untuk kebutuhan bisnis lokal.</p>
                            <a href="{{ route('services.index') }}" class="flex justify-end text-[#128AEB] font-medium hover:underline transition">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.2929 11.1129C17.4804 10.9254 17.7348 10.82 18 10.82C18.2652 10.82 18.5196 10.9254 18.7071 11.1129C18.8946 11.3004 19 11.5548 19 11.82V19C19 19.7956 18.6839 20.5587 18.1213 21.1213C17.5587 21.6839 16.7956 22 16 22H5C4.20435 22 3.44129 21.6839 2.87868 21.1213C2.31607 20.5587 2 19.7956 2 19V8C2 7.20435 2.31607 6.44129 2.87868 5.87868C3.44129 5.31607 4.20435 5 5 5H12.18C12.4452 5 12.6996 5.10536 12.8871 5.29289C13.0746 5.48043 13.18 5.73478 13.18 6C13.18 6.26522 13.0746 6.51957 12.8871 6.70711C12.6996 6.89464 12.4452 7 12.18 7H5C4.73478 7 4.48043 7.10536 4.29289 7.29289C4.10536 7.48043 4 7.73478 4 8V19C4 19.2652 4.10536 19.5196 4.29289 19.7071C4.48043 19.8946 4.73478 20 5 20H16C16.2652 20 16.5196 19.8946 16.7071 19.7071C16.8946 19.5196 17 19.2652 17 19V11.82C17 11.5548 17.1054 11.3004 17.2929 11.1129Z" fill="#128AEB"/>
                                <path d="M21.92 2.62C21.8185 2.37565 21.6243 2.18147 21.38 2.08C21.2598 2.02876 21.1307 2.00158 21 2H15C14.7348 2 14.4804 2.10536 14.2929 2.29289C14.1054 2.48043 14 2.73478 14 3C14 3.26522 14.1054 3.51957 14.2929 3.70711C14.4804 3.89464 14.7348 4 15 4H18.59L8.29 14.29C8.19627 14.383 8.12188 14.4936 8.07111 14.6154C8.02034 14.7373 7.9942 14.868 7.9942 15C7.9942 15.132 8.02034 15.2627 8.07111 15.3846C8.12188 15.5064 8.19627 15.617 8.29 15.71C8.38296 15.8037 8.49356 15.8781 8.61542 15.9289C8.73728 15.9797 8.86799 16.0058 9 16.0058C9.13201 16.0058 9.26272 15.9797 9.38458 15.9289C9.50644 15.8781 9.61704 15.8037 9.71 15.71L20 5.41V9C20 9.26522 20.1054 9.51957 20.2929 9.70711C20.4804 9.89464 20.7348 10 21 10C21.2652 10 21.5196 9.89464 21.7071 9.70711C21.8946 9.51957 22 9.26522 22 9V3C21.9984 2.86932 21.9712 2.74022 21.92 2.62Z" fill="#128AEB"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150 flex flex-col">
                        <img src="https://images.unsplash.com/photo-1667984390553-7f439e6ae401?q=80&w=1032&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Layanan App Development" loading="lazy" class="w-full aspect-video object-cover">
                        <div class="px-6 py-4 pb-6 flex-1 flex flex-col justify-between">
                            <p class="text-base font-medium mb-2">Menyediakan infrastruktur dan layanan yang andal serta dapat diskalakan.</p>
                            <a href="/layanan/app-development" class="flex justify-end text-[#128AEB] font-medium hover:underline transition">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.2929 11.1129C17.4804 10.9254 17.7348 10.82 18 10.82C18.2652 10.82 18.5196 10.9254 18.7071 11.1129C18.8946 11.3004 19 11.5548 19 11.82V19C19 19.7956 18.6839 20.5587 18.1213 21.1213C17.5587 21.6839 16.7956 22 16 22H5C4.20435 22 3.44129 21.6839 2.87868 21.1213C2.31607 20.5587 2 19.7956 2 19V8C2 7.20435 2.31607 6.44129 2.87868 5.87868C3.44129 5.31607 4.20435 5 5 5H12.18C12.4452 5 12.6996 5.10536 12.8871 5.29289C13.0746 5.48043 13.18 5.73478 13.18 6C13.18 6.26522 13.0746 6.51957 12.8871 6.70711C12.6996 6.89464 12.4452 7 12.18 7H5C4.73478 7 4.48043 7.10536 4.29289 7.29289C4.10536 7.48043 4 7.73478 4 8V19C4 19.2652 4.10536 19.5196 4.29289 19.7071C4.48043 19.8946 4.73478 20 5 20H16C16.2652 20 16.5196 19.8946 16.7071 19.7071C16.8946 19.5196 17 19.2652 17 19V11.82C17 11.5548 17.1054 11.3004 17.2929 11.1129Z" fill="#128AEB"/>
                                <path d="M21.92 2.62C21.8185 2.37565 21.6243 2.18147 21.38 2.08C21.2598 2.02876 21.1307 2.00158 21 2H15C14.7348 2 14.4804 2.10536 14.2929 2.29289C14.1054 2.48043 14 2.73478 14 3C14 3.26522 14.1054 3.51957 14.2929 3.70711C14.4804 3.89464 14.7348 4 15 4H18.59L8.29 14.29C8.19627 14.383 8.12188 14.4936 8.07111 14.6154C8.02034 14.7373 7.9942 14.868 7.9942 15C7.9942 15.132 8.02034 15.2627 8.07111 15.3846C8.12188 15.5064 8.19627 15.617 8.29 15.71C8.38296 15.8037 8.49356 15.8781 8.61542 15.9289C8.73728 15.9797 8.86799 16.0058 9 16.0058C9.13201 16.0058 9.26272 15.9797 9.38458 15.9289C9.50644 15.8781 9.61704 15.8037 9.71 15.71L20 5.41V9C20 9.26522 20.1054 9.51957 20.2929 9.70711C20.4804 9.89464 20.7348 10 21 10C21.2652 10 21.5196 9.89464 21.7071 9.70711C21.8946 9.51957 22 9.26522 22 9V3C21.9984 2.86932 21.9712 2.74022 21.92 2.62Z" fill="#128AEB"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150 flex flex-col">
                        <img src="https://plus.unsplash.com/premium_photo-1661429422690-f7dfe21d54c4?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Integrasi Sistem" loading="lazy" class="w-full aspect-video object-cover">
                        <div class="px-6 py-4 pb-6 flex-1 flex flex-col justify-between">
                            <p class="text-base font-medium mb-2">Mendukung pelatihan dan adopsi digital agar manfaat teknologi dapat dirasakan luas.</p>
                            <a href="{{ route('support.home') }}" class="flex justify-end text-[#128AEB] font-medium hover:underline transition">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.2929 11.1129C17.4804 10.9254 17.7348 10.82 18 10.82C18.2652 10.82 18.5196 10.9254 18.7071 11.1129C18.8946 11.3004 19 11.5548 19 11.82V19C19 19.7956 18.6839 20.5587 18.1213 21.1213C17.5587 21.6839 16.7956 22 16 22H5C4.20435 22 3.44129 21.6839 2.87868 21.1213C2.31607 20.5587 2 19.7956 2 19V8C2 7.20435 2.31607 6.44129 2.87868 5.87868C3.44129 5.31607 4.20435 5 5 5H12.18C12.4452 5 12.6996 5.10536 12.8871 5.29289C13.0746 5.48043 13.18 5.73478 13.18 6C13.18 6.26522 13.0746 6.51957 12.8871 6.70711C12.6996 6.89464 12.4452 7 12.18 7H5C4.73478 7 4.48043 7.10536 4.29289 7.29289C4.10536 7.48043 4 7.73478 4 8V19C4 19.2652 4.10536 19.5196 4.29289 19.7071C4.48043 19.8946 4.73478 20 5 20H16C16.2652 20 16.5196 19.8946 16.7071 19.7071C16.8946 19.5196 17 19.2652 17 19V11.82C17 11.5548 17.1054 11.3004 17.2929 11.1129Z" fill="#128AEB"/>
                                <path d="M21.92 2.62C21.8185 2.37565 21.6243 2.18147 21.38 2.08C21.2598 2.02876 21.1307 2.00158 21 2H15C14.7348 2 14.4804 2.10536 14.2929 2.29289C14.1054 2.48043 14 2.73478 14 3C14 3.26522 14.1054 3.51957 14.2929 3.70711C14.4804 3.89464 14.7348 4 15 4H18.59L8.29 14.29C8.19627 14.383 8.12188 14.4936 8.07111 14.6154C8.02034 14.7373 7.9942 14.868 7.9942 15C7.9942 15.132 8.02034 15.2627 8.07111 15.3846C8.12188 15.5064 8.19627 15.617 8.29 15.71C8.38296 15.8037 8.49356 15.8781 8.61542 15.9289C8.73728 15.9797 8.86799 16.0058 9 16.0058C9.13201 16.0058 9.26272 15.9797 9.38458 15.9289C9.50644 15.8781 9.61704 15.8037 9.71 15.71L20 5.41V9C20 9.26522 20.1054 9.51957 20.2929 9.70711C20.4804 9.89464 20.7348 10 21 10C21.2652 10 21.5196 9.89464 21.7071 9.70711C21.8946 9.51957 22 9.26522 22 9V3C21.9984 2.86932 21.9712 2.74022 21.92 2.62Z" fill="#128AEB"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150 flex flex-col">
                        <img src="https://images.unsplash.com/photo-1667372283545-1261fb5c427a?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Integrasi Sistem" loading="lazy" class="w-full aspect-video object-cover">
                        <div class="px-6 py-4 pb-6 flex-1 flex flex-col justify-between">
                            <p class="text-base font-medium mb-2">Menerapkan standar keamanan dan privasi yang ketat untuk menjaga data pelanggan.</p>
                            <a href="{{ route('legal.privacy') }}" class="flex justify-end text-[#128AEB] font-medium hover:underline transition">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.2929 11.1129C17.4804 10.9254 17.7348 10.82 18 10.82C18.2652 10.82 18.5196 10.9254 18.7071 11.1129C18.8946 11.3004 19 11.5548 19 11.82V19C19 19.7956 18.6839 20.5587 18.1213 21.1213C17.5587 21.6839 16.7956 22 16 22H5C4.20435 22 3.44129 21.6839 2.87868 21.1213C2.31607 20.5587 2 19.7956 2 19V8C2 7.20435 2.31607 6.44129 2.87868 5.87868C3.44129 5.31607 4.20435 5 5 5H12.18C12.4452 5 12.6996 5.10536 12.8871 5.29289C13.0746 5.48043 13.18 5.73478 13.18 6C13.18 6.26522 13.0746 6.51957 12.8871 6.70711C12.6996 6.89464 12.4452 7 12.18 7H5C4.73478 7 4.48043 7.10536 4.29289 7.29289C4.10536 7.48043 4 7.73478 4 8V19C4 19.2652 4.10536 19.5196 4.29289 19.7071C4.48043 19.8946 4.73478 20 5 20H16C16.2652 20 16.5196 19.8946 16.7071 19.7071C16.8946 19.5196 17 19.2652 17 19V11.82C17 11.5548 17.1054 11.3004 17.2929 11.1129Z" fill="#128AEB"/>
                                <path d="M21.92 2.62C21.8185 2.37565 21.6243 2.18147 21.38 2.08C21.2598 2.02876 21.1307 2.00158 21 2H15C14.7348 2 14.4804 2.10536 14.2929 2.29289C14.1054 2.48043 14 2.73478 14 3C14 3.26522 14.1054 3.51957 14.2929 3.70711C14.4804 3.89464 14.7348 4 15 4H18.59L8.29 14.29C8.19627 14.383 8.12188 14.4936 8.07111 14.6154C8.02034 14.7373 7.9942 14.868 7.9942 15C7.9942 15.132 8.02034 15.2627 8.07111 15.3846C8.12188 15.5064 8.19627 15.617 8.29 15.71C8.38296 15.8037 8.49356 15.8781 8.61542 15.9289C8.73728 15.9797 8.86799 16.0058 9 16.0058C9.13201 16.0058 9.26272 15.9797 9.38458 15.9289C9.50644 15.8781 9.61704 15.8037 9.71 15.71L20 5.41V9C20 9.26522 20.1054 9.51957 20.2929 9.70711C20.4804 9.89464 20.7348 10 21 10C21.2652 10 21.5196 9.89464 21.7071 9.70711C21.8946 9.51957 22 9.26522 22 9V3C21.9984 2.86932 21.9712 2.74022 21.92 2.62Z" fill="#128AEB"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Spotlight / Quote Section -->
        <div class="pb-16 hidden">
            <div class="max-w-7xl bg-neutral-100/70 rounded-3xl mx-auto p-10 lg:p-20">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-lg:justify-center items-center">
                    <div class="prose max-w-none max-lg:text-center">
                        <blockquote class="lg:text-2xl max-lg:text-xl max-lg:text-center font-normal text-slate-800 leading-relaxed lg:pr-20">“Harapan saya, Centrova bisa menjadi ekosistem teknologi yang memudahkan, memperkuat, dan memberdayakan setiap orang.”</blockquote>
                        <p class="mt-8 text-lg text-slate-600">Sultan Rahmatullah, CEO Centrova</p>
                    </div>

                    <div class="w-full">
                        <img src="https://www.gstatic.com/marketing-cms/assets/images/e7/35/bf4f7c844b89a69e972e0770b041/about-companyinfo-spquote.png=n-w502-h365-fcrop64=1,00000ac0fffff57f-rw" alt="Speaker on stage" class="w-full rounded-lg object-cover max-lg:max-w-[36rem] max-lg:mx-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
