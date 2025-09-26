<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Staff extends Authenticatable
{
    use HasFactory, Notifiable;

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
        'phone',
        'bio',
        'role',
        'password',
        'profile_picture',
        'email_notifications',
        'marketing_emails',
        'security_alerts',
        'staff_updates',
        'status',
        'last_login_at',
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
        'last_login_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'email_notifications' => 'boolean',
        'marketing_emails' => 'boolean',
        'security_alerts' => 'boolean',
        'staff_updates' => 'boolean',
        'password' => 'hashed',
    ];

    /**
     * Get the profile picture URL.
     */
    protected function profilePictureUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->profile_picture 
                ? asset('storage/' . $this->profile_picture)
                : null
        );
    }

    /**
     * Get the initials for the staff member.
     */
    protected function initials(): Attribute
    {
        return Attribute::make(
            get: fn () => collect(explode(' ', $this->name))
                ->map(fn ($word) => substr($word, 0, 1))
                ->take(2)
                ->implode('')
        );
    }

    /**
     * Check if the staff member is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the staff member can manage other staff.
     */
    public function canManageStaff(): bool
    {
        return in_array($this->role, ['admin', 'manager', 'supervisor']);
    }

    /**
     * Get the role display name.
     */
    protected function roleDisplayName(): Attribute
    {
        return Attribute::make(
            get: fn () => match($this->role) {
                'admin' => 'Administrator',
                'customer_service' => 'Customer Service',
                'developer' => 'Developer',
                'marketing' => 'Marketing',
                'manager' => 'Manager',
                'supervisor' => 'Supervisor',
                default => ucfirst($this->role)
            }
        );
    }

    /**
     * Scope a query to only include active staff.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include admins.
     */
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }
}
