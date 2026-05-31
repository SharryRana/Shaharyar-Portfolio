<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaasProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'tagline', 'overview', 'how_it_works', 'access_instructions',
        'thumbnail', 'thumbnail_alt', 'icon', 'category', 'demo_url', 'video_url',
        'benefits', 'use_cases', 'tech_stack', 'sort_order', 'status',
        'meta_title', 'meta_description', 'meta_keywords', 'canonical_url',
        'og_title', 'og_description', 'og_image', 'twitter_title',
        'twitter_description', 'twitter_image', 'product_schema_json', 'focus_keyword',
    ];

    protected $casts = [
        'benefits' => 'array',
        'use_cases' => 'array',
        'tech_stack' => 'array',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function features()
    {
        return $this->hasMany(SaasProductFeature::class)->orderBy('sort_order');
    }

    public function screenshots()
    {
        return $this->hasMany(SaasProductScreenshot::class)->orderBy('sort_order');
    }

    public function faqs()
    {
        return $this->hasMany(SaasProductFaq::class)->orderBy('sort_order');
    }

    public function pricingPlans()
    {
        return $this->hasMany(SaasProductPricingPlan::class)->orderBy('sort_order');
    }

    public function getVideoEmbedUrlAttribute(): ?string
    {
        if (!$this->video_url) {
            return null;
        }

        if (str_contains($this->video_url, 'youtube.com/watch')) {
            parse_str(parse_url($this->video_url, PHP_URL_QUERY) ?: '', $query);
            return isset($query['v']) ? 'https://www.youtube.com/embed/' . $query['v'] : $this->video_url;
        }

        if (str_contains($this->video_url, 'youtu.be/')) {
            return 'https://www.youtube.com/embed/' . basename(parse_url($this->video_url, PHP_URL_PATH));
        }

        return $this->video_url;
    }
}
