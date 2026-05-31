<?php

namespace Modules\Blog\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use Modules\Blog\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('blog::admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $rules = collect($this->settingKeys())
            ->mapWithKeys(fn ($key) => [$key => ['nullable', 'string']])
            ->toArray();

        $data = $request->validate($rules);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value ?? '',
                    'type' => str_starts_with($key, 'seo_') ? 'seo' : 'general',
                ]
            );
        }

        Cache::forget('site_settings');

        return back()->with('success', 'Settings updated successfully! ' . count($data) . ' settings saved.');
    }

    private function settingKeys(): array
    {
        return [
            'site_name',
            'contact_email',
            'home_page_title',
            'hero_title',
            'hero_subtitle',
            'seo_home_title',
            'seo_home_desc',
            'seo_home_keywords',
            'seo_about_title',
            'seo_about_desc',
            'seo_contact_title',
            'seo_contact_desc',
            'seo_privacy_title',
            'seo_privacy_desc',
            'seo_terms_title',
            'seo_terms_desc',
            'seo_faqs_title',
            'seo_faqs_desc',
            'seo_what_is_creavibe_title',
            'seo_what_is_creavibe_desc',
            'seo_blog_title',
            'seo_blog_desc',
        ];
    }
}
