<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Account\User;
use App\Helpers\ImageHelper;

class ProfileController extends Controller
{
    /**
     * Show the profile management page
     */
    public function index()
    {
        $user = User::find(Auth::id());
        
        return view('auth.profile.index', compact('user'));
    }

    /**
     * Update basic profile information
     */
    public function updateBasic(Request $request)
    {
        $user = User::find(Auth::id());

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female,other,prefer_not_to_say',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'birth_date' => $request->birth_date,
                'gender' => $request->gender,
            ]);

            return back()->with('success', 'Informasi dasar berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    /**
     * Update address information
     */
    public function updateAddress(Request $request)
    {
        $user = User::find(Auth::id());

        $validator = Validator::make($request->all(), [
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'country' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $user->update([
                'address' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
            ]);

            return back()->with('success', 'Informasi alamat berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui alamat.');
        }
    }

    /**
     * Update profile picture
     */
    public function updateProfilePicture(Request $request)
    {
        $user = User::find(Auth::id());

        // Check if it's an illustration or uploaded file
        if ($request->has('illustration')) {
            // Handle illustration selection
            $validator = Validator::make($request->all(), [
                'illustration' => 'required|string'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            try {
                // Validate illustration file exists and has valid extension
                $illustrationFile = $request->illustration;
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
                $fileExtension = strtolower(pathinfo($illustrationFile, PATHINFO_EXTENSION));
                
                if (!in_array($fileExtension, $allowedExtensions)) {
                    return back()->with('error', 'Format file ilustrasi tidak valid.');
                }
                
                // Check if illustration path contains category folder
                $illustrationPhysicalPath = public_path('assets/illustrations/' . $illustrationFile);
                if (!file_exists($illustrationPhysicalPath)) {
                    return back()->with('error', 'File ilustrasi tidak ditemukan.');
                }

                // Delete old profile picture if exists and it's not an illustration
                if ($user->profile_picture && !str_starts_with($user->profile_picture, 'assets/illustrations/') && Storage::disk('public')->exists($user->profile_picture)) {
                    Storage::disk('public')->delete($user->profile_picture);
                }

                // Set illustration path (with category support)
                $illustrationPath = 'assets/illustrations/' . $illustrationFile;

                $user->update([
                    'profile_picture' => $illustrationPath
                ]);

                return back()->with('success', 'Ilustrasi profil berhasil dipilih.');
            } catch (\Exception $e) {
                return back()->with('error', 'Terjadi kesalahan saat memilih ilustrasi.');
            }
        } else {
            // Handle file upload
            $validator = Validator::make($request->all(), [
                'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            try {
                // Delete old profile picture if exists and it's not an illustration
                if ($user->profile_picture && !str_starts_with($user->profile_picture, 'assets/illustrations/') && Storage::disk('public')->exists($user->profile_picture)) {
                    Storage::disk('public')->delete($user->profile_picture);
                }

                // Store new profile picture with resize to 600x600
                $file = $request->file('profile_picture');
                $filename = ImageHelper::generateProfilePictureFilename($user->id);
                $path = 'profile-pictures/' . $filename;
                $fullPath = storage_path('app/public/' . $path);
                
                // Process and resize image using ImageHelper
                ImageHelper::resizeProfilePicture($file->getPathname(), $fullPath);

                $user->update([
                    'profile_picture' => $path
                ]);

                return back()->with('success', 'Foto profil berhasil diperbarui.');
            } catch (\Exception $e) {
                return back()->with('error', 'Terjadi kesalahan saat mengunggah foto profil.');
            }
        }
    }

    /**
     * Remove profile picture
     */
    public function removeProfilePicture()
    {
        $user = User::find(Auth::id());

        try {
            // Delete profile picture file if exists and it's not an illustration
            if ($user->profile_picture && !str_starts_with($user->profile_picture, 'assets/illustrations/') && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $user->update([
                'profile_picture' => null
            ]);

            return back()->with('success', 'Foto profil berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus foto profil.');
        }
    }

    /**
     * Get images for a specific category
     */
    public function getCategoryImages(Request $request)
    {
        $category = $request->get('category');
        
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan'
            ], 400);
        }

        try {
            $illustrationPath = public_path('assets/illustrations/' . $category);
            $images = [];
            
            if (is_dir($illustrationPath)) {
                $files = scandir($illustrationPath);
                foreach ($files as $file) {
                    if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp'])) {
                        $images[] = $file;
                    }
                }
                // Sort images for consistent order
                sort($images);
            }

            return response()->json([
                'success' => true,
                'images' => $images,
                'category' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memuat ilustrasi'
            ], 500);
        }
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $user = User::find(Auth::id());

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/'
            ],
        ], [
            'password.regex' => 'Password harus mengandung minimal 1 huruf kecil, 1 huruf besar, 1 angka, dan 1 karakter khusus.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'current_password.required' => 'Password saat ini harus diisi.'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        try {
            $user->update([
                'password' => Hash::make($request->password),
                'password_updated_at' => now()
            ]);

            return back()->with('success', 'Password berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui password.');
        }
    }

    /**
     * Get countries list for dropdown
     */
    public function getCountries()
    {
        $countries = [
            'Indonesia' => 'Indonesia',
            'Malaysia' => 'Malaysia',
            'Singapore' => 'Singapore',
            'Thailand' => 'Thailand',
            'Philippines' => 'Philippines',
            'Vietnam' => 'Vietnam',
            'United States' => 'United States',
            'United Kingdom' => 'United Kingdom',
            'Australia' => 'Australia',
            'Japan' => 'Japan',
            'South Korea' => 'South Korea',
            'China' => 'China',
        ];

        return response()->json($countries);
    }
}
