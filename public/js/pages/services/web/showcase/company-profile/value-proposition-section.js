/**
 * Value Proposition Section Component
 * Displays company value propositions
 * @author Centrova Development Team
 * @version 1.0.0
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('valuePropositionSection', () => ({
        values: [
            {
                title: "100% Kustomisasi",
                description: "Website dibuat sesuai kebutuhan unik perusahaan Anda, bukan template copy-paste"
            },
            {
                title: "Tanpa Biaya Tersembunyi",
                description: "Harga transparan di depan, tidak ada tambahan biaya mengejutkan di tengah project"
            },
            {
                title: "Garansi Kepuasan",
                description: "Revisi sesuai kesepakatan hingga Anda benar-benar puas dengan hasilnya"
            },
            {
                title: "Dukungan Jangka Panjang",
                description: "Support berkelanjutan setelah website live untuk memastikan performa optimal"
            }
        ]
    }));
});
