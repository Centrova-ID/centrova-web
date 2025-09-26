@extends('partials.layouts.main')

@section('title', 'Kontak - Cara Menghubungi Kami')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-[#E3F2FD] to-white py-24">
    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-6xl font-bold text-[#004E8D] leading-tight mb-6">
            Hubungi <span class="text-[#128AEB]">Centrova</span>
        </h1>
        <p class="text-xl text-slate-600 max-w-4xl mx-auto leading-relaxed">
            Terima kasih telah menghubungi Centrova Indonesia. Kami sangat terbuka terhadap pertanyaan umum, kerja sama, dan hal-hal lain yang berkaitan dengan proyek kami.
        </p>
    </div>
</section>

<!-- Main Content -->
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Informasi Kontak -->
        <div class="mb-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-[#004E8D] mb-4">Informasi Kontak</h2>
                <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                    Berbagai cara untuk menghubungi tim Centrova
                </p>
            </div>
            
            <div class="bg-white rounded-2xl shadow-sm border p-8 md:p-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="h-16 w-16 bg-[#128AEB] text-white rounded-2xl flex items-center justify-center mb-6 mx-auto shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#004E8D] mb-3">Email</h3>
                        <a href="mailto:centrova@gmail.com" class="text-[#128AEB] hover:text-[#0F76C6] font-semibold text-lg">
                            centrova@gmail.com
                        </a>
                    </div>
                    
                    <div class="text-center">
                        <div class="h-16 w-16 bg-[#25D366] text-white rounded-2xl flex items-center justify-center mb-6 mx-auto shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#004E8D] mb-3">WhatsApp</h3>
                        <a href="https://wa.me/6285817909560" class="text-[#25D366] hover:text-[#128C7E] font-semibold text-lg">
                            0858 1790 9560
                        </a>
                    </div>
                    
                    <div class="text-center">
                        <div class="h-16 w-16 bg-slate-600 text-white rounded-2xl flex items-center justify-center mb-6 mx-auto shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#004E8D] mb-3">Domisili</h3>
                        <p class="text-slate-600 font-medium">Mangga Besar, Jakarta Barat, Indonesia</p>
                    </div>
                </div>
                
                <div class="mt-10 p-6 bg-slate-50 rounded-xl border">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-[#128AEB] mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-slate-600 leading-relaxed">
                            <span class="font-semibold text-[#004E8D]">Catatan:</span> Saat ini kami belum memiliki kantor resmi. Semua kegiatan proyek dilakukan secara remote dari berbagai lokasi.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulir Kontak -->
        <div class="mb-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-[#004E8D] mb-4">Formulir Kontak</h2>
                <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                    Kirimkan pesan Anda kepada kami dan kami akan meresponnya sesegera mungkin
                </p>
            </div>
            
            <div class="bg-white rounded-2xl shadow-sm border p-8 md:p-12">
                <form action="{{ route('contact.send') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-[#004E8D] mb-3">Nama Lengkap *</label>
                            <input type="text" name="name" id="name" required 
                                   class="w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl focus:border-[#128AEB] focus:outline-none text-slate-700 placeholder-slate-400"
                                   placeholder="Masukkan nama lengkap Anda">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-semibold text-[#004E8D] mb-3">Email *</label>
                            <input type="email" name="email" id="email" required 
                                   class="w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl focus:border-[#128AEB] focus:outline-none text-slate-700 placeholder-slate-400"
                                   placeholder="nama@email.com">
                        </div>
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-[#004E8D] mb-3">Nomor Telepon (Opsional)</label>
                        <input type="tel" name="phone" id="phone" 
                               class="w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl focus:border-[#128AEB] focus:outline-none text-slate-700 placeholder-slate-400"
                               placeholder="08xxxxxxxxxx">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-[#004E8D] mb-4">Topik Pesan</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="topic" value="umum" class="sr-only peer">
                                <div class="p-4 border-2 border-gray-200 rounded-xl peer-checked:border-[#128AEB] peer-checked:bg-[#128AEB]/5 hover:border-gray-300">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-4 h-4 rounded-full border-2 border-gray-300 peer-checked:border-[#128AEB] peer-checked:bg-[#128AEB] relative">
                                            <div class="absolute inset-1 rounded-full bg-white peer-checked:block hidden"></div>
                                        </div>
                                        <span class="font-medium text-slate-700">Umum</span>
                                    </div>
                                </div>
                            </label>
                            
                            <label class="relative cursor-pointer">
                                <input type="radio" name="topic" value="kerjasama" class="sr-only peer">
                                <div class="p-4 border-2 border-gray-200 rounded-xl peer-checked:border-[#128AEB] peer-checked:bg-[#128AEB]/5 hover:border-gray-300">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-4 h-4 rounded-full border-2 border-gray-300 peer-checked:border-[#128AEB] peer-checked:bg-[#128AEB] relative">
                                            <div class="absolute inset-1 rounded-full bg-white peer-checked:block hidden"></div>
                                        </div>
                                        <span class="font-medium text-slate-700">Kerja Sama</span>
                                    </div>
                                </div>
                            </label>
                            
                            <label class="relative cursor-pointer">
                                <input type="radio" name="topic" value="lainnya" class="sr-only peer">
                                <div class="p-4 border-2 border-gray-200 rounded-xl peer-checked:border-[#128AEB] peer-checked:bg-[#128AEB]/5 hover:border-gray-300">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-4 h-4 rounded-full border-2 border-gray-300 peer-checked:border-[#128AEB] peer-checked:bg-[#128AEB] relative">
                                            <div class="absolute inset-1 rounded-full bg-white peer-checked:block hidden"></div>
                                        </div>
                                        <span class="font-medium text-slate-700">Lainnya</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-semibold text-[#004E8D] mb-3">Pesan Anda *</label>
                        <textarea name="message" id="message" rows="6" required 
                                  class="w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl focus:border-[#128AEB] focus:outline-none text-slate-700 placeholder-slate-400 resize-none"
                                  placeholder="Tuliskan pesan Anda di sini..."></textarea>
                    </div>
                    
                    <div class="pt-4">
                        <button type="submit" 
                                class="w-full bg-[#128AEB] text-white font-bold py-4 px-8 rounded-xl shadow-md hover:bg-[#0F76C6] focus:outline-none">
                            <span class="flex items-center justify-center space-x-3">
                                <span>Kirim Pesan</span>
                                <svg class="w-5 h-5 rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                            </span>
                        </button>
                    </div>
                </form>
                
                <div class="mt-8 p-6 bg-amber-50 rounded-xl border border-amber-200">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-amber-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-slate-600 leading-relaxed">
                            <span class="font-semibold text-amber-700">Waktu Respons:</span> Kami akan berusaha membalas setiap pesan dalam waktu 24–48 jam di hari kerja. Jika Anda tidak menerima balasan dalam waktu tersebut, silakan hubungi kami kembali melalui email atau WhatsApp.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Media Sosial -->
        <div class="mb-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-[#004E8D] mb-4">Media Sosial</h2>
                <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                    Ikuti perkembangan terbaru Centrova di platform media sosial
                </p>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 md:p-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <a href="https://instagram.com/centrova.indonesia" 
                       class="flex items-center space-x-4 p-6 bg-slate-50 rounded-xl border border-slate-200 hover:border-slate-300">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-slate-600 rounded-xl flex items-center justify-center">
                                <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-slate-900 text-lg">Instagram</h3>
                            <p class="text-slate-600 truncate">@centrova.indonesia</p>
                        </div>
                    </a>
                    
                    <a href="https://linkedin.com/company/centrova-indonesia" 
                       class="flex items-center space-x-4 p-6 bg-slate-50 rounded-xl border border-slate-200 hover:border-slate-300">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-[#128AEB] rounded-xl flex items-center justify-center">
                                <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-slate-900 text-lg">LinkedIn</h3>
                            <p class="text-slate-600 truncate">Centrova Indonesia</p>
                        </div>
                    </a>
                    
                    <a href="https://github.com/centrova" 
                       class="flex items-center space-x-4 p-6 bg-slate-50 rounded-xl border border-slate-200 hover:border-slate-300">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-slate-800 rounded-xl flex items-center justify-center">
                                <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-slate-900 text-lg">GitHub</h3>
                            <p class="text-slate-600 truncate">github.com/centrova</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- FAQ -->
        <div class="mb-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-[#004E8D] mb-4">FAQ</h2>
                <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                    Pertanyaan yang sering diajukan tentang Centrova
                </p>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 md:p-12">
                <div class="space-y-8">
                    <div>
                        <div class="p-6 bg-white rounded-xl border border-[#128AEB]/20">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-[#128AEB] rounded-lg flex items-center justify-center">
                                        <span class="text-white font-bold text-sm">Q</span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold text-[#004E8D] mb-3">Apakah Centrova sudah terdaftar sebagai perusahaan resmi?</h3>
                                    <p class="text-slate-600 leading-relaxed">Belum, saat ini Centrova masih dalam tahap pengembangan awal proyek. Kami fokus pada pengembangan produk dan pembentukan tim yang solid sebelum melakukan registrasi formal sebagai entitas bisnis.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="p-6 bg-white rounded-xl border border-[#128AEB]/20">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-[#128AEB] rounded-lg flex items-center justify-center">
                                        <span class="text-white font-bold text-sm">Q</span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold text-[#004E8D] mb-3">Bagaimana cara kerja sama dengan Centrova?</h3>
                                    <p class="text-slate-600 leading-relaxed">Untuk memulai kerja sama, Anda dapat memilih topik "Kerja Sama" dalam formulir kontak di atas atau hubungi kami langsung melalui email di centrova@gmail.com atau WhatsApp di 0858 1790 9560. Tim kami akan merespons dan mendiskusikan peluang kolaborasi yang sesuai.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="p-6 bg-white rounded-xl border border-[#128AEB]/20">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-[#128AEB] rounded-lg flex items-center justify-center">
                                        <span class="text-white font-bold text-sm">Q</span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold text-[#004E8D] mb-3">Apakah Centrova memiliki layanan support?</h3>
                                    <p class="text-slate-600 leading-relaxed">Layanan dukungan teknis formal akan tersedia setelah produk kami resmi diluncurkan. Namun, untuk pertanyaan umum dan diskusi tentang proyek, Anda dapat menghubungi kami melalui channel komunikasi yang tersedia.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="p-6 bg-white rounded-xl border border-[#128AEB]/20">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-[#128AEB] rounded-lg flex items-center justify-center">
                                        <span class="text-white font-bold text-sm">Q</span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold text-[#004E8D] mb-3">Kapan produk Centrova akan diluncurkan?</h3>
                                    <p class="text-slate-600 leading-relaxed">Kami sedang dalam tahap pengembangan intensif dan akan mengumumkan timeline peluncuran resmi melalui website dan media sosial. Ikuti update terbaru kami untuk mendapatkan informasi peluncuran produk.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
