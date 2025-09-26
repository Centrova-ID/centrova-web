<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

/**
 * @method bool hasTwoFactorEnabled()
 * @method \App\Models\TwoFactorAuth getOrCreateTwoFactorAuth()
 * @method \Illuminate\Database\Eloquent\Relations\HasOne twoFactorAuth()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany trustedDevices()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany twoFactorAuthLogs()
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasTimestamps;

    /**
     * The database connection that should be used by the model.
     *
     * @var string
     */
    protected $connection = 'account';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'password_updated_at',
        'phone',
        'birth_date',
        'address',
        'city',
        'postal_code',
        'privacy_settings',
        'communication_preferences',
        'profile_picture',
        'role',
        'status',
        'suspended_at',
        'suspension_reason',
        'last_login_at',
        'bio',
        'email_notifications',
        'marketing_emails',
        'security_alerts',
        'staff_updates',
        'staff_uid',
        'department',
        'department_id',
        'location',
        'about',
        'description',
        'emergency_contact',
        'join_date',
        'gender',
        'nationality',
        'full_name',
        'country',
        'employee_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'privacy_settings' => 'array',
        'communication_preferences' => 'array',
        'birth_date' => 'date',
        'join_date' => 'date',
        'last_login_at' => 'datetime',
        'suspended_at' => 'datetime',
        'email_verified_at' => 'datetime',
        'password_updated_at' => 'datetime',
        'two_factor_confirmed_at' => 'datetime',
        'email_notifications' => 'boolean',
        'marketing_emails' => 'boolean', 
        'security_alerts' => 'boolean',
        'staff_updates' => 'boolean',
        'active_status' => 'boolean',
        'dark_mode' => 'boolean',
    ];

    /**
     * Check if user is staff (has any staff role)
     */
    public function isStaff(): bool
    {
        if (is_null($this->role)) {
            return false;
        }
        
        // Convert role to lowercase for case-insensitive comparison
        $role = strtolower(trim($this->role));
        
        // Explicitly check against customer role
        if ($role === 'customer') {
            return false;
        }
        
        // Define valid staff roles
        $staffRoles = ['admin', 'staff', 'customer_service', 'privacy_officer'];
        
        return in_array($role, $staffRoles);
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is customer service
     */
    public function isCS(): bool
    {
        return $this->role === 'customer_service';
    }

    /**
     * Check if user is developer
     */
    public function isDeveloper(): bool
    {
        return $this->role === 'developer';
    }

    /**
     * Check if user is marketing
     */
    public function isMarketing(): bool
    {
        return $this->role === 'marketing';
    }

    /**
     * Check if user is manager
     */
    public function isManager(): bool
    {
        return $this->role === 'manager';
    }

    /**
     * Check if user is supervisor
     */
    public function isSupervisor(): bool
    {
        return $this->role === 'supervisor';
    }

    /**
     * Check if user is customer
     */
    public function isCustomer(): bool
    {
        return is_null($this->role) || $this->role === 'customer';
    }

    /**
     * Check if user is active
     */
    public function isActive(): bool
    {
        return is_null($this->status) || $this->status === 'active';
    }

    /**
     * Check if user has specific role
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Check if user has any of the given roles
     */
    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role, $roles);
    }

    /**
     * Get role display name
     */
    public function getRoleDisplayNameAttribute(): string
    {
        return match($this->role) {
            'admin' => 'Administrator',
            'customer_service' => 'Customer Service',
            'developer' => 'Developer', 
            'marketing' => 'Marketing',
            'manager' => 'Manager',
            'supervisor' => 'Supervisor',
            'customer' => 'Customer',
            default => 'Customer'
        };
    }

    /**
     * Scope for staff users only
     */
    public function scopeStaff($query)
    {
        return $query->whereNotNull('role')->where('role', '!=', 'customer');
    }

    /**
     * Scope for customer users only
     */
    public function scopeCustomers($query)
    {
        return $query->where('role', 'customer')->orWhereNull('role');
    }

    /**
     * Scope for active users
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')->orWhereNull('status');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public static function username()
    {
        return 'username';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function devices() {
        return $this->hasMany(\App\Models\Device::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions() {
        return $this->hasMany(\App\Models\Subscription::class);
    }

    /**
     * Get the department that the user belongs to.
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * Get the user's login activities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function loginActivities()
    {
        return $this->hasMany(\App\Models\Account\UserLoginActivity::class);
    }

    /**
     * Get the user's chat conversations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chatConversations()
    {
        return $this->hasMany(\App\Models\ChatConversation::class);
    }

    /**
     * Get the user's chat messages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chatMessages()
    {
        return $this->hasMany(\App\Models\ChatMessage::class, 'sender_id')
                    ->where('sender_type', 'user');
    }

    /**
     * Get the user's recovery codes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recoveryCodes()
    {
        return $this->hasMany(\App\Models\Account\UserRecoveryCode::class);
    }

    /**
     * Get the user's two factor authentication settings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function twoFactorAuth()
    {
        return $this->hasOne(\App\Models\TwoFactorAuth::class);
    }

    /**
     * Get the user's trusted devices.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trustedDevices()
    {
        return $this->hasMany(\App\Models\TrustedDevice::class);
    }

    /**
     * Get the user's two factor auth logs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function twoFactorAuthLogs()
    {
        return $this->hasMany(\App\Models\TwoFactorAuthLog::class);
    }

    /**
     * Get the user's WhatsApp OTPs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whatsappOtps()
    {
        return $this->hasMany(\App\Models\WhatsAppOtp::class);
    }

    /**
     * Get the user's domains
     */
    public function domains()
    {
        return $this->hasMany(\App\Models\Domain::class);
    }

    /**
     * Get the user's domain orders
     */
    public function domainOrders()
    {
        return $this->hasMany(\App\Models\DomainOrder::class);
    }

    /**
     * Get the user's OAuth clients
     */
    public function oauthClients()
    {
        return $this->hasMany(\App\Models\OAuth\OAuthClient::class);
    }

    /**
     * Get the user's OAuth access tokens
     */
    public function oauthAccessTokens()
    {
        return $this->hasMany(\App\Models\OAuth\OAuthAccessToken::class);
    }

    /**
     * Get the user's OAuth authorization codes
     */
    public function oauthAuthorizationCodes()
    {
        return $this->hasMany(\App\Models\OAuth\OAuthAuthorizationCode::class);
    }

    /**
     * Check if user has 2FA enabled
     */
    public function hasTwoFactorEnabled(): bool
    {
        return $this->twoFactorAuth && $this->twoFactorAuth->is_enabled;
    }

    /**
     * Check if user has WhatsApp 2FA enabled
     */
    public function hasWhatsAppTwoFactorEnabled(): bool
    {
        return $this->hasTwoFactorEnabled() && !empty($this->phone);
    }

    /**
     * Get or create 2FA settings for user
     */
    public function getOrCreateTwoFactorAuth(): \App\Models\TwoFactorAuth
    {
        return $this->twoFactorAuth ?: $this->twoFactorAuth()->create([
            'is_enabled' => false,
        ]);
    }

    /**
     * Generate unique staff UID
     */
    public static function generateStaffUID(): string
    {
        do {
            $uid = 'CNV' . str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
            $exists = self::where('staff_uid', $uid)->exists();
        } while ($exists);

        return $uid;
    }

    /**
     * Assign staff UID to user if they don't have one and are staff
     */
    public function assignStaffUIDIfNeeded(): void
    {
        if ($this->isStaff() && empty($this->staff_uid)) {
            $this->staff_uid = self::generateStaffUID();
            $this->save();
        }
    }

    /**
     * Boot method to handle model events
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate staff UID when creating a new staff user
        static::creating(function ($user) {
            if ($user->isStaff() && empty($user->staff_uid)) {
                $user->staff_uid = self::generateStaffUID();
            }
        });

        // Auto-generate staff UID when updating role to staff
        static::updating(function ($user) {
            if ($user->isDirty('role') && $user->isStaff() && empty($user->staff_uid)) {
                $user->staff_uid = self::generateStaffUID();
            }
        });
    }
}
