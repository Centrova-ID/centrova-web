@extends('partials.layouts.careers')

{{-- @section('title', 'Centrova Developer') --}}

@section('content')
<!-- Hero Section -->
<div class="relative">
    <!-- Background image with overlay -->
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 w-full h-full bg-[#128AEB]/90"></div>
    </div>
    
    <!-- Content -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 min-h-[400px] flex items-center">
        <div class="max-w-3xl w-full space-y-8 text-white">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold leading-tight">
                Karena perubahan itu penting
            </h1>
            <p class="text-xl">
                Kami mencari talenta-talenta berbakat untuk bersama-sama menciptakan solusi digital yang mengubah bisnis.
            </p>
            
            <!-- Search Box -->
            <div class="bg-white rounded-full max-md:rounded-2xl shadow-lg max-md:p-3 p-1 mt-6">
                <form class="flex flex-col md:flex-row gap-2">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-full leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-[#128AEB] focus:border-[#128AEB] text-gray-900" 
                               placeholder="Cari posisi...">
                    </div>
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <input type="text" 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-full leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-[#128AEB] focus:border-[#128AEB] text-gray-900" 
                               placeholder="Lokasi">
                    </div>
                    <button type="submit" 
                            class="px-6 py-2 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-[#128AEB] transition">
                        Cari Lowongan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Career Opportunities Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-[#004E8D] mb-4">Peluang Karir di Centrova</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Kami menawarkan lingkungan kerja yang dinamis, peluang pengembangan karir, dan kesempatan untuk bekerja pada proyek-proyek menarik.
            </p>
        </div>

        <!-- Job Openings -->
        <div class="max-w-4xl mx-auto">
            <h3 class="text-2xl font-semibold text-gray-800 mb-8">Posisi yang Sedang Dibuka</h3>
            
            <!-- Job Listing 1: Frontend Developer with Qualifications -->
            <div class="border border-gray-200 rounded-lg overflow-hidden mb-6 transition-shadow duration-150">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start">
                        <div class="mb-4 md:mb-0 w-full">
                            <h4 class="text-xl font-semibold text-[#128AEB]">Frontend Developer</h4>
                            <div class="flex items-center mt-2 text-gray-600">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span>Full-time</span>
                                <span class="mx-2">•</span>
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Jakarta (Hybrid)</span>
                            </div>

                            <!-- Qualifications Section -->
                            <div class="mt-4 text-gray-700 text-base">
                                <h5 class="font-medium mb-2">Kualifikasi Minimum:</h5>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Pengalaman minimal 1 tahun dalam pengembangan frontend.</li>
                                    <li>Menguasai HTML, CSS, JavaScript, dan framework seperti React atau Vue.</li>
                                    <li>Berpengalaman dengan Tailwind CSS menjadi nilai tambah.</li>
                                    <li>Kemampuan bekerja tim dan komunikasi yang baik.</li>
                                </ul>
                            </div>
                        </div>
                        <a href="/karir/frontend-developer"
                            class="mt-6 md:mt-0 md:ml-6 inline-flex items-center justify-center px-6 py-2 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition whitespace-nowrap">
                            Lamar Sekarang
                        </a>
                    </div>
                </div>
            </div>

            <!-- Job Listing 2 -->
            <div class="border border-gray-200 rounded-lg overflow-hidden mb-6 transition-shadow duration-150">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                        <div class="mb-4 md:mb-0">
                            <h4 class="text-xl font-semibold text-[#128AEB]">Backend Developer</h4>
                            <div class="flex items-center mt-2 text-gray-600">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span>Full-time</span>
                                <span class="mx-2">•</span>
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Remote</span>
                            </div>
                        </div>
                        <a href="/karir/backend-developer" class="inline-flex items-center justify-center px-6 py-2 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition">
                            Lamar Sekarang
                        </a>
                    </div>
                </div>
            </div>

            <!-- Job Listing 3 -->
            <div class="border border-gray-200 rounded-lg overflow-hidden mb-6 transition-shadow duration-150">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                        <div class="mb-4 md:mb-0">
                            <h4 class="text-xl font-semibold text-[#128AEB]">UI/UX Designer</h4>
                            <div class="flex items-center mt-2 text-gray-600">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span>Full-time</span>
                                <span class="mx-2">•</span>
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Bandung (Hybrid)</span>
                            </div>
                        </div>
                        <a href="/karir/ui-ux-designer" class="inline-flex items-center justify-center px-6 py-2 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition">
                            Lamar Sekarang
                        </a>
                    </div>
                </div>
            </div>

            <!-- Job Listing 4 -->
            <div class="border border-gray-200 rounded-lg overflow-hidden mb-6 transition-shadow duration-150">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                        <div class="mb-4 md:mb-0">
                            <h4 class="text-xl font-semibold text-[#128AEB]">Digital Marketing Specialist</h4>
                            <div class="flex items-center mt-2 text-gray-600">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span>Full-time</span>
                                <span class="mx-2">•</span>
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Jakarta (On-site)</span>
                            </div>
                        </div>
                        <a href="/karir/digital-marketing" class="inline-flex items-center justify-center px-6 py-2 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition">
                            Lamar Sekarang
                        </a>
                    </div>
                </div>
            </div>

            <!-- No Open Positions -->
            <div class="text-center py-12 hidden">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">Tidak ada lowongan saat ini</h3>
                <p class="mt-1 text-gray-500">Silakan periksa kembali di lain waktu untuk peluang karir di Centrova.</p>
            </div>
        </div>
    </div>
</div>

<!-- Why Join Us Section -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-[#004E8D] mb-4">Mengapa Bergabung dengan Centrova?</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Kami menawarkan lebih dari sekadar pekerjaan - kami menawarkan lingkungan untuk berkembang dan membuat dampak.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Benefit 1 -->
            <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="w-14 h-14 bg-[#E3F2FD] rounded-full flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Pengembangan Karir</h3>
                <p class="text-gray-600">
                    Program pelatihan reguler, mentoring, dan kesempatan untuk mempelajari teknologi terbaru.
                </p>
            </div>

            <!-- Benefit 2 -->
            <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="w-14 h-14 bg-[#E3F2FD] rounded-full flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Fleksibilitas Kerja</h3>
                <p class="text-gray-600">
                    Kebijakan kerja hybrid/remote dan jam kerja fleksibel untuk keseimbangan kerja-hidup yang lebih baik.
                </p>
            </div>

            <!-- Benefit 3 -->
            <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="w-14 h-14 bg-[#E3F2FD] rounded-full flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Tim yang Kolaboratif</h3>
                <p class="text-gray-600">
                    Bekerja dengan tim yang beragam, berbakat, dan suportif yang mendorong inovasi.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Employee Testimonials -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-[#004E8D] mb-4">Apa Kata Tim Kami</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Dengarkan langsung dari karyawan kami tentang pengalaman mereka bekerja di Centrova.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Testimonial 1 -->
            <div class="bg-gray-50 p-8 rounded-lg">
                <div class="flex items-center mb-6">
                    <img class="w-12 h-12 rounded-full object-cover mr-4" src="https://randomuser.me/api/portraits/women/43.jpg" alt="Sarah Wijaya">
                    <div>
                        <h4 class="font-semibold text-gray-800">Sarah Wijaya</h4>
                        <p class="text-sm text-gray-600">Frontend Developer</p>
                    </div>
                </div>
                <p class="text-gray-700 italic">
                    "Sejak bergabung dengan Centrova, saya mendapatkan banyak kesempatan untuk mengembangkan keterampilan saya. Budaya perusahaan yang mendukung dan proyek-proyek menarik membuat setiap hari menjadi tantangan yang menyenangkan."
                </p>
            </div>

            <!-- Testimonial 2 -->
            <div class="bg-gray-50 p-8 rounded-lg">
                <div class="flex items-center mb-6">
                    <img class="w-12 h-12 rounded-full object-cover mr-4" src="https://randomuser.me/api/portraits/men/32.jpg" alt="Budi Santoso">
                    <div>
                        <h4 class="font-semibold text-gray-800">Budi Santoso</h4>
                        <p class="text-sm text-gray-600">Product Manager</p>
                    </div>
                </div>
                <p class="text-gray-700 italic">
                    "Apa yang saya sukai dari Centrova adalah bagaimana setiap anggota tim didengar dan ide-ide mereka dihargai. Fleksibilitas kerja juga membantu saya menjaga keseimbangan antara pekerjaan dan kehidupan pribadi."
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="bg-gradient-to-r from-[#004E8D] to-[#128AEB] py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-6">Siap untuk Bergabung dengan Tim Kami?</h2>
        <p class="text-white/90 mb-8 text-lg">
            Jika Anda tidak melihat posisi yang sesuai tetapi merasa memiliki keterampilan yang kami butuhkan, jangan ragu untuk mengirimkan lamaran spontan.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/contact" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-bold rounded-full text-[#128AEB] bg-white hover:bg-[#E3F2FD] shadow transition">
                Kirim Lamaran Spontan
            </a>
            <a href="mailto:hr@centrova.com" class="inline-flex items-center justify-center px-6 py-3 border-2 border-white text-base font-bold rounded-full text-white hover:bg-white/10 transition">
                Hubungi HR
            </a>
        </div>
    </div>
</div>

@endsection
