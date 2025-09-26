@push('styles')
<style>
#monaco-editor {
    height: 450px;
    overflow: hidden;
}

.monaco-editor-container {
    position: relative;
    background: #ffffff;
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
}

.preview-toolbar {
    user-select: none;
}

.preview-content {
    position: relative;
    overflow: visible;
    min-height: 100px;
}

/* Iframe styling */
#preview-frame {
    border: none;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    width: 100%;
    height: auto;
    min-height: 300px;
    transition: height 0.1s ease-out;
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

/* Error state */
.preview-error {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 200px;
    color: #ef4444;
    background: #fef2f2;
    border: 1px dashed #fca5a5;
    border-radius: 6px;
    margin: 16px;
}

.preview-error svg {
    width: 48px;
    height: 48px;
    margin-bottom: 12px;
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
#preview-frame {
    transition: opacity 0.2s ease-in-out;
}

.preview-updating #preview-frame {
    opacity: 0.8;
}

/* Code editor live indicator */
.monaco-editor-live::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, #3b82f6, #10b981);
    z-index: 1000;
    animation: live-pulse 2s ease-in-out infinite;
}

/* Smooth width transitions for preview container */
#resizable-preview {
    transition: width 0.1s ease-out;
    will-change: width;
    transform: translateZ(0); /* Force hardware acceleration */
    backface-visibility: hidden;
}

/* Disable transitions during drag for better performance */
#resizable-preview.dragging {
    transition: none !important;
    will-change: width;
}

/* Prevent text selection during resize */
body.resizing {
    user-select: none !important;
    cursor: col-resize !important;
}

body.resizing * {
    user-select: none !important;
}

/* Optimize iframe during resize */
body.resizing #preview-frame {
    pointer-events: none;
    will-change: auto;
}
</style>
@endpush

@push('scripts')
<script>
// Preload critical resources with caching
const cdnCache = new Map();
const loadWithCache = (url) => {
    if (cdnCache.has(url)) {
        return Promise.resolve();
    }
    return new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.src = url;
        script.onload = () => {
            cdnCache.set(url, true);
            resolve();
        };
        script.onerror = reject;
        document.head.appendChild(script);
    });
};

// Load Monaco editor asynchronously with faster CDN
loadWithCache('https://cdn.jsdelivr.net/npm/monaco-editor@0.44.0/min/vs/loader.min.js');
loadWithCache('https://cdn.jsdelivr.net/npm/js-beautify@1.14.9/js/lib/beautify-html.min.js');
</script>
@endpush

<!-- Code Container -->
<div id="code-container">
    <!-- Header -->
    <div class="py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <h3 class="text-lg font-bold text-gray-900">Code</h3>
            </div>
            
            <!-- Code Actions -->
            <div class="flex items-center space-x-3">
                <!-- Toggle Switch -->
                <div class="flex items-center bg-gray-100 rounded-full p-1">
                    <button id="code-view" type="button"
                            class="px-4 py-1 text-sm font-medium rounded-full transition-all duration-200 toggle-active">
                        Code
                    </button>
                    <button id="preview-view" type="button"
                            class="px-4 py-1 text-sm font-medium rounded-full transition-all duration-200 text-gray-600 hover:text-gray-900">
                        Preview
                    </button>
                </div>

                @if(isset($isEditable) && $isEditable)
                <button id="format-code-btn" type="button" onclick="formatCode()" 
                        class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <svg class="h-[18px] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    Format
                </button>
                @endif
                <button id="copy-code-btn" type="button" onclick="copyCode('html-code')" 
                        class="inline-flex items-center w-[36px] aspect-square flex justify-center items-center rounded-full text-sm font-medium text-white bg-[#128AEB] hover:bg-[#0f75c6]">
                    <svg class="h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Code Content -->
    <div class="flex flex-col rounded-2xl overflow-hidden border border-neutral-300">
        <div class="monaco-editor-container">
            <textarea id="html-code" class="hidden">{!! $component->html_code !!}</textarea>
            <div id="monaco-editor" class="min-h-[400px] max-h-[600px] overflow-auto"></div>
        </div>
    </div>
</div>

