<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    
    protected $fillable = [
        'ip',
        'user_agent',
        'referrer',
        'country',
        'city',
        'status'
    ];
}
