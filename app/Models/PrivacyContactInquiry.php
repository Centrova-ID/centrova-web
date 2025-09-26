<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyContactInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
        'inquiry_type',
        'subject',
        'message',
        'status',
        'submitted_at',
        'responded_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'responded_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getInquiryTypeDisplayAttribute()
    {
        $types = [
            'data_access' => 'Akses Data',
            'data_correction' => 'Koreksi Data',
            'data_deletion' => 'Penghapusan Data',
            'data_portability' => 'Portabilitas Data',
            'marketing_opt_out' => 'Berhenti dari Pemasaran',
            'privacy_policy' => 'Pertanyaan Kebijakan Privasi',
            'data_processing' => 'Proses Data',
            'security_concern' => 'Kekhawatiran Keamanan',
            'other' => 'Lainnya',
        ];

        return $types[$this->inquiry_type] ?? $this->inquiry_type;
    }
}
