<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    protected $fillable = [
        'article_id',
        'name',
        'email',
        'message',
        'status',
        'ip_address',
        'user_agent',
        'visitor_key',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function reactions()
    {
        return $this->hasMany(ArticleCommentReaction::class);
    }
}
