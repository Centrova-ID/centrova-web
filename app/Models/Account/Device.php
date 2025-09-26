<?php

namespace App\Models\Account;

use App\Models\Base\AccountModel;

/**
 * Model Device untuk database Account (centrova_account)
 */
class Device extends AccountModel
{
    /**
     * The table associated with the model.
     */
    protected $table = 'devices';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'device_name',
        'device_type',
        'device_os',
        'device_browser',
        'device_ip',
        'last_login',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'last_login' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Relationship dengan user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
