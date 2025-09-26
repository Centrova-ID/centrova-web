/**
 * Quick Links Section Component
 * Displays quick navigation links
 * @author Centrova Development Team
 * @version 1.0.0
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('quickLinksSection', () => ({
        quickLinks: [
            {
                text: "Konsultasi Gratis",
                url: "/support/web/consult",
                target: "_blank"
            },
            {
                text: "Pusat Bantuan",
                url: "/support/services",
                target: "_self"
            },
            {
                text: "Pembatalan Layanan",
                url: "/services/cancellation",
                target: "_self"
            }
        ]
    }));
});
