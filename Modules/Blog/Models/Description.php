<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    protected $fillable = ['title', 'content', 'is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
