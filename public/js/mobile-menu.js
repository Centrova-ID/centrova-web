/**
 * Mobile Menu Component
 * Apple-style mobile navigation with smooth animations
 */

class MobileMenu {
    constructor() {
        this.toggle = document.getElementById('menuToggle');
        this.menu = document.getElementById('mobileMenu');
        this.backdrop = document.getElementById('mobileBackdrop');
        this.links = document.querySelectorAll('.mobile-link');
        this.isOpen = false;
        
        this.init();
    }

    init() {
        if (!this.toggle || !this.menu || !this.backdrop) {
            console.warn('Mobile menu elements not found');
            return;
        }

        this.bindEvents();
    }

    bindEvents() {
        // Toggle menu on hamburger click
        this.toggle.addEventListener('click', (e) => {
            e.preventDefault();
            this.isOpen ? this.closeMenu() : this.openMenu();
        });

        // Close menu when clicking backdrop
        this.backdrop.addEventListener('click', () => this.closeMenu());

        // Close menu when clicking links (except buttons)
        this.links.forEach(link => {
            if (link.tagName.toLowerCase() !== 'button') {
                link.addEventListener('click', () => this.closeMenu());
            }
        });

        // Close menu on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isOpen) {
                this.closeMenu();
            }
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768 && this.isOpen) {
                this.closeMenuInstantly();
            }
        });
    }

    openMenu() {
        this.isOpen = true;
        
        // Add open class to hamburger for animation
        this.toggle.classList.add('open');
        
        // Show backdrop
        this.backdrop.classList.remove('opacity-0', 'pointer-events-none');
        this.backdrop.classList.add('opacity-100');
        
        // Show menu with slide down animation
        this.menu.classList.remove('-translate-y-full', 'opacity-0', 'pointer-events-none');
        this.menu.classList.add('translate-y-0', 'opacity-100');
        
        // Animate links with stagger effect (Apple-style)
        this.links.forEach((link, index) => {
            setTimeout(() => {
                link.classList.remove('opacity-0', 'translate-y-4');
                link.classList.add('opacity-100', 'translate-y-0');
            }, 100 + (index * 50)); // Staggered animation
        });
        
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    closeMenu() {
        this.isOpen = false;
        
        // Remove open class from hamburger
        this.toggle.classList.remove('open');
        
        // Hide links first
        this.links.forEach((link) => {
            link.classList.remove('opacity-100', 'translate-y-0');
            link.classList.add('opacity-0', 'translate-y-4');
        });
        
        // Hide menu and backdrop after a short delay
        setTimeout(() => {
            this.backdrop.classList.remove('opacity-100');
            this.backdrop.classList.add('opacity-0', 'pointer-events-none');
            
            this.menu.classList.remove('translate-y-0', 'opacity-100');
            this.menu.classList.add('-translate-y-full', 'opacity-0', 'pointer-events-none');
        }, 150);
        
        // Restore body scroll
        document.body.style.overflow = '';
    }

    closeMenuInstantly() {
        if (!this.isOpen) return;
        
        this.isOpen = false;
        
        // Remove open class from hamburger
        this.toggle.classList.remove('open');
        
        // Temporarily disable transitions for instant close
        this.backdrop.style.transition = 'none';
        this.menu.style.transition = 'none';
        
        // Reset all links instantly
        this.links.forEach((link) => {
            link.style.transition = 'none';
            link.classList.remove('opacity-100', 'translate-y-0');
            link.classList.add('opacity-0', 'translate-y-4');
        });
        
        // Hide menu and backdrop instantly without delay
        this.backdrop.classList.remove('opacity-100');
        this.backdrop.classList.add('opacity-0', 'pointer-events-none');
        
        this.menu.classList.remove('translate-y-0', 'opacity-100');
        this.menu.classList.add('-translate-y-full', 'opacity-0', 'pointer-events-none');
        
        // Restore body scroll
        document.body.style.overflow = '';
        
        // Re-enable transitions after a brief moment for future animations
        setTimeout(() => {
            this.backdrop.style.transition = '';
            this.menu.style.transition = '';
            this.links.forEach((link) => {
                link.style.transition = '';
            });
        }, 50);
    }

    // Public methods for external control
    open() {
        if (!this.isOpen) {
            this.openMenu();
        }
    }

    close() {
        if (this.isOpen) {
            this.closeMenu();
        }
    }

    toggle() {
        this.isOpen ? this.closeMenu() : this.openMenu();
    }

    getState() {
        return this.isOpen;
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Create global instance
    window.mobileMenu = new MobileMenu();
});

// Export for module usage (if needed)
if (typeof module !== 'undefined' && module.exports) {
    module.exports = MobileMenu;
}
