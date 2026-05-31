<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    public const CATEGORY_GENERAL = 'general';
    public const CATEGORY_ADVERTISER = 'advertiser';
    public const CATEGORY_PUBLISHER = 'publisher';

    protected $fillable = ['category', 'question', 'answer', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function categories(): array
    {
        return [
            self::CATEGORY_GENERAL => 'General',
            self::CATEGORY_ADVERTISER => 'For Advertisers',
            self::CATEGORY_PUBLISHER => 'For Publishers',
        ];
    }
}
