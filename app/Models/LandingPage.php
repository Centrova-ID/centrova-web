<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LandingPage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'headline', 'subheadline', 'content',
        'target_keyword', 'service_type', 'featured_image',
        'sections', 'cta',
        'meta_title', 'meta_description', 'meta_keywords',
        'status', 'published_at',
    ];

    protected $casts = [
        'sections' => 'json',
        'cta' => 'json',
        'published_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    public function getUrlAttribute(): string
    {
        return url('/lp/' . $this->slug);
    }
}
