<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Blog\Database\Factories\BlogAdminFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class BlogAdmin extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'blog_admins';

    protected $fillable = [
        'name',
        'username',
        'phone',
        'email',
        'password',
        'avatar',
        'status',
        'role',
        'last_login_ip',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // protected static function newFactory(): BlogAdminFactory
    // {
    //     // return BlogAdminFactory::new();
    // }
}