<!-- Preview Container -->
<div id="preview-container" style="display: none;">
    <!-- Header -->
    <div class="py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <h3 class="text-lg font-bold text-gray-900 flex items-center">
                    Preview
                </h3>
            </div>
            
            <!-- Preview Controls -->
            <div class="flex items-center space-x-3">
                <!-- Toggle Switch -->
                <div class="flex items-center bg-gray-100 rounded-full p-1">
                    <button id="code-view-2" type="button"
                            class="px-4 py-1 text-sm font-medium rounded-full transition-all duration-200 text-gray-600 hover:text-gray-900">
                        Code
                    </button>
                    <button id="preview-view-2" type="button"
                            class="px-4 py-1 text-sm font-medium rounded-full transition-all duration-200 toggle-active">
                        Preview
                    </button>
                </div>

                <!-- View Mode Toggles -->
                <div class="flex items-center space-x-1 bg-gray-100 rounded-lg p-1 hidden">
                    <button id="mobile-view" type="button" 
                            class="px-3 py-1 text-xs font-medium rounded-md transition-colors duration-200 text-gray-600 hover:text-gray-900">
                        Mobile
                    </button>
                    <button id="tablet-view" type="button" 
                            class="px-3 py-1 text-xs font-medium rounded-md transition-colors duration-200 text-gray-600 hover:text-gray-900">
                        Tablet
                    </button>
                    <button id="desktop-view" type="button" 
                            class="px-3 py-1 text-xs font-medium rounded-md transition-colors duration-200 text-gray-600 hover:text-gray-900 bg-white shadow-sm">
                        Desktop
                    </button>
                </div>
                
                <!-- Refresh Button -->
                <button id="refresh-preview" type="button" 
                        class="inline-flex items-center w-[36px] aspect-square flex justify-center items-center rounded-full text-sm font-medium text-white bg-[#128AEB] hover:bg-[#0f75c6]">
                    <svg class="h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Preview Content -->
    <div class="flex">
        <div id="resizable-preview" class="flex flex-col rounded-2xl overflow-hidden border border-neutral-300" style="min-width: 375px; max-width: 100%; width: 100%;">
            <div class="preview-content">
                <iframe id="preview-frame" 
                        class="w-full border-0 overflow-hidden" 
                        style="height: auto; min-height: 300px;"
                        sandbox="allow-scripts allow-same-origin"
                        scrolling="no"
                        srcdoc="">
                </iframe>
            </div>
        </div>
        <div id="resize-handle" class="flex items-center justify-center w-[14px] cursor-col-resize" title="Drag to resize preview">
            <div class="flex flex-col space-y-1">
                <div class="w-[6px] h-[32px] rounded-full bg-neutral-400"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let editor;
    let currentViewMode = 'desktop';
    let currentMode = 'code';

    // Initialize Monaco Editor with improved loading
    @if($component->html_code)
    // Use faster CDN and lazy load Monaco editor
    const initializeEditor = () => {
        require.config({ 
            paths: { 
                'vs': 'https://cdn.jsdelivr.net/npm/monaco-editor@0.44.0/min/vs'
            },
            waitSeconds: 30 // Increase timeout for slower connections
        });
        
        require(['vs/editor/editor.main'], function() {
            const htmlTextarea = document.getElementById('html-code');
            const editorContainer = document.getElementById('monaco-editor');
            
            if (htmlTextarea && editorContainer) {
                // Get raw HTML code
                let rawCode = htmlTextarea.value;
                
                // Check if we're in edit mode (look for hidden form fields)
                const isEditable = document.getElementById('hidden_html_code') !== null;
                
                // Optimized editor configuration for faster loading
                editor = monaco.editor.create(editorContainer, {
                    value: rawCode,
                    language: 'html',
                    theme: 'vs',
                    readOnly: !isEditable,
                    automaticLayout: true,
                    minimap: {
                        enabled: false // Disable minimap for faster loading
                    },
                    scrollBeyondLastLine: false,
                    fontSize: 14,
                    lineNumbers: 'on',
                    wordWrap: 'off',
                    lineHeight: 20,
                    tabSize: 2,
                    insertSpaces: true,
                    formatOnType: false, // Disable for better performance
                    formatOnPaste: false, // Disable for better performance
                    renderWhitespace: 'none', // Improve performance
                    renderIndentGuides: false, // Improve performance
                    folding: false, // Disable for faster rendering
                    glyphMargin: false, // Disable for faster rendering
                    lightbulb: { enabled: false }, // Disable for faster rendering
                    quickSuggestions: false, // Disable for faster typing
                    parameterHints: { enabled: false }, // Disable for faster typing
                    suggestOnTriggerCharacters: false, // Disable for faster typing
                    acceptSuggestionOnEnter: 'off', // Disable for faster typing
                    hover: { enabled: false }, // Disable for faster rendering
                    links: false, // Disable for faster rendering
                    colorDecorators: false, // Disable for faster rendering
                    codeLens: false, // Disable for faster rendering
                    contextmenu: false, // Disable for faster rendering
                    mouseWheelZoom: false // Disable for better performance
                });
                
                // If editable, sync changes back to textarea and form
                if (isEditable) {
                    let updateTimeout;
                    
                    editor.onDidChangeModelContent(() => {
                        const currentValue = editor.getValue();
                        htmlTextarea.value = currentValue;
                        
                        // Update hidden form field if it exists
                        const hiddenField = document.getElementById('hidden_html_code');
                        if (hiddenField) {
                            hiddenField.value = currentValue;
                        }
                        
                        // Real-time preview update with optimized debouncing
                        clearTimeout(updateTimeout);
                        updateTimeout = setTimeout(() => {
                            if (currentMode === 'preview') {
                                // Add updating class for visual feedback
                                const previewContainer = document.getElementById('preview-container');
                                if (previewContainer) {
                                    previewContainer.classList.add('preview-updating');
                                }
                                
                                loadPreviewOptimized();
                                
                                // Show live update indicator
                                showLiveUpdateIndicator();
                                
                                // Remove updating class after a brief moment
                                setTimeout(() => {
                                    if (previewContainer) {
                                        previewContainer.classList.remove('preview-updating');
                                    }
                                }, 200); // Reduced time
                            }
                        }, 200); // Reduced debounce time for faster updates
                    });
                    
                    // Also update preview when switching to preview mode
                    window.addEventListener('preview-mode-activated', () => {
                        setTimeout(loadPreviewOptimized, 50); // Reduced delay
                    });
                }
                
                // Dispatch event to let parent know editor is ready
                window.dispatchEvent(new CustomEvent('monaco-editor-ready', {
                    detail: { editor: editor }
                }));
            }
        });
    };
    
    // Check if Monaco is already loaded, if not initialize
    if (typeof require !== 'undefined') {
        initializeEditor();
    } else {
        // Wait for Monaco to load
        const checkMonaco = setInterval(() => {
            if (typeof require !== 'undefined') {
                clearInterval(checkMonaco);
                initializeEditor();
            }
        }, 100);
        
        // Timeout after 10 seconds
        setTimeout(() => {
            clearInterval(checkMonaco);
            console.warn('Monaco editor failed to load');
        }, 10000);
    }
    @endif

    // Toggle between Code and Preview
    function switchMode(mode) {
        const codeContainer = document.getElementById('code-container');
        const previewContainer = document.getElementById('preview-container');

        if (mode === 'code') {
            codeContainer.style.display = 'block';
            previewContainer.style.display = 'none';
            
            // Update toggle buttons
            updateToggleButtons('code');
            
            // Hide live indicator
            hidePermanentLiveIndicator();
            
            if (editor) {
                setTimeout(() => {
                    editor.layout();
                }, 100);
            }
        } else {
            codeContainer.style.display = 'none';
            previewContainer.style.display = 'block';
            
            // Update toggle buttons
            updateToggleButtons('preview');
            
            // Load preview and dispatch event
            loadPreview();
            window.dispatchEvent(new CustomEvent('preview-mode-activated'));
            
            // Show permanent live indicator if in edit mode
            setTimeout(showPermanentLiveIndicator, 100);
        }
        
        currentMode = mode;
    }

    // Show live update indicator
    function showLiveUpdateIndicator() {
        const liveIndicator = document.getElementById('live-indicator');
        if (liveIndicator) {
            // Show indicator
            liveIndicator.classList.remove('opacity-0');
            liveIndicator.classList.add('opacity-100');
            
            // Hide after 1.5 seconds
            setTimeout(() => {
                liveIndicator.classList.remove('opacity-100');
                liveIndicator.classList.add('opacity-0');
            }, 1500);
        }
    }

    // Show permanent live indicator when in edit mode and preview is active
    function showPermanentLiveIndicator() {
        const liveIndicator = document.getElementById('live-indicator');
        const isEditable = document.getElementById('hidden_html_code') !== null;
        
        if (liveIndicator && isEditable && currentMode === 'preview') {
            liveIndicator.classList.remove('opacity-0');
            liveIndicator.classList.add('opacity-100');
            liveIndicator.querySelector('span').textContent = 'Live Editing';
        }
    }

    // Hide permanent live indicator
    function hidePermanentLiveIndicator() {
        const liveIndicator = document.getElementById('live-indicator');
        if (liveIndicator) {
            liveIndicator.classList.remove('opacity-100');
            liveIndicator.classList.add('opacity-0');
        }
    }

    function updateToggleButtons(activeMode) {
        const codeButtons = [
            document.getElementById('code-view'),
            document.getElementById('code-view-2')
        ];
        const previewButtons = [
            document.getElementById('preview-view'),
            document.getElementById('preview-view-2')
        ];

        codeButtons.forEach(btn => {
            if (btn) {
                if (activeMode === 'code') {
                    btn.classList.add('toggle-active');
                    btn.classList.remove('text-gray-600', 'hover:text-gray-900');
                } else {
                    btn.classList.remove('toggle-active');
                    btn.classList.add('text-gray-600', 'hover:text-gray-900');
                }
            }
        });

        previewButtons.forEach(btn => {
            if (btn) {
                if (activeMode === 'preview') {
                    btn.classList.add('toggle-active');
                    btn.classList.remove('text-gray-600', 'hover:text-gray-900');
                } else {
                    btn.classList.remove('toggle-active');
                    btn.classList.add('text-gray-600', 'hover:text-gray-900');
                }
            }
        });
    }

    function loadPreview() {
        const htmlCode = {!! json_encode($component->html_code ?? '') !!};
        const cssCode = {!! json_encode($component->css_code ?? '') !!};
        const jsCode = {!! json_encode($component->js_code ?? '') !!};
        const previewFrame = document.getElementById('preview-frame');
        
        if (!previewFrame) return;
        
        // Get current code from editor if available, otherwise use original
        let currentHtmlCode = htmlCode;
        if (editor && editor.getValue) {
            currentHtmlCode = editor.getValue();
        }
        
        if (!currentHtmlCode || !currentHtmlCode.trim()) {
            previewFrame.srcdoc = `<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
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
    <!-- Tailwind v4 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"><\/script>

    <!-- Google Fonts (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind Config -->
    <script type="tailwind-config">
    {
        theme: {
        extend: {
            fontFamily: {
            sans: ["Inter", "ui-sans-serif", "system-ui", "-apple-system", "BlinkMacSystemFont", "Segoe UI", "Roboto", "sans-serif"]
            }
        }
        }
    }
    <\/script>
    <style>
        * {
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        body {
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        ${cssCode || ''}
    </style>
</head>
<body class="font-sans">
${currentHtmlCode}
<script>
    function sendHeight() {
        const height = document.body.scrollHeight;
        window.parent.postMessage({
            type: 'resize',
            height: height
        }, '*');
    }
    
    sendHeight();
    window.onload = sendHeight;
    window.onresize = sendHeight;
    
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
        
        sendHeight();
        
        if (window.ResizeObserver) {
            const resizeObserver = new ResizeObserver(sendHeight);
            resizeObserver.observe(document.body);
        } else {
            setInterval(sendHeight, 200);
        }
        
        window.addEventListener('message', function(event) {
            if (event.data.type === 'recalculate-height') {
                sendHeight();
            }
        });
        
        let mutationTimeout;
        const mutationObserver = new MutationObserver(function() {
            clearTimeout(mutationTimeout);
            mutationTimeout = setTimeout(sendHeight, 10);
        });
        
        mutationObserver.observe(document.body, {
            childList: true,
            subtree: true,
            attributes: true,
            attributeFilter: ['style', 'class']
        });
    });
<\/script>
</body>
</html>`;

        previewFrame.style.height = '300px';
        previewFrame.srcdoc = iframeHTML;
    }
    
    function applyViewMode(mode) {
        const previewFrame = document.getElementById('preview-frame');
        const viewButtons = document.querySelectorAll('#mobile-view, #tablet-view, #desktop-view');
        
        viewButtons.forEach(btn => {
            btn.classList.remove('bg-white', 'shadow-sm');
            btn.classList.add('text-gray-600', 'hover:text-gray-900');
        });
        
        const activeBtn = document.getElementById(`${mode}-view`);
        if (activeBtn) {
            activeBtn.classList.add('bg-white', 'shadow-sm');
            activeBtn.classList.remove('text-gray-600', 'hover:text-gray-900');
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
            
            setTimeout(() => {
                if (previewFrame && previewFrame.contentWindow) {
                    previewFrame.contentWindow.postMessage({
                        type: 'recalculate-height'
                    }, '*');
                }
            }, 50);
        }
        
        currentViewMode = mode;
    }

    // Event listeners
    document.getElementById('code-view').addEventListener('click', () => switchMode('code'));
    document.getElementById('preview-view').addEventListener('click', () => switchMode('preview'));
    document.getElementById('code-view-2').addEventListener('click', () => switchMode('code'));
    document.getElementById('preview-view-2').addEventListener('click', () => switchMode('preview'));

    document.getElementById('mobile-view').addEventListener('click', () => applyViewMode('mobile'));
    document.getElementById('tablet-view').addEventListener('click', () => applyViewMode('tablet'));
    document.getElementById('desktop-view').addEventListener('click', () => applyViewMode('desktop'));
    document.getElementById('refresh-preview').addEventListener('click', loadPreview);

    // Resize functionality with improved performance
    let isResizing = false;
    let startX = 0;
    let startWidth = 0;
    let animationFrame = null;
    let lastMouseX = 0;

    const resizeHandle = document.getElementById('resize-handle');
    const resizablePreview = document.getElementById('resizable-preview');

    if (resizeHandle && resizablePreview) {
        // Add hover effect for better UX
        resizeHandle.addEventListener('mouseenter', () => {
            if (!isResizing) {
                resizeHandle.style.background = '';
            }
        });

        resizeHandle.addEventListener('mouseleave', () => {
            if (!isResizing) {
                resizeHandle.style.background = '';
            }
        });

        resizeHandle.addEventListener('mousedown', (e) => {
            isResizing = true;
            startX = e.clientX;
            lastMouseX = e.clientX;
            startWidth = parseInt(window.getComputedStyle(resizablePreview).width, 10);
            
            // Add visual feedback with classes
            document.body.classList.add('resizing');
            resizablePreview.classList.add('dragging');
            
            // Disable iframe pointer events during drag to prevent interference
            const previewFrame = document.getElementById('preview-frame');
            if (previewFrame) {
                previewFrame.style.pointerEvents = 'none';
            }
            
            e.preventDefault();
        });

        // Optimized mousemove with requestAnimationFrame
        document.addEventListener('mousemove', (e) => {
            if (!isResizing) return;
            
            lastMouseX = e.clientX;
            
            // Cancel previous frame if still pending
            if (animationFrame) {
                cancelAnimationFrame(animationFrame);
            }
            
            // Use requestAnimationFrame for smooth updates
            animationFrame = requestAnimationFrame(() => {
                const dx = lastMouseX - startX;
                const newWidth = startWidth + dx;
                
                const minWidth = 375;
                const maxWidth = window.innerWidth - 100;
                
                // Clamp the width to min/max bounds
                const clampedWidth = Math.max(minWidth, Math.min(maxWidth, newWidth));
                
                // Only update if width actually changed
                if (parseInt(resizablePreview.style.width, 10) !== clampedWidth) {
                    resizablePreview.style.width = clampedWidth + 'px';
                }
                
                animationFrame = null;
            });
        });

        document.addEventListener('mouseup', () => {
            if (isResizing) {
                isResizing = false;
                
                // Cancel any pending animation frame
                if (animationFrame) {
                    cancelAnimationFrame(animationFrame);
                    animationFrame = null;
                }
                
                // Reset visual feedback with classes
                document.body.classList.remove('resizing');
                resizablePreview.classList.remove('dragging');
                resizeHandle.style.background = '';
                
                // Re-enable iframe pointer events
                const previewFrame = document.getElementById('preview-frame');
                if (previewFrame) {
                    previewFrame.style.pointerEvents = '';
                }
                
                // Recalculate height after resize is complete
                setTimeout(() => {
                    if (previewFrame && previewFrame.contentWindow) {
                        previewFrame.contentWindow.postMessage({
                            type: 'recalculate-height'
                        }, '*');
                    }
                }, 100); // Increased delay for better performance
            }
        });

        // Handle mouse leave to prevent stuck state
        document.addEventListener('mouseleave', () => {
            if (isResizing) {
                document.dispatchEvent(new MouseEvent('mouseup'));
            }
        });
    }

    // Initialize with code view
    switchMode('code');
    
    // Keyboard shortcuts for better UX
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + Shift + P for preview toggle
        if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.key === 'P') {
            e.preventDefault();
            const newMode = currentMode === 'code' ? 'preview' : 'code';
            switchMode(newMode);
        }
        
        // Ctrl/Cmd + R for refresh preview (only in preview mode)
        if ((e.ctrlKey || e.metaKey) && e.key === 'r' && currentMode === 'preview') {
            e.preventDefault();
            loadPreview();
            showLiveUpdateIndicator();
        }
    });
    
    // Add tooltip for keyboard shortcuts
    const previewButtons = document.querySelectorAll('#preview-view, #preview-view-2');
    previewButtons.forEach(btn => {
        btn.title = 'Switch to Preview (Ctrl+Shift+P)';
    });
    
    const codeButtons = document.querySelectorAll('#code-view, #code-view-2');
    codeButtons.forEach(btn => {
        btn.title = 'Switch to Code (Ctrl+Shift+P)';
    });
    
    // Add refresh tooltip
    const refreshBtn = document.getElementById('refresh-preview');
    if (refreshBtn) {
        refreshBtn.title = 'Refresh Preview (Ctrl+R)';
    }
});

