<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi - Centrova</title>
    <style>
        /* Ensure dompdf knows the target page size and margins */
        @page {
            size: A4;
            margin: 15mm 12mm;
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            /* slightly larger font-size and more line-height for readability in PDF */
            font-size: 12px;
            line-height: 1.6;
            color: #1a202c;
            margin: 0;
            /* use mm units to match @page margins and avoid rounding issues */
            padding: 10mm;
        }
        
        .container {
            max-width: 100%;
            margin: 0 auto;
        }
        
        h1 {
            color: #1a202c;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
            line-height: 1.3;
        }
        
        .subtitle {
            color: #128AEB;
            font-weight: bold;
        }
        
        h2 {
            color: #1a202c;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
            text-align: center;
        }
        
        h3 {
            color: #1a202c;
            font-size: 14px;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 8px;
        }
        
        h4 {
            color: #374151;
            font-size: 12px;
            font-weight: bold;
            margin-top: 12px;
            margin-bottom: 6px;
        }
        
        p {
            margin-bottom: 10px;
            text-align: justify;
            line-height: 1.4;
        }
        
        .intro-text {
            text-align: center;
            margin-bottom: 25px;
        }
        
        .download-info {
            text-align: center;
            font-size: 10px;
            color: #666;
            margin-bottom: 25px;
            padding: 8px;
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
        }
        
        .section {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        
        .section-title {
            color: #1a202c;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 12px;
            padding-bottom: 4px;
            border-bottom: 2px solid #128AEB;
        }
        
        .section-content {
            margin-left: 8px;
        }
        
        ul {
            margin: 8px 0;
            padding-left: 16px;
        }
        
        li {
            margin-bottom: 4px;
            line-height: 1.3;
        }
        
        strong {
            font-weight: bold;
            color: #1a202c;
        }
        
        .highlight-box {
            background-color: #f0f9ff;
            border: 1px solid #bae6fd;
            padding: 10px;
            margin: 10px 0;
            border-radius: 3px;
            font-size: 10px;
        }
        
        .info-box {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 10px;
            margin: 10px 0;
            border-radius: 3px;
        }
        
        .warning-box {
            background-color: #fffbeb;
            border: 1px solid #fde68a;
            padding: 10px;
            margin: 10px 0;
            border-radius: 3px;
            font-size: 10px;
        }
        
        .contact-box {
            border: 1px solid #d1d5db;
            padding: 10px;
            margin: 10px 0;
            border-radius: 3px;
        }
        
        .grid-item {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 8px;
            margin: 5px 0;
            border-radius: 3px;
        }
        
        .footer-info {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 9px;
            color: #6b7280;
        }
        
        a {
            color: #128AEB;
            text-decoration: none;
        }
        
        .version-info {
            background-color: #f3f4f6;
            border: 1px solid #d1d5db;
            padding: 10px;
            margin: 10px 0;
            border-radius: 3px;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        em {
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <h1>Kebijakan privasi <span class="subtitle">komitmen kami dalam menjaga data anda</span></h1>
        <h2>Diperbarui 27 September 2025</h2>
        <h2>Data Anda bersifat pribadi di kantor, di rumah, dan dalam perjalanan.</h2>
        
        <div class="intro-text">
            <p>Selain Kebijakan Privasi ini, informasi tentang penggunaan data pribadi juga tersedia langsung di produk dan fitur tertentu.</p>
            <p>Anda dapat mempelajari praktik privasi kami, yang dapat diakses melalui judul di bawah, dan hubungi kami jika Anda memiliki pertanyaan.</p>
        </div>

        <div class="download-info">
            <strong>Dokumen PDF ini berisi seluruh Kebijakan Privasi Centrova dengan semua bagian terbuka.</strong><br>
            Diunduh pada: {{ date('d F Y, H:i') }} WIB<br>
            URL Asli: {{ url('/legal/privacy') }}
        </div>

        <!-- Section 1: Data Pribadi Anda di Centrova -->
        <div class="section">
            <div class="section-title">Data Pribadi Anda di Centrova</div>
            <div class="section-content">
                <p>Di Centrova, kami memandang <strong>privasi sebagai hak mendasar setiap pelanggan</strong> yang menggunakan layanan kami. 
                Hak ini berlaku sama untuk semua pelanggan, tanpa memandang lokasi atau jenis layanan yang digunakan.</p>

                <p>Kami menganggap setiap <strong>informasi yang dapat mengidentifikasi atau dihubungkan dengan individu</strong> oleh Centrova sebagai 
                data pribadi. Data pribadi mencakup informasi yang secara langsung mengidentifikasi Anda — seperti 
                nama, alamat, atau nomor kontak — serta informasi yang 
                tidak secara langsung mengidentifikasi, tetapi dapat digunakan untuk mengenali Anda, 
                seperti username unik atau catatan komunikasi chat. 
                Informasi yang telah dianonimkan sehingga tidak lagi dapat dikaitkan dengan individu tertentu akan diperlakukan 
                sebagai informasi nonpribadi.</p>

                <p>Kebijakan ini tidak mencakup bagaimana pihak ketiga tersebut mengelola data pribadi Anda, sehingga kami menyarankan Anda untuk 
                <strong>membaca kebijakan privasi mereka sebelum berbagi informasi</strong>.</p>

                <p>Untuk menggunakan hak-hak privasi Anda, kunjungi halaman Hak Data Pribadi 
                atau hubungi kami di privacy@centrova.com.</p>
            </div>
        </div>

        <!-- Section 2: Hak Privasi Anda -->
        <div class="section">
            <div class="section-title">Hak Privasi Anda Sebagai Subjek Data</div>
            <div class="section-content">
                <p>Di Centrova, kami menghargai hak Anda untuk mengetahui, mengakses, memperbaiki, mentransfer, membatasi pemrosesan, dan menghapus data pribadi Anda. Hak-hak ini kami berikan kepada seluruh pelanggan kami, tanpa memandang lokasi atau jenis layanan yang digunakan. Jika Anda memilih untuk menggunakan hak privasi ini, Anda berhak untuk tidak diperlakukan secara diskriminatif atau menerima tingkat layanan yang lebih rendah dari Centrova.</p>
                
                <p>Apabila Anda diminta untuk menyetujui pemrosesan data pribadi oleh Centrova, Anda berhak untuk menarik persetujuan tersebut kapan saja melalui pengaturan akun Anda atau dengan menghubungi kami.</p>

                <p>Untuk menggunakan hak dan pilihan privasi Anda, termasuk ketika penyedia layanan pihak ketiga bertindak atas nama Centrova, silakan masuk ke akun Anda dan kunjungi halaman Hak Data Pribadi atau hubungi kami di privacy@centrova.com. Untuk melindungi keamanan data pribadi, Anda mungkin diminta untuk masuk ke akun Centrova Anda agar identitas dapat diverifikasi. Detail lengkap tentang langkah-langkah keamanan kami tersedia di bagian Pengamanan Data.</p>

                <p>Dalam situasi tertentu, kami mungkin tidak dapat memenuhi permintaan Anda — misalnya jika Anda meminta penghapusan data yang diwajibkan oleh hukum untuk disimpan sebagai catatan bisnis, atau jika penghapusan data dapat mengganggu proses penyelidikan keamanan dan anti-penipuan yang sedang berlangsung. Permintaan privasi juga dapat ditolak jika membahayakan privasi pihak lain, tidak berdasar atau mengganggu, atau secara teknis sangat sulit dan tidak masuk akal untuk dilakukan. Informasi tentang masa penyimpanan data dapat dilihat di bagian Retensi Data.</p>
            </div>
        </div>

        <!-- Section 3: Data yang Kami Kumpulkan -->
        <div class="section">
            <div class="section-title">Data yang Kami Kumpulkan</div>
            <div class="section-content">
                <p>Berdasarkan implementasi sistem kami, Centrova mengumpulkan dan mengelola data pribadi berikut ini:</p>

                <h3>1. Data Identitas dan Profil</h3>
                <ul>
                    <li><strong>Identitas Dasar:</strong> Nama lengkap, username, alamat email</li>
                    <li><strong>Kontak:</strong> Nomor telepon, alamat fisik, kota, kode pos</li>
                    <li><strong>Profil:</strong> Tanggal lahir (opsional), foto profil, bio</li>
                    <li><strong>Preferensi:</strong> Pengaturan privasi, preferensi komunikasi, pengaturan notifikasi</li>
                </ul>

                <h3>2. Data Keamanan dan Otentikasi</h3>
                <ul>
                    <li><strong>Kredensial:</strong> Password ter-hash, tanggal pembaruan password</li>
                    <li><strong>Aktivitas Login:</strong> Waktu login, alamat IP, informasi perangkat, browser, sistem operasi</li>
                    <li><strong>Lokasi:</strong> Kota, negara berdasarkan IP (untuk keamanan)</li>
                    <li><strong>Two-Factor Authentication:</strong> Pengaturan 2FA, recovery codes, trusted devices</li>
                    <li><strong>Device Fingerprinting:</strong> Identifikasi perangkat tepercaya untuk keamanan</li>
                </ul>

                <h3>3. Data Komunikasi dan Interaksi</h3>
                <ul>
                    <li><strong>Chat & Customer Service:</strong> Percakapan, pesan, riwayat komunikasi</li>
                    <li><strong>Preferensi Email:</strong> Notifikasi email, marketing emails, security alerts, staff updates</li>
                    <li><strong>Session Data:</strong> Data sesi terenkripsi untuk pengalaman yang seamless</li>
                </ul>

                <h3>4. Data Teknis dan Monitoring</h3>
                <ul>
                    <li><strong>Log Aktivitas:</strong> Jejak audit untuk keamanan dan compliance</li>
                    <li><strong>Deteksi Ancaman:</strong> Analisis pola untuk mendeteksi aktivitas mencurigakan</li>
                    <li><strong>Performance Monitoring:</strong> Data penggunaan untuk optimasi layanan</li>
                </ul>

                <p>Semua data pribadi Anda dilindungi dengan enkripsi baik saat dikirim maupun disimpan, sehingga tidak dapat diakses oleh pihak yang tidak berwenang. Informasi seperti cookie dan sesi login diamankan dengan metode enkripsi khusus untuk mencegah manipulasi atau pencurian. Kata sandi Anda diproses menggunakan teknik <em>hashing</em>, sehingga tidak pernah disimpan dalam bentuk teks asli (<em>plain text</em>). Dengan langkah-langkah ini, kami menjaga kerahasiaan dan integritas data Anda secara maksimal.</p>
            </div>
        </div>

        <div class="page-break"></div>

        <!-- Section 4: Tujuan dan Dasar Hukum -->
        <div class="section">
            <div class="section-title">Tujuan dan Dasar Hukum Pemrosesan</div>
            <div class="section-content">
                <p>Kami memproses data pribadi Anda dengan tujuan yang spesifik dan dasar hukum yang jelas. Data yang Anda berikan kepada kami digunakan untuk menyediakan layanan teknologi yang Anda minta, seperti pengelolaan akun, pemrosesan pesanan layanan pengembangan, dan memberikan dukungan pelanggan melalui sistem chat.</p>

                <h3>1. Tujuan Pemrosesan Berdasarkan Implementasi Sistem</h3>
                <ul>
                    <li><strong>Penyediaan Layanan Teknologi:</strong> Web development, app development, mobile app development, UI/UX design, dan custom solutions</li>
                    <li><strong>Manajemen Pesanan (ServiceOrder):</strong> Memproses permintaan layanan, mengelola status proyek, dan pelacakan pembayaran</li>
                    <li><strong>Sistem Berlangganan:</strong> Mengelola paket layanan berlangganan dan perpanjangan otomatis</li>
                    <li><strong>Customer Service Chat:</strong> Menyediakan dukungan real-time melalui sistem chat terintegrasi</li>
                    <li><strong>Keamanan & Anti-Penipuan:</strong> Monitoring aktivitas login, deteksi perangkat mencurigakan, dan perlindungan akun</li>
                    <li><strong>Komunikasi Layanan:</strong> Notifikasi project updates, security alerts, dan komunikasi bisnis penting</li>
                    <li><strong>Analisis & Optimisasi:</strong> Menganalisis penggunaan platform untuk meningkatkan kualitas layanan</li>
                    <li><strong>Compliance Legal:</strong> Memenuhi kewajiban hukum bisnis, perpajakan, dan audit keamanan</li>
                </ul>

                <p>Setiap pemrosesan data dicatat dalam sistem audit GDPR kami dengan legal basis yang spesifik. Kami menggunakan prinsip data minimization - hanya mengumpulkan data yang diperlukan untuk tujuan tertentu.</p>

                <h3>2. Dasar Hukum Pemrosesan (GDPR Article 6)</h3>
                <ul>
                    <li><strong>Pelaksanaan Kontrak (Article 6.1.b):</strong> Untuk memenuhi layanan pengembangan yang Anda pesan, memproses pembayaran, dan menyelesaikan proyek sesuai agreement</li>
                    <li><strong>Kepentingan Sah (Article 6.1.f):</strong> Untuk keamanan platform (365 hari retention), pencegahan penipuan, analisis performa, dan peningkatan layanan</li>
                    <li><strong>Persetujuan (Article 6.1.a):</strong> Untuk marketing emails, newsletter, dan komunikasi promosi (dapat ditarik kapan saja melalui pengaturan akun)</li>
                    <li><strong>Kewajiban Hukum (Article 6.1.c):</strong> Untuk compliance perpajakan (7 tahun), audit bisnis, dan penyimpanan rekam jejak customer service</li>
                    <li><strong>Vital Interest (Article 6.1.d):</strong> Untuk investigasi keamanan serius dan melindungi kepentingan vital subjek data</li>
                </ul>
            </div>
        </div>

        <!-- Section 5: Retensi Data -->
        <div class="section">
            <div class="section-title">Retensi Data</div>
            <div class="section-content">
                <p>Centrova menerapkan kebijakan retensi data yang ketat untuk melindungi privasi Anda. Kami hanya menyimpan data pribadi selama diperlukan untuk tujuan yang telah dijelaskan di bagian Tujuan dan Dasar Hukum Pemrosesan atau selama diwajibkan oleh hukum yang berlaku.</p>

                <h3>Periode Retensi Berdasarkan Jenis Data:</h3>
                <ul>
                    <li><strong>Data Akun:</strong> Selama akun aktif + 2 tahun setelah tidak aktif</li>
                    <li><strong>Data Transaksi:</strong> 7 tahun (sesuai peraturan akuntansi)</li>
                    <li><strong>Data Marketing:</strong> Hingga persetujuan ditarik</li>
                    <li><strong>Data Log Teknis:</strong> Maksimal 12 bulan</li>
                    <li><strong>Data Layanan Pelanggan:</strong> 3 tahun setelah kasus terakhir</li>
                </ul>

                <p>Setelah periode retensi berakhir, semua data akan dihapus secara aman menggunakan metode penghapusan yang tidak dapat dipulihkan. Sistem kami juga dilengkapi dengan proses otomatis untuk membersihkan data yang telah kedaluwarsa.</p>

                <div class="info-box">
                    <em>*Data akan dihapus secara aman setelah periode retensi berakhir, kecuali diwajibkan oleh hukum.</em>
                </div>
            </div>
        </div>

        <!-- Section 6: Pihak Ketiga -->
        <div class="section">
            <div class="section-title">Pihak Ketiga dan Transfer Data</div>
            <div class="section-content">
                <p>Berdasarkan implementasi sistem Centrova, kami bekerja sama dengan penyedia layanan tepercaya yang membantu kami mengoperasikan platform teknologi. Semua berbagi data dilakukan untuk mendukung tujuan yang telah dijelaskan di bagian Tujuan dan Dasar Hukum Pemrosesan dengan langkah-langkah keamanan sebagaimana dijelaskan di bagian Pengamanan Data.</p>

                <h3>6.1 Penyedia Layanan yang Terimplementasi</h3>
                <p>Berdasarkan konfigurasi sistem aktual kami, berikut adalah kategori penyedia layanan yang kami gunakan:</p>
                <ul>
                    <li><strong>Email Service Providers:</strong> Mailgun, Postmark, dan AWS SES untuk pengiriman email notifikasi, security alerts, dan komunikasi sistem</li>
                    <li><strong>Cloud Infrastructure:</strong> AWS (Amazon Web Services) untuk hosting, storage, dan backup data dengan enkripsi</li>
                    <li><strong>Security & Monitoring:</strong> Security notification system untuk monitoring aktivitas mencurigakan dan alert keamanan</li>
                    <li><strong>Session Management:</strong> EncryptCookies middleware untuk enkripsi session data dan cookie security</li>
                    <li><strong>Authentication Services:</strong> Two-factor authentication providers untuk keamanan tambahan akun</li>
                </ul>

                <h3>6.2 Dasar Hukum Berbagi Data</h3>
                <div class="info-box">
                    <ul>
                        <li><strong>Service Order Processing:</strong> Legal basis "Contract" - untuk memproses pesanan layanan pengembangan</li>
                        <li><strong>Security Monitoring:</strong> Legal basis "Legitimate Interest" - untuk deteksi ancaman dan perlindungan platform</li>
                        <li><strong>Email Communications:</strong> Legal basis "Contract" untuk service notifications, "Consent" untuk marketing</li>
                        <li><strong>Data Backup & Recovery:</strong> Legal basis "Contract" - untuk memastikan kelangsungan layanan</li>
                    </ul>
                </div>

                <h3>6.3 Proteksi Transfer Data Internasional</h3>
                <p>Untuk penyedia layanan yang berlokasi di luar Indonesia, kami menerapkan safeguards sebagai berikut:</p>
                <ul>
                    <li>Transfer hanya ke negara dengan tingkat perlindungan data yang memadai (Adequacy Decision)</li>
                    <li>Standard Contractual Clauses (SCCs) untuk semua vendor internasional</li>
                    <li>AWS Infrastructure dengan sertifikasi SOC, ISO 27001, dan compliance GDPR</li>
                    <li>Data residency controls untuk memastikan data sensitif tetap dalam jurisdiksi yang aman</li>
                </ul>

                <div class="highlight-box">
                    <strong>Jaminan Kami:</strong> Centrova tidak menjual, menyewakan, atau memperdagangkan data pribadi Anda kepada pihak ketiga untuk tujuan komersial. Semua sharing data dilakukan semata-mata untuk operational necessity dengan perjanjian kerahasiaan yang ketat.
                </div>
            </div>
        </div>

        <div class="page-break"></div>

        <!-- Section 7: Pengamanan Data -->
        <div class="section">
            <div class="section-title">Pengamanan Data</div>
            <div class="section-content">
                <p>Keamanan data pribadi Anda adalah prioritas utama kami. Berdasarkan implementasi sistem aktual Centrova, kami menerapkan langkah-langkah keamanan teknis dan organisasi yang komprehensif untuk melindungi data dari akses yang tidak sah, kehilangan, atau penyalahgunaan. Sistem keamanan kami terintegrasi dengan proses pemrosesan data yang telah dijelaskan di bagian Tujuan dan Dasar Hukum Pemrosesan.</p>

                <h3>7.1 Implementasi Keamanan Teknis</h3>
                <ul>
                    <li><strong>Cookie & Session Encryption:</strong> EncryptCookies middleware untuk enkripsi semua cookie dan session data</li>
                    <li><strong>Password Security:</strong> Bcrypt hashing untuk semua password - tidak pernah disimpan dalam plain text</li>
                    <li><strong>HTTPS/TLS Encryption:</strong> Semua komunikasi menggunakan TLS untuk melindungi data in-transit</li>
                    <li><strong>Database Encryption:</strong> Data sensitif dienkripsi at-rest menggunakan standar industri</li>
                    <li><strong>Security Notification System:</strong> Monitoring real-time untuk aktivitas mencurigakan dan failed login attempts</li>
                    <li><strong>Device Session Management:</strong> DeviceSessionService untuk tracking dan protection terhadap session hijacking</li>
                    <li><strong>Two-Factor Authentication:</strong> 2FA dengan recovery codes dan trusted device management</li>
                </ul>

                <h3>7.2 Security Monitoring & Response</h3>
                <div class="info-box">
                    <ul>
                        <li><strong>Real-time Threat Detection:</strong> SecurityNotificationService untuk deteksi login dari device baru atau lokasi mencurigakan</li>
                        <li><strong>Failed Login Protection:</strong> Automatic alerts untuk multiple failed attempts (threshold: 3+ attempts dalam 24 jam)</li>
                        <li><strong>GDPR Audit Logging:</strong> Comprehensive logging semua aksi yang melibatkan data pribadi dengan legal basis tracking</li>
                        <li><strong>Session Security:</strong> Force session revocation untuk security purposes dan session summary monitoring</li>
                    </ul>
                </div>

                <h3>7.3 Langkah Organisasi & Compliance</h3>
                <ul>
                    <li>Akses data berdasarkan prinsip "need-to-know" dengan role-based permissions</li>
                    <li>Data retention policies yang terimplementasi dengan automated cleanup</li>
                    <li>Regular security patches dan dependency updates</li>
                    <li>Incident response procedures yang terdokumentasi</li>
                    <li>Staff training untuk data protection awareness</li>
                </ul>

                <h3>7.4 Backup & Recovery</h3>
                <p>Sistem backup kami menggunakan enkripsi dan multiple redundancy untuk memastikan data availability tanpa mengorbankan security. Semua backup dilakukan dengan encryption at-rest dan access controls yang ketat.</p>

                <p>Meskipun kami menerapkan langkah-langkah keamanan terbaik, tidak ada sistem yang 100% aman. Jika terjadi pelanggaran data, SecurityNotificationService kami akan segera memberitahu Anda dan otoritas yang berwenang sesuai dengan peraturan yang berlaku. Untuk memahami hak-hak Anda terkait keamanan data, silakan lihat bagian Hak Privasi Anda.</p>
            </div>
        </div>

        <!-- Section 8: Cara Mengajukan Permintaan -->
        <div class="section">
            <div class="section-title">Cara Mengajukan Permintaan Data</div>
            <div class="section-content">
                <p>Untuk menggunakan hak-hak privasi Anda sebagaimana dijelaskan di bagian Hak Privasi Anda, atau jika Anda memiliki pertanyaan tentang cara kami menangani data pribadi Anda, silakan hubungi tim kami melalui cara-cara berikut yang telah terimplementasi dalam sistem kami.</p>

                <h3>8.1 Portal Online (Recommended)</h3>
                <div class="highlight-box">
                    <p><strong>Halaman Hak Data Pribadi:</strong> centrova.test/data-rights</p>
                    <p>Portal ini memungkinkan Anda untuk langsung mengajukan permintaan GDPR seperti data export, rectification, dan deletion request dengan sistem tracking yang terintegrasi.</p>
                </div>

                <h3>8.2 Kontak Data Protection Officer</h3>
                <div class="contact-box">
                    <p><strong>Email Utama:</strong> privacy@centrova.com</p>
                    <p><strong>Form Kontak:</strong> centrova.test/legal/privacy/contact</p>
                    <p><strong>Alamat Kantor:</strong> [Akan diupdate dengan alamat lengkap]</p>
                    <p><strong>Telepon:</strong> [Akan diupdate dengan nomor DPO]</p>
                </div>

                <h3>8.3 Jenis Permintaan yang Dapat Diajukan</h3>
                <div class="grid-item">
                    <h4>Data Export (Portability)</h4>
                    <p>Download semua data pribadi Anda dalam format JSON/ZIP melalui DataRightsController.</p>
                </div>
                <div class="grid-item">
                    <h4>Data Rectification</h4>
                    <p>Mengajukan perbaikan data yang tidak akurat dengan sistem tracking approval.</p>
                </div>
                <div class="grid-item">
                    <h4>Account Deletion</h4>
                    <p>Permintaan penghapusan akun dengan verifikasi password dan approval workflow.</p>
                </div>
                <div class="grid-item">
                    <h4>Data Access Request</h4>
                    <p>Meminta informasi tentang data apa saja yang kami simpan tentang Anda.</p>
                </div>

                <h3>8.4 Timeline Pemrosesan</h3>
                <div class="info-box">
                    <ul>
                        <li><strong>Konfirmasi Penerimaan:</strong> 2 hari kerja (automated system)</li>
                        <li><strong>Data Export:</strong> Instantly available untuk download</li>
                        <li><strong>Data Rectification:</strong> 3-5 hari kerja (memerlukan manual review)</li>
                        <li><strong>Account Deletion:</strong> 30 hari kerja (sesuai GDPR compliance)</li>
                        <li><strong>Permintaan Mendesak:</strong> 72 jam (jika memungkinkan secara teknis)</li>
                    </ul>
                </div>

                <div class="warning-box">
                    <strong>Catatan:</strong> Semua permintaan data akan dilog dalam sistem GDPR audit kami untuk compliance tracking. Anda akan menerima konfirmasi email dan reference number untuk setiap permintaan yang diajukan.
                </div>
            </div>
        </div>

        <!-- Section 9: Tanggal Berlaku -->
        <div class="section">
            <div class="section-title">Tanggal Berlaku dan Riwayat Perubahan</div>
            <div class="section-content">
                <div class="version-info">
                    <h3>Kebijakan Saat Ini</h3>
                    <p><strong>Berlaku sejak:</strong> 10 Agustus 2025</p>
                    <p><strong>Versi:</strong> 2.0</p>
                    
                    <h3>Riwayat Perubahan</h3>
                    <div style="margin-left: 15px;">
                        <div style="border-left: 3px solid #64748b; padding-left: 10px; margin-bottom: 10px;">
                            <p style="font-weight: bold;">Versi 2.0 - 10 Agustus 2025</p>
                            <p style="font-size: 10px; color: #6b7280;">
                                • Pembaruan struktur sesuai standar GDPR<br>
                                • Penambahan hak subjek data yang lebih detail<br>
                                • Klarifikasi jaminan tidak memperjualbelikan data<br>
                                • Perincian langkah keamanan teknis dan organisasi
                            </p>
                        </div>
                        <div style="border-left: 3px solid #9ca3af; padding-left: 10px;">
                            <p style="font-weight: bold;">Versi 1.0 - [Tanggal versi sebelumnya]</p>
                            <p style="font-size: 10px; color: #6b7280;">• Kebijakan privasi versi awal</p>
                        </div>
                    </div>
                    
                    <div class="info-box">
                        <h4>Pemberitahuan Perubahan</h4>
                        <p>Kami akan memberitahukan setiap perubahan material pada kebijakan ini melalui email 
                        dan notifikasi di platform kami minimal 30 hari sebelum perubahan berlaku.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer-info">
            <p><strong>Centrova - Technology Solutions</strong></p>
            <p>Dokumen ini digenerate otomatis dari: {{ url('/legal/privacy') }}</p>
            <p>Untuk versi terbaru dan interaktif, silakan kunjungi website kami.</p>
            <p>© {{ date('Y') }} Centrova. Hak cipta dilindungi undang-undang.</p>
        </div>
    </div>
</body>
</html>
