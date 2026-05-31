<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaasProductCountryPrice extends Model
{
    protected $fillable = ['saas_product_pricing_plan_id', 'country_code', 'country_name', 'currency', 'price'];
}
