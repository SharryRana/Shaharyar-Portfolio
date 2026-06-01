<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleHelpfulVote extends Model
{
    protected $fillable = [
        'article_id',
        'fingerprint',
        'vote',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
