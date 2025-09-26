@props(['htmlCode' => '', 'cssCode' => '', 'jsCode' => '', 'title' => 'Component'])

<div class="bg-white shadow-sm rounded-lg border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">{{ $title }}</h3>
    </div>
    <div class="p-6">
        @if($htmlCode)
            <div class="space-y-4">
                <!-- HTML Code -->
                <div>
                    <h4 class="text-sm font-medium text-gray-700 mb-2">HTML Code:</h4>
                    <div class="bg-gray-100 rounded-lg p-4">
                        <pre class="text-sm text-gray-800 overflow-x-auto"><code>{{ $htmlCode }}</code></pre>
                    </div>
                </div>
                
                @if($cssCode)
                <!-- CSS Code -->
                <div>
                    <h4 class="text-sm font-medium text-gray-700 mb-2">CSS Code:</h4>
                    <div class="bg-gray-100 rounded-lg p-4">
                        <pre class="text-sm text-gray-800 overflow-x-auto"><code>{{ $cssCode }}</code></pre>
                    </div>
                </div>
                @endif
                
                @if($jsCode)
                <!-- JavaScript Code -->
                <div>
                    <h4 class="text-sm font-medium text-gray-700 mb-2">JavaScript Code:</h4>
                    <div class="bg-gray-100 rounded-lg p-4">
                        <pre class="text-sm text-gray-800 overflow-x-auto"><code>{{ $jsCode }}</code></pre>
                    </div>
                </div>
                @endif
            </div>
        @else
            <p class="text-gray-500">No code available</p>
        @endif
    </div>
</div>
