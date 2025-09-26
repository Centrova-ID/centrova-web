<?php

namespace App\Models\OAuth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OAuthScope extends Model
{
    use HasFactory;

    protected $table = 'oauth_scopes';

    protected $fillable = [
        'scope',
        'name',
        'description',
        'is_default'
    ];

    protected $casts = [
        'is_default' => 'boolean'
    ];

    /**
     * Get default scopes.
     */
    public static function getDefaultScopes()
    {
        return static::where('is_default', true)->get();
    }

    /**
     * Get scope by name.
     */
    public static function findByScope(string $scope)
    {
        return static::where('scope', $scope)->first();
    }

    /**
     * Get multiple scopes by names.
     */
    public static function findByScopes(array $scopes)
    {
        return static::whereIn('scope', $scopes)->get();
    }

    /**
     * Check if scope exists.
     */
    public static function scopeExists(string $scope): bool
    {
        return static::where('scope', $scope)->exists();
    }

    /**
     * Validate multiple scopes.
     */
    public static function validateScopes(array $scopes): bool
    {
        $existingScopes = static::whereIn('scope', $scopes)->pluck('scope')->toArray();
        return count($scopes) === count($existingScopes);
    }
}
