@extends('partials.layouts.main')

@section('title', 'Layanan - Custom Software Solution')

@section('content')
<div class="bg-gradient-to-b from-gray-50 to-white">
    <!-- Hero Section -->
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                Custom Software Solution
            </h1>
            <p class="text-xl text-gray-600 mb-12">
                Layanan pengembangan perangkat lunak sesuai kebutuhan bisnis, termasuk sistem akuntansi, HR, CRM, atau workflow automation.
            </p>
        </div>
    </div>

    <div class="w-full h-screen bg-gradient-to-b from-black to-white/10 flex flex-col">
        <div class="w-full bg-yellow-100 h-[32px] max-w-lg">
            
        </div>
    </div>

    <!-- Features Section -->
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Fokus Layanan</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <!-- Tailor-made -->
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="bg-yellow-100 rounded-lg p-3 inline-block mb-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Tailor-made</h3>
                    <p class="text-gray-600">Solusi yang disesuaikan dengan kebutuhan spesifik bisnis Anda.</p>
                </div>

                <!-- Scalable -->
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="bg-yellow-100 rounded-lg p-3 inline-block mb-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Scalable</h3>
                    <p class="text-gray-600">Sistem yang dapat berkembang seiring pertumbuhan bisnis.</p>
                </div>

                <!-- Future-Ready -->
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="bg-yellow-100 rounded-lg p-3 inline-block mb-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Future-Ready</h3>
                    <p class="text-gray-600">Teknologi modern yang siap untuk perkembangan masa depan.</p>
                </div>
            </div>

            <!-- Solutions List -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Solusi Bisnis</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Accounting System -->
                    <div class="p-6 bg-gray-50 rounded-lg">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-900">Sistem Akuntansi</h3>
                        </div>
                        <p class="text-gray-600">Manajemen keuangan terintegrasi dengan fitur pembukuan, pajak, dan laporan keuangan.</p>
                    </div>

                    <div class="flex items-center">
                      <img src="path/to/image.jpg" />
                      <div>
                        <strong>Andrew Alfred</strong>
                        <span>Technical advisor</span>
                      </div>
                    </div>

                    <!-- HR System -->
                    <div class="p-6 bg-gray-50 rounded-lg">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-900">Sistem HR</h3>
                        </div>
                        <p class="text-gray-600">Pengelolaan SDM lengkap dengan payroll, absensi, dan manajemen kinerja.</p>
                    </div>

                    <!-- CRM System -->
                    <div class="p-6 bg-gray-50 rounded-lg">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-900">Sistem CRM</h3>
                        </div>
                        <p class="text-gray-600">Manajemen pelanggan dan sales pipeline dengan analitik terintegrasi.</p>
                    </div>

                    <!-- Workflow Automation -->
                    <div class="p-6 bg-gray-50 rounded-lg">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-900">Workflow Automation</h3>
                        </div>
                        <p class="text-gray-600">Otomatisasi proses bisnis untuk meningkatkan efisiensi operasional.</p>
                    </div>
                </div>
            </div>

            <!-- Development Process -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Proses Pengembangan</h2>
                <div class="relative">
                    <div class="border-l-2 border-yellow-200 ml-3">
                        <div class="space-y-6">
                            <div class="flex items-center mb-8">
                                <div class="absolute left-0 bg-yellow-100 rounded-full w-8 h-8 flex items-center justify-center">
                                    <span class="text-yellow-600 font-semibold">1</span>
                                </div>
                                <div class="ml-12">
                                    <h3 class="font-semibold text-gray-900">Analisis Kebutuhan</h3>
                                    <p class="text-gray-600">Memahami proses bisnis dan kebutuhan spesifik perusahaan.</p>
                                </div>
                            </div>

                            <div class="flex items-center mb-8">
                                <div class="absolute left-0 bg-yellow-100 rounded-full w-8 h-8 flex items-center justify-center">
                                    <span class="text-yellow-600 font-semibold">2</span>
                                </div>
                                <div class="ml-12">
                                    <h3 class="font-semibold text-gray-900">Perancangan Sistem</h3>
                                    <p class="text-gray-600">Merancang arsitektur dan flow sistem yang optimal.</p>
                                </div>
                            </div>

                            <div class="flex items-center mb-8">
                                <div class="absolute left-0 bg-yellow-100 rounded-full w-8 h-8 flex items-center justify-center">
                                    <span class="text-yellow-600 font-semibold">3</span>
                                </div>
                                <div class="ml-12">
                                    <h3 class="font-semibold text-gray-900">Pengembangan</h3>
                                    <p class="text-gray-600">Membangun sistem dengan teknologi yang tepat dan modern.</p>
                                </div>
                            </div>

                            <div class="flex items-center mb-8">
                                <div class="absolute left-0 bg-yellow-100 rounded-full w-8 h-8 flex items-center justify-center">
                                    <span class="text-yellow-600 font-semibold">4</span>
                                </div>
                                <div class="ml-12">
                                    <h3 class="font-semibold text-gray-900">Testing & QA</h3>
                                    <p class="text-gray-600">Pengujian menyeluruh untuk memastikan kualitas sistem.</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="absolute left-0 bg-yellow-100 rounded-full w-8 h-8 flex items-center justify-center">
                                    <span class="text-yellow-600 font-semibold">5</span>
                                </div>
                                <div class="ml-12">
                                    <h3 class="font-semibold text-gray-900">Deployment & Support</h3>
                                    <p class="text-gray-600">Implementasi sistem dan dukungan berkelanjutan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
