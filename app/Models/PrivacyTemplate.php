<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrivacyTemplate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'subject',
        'content',
        'variables',
        'is_active',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'variables' => 'array',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    // Template types
    const TYPE_DATA_ACCESS_REQUEST = 'data_access_request';
    const TYPE_DATA_DELETION_REQUEST = 'data_deletion_request';
    const TYPE_DATA_PORTABILITY_REQUEST = 'data_portability_request';
    const TYPE_PRIVACY_POLICY_UPDATE = 'privacy_policy_update';
    const TYPE_CONSENT_CONFIRMATION = 'consent_confirmation';
    const TYPE_DATA_BREACH_NOTIFICATION = 'data_breach_notification';

    public static function getTypes()
    {
        return [
            self::TYPE_DATA_ACCESS_REQUEST => 'Data Access Request Response',
            self::TYPE_DATA_DELETION_REQUEST => 'Data Deletion Request Response',
            self::TYPE_DATA_PORTABILITY_REQUEST => 'Data Portability Request Response',
            self::TYPE_PRIVACY_POLICY_UPDATE => 'Privacy Policy Update Notification',
            self::TYPE_CONSENT_CONFIRMATION => 'Consent Confirmation',
            self::TYPE_DATA_BREACH_NOTIFICATION => 'Data Breach Notification'
        ];
    }

    // Relationships
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function requests()
    {
        return $this->hasMany(PrivacyRequest::class, 'template_id');
    }

    // Helper methods
    public function renderContent($variables = [])
    {
        $content = $this->content;
        
        foreach ($variables as $key => $value) {
            $content = str_replace('{{' . $key . '}}', $value, $content);
        }

        return $content;
    }

    public function getDefaultVariables()
    {
        return $this->variables ?? [];
    }
}
