<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseStudy extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'client_name', 'industry', 'service_type',
        'challenge', 'solution', 'results', 'content',
        'featured_image', 'gallery', 'testimonial', 'metrics',
        'meta_title', 'meta_description',
        'status', 'published_at', 'view_count',
    ];

    protected $casts = [
        'gallery' => 'json',
        'testimonial' => 'json',
        'metrics' => 'json',
        'published_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    public function getUrlAttribute(): string
    {
        return url('/case-studies/' . $this->slug);
    }
}
