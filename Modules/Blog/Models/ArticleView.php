<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleView extends Model
{
    protected $fillable = [
        'article_id',
        'visitor_key',
        'ip_address',
        'user_agent',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
