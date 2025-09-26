@extends('partials.layouts.main')

@section('content')

<!-- News Detail Section -->
<div class="bg-white py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-slate-800">
        
        <!-- Article Header -->
        <article>
            <!-- Category & Metadata -->
            <div class="flex items-center text-neutral-500 text-sm font-medium space-x-3 mb-4">
                <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full">Technology</span>
                <span>•</span>
                <time datetime="2025-06-12">12 Juni 2025</time>
                <span>•</span>
                <span>5 min read</span>
            </div>

            <!-- Title & Subtitle -->
            <header class="mb-12">
                <h1 class="text-4xl md:text-5xl font-bold mb-5 leading-tight">Centrova Meluncurkan Fitur AI untuk Analisis Bisnis</h1>
                <p class="text-xl font-semibold text-slate-600 leading-relaxed">Inovasi terbaru dalam platform Centrova POS memungkinkan pemilik bisnis untuk mendapatkan wawasan mendalam tentang performa bisnis mereka melalui analisis AI yang canggih.</p>
            </header>

            <!-- Featured Image -->
            <figure class="rounded-2xl overflow-hidden mb-10">
                <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?q=80&w=1469&auto=format&fit=crop" 
                     alt="Centrova AI Analytics Dashboard" 
                     class="w-full h-[400px] object-cover rounded-2xl">
                <figcaption class="text-sm text-slate-500 mt-2 text-center">Tampilan dashboard Centrova AI Analytics yang baru diluncurkan</figcaption>
            </figure>

            <!-- Article Content -->
            <div class="prose lg:prose-lg max-w-none prose-slate prose-img:rounded-xl prose-a:text-blue-600 prose-headings:scroll-mt-16 text-lg space-y-6">
                
                <!-- Lead / Opening -->
                <div class="lead-paragraph text-lg text-slate-700 font-medium border-l-[3px] border-blue-500 pl-6 my-8">
                    Dalam langkah strategis untuk mendukung digitalisasi UMKM Indonesia, Centrova mengintegrasikan teknologi AI ke dalam platform POS mereka, memberikan akses ke analisis bisnis tingkat lanjut yang sebelumnya hanya tersedia untuk perusahaan besar.
                </div>

                <!-- Main Content -->
                <section id="introduction">
                    <h2 class="pt-6 text-2xl font-bold">Pengenalan Fitur AI Centrova</h2>
                    <p>
                        Centrova secara resmi meluncurkan fitur baru berbasis <strong>Artificial Intelligence (AI)</strong> yang dirancang khusus untuk pelaku usaha kecil dan menengah (UMKM). Fitur ini hadir dalam platform <em>Centrova Retail</em> dan dapat digunakan secara langsung tanpa biaya tambahan.
                    </p>            
                    <p>
                        Dengan fitur ini, pemilik bisnis dapat melihat performa usaha mereka melalui analisis data yang akurat dan real-time. Tujuan utamanya adalah mempermudah proses pengambilan keputusan tanpa harus melakukan analisis manual.
                    </p>
                </section>

                <section id="technology">
                    <h3 class="mt-8 text-xl font-semibold mb-4">Cara Kerja Teknologi</h3>
                    <p>
                        Teknologi ini menggunakan <em>machine learning</em> untuk mendeteksi pola dari data transaksi, pergerakan stok barang, hingga kebiasaan pelanggan. Beberapa insight yang disediakan meliputi:
                    </p>
                    <ol class="list-decimal list-outside ml-8 space-y-2">
                        <li>Produk yang paling laku selama periode tertentu</li>
                        <li>Jam operasional paling sibuk dalam sehari</li>
                        <li>Rekomendasi stok ulang sebelum kehabisan</li>
                        <li>Prediksi pendapatan di minggu atau bulan berikutnya</li>
                    </ol>

                    <!-- Expert Quote -->
                    <blockquote class="my-8 p-6 bg-slate-50 border-l-[3px] border-blue-500 rounded-lg">
                        <p class="text-xl italic mb-4">"Kami percaya AI bukan cuma untuk perusahaan besar. UMKM juga pantas mendapatkan alat yang powerful, namun tetap mudah digunakan."</p>
                        <footer class="font-medium">
                            — Ahmad Suryadi
                            <cite class="block text-sm text-slate-600 mt-1">CEO Centrova</cite>
                        </footer>
                    </blockquote>
                </section>

                <section id="features">
                    <h3 class="mt-8 text-xl font-semibold mb-4">Fitur Tambahan yang Mendukung</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-6">
                        <div class="p-6 bg-white rounded-lg border border-slate-200">
                            <h4 class="font-semibold mb-2">Ekspor Data</h4>
                            <p class="text-slate-600">Unduh laporan dalam format PDF dan Excel, atau kirim langsung via email ke tim.</p>
                        </div>
                        <div class="p-6 bg-white rounded-lg border border-slate-200">
                            <h4 class="font-semibold mb-2">Integrasi Sistem</h4>
                            <p class="text-slate-600">Dikembangkan oleh tim Centrova Labs dan kompatibel dengan versi 1.8 ke atas.</p>
                        </div>
                    </div>
                </section>

                <section id="future">
                    <h2 class="pt-8 text-2xl font-bold">Rencana Pengembangan Selanjutnya</h2>
                    <p>
                        Dalam roadmap pengembangan ke depan, Centrova akan meluncurkan fitur lanjutan bernama <strong>Centrova Copilot</strong>—sebuah asisten virtual berbasis AI yang mampu memberikan rekomendasi strategi bisnis secara personal dan kontekstual.
                    </p>

                    <!-- Supporting Image -->
                    <figure class="my-8">
                        <img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?q=80&w=1470&auto=format&fit=crop" 
                             alt="Tim Centrova sedang berkolaborasi" 
                             class="rounded-lg shadow-lg">
                        <figcaption class="text-sm text-slate-500 mt-2 text-center">Tim Centrova sedang mengembangkan fitur AI terbaru</figcaption>
                    </figure>

                    <h3 class="mt-8 text-xl font-semibold mb-4">Kolaborasi dengan Komunitas</h3>
                    <p>
                        Centrova juga membuka pintu kolaborasi dengan komunitas pengembang dan pengguna. Feedback, ide, dan permintaan fitur akan dikumpulkan dan dianalisis untuk terus menyempurnakan teknologi ini.
                    </p>
                </section>

                <!-- Author Info -->
                <footer class="border-t border-slate-200 mt-12 pt-8">
                    <div class="flex items-center space-x-4">
                        <img src="https://ui-avatars.com/api/?name=Admin+Centrova&background=0D8ABC&color=fff" 
                             alt="Author" 
                             class="w-12 h-12 rounded-full">
                        <div>
                            <h3 class="font-semibold">Admin Centrova</h3>
                            <p class="text-sm text-slate-600">Tech Writer at Centrova</p>
                        </div>
                    </div>
                </footer>

                <!-- Tags -->
                <div class="flex flex-wrap gap-2 mt-8">
                    <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-sm">#CentrovaAI</span>
                    <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-sm">#UMKM</span>
                    <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-sm">#Teknologi</span>
                    <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-sm">#BisnisDigital</span>
                </div>
            </div>
        </article>

        <!-- Navigation -->
        <nav class="mt-12">
            <div class="flex justify-between items-center border-t border-slate-200 pt-8">
                <a href="{{ url('../') }}" class="inline-flex items-center px-6 py-3 rounded-full bg-neutral-100 hover:bg-neutral-200 text-slate-700 font-semibold transition">
                    <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Berita
                </a>
                <a href="#" class="inline-flex items-center px-6 py-3 rounded-full bg-neutral-100 hover:bg-neutral-200 text-slate-700 font-semibold transition">
                    Artikel Berikutnya
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </nav>
    </div>
</div>

@endsection
