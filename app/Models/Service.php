<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name', 'slug', 'icon', 'headline', 'short_description', 'full_content',
        'technologies', 'key_points', 'process_steps', 'sort_order', 'is_active',
        'meta_title', 'meta_description', 'og_image',
    ];

    protected $casts = [
        'technologies'  => 'array',
        'key_points'    => 'array',
        'process_steps' => 'array',
        'is_active'     => 'boolean',
        'sort_order'    => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function faqs()
    {
        return $this->hasMany(ServiceFaq::class)->orderBy('sort_order');
    }
}
