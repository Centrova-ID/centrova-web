import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    
    build: {
        // Production optimizations
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true, // Remove console.logs in production
                drop_debugger: true,
                pure_funcs: ['console.log', 'console.info'], // Remove specific functions
            },
            mangle: {
                safari10: true,
            },
        },
        
        // Chunk optimization for better caching
        rollupOptions: {
            output: {
                manualChunks: {
                    // Separate vendor chunks for better caching
                    'vendor-alpine': ['alpinejs', '@alpinejs/persist'],
                    'vendor-utils': ['cropperjs', 'axios'],
                    'vendor-editor': ['tinymce'],
                },
                // Optimized chunk file names
                chunkFileNames: 'assets/js/[name]-[hash].js',
                entryFileNames: 'assets/js/[name]-[hash].js',
                assetFileNames: 'assets/[ext]/[name]-[hash].[ext]',
            },
        },
        
        // Chunk size warnings (500kb)
        chunkSizeWarningLimit: 500,
        
        // Source maps for production debugging (optional, remove for max performance)
        sourcemap: false,
        
        // Target modern browsers for smaller bundles
        target: 'es2020',
        
        // CSS code splitting
        cssCodeSplit: true,
        
        // Asset inlining threshold (4kb)
        assetsInlineLimit: 4096,
    },
    
    // Optimize dependencies
    optimizeDeps: {
        include: [
            'alpinejs',
            '@alpinejs/persist',
            '@hotwired/turbo',
            'axios',
            'cropperjs',
            'tinymce',
        ],
        // Force pre-bundling
        force: false,
    },
    
    // Server configuration for development
    server: {
        hmr: {
            host: 'localhost',
        },
        // Optimize dev server
        watch: {
            usePolling: false,
        },
    },
    
    // Resolve configuration
    resolve: {
        alias: {
            '@': '/resources/js',
            '@css': '/resources/css',
        },
    },
});
