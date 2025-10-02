<?php

namespace Modules\BlogAdmin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Blog\Database\Factories\PostsFactory;

class posts extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): PostsFactory
    // {
    //     // return PostsFactory::new();
    // }
}
