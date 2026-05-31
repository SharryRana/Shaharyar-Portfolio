<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaasProductFeature extends Model
{
    protected $fillable = ['saas_product_id', 'title', 'description', 'icon', 'sort_order'];
}
