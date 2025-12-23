<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\CachesQueries;

/**
 * Optimized User Model
 * 
 * Performance Features:
 * - Query caching enabled
 * - Optimized attribute casting
 * - Selective eager loading
 * - Efficient scopes
 */
class OptimizedUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CachesQueries;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Performance: Disable timestamps if not needed
     */
    // public $timestamps = false;

    /**
     * Performance: Specify exactly which attributes to select by default
     */
    // protected $attributes = ['id', 'name', 'email'];

    /*
    |--------------------------------------------------------------------------
    | Optimized Relationships
    |--------------------------------------------------------------------------
    | Use countable relationships and selective eager loading
    */

    /**
     * Get posts with efficient counting
     */
    public function posts()
    {
        return $this->hasMany(Post::class)->select(['id', 'user_id', 'title', 'created_at']);
    }

    /**
     * Get active posts only
     */
    public function activePosts()
    {
        return $this->posts()->where('status', 'published');
    }

    /**
     * Count posts without loading them
     */
    public function postsCount()
    {
        return $this->posts()->count();
    }

    /*
    |--------------------------------------------------------------------------
    | Optimized Query Scopes
    |--------------------------------------------------------------------------
    | Reusable, efficient query builders
    */

    /**
     * Scope: Active users only
     */
    public function scopeActive($query)
    {
        return $query->whereNotNull('email_verified_at');
    }

    /**
     * Scope: Recent users (last 30 days)
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Scope: With essential relationships
     */
    public function scopeWithEssentials($query)
    {
        return $query->with(['posts' => function ($q) {
            $q->select('id', 'user_id', 'title')->limit(5);
        }]);
    }

    /**
     * Scope: Minimal user data for lists
     */
    public function scopeMinimal($query)
    {
        return $query->select(['id', 'name', 'email', 'created_at']);
    }

    /*
    |--------------------------------------------------------------------------
    | Cached Queries
    |--------------------------------------------------------------------------
    | Examples of using CachesQueries trait
    */

    /**
     * Get all active users (cached)
     */
    public static function getActiveUsers($ttl = 600)
    {
        return self::active()
            ->minimal()
            ->cached($ttl, ['users', 'active']);
    }

    /**
     * Get user by email (cached)
     */
    public static function findByEmail($email, $ttl = 3600)
    {
        $key = 'user:email:' . md5($email);
        
        return \Cache::tags(['users'])->remember($key, $ttl, function () use ($email) {
            return self::where('email', $email)->first();
        });
    }

    /**
     * Get user with relationships (cached)
     */
    public static function getWithRelations($id, $ttl = 600)
    {
        $key = 'user:relations:' . $id;
        
        return \Cache::tags(['users'])->remember($key, $ttl, function () use ($id) {
            return self::with(['posts', 'comments'])
                ->find($id);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Attribute Accessors (Optimized)
    |--------------------------------------------------------------------------
    */

    /**
     * Get user's initials
     * Cached in memory during request
     */
    protected $initialsCache;
    
    public function getInitialsAttribute()
    {
        if (!$this->initialsCache) {
            $words = explode(' ', $this->name);
            $this->initialsCache = strtoupper(
                substr($words[0], 0, 1) . 
                (isset($words[1]) ? substr($words[1], 0, 1) : '')
            );
        }
        
        return $this->initialsCache;
    }

    /**
     * Get avatar URL (cached)
     */
    public function getAvatarUrlAttribute()
    {
        return \Cache::tags(['users', 'avatars'])->remember(
            'user:avatar:' . $this->id,
            3600,
            function () {
                // Your avatar logic here
                return "https://ui-avatars.com/api/?name=" . urlencode($this->name);
            }
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Cache Invalidation
    |--------------------------------------------------------------------------
    */

    /**
     * Boot method - auto-clear cache on updates
     */
    protected static function boot()
    {
        parent::boot();

        // Clear cache when user is saved
        static::saved(function ($user) {
            $user->clearRelatedCache();
        });

        // Clear cache when user is deleted
        static::deleted(function ($user) {
            $user->clearRelatedCache();
        });
    }

    /**
     * Clear all user-related cache
     */
    public function clearRelatedCache()
    {
        // Clear model cache (from CachesQueries trait)
        $this->clearModelCache();
        
        // Clear specific user cache
        \Cache::tags(['users'])->flush();
        
        // Clear specific keys
        \Cache::forget('user:email:' . md5($this->email));
        \Cache::forget('user:avatar:' . $this->id);
        \Cache::forget('user:relations:' . $this->id);
    }

    /*
    |--------------------------------------------------------------------------
    | Bulk Operations (Performance Optimized)
    |--------------------------------------------------------------------------
    */

    /**
     * Bulk update with cache clearing
     */
    public static function bulkUpdate(array $ids, array $data)
    {
        // Use query builder for better performance
        $updated = self::whereIn('id', $ids)->update($data);
        
        // Clear cache for affected users
        \Cache::tags(['users'])->flush();
        
        return $updated;
    }

    /**
     * Chunk process large datasets
     */
    public static function processInChunks($callback, $chunkSize = 1000)
    {
        self::chunk($chunkSize, function ($users) use ($callback) {
            foreach ($users as $user) {
                $callback($user);
            }
        });
    }
}
