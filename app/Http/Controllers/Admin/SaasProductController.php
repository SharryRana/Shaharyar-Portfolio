<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SaasProduct;
use App\Models\SaasProductCountryPrice;
use App\Models\SaasProductFaq;
use App\Models\SaasProductFeature;
use App\Models\SaasProductPricingPlan;
use App\Models\SaasProductScreenshot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SaasProductController extends Controller
{
    public function index(Request $request)
    {
        $query = SaasProduct::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(fn ($query) => $query
                    ->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%"));
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status));

        $products = $query->orderBy('sort_order')->latest()->paginate(10)->withQueryString();
        $activeCount = SaasProduct::active()->count();
        $inactiveCount = SaasProduct::where('status', 'inactive')->count();

        return view('admin.saas-products.index', compact('products', 'activeCount', 'inactiveCount'));
    }

    public function create()
    {
        $product = new SaasProduct([
            'status' => 'active',
            'sort_order' => (SaasProduct::max('sort_order') ?? 0) + 1,
        ]);

        return view('admin.saas-products.create', compact('product'));
    }

    public function store(Request $request)
    {
        $product = SaasProduct::create($this->validatedData($request));
        $this->syncNestedContent($request, $product);

        return redirect()->route('saas-products.index')->with('success', 'SaaS product added successfully.');
    }

    public function edit(SaasProduct $saasProduct)
    {
        $saasProduct->load('features', 'screenshots', 'faqs', 'pricingPlans.countryPrices');
        $product = $saasProduct;

        return view('admin.saas-products.edit', compact('product'));
    }

    public function update(Request $request, SaasProduct $saasProduct)
    {
        $saasProduct->update($this->validatedData($request, $saasProduct));
        $this->syncNestedContent($request, $saasProduct);

        return redirect()->route('saas-products.index')->with('success', 'SaaS product updated successfully.');
    }

    public function destroy(SaasProduct $saasProduct)
    {
        $this->deleteImage($saasProduct->thumbnail);
        $this->deleteImage($saasProduct->og_image);
        $this->deleteImage($saasProduct->twitter_image);
        foreach ($saasProduct->screenshots as $screenshot) {
            $this->deleteImage($screenshot->image);
        }
        $saasProduct->delete();

        return redirect()->route('saas-products.index')->with('success', 'SaaS product deleted successfully.');
    }

    public function toggleStatus(SaasProduct $saasProduct)
    {
        $saasProduct->update(['status' => $saasProduct->status === 'active' ? 'inactive' : 'active']);

        return back()->with('success', 'SaaS product status updated successfully.');
    }

    private function validatedData(Request $request, ?SaasProduct $product = null): array
    {
        $slug = $request->input('slug') ?: Str::slug($request->input('title', ''));
        $request->merge(['slug' => $slug]);

        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('saas_products', 'slug')->ignore($product?->id)],
            'tagline' => ['nullable', 'string', 'max:255'],
            'overview' => ['required', 'string', 'max:4000'],
            'how_it_works' => ['nullable', 'string', 'max:4000'],
            'access_instructions' => ['nullable', 'string', 'max:4000'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'thumbnail_alt' => ['nullable', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'demo_url' => ['nullable', 'url', 'max:255'],
            'video_url' => ['nullable', 'url', 'max:255', function ($attribute, $value, $fail) {
                if ($value && !$this->videoEmbedUrl($value)) {
                    $fail('Please enter a supported YouTube, Vimeo, or direct MP4 video URL.');
                }
            }],
            'benefits' => ['nullable', 'string', 'max:4000'],
            'use_cases' => ['nullable', 'string', 'max:4000'],
            'tech_stack' => ['nullable', 'string', 'max:2000'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:active,inactive'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'canonical_url' => ['nullable', 'url', 'max:255'],
            'og_title' => ['nullable', 'string', 'max:255'],
            'og_description' => ['nullable', 'string', 'max:500'],
            'og_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'twitter_title' => ['nullable', 'string', 'max:255'],
            'twitter_description' => ['nullable', 'string', 'max:500'],
            'twitter_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'product_schema_json' => ['nullable', 'string', 'max:8000'],
            'focus_keyword' => ['nullable', 'string', 'max:255'],
            'features' => ['nullable'],
            'features.*.title' => ['nullable', 'string', 'max:255'],
            'features.*.description' => ['nullable', 'string', 'max:1000'],
            'features.*.icon' => ['nullable', 'string', 'max:255'],
            'features.*.sort_order' => ['nullable', 'integer', 'min:0'],
            'faqs' => ['nullable'],
            'faqs.*.question' => ['nullable', 'string', 'max:255'],
            'faqs.*.answer' => ['nullable', 'string', 'max:2000'],
            'faqs.*.sort_order' => ['nullable', 'integer', 'min:0'],
            'pricing_plans' => ['nullable'],
            'pricing_plans.*.key' => ['nullable', 'string', 'max:80'],
            'pricing_plans.*.title' => ['nullable', 'string', 'max:255'],
            'pricing_plans.*.price' => ['nullable', 'numeric', 'min:0'],
            'pricing_plans.*.currency' => ['nullable', 'string', 'max:10'],
            'pricing_plans.*.duration' => ['nullable', 'string', 'max:255'],
            'pricing_plans.*.description' => ['nullable', 'string', 'max:1000'],
            'pricing_plans.*.cta_label' => ['nullable', 'string', 'max:255'],
            'pricing_plans.*.features' => ['nullable', 'string', 'max:2000'],
            'pricing_plans.*.is_popular' => ['nullable', 'boolean'],
            'pricing_plans.*.status' => ['nullable', 'in:active,inactive'],
            'pricing_plans.*.sort_order' => ['nullable', 'integer', 'min:0'],
            'country_prices' => ['nullable'],
            'country_prices.*.plan_key' => ['nullable', 'string', 'max:80'],
            'country_prices.*.plan_title' => ['nullable', 'string', 'max:255'],
            'country_prices.*.country_code' => ['nullable', 'string', 'max:10'],
            'country_prices.*.country_name' => ['nullable', 'string', 'max:255'],
            'country_prices.*.currency' => ['nullable', 'string', 'max:10'],
            'country_prices.*.price' => ['nullable', 'numeric', 'min:0'],
            'screenshots.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ];

        $attributes = [
            'title' => 'product name',
            'slug' => 'SEO slug',
            'overview' => 'product overview',
            'video_url' => 'video URL',
            'thumbnail' => 'thumbnail',
            'screenshots.*' => 'screenshot',
            'pricing_plans.*.title' => 'plan name',
            'pricing_plans.*.price' => 'price',
            'pricing_plans.*.currency' => 'currency',
            'pricing_plans.*.duration' => 'duration',
            'pricing_plans.*.description' => 'plan description',
            'pricing_plans.*.cta_label' => 'CTA text',
            'pricing_plans.*.features' => 'features list',
            'country_prices.*.country_code' => 'country code',
            'country_prices.*.country_name' => 'country name',
            'country_prices.*.currency' => 'currency',
            'country_prices.*.price' => 'country price',
            'meta_title' => 'meta title',
            'meta_description' => 'meta description',
            'og_description' => 'Open Graph description',
            'twitter_description' => 'Twitter card description',
        ];

        $data = $request->validate($rules, [], $attributes);

        $data['slug'] = Str::slug($data['slug']);
        $data['benefits'] = $this->linesToArray($request->input('benefits'));
        $data['use_cases'] = $this->linesToArray($request->input('use_cases'));
        $data['tech_stack'] = $this->linesToArray($request->input('tech_stack'));

        foreach (['thumbnail', 'og_image', 'twitter_image'] as $field) {
            if ($request->hasFile($field)) {
                $this->deleteImage($product?->{$field});
                $data[$field] = $this->storeImage($request->file($field));
            } else {
                unset($data[$field]);
            }
        }

        return $data;
    }

    private function syncNestedContent(Request $request, SaasProduct $product): void
    {
        $product->features()->delete();
        foreach ($this->featureRows($request->input('features')) as $index => $feature) {
            $title = trim($feature['title'] ?? '');
            if ($title) {
                SaasProductFeature::create([
                    'saas_product_id' => $product->id,
                    'title' => $title,
                    'description' => $feature['description'] ?? null,
                    'icon' => $feature['icon'] ?? null,
                    'sort_order' => $feature['sort_order'] ?? $index + 1,
                ]);
            }
        }

        $product->faqs()->delete();
        foreach ($this->faqRows($request->input('faqs')) as $index => $faq) {
            $question = trim($faq['question'] ?? '');
            $answer = trim($faq['answer'] ?? '');
            if ($question && $answer) {
                SaasProductFaq::create([
                    'saas_product_id' => $product->id,
                    'question' => $question,
                    'answer' => $answer,
                    'sort_order' => $faq['sort_order'] ?? $index + 1,
                ]);
            }
        }

        $product->pricingPlans()->delete();
        $plansByKey = [];
        $plansByTitle = [];
        foreach ($this->pricingRows($request->input('pricing_plans')) as $index => $pricing) {
            $title = trim($pricing['title'] ?? '');
            if ($title) {
                $plan = SaasProductPricingPlan::create([
                    'saas_product_id' => $product->id,
                    'title' => $title,
                    'price' => is_numeric($pricing['price'] ?? null) ? $pricing['price'] : 0,
                    'currency' => ($pricing['currency'] ?? null) ?: 'USD',
                    'duration' => $pricing['duration'] ?? null,
                    'description' => $pricing['description'] ?? null,
                    'cta_label' => ($pricing['cta_label'] ?? null) ?: 'Get Started',
                    'features' => $this->listToArray($pricing['features'] ?? null),
                    'is_popular' => !empty($pricing['is_popular']),
                    'status' => $pricing['status'] ?? 'active',
                    'sort_order' => $pricing['sort_order'] ?? $index + 1,
                ]);
                $plansByKey[(string) ($pricing['key'] ?? $index)] = $plan;
                $plansByTitle[Str::lower($title)] = $plan;
            }
        }

        foreach ($this->countryPriceRows($request->input('country_prices')) as $row) {
            $planKey = (string) ($row['plan_key'] ?? '');
            $planTitle = trim($row['plan_title'] ?? '');
            if (!$planTitle) {
                $planTitle = $plansByKey[$planKey]->title ?? '';
            }
            $plan = $plansByKey[$planKey] ?? ($plansByTitle[Str::lower($planTitle)] ?? null);
            if ($plan && !empty($row['country_name']) && !empty($row['currency']) && is_numeric($row['price'] ?? null)) {
                SaasProductCountryPrice::create([
                    'saas_product_pricing_plan_id' => $plan->id,
                    'country_code' => $row['country_code'] ?? null,
                    'country_name' => $row['country_name'],
                    'currency' => $row['currency'],
                    'price' => $row['price'],
                ]);
            }
        }

        foreach ($request->input('existing_screenshots', []) as $id => $data) {
            $screenshot = $product->screenshots()->find($id);
            if (!$screenshot) {
                continue;
            }
            if (!empty($data['delete'])) {
                $this->deleteImage($screenshot->image);
                $screenshot->delete();
                continue;
            }
            $screenshot->update([
                'alt_text' => $data['alt_text'] ?? null,
                'title' => $data['title'] ?? null,
                'sort_order' => $data['sort_order'] ?? 0,
            ]);
        }

        foreach ($request->file('screenshots', []) as $index => $file) {
            SaasProductScreenshot::create([
                'saas_product_id' => $product->id,
                'image' => $this->storeImage($file),
                'alt_text' => $request->input("screenshot_alt.{$index}") ?: $product->title . ' screenshot',
                'title' => $request->input("screenshot_title.{$index}") ?: $product->title,
                'sort_order' => $product->screenshots()->max('sort_order') + 1,
            ]);
        }
    }

    private function linesToArray(?string $value): array
    {
        return $this->rows($value);
    }

    private function listToArray(?string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n|,/', (string) $value))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    private function featureRows($value): array
    {
        if (is_array($value)) {
            return array_values($value);
        }

        return collect($this->rows($value))->map(function ($row) {
            [$title, $description, $icon] = array_pad(array_map('trim', explode('|', $row, 3)), 3, null);
            return compact('title', 'description', 'icon');
        })->all();
    }

    private function faqRows($value): array
    {
        if (is_array($value)) {
            return array_values($value);
        }

        return collect($this->rows($value))->map(function ($row) {
            [$question, $answer] = array_pad(array_map('trim', explode('|', $row, 2)), 2, null);
            return compact('question', 'answer');
        })->all();
    }

    private function pricingRows($value): array
    {
        if (is_array($value)) {
            return array_values($value);
        }

        return collect($this->rows($value))->map(function ($row, $index) {
            [$title, $price, $currency, $duration, $ctaLabel, $features] = array_pad(array_map('trim', explode('|', $row, 6)), 6, null);
            return [
                'key' => 'legacy-' . $index,
                'title' => $title,
                'price' => $price,
                'currency' => $currency ?: 'USD',
                'duration' => $duration,
                'cta_label' => $ctaLabel,
                'features' => $features,
                'status' => 'active',
                'sort_order' => $index + 1,
            ];
        })->all();
    }

    private function countryPriceRows($value): array
    {
        if (is_array($value)) {
            return array_values($value);
        }

        return collect($this->rows($value))->map(function ($row) {
            [$planTitle, $countryCode, $countryName, $currency, $price] = array_pad(array_map('trim', explode('|', $row, 5)), 5, null);
            return compact('planTitle', 'countryCode', 'countryName', 'currency', 'price');
        })->map(fn ($row) => [
            'plan_title' => $row['planTitle'],
            'country_code' => $row['countryCode'],
            'country_name' => $row['countryName'],
            'currency' => $row['currency'],
            'price' => $row['price'],
        ])->all();
    }

    private function rows(?string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $value))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    private function storeImage($file): string
    {
        $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/saas-products'), $fileName);

        return 'uploads/saas-products/' . $fileName;
    }

    private function deleteImage(?string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }

    private function videoEmbedUrl(?string $url): ?string
    {
        if (!$url) {
            return null;
        }

        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/shorts\/)([A-Za-z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        if (preg_match('/vimeo\.com\/(?:video\/)?([0-9]+)/', $url, $matches)) {
            return 'https://player.vimeo.com/video/' . $matches[1];
        }

        if (preg_match('/\.mp4(?:\?.*)?$/i', $url)) {
            return $url;
        }

        return null;
    }
}
