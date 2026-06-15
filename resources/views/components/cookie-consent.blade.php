{{-- Cookie Consent Modal (Google-style) --}}
<div id="cookie-consent-modal" class="fixed inset-0 z-50 hidden">
    {{-- Overlay --}}
    <div id="cookie-overlay" class="absolute inset-0 bg-black/60"></div>
    
    {{-- Modal Container (flex column so header/body/footer stack) --}}
    <div class="absolute inset-0 flex items-end sm:items-center justify-center sm:p-4">
        <div id="cookie-modal-panel" class="bg-white sm:rounded-2xl shadow-2xl w-full max-w-2xl flex flex-col h-screen sm:h-[90vh] sm:max-h-[90vh] overflow-hidden">
                    
            {{-- === VIEW 1: Main Consent View === --}}
            <div id="cookie-main-view" class="flex flex-col min-h-0 h-full">
                {{-- Sticky Header: Logo --}}
                <div class="flex-shrink-0 px-6 sm:px-8 pt-6 sm:pt-8 pb-4 bg-white">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('/assets/brand/favicon.svg') }}" 
                             alt="Centrova Logo" 
                             class="h-7 w-auto"
                             draggable="false">
                    </div>
                </div>

                {{-- Scrollable Content: Description + Cookie List --}}
                <div class="flex-1 overflow-y-auto px-6 sm:px-8 py-2 min-h-0 tracking-tight">
                    <h3 class="text-2xl font-medium text-gray-900 mb-3 text-center">Sebelum Anda melanjutkan</h3>
                    <p class="text-base text-neutral-700 leading-relaxed mb-4">
                        Kami menggunakan cookie untuk berbagai keperluan berikut. Anda dapat memilih atau mengatur 
                        preferensi cookie sesuai keinginan Anda.
                    </p>

                    {{-- Cookie Purposes List --}}
                    <div class="space-y-3">
                        {{-- Essential --}}
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-neutral-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-neutral-700">Untuk login, keamanan akun, dan fungsi dasar website agar berjalan normal.</p>
                            </div>
                        </div>

                        {{-- Analytics --}}
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-neutral-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-neutral-700">Membantu kami memahami halaman mana yang dikunjungi dan bagaimana pengguna berinteraksi dengan website.</p>
                            </div>
                        </div>

                        {{-- Marketing --}}
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-neutral-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-neutral-700">Untuk menampilkan promosi, iklan yang relevan, dan mengukur efektivitas kampanye pemasaran.</p>
                            </div>
                        </div>

                        {{-- Functional --}}
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-neutral-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-neutral-700">Untuk menyimpan preferensi seperti bahasa, tema tampilan, dan pengaturan personal lainnya.</p>
                            </div>
                        </div>
                    </div>

                    <p class="text-base text-neutral-700 leading-relaxed mt-4">
                        Dengan mengklik "Terima Semua", Anda menyetujui penggunaan semua cookie. 
                        Anda dapat mengubah pengaturan kapan saja melalui menu <strong>Pengaturan</strong>.
                    </p>
                </div>

                {{-- Sticky Footer: Buttons --}}
                <div class="flex-shrink-0 px-6 sm:px-8 py-8 sm:rounded-b-2xl">
                    <div class="flex flex-col-reverse sm:flex-row justify-end gap-3">
                        <button id="cookie-settings-btn" 
                                class="w-full sm:w-auto px-5 py-2.5 text-sm font-medium text-white bg-primary-600 rounded-full hover:bg-primary-700 transition">
                            Pengaturan
                        </button>
                        <button id="cookie-accept-all" 
                                class="w-full sm:w-auto px-5 py-2.5 text-sm font-medium text-white bg-primary-600 rounded-full hover:bg-primary-700 transition">
                            Terima Semua
                        </button>
                    </div>
                </div>
            </div>

            {{-- === VIEW 2: Settings View === --}}
            <div id="cookie-settings-view" class="hidden flex flex-col min-h-0 h-full tracking-tight">
                {{-- Sticky Header: Back + Title + Close --}}
                <div class="flex-shrink-0 px-6 sm:px-8 pt-6 sm:pt-8 pb-4 bg-white">
                    <div class="flex items-center">
                        <h2 class="text-xl font-medium text-gray-900">Pengaturan Cookie</h2>
                    </div>
                </div>

                {{-- Scrollable Content: Cookie Categories --}}
                <div class="flex-1 overflow-y-auto px-6 sm:px-8 py-4 min-h-0">
                    <div class="space-y-4">
                        {{-- Essential --}}
                        <div class="py-2">
                            <div class="flex justify-between items-center">
                                <div class="mr-5 flex-shrink-0">
                                    <input type="checkbox" id="essential-consent" 
                                           class="w-5 h-5 text-gray-400 border-gray-300 rounded bg-gray-100 cursor-not-allowed" 
                                           checked disabled>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-base font-normal text-neutral-900">Cookie Penting</h3>
                                    <p class="text-[15px] text-neutral-700 mt-0.5">Diperlukan untuk login, keamanan, dan fungsi dasar website.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Analytics --}}
                        <div class="py-2">
                            <div class="flex justify-between items-center">
                                <div class="mr-5 flex-shrink-0">
                                    <input type="checkbox" id="analytics-consent" 
                                           class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500 cursor-pointer">
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-base font-normal text-neutral-900">Cookie Analitik</h3>
                                    <p class="text-[15px] text-neutral-700 mt-0.5">Membantu kami memahami penggunaan website secara anonim.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Marketing --}}
                        <div class="py-2">
                            <div class="flex justify-between items-center">
                                <div class="mr-5 flex-shrink-0">
                                    <input type="checkbox" id="marketing-consent" 
                                           class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500 cursor-pointer">
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-base font-normal text-neutral-900">Cookie Marketing</h3>
                                    <p class="text-[15px] text-neutral-700 mt-0.5">Untuk menampilkan iklan yang relevan dan mengukur kampanye.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Functional --}}
                        <div class="py-2">
                            <div class="flex justify-between items-center">
                                <div class="mr-5 flex-shrink-0">
                                    <input type="checkbox" id="functional-consent" 
                                           class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500 cursor-pointer">
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-base font-normal text-neutral-900">Cookie Fungsional</h3>
                                    <p class="text-[15px] text-neutral-700 mt-0.5">Untuk preferensi bahasa, tema, dan personalisasi lainnya.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sticky Footer: Save --}}
                <div class="flex-shrink-0 px-6 sm:px-8 py-8 sm:rounded-b-2xl">
                    <div class="flex flex-col-reverse sm:flex-row justify-end gap-3">
                        <button id="cookie-back-btn" 
                                class="w-full sm:w-auto px-5 py-2.5 text-sm font-medium text-primary-500 hover:text-primary-600 bg-transparent rounded-full hover:bg-primary-50 transition border border-neutral-400">
                            Kembali
                        </button>
                        <button id="save-cookie-preferences" 
                                class="w-full sm:w-auto px-5 py-2.5 text-sm font-medium text-white bg-primary-600 rounded-full hover:bg-primary-700 transition">
                            Simpan Preferensi
                        </button>
                    </div>
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
        
        // Track scrollbar width to prevent layout shift
        scrollbarWidth: 0,

        // Lock body scroll when modal opens
        lockBodyScroll: function() {
            // Calculate scrollbar width
            this.scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
            document.body.style.overflow = 'hidden';
            document.body.style.paddingRight = this.scrollbarWidth + 'px';
        },

        // Unlock body scroll when modal closes
        unlockBodyScroll: function() {
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
        },
        
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

        // Show modal if no consent given
        showBanner: function() {
            const hasConsent = this.hasConsent();
            
            if (!hasConsent) {
                // Lock body scroll
                this.lockBodyScroll();
                
                const modal = document.getElementById('cookie-consent-modal');
                const panel = document.getElementById('cookie-modal-panel');
                if (modal) {
                    modal.classList.remove('hidden');
                    // Animate in
                    requestAnimationFrame(() => {
                        panel.classList.remove('scale-95');
                        panel.classList.add('scale-100');
                    });
                }
                // Reset to main view
                this.showMainView();
            }
        },

        // Hide modal
        hideBanner: function() {
            const modal = document.getElementById('cookie-consent-modal');
            const panel = document.getElementById('cookie-modal-panel');
            if (modal) {
                panel.classList.remove('scale-100');
                panel.classList.add('scale-95');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    // Unlock body scroll after animation
                    this.unlockBodyScroll();
                }, 200);
            }
        },

        // Show main consent view, hide settings view
        showMainView: function() {
            const mainView = document.getElementById('cookie-main-view');
            const settingsView = document.getElementById('cookie-settings-view');
            if (mainView) mainView.classList.remove('hidden');
            if (settingsView) settingsView.classList.add('hidden');
        },

        // Show settings view, hide main view
        showSettingsView: function() {
            const mainView = document.getElementById('cookie-main-view');
            const settingsView = document.getElementById('cookie-settings-view');
            if (mainView) mainView.classList.add('hidden');
            if (settingsView) settingsView.classList.remove('hidden');
            
            // Load current preferences into modal
            const preferences = this.getPreferences();
            const analyticsCheck = document.getElementById('analytics-consent');
            const marketingCheck = document.getElementById('marketing-consent');
            const functionalCheck = document.getElementById('functional-consent');
            
            if (analyticsCheck) analyticsCheck.checked = preferences.analytics;
            if (marketingCheck) marketingCheck.checked = preferences.marketing;
            if (functionalCheck) functionalCheck.checked = preferences.functional;
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
            if (window.centrovaGALoaded) return;
            window.centrovaGALoaded = true;

            const gaId = '{{ config("services.google.analytics_id") }}';
            if (!gaId || gaId === 'G-XXXXXXXXXX') return;

            // Load Google Analytics 4 (gtag.js)
            const gaScript = document.createElement('script');
            gaScript.async = true;
            gaScript.src = 'https://www.googletagmanager.com/gtag/js?id=' + gaId;
            document.head.appendChild(gaScript);

            // Initialize gtag
            window.dataLayer = window.dataLayer || [];
            window.gtag = function(){ dataLayer.push(arguments); };
            gtag('js', new Date());
            gtag('config', gaId, {
                cookie_flags: 'SameSite=Lax;Secure',
                cookie_domain: window.location.hostname
            });
        },

        // Load marketing scripts
        loadMarketing: function() {
            // Load marketing pixels, Facebook Pixel, etc.
        },

        // Load functional enhancements
        loadFunctional: function() {
            // Load additional functional features
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
            
            // Show modal again
            this.showBanner();
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
        }
    };

    // Event listeners - Main View
    const acceptAllBtn = document.getElementById('cookie-accept-all');
    const settingsBtn = document.getElementById('cookie-settings-btn');
    
    // Event listeners - Settings View
    const backBtn = document.getElementById('cookie-back-btn');
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

    // Settings button switches to settings view within the same modal
    if (settingsBtn && !settingsBtn.hasAttribute('data-listener-added')) {
        settingsBtn.setAttribute('data-listener-added', 'true');
        settingsBtn.addEventListener('click', function() {
            cookieConsentManager.showSettingsView();
        });
    }

    // Back button returns to main view
    if (backBtn && !backBtn.hasAttribute('data-listener-added')) {
        backBtn.setAttribute('data-listener-added', 'true');
        backBtn.addEventListener('click', function() {
            cookieConsentManager.showMainView();
        });
    }

    // Close modal (X button in settings) - goes back to main view
    if (closeModalBtn && !closeModalBtn.hasAttribute('data-listener-added')) {
        closeModalBtn.setAttribute('data-listener-added', 'true');
        closeModalBtn.addEventListener('click', function() {
            cookieConsentManager.showMainView();
        });
    }

    // Save preferences button
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
