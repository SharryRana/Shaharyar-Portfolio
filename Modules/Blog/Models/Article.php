<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public const CATEGORY_PUBLISHER = 'Publisher';

    public const CATEGORY_ADVERTISER = 'Advertiser';

    public const CATEGORY_LINK_BUILDING = 'Link Building';

    protected $fillable = [
        'title', 'slug', 'category', 'excerpt', 'content', 'image',
        'image_title', 'image_alt_text', 'image_description', 'image_caption',
        'author_id', 'blog_category_id',
        'author_name', 'author_avatar', 'author_signature', 'status', 'published_at',
        'meta_title', 'meta_description', 'meta_keywords',
        'view_count', 'show_on_blog', 'is_trending',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'show_on_blog' => 'boolean',
        'is_trending' => 'boolean',
    ];

    public static function categories(): array
    {
        return [
            self::CATEGORY_PUBLISHER,
            self::CATEGORY_ADVERTISER,
            self::CATEGORY_LINK_BUILDING,
        ];
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function comments()
    {
        return $this->hasMany(ArticleComment::class);
    }

    public function approvedComments()
    {
        return $this->comments()->where('status', 'approved');
    }

    public function helpfulVotes()
    {
        return $this->hasMany(ArticleHelpfulVote::class);
    }

    public function uniqueViews()
    {
        return $this->hasMany(ArticleView::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class)->withTrashed();
    }

    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class)->withTrashed();
    }

    public function getDisplayCategoryAttribute(): string
    {
        return $this->blogCategory?->name ?: ($this->category ?: self::CATEGORY_LINK_BUILDING);
    }

    public function incrementViews()
    {
        $this->increment('view_count');
    }
}
