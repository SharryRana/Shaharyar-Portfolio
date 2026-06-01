<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    protected $fillable = [
        'email',
        'status',
        'ip_address',
        'user_agent',
    ];
}
