@push('styles')
<style>
#monaco-editor {
    height: 100%;
    overflow: hidden;
}

.monaco-editor-container {
    position: relative;
    background: #ffffff;
    height: 100%;
}

.code-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 8px 12px;
    background: #f8f9fa;
    border-bottom: 1px solid #e1e4e8;
    font-size: 12px;
    color: #6a737d;
}

.code-language {
    font-family: ui-monospace, SFMono-Regular, 'SF Mono', Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;
    font-weight: 500;
}

/* Preview Styles */
.preview-container {
    position: relative;
    background: #f8f9fa;
    height: 100%;
}

.preview-toolbar {
    user-select: none;
}

.preview-content {
    position: relative;
    overflow: visible;
    min-height: 100px;
    height: calc(100% - 60px);
}

/* Iframe styling */
#preview-frame {
    border: none;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    width: 100%;
    height: 100%;
    min-height: 300px;
    transition: opacity 0.2s ease-in-out;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

#preview-frame::-webkit-scrollbar {
    display: none;
}

.preview-content {
    overflow: hidden;
}

#resizable-preview {
    overflow: hidden;
    scrollbar-width: none;
    -ms-overflow-style: none;
    height: 100%;
}

#resizable-preview::-webkit-scrollbar {
    display: none;
}

/* Toggle button active state */
.toggle-active {
    background-color: white !important;
    color: #111827 !important;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
}

/* Loading state for iframe */
.preview-loading::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
}

.preview-loading::before {
    content: 'Loading preview...';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 11;
    font-size: 14px;
    color: #6b7280;
}

/* Live indicator styles */
#live-indicator {
    transition: opacity 0.3s ease-in-out;
}

/* Real-time update animation */
@keyframes live-pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.live-updating {
    animation: live-pulse 1s ease-in-out infinite;
}

/* Smooth iframe transitions */
.preview-updating #preview-frame {
    opacity: 0.8;
}

/* Splitter styles */
.splitter {
    width: 4px;
    background: #e5e7eb;
    cursor: col-resize;
    transition: background-color 0.2s ease;
}

.splitter:hover {
    background: #3b82f6;
}

.splitter.resizing {
    background: #3b82f6;
}

/* Editor container */
.editor-container {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.editor-content-area {
    flex: 1;
    overflow: hidden;
}

/* Fullscreen transition styles */
#left-panel, #right-panel {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

#left-panel {
    transition-property: width, opacity;
}

/* Fullscreen zoom animation */
.fullscreen-mode {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    width: 100vw !important;
    height: 100vh !important;
    z-index: 9999 !important;
    background: white !important;
    transform: scale(1) !important;
    animation: zoomToFullscreen 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

/* Hide page scrollbar when in fullscreen mode */
body.fullscreen-active {
    overflow: hidden !important;
}

.fullscreen-mode #split-container {
    height: 100vh !important;
}

.fullscreen-mode #main-header {
    display: none !important;
}

.fullscreen-mode #left-panel {
    display: none !important;
}

.fullscreen-mode #right-panel {
    width: 100% !important;
    flex: none !important;
}

@keyframes zoomToFullscreen {
    0% {
        transform: scale(1);
        border-radius: 0;
    }
    50% {
        transform: scale(1.02);
        border-radius: 8px;
    }
    100% {
        transform: scale(1);
        border-radius: 0;
    }
}

.exit-fullscreen {
    animation: zoomFromFullscreen 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@keyframes zoomFromFullscreen {
    0% {
        transform: scale(1);
        border-radius: 0;
    }
    50% {
        transform: scale(0.98);
        border-radius: 8px;
    }
    100% {
        transform: scale(1);
        border-radius: 0;
    }
}

/* Disabled preview button styles */
button:disabled {
    cursor: not-allowed !important;
    opacity: 0.5 !important;
}

button:disabled:hover {
    background-color: white !important;
}

/* Dark mode styles akan dihandle oleh Tailwind CSS classes */

.dark-theme .hover\:text-gray-600:hover {
    color: #cccccc !important;
}

/* Dark scrollbar for preview */
.dark-theme #preview-frame {
    background: #1e1e1e !important;
}

/* Theme transition - only for editor component elements */
#editor-container * {
    transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
}

#editor-panel * {
    transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
}

#preview-panel * {
    transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
}
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.44.0/min/vs/loader.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.14.9/beautify-html.min.js"></script>
<script src="https://unpkg.com/emmet-monaco-es@5.3.0/dist/emmet-monaco.min.js"></script>
@endpush

