<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Akun Anda - Centrova</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #000;
            margin: 0;
            padding: 20px;
        }
        
        .header {
            text-align: left;
            border-bottom: 1px solid #333;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        
        .header h1 {
            font-size: 18px;
            margin: 0 0 5px 0;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .header h2 {
            font-size: 14px;
            margin: 5px 0 15px 0;
            font-weight: normal;
            color: #666;
        }
        
        .header p {
            margin: 3px 0;
            font-size: 12px;
        }
        
        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        
        .section-title {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 12px;
            padding: 8px 0 5px 0;
            border-bottom: 1px solid #333;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        
        .info-table td {
            padding: 8px 10px;
            border-bottom: 1px solid #ddd;
            vertical-align: top;
        }
        
        .info-table td:first-child {
            font-weight: bold;
            width: 35%;
            color: #000;
            text-align: left;
        }
        
        .info-table td:last-child {
            color: #000;
            text-align: left;
        }
        
        .status-suspended {
            font-weight: bold;
            color: #000;
        }
        
        .formal-box {
            padding: 15px;
            margin: 15px 0;
            background-color: #f9f9f9;
            border-left: 3px solid #333;
        }
        
        .formal-box h3, .formal-box h4 {
            margin: 0 0 10px 0;
            font-size: 12px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .formal-box p {
            margin: 8px 0;
            color: #000;
            text-align: justify;
        }
        
        .formal-box ul {
            margin: 8px 0 8px 20px;
            padding: 0;
        }
        
        .formal-box li {
            margin: 5px 0;
            text-align: justify;
        }
        
        .disclaimer {
            padding: 15px;
            margin-top: 25px;
            font-size: 11px;
            color: #000;
            background-color: #f5f5f5;
            border-left: 3px solid #666;
        }
        
        .disclaimer h3 {
            margin: 0 0 10px 0;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .disclaimer p {
            margin: 8px 0;
            line-height: 1.4;
            text-align: justify;
        }
        
        .footer {
            margin-top: 25px;
            text-align: center;
            font-size: 10px;
            border-top: 1px solid #333;
            padding-top: 15px;
            color: #000;
        }
        
        ul {
            margin: 10px 0 10px 20px;
            padding: 0;
        }
        
        li {
            margin: 5px 0;
        }
        
        p {
            margin: 8px 0;
            text-align: justify;
        }
        
        strong {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Header / Cover Page -->
    <div class="header">
        <h1>Data Akun Anda</h1>
        <h2>Centrova Account</h2>
        <p><strong>{{ $userData['full_name'] }}</strong></p>
        <p>Tanggal Request Download: {{ $downloadDate }}</p>
    </div>

    <!-- Informasi Akun -->
    <div class="section">
        <div class="section-title">INFORMASI AKUN</div>
        <table class="info-table">
            <tr>
                <td>Nama Lengkap</td>
                <td>{{ $userData['full_name'] }}</td>
            </tr>
            <tr>
                <td>Username / ID Akun</td>
                <td>{{ $userData['username'] }}</td>
            </tr>
            <tr>
                <td>Email Terdaftar</td>
                <td>{{ $userData['email'] }}</td>
            </tr>
            <tr>
                <td>Nomor Telepon</td>
                <td>{{ $userData['phone'] }}</td>
            </tr>
            <tr>
                <td>Status Akun</td>
                <td><span class="status-suspended">{{ $userData['status'] }}</span></td>
            </tr>
        </table>
    </div>

    <!-- Aktivitas Akun -->
    <div class="section">
        <div class="section-title">AKTIVITAS AKUN</div>
        <table class="info-table">
            <tr>
                <td>Tanggal Pembuatan Akun</td>
                <td>{{ $userData['created_at'] }}</td>
            </tr>
            <tr>
                <td>Login Terakhir</td>
                <td>{{ $userData['last_login'] }}</td>
            </tr>
            <tr>
                <td>Perangkat Terakhir</td>
                <td>{{ $userData['last_device'] }}</td>
            </tr>
        </table>
    </div>

    <!-- Data Profil -->
    <div class="section">
        <div class="section-title">DATA PROFIL</div>
        <table class="info-table">
            <tr>
                <td>Alamat</td>
                <td>{{ $userData['address'] }}</td>
            </tr>
            <tr>
                <td>Kontak Darurat</td>
                <td>{{ $userData['emergency_contact'] }}</td>
            </tr>
            <tr>
                <td>Preferensi Bahasa</td>
                <td>{{ $userData['language_preference'] }}</td>
            </tr>
        </table>
    </div>

    <!-- Catatan Penangguhan -->
    <div class="section">
        <div class="section-title">CATATAN PENANGGUHAN</div>
        <table class="info-table">
            <tr>
                <td>Tanggal Ditangguhkan</td>
                <td>{{ $userData['suspended_at'] }}</td>
            </tr>
        </table>
        
        <div class="formal-box">
            <h4>Alasan Penangguhan</h4>
            <p>{{ $userData['suspension_reason'] }}</p>
            <p><strong>Detail:</strong> Akun Anda telah ditinjau oleh sistem keamanan kami dan ditemukan adanya aktivitas yang tidak sesuai dengan ketentuan penggunaan Centrova atau menimbulkan risiko keamanan.</p>
        </div>
    </div>

    <!-- Penjelasan dan Solusi -->
    <div class="section">
        <div class="section-title">PENJELASAN DAN SOLUSI</div>
        
        <div class="formal-box">
            <h3>Mengapa Akun Ditangguhkan</h3>
            <ul>
                <li><strong>Aktivitas Mencurigakan:</strong> Login dari lokasi atau perangkat yang tidak biasa</li>
                <li><strong>Pelanggaran Ketentuan:</strong> Penggunaan layanan yang melanggar syarat dan ketentuan</li>
                <li><strong>Risiko Keamanan:</strong> Terdeteksi aktivitas yang berpotensi membahayakan akun atau sistem</li>
                <li><strong>Verifikasi Identitas:</strong> Diperlukan verifikasi tambahan untuk memastikan keamanan akun</li>
            </ul>
        </div>

        <div class="formal-box">
            <h4>Langkah yang Dapat Dilakukan</h4>
            <ul>
                <li><strong>Hubungi Tim Support:</strong> Kirim email ke support@centrova.com dengan melampirkan dokumen ini</li>
                <li><strong>Verifikasi Identitas:</strong> Siapkan dokumen identitas resmi untuk proses verifikasi</li>
                <li><strong>Tinjau Aktivitas:</strong> Periksa aktivitas terakhir Anda untuk memahami alasan penangguhan</li>
                <li><strong>Baca Ketentuan:</strong> Pastikan Anda memahami syarat dan ketentuan penggunaan layanan</li>
            </ul>
        </div>
    </div>

    <!-- Kesimpulan -->
    <div class="section">
        <div class="section-title">KESIMPULAN</div>
        <p>Akun Anda telah ditangguhkan sementara sebagai tindakan pencegahan untuk melindungi keamanan akun dan sistem. Penangguhan ini bukan merupakan tindakan permanen dan dapat ditinjau ulang dengan mengikuti prosedur yang telah ditetapkan.</p>
        
        <p><strong>Penting untuk diingat:</strong></p>
        <ul>
            <li>Data akun Anda tetap aman dan terlindungi</li>
            <li>Penangguhan dapat dicabut setelah proses verifikasi</li>
            <li>Tim support siap membantu proses pemulihan akun</li>
            <li>Dokumen ini dapat digunakan sebagai referensi saat menghubungi support</li>
        </ul>
    </div>

    <!-- Disclaimer -->
    <div class="disclaimer">
        <h3>DISCLAIMER</h3>
        <p><strong>Data Arsip:</strong> Dokumen ini berisi data arsip akun Anda dan bersifat hanya untuk informasi. Data ini tidak dapat digunakan untuk mengaktifkan kembali akun yang ditangguhkan.</p>
        
        <p><strong>Privasi dan Keamanan:</strong> Dokumen ini berisi informasi pribadi Anda. Harap simpan dengan aman dan jangan bagikan kepada pihak yang tidak berwenang.</p>
        
        <p><strong>Kontak Bantuan:</strong> Untuk pertanyaan lebih lanjut mengenai status akun atau proses pemulihan, silakan hubungi tim support kami di support@centrova.com atau kunjungi halaman bantuan di help.centrova.com</p>
        
        <p><strong>Validitas:</strong> Dokumen ini berlaku sebagai bukti resmi status akun pada tanggal {{ $downloadDate }}.</p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>© {{ date('Y') }} Centrova. Hak Cipta Dilindungi oleh undang-undang.</p>
        <p>Dokumen ini dibuat secara otomatis pada {{ $downloadDate }}</p>
        <p>Untuk bantuan lebih lanjut: support@centrova.com | help.centrova.com</p>
    </div>
</body>
</html>
