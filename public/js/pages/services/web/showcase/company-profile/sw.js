/**
 * Service Worker for Company Profile Page
 * Provides caching strategy for JavaScript components
 * @version 1.0.0
 */

const CACHE_NAME = 'company-profile-js-v1';
const COMPONENT_FILES = [
    '/js/pages/services/web/showcase/company-profile/company-profile-master.js',
    '/js/pages/services/web/showcase/company-profile/showcase-frames.js',
    '/js/pages/services/web/showcase/company-profile/packages-section.js',
    '/js/pages/services/web/showcase/company-profile/process-section.js',
    '/js/pages/services/web/showcase/company-profile/technology-section.js',
    '/js/pages/services/web/showcase/company-profile/easy-section.js',
    '/js/pages/services/web/showcase/company-profile/stats-section.js',
    '/js/pages/services/web/showcase/company-profile/value-proposition-section.js',
    '/js/pages/services/web/showcase/company-profile/trust-signals-section.js',
    '/js/pages/services/web/showcase/company-profile/visual-identity-section.js',
    '/js/pages/services/web/showcase/company-profile/legal-section.js',
    '/js/pages/services/web/showcase/company-profile/faq-section.js',
    '/js/pages/services/web/showcase/company-profile/quick-links-section.js'
];

// Install event
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                return cache.addAll(COMPONENT_FILES);
            })
    );
});

// Fetch event
self.addEventListener('fetch', event => {
    // Only handle requests for our component files
    if (COMPONENT_FILES.some(file => event.request.url.includes(file))) {
        event.respondWith(
            caches.match(event.request)
                .then(response => {
                    // Return cached version or fetch from network
                    return response || fetch(event.request);
                })
        );
    }
});

// Activate event - cleanup old caches
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheName !== CACHE_NAME && cacheName.includes('company-profile-js')) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});
