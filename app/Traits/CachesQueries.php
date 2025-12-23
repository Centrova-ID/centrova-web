<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

/**
 * Query Cache Trait
 * Add to models for automatic query caching
 */
trait CachesQueries
{
    /**
     * Cache query results
     */
    public function scopeCached(Builder $query, int $ttl = null, array $tags = [])
    {
        $ttl = $ttl ?? config('performance.database.remember_time', 600);
        $key = $this->getCacheKey($query);
        $allTags = array_merge(['model:' . static::class], $tags);

        return Cache::tags($allTags)->remember($key, $ttl, function () use ($query) {
            return $query->get();
        });
    }

    /**
     * Generate cache key from query
     */
    protected function getCacheKey(Builder $query): string
    {
        $sql = $query->toSql();
        $bindings = $query->getBindings();
        
        return 'query:' . md5($sql . serialize($bindings));
    }

    /**
     * Invalidate model cache on save/delete
     */
    protected static function bootCachesQueries()
    {
        static::saved(function ($model) {
            $model->clearModelCache();
        });

        static::deleted(function ($model) {
            $model->clearModelCache();
        });
    }

    /**
     * Clear all cache for this model
     */
    public function clearModelCache(): void
    {
        Cache::tags(['model:' . static::class])->flush();
    }

    /**
     * Remember a model query
     */
    public static function cacheFind($id, int $ttl = 3600)
    {
        $key = 'model:' . static::class . ':' . $id;
        
        return Cache::tags(['model:' . static::class])->remember($key, $ttl, function () use ($id) {
            return static::find($id);
        });
    }

    /**
     * Cache with relationships
     */
    public function scopeCachedWith(Builder $query, array $relations, int $ttl = null)
    {
        $ttl = $ttl ?? config('performance.database.remember_time', 600);
        $key = $this->getCacheKey($query) . ':with:' . md5(serialize($relations));
        
        return Cache::tags(['model:' . static::class])->remember($key, $ttl, function () use ($query, $relations) {
            return $query->with($relations)->get();
        });
    }
}
