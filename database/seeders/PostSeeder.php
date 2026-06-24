<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // Artikel 1: June Pixel Drop
        Post::create([
            'title' => 'June Pixel Drop: Fitur Baru untuk Kreator, Upgrade Gemini, dan Lainnya',
            'slug' => 'june-pixel-drop-fitur-baru-kreator-gemini',
            'excerpt' => 'Google merilis June Pixel Drop dengan berbagai fitur baru yang membuat perangkat Pixel lebih personal dan membantu, termasuk Android 17 dan Wear OS 7.',
            'content' => '
<h2>Screen Reactions: Reaksi Wajah Langsung di Rekaman Layar</h2>
<p>Pernah mencoba merekam video reaksi di ponsel, tetapi frustrasi karena harus menggunakan banyak aplikasi? Dengan Screen Reactions, pengalaman baru khusus Pixel, video selfie kini terintegrasi langsung ke dalam rekaman layar – layaknya layar hijau profesional. Baik Anda membuat video reaksi "one-take" untuk media sosial atau tutorial langkah-demi-langkah, Screen Reactions membuatnya sangat mudah.</p>
<p>Cukup usap layar dua kali ke bawah ke menu Quick Settings, pilih ikon perekaman, lalu aktifkan "Show selfie camera" dan mulai merekam. Anda akan memiliki kendali penuh atas layar secara real-time sementara kamera depan merekam reaksi Anda, dengan kemampuan mengetuk, menyeret, dan mengubah ukuran diri Anda.</p>

<h2>Edit Video dengan Gemini Omni</h2>
<p>Buat dan edit video dengan mudah menggunakan <a href="https://blog.google/innovation-and-ai/models-and-research/gemini-models/gemini-omni/">Gemini Omni</a> di Pixel. Cukup mengobrol dengan Gemini secara alami untuk mewujudkan ide Anda. Gabungkan kombinasi teks, gambar, dan video untuk membuat video berkualitas tinggi. Anda bisa memulai dari awal, me-remix foto dan video dari galeri, atau mencoba template yang sudah tersedia. Anda bahkan bisa membuat avatar AI kustom yang terlihat dan bersuara seperti Anda.</p>

<h2>Buat Soundtrack Kustom dengan Gemini</h2>
<p>Gunakan fitur pembuatan musik dengan Gemini di Pixel untuk menciptakan trek orisinal. Cukup deskripsikan ide atau unggah foto, dan foto tersebut akan diubah menjadi trek audio berkualitas tinggi dengan lirik. Anda dapat menyesuaikannya dengan memberikan perintah mengenai gaya, vokal, dan tempo yang diinginkan. Untuk mulai membuat, buka aplikasi Gemini, ketuk menu tools, dan pilih "Create Music."</p>

<h2>Multitasking dengan Bubbles</h2>
<p>Berpindah bolak-balik antar aplikasi seharusnya tidak memperlambat Anda. Kini Anda bisa mengubah aplikasi apa pun menjadi jendela apung yang ringkas. Cukup tekan lama ikon aplikasi di ponsel Anda untuk mengubahnya menjadi bubble yang melayang di atas aplikasi lain. Di Pixel 10 Pro Fold, bubble akan tertata di bubble bar khusus di bagian bawah layar, memudahkan perpindahan antar aplikasi dengan satu ketukan.</p>

<h2>Fitur Pixel di Lebih Banyak Perangkat</h2>
<p>Voice Translate hadir di Pixel 10a. Dengan teknologi penerjemahan speech-to-speech canggih, Voice Translate bekerja secara real-time selama panggilan telepon untuk menerjemahkan apa yang dikatakan masing-masing penelepon menggunakan suara asli mereka. Voice Translate di Pixel 10a saat ini mendukung terjemahan antara Bahasa Inggris dan Jerman, Spanyol, Prancis, Italia, Portugis, serta Hindi (dalam pratinjau). Plus, Quick Share kini kompatibel dengan AirDrop di Pixel 8a dan 9a.</p>

<h2>Fitur Panggilan di Lebih Banyak Wilayah</h2>
<p>Fitur Take a Message kini diperluas ke lebih banyak pasar dengan kemampuan Custom Greetings. Anda dapat merekam pesan audio khusus untuk penelepon, memberikan pengalaman yang lebih personal saat Anda tidak bisa mengangkat telepon. Manual Call Screen kini tersedia di ponsel Pixel di India – ketika nomor tidak dikenal muncul, cukup ketuk "Screen call" dan Call Assist Google akan dengan sopan meminta penelepon menyebutkan nama dan tujuan panggilan.</p>

<h2>Pemberitahuan Darurat Otomatis untuk Orang Tercinta</h2>
<p>Integrasi Emergency Sharing langsung ke fitur Emergency Detection, termasuk Car Crash Detection, Fall Detection, dan Loss of Pulse Detection. Jika Pixel mendeteksi kecelakaan mobil parah, jatuh keras, atau kehilangan denyut nadi, ponsel akan menghubungi layanan darurat dan secara bersamaan memberitahu kontak darurat pilihan Anda. Anda bisa menyesuaikan siapa yang mendapat notifikasi untuk setiap jenis deteksi.</p>

<h2>Edit Foto dengan Perintah Sederhana di Lebih Banyak Wilayah</h2>
<p>Edit with Ask Photos di Google Photos kini tersedia di ponsel Pixel di Inggris, Jerman, Prancis, Spanyol, dan Italia. Didukung oleh model Gemini, Ask Photos membantu Anda menyentuh foto atau melakukan edit multi-langkah yang kompleks hanya dengan berbicara secara alami dengan Pixel Anda. Cukup katakan "make it better" atau minta beberapa perubahan dalam satu perintah, seperti "remove the reflections and fix the washed out colors."</p>
            ',
            'featured_image' => 'https://storage.googleapis.com/gweb-uniblog-publish-prod/images/June_Pixel_Drop_hero.width-100.format-webp.webp',
            'category' => 'Teknologi',
            'tags' => json_encode(['Pixel', 'Google', 'Gemini', 'Android', 'AI', 'Smartphone']),
            'meta_title' => 'June Pixel Drop: Fitur Baru untuk Kreator, Upgrade Gemini, dan Lainnya',
            'meta_description' => 'Google merilis June Pixel Drop dengan Screen Reactions, Gemini Omni, Bubbles, Voice Translate, dan berbagai fitur baru lainnya untuk perangkat Pixel.',
            'meta_keywords' => 'Pixel Drop, Google Pixel, Gemini, Android 17, Screen Reactions, fitur Pixel terbaru',
            'status' => 'published',
            'published_at' => now(),
            'author_id' => 1,
            'view_count' => 0,
        ]);

        // Artikel 2: Wear OS 7
        Post::create([
            'title' => 'Wear OS 7: Smartwatch yang Selalu Siap Menemani Keseharian Anda',
            'slug' => 'wear-os-7-smartwatch-siap-menemani',
            'excerpt' => 'Wear OS 7 menghadirkan Live Updates, kontrol perangkat terintegrasi, dan Gemini Intelligence untuk pengalaman smartwatch yang lebih personal dan cerdas.',
            'content' => '
<p>Smartwatch Anda kini semakin tak tergantikan. Lebih dari setengah pengguna Wear OS memakai jam tangan mereka tujuh hari seminggu – dan yang paling aktif mengenakannya lebih dari 23 jam setiap hari. Wear OS 7, yang mulai tersedia di perangkat Pixel Watch hari ini, menyediakan platform yang andal untuk penggunaan sehari-hari penuh. Berikut empat hal yang bisa Anda nantikan:</p>

<h2>1. Lacak Info Real-Time dengan Live Updates</h2>
<p>Wear OS 7 menghadirkan Android Live Updates langsung ke pergelangan tangan Anda. Anda bisa melacak event yang sedang berlangsung – skor pertandingan besar, perkiraan kedatangan pesanan makanan, atau progres olahraga – secara real-time. Informasi glanceable ini hadir tepat saat Anda membutuhkannya, memberikan update instan tanpa perlu membuka ponsel.</p>

<h2>2. Kontrol Perangkat Lain dari Pergelangan Tangan</h2>
<p>Wear OS 7 dibangun untuk bekerja lebih baik dengan perangkat terhubung Anda, termasuk earbud atau kacamata pintar yang akan diluncurkan musim gugur ini. Jika Anda mengambil foto dengan kacamata audio, Anda bisa langsung melihat hasil jepretan melalui jam tangan. Wear OS 7 juga memudahkan pengelolaan media di berbagai perangkat – kontrol musik di headphone, speaker rumah, dan lainnya, serta beralih audio dari satu perangkat ke perangkat lain menggunakan media output switcher.</p>

<h2>3. Bantuan Personal dengan Gemini Intelligence</h2>
<p> akhir tahun ini, perangkat Wear OS 7 terpilih akan mendapatkan fitur Gemini Intelligence. Dengan Gemini Intelligence, jam tangan Anda menjadi lebih unik melalui Create My Widget, yang memungkinkan Anda membangun dashboard kustom menggunakan bahasa alami. Dengan multi-step app automation, Gemini menavigasi tugas langsung dari jam tangan, baik itu memesan sepeda untuk kelas spin atau memesan menu favorit dari restoran kesukaan Anda. Desain bahasa Neural Expressive juga hadir di pergelangan tangan, bersama dengan Personal Intelligence yang merujuk aplikasi Google Anda – termasuk Gmail dan Search – serta riwayat chat untuk memberikan saran yang unik dan relevan bagi Anda.</p>

<h2>4. Lakukan Lebih Banyak dalam Sekali Isi Daya</h2>
<p>Berkat optimalisasi daya tingkat sistem yang mendalam, Wear OS 7 memungkinkan Anda menikmati semua fitur baru ini tanpa khawatir kehabisan baterai. Pengguna rata-rata yang meningkatkan dari Wear OS 6 ke Wear OS 7 dapat mengharapkan peningkatan masa pakai baterai hingga 10%.</p>

<p>Rasakan era baru wearable cerdas mulai hari ini, dengan lebih banyak lagi yang akan hadir akhir tahun ini.</p>
            ',
            'featured_image' => 'https://storage.googleapis.com/gweb-uniblog-publish-prod/images/61627.width-800.format-webp.webp',
            'category' => 'Teknologi',
            'tags' => json_encode(['Wear OS', 'Smartwatch', 'Google', 'Gemini', 'Wearable', 'Android']),
            'meta_title' => 'Wear OS 7: Smartwatch yang Selalu Siap Menemani Keseharian Anda',
            'meta_description' => 'Wear OS 7 hadir dengan Live Updates, kontrol perangkat terintegrasi, dan Gemini Intelligence. Nikmati pengalaman smartwatch yang lebih personal dan cerdas.',
            'meta_keywords' => 'Wear OS 7, Google Wear OS, smartwatch, Pixel Watch, Gemini Intelligence, wearable',
            'status' => 'published',
            'published_at' => now(),
            'author_id' => 1,
            'view_count' => 0,
        ]);

        // Artikel 3: Android Parental Controls
        Post::create([
            'title' => 'Kontrol Parental Android yang Diperluas: Dukung Keluarga di Seluruh Dunia',
            'slug' => 'kontrol-parental-android-diperluas-dukung-keluarga',
            'excerpt' => 'Android memperluas fitur Parental Controls ke semua perangkat yang update ke Android 17, plus meningkatkan dana digital wellbeing AS menjadi lebih dari $50 juta.',
            'content' => '
<p>Musim liburan sekolah telah tiba, dan bagi banyak keluarga, ini berarti menemukan keseimbangan antara bersenang-senang di luar dan waktu layar. Untuk membantu orang tua menavigasi lanskap digital selama liburan, Android membagikan pembaruan baru yang dipandu oleh komitmen berkelanjutan untuk memastikan pengalaman yang sesuai dengan usia anak.</p>

<h2>Memperluas Android Parental Controls</h2>
<p>Android Parental Controls kini diperluas ke semua perangkat Android yang melakukan update ke Android 17. Diluncurkan tahun lalu di Pixel, kontrol orang tua ini memudahkan orang tua mengelola waktu layar anak dan menemukan keseimbangan antara bersenang-senang secara online dan offline.</p>
<p>Terletak langsung di dalam Pengaturan Android, fitur ini menyediakan satu tempat yang nyaman untuk kontrol perangkat bawaan dan Google Family Link. Baik anak Anda sedang menjelajahi perangkat mereka atau beristirahat, kontrol pada perangkat ini – dilindungi oleh PIN yang mudah diatur – dapat membantu Anda tetap memegang kendali:</p>
<ul>
<li><strong>Atur batas waktu layar</strong> – Tetapkan jumlah waktu layar yang dapat digunakan anak setiap hari untuk membantu membangun kebiasaan sehat.</li>
<li><strong>Buat jadwal downtime</strong> – Jadwal otomatis untuk mengunci perangkat di malam hari memastikan tidur nyenyak tanpa gangguan.</li>
<li><strong>Filter konten Google Play</strong> – Kelola peringkat konten tertinggi yang boleh diunduh anak Anda.</li>
<li><strong>Kontrol penggunaan aplikasi</strong> – Batasi waktu pada aplikasi tertentu, atau blokir aplikasi sepenuhnya.</li>
</ul>
<p>Android Parental Controls juga menyediakan jalur langsung untuk mengatur Google Family Link di aplikasi Family Link pada ponsel orang tua. Family Link menawarkan kemampuan seperti School Time, persetujuan pembelian aplikasi Google Play, notifikasi lokasi, dan lainnya.</p>

<h2>Dana Digital Wellbeing AS Ditingkatkan menjadi $50 Juta</h2>
<p>Berdasarkan komitmen jangka panjang terhadap kesejahteraan digital, Google meningkatkan dana digital wellbeing AS menjadi lebih dari $50 juta untuk mendukung generasi anak-anak dan remaja yang lebih sehat dan tangguh. Pendanaan ini akan membantu memperkenalkan intervensi baru yang berfokus pada praktik terbaik untuk interaksi teknologi yang sehat dan dukungan yang memerangi isolasi sosial.</p>
<p>Dengan pembaruan ini, Google terus menunjukkan komitmennya dalam menciptakan pengalaman digital yang aman, sehat, dan sesuai usia bagi semua anggota keluarga.</p>
            ',
            'featured_image' => 'https://storage.googleapis.com/gweb-uniblog-publish-prod/images/Android_Parental_Controls.width-100.format-webp.webp',
            'category' => 'Parenting',
            'tags' => json_encode(['Android', 'Parental Control', 'Family Link', 'Digital Wellbeing', 'Parenting', 'Keamanan']),
            'meta_title' => 'Kontrol Parental Android yang Diperluas: Dukung Keluarga di Seluruh Dunia',
            'meta_description' => 'Android memperluas Parental Controls ke semua perangkat Android 17. Plus, Google tingkatkan dana digital wellbeing AS jadi $50 juta untuk keluarga yang lebih sehat.',
            'meta_keywords' => 'parental control android, family link, kontrol orang tua, digital wellbeing, keamanan anak, android 17',
            'status' => 'published',
            'published_at' => now(),
            'author_id' => 1,
            'view_count' => 0,
        ]);

        // Artikel 4: AI untuk Bencana Alam
        Post::create([
            'title' => 'Menuju Dunia Tanpa Kejutan Bencana Alam: Peran AI dalam Mitigasi Bencana',
            'slug' => 'menuju-dunia-tanpa-kejutan-bencana-alam-peran-ai',
            'excerpt' => 'Google memanfaatkan AI untuk prediksi banjir, kebakaran hutan, gempa bumi, dan cuaca ekstrem – membantu komunitas di seluruh dunia bersiap menghadapi bencana alam.',
            'content' => '
<p>Dunia mengalami peningkatan dramatis dalam cuaca ekstrem dan bencana alam yang menghancurkan komunitas. Selama dekade terakhir, tim Google telah bekerja untuk menyediakan informasi yang membantu kepada masyarakat di saat krisis – sering kali saat mereka paling membutuhkannya. Visi utama kami: tidak ada seorang pun yang dikejutkan oleh bencana alam.</p>

<h2>Kemajuan dalam Peramalan dan Deteksi</h2>
<p>Sepuluh tahun lalu, prediksi banjir yang andal dalam skala besar dianggap sulit dijangkau. Perjalanan multi-tahun Google menuju dampak global dalam peramalan banjir dimulai dengan pilot di wilayah Patna, India pada tahun 2018. Sejak itu, Google terus memajukan riset dan memperluas penerapan:</p>
<ul>
<li><strong>Flood Hub</strong> – Mencakup 2 miliar orang di lebih dari 150 negara. Prediksi banjir sungai tersedia hingga tujuh hari sebelumnya, dan prediksi banjir banding di perkotaan memberikan peringatan hingga 24 jam sebelumnya.</li>
<li><strong>WeatherNext 2</strong> – Model prediksi cuaca paling akurat yang mampu menghasilkan prakiraan per jam untuk seluruh dunia dalam hitungan menit. Selama musim badai 2025, model ini berhasil memprediksi jalur dan intensitas siklon dengan keyakinan tinggi beberapa hari sebelumnya.</li>
<li><strong>FireSat</strong> – Satelit pendeteksi kebakaran yang dikembangkan bersama Earth Fire Alliance dan Muon Space. Satelit protoflight pertama telah ditempatkan di orbit. Konstelasi penuh 50+ satelit dapat mendeteksi kebakaran hutan berukuran 5 x 5 meter di mana pun di bumi, dengan pembaruan setiap 20 menit.</li>
<li><strong>Pemetaan Panas Ekstrem</strong> – AI diterapkan pada citra satelit dan udara untuk memetakan reflektivitas bangunan di lingkungan perkotaan, membantu kota memahami cara mengurangi suhu permukaan menggunakan atap yang lebih sejuk.</li>
</ul>

<h2>Peringatan Real-Time dan Informasi Tepercaya</h2>
<p>Google menyediakan pembaruan respons krisis di Search dan Maps melalui SOS alerts, yang menghimpun informasi relevan dari otoritas dan media tepercaya. Google bermitra dengan penyebar peringatan resmi di lebih dari 90 negara untuk memperkuat peringatan darurat dan peringatan publik.</p>
<p>Informasi krisis Google telah dilihat miliaran kali; tahun lalu saja, Google membantu menghubungkan orang-orang dengan informasi krisis lebih dari 10 juta kali per hari, rata-rata. Contohnya:</p>
<ul>
<li><strong>Peringatan panas ekstrem</strong> – Tersedia di lebih dari 100 negara, lengkap dengan tips keselamatan dari Global Heat Health Information Network.</li>
<li><strong>Sistem Peringatan Gempa Android</strong> – Mendeteksi gempa bumi dan memberi peringatan kepada pengguna Android sebelum guncangan mencapai mereka.</li>
<li><strong>Kualitas udara</strong> – Data udara terkini tersedia di Google Maps di lebih dari 30 negara.</li>
</ul>

<h2>Dukungan Berkelanjutan untuk Misi Global</h2>
<p>Membangun ketahanan global membutuhkan kolaborasi. Google bekerja sama dengan pemerintah, badan PBB, organisasi, ilmuwan, dan petugas tanggap darurat:</p>
<ul>
<li>Di Nigeria dan Bangladesh, GiveDirectly dan International Rescue Committee menggunakan prakiraan banjir Google untuk aksi antisipatif, mendistribusikan bantuan tunai sebelum air naik.</li>
<li>Selama Badai Melissa, Pusat Badai Nasional AS menggunakan model WeatherNext Google yang berhasil memprediksi pendaratan di Jamaika lima hari sebelumnya.</li>
<li>Google.org bermitra dengan organisasi lokal dan mendanai upaya pemulihan bencana di seluruh dunia.</li>
</ul>
<p>Selama dekade terakhir, Google telah membuat kemajuan dalam riset berbasis AI untuk ketahanan iklim, menyediakan informasi yang dapat ditindaklanjuti dan tepat waktu kepada komunitas di seluruh dunia. Dengan memanfaatkan AI dan bekerja sama dengan mitra global, kita akan bergerak menuju dunia di mana tidak ada seorang pun yang dikejutkan oleh bencana alam.</p>
            ',
            'featured_image' => 'https://storage.googleapis.com/gweb-uniblog-publish-prod/images/FloodAlert_hero.width-800.format-webp.webp',
            'category' => 'AI',
            'tags' => json_encode(['AI', 'Bencana Alam', 'Google Research', 'Flood Hub', 'FireSat', 'WeatherNext', 'Climate']),
            'meta_title' => 'Menuju Dunia Tanpa Kejutan Bencana Alam: Peran AI dalam Mitigasi Bencana',
            'meta_description' => 'Google gunakan AI untuk prediksi banjir, kebakaran hutan, gempa bumi, dan cuaca ekstrem. Flood Hub kini mencakup 2 miliar orang di 150+ negara.',
            'meta_keywords' => 'AI bencana alam, prediksi banjir, Google Flood Hub, FireSat, WeatherNext, mitigasi bencana, AI untuk iklim',
            'status' => 'published',
            'published_at' => now(),
            'author_id' => 1,
            'view_count' => 0,
        ]);
    }
}
