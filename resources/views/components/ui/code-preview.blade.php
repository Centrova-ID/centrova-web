@props([
    'htmlCode' => '',
    'cssCode' => '',
    'jsCode' => '',
    'title' => 'Component',
    'showToggle' => true,
    'defaultMode' => 'code', // 'code' or 'preview'
    'editorId' => '',
    'containerId' => '',
    'showCopyButton' => true,
    'showViewModes' => true,
    'showRefresh' => true,
    'minHeight' => '300px',
    'maxHeight' => '600px',
    'enableResize' => true
])

@php
    // Generate unique IDs if not provided
    $editorId = $editorId ?: 'monaco-editor-' . uniqid();
    $containerId = $containerId ?: 'code-preview-' . uniqid();
@endphp
@endphp

@push('styles')
<style>
.code-preview-monaco-editor {
    overflow: hidden;
}

.code-preview-editor-container {
    position: relative;
    background: #ffffff;
}

/* Preview Styles */
.code-preview-container {
    position: relative;
    background: #f8f9fa;
}

.code-preview-toolbar {
    user-select: none;
}

.code-preview-content {
    position: relative;
    overflow: visible;
    min-height: 100px;
}

/* Iframe styling */
.code-preview-frame {
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

.code-preview-frame::-webkit-scrollbar {
    display: none;
}

.code-preview-content {
    overflow: hidden;
}

/* Hide scrollbars from resizable preview container */
.code-preview-resizable {
    overflow: hidden;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

.code-preview-resizable::-webkit-scrollbar {
    display: none;
}

/* Toggle button active state */
.code-preview-toggle-active {
    background-color: white !important;
    color: #111827 !important;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
}

/* Loading state for iframe */
.code-preview-loading::after {
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

.code-preview-loading::before {
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
.code-preview-error {
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

.code-preview-error svg {
    width: 48px;
    height: 48px;
    margin-bottom: 12px;
}
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.44.0/min/vs/loader.min.js"></script>
@endpush

<div class="code-preview-component" data-container-id="{{ $containerId }}" data-editor-id="{{ $editorId }}">
    <!-- Code Container -->
    <div id="{{ $containerId }}-code" class="code-preview-code-container">
        @if($showToggle)
        <!-- Header -->
        <div class="px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <h3 class="text-lg font-medium text-gray-900">{{ $title }}</h3>
                    
                    <!-- Toggle Switch -->
                    <div class="flex items-center bg-gray-100 rounded-lg p-1">
                        <button id="{{ $containerId }}-code-view" type="button"
                                class="px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 code-preview-toggle-active">
                            Code
                        </button>
                        <button id="{{ $containerId }}-preview-view" type="button"
                                class="px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 text-gray-600 hover:text-gray-900">
                            Preview
                        </button>
                    </div>
                </div>
                
                @if($showCopyButton)
                <!-- Copy Button -->
                <div class="flex items-center space-x-3">
                    <button id="{{ $containerId }}-copy-btn" type="button" onclick="codePreviewCopyCode('{{ $containerId }}-html-code')" 
                            class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        Copy Code
                    </button>
                </div>
                @endif
            </div>
        </div>
        @endif
        
        <!-- Code Content -->
        <div class="flex flex-col rounded-2xl overflow-hidden border border-neutral-300">
            <div class="code-preview-editor-container">
                <textarea id="{{ $containerId }}-html-code" class="hidden">{!! htmlspecialchars($htmlCode) !!}</textarea>
                <div id="{{ $editorId }}" class="code-preview-monaco-editor" style="min-height: {{ $minHeight }}; max-height: {{ $maxHeight }}; overflow: auto;"></div>
            </div>
        </div>
    </div>

    <!-- Preview Container -->
    <div id="{{ $containerId }}-preview" class="code-preview-preview-container" style="display: none;">
        @if($showToggle)
        <!-- Header -->
        <div class="px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <h3 class="text-lg font-medium text-gray-900">{{ $title }}</h3>
                    
                    <!-- Toggle Switch -->
                    <div class="flex items-center bg-gray-100 rounded-lg p-1">
                        <button id="{{ $containerId }}-code-view-2" type="button"
                                class="px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 text-gray-600 hover:text-gray-900">
                            Code
                        </button>
                        <button id="{{ $containerId }}-preview-view-2" type="button"
                                class="px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 code-preview-toggle-active">
                            Preview
                        </button>
                    </div>
                </div>
                
                @if($showViewModes || $showRefresh)
                <!-- Preview Controls -->
                <div class="flex items-center space-x-3">
                    @if($showViewModes)
                    <!-- View Mode Toggles -->
                    <div class="flex items-center space-x-1 bg-gray-100 rounded-lg p-1">
                        <button id="{{ $containerId }}-mobile-view" type="button" 
                                class="px-3 py-1 text-xs font-medium rounded-md transition-colors duration-200 text-gray-600 hover:text-gray-900">
                            Mobile
                        </button>
                        <button id="{{ $containerId }}-tablet-view" type="button" 
                                class="px-3 py-1 text-xs font-medium rounded-md transition-colors duration-200 text-gray-600 hover:text-gray-900">
                            Tablet
                        </button>
                        <button id="{{ $containerId }}-desktop-view" type="button" 
                                class="px-3 py-1 text-xs font-medium rounded-md transition-colors duration-200 text-gray-600 hover:text-gray-900 bg-white shadow-sm">
                            Desktop
                        </button>
                    </div>
                    @endif
                    
                    @if($showRefresh)
                    <!-- Refresh Button -->
                    <button id="{{ $containerId }}-refresh-preview" type="button" 
                            class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Refresh
                    </button>
                    @endif
                </div>
                @endif
            </div>
        </div>
        @endif
        
        <!-- Preview Content -->
        <div class="flex">
            <div id="{{ $containerId }}-resizable-preview" class="flex flex-col rounded-2xl overflow-hidden border border-neutral-300 code-preview-resizable" style="min-width: 375px; max-width: 100%; width: 100%;">
                <div class="code-preview-content">
                    <iframe id="{{ $containerId }}-preview-frame" 
                            class="w-full border-0 overflow-hidden code-preview-frame" 
                            style="height: auto; min-height: 300px;"
                            sandbox="allow-scripts allow-same-origin"
                            scrolling="no"
                            srcdoc="">
                    </iframe>
                </div>
            </div>
            @if($enableResize)
            <div id="{{ $containerId }}-resize-handle" class="flex items-center justify-center w-[14px] cursor-col-resize">
                <div class="flex flex-col space-y-1">
                    <div class="w-[6px] h-[32px] rounded-full bg-neutral-400"></div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const containerId = '{{ $containerId }}';
    const editorId = '{{ $editorId }}';
    const htmlCode = {!! json_encode($htmlCode) !!};
    const cssCode = {!! json_encode($cssCode) !!};
    const jsCode = {!! json_encode($jsCode) !!};
    const defaultMode = '{{ $defaultMode }}';
    
    // Create a namespace for this component instance
    const componentInstance = {
        editor: null,
        currentViewMode: 'desktop',
        currentMode: defaultMode,
        containerId: containerId,
        editorId: editorId
    };

    // Store instance globally for access from other functions
    window.codePreviewInstances = window.codePreviewInstances || {};
    window.codePreviewInstances[containerId] = componentInstance;

    // Initialize Monaco Editor
    if (htmlCode && htmlCode.trim()) {
        require.config({ paths: { 'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.44.0/min/vs' }});
        require(['vs/editor/editor.main'], function() {
            const htmlTextarea = document.getElementById(containerId + '-html-code');
            const editorContainer = document.getElementById(editorId);
            
            if (htmlTextarea && editorContainer) {
                componentInstance.editor = monaco.editor.create(editorContainer, {
                    value: htmlTextarea.value,
                    language: 'html',
                    theme: 'vs',
                    readOnly: true,
                    automaticLayout: true,
                    minimap: {
                        enabled: true
                    },
                    scrollBeyondLastLine: false,
                    fontSize: 14,
                    lineNumbers: 'on',
                    wordWrap: 'off',
                    lineHeight: 20
                });
            }
        });
    }

    // Toggle between Code and Preview
    function switchMode(mode) {
        const codeContainer = document.getElementById(containerId + '-code');
        const previewContainer = document.getElementById(containerId + '-preview');

        if (mode === 'code') {
            codeContainer.style.display = 'block';
            previewContainer.style.display = 'none';
            
            // Update toggle buttons
            updateToggleButtons('code');
            
            // Resize Monaco editor
            if (componentInstance.editor) {
                setTimeout(() => {
                    componentInstance.editor.layout();
                }, 100);
            }
        } else {
            codeContainer.style.display = 'none';
            previewContainer.style.display = 'block';
            
            // Update toggle buttons
            updateToggleButtons('preview');
            
            // Load preview
            loadPreview();
        }
        
        componentInstance.currentMode = mode;
    }

    // Update toggle button states
    function updateToggleButtons(activeMode) {
        const codeButtons = [
            document.getElementById(containerId + '-code-view'),
            document.getElementById(containerId + '-code-view-2')
        ];
        const previewButtons = [
            document.getElementById(containerId + '-preview-view'),
            document.getElementById(containerId + '-preview-view-2')
        ];

        codeButtons.forEach(btn => {
            if (btn) {
                if (activeMode === 'code') {
                    btn.classList.add('code-preview-toggle-active');
                    btn.classList.remove('text-gray-600', 'hover:text-gray-900');
                } else {
                    btn.classList.remove('code-preview-toggle-active');
                    btn.classList.add('text-gray-600', 'hover:text-gray-900');
                }
            }
        });

        previewButtons.forEach(btn => {
            if (btn) {
                if (activeMode === 'preview') {
                    btn.classList.add('code-preview-toggle-active');
                    btn.classList.remove('text-gray-600', 'hover:text-gray-900');
                } else {
                    btn.classList.remove('code-preview-toggle-active');
                    btn.classList.add('text-gray-600', 'hover:text-gray-900');
                }
            }
        });
    }

    // Generate and render preview content
    function loadPreview() {
        const previewFrame = document.getElementById(containerId + '-preview-frame');
        
        if (!previewFrame) {
            console.error('Preview frame not found');
            return;
        }
        
        if (!htmlCode || !htmlCode.trim()) {
            // Show empty state
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

        // Create iframe content
        const iframeHTML = `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview</title>
    <script src="https://cdn.tailwindcss.com"><\/script>
    <style>
        * { box-sizing: border-box; }
        body { 
            margin: 0; 
            font-family: system-ui, -apple-system, sans-serif; 
            line-height: 1.5; 
            background: white;
            height: auto;
            min-height: fit-content;
        }
        html {
            height: auto;
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
    // Function to send height to parent
    function sendHeight() {
        const height = document.body.scrollHeight;
        window.parent.postMessage({
            type: 'resize',
            height: height,
            containerId: '${containerId}'
        }, '*');
    }
    
    sendHeight();
    window.onload = sendHeight;
    window.onresize = sendHeight;
    
    document.addEventListener('DOMContentLoaded', function() {
        // Disable interactions
        document.querySelectorAll('a, button, form').forEach(el => {
            el.addEventListener('click', e => e.preventDefault());
            el.addEventListener('submit', e => e.preventDefault());
        });
        
        // Custom component JS
        try {
            ${jsCode || ''}
        } catch (error) {
            console.warn('Component JS error:', error);
        }
        
        sendHeight();
        
        // Use ResizeObserver to watch for content size changes
        if (window.ResizeObserver) {
            const resizeObserver = new ResizeObserver(sendHeight);
            resizeObserver.observe(document.body);
        } else {
            setInterval(sendHeight, 200);
        }
        
        // Listen for messages from parent to recalculate height
        window.addEventListener('message', function(event) {
            if (event.data.type === 'recalculate-height' && event.data.containerId === '${containerId}') {
                sendHeight();
            }
        });
        
        // Watch for DOM mutations
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

        // Reset iframe height before loading new content
        previewFrame.style.height = '300px';
        
        // Set iframe content
        previewFrame.srcdoc = iframeHTML;
    }
    
    // Apply view mode for responsive preview
    function applyViewMode(mode) {
        const previewFrame = document.getElementById(containerId + '-preview-frame');
        const viewButtons = [
            document.getElementById(containerId + '-mobile-view'),
            document.getElementById(containerId + '-tablet-view'),
            document.getElementById(containerId + '-desktop-view')
        ];
        
        // Remove active states from all buttons
        viewButtons.forEach(btn => {
            if (btn) {
                btn.classList.remove('bg-white', 'shadow-sm');
                btn.classList.add('text-gray-600', 'hover:text-gray-900');
            }
        });
        
        // Set active button
        const activeBtn = document.getElementById(containerId + '-' + mode + '-view');
        if (activeBtn) {
            activeBtn.classList.add('bg-white', 'shadow-sm');
            activeBtn.classList.remove('text-gray-600', 'hover:text-gray-900');
        }
        
        // Apply responsive width to iframe container
        const resizablePreview = document.getElementById(containerId + '-resizable-preview');
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
            
            // Request iframe to recalculate height after width change
            setTimeout(() => {
                if (previewFrame && previewFrame.contentWindow) {
                    previewFrame.contentWindow.postMessage({
                        type: 'recalculate-height',
                        containerId: containerId
                    }, '*');
                }
            }, 50);
        }
        
        componentInstance.currentViewMode = mode;
    }

    // Event listeners for toggle buttons
    const codeViewBtn = document.getElementById(containerId + '-code-view');
    const previewViewBtn = document.getElementById(containerId + '-preview-view');
    const codeViewBtn2 = document.getElementById(containerId + '-code-view-2');
    const previewViewBtn2 = document.getElementById(containerId + '-preview-view-2');

    if (codeViewBtn) codeViewBtn.addEventListener('click', () => switchMode('code'));
    if (previewViewBtn) previewViewBtn.addEventListener('click', () => switchMode('preview'));
    if (codeViewBtn2) codeViewBtn2.addEventListener('click', () => switchMode('code'));
    if (previewViewBtn2) previewViewBtn2.addEventListener('click', () => switchMode('preview'));

    // Event listeners for view mode buttons
    const mobileViewBtn = document.getElementById(containerId + '-mobile-view');
    const tabletViewBtn = document.getElementById(containerId + '-tablet-view');
    const desktopViewBtn = document.getElementById(containerId + '-desktop-view');
    const refreshBtn = document.getElementById(containerId + '-refresh-preview');

    if (mobileViewBtn) mobileViewBtn.addEventListener('click', () => applyViewMode('mobile'));
    if (tabletViewBtn) tabletViewBtn.addEventListener('click', () => applyViewMode('tablet'));
    if (desktopViewBtn) desktopViewBtn.addEventListener('click', () => applyViewMode('desktop'));
    if (refreshBtn) refreshBtn.addEventListener('click', loadPreview);

    // Resize functionality
    @if($enableResize)
    let isResizing = false;
    let startX = 0;
    let startWidth = 0;

    const resizeHandle = document.getElementById(containerId + '-resize-handle');
    const resizablePreview = document.getElementById(containerId + '-resizable-preview');

    if (resizeHandle && resizablePreview) {
        resizeHandle.addEventListener('mousedown', (e) => {
            isResizing = true;
            startX = e.clientX;
            startWidth = parseInt(window.getComputedStyle(resizablePreview).width, 10);
            
            document.body.style.cursor = 'col-resize';
            document.body.style.userSelect = 'none';
            
            e.preventDefault();
        });

        document.addEventListener('mousemove', (e) => {
            if (!isResizing) return;
            
            const dx = e.clientX - startX;
            const newWidth = startWidth + dx;
            
            const minWidth = 375;
            const maxWidth = window.innerWidth - 100;
            
            if (newWidth >= minWidth && newWidth <= maxWidth) {
                resizablePreview.style.width = newWidth + 'px';
            }
        });

        document.addEventListener('mouseup', () => {
            if (isResizing) {
                isResizing = false;
                document.body.style.cursor = '';
                document.body.style.userSelect = '';
                
                const previewFrame = document.getElementById(containerId + '-preview-frame');
                setTimeout(() => {
                    if (previewFrame && previewFrame.contentWindow) {
                        previewFrame.contentWindow.postMessage({
                            type: 'recalculate-height',
                            containerId: containerId
                        }, '*');
                    }
                }, 30);
            }
        });
    }
    @endif

    // Initialize with default mode
    switchMode(defaultMode);
});
</script>

<script>
// Global copy function
window.codePreviewCopyCode = function(elementId) {
    const textarea = document.getElementById(elementId);
    if (textarea) {
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(textarea.value).then(() => {
                showCopyFeedback(elementId);
            }).catch(() => {
                legacyCopyCode(textarea.value, elementId);
            });
        } else {
            legacyCopyCode(textarea.value, elementId);
        }
    }
}

function legacyCopyCode(text, elementId) {
    const tempTextarea = document.createElement('textarea');
    tempTextarea.value = text;
    document.body.appendChild(tempTextarea);
    tempTextarea.select();
    try {
        document.execCommand('copy');
        showCopyFeedback(elementId);
    } catch (err) {
        console.error('Copy failed:', err);
    }
    document.body.removeChild(tempTextarea);
}

function showCopyFeedback(elementId) {
    // Extract containerId from elementId
    const containerId = elementId.replace('-html-code', '');
    const button = document.getElementById(containerId + '-copy-btn');
    if (!button) return;
    
    const originalText = button.innerHTML;
    button.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Copied!';
    button.classList.remove('bg-white', 'hover:bg-gray-50', 'text-gray-700');
    button.classList.add('bg-green-50', 'text-green-700');
    
    setTimeout(() => {
        button.innerHTML = originalText;
        button.classList.remove('bg-green-50', 'text-green-700');
        button.classList.add('bg-white', 'hover:bg-gray-50', 'text-gray-700');
    }, 2000);
}

// Listen for iframe resize messages
window.addEventListener('message', function(event) {
    if (event.data.type === 'resize' && event.data.containerId) {
        const previewFrame = document.getElementById(event.data.containerId + '-preview-frame');
        if (previewFrame) {
            const newHeight = Math.max(event.data.height, 300);
            previewFrame.style.height = newHeight + 'px';
        }
    }
});
</script>