// Copy code functionality
function copyCode(elementId) {
    const textarea = document.getElementById(elementId);
    if (textarea) {
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(textarea.value).then(() => {
                showCopyFeedback();
            }).catch(() => {
                legacyCopyCode(textarea.value);
            });
        } else {
            legacyCopyCode(textarea.value);
        }
    }
}

// Format code functionality
function formatCode() {
    if (editor && typeof html_beautify !== 'undefined') {
        const currentCode = editor.getValue();
        const formattedCode = html_beautify(currentCode, {
            indent_size: 2,
            indent_char: ' ',
            max_preserve_newlines: 2,
            preserve_newlines: true,
            keep_array_indentation: false,
            break_chained_methods: false,
            indent_scripts: 'normal',
            brace_style: 'collapse',
            space_before_conditional: true,
            unescape_strings: false,
            jslint_happy: false,
            end_with_newline: true,
            wrap_line_length: 120,
            indent_inner_html: true,
            comma_first: false,
            e4x: false,
            indent_empty_lines: false
        });
        
        editor.setValue(formattedCode);
        
        // Update hidden textarea
        const textarea = document.getElementById('html-code');
        if (textarea) {
            textarea.value = formattedCode;
        }
        
        // Show feedback
        const button = document.getElementById('format-code-btn');
        if (button) {
            const originalText = button.innerHTML;
            button.innerHTML = '<svg class="h-[18px] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Formatted!';
            button.classList.remove('bg-white', 'hover:bg-gray-50', 'text-gray-700');
            button.classList.add('bg-green-50', 'text-green-700');
            
            setTimeout(() => {
                button.innerHTML = originalText;
                button.classList.remove('bg-green-50', 'text-green-700');
                button.classList.add('bg-white', 'hover:bg-gray-50', 'text-gray-700');
            }, 2000);
        }
    }
}

