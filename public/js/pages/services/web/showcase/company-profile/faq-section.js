/**
 * FAQ Section Component
 * Handles FAQ display and toggle functionality
 * @author Centrova Development Team
 * @version 1.0.0
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('faqSection', () => ({
        openFaq: null,
        faqs: [
            {
                question: 'Berapa lama waktu pengerjaan website?',
                answer: 'Waktu pengerjaan disesuaikan dengan kompleksitas project: landing page / website personal sekitar 3 hari hingga 1 minggu, website corporate 1–2 minggu, dan e-commerce atau marketplace 4–8 minggu. Kami berkomitmen untuk menyampaikan timeline secara jelas di awal dan menjaga komunikasi terbuka selama proses berlangsung, agar setiap project selesai tepat waktu dengan kualitas terbaik.'
            },
            {
                question: 'Apakah website yang dibuat mobile-friendly?',
                answer: 'Ya, semua website yang kami buat sudah responsive dan mobile-friendly. Kami memastikan tampilan dan functionality website optimal di semua device, mulai dari smartphone, tablet, hingga desktop.'
            },
            {
                question: 'Apakah termasuk hosting dan domain?',
                answer: 'Paket kami sudah termasuk layanan hosting dengan performa andal untuk mendukung website Anda. Untuk domain, Anda dapat menggunakan domain yang sudah dimiliki atau kami bantu proses pembeliannya melalui registrar terpercaya.'
            },
            {
                question: 'Bagaimana sistem pembayaran?',
                answer: 'Sistem pembayaran dibagi dalam beberapa termin: 30% di awal, 40% saat desain disetujui, dan 30% setelah website selesai. Invoice akan diterbitkan sesuai setiap tahap pembayaran. Kami menerima pembayaran melalui transfer bank, e-wallet, dan metode digital lainnya.'
            },
            {
                question: 'Apakah bisa request revisi?',
                answer: 'Ya, kami memberikan kesempatan revisi sesuai scope project yang disepakati. Biasanya 2-3 kali revisi untuk desain dan 1-2 kali revisi untuk functionality. Revisi di luar scope akan dikenakan biaya tambahan.'
            },
            {
                question: 'Apakah mendapat source code website?',
                answer: 'Ya, setelah project selesai dan pelunasan, Anda akan mendapat seluruh source code website beserta dokumentasinya. Anda memiliki full control atas website yang telah dibuat oleh kami.'
            },
            {
                question: 'Bagaimana dengan maintenance setelah website jadi?',
                answer: 'Kami menyediakan layanan maintenance dengan berbagai paket. Mulai dari basic maintenance (bug fixes, security updates) hingga comprehensive maintenance (feature development, performance optimization, content updates).'
            },
            {
                question: 'Apakah website sudah SEO-ready?',
                answer: 'Ya, semua website yang kami buat sudah dioptimasi untuk SEO dasar, termasuk meta tags, site structure, loading speed, dan mobile optimization. Untuk advanced SEO, tersedia sebagai layanan tambahan.'
            },
            {
                question: 'Kalau saya gaptek, apakah bisa tetap punya website profesional?',
                answer: 'Tentu saja! Kami memahami tidak semua klien memiliki background teknis. Tim kami akan memandu Anda step by step, mulai dari konsultasi kebutuhan hingga training penggunaan website. Kami juga menyediakan dokumentasi lengkap dan video tutorial yang mudah dipahami.'
            },
            {
                question: 'Apakah ada kontrak tertulis?',
                answer: 'Ya, setiap project akan dilindungi dengan kontrak tertulis yang mencakup scope kerja, timeline, harga, dan ketentuan lainnya. Kontrak ini dibuat untuk melindungi kedua belah pihak dan memastikan transparansi penuh dalam kerjasama.'
            },
            {
                question: 'Apakah bisa upgrade dari company profile ke e-commerce di masa depan?',
                answer: 'Absolut! Kami membangun website dengan arsitektur yang scalable, sehingga mudah untuk di-upgrade. Klien yang sudah punya website company profile mendapat diskon khusus untuk upgrade ke e-commerce atau fitur tambahan lainnya.'
            }
        ],
        
        /**
         * Toggle FAQ item open/close
         * @param {number} index - Index of FAQ item to toggle
         */
        toggleFaq(index) {
            this.openFaq = this.openFaq === index ? null : index;
        },
        
        init() {
            // Pastikan tidak ada FAQ yang terbuka saat init
            this.openFaq = null;
        }
    }));
});
