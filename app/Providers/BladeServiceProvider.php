<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        /**
         * @cacheFragment directive
         * Usage: @cacheFragment('key', 900, ['tag1', 'tag2'])
         */
        Blade::directive('cacheFragment', function ($expression) {
            $parts = explode(',', $expression);
            $key = trim($parts[0]);
            $ttl = isset($parts[1]) ? trim($parts[1]) : 900;
            $tags = isset($parts[2]) ? trim($parts[2]) : "['fragments']";

            return "<?php 
                \$__cacheFragmentKey = {$key};
                \$__cacheFragmentTTL = {$ttl};
                \$__cacheFragmentTags = {$tags};
                
                if (Cache::tags(\$__cacheFragmentTags)->has(\$__cacheFragmentKey)) {
                    echo Cache::tags(\$__cacheFragmentTags)->get(\$__cacheFragmentKey);
                    \$__cacheFragmentSkip = true;
                } else {
                    ob_start();
                    \$__cacheFragmentSkip = false;
                }
            ?>";
        });

        Blade::directive('endCacheFragment', function () {
            return "<?php 
                if (!\$__cacheFragmentSkip) {
                    \$content = ob_get_clean();
                    Cache::tags(\$__cacheFragmentTags)->put(\$__cacheFragmentKey, \$content, \$__cacheFragmentTTL);
                    echo \$content;
                }
            ?>";
        });

        /**
         * @cache directive - simpler version
         * Usage: @cache('key', 900)
         */
        Blade::directive('cache', function ($expression) {
            return "<?php if(! app('cache')->has({$expression})) { ob_start(); ?>";
        });

        Blade::directive('endcache', function ($expression) {
            return "<?php echo app('cache')->remember({$expression}, ob_get_clean()); } 
                    else { echo app('cache')->get({$expression}); } ?>";
        });

        /**
         * @turboFrame directive
         * Usage: @turboFrame('frame-id')
         */
        Blade::directive('turboFrame', function ($expression) {
            return "<?php echo '<turbo-frame id=\"' . {$expression} . '\">'; ?>";
        });

        Blade::directive('endTurboFrame', function () {
            return "<?php echo '</turbo-frame>'; ?>";
        });

        /**
         * @turboStream directive
         * Usage: @turboStream('append', 'target-id')
         */
        Blade::directive('turboStream', function ($expression) {
            $parts = explode(',', $expression);
            $action = trim($parts[0], " '\"");
            $target = trim($parts[1], " '\"");
            
            return "<?php echo '<turbo-stream action=\"{$action}\" target=\"{$target}\"><template>'; ?>";
        });

        Blade::directive('endTurboStream', function () {
            return "<?php echo '</template></turbo-stream>'; ?>";
        });
    }
}
