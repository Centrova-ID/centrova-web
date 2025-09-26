/**
 * Process Section Component
 * Handles the development process steps display
 * @author Centrova Development Team
 * @version 1.0.0
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('processSection', () => ({
        steps: [
            {
                title: "Konsultasi & Analisis",
                description: "Tahap awal dimana kami memahami kebutuhan bisnis, target audience, dan tujuan website Anda secara mendalam.",
                duration: "1-2 Hari",
                details: [
                    "Diskusi kebutuhan dan ekspektasi",
                    "Analisis kompetitor dan market research",
                    "Pembuatan proposal dan timeline",
                    "Kesepakatan scope project"
                ],
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>'
            },
            {
                title: "Design & Wireframe",
                description: "Pembuatan konsep visual dan user experience design yang sesuai dengan brand identity dan kebutuhan fungsional.",
                duration: "3-5 Hari",
                details: [
                    "Penelitian UX/UI best practices",
                    "Pembuatan wireframe dan mockup",
                    "Desain visual interface",
                    "Review dan revisi design"
                ],
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17v4a2 2 0 002 2h4M13 13h4a2 2 0 012 2v4a2 2 0 01-2 2h-4m-6-4a2 2 0 01-2-2V9a2 2 0 012-2h2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>'
            },
            {
                title: "Development & Coding",
                description: "Implementasi design menjadi website fungsional dengan teknologi modern dan coding standards terbaik.",
                duration: "5-10 Hari",
                details: [
                    "Frontend development (HTML, CSS, JS)",
                    "Backend development dan database",
                    "Integration dengan third-party services",
                    "Responsive design implementation"
                ],
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>'
            },
            {
                title: "Testing & Quality Assurance",
                description: "Pengujian menyeluruh untuk memastikan website berfungsi optimal di berbagai device dan browser.",
                duration: "2-3 Hari",
                details: [
                    "Cross-browser compatibility testing",
                    "Mobile responsiveness testing",
                    "Performance dan loading speed test",
                    "Security dan vulnerability check"
                ],
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>'
            },
            {
                title: "Launch & Deployment",
                description: "Proses go-live website dengan setup hosting, domain, SSL, dan monitoring untuk memastikan website berjalan stabil.",
                duration: "1-2 Hari",
                details: [
                    "Setup hosting dan domain configuration",
                    "SSL certificate installation",
                    "Website deployment dan go-live",
                    "Training dan handover dokumentasi"
                ],
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>'
            },
            {
                title: "Support & Maintenance",
                description: "Layanan ongoing support, maintenance, dan monitoring untuk memastikan website selalu optimal dan up-to-date.",
                duration: "Berkelanjutan",
                details: [
                    "24/7 monitoring dan uptime check",
                    "Regular backup dan security updates",
                    "Technical support dan bug fixes",
                    "Performance optimization"
                ],
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>'
            }
        ]
    }));
});
