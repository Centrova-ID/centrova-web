<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview: {{ $component->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @if($component->css_code)
    <style>
        {!! $component->css_code !!}
    </style>
    @endif
</head>
<body class="bg-gray-100">
    <div class="min-h-screen p-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-lg bg-gray-100 flex items-center justify-center mr-4">
                            <span class="text-xl">{{ $component->icon ?? '🧩' }}</span>
                        </div>
                        <div>
                            <h1 class="text-xl font-semibold text-gray-900">{{ $component->title }}</h1>
                            <p class="text-sm text-gray-600">{{ $component->description }}</p>
                        </div>
                    </div>
                    <button onclick="window.close()" 
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Close Preview
                    </button>
                </div>
            </div>

            <!-- Component Preview -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Component Preview</h2>
                </div>
                <div class="p-8">
                    <div id="component-preview">
                        {!! $component->html_code !!}
                    </div>
                </div>
            </div>

            <!-- Code Display -->
            <div class="mt-8 space-y-6">
                @if($component->html_code)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">HTML Code</h3>
                    </div>
                    <div class="p-6">
                        <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
                            <pre class="text-green-400 text-sm"><code>{{ $component->html_code }}</code></pre>
                        </div>
                    </div>
                </div>
                @endif

                @if($component->css_code)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">CSS Code</h3>
                    </div>
                    <div class="p-6">
                        <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
                            <pre class="text-blue-400 text-sm"><code>{{ $component->css_code }}</code></pre>
                        </div>
                    </div>
                </div>
                @endif

                @if($component->js_code)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">JavaScript Code</h3>
                    </div>
                    <div class="p-6">
                        <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
                            <pre class="text-yellow-400 text-sm"><code>{{ $component->js_code }}</code></pre>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    @if($component->js_code)
    <script>
        {!! $component->js_code !!}
    </script>
    @endif
</body>
</html>
