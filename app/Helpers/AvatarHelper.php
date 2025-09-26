<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class AvatarHelper
{
    /**
     * Generate hashed URL untuk avatar illustration
     */
    public static function generateHashedAvatarUrl($illustrationPath)
    {
        // Cek apakah sudah ada hash untuk path ini
        $existingHash = self::findExistingHash($illustrationPath);
        if ($existingHash) {
            return route('avatar.hashed', ['hash' => $existingHash]);
        }
        
        // Buat hash yang unique
        $hash = Str::random(32) . '_' . md5($illustrationPath . config('app.key'));
        
        // Simpan mapping hash ke path asli
        self::saveHashMapping($hash, $illustrationPath);
        
        return route('avatar.hashed', ['hash' => $hash]);
    }
    
    /**
     * Cari hash yang sudah ada untuk path tertentu
     */
    private static function findExistingHash($illustrationPath)
    {
        $mapping = self::getHashMapping();
        
        foreach ($mapping as $hash => $path) {
            if ($path === $illustrationPath) {
                return $hash;
            }
        }
        
        return null;
    }
    
    /**
     * Save hash mapping dengan cache dan session
     */
    private static function saveHashMapping($hash, $illustrationPath)
    {
        // Session mapping
        $sessionMapping = session('avatar_hash_mapping', []);
        $sessionMapping[$hash] = $illustrationPath;
        session(['avatar_hash_mapping' => $sessionMapping]);
        
        // Cache mapping (global untuk semua user)
        $cacheKey = 'global_avatar_hash_mapping';
        $cacheMapping = Cache::get($cacheKey, []);
        $cacheMapping[$hash] = $illustrationPath;
        Cache::put($cacheKey, $cacheMapping, now()->addDays(90));
    }
    
    /**
     * Get hash mapping dari session dan cache
     */
    private static function getHashMapping()
    {
        $sessionMapping = session('avatar_hash_mapping', []);
        $cacheMapping = Cache::get('global_avatar_hash_mapping', []);
        
        return array_merge($cacheMapping, $sessionMapping);
    }
    
    /**
     * Resolve avatar URL berdasarkan profile picture
     */
    public static function resolveAvatarUrl($profilePicture)
    {
        if (!$profilePicture || empty(trim($profilePicture))) {
            return null;
        }
        
        // Jika sudah dalam format hash
        if (str_starts_with($profilePicture, 'hashed:')) {
            $hash = str_replace('hashed:', '', $profilePicture);
            return route('avatar.hashed', ['hash' => $hash]);
        }
        
        // Jika illustration, generate hash
        if (str_starts_with($profilePicture, 'assets/illustrations/')) {
            return self::generateHashedAvatarUrl($profilePicture);
        }
        
        // Jika external URL
        if (str_starts_with($profilePicture, 'http')) {
            return $profilePicture;
        }
        
        // Jika storage path (uploaded files), juga generate hash
        if (str_starts_with($profilePicture, 'profile-pictures/') || 
            str_starts_with($profilePicture, 'avatars/') ||
            str_contains($profilePicture, '/profile_')) {
            return self::generateHashedAvatarUrl($profilePicture);
        }
        
        // Default fallback untuk storage URL
        return Storage::url($profilePicture);
    }
    
    /**
     * Check apakah profile picture adalah illustration
     */
    public static function isIllustration($profilePicture)
    {
        if (!$profilePicture) {
            return false;
        }
        
        // Jika format hash, cek path aslinya
        if (str_starts_with($profilePicture, 'hashed:')) {
            $hash = str_replace('hashed:', '', $profilePicture);
            $originalPath = self::getOriginalPath($hash);
            return $originalPath && str_starts_with($originalPath, 'assets/illustrations/');
        }
        
        return str_starts_with($profilePicture, 'assets/illustrations/');
    }
    
    /**
     * Get original path dari hashed avatar
     */
    public static function getOriginalPath($hash)
    {
        $mapping = self::getHashMapping();
        return $mapping[$hash] ?? null;
    }
}
