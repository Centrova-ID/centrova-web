/**
 * Trust Signals Section Component
 * Displays customer success stories and impact metrics
 * @author Centrova Development Team
 * @version 1.0.0
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('trustSignalsSection', () => ({
        stories: [
            {
                title: "Meningkatkan Citra Profesional",
                problem: "Sebuah perusahaan konsultan kesulitan mendapatkan kepercayaan klien korporat karena hanya mengandalkan presentasi dan brosur.",
                result: "Setelah memiliki website company profile yang profesional, mereka berhasil mempercepat proses negosiasi dan meningkatkan respon dari calon partner strategis.",
                impact: "3x",
                metric: "Respon Lebih Cepat"
            },
            {
                title: "Memperkuat Brand Positioning",
                problem: "Perusahaan manufaktur lokal sulit berkompetisi dengan brand internasional karena kurang eksposur digital.",
                result: "Website company profile membantu mereka menampilkan portofolio, sertifikasi, dan keunggulan produk secara komprehensif, meningkatkan competitive advantage.",
                impact: "40%",
                metric: "Inquiry Meningkat"
            },
            {
                title: "Efisiensi Komunikasi Bisnis",
                problem: "Tim sales menghabiskan banyak waktu menjelaskan profil perusahaan berulang-ulang kepada setiap calon klien.",
                result: "Dengan website yang lengkap, calon klien sudah memahami profil perusahaan sebelum meeting, sehingga diskusi langsung fokus ke solusi dan kerjasama.",
                impact: "50%",
                metric: "Waktu Lebih Efisien"
            }
        ]
    }));
});
