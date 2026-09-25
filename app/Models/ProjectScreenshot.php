<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectScreenshot extends Model
{
    protected $fillable = ['project_id', 'image', 'alt_text', 'title', 'sort_order'];

    protected $casts = ['sort_order' => 'integer'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
