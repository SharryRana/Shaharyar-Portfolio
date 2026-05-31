<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    const UPDATED_AT = null;
    protected $fillable = [
        'ip_address', 'user_agent', 'url', 'method',
        'country', 'region', 'city', 'article_id',
        'referer', 'device_type'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

}
