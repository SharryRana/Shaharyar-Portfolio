<?php

namespace Modules\Blog\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    const UPDATED_AT = null;
    protected $fillable = ['user_id', 'description', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
