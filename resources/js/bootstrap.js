/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Hotwire Turbo Configuration
 * Optimized for instant page transitions
 */
import * as Turbo from '@hotwired/turbo';

// Enable Turbo Drive for full-page acceleration
Turbo.start();

// Configure Turbo for optimal performance
Turbo.setProgressBarDelay(0); // Instant progress bar
Turbo.setFormMode('on'); // Enable form handling

// Turbo event listeners for performance monitoring
document.addEventListener('turbo:load', () => {
    console.log('🚀 Turbo: Page loaded');
    
    // Re-initialize Alpine components if needed
    if (window.Alpine) {
        window.Alpine.initTree(document.body);
    }
});

document.addEventListener('turbo:before-cache', () => {
    // Clean up before caching
    console.log('📦 Turbo: Preparing cache');
});

document.addEventListener('turbo:before-render', (event) => {
    console.log('🎨 Turbo: Before render');
});

document.addEventListener('turbo:render', () => {
    console.log('✨ Turbo: Rendered');
});

// Performance: Track navigation timing
document.addEventListener('turbo:load', () => {
    if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_NAVIGATE) {
        const perfData = window.performance.timing;
        const pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;
        console.log(`⚡ Page load time: ${pageLoadTime}ms`);
    }
});

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
