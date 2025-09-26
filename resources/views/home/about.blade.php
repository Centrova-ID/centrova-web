@extends('partials.layouts.main')

@section('content')
<div class="max-w-4xl mx-auto px-4 max-md:px-8 lg:px-8 text-center border-none border-neutral-300 pb-20 pt-28">
    <h1 class="text-4xl sm:text-5xl font-bold text-slate-900 mb-6">Tentang Centrova</h1>
    <p class="mt-8 text-xl text-neutral-900 w-full max-w-3xl mx-auto font-medium">
       Centrova adalah perusahaan teknologi yang berfokus pada inovasi dan layanan digitalisasi bisnis. Kami membantu berbagai sektor—dari wirausahawan hingga perusahaan—mengadopsi teknologi yang efisien, terintegrasi, dan relevan dengan kebutuhan lokal, untuk mempercepat transformasi menuju bisnis yang lebih produktif dan berdaya saing.
    </p>
</div>

<img src="https://images.ctfassets.net/kftzwdyauwt9/32cmTSUIF5POX5FMuoHJwO/be8b42b8016957ca28e07274f05f1d3d/stangel-2022-0527.webp?w=1920&q=90&fm=webp" class="w-full max-w-[1920px] mx-auto">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Company Story Section -->
    <div class="mb-16 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center px-6 sm:px-10 lg:px-20">
            <div class="prose prose-lg max-w-none">
                <h2 class="text-3xl font-bold text-slate-900 mb-6">
                    Visi Kami untuk Masa Depan Teknologi Cerdas
                </h2>
                <p class="text-slate-600">
                    Misi kami adalah memastikan bahwa kecerdasan buatan tingkat tinggi sistem yang secara umum lebih cerdas dari manusia—dapat memberikan manfaat bagi seluruh umat manusia.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 mt-6 max-md:justify-center max-md:items-center">
                    <a href="{{ route('services.index') }}?utm_source=learn"
                       class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150">
                        Pelajari selengkapnya
                    </a>
                    <a href="{{ route('services.index') }}" class="flex items-center text-[#128AEB] font-medium hover:underline transition">
                        <span>Lihat charter</span>
                        <svg class="w-[13.5px] h-[13.5px] ml-1 mt-[2.4px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
            <figure class="relative aspect-square w-full h-auto">
                <img src="https://images.ctfassets.net/kftzwdyauwt9/e632747f-9587-47a4-60779b6e0c90/cf75112eedea676e9deed512d191d1ac/planning-for-agi-and-beyond.jpg?w=1920&q=90&fm=webp"
                     alt="Centrova Office"
                     class="rounded-lg shadow-md object-cover w-full h-full">
                <figcaption class="text-sm text-slate-500 mt-4 text-center">
                    Illustration: Justin Jay Wang × DALL·E
                </figcaption>
            </figure>
        </div>
    </div>

</div>
@endsection
