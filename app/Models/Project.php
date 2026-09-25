<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'tagline', 'summary', 'overview', 'problem', 'solution',
        'my_role', 'architecture', 'challenges', 'results', 'tech_stack', 'highlights',
        'project_type', 'thumbnail', 'thumbnail_alt', 'demo_url', 'github_url',
        'is_featured', 'project_date', 'sort_order', 'status',
        'meta_title', 'meta_description', 'og_image', 'focus_keyword',
    ];

    protected $casts = [
        'tech_stack'  => 'array',
        'highlights'  => 'array',
        'is_featured' => 'boolean',
        'project_date'=> 'date',
        'sort_order'  => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->active();
    }

    public function screenshots()
    {
        return $this->hasMany(ProjectScreenshot::class)->orderBy('sort_order');
    }
}
