<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaasProductScreenshot extends Model
{
    protected $fillable = ['saas_product_id', 'image', 'alt_text', 'title', 'sort_order'];
}
