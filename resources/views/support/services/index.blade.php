@extends('partials.layouts.main')

@php
$helpSections = [
    [
        'title' => ' Sudah melakukan pembayaran namun proyek belum berjalan?',
        'description' => 'Temukan penyebab umum seperti dokumen yang belum lengkap, konfirmasi brief yang tertunda, atau antrean jadwal pengembangan.',
        'image' => 'https://www.gstatic.com/identity/boq/accountsettingsmobile/dataandpersonalization_icon_96x96_cdb6dff2e31ed6745ece4662231bfd48.png',
        'link' => route('legal.privacy'),
        'action_text' => 'Pelajari penyebab keterlambatan proyek'
    ],
    [
        'title' => 'Desain awal tidak sesuai dengan keinginan Anda?',
        'description' => 'Pelajari cara memberikan umpan balik yang efektif agar hasil desain lebih sesuai dengan visi dan kebutuhan bisnis Anda.',
        'image' => 'https://www.gstatic.com/identity/boq/accountsettingsmobile/securitycheckup_green_with_new_shield_96x96_26d2e3da755cc2e67209838c9cd08271.png',
        'link' => route('legal.privacy'),
        'action_text' => 'Panduan revisi desain secara profesional'
    ],
    [
        'title' => 'Sistem Anda mengalami kendala akses?',
        'description' => 'Temukan solusi umum untuk mengatasi permasalahan seperti error server, domain tidak aktif, atau kendala pada hosting dan koneksi.',
        'image' => 'https://www.gstatic.com/identity/boq/accountsettingsmobile/privacycheckup_scene_with_new_shield_316x112_6f524a4a87d89af8e0120501a6295875.png',
        'link' => route('legal.privacy'),
        'action_text' => 'Solusi untuk kendala akses sistem'
    ],
];
@endphp

