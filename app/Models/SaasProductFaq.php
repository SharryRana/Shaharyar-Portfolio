<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaasProductFaq extends Model
{
    protected $fillable = ['saas_product_id', 'question', 'answer', 'sort_order'];
}
