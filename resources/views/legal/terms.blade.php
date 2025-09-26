@extends('partials.layouts.legal')

@section('title', 'Ketentuan Layanan')

@section('content')
<section class="relative bg-white py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center border-b border-neutral-300 pb-12">
        <h1 class="text-4xl sm:text-5xl font-bold text-slate-900 mb-6">Ketentuan Layanan Centrova</h1>
        <h2 class="text-xl font-semibold text-slate-900 mb-4">Syarat dan ketentuan penggunaan layanan Centrova</h2>
        <p class="mt-8 text-lg text-neutral-900 max-w-3xl mx-auto">
            Dengan menggunakan layanan Centrova, Anda menyetujui ketentuan layanan ini. Harap baca dengan seksama sebelum menggunakan layanan kami.
        </p>
    </div>

    <div class="max-w-4xl mx-auto mt-12 px-4 sm:px-6 lg:px-8 prose prose-neutral dark:prose-invert text-slate-900">
        
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4">1. Persetujuan Ketentuan</h2>
            <p class="text-neutral-900 text-lg leading-relaxed">
                Dengan mengakses atau menggunakan layanan Centrova, Anda setuju untuk terikat dengan Ketentuan Layanan ini. Jika Anda tidak setuju dengan bagian mana pun dari ketentuan ini, Anda tidak boleh mengakses layanan kami.
            </p>
            <p class="text-neutral-900 text-lg leading-relaxed mt-4">
                Ketentuan ini berlaku untuk semua pengguna layanan, termasuk namun tidak terbatas pada browser, vendor, pelanggan, merchant, dan/atau kontributor konten.
            </p>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4">2. Lisensi Penggunaan</h2>
            
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">2.1 Izin Penggunaan</h3>
                <p class="text-neutral-900 text-lg mb-4">Izin diberikan untuk mengakses materi (informasi atau perangkat lunak) di situs web Centrova untuk penggunaan pribadi, non-komersial, dan sementara saja.</p>
                <ul class="list-disc pl-7 text-neutral-900 text-lg">
                    <li>Menggunakan layanan sesuai dengan ketentuan yang berlaku</li>
                    <li>Mengakses konten untuk keperluan pribadi atau bisnis yang sah</li>
                    <li>Mematuhi semua hukum dan peraturan yang berlaku</li>
                </ul>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">2.2 Pembatasan Penggunaan</h3>
                <p class="text-neutral-900 text-lg mb-4">Lisensi ini akan otomatis berakhir jika Anda melanggar salah satu pembatasan berikut:</p>
                <ul class="list-disc pl-7 text-neutral-900 text-lg">
                    <li>Memodifikasi atau menyalin materi</li>
                    <li>Menggunakan materi untuk tujuan komersial atau tampilan publik</li>
                    <li>Mencoba melakukan reverse engineer perangkat lunak</li>
                    <li>Menghapus hak cipta atau notasi kepemilikan lainnya</li>
                </ul>
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4">3. Tanggung Jawab Pengguna</h2>
            
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">3.1 Informasi Akurat</h3>
                <p class="text-neutral-900 text-lg mb-4">Pengguna bertanggung jawab untuk:</p>
                <ul class="list-disc pl-7 text-neutral-900 text-lg">
                    <li>Memberikan informasi yang akurat dan lengkap</li>
                    <li>Memelihara keamanan akun Anda</li>
                    <li>Mematuhi semua hukum dan peraturan yang berlaku</li>
                    <li>Menggunakan layanan dengan cara yang bertanggung jawab</li>
                </ul>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">3.2 Keamanan Akun</h3>
                <p class="text-neutral-900 text-lg mb-4">Anda bertanggung jawab untuk menjaga kerahasiaan akun dan kata sandi Anda serta untuk membatasi akses ke komputer Anda.</p>
                <p class="text-neutral-900 text-lg">Anda setuju untuk menerima tanggung jawab atas semua aktivitas yang terjadi di bawah akun atau kata sandi Anda.</p>
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4">4. Layanan dan Produk</h2>
            
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">4.1 Ketersediaan Layanan</h3>
                <p class="text-neutral-900 text-lg mb-4">Kami berusaha untuk menyediakan layanan yang dapat diandalkan, namun:</p>
                <ul class="list-disc pl-7 text-neutral-900 text-lg">
                    <li>Layanan dapat mengalami gangguan atau pemeliharaan</li>
                    <li>Beberapa fitur mungkin tidak tersedia di semua wilayah</li>
                    <li>Kami berhak mengubah atau menghentikan layanan dengan pemberitahuan</li>
                </ul>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">4.2 Pembaruan Layanan</h3>
                <p class="text-neutral-900 text-lg">Centrova berhak untuk mengubah atau memperbarui ketentuan layanan ini kapan saja. Perubahan akan diberitahukan melalui situs web atau email.</p>
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4">5. Pembayaran dan Penagihan</h2>
            
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">5.1 Metode Pembayaran</h3>
                <p class="text-neutral-900 text-lg mb-4">Kami menerima berbagai metode pembayaran yang aman:</p>
                <ul class="list-disc pl-7 text-neutral-900 text-lg">
                    <li>Kartu kredit dan debit utama</li>
                    <li>Transfer bank</li>
                    <li>E-wallet dan pembayaran digital</li>
                    <li>Metode pembayaran lokal yang didukung</li>
                </ul>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-3">5.2 Kebijakan Refund</h3>
                <p class="text-neutral-900 text-lg">Kebijakan pengembalian dana berlaku sesuai dengan jenis layanan yang Anda gunakan. Detail lengkap tersedia di halaman kebijakan refund kami.</p>
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4">6. Pembatasan Tanggung Jawab</h2>
            <p class="text-neutral-900 text-lg leading-relaxed">
                Dalam keadaan apa pun Centrova atau pemasoknya tidak bertanggung jawab atas kerusakan apa pun (termasuk, tanpa batasan, kerusakan untuk kehilangan data atau keuntungan, atau karena gangguan bisnis) yang timbul dari penggunaan atau ketidakmampuan untuk menggunakan materi di situs web Centrova.
            </p>
            <p class="text-neutral-900 text-lg leading-relaxed mt-4">
                Beberapa yurisdiksi tidak mengizinkan pembatasan pada garansi tersirat, atau pembatasan tanggung jawab untuk kerusakan konsekuensial atau insidental, sehingga pembatasan ini mungkin tidak berlaku untuk Anda.
            </p>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4">7. Hukum yang Berlaku</h2>
            <p class="text-neutral-900 text-lg leading-relaxed">
                Ketentuan layanan ini dan penggunaan layanan diatur oleh dan ditafsirkan sesuai dengan hukum Republik Indonesia. Setiap sengketa yang timbul akan diselesaikan di pengadilan yang berwenang di Indonesia.
            </p>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4">8. Kontak</h2>
            <p class="text-neutral-900 text-lg leading-relaxed">
                Jika Anda memiliki pertanyaan tentang Ketentuan Layanan ini, silakan hubungi kami di:
            </p>
            <ul class="list-disc pl-7 text-neutral-900 text-lg mt-4">
                <li>Email: legal@centrova.id</li>
                <li>Telepon: (021) 1234 5678</li>
                <li>Alamat: Jl. Teknologi No. 123, Jakarta, Indonesia</li>
            </ul>
        </div>

        <div class="mt-16 p-6 bg-neutral-50 rounded-lg">
            <p class="text-sm text-neutral-600">
                <strong>Terakhir diperbarui:</strong> {{ date('d F Y') }}
            </p>
            <p class="text-sm text-neutral-600 mt-2">
                Ketentuan layanan ini efektif mulai tanggal tersebut di atas dan akan tetap berlaku hingga diubah atau dihentikan oleh Centrova.
            </p>
        </div>

    </div>
</section>
@endsection
