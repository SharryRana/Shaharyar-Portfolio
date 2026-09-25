<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'company', 'role', 'location', 'employment_type', 'start_date', 'end_date',
        'is_current', 'description', 'highlights', 'technologies',
        'company_url', 'company_logo', 'sort_order', 'is_visible',
    ];

    protected $casts = [
        'highlights'   => 'array',
        'technologies' => 'array',
        'is_current'   => 'boolean',
        'is_visible'   => 'boolean',
        'start_date'   => 'date',
        'end_date'     => 'date',
        'sort_order'   => 'integer',
    ];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function getDurationAttribute(): string
    {
        $start = $this->start_date;
        $end = $this->is_current ? now() : $this->end_date;
        if (!$start || !$end) return '';
        $months = $start->diffInMonths($end);
        $years = intdiv($months, 12);
        $rem = $months % 12;
        $parts = [];
        if ($years > 0) $parts[] = $years . ' yr' . ($years > 1 ? 's' : '');
        if ($rem > 0) $parts[] = $rem . ' mo';
        return implode(' ', $parts) ?: '< 1 mo';
    }
}
