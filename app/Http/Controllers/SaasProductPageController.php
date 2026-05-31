<?php

namespace App\Http\Controllers;

use App\Models\SaasProduct;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class SaasProductPageController extends Controller
{
    public function show(Request $request, string $slug)
    {
        $product = SaasProduct::active()
            ->where('slug', $slug)
            ->with('features', 'screenshots', 'faqs', 'pricingPlans.countryPrices')
            ->firstOrFail();

        $pricingContext = $this->detectPricingCountry($request);
        $localizedPrices = $this->localizedPrices($product, $pricingContext);

        return view('frontend.saas-products.show', compact('product', 'pricingContext', 'localizedPrices'));
    }

    private function localizedPrices(SaasProduct $product, array $pricingContext): array
    {
        $countryCode = $pricingContext['country_code'];
        $countryName = $pricingContext['country_name'];

        return $product->pricingPlans->mapWithKeys(function ($plan) use ($countryCode, $countryName) {
            $countryPrice = $plan->countryPrices->first(function ($price) use ($countryCode, $countryName) {
                return ($countryCode && strtoupper((string) $price->country_code) === $countryCode)
                    || ($countryName && strcasecmp((string) $price->country_name, $countryName) === 0);
            });

            return [
                $plan->id => [
                    'currency' => $countryPrice?->currency ?: $plan->currency,
                    'price' => $countryPrice?->price ?: $plan->price,
                    'country_name' => $countryPrice?->country_name ?: $countryName,
                    'country_code' => $countryPrice?->country_code ?: $countryCode,
                    'is_localized' => (bool) $countryPrice,
                ],
            ];
        })->all();
    }

    private function detectPricingCountry(Request $request): array
    {
        $headerCountryCode = strtoupper((string) $request->header('CF-IPCountry', ''));
        if ($headerCountryCode && $headerCountryCode !== 'XX') {
            return [
                'country_code' => $headerCountryCode,
                'country_name' => $this->countryNameFromCode($headerCountryCode),
                'detected' => true,
            ];
        }

        $ip = $request->server('HTTP_X_FORWARDED_FOR')
            ?? $request->server('HTTP_CLIENT_IP')
            ?? $request->server('HTTP_X_REAL_IP')
            ?? $request->ip();

        if ($ip && str_contains($ip, ',')) {
            $ip = trim(explode(',', $ip)[0]);
        }

        $location = $ip ? Location::get($ip) : null;
        if (!$location || !is_object($location)) {
            $location = null;
        }

        $countryCode = strtoupper((string) ($location?->countryCode ?? ''));
        $countryName = $location?->countryName;

        return [
            'country_code' => $countryCode ?: null,
            'country_name' => $countryName ?: null,
            'detected' => (bool) ($countryCode || $countryName),
        ];
    }

    private function countryNameFromCode(string $countryCode): ?string
    {
        return [
            'PK' => 'Pakistan',
            'AE' => 'UAE',
            'US' => 'United States',
            'GB' => 'United Kingdom',
            'CA' => 'Canada',
            'AU' => 'Australia',
            'IN' => 'India',
        ][$countryCode] ?? null;
    }
}
