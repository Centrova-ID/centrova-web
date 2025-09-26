/**
 * Easy Section Component
 * Handles the display of easy process features and simplicity promises
 * @author Centrova Development Team
 * @version 1.0.0
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('easySection', () => ({
        easyFeatures: [
            {
                title: "Konsultasi Mudah",
                description: "Tidak perlu ribet, cukup ceritakan kebutuhan Anda dan kami akan berikan solusi terbaik.",
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>',
                steps: [
                    "WhatsApp atau telpon kami",
                    "Ceritakan kebutuhan website",
                    "Dapatkan rekomendasi tepat"
                ]
            },
            {
                title: "Proses Pembayaran Fleksibel",
                description: "Bayar bertahap sesuai progress, tidak perlu bayar lunas di awal. Aman dan terpercaya.",
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>',
                steps: [
                    "DP 30% untuk memulai",
                    "40% saat desain approve",
                    "30% setelah website selesai"
                ]
            },
            {
                title: "Tidak Perlu Skill Teknis",
                description: "Gaptek? Tidak masalah! Kami akan menghandle semua aspek teknis dan memberikan tutorial lengkap.",
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>',
                steps: [
                    "Kami handle semua teknis",
                    "Training cara pakai website",
                    "Dokumentasi mudah dipahami"
                ]
            },
            {
                title: "Komunikasi Lancar",
                description: "Update progress real-time via WhatsApp. Tanya jawab kapan saja, respon cepat dan ramah.",
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>',
                steps: [
                    "Update progress via WhatsApp",
                    "Tanya jawab real-time",
                    "Tim support ramah & sabar"
                ]
            },
            {
                title: "Revisi Unlimited",
                description: "Tidak puas dengan hasil? Revisi sampai Anda benar-benar puas dengan website yang dibuat.",
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>',
                steps: [
                    "Revisi design berkali-kali",
                    "Penyesuaian fitur sesuai keinginan",
                    "*dalam batas scope yang wajar"
                ]
            },
            {
                title: "Training & Support",
                description: "Setelah website jadi, kami akan training cara menggunakan dan memberikan support jangka panjang.",
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>',
                steps: [
                    "Video tutorial cara pakai",
                    "Training one-on-one",
                    "Support via WhatsApp"
                ]
            }
        ],
        simplicityPromises: [
            {
                title: "Tanpa Ribet Administrasi",
                description: "Proses administrasi simple, tidak perlu dokumen berbelit-belit."
            },
            {
                title: "Bahasa yang Mudah Dipahami",
                description: "Tidak pakai istilah teknis yang membingungkan, semua dijelaskan dengan bahasa sederhana."
            },
            {
                title: "Timeline yang Jelas",
                description: "Kami berikan jadwal yang pasti dan update progress secara berkala."
            },
            {
                title: "One-Stop Solution",
                description: "Dari konsep sampai website live, semua ditangani tim kami. Anda tinggal duduk manis."
            },
            {
                title: "Support Jangka Panjang",
                description: "Setelah website selesai, kami tetap siap membantu untuk maintenance dan update."
            }
        ]
    }));
});
