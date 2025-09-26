// E-Commerce FAQ Section Component
document.addEventListener('alpine:init', () => {
    Alpine.data('faqSection', () => ({
        openFaq: null,
        
        faqs: [
            {
                question: 'Berapa harga jasa pembuatan website e-commerce toko online?',
                answer: 'Harga jasa pembuatan website e-commerce mulai dari Rp 4.049.000 dengan fitur lengkap, sistem pembayaran, manajemen produk, dan optimasi SEO. Kami juga menyediakan paket starter mulai dari Rp 2.999.000 untuk UMKM.'
            },
            {
                question: 'Berapa lama proses pembuatan website e-commerce?',
                answer: 'Proses pembuatan website e-commerce membutuhkan waktu 7-14 hari kerja tergantung kompleksitas dan jumlah fitur yang dibutuhkan. Paket starter dapat selesai dalam 5-7 hari kerja.'
            },
            {
                question: 'Apakah website e-commerce sudah terintegrasi dengan payment gateway?',
                answer: 'Ya, website e-commerce kami sudah terintegrasi dengan berbagai payment gateway seperti Midtrans, Xendit, dan metode pembayaran lokal lainnya termasuk transfer bank, e-wallet, dan COD.'
            },
            {
                question: 'Apakah ada fitur manajemen stok dan inventori?',
                answer: 'Ya, website e-commerce dilengkapi dengan sistem manajemen stok otomatis, tracking inventori real-time, notifikasi stok menipis, dan laporan stok lengkap untuk membantu Anda mengelola bisnis.'
            },
            {
                question: 'Apakah bisa menambahkan fitur marketplace seperti multi-vendor?',
                answer: 'Ya, kami menyediakan paket Marketplace Enterprise dengan sistem multi-vendor, komisi otomatis, dashboard terpisah untuk setiap penjual, dan fitur manajemen vendor yang lengkap.'
            },
            {
                question: 'Apakah website e-commerce sudah mobile-friendly dan responsive?',
                answer: 'Ya, semua website e-commerce yang kami buat sudah responsive dan mobile-friendly. Desain akan otomatis menyesuaikan tampilan di smartphone, tablet, dan desktop untuk pengalaman berbelanja yang optimal.'
            },
            {
                question: 'Bagaimana dengan sistem keamanan untuk transaksi online?',
                answer: 'Website e-commerce kami dilengkapi dengan SSL certificate, enkripsi data transaksi, sistem keamanan berlapis, dan mengikuti standar PCI DSS untuk memastikan keamanan data customer dan transaksi.'
            },
            {
                question: 'Apakah ada training untuk mengelola website e-commerce?',
                answer: 'Ya, kami menyediakan training lengkap cara mengelola website e-commerce, menambah produk, memproses order, menggunakan dashboard admin, dan tips optimasi penjualan online.'
            }
        ],
        
        toggleFaq(index) {
            this.openFaq = this.openFaq === index ? null : index;
        }
    }));
});
