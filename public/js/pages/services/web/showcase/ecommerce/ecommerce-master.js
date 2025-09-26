// E-Commerce Master JavaScript - Loads all required components
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS (Animate On Scroll) if available
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 700,
            once: true,
            offset: 50
        });
    }
    
    // Initialize any additional e-commerce specific functionality
    initEcommerceFeatures();
});

function initEcommerceFeatures() {
    // Payment method hover effects
    const paymentCards = document.querySelectorAll('.payment-method-card');
    paymentCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px) scale(1.05)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Product management feature cards animation
    const featureCards = document.querySelectorAll('.product-management-feature');
    featureCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });
    
    // Analytics cards pulse animation
    const analyticsCards = document.querySelectorAll('.analytics-card');
    analyticsCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.background = 'rgba(255, 255, 255, 0.2)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.background = 'rgba(255, 255, 255, 0.1)';
        });
    });
    
    // Smooth scroll for internal links
    const internalLinks = document.querySelectorAll('a[href^="#"]');
    internalLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Utility function for WhatsApp integration
function sendWhatsAppMessage(message) {
    const phoneNumber = '6285817909560';
    const encodedMessage = encodeURIComponent(message);
    const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;
    window.open(whatsappUrl, '_blank');
}

// E-commerce specific utilities
const EcommerceUtils = {
    formatPrice: function(price) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(price);
    },
    
    trackEvent: function(eventName, eventData) {
        // Analytics tracking for e-commerce events
        if (typeof gtag !== 'undefined') {
            gtag('event', eventName, eventData);
        }
        console.log('E-commerce Event:', eventName, eventData);
    },
    
    validateEmail: function(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
};

// Export utilities for global use
window.EcommerceUtils = EcommerceUtils;
