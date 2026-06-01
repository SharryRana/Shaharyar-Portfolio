<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCommentReaction extends Model
{
    protected $fillable = [
        'article_comment_id',
        'fingerprint',
        'reaction',
    ];

    public function comment()
    {
        return $this->belongsTo(ArticleComment::class, 'article_comment_id');
    }
}
