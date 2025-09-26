// E-Commerce Packages Section Component
document.addEventListener('alpine:init', () => {
    Alpine.data('packagesSection', () => ({
        packages: [
            {
                name: 'Toko Online Starter',
                description: 'Perfect untuk UMKM yang baru memulai bisnis online',
                price: 'Rp 2.999.000',
                renewalPrice: 'Rp 999.000/tahun',
                duration: 'Selesai dalam 5-7 hari kerja',
                popular: false,
                features: [
                    'Hingga 50 produk',
                    'Payment gateway dasar',
                    'Manajemen order sederhana',
                    'Template responsive',
                    'SSL Certificate',
                    'Dashboard admin',
                    'Laporan penjualan dasar',
                    'Integrasi WhatsApp',
                    'Support 30 hari'
                ]
            },
            {
                name: 'Toko Online Professional',
                description: 'Untuk bisnis menengah dengan fitur lengkap',
                price: 'Rp 4.049.000',
                renewalPrice: 'Rp 1.349.000/tahun',
                duration: 'Selesai dalam 7-10 hari kerja',
                popular: true,
                features: [
                    'Produk unlimited',
                    'Multi payment gateway',
                    'Sistem inventory lengkap',
                    'Custom design',
                    'SEO optimization',
                    'Analytics dashboard',
                    'Sistem kupon & diskon',
                    'Multi kategori produk',
                    'Integrasi sosial media',
                    'Live chat support',
                    'Training & dokumentasi',
                    'Support 90 hari'
                ]
            },
            {
                name: 'Marketplace Enterprise',
                description: 'Solusi marketplace untuk bisnis besar',
                price: 'Rp 8.999.000',
                renewalPrice: 'Rp 2.999.000/tahun',
                duration: 'Selesai dalam 14-21 hari kerja',
                popular: false,
                features: [
                    'Multi-vendor system',
                    'Advanced analytics',
                    'Custom features',
                    'API integration',
                    'Advanced SEO',
                    'Mobile app support',
                    'Sistem komisi otomatis',
                    'Multi-currency support',
                    'Advanced security',
                    'Priority support 24/7',
                    'Custom training',
                    'Support 1 tahun'
                ]
            }
        ],
        
        selectPackage(packageName) {
            const message = `Halo Centrova, saya tertarik dengan paket ${packageName} untuk website e-commerce. Bisakah kita diskusi lebih lanjut mengenai detail dan proses pembuatannya?`;
            const whatsappUrl = `https://wa.me/6285817909560?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        }
    }));
});
