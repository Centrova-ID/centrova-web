<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;

class StaffUser extends Authenticatable
{
    use HasFactory, Notifiable;

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
    protected $table = 'staff_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'status',
        'last_login_at',
        'phone',
        'bio',
        'profile_picture',
        'email_notifications',
        'marketing_emails',
        'security_alerts',
        'staff_updates',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if staff user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if staff user is customer service
     */
    public function isCS(): bool
    {
        return $this->role === 'customer_service';
    }

    /**
     * Check if staff user is developer
     */
    public function isDeveloper(): bool
    {
        return $this->role === 'developer';
    }

    /**
     * Check if staff user is marketing
     */
    public function isMarketing(): bool
    {
        return $this->role === 'marketing';
    }

    /**
     * Check if staff user is manager
     */
    public function isManager(): bool
    {
        return $this->role === 'manager';
    }

    /**
     * Check if staff user is supervisor
     */
    public function isSupervisor(): bool
    {
        return $this->role === 'supervisor';
    }

    /**
     * Check if staff user is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if user is staff (always true for StaffUser model)
     */
    public function isStaff(): bool
    {
        if (is_null($this->role)) {
            return false;
        }
        
        // Convert role to lowercase for case-insensitive comparison
        $role = strtolower(trim($this->role));
        
        // Explicitly check against customer role (should never happen for StaffUser but safety check)
        if ($role === 'customer') {
            return false;
        }
        
        // Define valid staff roles
        $staffRoles = ['admin', 'staff', 'customer_service', 'privacy_officer'];
        
        return in_array($role, $staffRoles);
    }

    /**
     * Check if staff user has role
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Check if staff user has any of the given roles
     */
    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role, $roles);
    }

    /**
     * Get formatted last login date
     */
    public function getFormattedLastLoginAttribute(): ?string
    {
        if (!$this->last_login_at) {
            return null;
        }
        
        try {
            return \Carbon\Carbon::parse($this->last_login_at)->format('M d, Y g:i A');
        } catch (\Exception $e) {
            return $this->last_login_at;
        }
    }

    /**
     * Get formatted created date
     */
    public function getFormattedCreatedAttribute(): string
    {
        try {
            return \Carbon\Carbon::parse($this->created_at)->format('M d, Y g:i A');
        } catch (\Exception $e) {
            return $this->created_at;
        }
    }

    /**
     * Get formatted updated date
     */
    public function getFormattedUpdatedAttribute(): string
    {
        try {
            return \Carbon\Carbon::parse($this->updated_at)->format('M d, Y g:i A');
        } catch (\Exception $e) {
            return $this->updated_at;
        }
    }

    /**
     * Scope for active staff users
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for specific role
     */
    public function scopeRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Get chat conversations assigned to this staff
     */
    public function chatConversations()
    {
        return $this->hasMany(\App\Models\ChatConversation::class, 'staff_id');
    }

    /**
     * Get chat messages sent by this staff
     */
    public function chatMessages()
    {
        return $this->hasMany(\App\Models\ChatMessage::class, 'sender_id')
                    ->where('sender_type', 'staff');
    }
}
