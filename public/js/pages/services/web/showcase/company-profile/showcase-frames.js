/**
 * Showcase Frames Component
 * Handles parallax scrolling animations for showcase frames
 * @author Centrova Development Team
 * @version 1.0.0
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('showcaseFrames', () => ({
        scrollOffset: 0,
        frame2Offset: 0, // Mulai dari posisi normal
        frame4Offset: 0, // Mulai dari posisi normal
        isMobile: false,
        
        init() {
            this.checkIsMobile();
            if (!this.isMobile) {
                this.handleScroll();
                window.addEventListener('scroll', () => this.handleScroll());
            }
            window.addEventListener('resize', () => {
                this.checkIsMobile();
            });
        },
        
        checkIsMobile() {
            this.isMobile = window.innerWidth < 1024; // lg breakpoint
        },
        
        handleScroll() {
            // Only run animations on desktop
            if (this.isMobile) return;
            
            const scrollY = window.scrollY;
            const showcaseSection = document.querySelector('section.w-full.bg-white.overflow-x-hidden');
            
            if (showcaseSection) {
                const sectionTop = showcaseSection.offsetTop;
                const windowHeight = window.innerHeight;
                
                // Parallax horizontal movement (seperti Chrome original)
                this.scrollOffset = Math.max(scrollY * -0.25, -300);
                
                // Calculate scroll progress relative to section
                const scrollProgress = (scrollY - sectionTop + windowHeight) / windowHeight;
                
                // Frame 2 & 4 vertical movement (efek mengintip dari bawah seperti Chrome)
                if (scrollProgress < 0.5) {
                    // Frames start from below and gradually move up
                    const moveProgress = Math.max(0, scrollProgress * 2);
                    this.frame2Offset = -1000 * (1 - this.easeOutCubic(moveProgress));
                    this.frame4Offset = -1000 * (1 - this.easeOutCubic(moveProgress));
                } else {
                    // Frames are in normal position
                    this.frame2Offset = 0;
                    this.frame4Offset = 0;
                }
            }
        },
        
        // Easing function for smooth animation
        easeOutCubic(t) {
            return 1 - Math.pow(1 - t, 3);
        }
    }));
});
