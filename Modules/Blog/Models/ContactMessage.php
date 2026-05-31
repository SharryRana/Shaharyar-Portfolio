<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'ip_address',
        'user_agent',
        'referrer',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}
