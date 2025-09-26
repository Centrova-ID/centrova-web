@extends('partials.layouts.legal')

@section('title', 'Disclaimer')

@section('content')
<section class="relative bg-white py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center max-md:text-left pb-12">
        <h1 class="text-4xl sm:text-5xl font-semibold text-slate-800 mb-6">Disclaimer <span class="text-[#128AEB]">penggunaan website dan layanan teknologi kami</span></h1>
        <h2 class="font-semibold text-xl text-slate-900 mb-4">Diperbarui 4 September 2025</h2>
        <h2 class="text-xl font-medium text-neutral-900 mb-2">Informasi penting untuk melindungi kepentingan semua pihak dalam penggunaan layanan digital Centrova.</h2>
        
        <div class="mt-6 max-w-2xl mx-auto">
            <div class="text-center max-md:text-left mb-8">
                <p class="text-lg text-neutral-900 leading-relaxed mb-6">
                    Disclaimer ini mencakup penggunaan website, layanan pengembangan teknologi, estimasi biaya, portfolio showcase, dan sistem konsultasi digital kami.
                </p>

                <p class="text-lg text-neutral-900 leading-relaxed mb-8">
                    Anda dapat mempelajari setiap aspek disclaimer melalui 
                    bagian di bawah ini, dan <a href="{{ route('contact') }}" class="text-[#128AEB] hover:underline">hubungi kami</a> untuk konsultasi gratis jika membutuhkan klarifikasi.
                </p>

                <!-- Download and Links Section -->
                <div class="space-y-4">
                    <a href="#" class="inline-block text-[#128AEB] hover:underline font-medium text-lg">
                        Konsultasi Gratis Layanan Teknologi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Disclaimer FAQ Style Section --}}
    <section class="max-w-4xl mx-auto mt-12 px-4 sm:px-6 lg:px-8" x-data="disclaimerSection">
        <div class="divide-y divide-neutral-300">
            <template x-for="(section, index) in sections" :key="index">
                <div class="py-0 focus-within:border-b-2 focus-within:border-[#128AEB] transition">
                    <!-- Button -->
                    <button 
                        @click="toggleSection(index)"
                        class="w-full py-4 text-left flex items-center justify-between focus:z-20 my-0.5 transition-colors gap-2 group"
                    >
                        <span class="font-bold text-slate-900 text-xl sm:text-2xl leading-snug sm:leading-normal flex-wrap sm:flex-nowrap max-w-[80%] group-hover:text-[#128AEB]" x-text="section.title"></span>
                        <svg 
                            class="w-5 h-5 text-gray-500 group-hover:text-[#128AEB] transform transition-transform duration-300 flex-shrink-0"
                            :class="{ 'rotate-180': openSection === index }"
                            fill="none" 
                            stroke="currentColor" 
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Content -->
                    <div
                        x-show="openSection === index"
                        x-transition:enter="transition-[max-height] duration-[600ms] ease-in"
                        x-transition:leave="transition-[max-height] duration-[600ms] ease-out"
                        x-transition:enter-start="max-h-0"
                        x-transition:enter-end="max-h-[2000px]"
                        x-transition:leave-start="max-h-[2000px]"
                        x-transition:leave-end="max-h-0"
                        class="overflow-hidden will-change-transform will-change-opacity will-change-scroll-position"
                    >
                        <div class="pb-6 pt-2 text-slate-900 text-base leading-relaxed max-w-full prose prose-neutral" x-html="section.content"></div>
                    </div>
                </div>
            </template>
        </div>
    </section>

    @push('scripts')
    @once
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('disclaimerSection', () => ({
                openSection: null,
                sections: [
                    {
                        title: 'Informasi Layanan & Konten Website',
                        content: `
                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Website Centrova disediakan untuk memberikan informasi umum mengenai layanan teknologi digital kami, termasuk <strong>Web Development, Mobile App Development, UI/UX Design, dan Desktop Application Development</strong>. Kami berusaha menyajikan informasi yang akurat dan terbaru, namun tidak dapat menjamin kelengkapan atau ketepatan 100% dari semua konten yang ditampilkan.
                            </p>

                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Semua konten di website ini bersifat <strong>informasi umum</strong> dan dapat berubah sewaktu-waktu tanpa pemberitahuan sebelumnya, termasuk:
                            </p>

                            <ul class="list-disc pl-7 text-neutral-900 text-lg space-y-2 mb-4">
                                <li><strong>Portfolio & Showcase:</strong> Demo website dan aplikasi yang ditampilkan</li>
                                <li><strong>Artikel & Blog:</strong> Konten edukatif tentang teknologi dan bisnis digital</li>
                                <li><strong>Fitur Produk:</strong> Deskripsi kemampuan dan spesifikasi layanan</li>
                                <li><strong>Dokumentasi Teknis:</strong> Panduan penggunaan dan integrasi sistem</li>
                            </ul>

                            <p class="text-neutral-900 text-lg leading-relaxed">
                                Setiap keputusan bisnis atau teknis sebaiknya dilakukan setelah <strong>konsultasi gratis langsung dengan tim ahli kami</strong> untuk memastikan solusi yang tepat sesuai kebutuhan spesifik Anda.
                            </p>
                        `
                    },
                    {
                        title: 'Estimasi Biaya & Kalkulator Harga',
                        content: `
                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Estimasi harga yang ditampilkan di website kami (mulai dari <strong>Rp 1.5 juta untuk website sederhana hingga Rp 75+ juta untuk aplikasi enterprise</strong>) adalah <strong>simulasi perhitungan awal</strong> dan bukan merupakan penawaran resmi atau harga final.
                            </p>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">Faktor yang Mempengaruhi Harga Final:</h3>
                                <ul class="list-disc pl-7 text-neutral-900 text-lg space-y-2">
                                    <li><strong>Kompleksitas Fitur:</strong> Jumlah dan tingkat kesulitan fungsionalitas yang diminta</li>
                                    <li><strong>Desain Custom:</strong> Tingkat kustomisasi UI/UX dan branding requirements</li>
                                    <li><strong>Integrasi Sistem:</strong> Kebutuhan koneksi dengan database, API, atau platform pihak ketiga</li>
                                    <li><strong>Timeline Pengerjaan:</strong> Urgensi proyek dan jadwal yang diinginkan klien</li>
                                    <li><strong>Support & Maintenance:</strong> Durasi dan level dukungan teknis yang diperlukan</li>
                                </ul>
                            </div>

                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                <strong>Proses penentuan harga final:</strong> Tim kami akan melakukan analisis mendalam terhadap kebutuhan spesifik Anda melalui sesi konsultasi, kemudian menyusun proposal detail dengan breakdown biaya yang transparan dan akurat.
                            </p>

                            <p class="text-neutral-900 text-sm italic bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <strong>Catatan Penting:</strong> Semua harga yang tertera bersifat estimasi dan dapat berubah berdasarkan analisis kebutuhan yang mendalam. Centrova berkomitmen memberikan harga yang fair dan sesuai dengan value yang diberikan.
                            </p>
                        `
                    },
                    {
                        title: 'Layanan Teknologi & Tanggung Jawab',
                        content: `
                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Layanan yang kami tawarkan mencakup pengembangan teknologi digital dengan metodologi <strong>Agile development</strong> dan standar industri terkini. Namun, informasi yang ditampilkan di website hanyalah <strong>gambaran umum kemampuan</strong> kami.
                            </p>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">Layanan Utama Centrova:</h3>
                                <ul class="list-disc pl-7 text-neutral-900 text-lg space-y-2">
                                    <li><strong>Web Development:</strong> Website responsive, e-commerce, company profile, dan web application</li>
                                    <li><strong>Mobile App Development:</strong> Aplikasi Android & iOS native maupun hybrid</li>
                                    <li><strong>Desktop Application:</strong> Software desktop untuk kebutuhan bisnis dan enterprise</li>
                                    <li><strong>UI/UX Design:</strong> User research, wireframing, prototyping, dan design system</li>
                                </ul>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">Batasan Tanggung Jawab:</h3>
                                <ul class="list-disc pl-7 text-neutral-900 text-lg space-y-2">
                                    <li>Detail spesifikasi teknis dan fitur akan dituangkan dalam <strong>kontrak kerja atau proposal resmi</strong></li>
                                    <li>Centrova tidak bertanggung jawab atas kerugian yang timbul dari penggunaan informasi website tanpa konsultasi resmi</li>
                                    <li>Timeline pengerjaan dapat berubah berdasarkan kompleksitas dan perubahan scope yang diminta klien</li>
                                    <li>Dukungan purna jual dan maintenance mengikuti <strong>Service Level Agreement (SLA)</strong> yang disepakati</li>
                                </ul>
                            </div>

                            <p class="text-neutral-900 text-lg leading-relaxed">
                                Tim kami berkomitmen memberikan layanan terbaik dengan <strong>transparansi penuh</strong> mengenai progress, tantangan, dan solusi selama proses pengembangan.
                            </p>
                        `
                    },
                    {
                        title: 'Integrasi Pihak Ketiga & Teknologi',
                        content: `
                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Dalam pengembangan proyek teknologi, kami menggunakan berbagai layanan dan platform pihak ketiga untuk memberikan solusi terbaik. Centrova tidak mengontrol sepenuhnya layanan eksternal ini dan tidak bertanggung jawab atas gangguan atau kebijakan mereka.
                            </p>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">Teknologi & Platform yang Sering Digunakan:</h3>
                                <ul class="list-disc pl-7 text-neutral-900 text-lg space-y-2">
                                    <li><strong>Cloud Hosting:</strong> AWS, Google Cloud, DigitalOcean untuk infrastruktur server</li>
                                    <li><strong>Payment Gateway:</strong> Midtrans, Xendit, PayPal untuk sistem pembayaran</li>
                                    <li><strong>Database Services:</strong> MySQL, PostgreSQL, MongoDB, Firebase</li>
                                    <li><strong>API Services:</strong> Google Maps, WhatsApp Business API, social media integration</li>
                                    <li><strong>Analytics:</strong> Google Analytics, Facebook Pixel, heat mapping tools</li>
                                    <li><strong>Security:</strong> SSL certificates, firewall protection, security monitoring</li>
                                </ul>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">Framework & Tools Development:</h3>
                                <ul class="list-disc pl-7 text-neutral-900 text-lg space-y-2">
                                    <li><strong>Web:</strong> Laravel, React, Vue.js, Next.js, Tailwind CSS</li>
                                    <li><strong>Mobile:</strong> React Native, Flutter, native Android & iOS development</li>
                                    <li><strong>Desktop:</strong> Electron, .NET, Python, Java</li>
                                    <li><strong>Design:</strong> Figma, Adobe Creative Suite, prototyping tools</li>
                                </ul>
                            </div>

                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Semua teknologi yang kami gunakan tetap tunduk pada <strong>syarat, ketentuan, dan lisensi masing-masing pihak</strong>. Kami akan memberikan informasi lengkap mengenai dependencies dan persyaratan lisensi dalam dokumentasi proyek.
                            </p>

                            <p class="text-neutral-900 text-sm italic bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <strong>Rekomendasi:</strong> Selalu review syarat dan ketentuan layanan pihak ketiga yang akan diintegrasikan dalam proyek Anda untuk memastikan compliance dengan kebutuhan bisnis dan legal.
                            </p>
                        `
                    },
                    {
                        title: 'Hak Kekayaan Intelektual & Portfolio',
                        content: `
                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Semua konten yang ditampilkan di website Centrova, termasuk <strong>portfolio, demo aplikasi, source code, desain, metodologi, dan dokumentasi</strong> adalah hak kekayaan intelektual yang dilindungi oleh hukum copyright dan trademark.
                            </p>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">Materi yang Dilindungi:</h3>
                                <ul class="list-disc pl-7 text-neutral-900 text-lg space-y-2">
                                    <li><strong>Source Code & Algorithm:</strong> Kode program dan logika bisnis yang kami kembangkan</li>
                                    <li><strong>UI/UX Design:</strong> Desain interface, icon, layout, dan design system</li>
                                    <li><strong>Portfolio Showcase:</strong> Demo website dan aplikasi yang ditampilkan</li>
                                    <li><strong>Brand Assets:</strong> Logo, nama Centrova, color scheme, dan identitas visual</li>
                                    <li><strong>Dokumentasi:</strong> Tutorial, panduan, dan knowledge base yang kami buat</li>
                                    <li><strong>Metodologi:</strong> Framework kerja dan best practices yang kami terapkan</li>
                                </ul>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">Kebijakan Penggunaan:</h3>
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-4">
                                    <p class="text-neutral-900 text-lg leading-relaxed mb-2">
                                        <strong>Dilarang:</strong> Reproduksi, distribusi, modifikasi, atau penggunaan komersial tanpa izin tertulis
                                    </p>
                                    <p class="text-neutral-900 text-lg leading-relaxed">
                                        <strong>Diizinkan:</strong> Viewing dan referensi untuk keperluan evaluasi layanan kami
                                    </p>
                                </div>
                            </div>

                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Untuk klien yang menggunakan layanan kami, <strong>hak kepemilikan hasil akhir proyek</strong> akan diatur dalam kontrak kerja dengan ketentuan yang jelas mengenai source code ownership, licensing, dan usage rights.
                            </p>

                            <p class="text-neutral-900 text-lg leading-relaxed">
                                Jika Anda tertarik menggunakan atau mengutip materi kami untuk keperluan penelitian, pendidikan, atau kolaborasi bisnis, silakan hubungi tim legal kami di <a href="mailto:legal@centrova.com" class="text-[#128AEB] hover:underline">legal@centrova.com</a>.
                            </p>
                        `
                    },
                    {
                        title: 'Ketersediaan Layanan & Sistem',
                        content: `
                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Website dan layanan digital Centrova disediakan <strong>"sebagaimana adanya"</strong> tanpa jaminan bahwa semua fitur akan selalu berfungsi tanpa gangguan, bebas dari error, atau sepenuhnya aman dari ancaman cyber.
                            </p>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">Kondisi yang Dapat Mempengaruhi Layanan:</h3>
                                <ul class="list-disc pl-7 text-neutral-900 text-lg space-y-2">
                                    <li><strong>Maintenance Terjadwal:</strong> Update sistem, security patch, dan pengembangan fitur baru</li>
                                    <li><strong>Gangguan Teknis:</strong> Server downtime, network issues, atau masalah infrastruktur</li>
                                    <li><strong>Force Majeure:</strong> Bencana alam, pemadaman listrik, atau kondisi di luar kendali</li>
                                    <li><strong>Cyber Security:</strong> Serangan DDoS, hacking attempt, atau threat lainnya</li>
                                    <li><strong>Third-party Dependencies:</strong> Gangguan pada layanan hosting, API, atau platform eksternal</li>
                                </ul>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">Upaya Mitigasi yang Kami Lakukan:</h3>
                                <ul class="list-disc pl-7 text-neutral-900 text-lg space-y-2">
                                    <li><strong>Monitoring 24/7:</strong> Sistem pemantauan otomatis untuk deteksi dini masalah</li>
                                    <li><strong>Backup Rutin:</strong> Backup data dan konfigurasi sistem secara berkala</li>
                                    <li><strong>Security Measures:</strong> Firewall, SSL certificate, dan proteksi berlapis</li>
                                    <li><strong>Rapid Response:</strong> Tim teknis siaga untuk penanganan cepat gangguan</li>
                                    <li><strong>Communication:</strong> Update status dan estimasi recovery time melalui multiple channel</li>
                                </ul>
                            </div>

                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Untuk proyek klien, kami akan menyediakan <strong>Service Level Agreement (SLA)</strong> yang spesifik mengenai uptime guarantee, response time, dan prosedur escalation jika terjadi masalah teknis.
                            </p>

                            <p class="text-neutral-900 text-sm italic bg-red-50 border border-red-200 rounded-lg p-4">
                                <strong>Disclaimer:</strong> Meskipun kami berusaha maksimal, tidak ada sistem teknologi yang 100% bebas dari risiko. Kami menolak jaminan tersirat mengenai kelayakan komersial dan kesesuaian untuk tujuan tertentu.
                            </p>
                        `
                    },
                    {
                        title: 'Perubahan Kebijakan & Layanan',
                        content: `
                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Seiring dengan perkembangan teknologi dan kebutuhan pasar, Centrova berhak mengubah konten website, struktur layanan, metodologi pengembangan, harga, maupun disclaimer ini kapan saja untuk memberikan layanan yang lebih baik.
                            </p>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">Jenis Perubahan yang Mungkin Terjadi:</h3>
                                <ul class="list-disc pl-7 text-neutral-900 text-lg space-y-2">
                                    <li><strong>Pengembangan Fitur:</strong> Penambahan layanan baru seperti AI integration, blockchain development</li>
                                    <li><strong>Update Teknologi:</strong> Migrasi ke framework atau tools yang lebih modern</li>
                                    <li><strong>Struktur Harga:</strong> Penyesuaian paket layanan berdasarkan feedback pasar</li>
                                    <li><strong>Metodologi:</strong> Improvement pada workflow development dan project management</li>
                                    <li><strong>Kebijakan Legal:</strong> Update disclaimer, privacy policy, atau terms of service</li>
                                </ul>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">Cara Kami Mengkomunikasikan Perubahan:</h3>
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <ul class="list-disc pl-7 text-neutral-900 text-lg space-y-2">
                                        <li><strong>Email Notification:</strong> Untuk perubahan yang signifikan kepada klien terdaftar</li>
                                        <li><strong>Website Announcement:</strong> Pengumuman di halaman utama untuk update major</li>
                                        <li><strong>Blog & News:</strong> Artikel detail mengenai perubahan fitur atau layanan</li>
                                        <li><strong>Direct Communication:</strong> Personal notification untuk klien yang sedang dalam proses pengembangan</li>
                                    </ul>
                                </div>
                            </div>

                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                <strong>Untuk proyek yang sedang berjalan:</strong> Perubahan kebijakan tidak akan mempengaruhi kontrak yang sudah ditandatangani dan masih dalam masa pengerjaan, kecuali ada mutual agreement antara kedua belah pihak.
                            </p>

                            <p class="text-neutral-900 text-lg leading-relaxed">
                                Dengan mengakses dan menggunakan website atau layanan kami, Anda dianggap telah membaca, memahami, dan menyetujui disclaimer ini beserta setiap perubahannya di masa depan.
                            </p>
                        `
                    },
                    {
                        title: 'Kontak & Konsultasi Gratis',
                        content: `
                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Tim Centrova siap membantu Anda memahami setiap aspek disclaimer ini atau menjawab pertanyaan mengenai layanan teknologi yang kami tawarkan melalui <strong>konsultasi gratis tanpa komitmen</strong>.
                            </p>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">Channel Komunikasi Resmi:</h3>
                                <div class="border border-gray-200 rounded-lg p-6 space-y-3">
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">📧</span>
                                        <div>
                                            <p class="font-semibold">Email Legal & Compliance</p>
                                            <p class="text-[#128AEB]">legal@centrova.com</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">💼</span>
                                        <div>
                                            <p class="font-semibold">Konsultasi Bisnis & Teknis</p>
                                            <p class="text-[#128AEB]">hello@centrova.com</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">📱</span>
                                        <div>
                                            <p class="font-semibold">WhatsApp Support</p>
                                            <p class="text-[#128AEB]">+62 858-1790-9560</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">🏢</span>
                                        <div>
                                            <p class="font-semibold">Alamat Kantor</p>
                                            <p>Jakarta, Indonesia</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">Layanan Konsultasi yang Tersedia:</h3>
                                <ul class="list-disc pl-7 text-neutral-900 text-lg space-y-2">
                                    <li><strong>Technology Consultation:</strong> Pemilihan tech stack yang tepat untuk proyek Anda</li>
                                    <li><strong>Business Analysis:</strong> Analisis kebutuhan sistem dan rekomendasi solusi</li>
                                    <li><strong>Project Planning:</strong> Estimasi timeline, budget, dan resource requirements</li>
                                    <li><strong>Legal & Compliance:</strong> Diskusi mengenai ownership, licensing, dan legal aspects</li>
                                </ul>
                            </div>

                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                <strong>Response Time:</strong> Tim kami berkomitmen merespons setiap inquiry dalam waktu maksimal 24 jam pada hari kerja, dan menyediakan waktu konsultasi yang fleksibel sesuai kebutuhan Anda.
                            </p>

                            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <p class="text-neutral-900 text-lg leading-relaxed font-medium">
                                    💡 <strong>Konsultasi Gratis:</strong> Tim ahli kami siap memberikan advice dan recommendation untuk membantu Anda memilih solusi teknologi yang tepat sesuai kebutuhan dan budget bisnis Anda.
                                </p>
                            </div>
                        `
                    }
                ],
                toggleSection(index) {
                    this.openSection = this.openSection === index ? null : index;
                },
                init() {
                    // Pastikan tidak ada section yang terbuka saat init
                    this.openSection = null;
                }
            }));
        });
    </script>
    @endonce
    @endpush
</section>
@endsection
