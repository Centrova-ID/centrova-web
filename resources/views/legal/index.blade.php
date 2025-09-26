@extends('partials.layouts.legal')

@section('space-top', 'no')

@section('content')
<div class="bg-neutral-100">
    <!-- Hero Section -->
    <div class="-mt-[110px] bg-white h-[500px] w-full relative z-0 flex justify-center items-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://www.apple.com/legal/images/heroes/rf-hello-blue-hero/rf-hello-blue-hero_large.jpg" srcset="https://www.apple.com/legal/images/heroes/rf-hello-blue-hero/rf-hello-blue-hero_large.jpg" sizes="(max-width:768px) 600px, 1200px" width="1200" height="800" loading="lazy" alt="Digital Business Solutions" class="w-full h-full object-cover max-md:object-right max-lg:hidden">
            <img src="https://www.apple.com/legal/images/heroes/rf-hello-blue-hero/rf-hello-blue-hero_small.jpg" srcset="https://www.apple.com/legal/images/heroes/rf-hello-blue-hero/rf-hello-blue-hero_small.jpg" sizes="(max-width:768px) 600px, 1200px" width="1200" height="800" loading="lazy" alt="Digital Business Solutions" class="w-full h-full object-cover max-md:object-center lg:hidden">
        </div>

        <div class="max-w-md mx-auto px-4 pt-24 sm:px-6 lg:px-8 text-center z-10 text-black">
            <h1 class="text-5xl font-semibold">Centrova Legal</h1>
            <p class="mt-4 text-xl">Temukan informasi dan dokumen hukum untuk produk dan layanan Centrova.</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Privacy Policy -->
            <div class="bg-white rounded-2xl">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-3 text-slate-900">Kebijakan Privasi</h2>
                    <p class="text-slate-800 text-[17px] mb-4">Pelajari bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda.</p>
                    <a href="{{ route('legal.privacy') }}" class="inline-flex items-center text-blue-600 font-medium hover:underline text-lg">
                        Selengkapnya
                        <svg class="w-4 h-4 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Terms of Service -->
            <div class="bg-white rounded-2xl">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-3 text-slate-900">Ketentuan Layanan</h2>
                    <p class="text-slate-800 text-[17px] mb-4">Baca ketentuan layanan dan syarat penggunaan kami.</p>
                    <a href="{{ route('legal.terms') }}" class="inline-flex items-center text-blue-600 font-medium hover:underline text-lg">
                        Selengkapnya
                        <svg class="w-4 h-4 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- License Agreement -->
            <div class="bg-white rounded-2xl">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-3 text-slate-900">Perjanjian Lisensi</h2>
                    <p class="text-slate-800 text-[17px] mb-4">Lihat perjanjian lisensi perangkat lunak dan ketentuan penggunaannya.</p>
                    <a href="{{ route('legal.license') }}" class="inline-flex items-center text-blue-600 font-medium hover:underline text-lg">
                        Selengkapnya
                        <svg class="w-4 h-4 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Trademark -->
            <div class="bg-white rounded-2xl">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-3 text-slate-900">Kebijakan Merek Dagang</h2>
                    <p class="text-slate-800 text-[17px] mb-4">Informasi tentang merek dagang kami dan penggunaannya dengan benar.</p>
                    <a href="{{ route('legal.trademark') }}" class="inline-flex items-center text-blue-600 font-medium hover:underline text-lg">
                        Selengkapnya
                        <svg class="w-4 h-4 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Copyright -->
            <div class="bg-white rounded-2xl">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-3 text-slate-900">Hak Cipta</h2>
                    <p class="text-slate-800 text-[17px] mb-4">Detail tentang kebijakan dan perlindungan hak cipta kami.</p>
                    <a href="{{ route('legal.copyright') }}" class="inline-flex items-center text-blue-600 font-medium hover:underline text-lg">
                        Selengkapnya
                        <svg class="w-4 h-4 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Compliance -->
            <div class="bg-white rounded-2xl">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-3 text-slate-900">Kepatuhan</h2>
                    <p class="text-slate-800 text-[17px] mb-4">Pelajari tentang kepatuhan regulasi dan standar kami.</p>
                    <a href="{{ route('legal.compliance') }}" class="inline-flex items-center text-blue-600 font-medium hover:underline text-lg">
                        Selengkapnya
                        <svg class="w-4 h-4 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Open Source -->
            <div class="bg-white rounded-2xl">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-3 text-slate-900">Open Source</h2>
                    <p class="text-slate-800 text-[17px] mb-4">Informasi tentang perangkat lunak open source yang kami gunakan.</p>
                    <a href="{{ route('legal.opensource') }}" class="inline-flex items-center text-blue-600 font-medium hover:underline text-lg">
                        Selengkapnya
                        <svg class="w-4 h-4 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Cookie Policy -->
            <div class="bg-white rounded-2xl">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-3 text-slate-900">Kebijakan Cookie</h2>
                    <p class="text-slate-800 text-[17px] mb-4">Memahami bagaimana kami menggunakan cookie di situs web kami.</p>
                    <a href="{{ route('legal.cookies') }}" class="inline-flex items-center text-blue-600 font-medium hover:underline text-lg">
                        Selengkapnya
                        <svg class="w-4 h-4 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Support Terms -->
            <div class="bg-white rounded-2xl">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-3 text-slate-900">Ketentuan Dukungan</h2>
                    <p class="text-slate-800 text-[17px] mb-4">Ketentuan dan persyaratan untuk layanan dukungan kami.</p>
                    <a href="{{ route('legal.support-terms') }}" class="inline-flex items-center text-blue-600 font-medium hover:underline text-lg">
                        Selengkapnya
                        <svg class="w-4 h-4 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Additional Links Section -->
        <div class="mt-12 bg-white rounded-2xl shadow-sm p-8">
            <h2 class="text-2xl font-semibold mb-6 text-gray-900">Tautan Legal Tambahan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('legal.retail-terms') }}" class="flex items-center group">
                    <div class="flex-1">
                        <h3 class="text-lg font-medium text-gray-900 group-hover:underline group-hover:text-blue-600">Ketentuan Retail</h3>
                        <p class="text-gray-600">Ketentuan khusus untuk pembelian dan layanan retail</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="{{ route('legal.disclaimer') }}" class="flex items-center group">
                    <div class="flex-1">
                        <h3 class="text-lg font-medium text-gray-900 group-hover:underline group-hover:text-blue-600">Disclaimer</h3>
                        <p class="text-gray-600">Penafian dan batasan tanggung jawab penting</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
