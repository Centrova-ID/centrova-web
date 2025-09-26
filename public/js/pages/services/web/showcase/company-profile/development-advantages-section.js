/**
 * Development Advantages Section Component
 * Displays development process advantages and construction-themed benefits
 * @author Centrova Development Team
 * @version 1.0.0
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('developmentAdvantagesSection', () => ({
        advantages: [
            {
                title: "Konstruksi Website yang Solid",
                description: "Seperti membangun gedung bertingkat, kami membangun website dengan fondasi yang kuat dan arsitektur yang terstruktur",
                icon: `<svg class="w-full h-full text-current" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 21V3h-4v18h4zM17 7h-2v2h2V7zm0 4h-2v2h2v-2zm0 4h-2v2h2v-2zM3 13h4v8H3v-8zm2 2v4h2v-4H5zm6-12v18h4V3h-4zm2 4h-2v2h2V7zm0 4h-2v2h2v-2zm0 4h-2v2h2v-2z"/>
                      </svg>`,
                features: [
                    "Arsitektur code yang terstruktur",
                    "Database design yang optimal", 
                    "Scalable untuk pertumbuhan bisnis"
                ]
            },
            {
                title: "Keamanan Tingkat Tinggi",
                description: "Perlindungan berlapis seperti helm keselamatan di konstruksi - data dan sistem Anda aman dari ancaman cyber",
                icon: `<svg class="w-full h-full text-current" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1M12,7C13.4,7 14.8,8.6 14.8,10V11.5H16.5V16.5H7.5V11.5H9.2V10C9.2,8.6 10.6,7 12,7M12,8.2C11.2,8.2 10.5,8.7 10.5,10V11.5H13.5V10C13.5,8.7 12.8,8.2 12,8.2Z"/>
                      </svg>`,
                features: [
                    "SSL Certificate dan HTTPS",
                    "Backup otomatis harian",
                    "Firewall dan monitoring 24/7"
                ]
            },
            {
                title: "Pengiriman Tepat Waktu",
                description: "Seperti truk konstruksi yang mengirim material tepat waktu, kami deliver project sesuai deadline yang disepakati",
                icon: `<svg class="w-full h-full text-current" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18,18.5A1.5,1.5 0 0,1 16.5,17A1.5,1.5 0 0,1 18,15.5A1.5,1.5 0 0,1 19.5,17A1.5,1.5 0 0,1 18,18.5M19.5,9.5L21.46,12H17V9.5M6,18.5A1.5,1.5 0 0,1 4.5,17A1.5,1.5 0 0,1 6,15.5A1.5,1.5 0 0,1 7.5,17A1.5,1.5 0 0,1 6,18.5M20,8H17V4H3C1.89,4 1,4.89 1,6V17A1,1 0 0,0 2,18H4A3,3 0 0,0 6,20A3,3 0 0,0 8,18H16A3,3 0 0,0 18,20A3,3 0 0,0 20,18H22A1,1 0 0,0 23,17V12L20,8Z"/>
                      </svg>`,
                features: [
                    "Timeline project yang jelas",
                    "Milestone tracking real-time",
                    "Delivery sesuai jadwal"
                ]
            },
            {
                title: "Tools & Equipment Terdepan",
                description: "Menggunakan tools development terkini seperti equipment konstruksi modern - efisien, cepat, dan hasil berkualitas",
                icon: `<svg class="w-full h-full text-current" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22.7,19L13.6,9.9C14.5,7.6 14,4.9 12.1,3C10.1,1 7.1,0.6 4.7,1.7L9,6L6,9L1.6,4.7C0.4,7.1 0.9,10.1 2.9,12.1C4.8,14 7.5,14.5 9.8,13.6L18.9,22.7C19.3,23.1 19.9,23.1 20.3,22.7L22.6,20.4C23.1,20 23.1,19.3 22.7,19Z"/>
                      </svg>`,
                features: [
                    "Modern development framework",
                    "Automated testing & deployment",
                    "Version control & collaboration tools"
                ]
            }
        ],
        
        processBenefits: [
            {
                title: "Planning & Blueprint",
                description: "Seperti arsitek membuat blueprint, kami merancang wireframe dan user flow yang detail",
                percentage: "100%",
                detail: "Dokumentasi lengkap"
            },
            {
                title: "Quality Control",
                description: "Setiap tahap development melalui quality check seperti inspeksi bangunan",
                percentage: "99%",
                detail: "Bug-free guarantee"
            },
            {
                title: "Material Premium",
                description: "Menggunakan komponen dan library terbaik untuk hasil yang tahan lama",
                percentage: "95%",
                detail: "Performance optimized"
            }
        ]
    }));
});