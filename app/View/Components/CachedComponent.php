<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Cache;

/**
 * Cached Component Base
 * Extend this for auto-cached components
 */
abstract class CachedComponent extends Component
{
    /**
     * Cache TTL in seconds
     */
    protected int $cacheTTL = 900; // 15 minutes

    /**
     * Cache tags for this component
     */
    protected array $cacheTags = ['components'];

    /**
     * Enable/disable caching
     */
    protected bool $cacheEnabled = true;

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        if (!$this->cacheEnabled || app()->environment('local')) {
            return $this->renderComponent();
        }

        $cacheKey = $this->getCacheKey();

        return Cache::tags($this->cacheTags)->remember($cacheKey, $this->cacheTTL, function () {
            return $this->renderComponent();
        });
    }

    /**
     * Render the component (to be implemented by child classes)
     */
    abstract protected function renderComponent();

    /**
     * Generate unique cache key for this component
     */
    protected function getCacheKey(): string
    {
        $className = class_basename($this);
        $props = $this->getPublicProperties();
        
        return 'component:' . $className . ':' . md5(serialize($props));
    }

    /**
     * Get public properties for cache key generation
     */
    protected function getPublicProperties(): array
    {
        $reflection = new \ReflectionClass($this);
        $properties = [];

        foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            if (!$property->isStatic()) {
                $properties[$property->getName()] = $property->getValue($this);
            }
        }

        return $properties;
    }

    /**
     * Clear component cache
     */
    public static function clearCache(): void
    {
        Cache::tags(['components'])->flush();
    }
}
