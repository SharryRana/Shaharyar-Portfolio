<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'experience_label',
        'projects_label',
        'description',
        'mission',
        'profile_image',
        'tags',
        'expertise',
        'stats',
        'phone',
        'email',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'tags' => 'array',
        'expertise' => 'array',
        'stats' => 'array',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
