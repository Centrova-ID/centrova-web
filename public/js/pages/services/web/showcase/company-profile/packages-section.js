/**
 * Packages Section Component
 * Handles package selection and WhatsApp integration
 * @author Centrova Development Team
 * @version 1.0.0
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('packagesSection', () => ({
        packages: [
            {
                name: "Landing Page",
                description: "Cocok untuk promosi produk atau jasa",
                price: "Rp 699K",
                period: "per project",
                duration: "Pengerjaan 3-5 hari",
                renewal: "Rp 609K/tahun",
                popular: false,
                features: [
                    "Desain modern & responsive",
                    "1-3 halaman",
                    "Contact form",
                    "Google Maps integration",
                    "SEO basic",
                    "Free hosting 1 tahun",
                    "Free SSL certificate",
                    "2x revisi gratis",
                    "Renewal: hosting + maintenance"
                ]
            },
            {
                name: "Corporate Website",
                description: "Ideal untuk profil perusahaan",
                price: "Rp 2.199K",
                period: "per project",
                duration: "Pengerjaan 1-2 minggu",
                renewal: "Rp 1.914K/tahun",
                popular: true,
                features: [
                    "Desain premium & responsive",
                    "5-8 halaman",
                    "Admin panel sederhana",
                    "Blog system",
                    "Contact form & live chat",
                    "Google Analytics",
                    "SEO optimization",
                    "Free hosting 1 tahun",
                    "Free SSL certificate",
                    "3x revisi gratis",
                    "Source code included",
                    "Renewal: hosting + maintenance + support"
                ]
            },
            {
                name: "E-Commerce",
                description: "Solusi lengkap toko online",
                price: "Rp 4.049K",
                period: "per project",
                duration: "Pengerjaan 3-6 minggu",
                renewal: "Rp 3.441K/tahun",
                popular: false,
                features: [
                    "Desain e-commerce professional",
                    "Admin panel lengkap",
                    "Product management",
                    "Shopping cart & checkout",
                    "Payment gateway integration",
                    "Order management system",
                    "Customer management",
                    "Inventory tracking",
                    "SEO & marketing tools",
                    "Free hosting 1 tahun",
                    "Free SSL certificate",
                    "Unlimited revisi design",
                    "Training & dokumentasi",
                    "Source code included",
                    "Renewal: hosting + maintenance + priority support"
                ]
            }
        ],
        
        /**
         * Handle package selection and redirect to WhatsApp
         * @param {string} packageName - Name of the selected package
         */
        selectPackage(packageName) {
            // Generate WhatsApp message with package info
            const message = `Halo Centrova, saya tertarik dengan paket ${packageName} untuk website company profile. Bisakah kita diskusi lebih detail mengenai paket ini?`;
            const whatsappUrl = `https://wa.me/6285817909560?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        }
    }));
});
