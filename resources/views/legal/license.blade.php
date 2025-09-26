@extends('partials.layouts.legal')

@section('title', 'Perjanjian Lisensi')

@section('content')
<section class="relative bg-white py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center border-b border-neutral-300 pb-12">
        <h1 class="text-4xl sm:text-5xl font-bold text-slate-900 mb-6">Perjanjian Lisensi Perangkat Lunak</h1>
        <h2 class="text-xl font-semibold text-slate-900 mb-4">Ketentuan penggunaan perangkat lunak dan produk Centrova</h2>
        <p class="mt-8 text-lg text-neutral-900 max-w-3xl mx-auto">
            Perjanjian lisensi ini mengatur penggunaan perangkat lunak, aplikasi, dan produk digital yang disediakan oleh Centrova. Harap baca dengan seksama sebelum menginstal atau menggunakan produk kami.
        </p>
    </div>

    <div class="max-w-4xl mx-auto mt-12 px-4 sm:px-6 lg:px-8 prose prose-neutral dark:prose-invert text-slate-900">
        
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4">1. Pemberian Lisensi</h2>
            <p class="text-neutral-900 text-lg leading-relaxed">
                Dengan tunduk pada syarat dan ketentuan Perjanjian ini, Centrova memberikan Anda lisensi non-eksklusif, tidak dapat dipindahtangankan untuk menggunakan perangkat lunak dan layanan kami.
            </p>
            <p class="text-neutral-900 text-lg leading-relaxed mt-4">
                Lisensi ini berlaku selama masa berlangganan Anda atau sesuai dengan ketentuan yang telah disepakati dalam kontrak pembelian.
            </p>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4">2. Ruang Lingkup Lisensi</h2>
            
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">2.1 Hak yang Diberikan</h3>
                <p class="text-neutral-900 text-lg mb-4">Lisensi ini mencakup:</p>
                <ul class="list-disc pl-7 text-neutral-900 text-lg">
                    <li>Instalasi dan penggunaan perangkat lunak sesuai dokumentasi</li>
                    <li>Akses ke pembaruan dan patch keamanan</li>
                    <li>Dukungan teknis sesuai dengan paket berlangganan Anda</li>
                    <li>Dokumentasi dan sumber daya pendukung</li>
                    <li>Penggunaan API dan integrasi yang disediakan</li>
                </ul>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">2.2 Batas Penggunaan</h3>
                <p class="text-neutral-900 text-lg mb-4">Penggunaan perangkat lunak dibatasi oleh:</p>
                <ul class="list-disc pl-7 text-neutral-900 text-lg">
                    <li>Jumlah pengguna sesuai dengan lisensi yang dibeli</li>
                    <li>Lokasi instalasi yang telah ditentukan</li>
                    <li>Kapasitas pemrosesan atau transaksi maksimum</li>
                    <li>Ketentuan geografis jika berlaku</li>
                </ul>
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4">3. Pembatasan Lisensi</h2>
            
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">3.1 Larangan Umum</h3>
                <p class="text-neutral-900 text-lg mb-4">Anda TIDAK diperbolehkan:</p>
                <ul class="list-disc pl-7 text-neutral-900 text-lg">
                    <li>Menyalin, memodifikasi, atau mendistribusikan perangkat lunak</li>
                    <li>Melakukan reverse engineering, decompile, atau disassemble</li>
                    <li>Menyewakan, meminjamkan, atau menjual lisensi kepada pihak ketiga</li>
                    <li>Menggunakan perangkat lunak untuk tujuan ilegal</li>
                    <li>Menghapus atau mengubah pemberitahuan hak cipta</li>
                </ul>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">3.2 Pembatasan Teknis</h3>
                <p class="text-neutral-900 text-lg mb-4">Pembatasan tambahan meliputi:</p>
                <ul class="list-disc pl-7 text-neutral-900 text-lg">
                    <li>Tidak boleh menonaktifkan fitur keamanan atau lisensi</li>
                    <li>Tidak boleh menggunakan perangkat lunak pada sistem yang tidak didukung</li>
                    <li>Tidak boleh mengakses source code yang tidak dipublikasikan</li>
                </ul>
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4">4. Hak Kekayaan Intelektual</h2>
            
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">4.1 Kepemilikan</h3>
                <p class="text-neutral-900 text-lg leading-relaxed">
                    Centrova mempertahankan semua hak, kepemilikan, dan kepentingan dalam dan atas perangkat lunak, termasuk namun tidak terbatas pada semua hak kekayaan intelektual. Tidak ada hak yang diberikan kepada Anda selain yang secara tegas diberikan dalam Perjanjian ini.
                </p>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">4.2 Merek Dagang</h3>
                <p class="text-neutral-900 text-lg leading-relaxed">
                    Nama Centrova dan logo adalah merek dagang dari Centrova. Anda tidak memiliki hak untuk menggunakan merek dagang ini tanpa izin tertulis dari Centrova.
                </p>
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4">5. Dukungan dan Pemeliharaan</h2>
            
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">5.1 Layanan Dukungan</h3>
                <p class="text-neutral-900 text-lg mb-4">Centrova menyediakan:</p>
                <ul class="list-disc pl-7 text-neutral-900 text-lg">
                    <li>Pembaruan keamanan dan bug fixes</li>
                    <li>Dukungan teknis sesuai dengan SLA yang berlaku</li>
                    <li>Dokumentasi dan tutorial penggunaan</li>
                    <li>Forum komunitas dan knowledge base</li>
                </ul>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">5.2 Pembaruan Perangkat Lunak</h3>
                <p class="text-neutral-900 text-lg leading-relaxed">
                    Centrova dapat menyediakan pembaruan, upgrade, atau modifikasi perangkat lunak. Pembaruan dapat bersifat otomatis atau memerlukan tindakan manual dari pengguna.
                </p>
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4">6. Masa Berlaku dan Penghentian</h2>
            
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">6.1 Durasi Lisensi</h3>
                <p class="text-neutral-900 text-lg leading-relaxed">
                    Lisensi ini berlaku mulai dari tanggal instalasi atau aktivasi dan akan berakhir sesuai dengan ketentuan berlangganan atau kontrak yang telah disepakati.
                </p>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">6.2 Penghentian</h3>
                <p class="text-neutral-900 text-lg mb-4">Lisensi dapat dihentikan jika:</p>
                <ul class="list-disc pl-7 text-neutral-900 text-lg">
                    <li>Anda melanggar ketentuan dalam perjanjian ini</li>
                    <li>Masa berlangganan telah berakhir</li>
                    <li>Pembayaran tidak dilakukan sesuai jadwal</li>
                    <li>Permintaan penghentian dari pengguna</li>
                </ul>
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4">7. Jaminan dan Disclaimer</h2>
            <p class="text-neutral-900 text-lg leading-relaxed">
                Perangkat lunak disediakan "SEBAGAIMANA ADANYA" tanpa jaminan apa pun, baik tersurat maupun tersirat. Centrova menolak semua jaminan termasuk, namun tidak terbatas pada, jaminan tersirat tentang dapat diperjualbelikan, kesesuaian untuk tujuan tertentu, dan non-pelanggaran.
            </p>
            <p class="text-neutral-900 text-lg leading-relaxed mt-4">
                Centrova tidak menjamin bahwa perangkat lunak akan memenuhi persyaratan Anda atau bahwa operasinya akan tidak terganggu atau bebas dari kesalahan.
            </p>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4">8. Hukum yang Berlaku</h2>
            <p class="text-neutral-900 text-lg leading-relaxed">
                Perjanjian lisensi ini diatur oleh dan ditafsirkan sesuai dengan hukum Republik Indonesia. Setiap sengketa akan diselesaikan melalui pengadilan yang berwenang di Jakarta, Indonesia.
            </p>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4">9. Kontak dan Dukungan</h2>
            <p class="text-neutral-900 text-lg leading-relaxed">
                Untuk pertanyaan tentang lisensi atau dukungan teknis, hubungi:
            </p>
            <ul class="list-disc pl-7 text-neutral-900 text-lg mt-4">
                <li>Email Support: support@centrova.id</li>
                <li>Email Legal: legal@centrova.id</li>
                <li>Telepon: +62 21 1234 5678</li>
                <li>Portal Dukungan: support.centrova.id</li>
            </ul>
        </div>

        <div class="mt-16 p-6 bg-neutral-50 rounded-lg">
            <p class="text-sm text-neutral-600">
                <strong>Terakhir diperbarui:</strong> {{ date('d F Y') }}
            </p>
            <p class="text-sm text-neutral-600 mt-2">
                Perjanjian lisensi ini efektif mulai tanggal instalasi dan akan tetap berlaku sesuai dengan ketentuan yang telah disepakati.
            </p>
        </div>

    </div>
</section>
@endsection
                <p>You may not:</p>
                <ul class="list-disc pl-6 mb-4">
                    <li>Modify or create derivative works</li>
                    <li>Reverse engineer the software</li>
                    <li>Remove or alter any proprietary notices</li>
                    <li>Transfer the license to any third party</li>
                </ul>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">4. Term and Termination</h2>
                <p>This license remains in effect until terminated. Centrova may terminate your license if you fail to comply with any term of this agreement.</p>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">5. Intellectual Property</h2>
                <p>All rights, title, and interest in and to the software, including all intellectual property rights, remain with Centrova.</p>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">6. Contact Information</h2>
                <p>For licensing inquiries, please contact:</p>
                <p>Email: licensing@centrova.com</p>
                <p>Address: [Your Company Address]</p>
            </section>
        </div>
    </div>
</div>
@endsection