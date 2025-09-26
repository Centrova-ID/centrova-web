@extends('partials.layouts.legal')

@section('title', 'Kebijakan Privasi')

@section('content')
<section class="relative bg-white py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center max-md:text-left pb-12">
        <h1 class="text-4xl sm:text-5xl font-semibold text-slate-800 mb-6">Kebijakan privasi <span class="text-[#128AEB]">komitmen kami dalam menjaga data anda</span></h1>
        <h2 class="font-semibold text-xl text-slate-900 mb-4">Diperbarui 30 Juli 2025</h2>
        <h2 class="text-xl font-medium text-neutral-900 mb-2">Data Anda bersifat pribadi di kantor, di rumah, dan dalam perjalanan.</h2>
        
        <div class="mt-6 max-w-2xl mx-auto">
            <div class="text-center max-md:text-left mb-8">
                <p class="text-lg text-neutral-900 leading-relaxed mb-6">
                    Selain Kebijakan Privasi ini, informasi tentang penggunaan data pribadi juga tersedia langsung di produk dan fitur tertentu.
                </p>

                <p class="text-lg text-neutral-900 leading-relaxed mb-8">
                    Anda dapat mempelajari praktik privasi kami, yang dapat diakses melalui 
                    judul di bawah, dan <a href="{{ route('legal.privacy.contact') }}" class="text-[#128AEB] hover:underline">hubungi kami</a> jika Anda memiliki pertanyaan.
                </p>

                <!-- Download and Links Section -->
                <div class="space-y-4">
                    <a href="{{ route('legal.privacy.pdf') }}" class="inline-block text-[#128AEB] hover:underline font-medium text-lg">
                        Unduh salinan Kebijakan Privasi ini (PDF)
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Privacy Policy FAQ Style Section --}}
    <section class="max-w-4xl mx-auto mt-12 px-4 sm:px-6 lg:px-8" x-data="privacyPolicySection">
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
            Alpine.data('privacyPolicySection', () => ({
                openSection: null,
                sections: [
                    {
                        title: 'Data Pribadi Anda di Centrova',
                        content: `
                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Di Centrova, kami memandang <strong>privasi sebagai hak mendasar setiap pelanggan</strong> yang menggunakan layanan kami. 
                                Hak ini berlaku sama untuk semua pelanggan, tanpa memandang lokasi atau jenis layanan yang digunakan.
                            </p>

                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Kami menganggap setiap <strong>informasi yang dapat mengidentifikasi atau dihubungkan dengan individu</strong> oleh Centrova sebagai 
                                data pribadi. Data pribadi mencakup informasi yang secara langsung mengidentifikasi Anda — seperti 
                                nama, alamat, atau nomor kontak — serta informasi yang 
                                tidak secara langsung mengidentifikasi, tetapi dapat digunakan untuk mengenali Anda, 
                                seperti username unik atau catatan komunikasi chat. 
                                Informasi yang telah dianonimkan sehingga tidak lagi dapat dikaitkan dengan individu tertentu akan diperlakukan 
                                sebagai informasi nonpribadi.
                            </p>

                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Kebijakan ini tidak mencakup bagaimana pihak ketiga tersebut mengelola data pribadi Anda, sehingga kami menyarankan Anda untuk 
                                <strong>membaca kebijakan privasi mereka sebelum berbagi informasi</strong>.
                            </p>

                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Untuk menggunakan hak-hak privasi Anda, kunjungi halaman <a href="{{ route('data-rights.index') }}" class="text-[#128AEB] hover:underline">Hak Data Pribadi</a> 
                                atau hubungi kami di <a href="mailto:privacy@centrova.com" class="text-[#128AEB] hover:underline">privacy@centrova.com</a>.
                            </p>
                        `
                    },
                    {
                        title: 'Hak Privasi Anda Sebagai Subjek Data',
                        content: `
                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Di Centrova, kami menghargai hak Anda untuk mengetahui, mengakses, memperbaiki, mentransfer, membatasi pemrosesan, dan menghapus data pribadi Anda. Hak-hak ini kami berikan kepada seluruh pelanggan kami, tanpa memandang lokasi atau jenis layanan yang digunakan. Jika Anda memilih untuk menggunakan hak privasi ini, Anda berhak untuk tidak diperlakukan secara diskriminatif atau menerima tingkat layanan yang lebih rendah dari Centrova.
                            </p>
                            
                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Apabila Anda diminta untuk menyetujui pemrosesan data pribadi oleh Centrova, Anda berhak untuk menarik persetujuan tersebut kapan saja melalui pengaturan akun Anda atau dengan <a href="{{ route('legal.privacy.contact') }}" class="text-[#128AEB] hover:underline">menghubungi kami</a>.
                            </p>

                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Untuk menggunakan hak dan pilihan privasi Anda, termasuk ketika penyedia layanan pihak ketiga bertindak atas nama Centrova, silakan masuk ke akun Anda dan kunjungi halaman <a href="{{ route('data-rights.index') }}" class="text-[#128AEB] hover:underline">Hak Data Pribadi</a> atau hubungi kami di <a href="mailto:privacy@centrova.com" class="text-[#128AEB] hover:underline">privacy@centrova.com</a>. Untuk melindungi keamanan data pribadi, Anda mungkin diminta untuk masuk ke akun Centrova Anda agar identitas dapat diverifikasi. Detail lengkap tentang langkah-langkah keamanan kami tersedia di bagian Pengamanan Data.

                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Dalam situasi tertentu, kami mungkin tidak dapat memenuhi permintaan Anda — misalnya jika Anda meminta penghapusan data yang diwajibkan oleh hukum untuk disimpan sebagai catatan bisnis, atau jika penghapusan data dapat mengganggu proses penyelidikan keamanan dan anti-penipuan yang sedang berlangsung. Permintaan privasi juga dapat ditolak jika membahayakan privasi pihak lain, tidak berdasar atau mengganggu, atau secara teknis sangat sulit dan tidak masuk akal untuk dilakukan. Informasi tentang masa penyimpanan data dapat dilihat di bagian Retensi Data.
                            </p>
                        `
                    },
                    {
                        title: 'Data yang Kami Kumpulkan',
                        content: `
                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Berdasarkan implementasi sistem kami, Centrova mengumpulkan dan mengelola data pribadi berikut ini:
                            </p>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">1. Data Identitas dan Profil</h3>
                                <ul class="list-disc pl-7 text-neutral-900 text-lg">
                                    <li><strong>Identitas Dasar:</strong> Nama lengkap, username, alamat email</li>
                                    <li><strong>Kontak:</strong> Nomor telepon, alamat fisik, kota, kode pos</li>
                                    <li><strong>Profil:</strong> Tanggal lahir (opsional), foto profil, bio</li>
                                    <li><strong>Preferensi:</strong> Pengaturan privasi, preferensi komunikasi, pengaturan notifikasi</li>
                                </ul>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">2. Data Keamanan dan Otentikasi</h3>
                                <ul class="list-disc pl-7 text-neutral-900 text-lg">
                                    <li><strong>Kredensial:</strong> Password ter-hash, tanggal pembaruan password</li>
                                    <li><strong>Aktivitas Login:</strong> Waktu login, alamat IP, informasi perangkat, browser, sistem operasi</li>
                                    <li><strong>Lokasi:</strong> Kota, negara berdasarkan IP (untuk keamanan)</li>
                                    <li><strong>Two-Factor Authentication:</strong> Pengaturan 2FA, recovery codes, trusted devices</li>
                                    <li><strong>Device Fingerprinting:</strong> Identifikasi perangkat tepercaya untuk keamanan</li>
                                </ul>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">3. Data Komunikasi dan Interaksi</h3>
                                <ul class="list-disc pl-7 text-neutral-900 text-lg">
                                    <li><strong>Chat & Customer Service:</strong> Percakapan, pesan, riwayat komunikasi</li>
                                    <li><strong>Preferensi Email:</strong> Notifikasi email, marketing emails, security alerts, staff updates</li>
                                    <li><strong>Session Data:</strong> Data sesi terenkripsi untuk pengalaman yang seamless</li>
                                </ul>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">4. Data Teknis dan Monitoring</h3>
                                <ul class="list-disc pl-7 text-neutral-900 text-lg">
                                    <li><strong>Log Aktivitas:</strong> Jejak audit untuk keamanan dan compliance</li>
                                    <li><strong>Deteksi Ancaman:</strong> Analisis pola untuk mendeteksi aktivitas mencurigakan</li>
                                    <li><strong>Performance Monitoring:</strong> Data penggunaan untuk optimasi layanan</li>
                                </ul>
                            </div>

                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Semua data pribadi Anda dilindungi dengan enkripsi baik saat dikirim maupun disimpan, sehingga tidak dapat diakses oleh pihak yang tidak berwenang. Informasi seperti cookie dan sesi login diamankan dengan metode enkripsi khusus untuk mencegah manipulasi atau pencurian. Kata sandi Anda diproses menggunakan teknik <em>hashing</em>, sehingga tidak pernah disimpan dalam bentuk teks asli (<em>plain text</em>). Dengan langkah-langkah ini, kami menjaga kerahasiaan dan integritas data Anda secara maksimal.
                            </p>
                        `
                    },
                    {
                        title: 'Tujuan dan Dasar Hukum Pemrosesan',
                        content: `
                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Kami memproses data pribadi Anda dengan tujuan yang spesifik dan dasar hukum yang jelas. Data yang Anda berikan kepada kami digunakan untuk menyediakan layanan teknologi yang Anda minta, seperti pengelolaan akun, pemrosesan pesanan layanan pengembangan, dan memberikan dukungan pelanggan melalui sistem chat.
                            </p>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">1. Tujuan Pemrosesan Berdasarkan Implementasi Sistem</h3>
                                <ul class="list-disc pl-7 text-neutral-900 text-lg">
                                    <li><strong>Penyediaan Layanan Teknologi:</strong> Web development, app development, mobile app development, UI/UX design, dan custom solutions</li>
                                    <li><strong>Manajemen Pesanan (ServiceOrder):</strong> Memproses permintaan layanan, mengelola status proyek, dan pelacakan pembayaran</li>
                                    <li><strong>Sistem Berlangganan:</strong> Mengelola paket layanan berlangganan dan perpanjangan otomatis</li>
                                    <li><strong>Customer Service Chat:</strong> Menyediakan dukungan real-time melalui sistem chat terintegrasi</li>
                                    <li><strong>Keamanan & Anti-Penipuan:</strong> Monitoring aktivitas login, deteksi perangkat mencurigakan, dan perlindungan akun</li>
                                    <li><strong>Komunikasi Layanan:</strong> Notifikasi project updates, security alerts, dan komunikasi bisnis penting</li>
                                    <li><strong>Analisis & Optimisasi:</strong> Menganalisis penggunaan platform untuk meningkatkan kualitas layanan</li>
                                    <li><strong>Compliance Legal:</strong> Memenuhi kewajiban hukum bisnis, perpajakan, dan audit keamanan</li>
                                </ul>
                            </div>

                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Setiap pemrosesan data dicatat dalam sistem audit GDPR kami dengan legal basis yang spesifik. Kami menggunakan prinsip data minimization - hanya mengumpulkan data yang diperlukan untuk tujuan tertentu.
                            </p>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">2. Dasar Hukum Pemrosesan (GDPR Article 6)</h3>
                                <ul class="list-disc pl-7 text-neutral-900 text-lg">
                                    <li><strong>Pelaksanaan Kontrak (Article 6.1.b):</strong> Untuk memenuhi layanan pengembangan yang Anda pesan, memproses pembayaran, dan menyelesaikan proyek sesuai agreement</li>
                                    <li><strong>Kepentingan Sah (Article 6.1.f):</strong> Untuk keamanan platform (365 hari retention), pencegahan penipuan, analisis performa, dan peningkatan layanan</li>
                                    <li><strong>Persetujuan (Article 6.1.a):</strong> Untuk marketing emails, newsletter, dan komunikasi promosi (dapat ditarik kapan saja melalui pengaturan akun)</li>
                                    <li><strong>Kewajiban Hukum (Article 6.1.c):</strong> Untuk compliance perpajakan (7 tahun), audit bisnis, dan penyimpanan rekam jejak customer service</li>
                                    <li><strong>Vital Interest (Article 6.1.d):</strong> Untuk investigasi keamanan serius dan melindungi kepentingan vital subjek data</li>
                                </ul>
                            </div>
                        `
                    },
                    {
                        title: 'Retensi Data',
                        content: `
                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Centrova menerapkan kebijakan retensi data yang ketat untuk melindungi privasi Anda. Kami hanya menyimpan data pribadi selama diperlukan untuk tujuan yang telah dijelaskan di bagian Tujuan dan Dasar Hukum Pemrosesan atau selama diwajibkan oleh hukum yang berlaku.
                            </p>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">Periode Retensi Berdasarkan Jenis Data:</h3>
                                <ul class="list-disc pl-7 text-neutral-900 text-lg">
                                    <li><strong>Data Akun:</strong> Selama akun aktif + 2 tahun setelah tidak aktif</li>
                                    <li><strong>Data Transaksi:</strong> 7 tahun (sesuai peraturan akuntansi)</li>
                                    <li><strong>Data Marketing:</strong> Hingga persetujuan ditarik</li>
                                    <li><strong>Data Log Teknis:</strong> Maksimal 12 bulan</li>
                                    <li><strong>Data Layanan Pelanggan:</strong> 3 tahun setelah kasus terakhir</li>
                                </ul>
                            </div>

                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Setelah periode retensi berakhir, semua data akan dihapus secara aman menggunakan metode penghapusan yang tidak dapat dipulihkan. Sistem kami juga dilengkapi dengan proses otomatis untuk membersihkan data yang telah kedaluwarsa.
                            </p>

                            <p class="text-neutral-900 text-base mt-4 italic">
                                *Data akan dihapus secara aman setelah periode retensi berakhir, kecuali diwajibkan oleh hukum.
                            </p>
                        `
                    },
                    {
                        title: 'Pihak Ketiga dan Transfer Data',
                        content: `
                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Berdasarkan implementasi sistem Centrova, kami bekerja sama dengan penyedia layanan tepercaya yang membantu kami mengoperasikan platform teknologi. Semua berbagi data dilakukan untuk mendukung tujuan yang telah dijelaskan di bagian <a href="#" onclick="document.querySelector('[x-data]').__x.$data.openSection = 3" class="text-[#128AEB] hover:underline">Tujuan dan Dasar Hukum Pemrosesan</a> dengan langkah-langkah keamanan sebagaimana dijelaskan di bagian <a href="#" onclick="document.querySelector('[x-data]').__x.$data.openSection = 6" class="text-[#128AEB] hover:underline">Pengamanan Data</a>.
                            </p>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">6.1 Penyedia Layanan yang Terimplementasi</h3>
                                <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                    Berdasarkan konfigurasi sistem aktual kami, berikut adalah kategori penyedia layanan yang kami gunakan:
                                </p>
                                <ul class="list-disc pl-7 text-neutral-900 text-lg space-y-2">
                                    <li><strong>Email Service Providers:</strong> Mailgun, Postmark, dan AWS SES untuk pengiriman email notifikasi, security alerts, dan komunikasi sistem</li>
                                    <li><strong>Cloud Infrastructure:</strong> AWS (Amazon Web Services) untuk hosting, storage, dan backup data dengan enkripsi</li>
                                    <li><strong>Security & Monitoring:</strong> Security notification system untuk monitoring aktivitas mencurigakan dan alert keamanan</li>
                                    <li><strong>Session Management:</strong> EncryptCookies middleware untuk enkripsi session data dan cookie security</li>
                                    <li><strong>Authentication Services:</strong> Two-factor authentication providers untuk keamanan tambahan akun</li>
                                </ul>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">6.2 Dasar Hukum Berbagi Data</h3>
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                    <ul class="text-neutral-900 text-lg space-y-2">
                                        <li><strong>Service Order Processing:</strong> Legal basis "Contract" - untuk memproses pesanan layanan pengembangan</li>
                                        <li><strong>Security Monitoring:</strong> Legal basis "Legitimate Interest" - untuk deteksi ancaman dan perlindungan platform</li>
                                        <li><strong>Email Communications:</strong> Legal basis "Contract" untuk service notifications, "Consent" untuk marketing</li>
                                        <li><strong>Data Backup & Recovery:</strong> Legal basis "Contract" - untuk memastikan kelangsungan layanan</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">6.3 Proteksi Transfer Data Internasional</h3>
                                <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                    Untuk penyedia layanan yang berlokasi di luar Indonesia, kami menerapkan safeguards sebagai berikut:
                                </p>
                                <ul class="list-disc pl-7 text-neutral-900 text-lg space-y-2">
                                    <li>Transfer hanya ke negara dengan tingkat perlindungan data yang memadai (Adequacy Decision)</li>
                                    <li>Standard Contractual Clauses (SCCs) untuk semua vendor internasional</li>
                                    <li>AWS Infrastructure dengan sertifikasi SOC, ISO 27001, dan compliance GDPR</li>
                                    <li>Data residency controls untuk memastikan data sensitif tetap dalam jurisdiksi yang aman</li>
                                </ul>
                            </div>

                            <p class="text-neutral-900 text-sm italic bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <strong>Jaminan Kami:</strong> Centrova tidak menjual, menyewakan, atau memperdagangkan data pribadi Anda kepada pihak ketiga untuk tujuan komersial. Semua sharing data dilakukan semata-mata untuk operational necessity dengan perjanjian kerahasiaan yang ketat.
                            </p>
                        `
                    },
                    {
                        title: 'Pengamanan Data',
                        content: `
                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Keamanan data pribadi Anda adalah prioritas utama kami. Berdasarkan implementasi sistem aktual Centrova, kami menerapkan langkah-langkah keamanan teknis dan organisasi yang komprehensif untuk melindungi data dari akses yang tidak sah, kehilangan, atau penyalahgunaan. Sistem keamanan kami terintegrasi dengan proses pemrosesan data yang telah dijelaskan di bagian <a href="#" onclick="document.querySelector('[x-data]').__x.$data.openSection = 3" class="text-[#128AEB] hover:underline">Tujuan dan Dasar Hukum Pemrosesan</a>.
                            </p>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">7.1 Implementasi Keamanan Teknis</h3>
                                <ul class="list-disc pl-7 text-neutral-900 text-lg space-y-2">
                                    <li><strong>Cookie & Session Encryption:</strong> EncryptCookies middleware untuk enkripsi semua cookie dan session data</li>
                                    <li><strong>Password Security:</strong> Bcrypt hashing untuk semua password - tidak pernah disimpan dalam plain text</li>
                                    <li><strong>HTTPS/TLS Encryption:</strong> Semua komunikasi menggunakan TLS untuk melindungi data in-transit</li>
                                    <li><strong>Database Encryption:</strong> Data sensitif dienkripsi at-rest menggunakan standar industri</li>
                                    <li><strong>Security Notification System:</strong> Monitoring real-time untuk aktivitas mencurigakan dan failed login attempts</li>
                                    <li><strong>Device Session Management:</strong> DeviceSessionService untuk tracking dan protection terhadap session hijacking</li>
                                    <li><strong>Two-Factor Authentication:</strong> 2FA dengan recovery codes dan trusted device management</li>
                                </ul>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">7.2 Security Monitoring & Response</h3>
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                    <ul class="text-neutral-900 text-lg space-y-2">
                                        <li><strong>Real-time Threat Detection:</strong> SecurityNotificationService untuk deteksi login dari device baru atau lokasi mencurigakan</li>
                                        <li><strong>Failed Login Protection:</strong> Automatic alerts untuk multiple failed attempts (threshold: 3+ attempts dalam 24 jam)</li>
                                        <li><strong>GDPR Audit Logging:</strong> Comprehensive logging semua aksi yang melibatkan data pribadi dengan legal basis tracking</li>
                                        <li><strong>Session Security:</strong> Force session revocation untuk security purposes dan session summary monitoring</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">7.3 Langkah Organisasi & Compliance</h3>
                                <ul class="list-disc pl-7 text-neutral-900 text-lg space-y-2">
                                    <li>Akses data berdasarkan prinsip "need-to-know" dengan role-based permissions</li>
                                    <li>Data retention policies yang terimplementasi dengan automated cleanup</li>
                                    <li>Regular security patches dan dependency updates</li>
                                    <li>Incident response procedures yang terdokumentasi</li>
                                    <li>Staff training untuk data protection awareness</li>
                                </ul>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">7.4 Backup & Recovery</h3>
                                <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                    Sistem backup kami menggunakan enkripsi dan multiple redundancy untuk memastikan data availability tanpa mengorbankan security. Semua backup dilakukan dengan encryption at-rest dan access controls yang ketat.
                                </p>
                            </div>

                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Meskipun kami menerapkan langkah-langkah keamanan terbaik, tidak ada sistem yang 100% aman. Jika terjadi pelanggaran data, SecurityNotificationService kami akan segera memberitahu Anda dan otoritas yang berwenang sesuai dengan peraturan yang berlaku. Untuk memahami hak-hak Anda terkait keamanan data, silakan lihat bagian <a href="#" onclick="document.querySelector('[x-data]').__x.$data.openSection = 1" class="text-[#128AEB] hover:underline">Hak Privasi Anda</a>.
                            </p>
                        `
                    },
                    {
                        title: 'Cara Mengajukan Permintaan Data',
                        content: `
                            <p class="text-neutral-900 text-lg leading-relaxed mb-4">
                                Untuk menggunakan hak-hak privasi Anda sebagaimana dijelaskan di bagian <a href="#" onclick="document.querySelector('[x-data]').__x.$data.openSection = 1" class="text-[#128AEB] hover:underline">Hak Privasi Anda</a>, atau jika Anda memiliki pertanyaan tentang cara kami menangani data pribadi Anda, silakan hubungi tim kami melalui cara-cara berikut yang telah terimplementasi dalam sistem kami.
                            </p>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">8.1 Portal Online (Recommended)</h3>
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                                    <p class="text-neutral-900 text-lg leading-relaxed mb-3">
                                        <strong>Halaman Hak Data Pribadi:</strong> <a href="{{ route('data-rights.index') }}" class="text-[#128AEB] hover:underline font-semibold">{{ route('data-rights.index') }}</a>
                                    </p>
                                    <p class="text-neutral-900 text-base">
                                        Portal ini memungkinkan Anda untuk langsung mengajukan permintaan GDPR seperti data export, rectification, dan deletion request dengan sistem tracking yang terintegrasi.
                                    </p>
                                </div>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">8.2 Kontak Data Protection Officer</h3>
                                <div class="border border-gray-200 rounded-lg p-6">
                                    <div class="space-y-3 text-neutral-900">
                                        <p><strong>Email Utama:</strong> <a href="mailto:privacy@centrova.com" class="text-[#128AEB] hover:underline">privacy@centrova.com</a></p>
                                        <p><strong>Form Kontak:</strong> <a href="{{ route('legal.privacy.contact') }}" class="text-[#128AEB] hover:underline">{{ route('legal.privacy.contact') }}</a></p>
                                        <p><strong>Alamat Kantor:</strong> [Akan diupdate dengan alamat lengkap]</p>
                                        <p><strong>Telepon:</strong> [Akan diupdate dengan nomor DPO]</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">8.3 Jenis Permintaan yang Dapat Diajukan</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                        <h4 class="font-semibold text-slate-800 mb-2">Data Export (Portability)</h4>
                                        <p class="text-sm text-gray-700">Download semua data pribadi Anda dalam format JSON/ZIP melalui DataRightsController.</p>
                                    </div>
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                        <h4 class="font-semibold text-slate-800 mb-2">Data Rectification</h4>
                                        <p class="text-sm text-gray-700">Mengajukan perbaikan data yang tidak akurat dengan sistem tracking approval.</p>
                                    </div>
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                        <h4 class="font-semibold text-slate-800 mb-2">Account Deletion</h4>
                                        <p class="text-sm text-gray-700">Permintaan penghapusan akun dengan verifikasi password dan approval workflow.</p>
                                    </div>
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                        <h4 class="font-semibold text-slate-800 mb-2">Data Access Request</h4>
                                        <p class="text-sm text-gray-700">Meminta informasi tentang data apa saja yang kami simpan tentang Anda.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-3">8.4 Timeline Pemrosesan</h3>
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                    <ul class="text-neutral-900 space-y-2">
                                        <li><strong>Konfirmasi Penerimaan:</strong> 2 hari kerja (automated system)</li>
                                        <li><strong>Data Export:</strong> Instantly available untuk download</li>
                                        <li><strong>Data Rectification:</strong> 3-5 hari kerja (memerlukan manual review)</li>
                                        <li><strong>Account Deletion:</strong> 30 hari kerja (sesuai GDPR compliance)</li>
                                        <li><strong>Permintaan Mendesak:</strong> 72 jam (jika memungkinkan secara teknis)</li>
                                    </ul>
                                </div>
                            </div>

                            <p class="text-neutral-900 text-sm italic bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <strong>Catatan:</strong> Semua permintaan data akan dilog dalam sistem GDPR audit kami untuk compliance tracking. Anda akan menerima konfirmasi email dan reference number untuk setiap permintaan yang diajukan.
                            </p>
                        `
                    },
                    {
                        title: 'Tanggal Berlaku dan Riwayat Perubahan',
                        content: `
                            <div class="border border-gray-200 rounded-lg p-6">
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold mb-2">Kebijakan Saat Ini</h3>
                                    <p class="text-neutral-900"><strong>Berlaku sejak:</strong> 10 Agustus 2025</p>
                                    <p class="text-neutral-900"><strong>Versi:</strong> 2.0</p>
                                </div>
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold mb-2">Riwayat Perubahan</h3>
                                    <div class="space-y-3">
                                        <div class="border-l-4 border-slate-500 pl-4">
                                            <p class="font-medium">Versi 2.0 - 10 Agustus 2025</p>
                                            <p class="text-sm text-gray-600">
                                                • Pembaruan struktur sesuai standar GDPR<br>
                                                • Penambahan hak subjek data yang lebih detail<br>
                                                • Klarifikasi jaminan tidak memperjualbelikan data<br>
                                                • Perincian langkah keamanan teknis dan organisasi
                                            </p>
                                        </div>
                                        <div class="border-l-4 border-gray-400 pl-4">
                                            <p class="font-medium">Versi 1.0 - [Tanggal versi sebelumnya]</p>
                                            <p class="text-sm text-gray-600">• Kebijakan privasi versi awal</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 border border-gray-200 rounded p-4">
                                    <h4 class="font-semibold text-slate-800 mb-2">Pemberitahuan Perubahan</h4>
                                    <p class="text-gray-700 text-sm">
                                        Kami akan memberitahukan setiap perubahan material pada kebijakan ini melalui email 
                                        dan notifikasi di platform kami minimal 30 hari sebelum perubahan berlaku.
                                    </p>
                                </div>
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
