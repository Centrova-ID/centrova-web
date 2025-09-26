@extends('partials.layouts.news')

@section('content')

<!-- Top Navigation Categories -->
<div class="border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex space-x-8 overflow-x-auto py-4" aria-label="News Categories">
            <a href="#" class="text-sm font-semibold text-slate-900 whitespace-nowrap">Semua Berita</a>
            <a href="#" class="text-sm font-semibold text-slate-500 hover:text-slate-900 whitespace-nowrap">Pengembangan Produk</a>
            <a href="#" class="text-sm font-semibold text-slate-500 hover:text-slate-900 whitespace-nowrap">Kisah Sukses</a>
            <a href="#" class="text-sm font-semibold text-slate-500 hover:text-slate-900 whitespace-nowrap">Event</a>
            <a href="#" class="text-sm font-semibold text-slate-500 hover:text-slate-900 whitespace-nowrap">Press Release</a>
            <a href="#" class="text-sm font-semibold text-slate-500 hover:text-slate-900 whitespace-nowrap">Updates</a>
        </nav>
    </div>
</div>

<!-- Hero Section with Latest News -->
<div class="py-16 bg-neutral-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Latest News Banner -->
        <div class="text-center mb-12">
            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                </svg>
                Pengumuman Terbaru
            </span>
        </div>

        <!-- Featured Article -->
        <div class="flex max-md:flex-col gap-8 mb-16 bg-white overflow-hidden rounded-2xl">
            <div class="w-3/6 max-lg:w-full h-full relative overflow-hidden">
                <a href="{{ url('detail') }}" class="w-full h-full">
                    <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?q=80&w=1469&auto=format&fit=crop" 
                         class="w-full h-full object-cover hover:scale-[1.05] transition duration-500" alt="Featured news image">
                </a>
                <div class="absolute h-[80%] flex flex-col justify-end bg-gradient-to-b from-transparent to-black/50 pt-5 px-4 py-2 bottom-0 w-full overflow-hidden md:hidden text-white">
                    <div class="flex items-center text-sm"><a href="#" class="font-semibold">Featured</a><span class="mx-2">•</span><a href="#" class="font-normal">12 Juni 2025</a></div>
                    <a href="{{ url('detail') }}"><h2 class="text-2xl font-semibold mb-3 line-clamp-3">Centrova Meluncurkan Fitur AI untuk Analisis Bisnis</h2></a>
                </div>
            </div>
            <div class="flex flex-col gap-y-3 w-3/5 justify-center py-6 md:pr-32 max-md:hidden text-slate-800">
                <a href="#" class="font-semibold text-lg text-neutral-500 max-lg:hidden">Featured</a>
                <a href="{{ url('detail') }}" class="text-3xl font-bold max-lg:line-clamp-4 lg:line-clamp-2">Centrova Meluncurkan Fitur AI untuk Analisis Bisnis</a>
                <a href="#" class="text-neutral-500 font-medium max-lg:hidden">12 Juni 2025</a>
                <p class="text-lg font-normal line-clamp-3 max-md:px-4 max-xl:hidden">Inovasi terbaru dalam platform Centrova POS memungkinkan pemilik bisnis untuk mendapatkan wawasan mendalam tentang performa bisnis mereka melalui analisis AI yang canggih.</p>
                <a href="#" class="flex items-center max-md:hidden text-blue-600 font-medium text-lg hover:underline">
                    <span>Baca Selengkapnya</span>
                    <span class="text-blue-500">
                      <svg class="w-3.5 h-3.5 mt-1" fill="none" stroke="currentColor" stroke-width="4"
                           viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                      </svg>
                    </span>
                </a>
            </div>
        </div>

        <!-- Featured Topics -->
        <div class="mb-16">
            <h2 class="text-2xl font-bold text-slate-800 mb-8">Topik Unggulan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <a href="#" class="group relative rounded-2xl overflow-hidden aspect-[16/9]">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=1630&auto=format&fit=crop" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="AI Innovation">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex items-end p-6">
                        <h3 class="text-white text-xl font-bold">AI Innovation</h3>
                    </div>
                </a>
                <a href="#" class="group relative rounded-2xl overflow-hidden aspect-[16/9]">
                    <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=1632&auto=format&fit=crop" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="UMKM Digital">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex items-end p-6">
                        <h3 class="text-white text-xl font-bold">UMKM Digital</h3>
                    </div>
                </a>
                <a href="#" class="group relative rounded-2xl overflow-hidden aspect-[16/9]">
                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1470&auto=format&fit=crop" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="Developer Stories">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex items-end p-6">
                        <h3 class="text-white text-xl font-bold">Developer Stories</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- Latest News Grid -->
        <div class="mb-16">
            <h2 class="text-2xl font-bold text-slate-800 mb-8">Berita Terbaru</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- News Card 1 -->
                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800">
                    <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=1632&auto=format&fit=crop" 
                         class="w-full h-56 object-cover" alt="News image">
                    <div class="p-6 pt-4">
                        <div class="text-base font-semibold text-neutral-500 mb-1"><a href="#">Pengembangan Produk</a></div>
                        <h3 class="text-xl font-bold mb-4 line-clamp-2">
                            <a href="#">Update Terbaru: Integrasi dengan Platform E-commerce</a>
                        </h3>
                        <div class="flex items-center justify-between">
                            <a href="#" class="flex items-center text-blue-600 font-medium hover:underline transition">
                                <span>Selengkapnya</span>
                                <svg class="w-3.5 h-3.5 ml-1 mt-[1px] text-blue-500" fill="none" stroke="currentColor" stroke-width="4"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                            <span class="text-sm text-black/60 font-semibold">12 Juni 2025</span>
                        </div>
                    </div>
                </div>

                <!-- News Card 2 -->
                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800">
                    <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?q=80&w=1470&auto=format&fit=crop" 
                         class="w-full h-56 object-cover" alt="News image">
                    <div class="p-6 pt-4">
                        <div class="text-base font-semibold text-neutral-500 mb-1"><a href="#">Story</a></div>
                        <h3 class="text-xl font-bold mb-4 line-clamp-2">
                            <a href="#">UMKM Binaan Meningkatkan Omset 300%</a>
                        </h3>
                        <div class="flex items-center justify-between">
                            <a href="#" class="flex items-center text-blue-600 font-medium hover:underline transition">
                                <span>Selengkapnya</span>
                                <svg class="w-3.5 h-3.5 ml-1 mt-[1px] text-blue-500" fill="none" stroke="currentColor" stroke-width="4"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                            <span class="text-sm text-black/60 font-semibold">10 Juni 2025</span>
                        </div>
                    </div>
                </div>

                <!-- News Card 3 -->
                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800">
                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1470&auto=format&fit=crop" 
                         class="w-full h-56 object-cover" alt="News image">
                    <div class="p-6 pt-4">
                        <div class="text-base font-semibold text-neutral-500 mb-1"><a href="#">Event</a></div>
                        <h3 class="text-xl font-bold mb-4 line-clamp-2">
                            <a href="#">Centrova Developer Conference 2025</a>
                        </h3>
                        <div class="flex items-center justify-between">
                            <a href="#" class="flex items-center text-blue-600 font-medium hover:underline transition">
                                <span>Selengkapnya</span>
                                <svg class="w-3.5 h-3.5 ml-1 mt-[1px] text-blue-500" fill="none" stroke="currentColor" stroke-width="4"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                            <span class="text-sm text-black/60 font-semibold">8 Juni 2025</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Press Releases -->
        <div class="mb-16">
            <h2 class="text-2xl font-bold text-slate-800 mb-8">Press Release</h2>
            <div class="space-y-6">
                <!-- Press Release Item -->
                <div class="flex items-start space-x-6 p-6 bg-white rounded-xl">
                    <div class="flex-1">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="text-sm font-semibold text-neutral-500">Press Release</span>
                            <span class="text-neutral-300">•</span>
                            <time class="text-sm text-neutral-500">8 Juni 2025</time>
                        </div>
                        <h3 class="text-xl font-bold mb-2">
                            <a href="#" class="hover:text-blue-600">Centrova Mengumumkan Ekspansi ke Asia Tenggara</a>
                        </h3>
                        <p class="text-slate-600 line-clamp-2">Centrova hari ini mengumumkan rencana ekspansi ke pasar Asia Tenggara, dimulai dengan pembukaan kantor regional di Singapura.</p>
                    </div>
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1470&auto=format&fit=crop" 
                         class="w-32 h-32 object-cover rounded-lg" alt="Press Release Image">
                </div>

                <!-- Press Release Item -->
                <div class="flex items-start space-x-6 p-6 bg-white rounded-xl">
                    <div class="flex-1">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="text-sm font-semibold text-neutral-500">Press Release</span>
                            <span class="text-neutral-300">•</span>
                            <time class="text-sm text-neutral-500">5 Juni 2025</time>
                        </div>
                        <h3 class="text-xl font-bold mb-2">
                            <a href="#" class="hover:text-blue-600">Centrova Meluncurkan Program Beasiswa Teknologi</a>
                        </h3>
                        <p class="text-slate-600 line-clamp-2">Program beasiswa ini akan memberikan kesempatan kepada 1000 mahasiswa Indonesia untuk belajar pengembangan software dan AI.</p>
                    </div>
                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=1470&auto=format&fit=crop" 
                         class="w-32 h-32 object-cover rounded-lg" alt="Press Release Image">
                </div>
            </div>
        </div>

        <!-- Events Section -->
        <div class="mb-16">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-slate-800">Upcoming Events</h2>
                <a href="#" class="text-blue-600 font-semibold hover:underline">Lihat Semua Events</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Event Card -->
                <div class="bg-white rounded-xl overflow-hidden">
                    <div class="aspect-video relative">
                        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=1470&auto=format&fit=crop" 
                             class="w-full h-full object-cover" alt="Event Image">
                        <div class="absolute top-4 left-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Coming Soon
                        </div>
                    </div>
                    <div class="p-6">
                        <time class="text-sm font-semibold text-neutral-500">20 Juli 2025</time>
                        <h3 class="text-xl font-bold mt-2 mb-3">Centrova Developer Conference 2025</h3>
                        <p class="text-slate-600 mb-4">Join us for our annual developer conference featuring the latest in retail technology innovation.</p>
                        <a href="#" class="text-blue-600 font-semibold hover:underline">Register Now →</a>
                    </div>
                </div>

                <!-- Event Card -->
                <div class="bg-white rounded-xl overflow-hidden">
                    <div class="aspect-video relative">
                        <img src="https://images.unsplash.com/photo-1475721027785-f74eccf877e2?q=80&w=1470&auto=format&fit=crop" 
                             class="w-full h-full object-cover" alt="Event Image">
                        <div class="absolute top-4 left-4 bg-green-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Online
                        </div>
                    </div>
                    <div class="p-6">
                        <time class="text-sm font-semibold text-neutral-500">15 Juli 2025</time>
                        <h3 class="text-xl font-bold mt-2 mb-3">Webinar: AI in Retail</h3>
                        <p class="text-slate-600 mb-4">Learn how AI is transforming the retail industry and how you can leverage it for your business.</p>
                        <a href="#" class="text-blue-600 font-semibold hover:underline">Register Now →</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resources Section -->
        <div class="mb-16">
            <h2 class="text-2xl font-bold text-slate-800 mb-8">Resources</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Resource Card -->
                <a href="#" class="group block">
                    <div class="bg-neutral-100 rounded-xl p-6 transition group-hover:bg-neutral-200">
                        <svg class="w-8 h-8 text-blue-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <h3 class="font-bold mb-2">Documentation</h3>
                        <p class="text-slate-600">Explore our comprehensive guides and API documentation</p>
                    </div>
                </a>

                <!-- Resource Card -->
                <a href="#" class="group block">
                    <div class="bg-neutral-100 rounded-xl p-6 transition group-hover:bg-neutral-200">
                        <svg class="w-8 h-8 text-blue-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        <h3 class="font-bold mb-2">Video Tutorials</h3>
                        <p class="text-slate-600">Watch step-by-step guides and product demonstrations</p>
                    </div>
                </a>

                <!-- Resource Card -->
                <a href="#" class="group block">
                    <div class="bg-neutral-100 rounded-xl p-6 transition group-hover:bg-neutral-200">
                        <svg class="w-8 h-8 text-blue-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                        </svg>
                        <h3 class="font-bold mb-2">Community Forum</h3>
                        <p class="text-slate-600">Join discussions and share experiences with other users</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
