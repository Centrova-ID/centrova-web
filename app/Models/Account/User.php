<?php

namespace App\Models\Account;

use App\Models\Base\AccountModel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model User untuk database Account (centrova_account)
 * 
 * Model ini mengakses tabel users di database centrova_account
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Koneksi database yang digunakan
     */
    protected $connection = 'account';

    /**
     * The table associated with the model.
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'phone',
        'birth_date',
        'gender',
        'address',
        'city',
        'postal_code',
        'country',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relation',
        'language',
        'timezone',
        'currency',
        'privacy_settings',
        'communication_preferences',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'privacy_settings' => 'array',
        'communication_preferences' => 'array',
        'birth_date' => 'date',
        'password' => 'hashed',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user's full address
     */
    public function getFullAddressAttribute()
    {
        $parts = array_filter([
            $this->address,
            $this->city,
            $this->postal_code,
            $this->country
        ]);
        
        return implode(', ', $parts);
    }

    /**
     * Get the user's age
     */
    public function getAgeAttribute()
    {
        return $this->birth_date ? $this->birth_date->age : null;
    }

    /**
     * Get gender display name
     */
    public function getGenderDisplayAttribute()
    {
        return match($this->gender) {
            'male' => 'Laki-laki',
            'female' => 'Perempuan',
            'other' => 'Lainnya',
            'prefer_not_to_say' => 'Lebih suka tidak menyebutkan',
            default => '-'
        };
    }

    /**
     * Get the login username to be used by the controller.
     */
    public static function username()
    {
        return 'username';
    }

    /**
     * Relationship dengan devices
     */
    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    /**
     * Relationship dengan subscriptions
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Relationship dengan login activities
     */
    public function loginActivities()
    {
        return $this->hasMany(UserLoginActivity::class);
    }

    /**
     * Relationship dengan recovery codes
     */
    public function recoveryCodes()
    {
        return $this->hasMany(UserRecoveryCode::class);
    }

    /**
     * Relationship dengan sessions
     */
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
