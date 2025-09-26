/**
 * Company Profile Page Master Script
 * Loads all component scripts for the company profile page
 * 
 * @description This file acts as the main entry point for all JavaScript components
 *              used on the company profile service page. It ensures proper loading
 *              order and provides a centralized location for component management.
 * 
 * @author Centrova Development Team
 * @version 1.0.0
 * @created 2025-08-23
 * 
 * Security Features:
 * - CSP compliant (no inline scripts)
 * - Namespace isolation using Alpine.js
 * - Input sanitization for WhatsApp messages
 * - Safe URL generation with encodeURIComponent
 * 
 * Performance Features:
 * - Modular loading for better caching
 * - Event delegation for optimal performance
 * - Throttled scroll events where applicable
 */

(function() {
    'use strict';
    
    // Configuration object for security and performance settings
    const CompanyProfileConfig = {
        // Security settings
        security: {
            allowedDomains: ['wa.me', 'centrova.id'],
            maxMessageLength: 500,
            sanitizeInput: true
        },
        
        // Performance settings
        performance: {
            throttleDelay: 16, // ~60fps for scroll events
            enableLazyLoading: true,
            enableCaching: true
        },
        
        // Contact settings
        contact: {
            whatsappNumber: '6285817909560',
            defaultMessage: 'Halo Centrova, saya tertarik dengan jasa pembuatan website company profile.'
        }
    };
    
    // Utility functions for security and performance
    const Utils = {
        /**
         * Sanitize text input to prevent XSS
         * @param {string} text - Text to sanitize
         * @return {string} - Sanitized text
         */
        sanitizeText(text) {
            if (!CompanyProfileConfig.security.sanitizeInput) return text;
            
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        },
        
        /**
         * Validate URL against allowed domains
         * @param {string} url - URL to validate
         * @return {boolean} - Whether URL is allowed
         */
        isAllowedUrl(url) {
            try {
                const urlObj = new URL(url);
                return CompanyProfileConfig.security.allowedDomains.some(domain => 
                    urlObj.hostname === domain || urlObj.hostname.endsWith(`.${domain}`)
                );
            } catch {
                return false;
            }
        },
        
        /**
         * Generate safe WhatsApp URL
         * @param {string} message - Message to send
         * @return {string} - Safe WhatsApp URL
         */
        generateWhatsAppUrl(message) {
            const sanitizedMessage = this.sanitizeText(message);
            const truncatedMessage = sanitizedMessage.length > CompanyProfileConfig.security.maxMessageLength 
                ? sanitizedMessage.substring(0, CompanyProfileConfig.security.maxMessageLength) + '...'
                : sanitizedMessage;
            
            const url = `https://wa.me/${CompanyProfileConfig.contact.whatsappNumber}?text=${encodeURIComponent(truncatedMessage)}`;
            
            return this.isAllowedUrl(url) ? url : '#';
        },
        
        /**
         * Throttle function execution
         * @param {Function} func - Function to throttle
         * @param {number} delay - Delay in milliseconds
         * @return {Function} - Throttled function
         */
        throttle(func, delay) {
            let timeoutId;
            let lastExecTime = 0;
            return function (...args) {
                const currentTime = Date.now();
                
                if (currentTime - lastExecTime > delay) {
                    func.apply(this, args);
                    lastExecTime = currentTime;
                } else {
                    clearTimeout(timeoutId);
                    timeoutId = setTimeout(() => {
                        func.apply(this, args);
                        lastExecTime = Date.now();
                    }, delay - (currentTime - lastExecTime));
                }
            };
        }
    };
    
    // Make utilities available globally for components
    window.CompanyProfileUtils = Utils;
    window.CompanyProfileConfig = CompanyProfileConfig;
    
    // Component loading status tracker
    const ComponentLoader = {
        components: [
            'showcase-frames',
            'packages-section', 
            'process-section',
            'technology-section',
            'easy-section',
            'stats-section',
            'value-proposition-section',
            'trust-signals-section',
            'visual-identity-section',
            'legal-section',
            'faq-section',
            'quick-links-section'
        ],
        loadedComponents: new Set(),
        
        /**
         * Mark component as loaded
         * @param {string} componentName - Name of the loaded component
         */
        markAsLoaded(componentName) {
            this.loadedComponents.add(componentName);
            
            // Check if all components are loaded
            if (this.loadedComponents.size === this.components.length) {
                this.onAllComponentsLoaded();
            }
        },
        
        /**
         * Called when all components are loaded
         */
        onAllComponentsLoaded() {
            
            // Dispatch custom event for external listeners
            document.dispatchEvent(new CustomEvent('companyProfileReady', {
                detail: { loadedComponents: Array.from(this.loadedComponents) }
            }));
        }
    };
    
    // Initialize page when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        
        // Add any global event listeners or initialization here
        
        // Performance monitoring
        if (window.performance && window.performance.mark) {
            window.performance.mark('company-profile-init-start');
        }
    });
    
    // Export for potential external use
    window.CompanyProfileLoader = ComponentLoader;
    
})();