<!-- Main Editor Container -->
<div id="editor-container" class="h-full flex w-full flex-shrink-0 bg-white dark:bg-gray-900">
    <!-- Code Editor Panel -->
    <div id="editor-panel" class="flex-1 flex-shrink-0 bg-white dark:bg-gray-900 overflow-hidden">
        <div class="editor-container">
            <!-- Editor Header -->
            <div class="editor-tabs px-4 py-2 bg-white dark:bg-[#1E1E1E]">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <button id="toggle-fullscreen" type="button" 
                                class="inline-flex items-center p-1.5 aspect-square rounded-lg text-xs font-medium text-neutral-700 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-700">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.4145 16.6522L7.34042 16.6592L7.34749 10.5852C7.34749 10.3189 7.2417 10.0635 7.0534 9.87518C6.86509 9.68688 6.6097 9.58109 6.3434 9.58109C6.0771 9.58109 5.8217 9.68688 5.6334 9.87518C5.44509 10.0635 5.33931 10.3189 5.33931 10.5852L5.33931 17.6563C5.33877 17.7883 5.36437 17.9191 5.41463 18.0411C5.4649 18.1632 5.53884 18.2741 5.63219 18.3675C5.72554 18.4608 5.83644 18.5347 5.95851 18.585C6.08057 18.6353 6.21139 18.6609 6.3434 18.6603L13.4145 18.6603C13.5463 18.6603 13.6769 18.6344 13.7987 18.5839C13.9205 18.5335 14.0312 18.4595 14.1245 18.3663C14.2177 18.273 14.2917 18.1623 14.3421 18.0405C14.3926 17.9187 14.4186 17.7881 14.4186 17.6563C14.4186 17.5244 14.3926 17.3938 14.3421 17.272C14.2917 17.1502 14.2177 17.0395 14.1245 16.9463C14.0312 16.853 13.9205 16.7791 13.7987 16.7286C13.6769 16.6781 13.5463 16.6522 13.4145 16.6522V16.6522ZM10.586 7.34664L16.6601 7.33956L16.653 13.4136C16.6525 13.5456 16.6781 13.6764 16.7283 13.7985C16.7786 13.9206 16.8526 14.0315 16.9459 14.1248C17.0392 14.2182 17.1502 14.2921 17.2722 14.3424C17.3943 14.3926 17.5251 14.4182 17.6571 14.4177C17.7891 14.4182 17.9199 14.3926 18.042 14.3424C18.1641 14.2921 18.275 14.2182 18.3683 14.1248C18.4617 14.0315 18.5356 13.9206 18.5859 13.7985C18.6361 13.6764 18.6617 13.5456 18.6612 13.4136L18.6612 6.34254C18.6617 6.21053 18.6361 6.07972 18.5859 5.95766C18.5356 5.83559 18.4617 5.72468 18.3683 5.63134C18.275 5.53799 18.1641 5.46405 18.042 5.41378C17.9199 5.36351 17.7891 5.33791 17.6571 5.33845L10.586 5.33845C10.3197 5.33845 10.0643 5.44424 9.87604 5.63254C9.68774 5.82085 9.58195 6.07624 9.58195 6.34254C9.58195 6.60885 9.68774 6.86424 9.87604 7.05254C10.0643 7.24085 10.3197 7.34664 10.586 7.34664Z" fill="currentColor"/>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <button id="theme-toggle" type="button" 
                                class="inline-flex items-center px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                title="Toggle dark/light theme">
                            <svg id="theme-icon-light" class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <svg id="theme-icon-dark" class="w-3 h-3 mr-1 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                            <span id="theme-text">Dark</span>
                        </button>
                        <button id="toggle-preview" type="button" 
                                class="hidden items-center px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" 
                                title="Toggle preview panel">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <span id="preview-toggle-text">Show Preview</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Editor Content Area -->
            <div class="editor-content-area">
                <!-- Single Editor for all code -->
                <div id="main-editor" class="editor-content h-full">
                    <textarea id="html-code" class="hidden">{!! $component->html_code !!}</textarea>
                    <div id="monaco-editor" class="h-full"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Preview Panel -->
    <div id="preview-panel" class="w-1/2 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden hidden">
        <div class="preview-container bg-gray-50 dark:bg-gray-800">
            <!-- Preview Header -->
            <div class="flex items-center justify-between px-4 py-3 bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-3">
                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100 flex items-center">
                        Live Preview
                        <span id="live-indicator" class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-green-900 text-blue-800 dark:text-green-300 opacity-0 transition-opacity duration-300">
                            <span class="w-1.5 h-1.5 bg-blue-400 dark:bg-green-400 rounded-full mr-1.5 animate-pulse"></span>
                            Live
                        </span>
                    </h4>
                </div>
                
                <div class="flex items-center space-x-2">
                    <!-- View Mode Toggles -->
                    <div class="flex items-center space-x-1 bg-gray-100 dark:bg-gray-700 rounded p-1">
                        <button id="mobile-view" type="button" 
                                class="px-2 py-1 text-xs font-medium rounded transition-colors duration-200 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                            📱
                        </button>
                        <button id="tablet-view" type="button" 
                                class="px-2 py-1 text-xs font-medium rounded transition-colors duration-200 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                            📱
                        </button>
                        <button id="desktop-view" type="button" 
                                class="px-2 py-1 text-xs font-medium rounded transition-colors duration-200 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 bg-white dark:bg-blue-600 shadow-sm">
                            🖥️
                        </button>
                    </div>
                    
                    <!-- Refresh Button -->
                    <button id="refresh-preview" type="button" 
                            class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                    </button>
                    
                    <!-- Fullscreen Button -->
                    <button id="fullscreen-preview" type="button" 
                            class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Preview Content -->
            <div class="preview-content p-4">
                <div id="resizable-preview" class="h-full" style="min-width: 375px; max-width: 100%; width: 100%;">
                    <iframe id="preview-frame" 
                            class="w-full h-full border-0 rounded shadow-sm" 
                            sandbox="allow-scripts allow-same-origin"
                            scrolling="no"
                            srcdoc="">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let htmlEditor;
    let isPreviewVisible = false;
    let currentViewMode = 'desktop';
    let isFullscreenMode = false;
    let currentTheme = 'light';
    
    // Load saved theme from localStorage
    const savedTheme = localStorage.getItem('code-editor-theme') || 'light';
    
    // Initialize theme
    function initializeTheme() {
        currentTheme = savedTheme;
        applyTheme(currentTheme);
        updateThemeButton();
    }
    
    // Apply theme
    function applyTheme(theme) {
        // Toggle dark class on html element for Tailwind dark mode
        const htmlElement = document.documentElement;
        
        if (theme === 'dark') {
            htmlElement.classList.add('dark');
        } else {
            htmlElement.classList.remove('dark');
        }
        
        // Update Monaco Editor theme if editor is ready
        if (htmlEditor) {
            const monacoTheme = theme === 'dark' ? 'vs-dark' : 'vs';
            monaco.editor.setTheme(monacoTheme);
        }
    }
    
    // Update theme button appearance
    function updateThemeButton() {
        const lightIcon = document.getElementById('theme-icon-light');
        const darkIcon = document.getElementById('theme-icon-dark');
        const themeText = document.getElementById('theme-text');
        
        if (currentTheme === 'dark') {
            lightIcon.classList.add('hidden');
            darkIcon.classList.remove('hidden');
            themeText.textContent = 'Light';
        } else {
            lightIcon.classList.remove('hidden');
            darkIcon.classList.add('hidden');
            themeText.textContent = 'Dark';
        }
    }
    
    // Theme toggle event listener
    document.getElementById('theme-toggle').addEventListener('click', function() {
        currentTheme = currentTheme === 'light' ? 'dark' : 'light';
        applyTheme(currentTheme);
        updateThemeButton();
        
        // Save to localStorage
        localStorage.setItem('code-editor-theme', currentTheme);
        
        // Show brief feedback
        const button = this;
        const originalBg = button.style.backgroundColor;
        button.style.backgroundColor = currentTheme === 'dark' ? '#374151' : '#f3f4f6';
        setTimeout(() => {
            button.style.backgroundColor = originalBg;
        }, 200);
    });
    
    // Initialize theme on page load
    initializeTheme();
    
    // Initialize Monaco Editor
    require.config({ paths: { 'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.44.0/min/vs' }});
    require(['vs/editor/editor.main'], function() {
        
        // Configure HTML language features
        monaco.languages.html.htmlDefaults.setOptions({
            format: {
                tabSize: 2,
                insertSpaces: true,
                wrapLineLength: 120,
                unformatted: 'default"',
                contentUnformatted: 'pre,code,textarea',
                indentInnerHtml: true,
                preserveNewLines: true,
                maxPreserveNewLines: 2,
                indentHandlebars: false,
                endWithNewline: false,
                extraLiners: 'head, body, /html',
                wrapAttributes: 'auto'
            },
            suggest: {
                html5: true,
                angular1: false,
                ionic: false
            },
            validate: true
        });

        // TailwindCSS class completion provider
        const tailwindClasses = [
            // Layout
            'container', 'box-border', 'box-content', 'block', 'inline-block', 'inline', 'flex', 'inline-flex', 'table', 'inline-table', 'table-caption', 'table-cell', 'table-column', 'table-column-group', 'table-footer-group', 'table-header-group', 'table-row-group', 'table-row', 'flow-root', 'grid', 'inline-grid', 'contents', 'list-item', 'hidden',
            
            // Flexbox & Grid
            'flex-row', 'flex-row-reverse', 'flex-col', 'flex-col-reverse', 'flex-wrap', 'flex-wrap-reverse', 'flex-nowrap', 'flex-1', 'flex-auto', 'flex-initial', 'flex-none', 'justify-start', 'justify-end', 'justify-center', 'justify-between', 'justify-around', 'justify-evenly', 'items-start', 'items-end', 'items-center', 'items-baseline', 'items-stretch', 'content-center', 'content-start', 'content-end', 'content-between', 'content-around', 'content-evenly',
            
            // Spacing
            'm-0', 'm-1', 'm-2', 'm-3', 'm-4', 'm-5', 'm-6', 'm-8', 'm-10', 'm-12', 'm-16', 'm-20', 'm-24', 'm-32', 'm-40', 'm-48', 'm-56', 'm-64', 'm-auto',
            'mx-0', 'mx-1', 'mx-2', 'mx-3', 'mx-4', 'mx-5', 'mx-6', 'mx-8', 'mx-10', 'mx-12', 'mx-16', 'mx-20', 'mx-24', 'mx-32', 'mx-40', 'mx-48', 'mx-56', 'mx-64', 'mx-auto',
            'my-0', 'my-1', 'my-2', 'my-3', 'my-4', 'my-5', 'my-6', 'my-8', 'my-10', 'my-12', 'my-16', 'my-20', 'my-24', 'my-32', 'my-40', 'my-48', 'my-56', 'my-64', 'my-auto',
            'mt-0', 'mt-1', 'mt-2', 'mt-3', 'mt-4', 'mt-5', 'mt-6', 'mt-8', 'mt-10', 'mt-12', 'mt-16', 'mt-20', 'mt-24', 'mt-32', 'mt-40', 'mt-48', 'mt-56', 'mt-64', 'mt-auto',
            'mr-0', 'mr-1', 'mr-2', 'mr-3', 'mr-4', 'mr-5', 'mr-6', 'mr-8', 'mr-10', 'mr-12', 'mr-16', 'mr-20', 'mr-24', 'mr-32', 'mr-40', 'mr-48', 'mr-56', 'mr-64', 'mr-auto',
            'mb-0', 'mb-1', 'mb-2', 'mb-3', 'mb-4', 'mb-5', 'mb-6', 'mb-8', 'mb-10', 'mb-12', 'mb-16', 'mb-20', 'mb-24', 'mb-32', 'mb-40', 'mb-48', 'mb-56', 'mb-64', 'mb-auto',
            'ml-0', 'ml-1', 'ml-2', 'ml-3', 'ml-4', 'ml-5', 'ml-6', 'ml-8', 'ml-10', 'ml-12', 'ml-16', 'ml-20', 'ml-24', 'ml-32', 'ml-40', 'ml-48', 'ml-56', 'ml-64', 'ml-auto',
            
            'p-0', 'p-1', 'p-2', 'p-3', 'p-4', 'p-5', 'p-6', 'p-8', 'p-10', 'p-12', 'p-16', 'p-20', 'p-24', 'p-32', 'p-40', 'p-48', 'p-56', 'p-64',
            'px-0', 'px-1', 'px-2', 'px-3', 'px-4', 'px-5', 'px-6', 'px-8', 'px-10', 'px-12', 'px-16', 'px-20', 'px-24', 'px-32', 'px-40', 'px-48', 'px-56', 'px-64',
            'py-0', 'py-1', 'py-2', 'py-3', 'py-4', 'py-5', 'py-6', 'py-8', 'py-10', 'py-12', 'py-16', 'py-20', 'py-24', 'py-32', 'py-40', 'py-48', 'py-56', 'py-64',
            'pt-0', 'pt-1', 'pt-2', 'pt-3', 'pt-4', 'pt-5', 'pt-6', 'pt-8', 'pt-10', 'pt-12', 'pt-16', 'pt-20', 'pt-24', 'pt-32', 'pt-40', 'pt-48', 'pt-56', 'pt-64',
            'pr-0', 'pr-1', 'pr-2', 'pr-3', 'pr-4', 'pr-5', 'pr-6', 'pr-8', 'pr-10', 'pr-12', 'pr-16', 'pr-20', 'pr-24', 'pr-32', 'pr-40', 'pr-48', 'pr-56', 'pr-64',
            'pb-0', 'pb-1', 'pb-2', 'pb-3', 'pb-4', 'pb-5', 'pb-6', 'pb-8', 'pb-10', 'pb-12', 'pb-16', 'pb-20', 'pb-24', 'pb-32', 'pb-40', 'pb-48', 'pb-56', 'pb-64',
            'pl-0', 'pl-1', 'pl-2', 'pl-3', 'pl-4', 'pl-5', 'pl-6', 'pl-8', 'pl-10', 'pl-12', 'pl-16', 'pl-20', 'pl-24', 'pl-32', 'pl-40', 'pl-48', 'pl-56', 'pl-64',
            
            // Sizing
            'w-0', 'w-1', 'w-2', 'w-3', 'w-4', 'w-5', 'w-6', 'w-8', 'w-10', 'w-12', 'w-16', 'w-20', 'w-24', 'w-32', 'w-40', 'w-48', 'w-56', 'w-64', 'w-auto', 'w-px', 'w-0.5', 'w-1.5', 'w-2.5', 'w-3.5',
            'w-1/2', 'w-1/3', 'w-2/3', 'w-1/4', 'w-2/4', 'w-3/4', 'w-1/5', 'w-2/5', 'w-3/5', 'w-4/5', 'w-1/6', 'w-2/6', 'w-3/6', 'w-4/6', 'w-5/6', 'w-1/12', 'w-2/12', 'w-3/12', 'w-4/12', 'w-5/12', 'w-6/12', 'w-7/12', 'w-8/12', 'w-9/12', 'w-10/12', 'w-11/12', 'w-full', 'w-screen', 'w-min', 'w-max', 'w-fit',
            
            'h-0', 'h-1', 'h-2', 'h-3', 'h-4', 'h-5', 'h-6', 'h-8', 'h-10', 'h-12', 'h-16', 'h-20', 'h-24', 'h-32', 'h-40', 'h-48', 'h-56', 'h-64', 'h-auto', 'h-px', 'h-0.5', 'h-1.5', 'h-2.5', 'h-3.5',
            'h-1/2', 'h-1/3', 'h-2/3', 'h-1/4', 'h-2/4', 'h-3/4', 'h-1/5', 'h-2/5', 'h-3/5', 'h-4/5', 'h-1/6', 'h-2/6', 'h-3/6', 'h-4/6', 'h-5/6', 'h-full', 'h-screen', 'h-min', 'h-max', 'h-fit',
            
            // Typography
            'text-xs', 'text-sm', 'text-base', 'text-lg', 'text-xl', 'text-2xl', 'text-3xl', 'text-4xl', 'text-5xl', 'text-6xl', 'text-7xl', 'text-8xl', 'text-9xl',
            'font-thin', 'font-extralight', 'font-light', 'font-normal', 'font-medium', 'font-semibold', 'font-bold', 'font-extrabold', 'font-black',
            'text-left', 'text-center', 'text-right', 'text-justify',
            'text-black', 'text-white', 'text-gray-50', 'text-gray-100', 'text-gray-200', 'text-gray-300', 'text-gray-400', 'text-gray-500', 'text-gray-600', 'text-gray-700', 'text-gray-800', 'text-gray-900',
            'text-red-50', 'text-red-100', 'text-red-200', 'text-red-300', 'text-red-400', 'text-red-500', 'text-red-600', 'text-red-700', 'text-red-800', 'text-red-900',
            'text-blue-50', 'text-blue-100', 'text-blue-200', 'text-blue-300', 'text-blue-400', 'text-blue-500', 'text-blue-600', 'text-blue-700', 'text-blue-800', 'text-blue-900',
            'text-green-50', 'text-green-100', 'text-green-200', 'text-green-300', 'text-green-400', 'text-green-500', 'text-green-600', 'text-green-700', 'text-green-800', 'text-green-900',
            'text-yellow-50', 'text-yellow-100', 'text-yellow-200', 'text-yellow-300', 'text-yellow-400', 'text-yellow-500', 'text-yellow-600', 'text-yellow-700', 'text-yellow-800', 'text-yellow-900',
            'text-purple-50', 'text-purple-100', 'text-purple-200', 'text-purple-300', 'text-purple-400', 'text-purple-500', 'text-purple-600', 'text-purple-700', 'text-purple-800', 'text-purple-900',
            'text-pink-50', 'text-pink-100', 'text-pink-200', 'text-pink-300', 'text-pink-400', 'text-pink-500', 'text-pink-600', 'text-pink-700', 'text-pink-800', 'text-pink-900',
            'text-indigo-50', 'text-indigo-100', 'text-indigo-200', 'text-indigo-300', 'text-indigo-400', 'text-indigo-500', 'text-indigo-600', 'text-indigo-700', 'text-indigo-800', 'text-indigo-900',
            
            // Background Colors
            'bg-transparent', 'bg-current', 'bg-black', 'bg-white',
            'bg-gray-50', 'bg-gray-100', 'bg-gray-200', 'bg-gray-300', 'bg-gray-400', 'bg-gray-500', 'bg-gray-600', 'bg-gray-700', 'bg-gray-800', 'bg-gray-900',
            'bg-red-50', 'bg-red-100', 'bg-red-200', 'bg-red-300', 'bg-red-400', 'bg-red-500', 'bg-red-600', 'bg-red-700', 'bg-red-800', 'bg-red-900',
            'bg-blue-50', 'bg-blue-100', 'bg-blue-200', 'bg-blue-300', 'bg-blue-400', 'bg-blue-500', 'bg-blue-600', 'bg-blue-700', 'bg-blue-800', 'bg-blue-900',
            'bg-green-50', 'bg-green-100', 'bg-green-200', 'bg-green-300', 'bg-green-400', 'bg-green-500', 'bg-green-600', 'bg-green-700', 'bg-green-800', 'bg-green-900',
            'bg-yellow-50', 'bg-yellow-100', 'bg-yellow-200', 'bg-yellow-300', 'bg-yellow-400', 'bg-yellow-500', 'bg-yellow-600', 'bg-yellow-700', 'bg-yellow-800', 'bg-yellow-900',
            'bg-purple-50', 'bg-purple-100', 'bg-purple-200', 'bg-purple-300', 'bg-purple-400', 'bg-purple-500', 'bg-purple-600', 'bg-purple-700', 'bg-purple-800', 'bg-purple-900',
            'bg-pink-50', 'bg-pink-100', 'bg-pink-200', 'bg-pink-300', 'bg-pink-400', 'bg-pink-500', 'bg-pink-600', 'bg-pink-700', 'bg-pink-800', 'bg-pink-900',
            'bg-indigo-50', 'bg-indigo-100', 'bg-indigo-200', 'bg-indigo-300', 'bg-indigo-400', 'bg-indigo-500', 'bg-indigo-600', 'bg-indigo-700', 'bg-indigo-800', 'bg-indigo-900',
            
            // Border
            'border', 'border-0', 'border-2', 'border-4', 'border-8', 'border-t', 'border-r', 'border-b', 'border-l',
            'border-gray-50', 'border-gray-100', 'border-gray-200', 'border-gray-300', 'border-gray-400', 'border-gray-500', 'border-gray-600', 'border-gray-700', 'border-gray-800', 'border-gray-900',
            'border-red-500', 'border-blue-500', 'border-green-500', 'border-yellow-500', 'border-purple-500', 'border-pink-500', 'border-indigo-500',
            'rounded', 'rounded-none', 'rounded-sm', 'rounded-md', 'rounded-lg', 'rounded-xl', 'rounded-2xl', 'rounded-3xl', 'rounded-full',
            'rounded-t', 'rounded-r', 'rounded-b', 'rounded-l', 'rounded-tl', 'rounded-tr', 'rounded-br', 'rounded-bl',
            
            // Shadow
            'shadow', 'shadow-sm', 'shadow-md', 'shadow-lg', 'shadow-xl', 'shadow-2xl', 'shadow-inner', 'shadow-none',
            
            // Effects
            'opacity-0', 'opacity-5', 'opacity-10', 'opacity-20', 'opacity-25', 'opacity-30', 'opacity-40', 'opacity-50', 'opacity-60', 'opacity-70', 'opacity-75', 'opacity-80', 'opacity-90', 'opacity-95', 'opacity-100',
            
            // Transitions
            'transition', 'transition-none', 'transition-all', 'transition-colors', 'transition-opacity', 'transition-shadow', 'transition-transform',
            'duration-75', 'duration-100', 'duration-150', 'duration-200', 'duration-300', 'duration-500', 'duration-700', 'duration-1000',
            'ease-linear', 'ease-in', 'ease-out', 'ease-in-out',
            
            // Transforms
            'transform', 'transform-gpu', 'transform-none',
            'scale-0', 'scale-50', 'scale-75', 'scale-90', 'scale-95', 'scale-100', 'scale-105', 'scale-110', 'scale-125', 'scale-150',
            'rotate-0', 'rotate-1', 'rotate-2', 'rotate-3', 'rotate-6', 'rotate-12', 'rotate-45', 'rotate-90', 'rotate-180',
            'translate-x-0', 'translate-x-1', 'translate-x-2', 'translate-x-3', 'translate-x-4', 'translate-x-5', 'translate-x-6', 'translate-x-8', 'translate-x-10', 'translate-x-12', 'translate-x-16', 'translate-x-20', 'translate-x-24', 'translate-x-32', 'translate-x-40', 'translate-x-48', 'translate-x-56', 'translate-x-64',
            'translate-y-0', 'translate-y-1', 'translate-y-2', 'translate-y-3', 'translate-y-4', 'translate-y-5', 'translate-y-6', 'translate-y-8', 'translate-y-10', 'translate-y-12', 'translate-y-16', 'translate-y-20', 'translate-y-24', 'translate-y-32', 'translate-y-40', 'translate-y-48', 'translate-y-56', 'translate-y-64',
            
            // Responsive prefixes
            'sm:', 'md:', 'lg:', 'xl:', '2xl:',
            
            // State prefixes
            'hover:', 'focus:', 'active:', 'disabled:', 'visited:', 'first:', 'last:', 'odd:', 'even:', 'group-hover:', 'group-focus:',
            
            // Popular utility combinations
            'flex items-center', 'flex justify-center', 'flex items-center justify-center', 'flex flex-col', 'flex flex-row',
            'grid grid-cols-1', 'grid grid-cols-2', 'grid grid-cols-3', 'grid grid-cols-4', 'grid grid-cols-12',
            'space-x-1', 'space-x-2', 'space-x-3', 'space-x-4', 'space-x-5', 'space-x-6', 'space-x-8',
            'space-y-1', 'space-y-2', 'space-y-3', 'space-y-4', 'space-y-5', 'space-y-6', 'space-y-8'
        ];

        // Register Tailwind completion provider
        monaco.languages.registerCompletionItemProvider('html', {
            provideCompletionItems: function(model, position) {
                const line = model.getLineContent(position.lineNumber);
                const wordAtPosition = model.getWordAtPosition(position);
                
                // Check if we're inside a class attribute
                const beforeCursor = line.substring(0, position.column - 1);
                const classMatch = beforeCursor.match(/class\s*=\s*["']([^"']*)$/);
                
                if (!classMatch) {
                    return { suggestions: [] };
                }
                
                const word = wordAtPosition ? wordAtPosition.word : '';
                const range = wordAtPosition ? {
                    startLineNumber: position.lineNumber,
                    endLineNumber: position.lineNumber,
                    startColumn: wordAtPosition.startColumn,
                    endColumn: wordAtPosition.endColumn
                } : {
                    startLineNumber: position.lineNumber,
                    endLineNumber: position.lineNumber,
                    startColumn: position.column,
                    endColumn: position.column
                };

                const suggestions = tailwindClasses
                    .filter(className => className.toLowerCase().includes(word.toLowerCase()))
                    .map(className => ({
                        label: className,
                        kind: monaco.languages.CompletionItemKind.Class,
                        insertText: className,
                        range: range,
                        documentation: `Tailwind CSS class: ${className}`,
                        detail: 'Tailwind CSS'
                    }));

                return { suggestions };
            }
        });

        // Enhanced HTML completion with common patterns
        monaco.languages.registerCompletionItemProvider('html', {
            provideCompletionItems: function(model, position) {
                const word = model.getWordUntilPosition(position);
                const range = {
                    startLineNumber: position.lineNumber,
                    endLineNumber: position.lineNumber,
                    startColumn: word.startColumn,
                    endColumn: word.endColumn
                };

                const htmlSnippets = [
                    {
                        label: 'div.container',
                        kind: monaco.languages.CompletionItemKind.Snippet,
                        insertText: '<div class="container">\n\t$0\n</div>',
                        insertTextRules: monaco.languages.CompletionItemInsertTextRule.InsertAsSnippet,
                        documentation: 'Container div with Tailwind CSS',
                        range: range
                    },
                    {
                        label: 'flex-center',
                        kind: monaco.languages.CompletionItemKind.Snippet,
                        insertText: '<div class="flex items-center justify-center">\n\t$0\n</div>',
                        insertTextRules: monaco.languages.CompletionItemInsertTextRule.InsertAsSnippet,
                        documentation: 'Flex container centered both ways',
                        range: range
                    },
                    {
                        label: 'button-primary',
                        kind: monaco.languages.CompletionItemKind.Snippet,
                        insertText: '<button class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">\n\t$0\n</button>',
                        insertTextRules: monaco.languages.CompletionItemInsertTextRule.InsertAsSnippet,
                        documentation: 'Primary button with Tailwind CSS styling',
                        range: range
                    },
                    {
                        label: 'card',
                        kind: monaco.languages.CompletionItemKind.Snippet,
                        insertText: '<div class="bg-white overflow-hidden shadow rounded-lg">\n\t<div class="px-4 py-5 sm:p-6">\n\t\t$0\n\t</div>\n</div>',
                        insertTextRules: monaco.languages.CompletionItemInsertTextRule.InsertAsSnippet,
                        documentation: 'Card component with Tailwind CSS',
                        range: range
                    },
                    {
                        label: 'grid-cols',
                        kind: monaco.languages.CompletionItemKind.Snippet,
                        insertText: '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">\n\t$0\n</div>',
                        insertTextRules: monaco.languages.CompletionItemInsertTextRule.InsertAsSnippet,
                        documentation: 'Responsive grid layout',
                        range: range
                    },
                    {
                        label: 'input-field',
                        kind: monaco.languages.CompletionItemKind.Snippet,
                        insertText: '<div class="mb-4">\n\t<label class="block text-sm font-medium text-gray-700 mb-2">$1</label>\n\t<input type="text" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="$2">\n</div>',
                        insertTextRules: monaco.languages.CompletionItemInsertTextRule.InsertAsSnippet,
                        documentation: 'Input field with label',
                        range: range
                    },
                    {
                        label: 'hero-section',
                        kind: monaco.languages.CompletionItemKind.Snippet,
                        insertText: '<div class="bg-gray-50 py-16">\n\t<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">\n\t\t<div class="text-center">\n\t\t\t<h1 class="text-4xl font-bold text-gray-900 sm:text-5xl md:text-6xl">\n\t\t\t\t$1\n\t\t\t</h1>\n\t\t\t<p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">\n\t\t\t\t$2\n\t\t\t</p>\n\t\t</div>\n\t</div>\n</div>',
                        insertTextRules: monaco.languages.CompletionItemInsertTextRule.InsertAsSnippet,
                        documentation: 'Hero section template',
                        range: range
                    }
                ];

                return { suggestions: htmlSnippets };
            }
        });

        // Single HTML Editor
        const htmlTextarea = document.getElementById('html-code');
        const editorContainer = document.getElementById('monaco-editor');
        if (htmlTextarea && editorContainer) {
            htmlEditor = monaco.editor.create(editorContainer, {
                value: htmlTextarea.value,
                language: 'html',
                theme: currentTheme === 'dark' ? 'vs-dark' : 'vs',
                automaticLayout: true,
                minimap: { enabled: false },
                scrollBeyondLastLine: false,
                fontSize: 14,
                lineNumbers: 'on',
                wordWrap: 'off',
                lineHeight: 20,
                tabSize: 6,
                insertSpaces: true,
                formatOnType: true,
                formatOnPaste: true,
                suggestOnTriggerCharacters: true,
                acceptSuggestionOnCommitCharacter: true,
                acceptSuggestionOnEnter: "on",
                snippetSuggestions: "top",
                suggest: {
                    showClasses: true,
                    showColors: true,
                    showConstants: true,
                    showConstructors: true,
                    showFields: true,
                    showFiles: true,
                    showFolders: true,
                    showFunctions: true,
                    showInterfaces: true,
                    showIssues: true,
                    showKeywords: true,
                    showMethods: true,
                    showModules: true,
                    showOperators: true,
                    showProperties: true,
                    showReferences: true,
                    showSnippets: true,
                    showStructs: true,
                    showTypeParameters: true,
                    showUnits: true,
                    showUsers: true,
                    showValues: true,
                    showVariables: true,
                    showWords: true
                },
                quickSuggestions: {
                    other: true,
                    comments: false,
                    strings: true
                },
                parameterHints: {
                    enabled: true
                },
                autoIndent: "full",
                bracketPairColorization: {
                    enabled: true
                },
                guides: {
                    indentation: false,  // Disable garis indent vertical
                    bracketPairs: false  // Disable garis bracket pairs
                },
                rulers: [],  // Disable ruler lines
                renderIndentGuides: false  // Extra ensure indent guides disabled
            });
            
            // Initialize Emmet if available
            if (typeof emmetMonaco !== 'undefined') {
                emmetMonaco.emmetHTML(monaco, ['html']);
            }
            
            // Real-time sync and preview update
            let updateTimeout;
            htmlEditor.onDidChangeModelContent(() => {
                const currentValue = htmlEditor.getValue();
                htmlTextarea.value = currentValue;
                
                // Update hidden form field
                const hiddenField = document.getElementById('hidden_html_code');
                if (hiddenField) {
                    hiddenField.value = currentValue;
                }
                
                // Real-time preview update only in fullscreen mode
                clearTimeout(updateTimeout);
                updateTimeout = setTimeout(() => {
                    if (isPreviewVisible && isFullscreenMode) {
                        loadPreview();
                        showLiveUpdateIndicator();
                    }
                }, 300);
            });
        }
        
        // Dispatch event to let parent know editor is ready
        window.dispatchEvent(new CustomEvent('monaco-editor-ready', {
            detail: { 
                htmlEditor: htmlEditor
            }
        }));
    });
    
    // Fullscreen toggle from within code editor
    document.getElementById('toggle-fullscreen').addEventListener('click', function() {
        isFullscreenMode = !isFullscreenMode;
        
        const mainContainer = document.getElementById('main-container');
        const splitContainer = document.getElementById('split-container');
        const fullscreenText = document.getElementById('fullscreen-text');
        const toggleBtn = document.getElementById('toggle-fullscreen');
        const previewBtn = document.getElementById('toggle-preview');
        
        if (isFullscreenMode) {
            // Enter fullscreen mode with zoom animation
            mainContainer.classList.add('fullscreen-mode');
            document.body.classList.add('fullscreen-active'); // Hide page scrollbar
            fullscreenText.textContent = 'Exit Fullscreen';
            
            // Update icon to exit fullscreen
            const icon = toggleBtn.querySelector('svg');
            icon.innerHTML = `<path d="M12.1181 8.87832C12.1175 9.01033 12.1431 9.14114 12.1934 9.26321C12.2437 9.38528 12.3176 9.49618 12.411 9.58953C12.5043 9.68287 12.6152 9.75681 12.7373 9.80708C12.8594 9.85735 12.9902 9.88295 13.1222 9.88241L20.1932 9.88241C20.4595 9.88241 20.7149 9.77662 20.9032 9.58832C21.0915 9.40002 21.1973 9.14462 21.1973 8.87832C21.1973 8.61202 21.0915 8.35662 20.9032 8.16832C20.7149 7.98002 20.4595 7.87423 20.1932 7.87423L14.1192 7.8813L14.1263 1.80725C14.1263 1.54095 14.0205 1.28556 13.8322 1.09725C13.6439 0.90895 13.3885 0.803162 13.1222 0.803162C12.8559 0.803162 12.6005 0.90895 12.4122 1.09725C12.2239 1.28556 12.1181 1.54095 12.1181 1.80725V8.87832ZM9.88362 13.121C9.88417 12.989 9.85856 12.8581 9.8083 12.7361C9.75803 12.614 9.68409 12.5031 9.59074 12.4098C9.49739 12.3164 9.38649 12.2425 9.26442 12.1922C9.14236 12.1419 9.01154 12.1163 8.87953 12.1169H1.80847C1.54216 12.1169 1.28677 12.2227 1.09847 12.411C0.910162 12.5993 0.804375 12.8547 0.804375 13.121C0.804375 13.3873 0.910162 13.6427 1.09847 13.831C1.28677 14.0193 1.54216 14.1251 1.80847 14.1251L7.88251 14.118L7.87544 20.192C7.8749 20.324 7.9005 20.4549 7.95077 20.5769C8.00104 20.699 8.07498 20.8099 8.16833 20.9032C8.26167 20.9966 8.37258 21.0705 8.49464 21.1208C8.61671 21.1711 8.74752 21.1967 8.87953 21.1961C9.01154 21.1967 9.14236 21.1711 9.26442 21.1208C9.38649 21.0705 9.49739 20.9966 9.59074 20.9032C9.68409 20.8099 9.75803 20.699 9.8083 20.5769C9.85856 20.4549 9.88416 20.324 9.88362 20.192L9.88362 13.121Z" fill="currentColor"/>`;
            
            // Show preview button in fullscreen mode
            previewBtn.classList.remove('hidden');
            previewBtn.classList.add('inline-flex');
            
        } else {
            // Hide preview when exiting fullscreen (do this first)
            if (isPreviewVisible) {
                isPreviewVisible = false;
                togglePreview();
            }
            
            // Hide preview button in split mode
            previewBtn.classList.add('hidden');
            previewBtn.classList.remove('inline-flex');
            
            // Exit fullscreen mode with zoom animation
            mainContainer.classList.add('exit-fullscreen');
            mainContainer.classList.remove('fullscreen-mode');
            document.body.classList.remove('fullscreen-active'); // Restore page scrollbar
            fullscreenText.textContent = 'Fullscreen';
            
            // Update icon to enter fullscreen
            const icon = toggleBtn.querySelector('svg');
            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />`;
            
            // Remove animation class after animation completes
            setTimeout(() => {
                mainContainer.classList.remove('exit-fullscreen');
            }, 400);
        }
        
        // Layout editor after transition
        setTimeout(() => {
            if (htmlEditor) htmlEditor.layout();
        }, 450);
    });
    
    // Listen for fullscreen mode changes from parent (keep for compatibility)
    window.addEventListener('fullscreen-mode-changed', function(event) {
        // This event is no longer used but kept for compatibility
        isFullscreenMode = event.detail.isFullscreen;
    });
    
    // Preview toggle
    document.getElementById('toggle-preview').addEventListener('click', function() {
        isPreviewVisible = !isPreviewVisible;
        togglePreview();
    });
    
    function togglePreview() {
        const previewPanel = document.getElementById('preview-panel');
        const splitter = document.getElementById('splitter');
        const editorPanel = document.getElementById('editor-panel');
        const toggleText = document.getElementById('preview-toggle-text');
        
        if (isPreviewVisible) {
            previewPanel.classList.remove('hidden');
            if (splitter) splitter.classList.remove('hidden');
            editorPanel.classList.remove('flex-1');
            editorPanel.classList.add('w-1/2');
            toggleText.textContent = 'Hide Preview';
            loadPreview();
            showPermanentLiveIndicator();
        } else {
            previewPanel.classList.add('hidden');
            if (splitter) splitter.classList.add('hidden');
            editorPanel.classList.remove('w-1/2');
            editorPanel.classList.add('flex-1');
            toggleText.textContent = 'Show Preview';
            hidePermanentLiveIndicator();
        }
        
        // Layout editor after panel change
        setTimeout(() => {
            if (htmlEditor) htmlEditor.layout();
        }, 100);
    }
    
    // Load preview function
    function loadPreview() {
        const previewFrame = document.getElementById('preview-frame');
        if (!previewFrame) return;
        
        const htmlCode = htmlEditor ? htmlEditor.getValue() : document.getElementById('html-code').value;
        const cssCode = {!! json_encode($component->css_code ?? '') !!};
        const jsCode = {!! json_encode($component->js_code ?? '') !!};
        
        if (!htmlCode || !htmlCode.trim()) {
            previewFrame.srcdoc = `<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { 
            font-family: system-ui, sans-serif; 
            margin: 0;
            text-align: center; 
            color: #6b7280; 
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 200px;
        }
    </style>
</head>
<body>
    <div>📄</div>
    <h3 style="margin: 16px 0 8px 0;">No HTML code available</h3>
    <p style="margin: 0;">Add HTML code to see the preview</p>
</body>
</html>`;
            return;
        }

        const iframeHTML = `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Preview</title>
    <script src="https://cdn.tailwindcss.com"><\/script>
    <style>
        * { box-sizing: border-box; }
        body { 
            margin: 0; 
            font-family: system-ui, -apple-system, sans-serif; 
            line-height: 1.5; 
            background: white;
        }
        a { pointer-events: none !important; cursor: default !important; }
        button { pointer-events: none !important; cursor: default !important; }
        input, textarea, select { pointer-events: none !important; cursor: default !important; }
        form { pointer-events: none !important; }
        ${cssCode || ''}
    </style>
</head>
<body>
${htmlCode}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('a, button, form').forEach(el => {
            el.addEventListener('click', e => e.preventDefault());
            el.addEventListener('submit', e => e.preventDefault());
        });
        
        try {
            ${jsCode || ''}
        } catch (error) {
            console.warn('Component JS error:', error);
        }
    });
<\/script>
</body>
</html>`;

        previewFrame.srcdoc = iframeHTML;
    }
    
    // Live indicator functions
    function showLiveUpdateIndicator() {
        const liveIndicator = document.getElementById('live-indicator');
        if (liveIndicator) {
            liveIndicator.classList.remove('opacity-0');
            liveIndicator.classList.add('opacity-100');
            
            setTimeout(() => {
                liveIndicator.classList.remove('opacity-100');
                liveIndicator.classList.add('opacity-0');
            }, 1500);
        }
    }
    
    function showPermanentLiveIndicator() {
        const liveIndicator = document.getElementById('live-indicator');
        if (liveIndicator) {
            liveIndicator.classList.remove('opacity-0');
            liveIndicator.classList.add('opacity-100');
        }
    }
    
    function hidePermanentLiveIndicator() {
        const liveIndicator = document.getElementById('live-indicator');
        if (liveIndicator) {
            liveIndicator.classList.remove('opacity-100');
            liveIndicator.classList.add('opacity-0');
        }
    }
    
    // Device view modes
    function applyViewMode(mode) {
        const viewButtons = document.querySelectorAll('#mobile-view, #tablet-view, #desktop-view');
        
        viewButtons.forEach(btn => {
            btn.classList.remove('bg-white', 'shadow-sm');
        });
        
        const activeBtn = document.getElementById(`${mode}-view`);
        if (activeBtn) {
            activeBtn.classList.add('bg-white', 'shadow-sm');
        }
        
        const resizablePreview = document.getElementById('resizable-preview');
        if (resizablePreview) {
            let width = '100%';
            switch(mode) {
                case 'mobile':
                    width = '375px';
                    break;
                case 'tablet':
                    width = '768px';
                    break;
                case 'desktop':
                default:
                    width = '100%';
                    break;
            }
            resizablePreview.style.width = width;
        }
        
        currentViewMode = mode;
    }

    // Event listeners
    document.getElementById('mobile-view').addEventListener('click', () => applyViewMode('mobile'));
    document.getElementById('tablet-view').addEventListener('click', () => applyViewMode('tablet'));
    document.getElementById('desktop-view').addEventListener('click', () => applyViewMode('desktop'));
    document.getElementById('refresh-preview').addEventListener('click', loadPreview);
    
    // Fullscreen preview
    document.getElementById('fullscreen-preview').addEventListener('click', function() {
        const htmlCode = htmlEditor ? htmlEditor.getValue() : '';
        const cssCode = {!! json_encode($component->css_code ?? '') !!};
        const jsCode = {!! json_encode($component->js_code ?? '') !!};
        
        const previewWindow = window.open('', '_blank', 'width=1200,height=800');
        const fullscreenContent = `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Component Preview - Fullscreen</title>
    <script src="https://cdn.tailwindcss.com"><\/script>
    <style>
        body { margin: 0; font-family: system-ui, -apple-system, sans-serif; }
        ${cssCode}
    </style>
</head>
<body>
    ${htmlCode}
    <script>
        try {
            ${jsCode}
        } catch (error) {
            console.error('JavaScript error:', error);
        }
    <\/script>
</body>
</html>`;
        
        previewWindow.document.write(fullscreenContent);
    });
    
    // Format code
    document.getElementById('format-code-btn').addEventListener('click', function() {
        if (htmlEditor && typeof html_beautify !== 'undefined') {
            const currentCode = htmlEditor.getValue();
            const formattedCode = html_beautify(currentCode, {
                indent_size: 2,
                indent_char: ' ',
                max_preserve_newlines: 2,
                preserve_newlines: true,
                indent_inner_html: true,
                wrap_line_length: 120
            });
            
            htmlEditor.setValue(formattedCode);
            
            // Show feedback
            const button = document.getElementById('format-code-btn');
            if (button) {
                const originalText = button.innerHTML;
                button.innerHTML = '<svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Formatted!';
                button.classList.remove('bg-white', 'hover:bg-gray-50', 'text-gray-700');
                button.classList.add('bg-green-50', 'text-green-700');
                
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.classList.remove('bg-green-50', 'text-green-700');
                    button.classList.add('bg-white', 'hover:bg-gray-50', 'text-gray-700');
                }, 2000);
            }
        }
    });
    
    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey || e.metaKey) {
            switch(e.key) {
                case 'Enter':
                    e.preventDefault();
                    document.getElementById('toggle-fullscreen').click();
                    break;
                case 'p':
                    if (e.shiftKey) {
                        e.preventDefault();
                        document.getElementById('toggle-preview').click();
                    }
                    break;
                case 'r':
                    if (isPreviewVisible) {
                        e.preventDefault();
                        loadPreview();
                        showLiveUpdateIndicator();
                    }
                    break;
                case 't':
                    e.preventDefault();
                    document.getElementById('theme-toggle').click();
                    break;
            }
        }
        
        // F11 for fullscreen toggle
        if (e.key === 'F11') {
            e.preventDefault();
            document.getElementById('toggle-fullscreen').click();
        }
        
        // ESC to exit fullscreen
        if (e.key === 'Escape' && isFullscreenMode) {
            e.preventDefault();
            document.getElementById('toggle-fullscreen').click();
        }
    });
});
</script>
