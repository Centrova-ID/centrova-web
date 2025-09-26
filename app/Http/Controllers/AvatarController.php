<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Helpers\AvatarHelper;

class AvatarController extends Controller
{
    /**
     * Serve hashed avatar illustration
     */
    public function serveHashedAvatar($hash)
    {
        // Ambil mapping hash dari cache dan session
        $originalPath = AvatarHelper::getOriginalPath($hash);
        
        if (!$originalPath) {
            abort(404, 'Avatar not found');
        }
        
        // Tentukan full path berdasarkan jenis file
        if (str_starts_with($originalPath, 'assets/illustrations/')) {
            // Illustration files
            $fullPath = public_path($originalPath);
        } else {
            // Uploaded files (storage)
            $fullPath = storage_path('app/public/' . $originalPath);
        }
        
        if (!file_exists($fullPath)) {
            abort(404, 'Avatar file not found');
        }
        
        // Tentukan content type berdasarkan ekstensi file
        $extension = pathinfo($fullPath, PATHINFO_EXTENSION);
        $contentType = $this->getContentType($extension);
        
        // Cache headers untuk performa
        $headers = [
            'Content-Type' => $contentType,
            'Cache-Control' => 'public, max-age=31536000', // 1 year
            'Expires' => gmdate('D, d M Y H:i:s \G\M\T', time() + 31536000),
            'Last-Modified' => gmdate('D, d M Y H:i:s \G\M\T', filemtime($fullPath)),
            'ETag' => '"' . md5_file($fullPath) . '"',
        ];
        
        return response()->file($fullPath, $headers);
    }
    
    /**
     * Get content type berdasarkan ekstensi file
     */
    private function getContentType($extension)
    {
        $types = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            'svg' => 'image/svg+xml',
        ];
        
        return $types[strtolower($extension)] ?? 'image/jpeg';
    }
    
    /**
     * API endpoint untuk mengambil ilustrasi dengan hash
     */
    public function getIllustrationsWithHash($category)
    {
        $categoryPath = public_path("assets/illustrations/{$category}");
        
        if (!is_dir($categoryPath)) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        
        $images = [];
        $files = scandir($categoryPath);
        
        foreach ($files as $file) {
            if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                $originalPath = "assets/illustrations/{$category}/{$file}";
                $hashedUrl = AvatarHelper::generateHashedAvatarUrl($originalPath);
                
                // Extract hash dari URL
                $hash = basename(parse_url($hashedUrl, PHP_URL_PATH));
                
                $images[] = [
                    'name' => pathinfo($file, PATHINFO_FILENAME),
                    'hash' => $hash,
                    'url' => $hashedUrl,
                    // 'original_path' => $originalPath, // Untuk debugging, hapus di production
                ];
            }
        }
        
        return response()->json($images);
    }
    
    /**
     * Set avatar illustration dengan hash untuk user
     */
    public function setIllustrationAvatar(Request $request)
    {
        $request->validate([
            'hash' => 'required|string',
            'user_id' => 'required|integer|exists:users,id'
        ]);
        
        $hash = $request->hash;
        $userId = $request->user_id;
        
        // Verifikasi hash valid
        $originalPath = AvatarHelper::getOriginalPath($hash);
        if (!$originalPath) {
            return response()->json(['error' => 'Invalid hash'], 400);
        }
        
        // Update user profile picture dengan hash
        $user = \App\Models\User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        
        // Simpan hash sebagai profile picture
        $user->profile_picture = "hashed:{$hash}";
        $user->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Avatar illustration set successfully',
            'avatar_url' => route('avatar.hashed', ['hash' => $hash])
        ]);
    }

    /**
     * Upload custom avatar untuk user
     */
    public function uploadAvatar(Request $request, $user)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048', // Max 2MB
        ]);

        $userModel = \App\Models\User::findOrFail($user);
        
        // Check if user is authorized to upload avatar for this user
        if (auth()->id() !== $userModel->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            
            // Delete old avatar if exists and is not a hashed illustration
            if ($userModel->profile_picture && !str_starts_with($userModel->profile_picture, 'hashed:')) {
                Storage::disk('public')->delete($userModel->profile_picture);
            }
            
            // Store the new avatar
            $filename = 'avatars/' . $userModel->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('avatars', $userModel->id . '_' . time() . '.' . $file->getClientOriginalExtension(), 'public');
            
            // Generate hash untuk uploaded file
            $hash = \Illuminate\Support\Str::random(32) . '_' . md5($path . config('app.key'));
            
            // Save hash mapping
            $this->saveHashMapping($hash, $path);
            
            // Update user profile picture dengan hash
            $userModel->profile_picture = "hashed:{$hash}";
            $userModel->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Avatar uploaded successfully',
                'avatar_url' => route('avatar.hashed', ['hash' => $hash])
            ]);
        }
        
        return response()->json(['error' => 'No file uploaded'], 400);
    }
    
    /**
     * Save hash mapping untuk uploaded files
     */
    private function saveHashMapping($hash, $filePath)
    {
        // Session mapping
        $sessionMapping = session('avatar_hash_mapping', []);
        $sessionMapping[$hash] = $filePath;
        session(['avatar_hash_mapping' => $sessionMapping]);
        
        // Cache mapping (global untuk semua user)
        $cacheKey = 'global_avatar_hash_mapping';
        $cacheMapping = \Illuminate\Support\Facades\Cache::get($cacheKey, []);
        $cacheMapping[$hash] = $filePath;
        \Illuminate\Support\Facades\Cache::put($cacheKey, $cacheMapping, now()->addDays(90));
    }
}
