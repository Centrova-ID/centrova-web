{{-- Cookie Consent Banner --}}
<div id="cookie-consent-banner" class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg z-50 transform translate-y-full transition-transform duration-300" style="display: none;">
    <div class="            }
        },

        // Utility method to reset consent (for debugging/testing)
        resetConsent: function() {
            // Remove cookies from current domain
            this.setCookie(this.cookieName, '', -1);
            this.setCookie('centrova_cookie_preferences', '', -1);
            this.setCookie('centrova_cookie_consent_date', '', -1);
            this.setCookie('centrova_cookie_consent_domain', '', -1);
            
            // Also try to remove from main domain if we're on subdomain
            const hostname = window.location.hostname;
            const parts = hostname.split('.');
            if (parts.length > 2) {
                // We're on a subdomain, also clear from main domain
                const mainDomain = '.' + parts.slice(-2).join('.');
                document.cookie = this.cookieName + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=' + mainDomain + ';';
                document.cookie = 'centrova_cookie_preferences=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=' + mainDomain + ';';
                document.cookie = 'centrova_cookie_consent_date=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=' + mainDomain + ';';
                document.cookie = 'centrova_cookie_consent_domain=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=' + mainDomain + ';';
            }
            
            // Remove localStorage items
            localStorage.removeItem('cookie_consent_given');
            localStorage.removeItem('cookie_preferences');
            localStorage.removeItem('cookie_consent_date');
            localStorage.removeItem('cookie_consent_domain');
            
            // Show banner again
            const banner = document.getElementById('cookie-consent-banner');
            if (banner) {
                banner.style.display = 'block';
                banner.classList.remove('translate-y-full');
            }
            
        },

        // Get debug information
        getDebugInfo: function() {
            const hostname = window.location.hostname;
            const cookieConsent = this.getCookie(this.cookieName) === 'true';
            const localStorageConsent = localStorage.getItem('cookie_consent_given') === 'true';
            const preferences = this.getPreferences();
            const allCookies = document.cookie.split(';').map(c => c.trim());
            
            return {
                domain: hostname,
                hasConsent: this.hasConsent(),
                consentSources: {
                    cookie: cookieConsent,
                    localStorage: localStorageConsent
                },
                preferences: preferences,
                allCookies: allCookies.filter(c => c.includes('centrova_cookie')),
                consentDate: this.getCookie('centrova_cookie_consent_date') || localStorage.getItem('cookie_consent_date'),
                consentDomain: this.getCookie('centrova_cookie_consent_domain') || localStorage.getItem('cookie_consent_domain')
            };
        },

        // Initialize
        init: function() {
            // Prevent multiple initializations
            if (window.centrovaCookieConsentInitialized) {
                return;
            }
            window.centrovaCookieConsentInitialized = true;
            
            this.showBanner();
            
            // Load existing preferences if any
            if (this.hasConsent()) {
                const preferences = this.getPreferences();
                this.applyPreferences(preferences);
            }
        }x-4 sm:px-6 lg:px-8 py-4">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex-1">
                <h3 class="text-sm font-semibold text-gray-900 mb-2">Pengaturan Cookie & Privasi</h3>
                <p class="text-sm text-gray-600 leading-relaxed">
                    Kami menggunakan cookie untuk meningkatkan pengalaman Anda, menganalisis penggunaan situs, dan menyediakan konten yang relevan. 
                    Anda dapat mengelola preferensi cookie Anda kapan saja.
                </p>
            </div>
            <div class="flex flex-col sm:flex-row gap-2 min-w-fit">
                <button id="cookie-settings-btn" class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    Pengaturan
                </button>
                <button id="cookie-accept-all" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Terima Semua
                </button>
                <button id="cookie-accept-essential" class="px-4 py-2 text-sm bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                    Hanya Penting
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Cookie Settings Modal --}}
<div id="cookie-settings-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[80vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Pengaturan Cookie</h2>
                    <button id="close-cookie-modal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="space-y-6">
                    {{-- Essential Cookies --}}
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="font-medium text-gray-900">Cookie Penting</h3>
                                <p class="text-sm text-gray-600 mt-1">Cookie yang diperlukan untuk fungsi dasar website</p>
                            </div>
                            <div class="bg-gray-100 px-3 py-1 rounded-full text-xs text-gray-600">Selalu Aktif</div>
                        </div>
                        <p class="text-sm text-gray-700">
                            Cookie ini diperlukan untuk login, keamanan, dan fungsi dasar website. Tidak dapat dinonaktifkan.
                        </p>
                    </div>

                    {{-- Analytics Cookies --}}
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="font-medium text-gray-900">Cookie Analitik</h3>
                                <p class="text-sm text-gray-600 mt-1">Membantu kami memahami penggunaan website</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="analytics-consent" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                        <p class="text-sm text-gray-700">
                            Cookie untuk menganalisis traffic, halaman yang dikunjungi, dan perilaku pengguna secara anonim.
                        </p>
                    </div>

                    {{-- Marketing Cookies --}}
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="font-medium text-gray-900">Cookie Marketing</h3>
                                <p class="text-sm text-gray-600 mt-1">Untuk konten dan iklan yang relevan</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="marketing-consent" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                        <p class="text-sm text-gray-700">
                            Cookie untuk menampilkan iklan yang relevan dan mengukur efektivitas kampanye marketing.
                        </p>
                    </div>

                    {{-- Functional Cookies --}}
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="font-medium text-gray-900">Cookie Fungsional</h3>
                                <p class="text-sm text-gray-600 mt-1">Untuk fitur tambahan dan personalisasi</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="functional-consent" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                        <p class="text-sm text-gray-700">
                            Cookie untuk preferensi bahasa, tema, dan fitur personalisasi lainnya.
                        </p>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                    <button id="save-cookie-preferences" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Simpan Preferensi
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cookieConsentManager = {
        // Cookie name for consent tracking
        cookieName: 'centrova_cookie_consent',
        
        // Set a cookie that works across all subdomains
        setCookie: function(name, value, days) {
            const expires = new Date();
            expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
            
            // Get the main domain (e.g., centrova.test from support.centrova.test)
            const hostname = window.location.hostname;
            let domain = hostname;
            
            // If it's a subdomain, extract the main domain
            const parts = hostname.split('.');
            if (parts.length > 2) {
                // For subdomains like support.centrova.test, use .centrova.test
                domain = '.' + parts.slice(-2).join('.');
            } else if (parts.length === 2) {
                // For main domain like centrova.test, use .centrova.test
                domain = '.' + hostname;
            }
            // For localhost, don't set domain
            if (hostname === 'localhost' || hostname === '127.0.0.1') {
                domain = '';
            }
            
            const domainPart = domain ? `;domain=${domain}` : '';
            document.cookie = name + '=' + value + ';expires=' + expires.toUTCString() + ';path=/' + domainPart + ';SameSite=Lax';
            
        },
        
        // Get a cookie
        getCookie: function(name) {
            const nameEQ = name + "=";
            const ca = document.cookie.split(';');
            for(let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        },

        // Check if consent has been given (using both cookie and localStorage for redundancy)
        hasConsent: function() {
            const cookieConsent = this.getCookie(this.cookieName) === 'true';
            const localStorageConsent = localStorage.getItem('cookie_consent_given') === 'true';
            
            // Check if consent exists in any storage method
            const hasAnyConsent = cookieConsent || localStorageConsent;
            
            
            return hasAnyConsent;
        },

        // Show banner if no consent given
        showBanner: function() {
            const hostname = window.location.hostname;
            const hasConsent = this.hasConsent();
            
            
            if (!hasConsent) {
                const banner = document.getElementById('cookie-consent-banner');
                if (banner) {
                    banner.style.display = 'block';
                    setTimeout(() => {
                        banner.classList.remove('translate-y-full');
                    }, 100);
                } else {
                }
            } else {
                // Log which method provided the consent
                const cookieConsent = this.getCookie(this.cookieName) === 'true';
                const localStorageConsent = localStorage.getItem('cookie_consent_given') === 'true';
            }
        },

        // Hide banner
        hideBanner: function() {
            const banner = document.getElementById('cookie-consent-banner');
            if (banner) {
                banner.classList.add('translate-y-full');
                setTimeout(() => {
                    banner.style.display = 'none';
                }, 300);
            }
        },

        // Save consent preferences (using both cookie and localStorage)
        saveConsent: function(preferences) {
            const consentData = {
                given: true,
                preferences: preferences,
                date: new Date().toISOString(),
                domain: window.location.hostname
            };
            
            // Set cookies for 365 days with proper domain handling
            this.setCookie(this.cookieName, 'true', 365);
            this.setCookie('centrova_cookie_preferences', JSON.stringify(preferences), 365);
            this.setCookie('centrova_cookie_consent_date', consentData.date, 365);
            this.setCookie('centrova_cookie_consent_domain', consentData.domain, 365);
            
            // Also save to localStorage as backup
            localStorage.setItem('cookie_consent_given', 'true');
            localStorage.setItem('cookie_preferences', JSON.stringify(preferences));
            localStorage.setItem('cookie_consent_date', consentData.date);
            localStorage.setItem('cookie_consent_domain', consentData.domain);
            
            
            // Apply preferences
            this.applyPreferences(preferences);
            this.hideBanner();
        },

        // Get current preferences (check both cookie and localStorage)
        getPreferences: function() {
            // Try to get from cookie first
            const cookiePrefs = this.getCookie('centrova_cookie_preferences');
            if (cookiePrefs) {
                try {
                    return JSON.parse(cookiePrefs);
                } catch (e) {
                }
            }
            
            // Fall back to localStorage
            const saved = localStorage.getItem('cookie_preferences');
            return saved ? JSON.parse(saved) : {
                essential: true,
                analytics: false,
                marketing: false,
                functional: false
            };
        },

        // Apply cookie preferences
        applyPreferences: function(preferences) {
            // Essential cookies are always enabled
            
            // Analytics cookies
            if (preferences.analytics) {
                // Enable Google Analytics or other analytics
                this.loadAnalytics();
            }

            // Marketing cookies
            if (preferences.marketing) {
                // Enable marketing pixels, ads, etc.
                this.loadMarketing();
            }

            // Functional cookies
            if (preferences.functional) {
                // Enable functional enhancements
                this.loadFunctional();
            }
        },

        // Load analytics scripts
        loadAnalytics: function() {
            // Only load if not already loaded
            if (!window.gtag) {
                // Example: Load Google Analytics
                // Implementation depends on your analytics provider
            }
        },

        // Load marketing scripts
        loadMarketing: function() {
            // Load marketing pixels, Facebook Pixel, etc.
        },

        // Load functional enhancements
        loadFunctional: function() {
            // Load additional functional features
        },

        // Initialize
        init: function() {
            // Prevent multiple initializations
            if (window.centrovaCookieConsentInitialized) {
                return;
            }
            window.centrovaCookieConsentInitialized = true;
            
            this.showBanner();
            
            // Load existing preferences if any
            if (this.hasConsent()) {
                const preferences = this.getPreferences();
                this.applyPreferences(preferences);
            }
        }
    };

    // Event listeners - with safe checks
    const acceptAllBtn = document.getElementById('cookie-accept-all');
    const acceptEssentialBtn = document.getElementById('cookie-accept-essential');
    const settingsBtn = document.getElementById('cookie-settings-btn');
    const closeModalBtn = document.getElementById('close-cookie-modal');
    const savePrefsBtn = document.getElementById('save-cookie-preferences');
    
    if (acceptAllBtn && !acceptAllBtn.hasAttribute('data-listener-added')) {
        acceptAllBtn.setAttribute('data-listener-added', 'true');
        acceptAllBtn.addEventListener('click', function() {
            cookieConsentManager.saveConsent({
                essential: true,
                analytics: true,
                marketing: true,
                functional: true
            });
        });
    }

    if (acceptEssentialBtn && !acceptEssentialBtn.hasAttribute('data-listener-added')) {
        acceptEssentialBtn.setAttribute('data-listener-added', 'true');
        acceptEssentialBtn.addEventListener('click', function() {
            cookieConsentManager.saveConsent({
                essential: true,
                analytics: false,
                marketing: false,
                functional: false
            });
        });
    }

    if (settingsBtn && !settingsBtn.hasAttribute('data-listener-added')) {
        settingsBtn.setAttribute('data-listener-added', 'true');
        settingsBtn.addEventListener('click', function() {
            const modal = document.getElementById('cookie-settings-modal');
            if (modal) {
                modal.classList.remove('hidden');
                
                // Load current preferences into modal
                const preferences = cookieConsentManager.getPreferences();
                const analyticsCheck = document.getElementById('analytics-consent');
                const marketingCheck = document.getElementById('marketing-consent');
                const functionalCheck = document.getElementById('functional-consent');
                
                if (analyticsCheck) analyticsCheck.checked = preferences.analytics;
                if (marketingCheck) marketingCheck.checked = preferences.marketing;
                if (functionalCheck) functionalCheck.checked = preferences.functional;
            }
        });
    }

    if (closeModalBtn && !closeModalBtn.hasAttribute('data-listener-added')) {
        closeModalBtn.setAttribute('data-listener-added', 'true');
        closeModalBtn.addEventListener('click', function() {
            const modal = document.getElementById('cookie-settings-modal');
            if (modal) {
                modal.classList.add('hidden');
            }
        });
    }

    if (savePrefsBtn && !savePrefsBtn.hasAttribute('data-listener-added')) {
        savePrefsBtn.setAttribute('data-listener-added', 'true');
        savePrefsBtn.addEventListener('click', function() {
            const analyticsCheck = document.getElementById('analytics-consent');
            const marketingCheck = document.getElementById('marketing-consent');
            const functionalCheck = document.getElementById('functional-consent');
            
            const preferences = {
                essential: true,
                analytics: analyticsCheck ? analyticsCheck.checked : false,
                marketing: marketingCheck ? marketingCheck.checked : false,
                functional: functionalCheck ? functionalCheck.checked : false
            };
            
            cookieConsentManager.saveConsent(preferences);
            
            const modal = document.getElementById('cookie-settings-modal');
            if (modal) {
                modal.classList.add('hidden');
            }
        });
    }

    // Initialize cookie consent manager - Only once per page load
    if (!window.centrovaCookieConsentManagerLoaded) {
        window.centrovaCookieConsentManagerLoaded = true;
        cookieConsentManager.init();
    }
    
    // Make cookieConsentManager globally available for debugging
    window.centrovaCookieConsentManager = cookieConsentManager;
    
    /*
     * Debugging Commands (dapat dijalankan di browser console):
     * - window.centrovaCookieConsentManager.resetConsent() : Reset consent untuk testing
     * - window.centrovaCookieConsentManager.hasConsent() : Cek apakah consent sudah diberikan
     * - window.centrovaCookieConsentManager.getPreferences() : Lihat preferensi cookie saat ini
     * - window.centrovaCookieConsentManager.getDebugInfo() : Lihat informasi debug lengkap
     * 
     * Example untuk testing cross-subdomain:
     * 1. Buka centrova.test, terima cookie consent
     * 2. Buka support.centrova.test, seharusnya consent sudah ada
     * 3. Jalankan getDebugInfo() di kedua domain untuk membandingkan
     */
});
</script>
