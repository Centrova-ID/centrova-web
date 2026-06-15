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
    {{-- About Section --}}
    <div class="max-w-4xl mx-auto px-4 max-md:px-8 lg:px-8 text-center border-none border-neutral-300 pb-20 pt-28">
        <h1 class="text-4xl sm:text-5xl font-bold text-slate-900 mb-6">Tentang Centrova</h1>
        <p class="mt-8 text-xl text-neutral-900 w-full max-w-3xl mx-auto font-medium leading-relaxed">
            PT Centrova Teknologi Indonesia adalah perusahaan AI Venture Engineering yang membantu bisnis membangun, mengotomatisasi, dan mengembangkan operasional melalui software, AI, dan intelligent automation.
        </p>
        <p class="mt-4 text-base text-neutral-600 w-full max-w-2xl mx-auto font-normal leading-relaxed">
            Kami menggabungkan software development, AI-powered systems, dan AI Agents untuk membantu organisasi bekerja lebih efisien, bergerak lebih cepat, dan menciptakan pertumbuhan yang berkelanjutan.
        </p>
    </div>

    <img src="https://www.gstatic.com/marketing-cms/assets/images/0b/d4/e6516d32418884386205621ad689/about-companyinfo-hero.jpg=n-w2000-h625-fcrop64=1,0000051ffffffae1-rw" class="w-full max-w-[1920px] mx-auto object-cover max-h-[450px]">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        {{-- Vision Section --}}
        <div class="text-center py-12 max-w-4xl mx-auto">
            <span class="text-xs font-bold tracking-widest text-[#128AEB] uppercase block mb-3">Visi Kami</span>
            <p class="text-[32px] max-lg:text-2xl max-md:text-2xl max-sm:text-xl font-semibold leading-snug text-slate-800 tracking-tight">
                Menjadi perusahaan AI Venture Engineering yang membantu bisnis <span class="text-[#128AEB]">membangun masa depan</span> melalui teknologi dan inovasi.
            </p>
        </div>

        {{-- What We Do Section (Missions) --}}
        <div class="py-16 pt-6" id="produk">
            <div class="max-w-7xl mx-auto">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-slate-900">What We Do</h2>
                </div>
                <div class="grid max-sm:grid-cols-1 max-md:grid-cols-2 grid-cols-3 gap-6">
                    {{-- Card 1: AI Venture Engineering --}}
                    <div class="rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150 flex flex-col">
                        <img src="https://plus.unsplash.com/premium_photo-1721080251127-76315300cc5c?q=80&w=870&auto=format&fit=crop" alt="AI Venture Engineering" loading="lazy" class="w-full aspect-video object-cover">
                        <div class="px-6 py-5 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 mb-2">AI Venture Engineering</h3>
                                <p class="text-sm text-neutral-600 font-normal leading-relaxed">Membantu perusahaan dan startup merancang serta membangun produk digital berbasis AI.</p>
                            </div>
                            <a href="{{ route('services.index') }}" class="flex justify-end text-[#128AEB] font-medium hover:underline transition mt-4">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.2929 11.1129C17.4804 10.9254 17.7348 10.82 18 10.82C18.2652 10.82 18.5196 10.9254 18.7071 11.1129C18.8946 11.3004 19 11.5548 19 11.82V19C19 19.7956 18.6839 20.5587 18.1213 21.1213C17.5587 21.6839 16.7956 22 16 22H5C4.20435 22 3.44129 21.6839 2.87868 21.1213C2.31607 20.5587 2 19.7956 2 19V8C2 7.20435 2.31607 6.44129 2.87868 5.87868C3.44129 5.31607 4.20435 5 5 5H12.18C12.4452 5 12.6996 5.10536 12.8871 5.29289C13.0746 5.48043 13.18 5.73478 13.18 6C13.18 6.26522 13.0746 6.51957 12.8871 6.70711C12.6996 6.89464 12.4452 7 12.18 7H5C4.73478 7 4.48043 7.10536 4.29289 7.29289C4.10536 7.48043 4 7.73478 4 8V19C4 19.2652 4.10536 19.5196 4.29289 19.7071C4.48043 19.8946 4.73478 20 5 20H16C16.2652 20 16.5196 19.8946 16.7071 19.7071C16.8946 19.5196 17 19.2652 17 19V11.82C17 11.5548 17.1054 11.3004 17.2929 11.1129Z" fill="#128AEB"/>
                                    <path d="M21.92 2.62C21.8185 2.37565 21.6243 2.18147 21.38 2.08C21.2598 2.02876 21.1307 2.00158 21 2H15C14.7348 2 14.4804 2.10536 14.2929 2.29289C14.1054 2.48043 14 2.73478 14 3C14 3.26522 14.1054 3.51957 14.2929 3.70711C14.4804 3.89464 14.7348 4 15 4H18.59L8.29 14.29C8.19627 14.383 8.12188 14.4936 8.07111 14.6154C8.02034 14.7373 7.9942 14.868 7.9942 15C7.9942 15.132 8.02034 15.2627 8.07111 15.3846C8.12188 15.5064 8.19627 15.617 8.29 15.71C8.38296 15.8037 8.49356 15.8781 8.61542 15.9289C8.73728 15.9797 8.86799 16.0058 9 16.0058C9.13201 16.0058 9.26272 15.9797 9.38458 15.9289C9.50644 15.8781 9.61704 15.8037 9.71 15.71L20 5.41V9C20 9.26522 20.1054 9.51957 20.2929 9.70711C20.4804 9.89464 20.7348 10 21 10C21.2652 10 21.5196 9.89464 21.7071 9.70711C21.8946 9.51957 22 9.26522 22 9V3C21.9984 2.86932 21.9712 2.74022 21.92 2.62Z" fill="#128AEB"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Card 2: Software Development --}}
                    <div class="rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150 flex flex-col">
                        <img src="https://images.unsplash.com/photo-1667984390553-7f439e6ae401?q=80&w=1032&auto=format&fit=crop" alt="Software Development" loading="lazy" class="w-full aspect-video object-cover">
                        <div class="px-6 py-5 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 mb-2">Software Development</h3>
                                <p class="text-sm text-neutral-600 font-normal leading-relaxed">Mengembangkan web apps, mobile apps, SaaS, dan custom software sesuai kebutuhan bisnis.</p>
                            </div>
                            <a href="/layanan/software-development" class="flex justify-end text-[#128AEB] font-medium hover:underline transition mt-4">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.2929 11.1129C17.4804 10.9254 17.7348 10.82 18 10.82C18.2652 10.82 18.5196 10.9254 18.7071 11.1129C18.8946 11.3004 19 11.5548 19 11.82V19C19 19.7956 18.6839 20.5587 18.1213 21.1213C17.5587 21.6839 16.7956 22 16 22H5C4.20435 22 3.44129 21.6839 2.87868 21.1213C2.31607 20.5587 2 19.7956 2 19V8C2 7.20435 2.31607 6.44129 2.87868 5.87868C3.44129 5.31607 4.20435 5 5 5H12.18C12.4452 5 12.6996 5.10536 12.8871 5.29289C13.0746 5.48043 13.18 5.73478 13.18 6C13.18 6.26522 13.0746 6.51957 12.8871 6.70711C12.6996 6.89464 12.4452 7 12.18 7H5C4.73478 7 4.48043 7.10536 4.29289 7.29289C4.10536 7.48043 4 7.73478 4 8V19C4 19.2652 4.10536 19.5196 4.29289 19.7071C4.48043 19.8946 4.73478 20 5 20H16C16.2652 20 16.5196 19.8946 16.7071 19.7071C16.8946 19.5196 17 19.2652 17 19V11.82C17 11.5548 17.1054 11.3004 17.2929 11.1129Z" fill="#128AEB"/>
                                    <path d="M21.92 2.62C21.8185 2.37565 21.6243 2.18147 21.38 2.08C21.2598 2.02876 21.1307 2.00158 21 2H15C14.7348 2 14.4804 2.10536 14.2929 2.29289C14.1054 2.48043 14 2.73478 14 3C14 3.26522 14.1054 3.51957 14.2929 3.70711C14.4804 3.89464 14.7348 4 15 4H18.59L8.29 14.29C8.19627 14.383 8.12188 14.4936 8.07111 14.6154C8.02034 14.7373 7.9942 14.868 7.9942 15C7.9942 15.132 8.02034 15.2627 8.07111 15.3846C8.12188 15.5064 8.19627 15.617 8.29 15.71C8.38296 15.8037 8.49356 15.8781 8.61542 15.9289C8.73728 15.9797 8.86799 16.0058 9 16.0058C9.13201 16.0058 9.26272 15.9797 9.38458 15.9289C9.50644 15.8781 9.61704 15.8037 9.71 15.71L20 5.41V9C20 9.26522 20.1054 9.51957 20.2929 9.70711C20.4804 9.89464 20.7348 10 21 10C21.2652 10 21.5196 9.89464 21.7071 9.70711C21.8946 9.51957 22 9.26522 22 9V3C21.9984 2.86932 21.9712 2.74022 21.92 2.62Z" fill="#128AEB"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Card 3: AI Agent Automation --}}
                    <div class="rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150 flex flex-col">
                        <img src="https://plus.unsplash.com/premium_photo-1661429422690-f7dfe21d54c4?q=80&w=870&auto=format&fit=crop" alt="AI Agent Automation" loading="lazy" class="w-full aspect-video object-cover">
                        <div class="px-6 py-5 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 mb-2">AI Agent Automation</h3>
                                <p class="text-sm text-neutral-600 font-normal leading-relaxed">Membangun AI Agents dan workflow automation untuk meningkatkan produktivitas dan efisiensi operasional.</p>
                            </div>
                            <a href="/layanan/ai-automation" class="flex justify-end text-[#128AEB] font-medium hover:underline transition mt-4">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.2929 11.1129C17.4804 10.9254 17.7348 10.82 18 10.82C18.2652 10.82 18.5196 10.9254 18.7071 11.1129C18.8946 11.3004 19 11.5548 19 11.82V19C19 19.7956 18.6839 20.5587 18.1213 21.1213C17.5587 21.6839 16.7956 22 16 22H5C4.20435 22 3.44129 21.6839 2.87868 21.1213C2.31607 20.5587 2 19.7956 2 19V8C2 7.20435 2.31607 6.44129 2.87868 5.87868C3.44129 5.31607 4.20435 5 5 5H12.18C12.4452 5 12.6996 5.10536 12.8871 5.29289C13.0746 5.48043 13.18 5.73478 13.18 6C13.18 6.26522 13.0746 6.51957 12.8871 6.70711C12.6996 6.89464 12.4452 7 12.18 7H5C4.73478 7 4.48043 7.10536 4.29289 7.29289C4.10536 7.48043 4 7.73478 4 8V19C4 19.2652 4.10536 19.5196 4.29289 19.7071C4.48043 19.8946 4.73478 20 5 20H16C16.2652 20 16.5196 19.8946 16.7071 19.7071C16.8946 19.5196 17 19.2652 17 19V11.82C17 11.5548 17.1054 11.3004 17.2929 11.1129Z" fill="#128AEB"/>
                                    <path d="M21.92 2.62C21.8185 2.37565 21.6243 2.18147 21.38 2.08C21.2598 2.02876 21.1307 2.00158 21 2H15C14.7348 2 14.4804 2.10536 14.2929 2.29289C14.1054 2.48043 14 2.73478 14 3C14 3.26522 14.1054 3.51957 14.2929 3.70711C14.4804 3.89464 14.7348 4 15 4H18.59L8.29 14.29C8.19627 14.383 8.12188 14.4936 8.07111 14.6154C8.02034 14.7373 7.9942 14.868 7.9942 15C7.9942 15.132 8.02034 15.2627 8.07111 15.3846C8.12188 15.5064 8.19627 15.617 8.29 15.71C8.38296 15.8037 8.49356 15.8781 8.61542 15.9289C8.73728 15.9797 8.86799 16.0058 9 16.0058C9.13201 16.0058 9.26272 15.9797 9.38458 15.9289C9.50644 15.8781 9.61704 15.8037 9.71 15.71L20 5.41V9C20 9.26522 20.1054 9.51957 20.2929 9.70711C20.4804 9.89464 20.7348 10 21 10C21.2652 10 21.5196 9.89464 21.7071 9.70711C21.8946 9.51957 22 9.26522 22 9V3C21.9984 2.86932 21.9712 2.74022 21.92 2.62Z" fill="#128AEB"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Our Values Section --}}
        <div class="py-12 border-t border-neutral-100">
            <div class="max-w-7xl mx-auto">
                <div class="mb-10 text-center">
                    <h2 class="text-2xl font-bold text-slate-900">Our Values</h2>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 text-center">
                    <div class="p-6 bg-neutral-50 rounded-2xl border border-neutral-100">
                        <span class="text-xl font-bold text-[#128AEB] block mb-1">Create</span>
                        <p class="text-sm text-neutral-600 font-normal">Berinovasi dan menciptakan solusi.</p>
                    </div>
                    <div class="p-6 bg-neutral-50 rounded-2xl border border-neutral-100">
                        <span class="text-xl font-bold text-[#128AEB] block mb-1">Own</span>
                        <p class="text-sm text-neutral-600 font-normal">Bertanggung jawab atas setiap hasil.</p>
                    </div>
                    <div class="p-6 bg-neutral-50 rounded-2xl border border-neutral-100">
                        <span class="text-xl font-bold text-[#128AEB] block mb-1">Rise</span>
                        <p class="text-sm text-neutral-600 font-normal">Terus belajar dan berkembang.</p>
                    </div>
                    <div class="p-6 bg-neutral-50 rounded-2xl border border-neutral-100">
                        <span class="text-xl font-bold text-[#128AEB] block mb-1">Empower</span>
                        <p class="text-sm text-neutral-600 font-normal">Memberdayakan melalui teknologi.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer Highlight / Quote Section --}}
        <div class="pt-16">
            <div class="max-w-7xl bg-neutral-900 rounded-3xl mx-auto p-10 lg:p-16 text-center">
                <div class="max-w-3xl mx-auto">
                    <h3 class="text-white text-2xl lg:text-3xl font-semibold mb-4 tracking-tight">Build to Shape the Future.</h3>
                    <p class="text-neutral-400 text-base lg:text-lg font-normal leading-relaxed">
                        Kami percaya masa depan dibangun oleh bisnis yang mampu memanfaatkan software, AI, dan automation secara efektif.
                    </p>
                </div>
            </div>
        </div>

    </div>
@endsection
