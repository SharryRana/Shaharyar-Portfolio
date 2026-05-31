<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaasProductPricingPlan extends Model
{
    protected $fillable = ['saas_product_id', 'title', 'price', 'currency', 'duration', 'description', 'cta_label', 'features', 'is_popular', 'status', 'sort_order'];

    protected $casts = [
        'features' => 'array',
        'is_popular' => 'boolean',
        'price' => 'decimal:2',
        'sort_order' => 'integer',
    ];

    public function countryPrices()
    {
        return $this->hasMany(SaasProductCountryPrice::class);
    }
}
