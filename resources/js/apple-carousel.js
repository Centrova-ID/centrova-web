// Apple Cards Carousel Component for Alpine.js
function appleCarousel() {
    return {
        modalOpen: false,
        currentCard: null,
        canScrollLeft: false,
        canScrollRight: true,
        
        cards: [
            {
                category: "Design",
                title: "Responsive Design untuk Semua Device",
                image: "https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2426&auto=format&fit=crop",
                content: `
                    <span class="font-bold text-neutral-700">Website yang tampil sempurna di segala perangkat.</span>
                    Kami memastikan website Anda responsive dan user-friendly di desktop, tablet, dan smartphone. 
                    Dengan desain yang adaptif dan modern, pengalaman pengguna akan selalu optimal tanpa mengurangi 
                    fungsionalitas dan estetika visual.
                `
            },
            {
                category: "Performance",
                title: "Loading Cepat & Optimized",
                image: "https://images.unsplash.com/photo-1551650975-87deedd944c3?q=80&w=2426&auto=format&fit=crop",
                content: `
                    <span class="font-bold text-neutral-700">Performa website yang lightning fast.</span>
                    Optimisasi kode, kompresi gambar, dan caching strategy untuk memastikan website loading dalam hitungan detik. 
                    Performa yang baik meningkatkan SEO ranking dan user experience secara signifikan.
                `
            },
            {
                category: "Security",
                title: "Keamanan Enterprise Level",
                image: "https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=2426&auto=format&fit=crop",
                content: `
                    <span class="font-bold text-neutral-700">Perlindungan maksimal untuk data dan sistem.</span>
                    SSL certificate, firewall protection, regular security updates, dan backup otomatis. 
                    Website Anda terlindungi dari serangan cyber dengan standar keamanan enterprise level.
                `
            },
            {
                category: "SEO",
                title: "SEO Friendly & Google Ready",
                image: "https://images.unsplash.com/photo-1551434678-e076c223a692?q=80&w=2426&auto=format&fit=crop",
                content: `
                    <span class="font-bold text-neutral-700">Optimasi untuk mesin pencari terbaik.</span>
                    Meta tags optimization, structured data, sitemap, dan semantic HTML untuk ranking tinggi di Google. 
                    Website Anda akan mudah ditemukan oleh calon customer melalui search engine.
                `
            },
            {
                category: "CMS",
                title: "Content Management System",
                image: "https://images.unsplash.com/photo-1556075798-4825dfaaf498?q=80&w=2426&auto=format&fit=crop",
                content: `
                    <span class="font-bold text-neutral-700">Kelola konten dengan mudah dan intuitif.</span>
                    Dashboard admin yang user-friendly untuk mengelola konten, produk, dan halaman website. 
                    Tidak perlu coding knowledge untuk update konten - semua bisa dilakukan dengan simple drag & drop.
                `
            },
            {
                category: "Support",
                title: "24/7 Technical Support",
                image: "https://images.unsplash.com/photo-1504639725590-34d0984388bd?q=80&w=2426&auto=format&fit=crop",
                content: `
                    <span class="font-bold text-neutral-700">Tim technical support yang siap membantu kapan saja.</span>
                    Support via WhatsApp, email, dan phone call untuk troubleshooting, maintenance, dan konsultasi. 
                    Kami memastikan website Anda selalu running optimal dengan response time yang cepat.
                `
            }
        ],

        init() {
            this.checkScrollability();
            
            // Auto-scroll check on window resize
            window.addEventListener('resize', () => {
                this.checkScrollability();
            });
        },

        checkScrollability() {
            const carousel = this.$refs.carousel;
            if (carousel) {
                const { scrollLeft, scrollWidth, clientWidth } = carousel;
                this.canScrollLeft = scrollLeft > 0;
                this.canScrollRight = scrollLeft < scrollWidth - clientWidth;
            }
        },

        scrollLeft() {
            const carousel = this.$refs.carousel;
            if (carousel) {
                carousel.scrollBy({ left: -300, behavior: 'smooth' });
                setTimeout(() => this.checkScrollability(), 300);
            }
        },

        scrollRight() {
            const carousel = this.$refs.carousel;
            if (carousel) {
                carousel.scrollBy({ left: 300, behavior: 'smooth' });
                setTimeout(() => this.checkScrollability(), 300);
            }
        },

        openModal(index) {
            this.currentCard = this.cards[index];
            this.modalOpen = true;
            document.body.style.overflow = 'hidden';
        },

        closeModal() {
            this.modalOpen = false;
            this.currentCard = null;
            document.body.style.overflow = 'auto';
        }
    }
}

// Make it globally available
window.appleCarousel = appleCarousel;