function legacyCopyCode(text) {
    const tempTextarea = document.createElement('textarea');
    tempTextarea.value = text;
    document.body.appendChild(tempTextarea);
    tempTextarea.select();
    try {
        document.execCommand('copy');
        showCopyFeedback();
    } catch (err) {
        console.error('Copy failed:', err);
    }
    document.body.removeChild(tempTextarea);
}

function showCopyFeedback() {
    const button = event.target.closest('button');
    if (!button) return;
    
    const originalText = button.innerHTML;
    button.innerHTML = '<svg class="h-[18px] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Copied!';
    button.classList.remove('bg-white', 'hover:bg-gray-50', 'text-gray-700');
    button.classList.add('bg-green-50', 'text-green-700');
    
    setTimeout(() => {
        button.innerHTML = originalText;
        button.classList.remove('bg-green-50', 'text-green-700');
        button.classList.add('bg-white', 'hover:bg-gray-50', 'text-gray-700');
    }, 2000);
}

// Listen for iframe resize messages with throttling
let resizeTimeout;
let lastResizeTime = 0;
const RESIZE_THROTTLE = 16; // ~60fps

window.addEventListener('message', function(event) {
    if (event.data.type === 'resize') {
        const now = Date.now();
        const timeSinceLastResize = now - lastResizeTime;
        
        // Throttle resize messages to prevent excessive updates
        if (timeSinceLastResize >= RESIZE_THROTTLE) {
            updatePreviewHeight(event.data.height);
            lastResizeTime = now;
        } else {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                updatePreviewHeight(event.data.height);
                lastResizeTime = Date.now();
            }, RESIZE_THROTTLE - timeSinceLastResize);
        }
    }
});

function updatePreviewHeight(height) {
    const previewFrame = document.getElementById('preview-frame');
    if (previewFrame) {
        const newHeight = Math.max(height, 300);
        if (parseInt(previewFrame.style.height, 10) !== newHeight) {
            previewFrame.style.height = newHeight + 'px';
        }
    }
}
</script>