@section('content')
<div>
	{{-- Hero Section --}}
	<div class="bg-neutral-50 relative z-0 overflow-hidden flex flex-col justify-center items-center pb-10">
		<div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-center items-center gap-6 mt-6">
		  
		  {{-- Text --}}
		  <div class="w-full text-center lg:text-left text-slate-800">
		    <span class="text-2xl md:text-3xl">Pusat Bantuan</span>
		    <h1 class="text-3xl md:text-5xl mt-4 md:mt-6 leading-snug md:leading-[54px] max-w-2xl font-medium text-slate-800">
		      Layanan Jasa <span class="text-[#128AEB]">Pengembangan Perangkat Lunak</span>
		    </h1>
		  </div>

		  {{-- Image --}}
		  <img 
		    src="https://www.gstatic.com/marketing-cms/assets/images/68/b9/a3c448e543cd82691ed417116133/overview-hero-2x.png=s616-fcrop64=1,00000000ffffffff-rw" 
		    class="w-full max-w-[400px] md:max-w-[500px] flex-shrink-0" 
		    alt="Illustration"
		  />
		</div>
		<div class="w-full max-w-7xl mx-auto px-12 sm:px-6 lg:px-8 mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

		  {{-- Website --}}
		  <a href="{{ route('support.services.web') }}" class="flex flex-col justify-center items-center bg-white rounded-lg p-8 hover:shadow border border-neutral-300/80">
		    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		      <path stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
		    </svg>
		    <h2 class="font-semibold text-lg mb-2 text-center text-slate-900">Website</h2>
		    <p class="text-slate-500 text-center">Kami bantu wujudkan website profesional sesuai identitas brand Anda.</p>
		  </a>

		  {{-- Aplikasi --}}
		  <a href="#" class="flex flex-col justify-center items-center bg-white rounded-lg p-8 hover:shadow border border-neutral-300/80">
		    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		      <path stroke-width="2" d="M9 2h6a2 2 0 012 2v16a2 2 0 01-2 2H9a2 2 0 01-2-2V4a2 2 0 012-2z"/>
		    </svg>
		    <h2 class="font-semibold text-lg mb-2 text-center text-slate-900">Aplikasi</h2>
		    <p class="text-slate-500 text-center">Solusi aplikasi yang dirancang khusus untuk mendukung operasional Anda.</p>
		  </a>

		  {{-- Mobile App --}}
		  <a href="#" class="flex flex-col justify-center items-center bg-white rounded-lg p-8 hover:shadow border border-neutral-300/80">
		    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		      <path stroke-width="2" d="M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
		    </svg>
		    <h2 class="font-semibold text-lg mb-2 text-center text-slate-900">Mobile</h2>
		    <p class="text-slate-500 text-center">Aplikasi mobile yang intuitif dan efisien untuk kebutuhan bisnis modern.</p>
		  </a>

		  {{-- Desain UI/UX --}}
		  <a href="#" class="flex flex-col justify-center items-center bg-white rounded-lg p-8 hover:shadow border border-neutral-300/80">
		    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-4 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		      <path stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
		    </svg>
		    <h2 class="font-semibold text-lg mb-2 text-center text-slate-900">Desain UI/UX</h2>
		    <p class="text-slate-500 text-center">Desain antarmuka yang nyaman, modern, dan mudah digunakan oleh pengguna.</p>
		  </a>

		</div>
	</div>

	<section class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 mt-10 grid grid-cols-1 sm:grid-cols-2 gap-8">
	  @foreach($helpSections as $index => $section)
	    <a href="{{ $section['link'] }}" class="flex-1 border border-neutral-200 rounded-2xl w-full @if(count($helpSections) % 2 == 1 && $index == count($helpSections) - 1) sm:col-span-2 @endif">
	      <div class="pt-6 pb-2 px-4 sm:px-6 max-md:py-4 flex items-start h-[174px] border-b border-neutral-200 gap-4 overflow-hidden">
	        <div class="flex-1 min-w-0">
	          <h3 class="text-lg sm:text-2xl text-gray-900 mb-2 tracking-tight truncate-2">{{ $section['title'] }}</h3>
	          <p class="mb-4 text-neutral-600 line-clamp-3 tracking-tight">{{ $section['description'] }}</p>
	        </div>
	        <div class="w-[20%] max-md:w-[35%] @if(count($helpSections) % 2 == 1 && $index == count($helpSections) - 1) hidden @else block @endif">
	          {{-- Gambar untuk card yang tidak sendirian dalam 1 baris --}}
	          <img src="{{ $section['image'] }}" class="w-full h-auto object-contain">
	          {{-- Gambar untuk card yang sendirian/memanjang dalam 1 baris --}}
	          <img src="{{ $section['image'] }}" class="w-full h-auto object-contain large @if(count($helpSections) % 2 == 1 && $index == count($helpSections) - 1) block @else hidden @endif">
	        </div>
	        <div class="w-[30%] max-md:w-[35%] h-full flex items-center @if(count($helpSections) % 2 == 1 && $index == count($helpSections) - 1) block @else hidden @endif">
	          {{-- Gambar untuk card yang sendirian/memanjang dalam 1 baris --}}
	          <img src="{{ $section['image'] }}" class="w-full h-auto object-contain">
	        </div>
	      </div>
	      <div class="py-4 px-4 sm:px-6 flex items-center text-[#128AEB] font-normal hover:underline transition hover:bg-neutral-50">
	        <span>{{ $section['action_text'] }}</span>
	        <svg class="w-[13.5px] h-[13.5px] ml-1 mt-[2.7px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
	          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
	        </svg>
	      </div>
	    </a>
	  @endforeach
	</section>

	{{-- Highlight Section: 1 --}}
	<section class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid grid-cols-1 gap-6">
	  <div class="flex-1 text-center bg-neutral-100 py-10 rounded-3xl">
	  	<img src="https://support.apple.com/content/dam/edam/applecare/images/en_US/psp/psp_content/content-block-sm-update-ios-device_2x.png" class="h-20 mx-auto mb-4">
	    <h3 class="text-3xl tracking-tight font-semibold text-gray-900 mb-3 max-w-4xl mx-auto">Panduan Memulai Proyek Bersama Centrova</h3>
	    <p class="text-slate-800 mb-4 max-w-4xl mx-auto text-lg">Pelajari tahapan lengkap kerja sama, mulai dari konsultasi awal, penawaran, proses pengembangan, hingga pelatihan dan dukungan teknis.</p>
	    <a href="{{ route('legal.privacy') }}" class="flex items-center text-blue-600 font-normal hover:underline transition justify-self-center">
	        <span>Lihat panduan kerja sama dengan Centrova</span>
	        <svg class="w-[13.5px] h-[13.5px] ml-1 mt-[3.1px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
	            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
	        </svg>
	    </a>
	  </div>
	</section>

	{{-- FAQ Section --}}
	<section class="py-24 bg-white" x-data="faqSection">
	  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
	    <div class="text-center mb-16">
	      <h2 class="text-4xl font-bold text-slate-900 mb-4">Frequently Asked Questions</h2>
	      <p class="text-xl text-slate-700">
	        Pertanyaan yang sering diajukan seputar layanan pengembangan perangkat lunak kami
	      </p>
	    </div>

	    <div class="divide-y divide-neutral-200 border-b border-neutral-200">
	      <template x-for="(faq, index) in faqs" :key="index">
	        <div class="py-0">
	          <!-- Button -->
	          <button 
	            @click="toggleFaq(index)"
	            class="w-full px-6 py-4 text-left flex items-center justify-between focus:ring-2 focus:ring-[#128AEB] focus:z-20 my-0.5 transition-colors"
	          >
	            <span class="font-semibold text-gray-900 text-xl" x-text="faq.question"></span>
	            <svg 
	              class="w-5 h-5 text-gray-500 transform transition-transform duration-300"
	              :class="{ 'rotate-180': openFaq === index }"
	              fill="none" 
	              stroke="currentColor" 
	              viewBox="0 0 24 24"
	            >
	              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
	            </svg>
	          </button>

	          <!-- Answer -->
	          <div
	            x-show="openFaq === index"
	            x-transition:enter="transition-[max-height] duration-1000 ease-in-out"
	            x-transition:leave="transition-[max-height] duration-1000 ease-in-out"
	            x-transition:enter-start="max-h-0"
	            x-transition:enter-end="max-h-[200px]"
	            x-transition:leave-start="max-h-[200px]"
	            x-transition:leave-end="max-h-0"
	            class="overflow-hidden will-change-transform will-change-opacity will-change-scroll-position"
	          >
	            <div class="px-6 pb-6 pt-3 text-slate-700 text-lg leading-relaxed" x-text="faq.answer"></div>
	          </div>
	        </div>
	      </template>
	    </div>
	  </div>
	  <script>
	    document.addEventListener('alpine:init', () => {
	      Alpine.data('faqSection', () => ({
	        openFaq: null,
	        faqs: [
	          { question: 'Berapa lama waktu pengerjaan website?', answer: 'Waktu pengerjaan bervariasi tergantung kompleksitas project. Landing page sederhana 1-2 minggu, website corporate 3-4 minggu, dan e-commerce atau marketplace 6-12 minggu. Kami akan memberikan timeline yang jelas di awal project.' },
	          { question: 'Apakah website yang dibuat mobile-friendly?', answer: 'Ya, semua website yang kami buat sudah responsive dan mobile-friendly. Kami memastikan tampilan dan functionality website optimal di semua device, mulai dari smartphone, tablet, hingga desktop.' },
	          { question: 'Apakah termasuk hosting dan domain?', answer: 'Paket kami fokus pada development website. Untuk hosting dan domain, kami bisa membantu setup di provider pilihan Anda atau merekomendasikan provider hosting terpercaya dengan harga terjangkau.' },
	          { question: 'Bagaimana sistem pembayaran?', answer: 'Sistem pembayaran dibagi menjadi beberapa termin: 30% di awal, 40% saat desain approved, dan 30% saat website selesai. Kami menerima transfer bank, e-wallet, dan metode pembayaran digital lainnya.' },
	          { question: 'Apakah bisa request revisi?', answer: 'Ya, kami memberikan kesempatan revisi sesuai scope project yang disepakati. Biasanya 2-3 kali revisi untuk desain dan 1-2 kali revisi untuk functionality. Revisi di luar scope akan dikenakan biaya tambahan.' },
	          { question: 'Apakah mendapat source code website?', answer: 'Ya, setelah project selesai dan pelunasan, Anda akan mendapat seluruh source code website beserta dokumentasinya. Anda memiliki full control atas website yang telah dibuat.' },
	          { question: 'Bagaimana dengan maintenance setelah website jadi?', answer: 'Kami menyediakan layanan maintenance dengan berbagai paket. Mulai dari basic maintenance (bug fixes, security updates) hingga comprehensive maintenance (feature development, performance optimization, content updates).' },
	          { question: 'Apakah website sudah SEO-ready?', answer: 'Ya, semua website yang kami buat sudah dioptimasi untuk SEO dasar, termasuk meta tags, site structure, loading speed, dan mobile optimization. Untuk advanced SEO, tersedia sebagai layanan tambahan.' }
	        ],
	        toggleFaq(index) {
	          this.openFaq = this.openFaq === index ? null : index;
	        },
	        init() {
	          this.openFaq = null;
	        }
	      }));
	    });
	  </script>
	</section>
</div>
@endsection