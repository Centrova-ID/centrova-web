/**
 * Legal Section Component
 * Displays legal policies and transparency information
 * @author Centrova Development Team
 * @version 1.0.0
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('legalSection', () => ({
        policies: [
            {
                title: "Kontrak Resmi",
                description: "Setiap project dilindungi dengan perjanjian yang jelas dan detail untuk melindungi kedua belah pihak",
                features: [
                    "Scope kerja tertulis",
                    "Timeline yang jelas",
                    "Hak dan kewajiban"
                ]
            },
            {
                title: "Kebijakan Pembatalan",
                description: "Proses pembatalan yang transparan dengan pengembalian dana sesuai tahap pengerjaan project",
                features: [
                    "Refund policy jelas",
                    "Proses mudah",
                    "Tanpa penalti berlebihan"
                ]
            },
            {
                title: "Keamanan Data",
                description: "Data dan informasi klien dijamin aman dengan protokol keamanan tingkat enterprise",
                features: [
                    "NDA tersedia",
                    "Backup secure",
                    "Privacy terjamin"
                ]
            }
        ]
    }));
});
