<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Helpers\ImageHelper;

class ProfileController extends Controller
{
    /**
     * Show the profile settings page
     */
    public function show()
    {
        $staffUser = Auth::guard('staff')->user();
        $staff = Staff::find($staffUser->id);
        
        return view('staff.profile.index', compact('staff'));
    }

    /**
     * Update the staff member's profile information
     */
    public function update(Request $request)
    {
        $staffUser = Auth::guard('staff')->user();
        $staff = Staff::find($staffUser->id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('staff_users')->ignore($staff->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'bio' => ['nullable', 'string', 'max:500'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($staff->profile_picture && Storage::disk('public')->exists($staff->profile_picture)) {
                Storage::disk('public')->delete($staff->profile_picture);
            }

            // Store new profile picture with resize to 600x600
            $file = $request->file('profile_picture');
            $filename = ImageHelper::generateProfilePictureFilename($staff->id, 'staff_profile');
            $path = 'staff/profile-pictures/' . $filename;
            $fullPath = storage_path('app/public/' . $path);
            
            // Process and resize image using ImageHelper
            ImageHelper::resizeProfilePicture($file->getPathname(), $fullPath);
            
            $staff->profile_picture = $path;
        }

        // Update staff information
        $staff->fill([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'bio' => $request->bio,
        ]);

        if (isset($staff->profile_picture)) {
            $staff->profile_picture = $staff->profile_picture;
        }

        $staff->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Update the staff member's password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password:staff'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $staffUser = Auth::guard('staff')->user();
        $staff = Staff::find($staffUser->id);
        
        $staff->password = Hash::make($request->password);
        $staff->save();

        return back()->with('success', 'Password updated successfully!');
    }

    /**
     * Update notification preferences
     */
    public function updateNotifications(Request $request)
    {
        $request->validate([
            'email_notifications' => ['boolean'],
            'marketing_emails' => ['boolean'],
            'security_alerts' => ['boolean'],
            'staff_updates' => ['boolean'],
        ]);

        $staffUser = Auth::guard('staff')->user();
        $staff = Staff::find($staffUser->id);
        
        $staff->fill([
            'email_notifications' => $request->boolean('email_notifications'),
            'marketing_emails' => $request->boolean('marketing_emails'),
            'security_alerts' => $request->boolean('security_alerts'),
            'staff_updates' => $request->boolean('staff_updates'),
        ]);

        $staff->save();

        return back()->with('success', 'Notification preferences updated successfully!');
    }

    /**
     * Remove profile picture
     */
    public function removeProfilePicture()
    {
        $staffUser = Auth::guard('staff')->user();
        $staff = Staff::find($staffUser->id);

        if ($staff->profile_picture && Storage::disk('public')->exists($staff->profile_picture)) {
            Storage::disk('public')->delete($staff->profile_picture);
        }

        $staff->profile_picture = null;
        $staff->save();

        return back()->with('success', 'Profile picture removed successfully!');
    }

    /**
     * Download profile data
     */
    public function downloadData()
    {
        $staffUser = Auth::guard('staff')->user();
        $staff = Staff::find($staffUser->id);
        
        $data = [
            'name' => $staff->name,
            'email' => $staff->email,
            'phone' => $staff->phone,
            'bio' => $staff->bio,
            'role' => $staff->role,
            'created_at' => $staff->created_at,
            'updated_at' => $staff->updated_at,
        ];

        $filename = 'profile-data-' . $staff->id . '-' . now()->format('Y-m-d') . '.json';

        return response()->json($data)
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    /**
     * Delete account
     */
    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $staffUser = Auth::guard('staff')->user();
        $staff = Staff::find($staffUser->id);

        if (!Hash::check($request->password, $staff->password)) {
            return back()->withErrors(['password' => 'Password salah.']);
        }

        // Delete profile picture if exists
        if ($staff->profile_picture) {
            Storage::delete('public/' . $staff->profile_picture);
        }

        // Logout and delete account
        Auth::guard('staff')->logout();
        $staff->delete();

        return redirect()->route('staff.login')->with('success', 'Akun berhasil dihapus.');
    }
}
