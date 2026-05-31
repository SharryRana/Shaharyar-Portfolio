<?php

namespace Modules\Blog\Database\Seeders;

use Modules\Blog\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class PlatformSettingsSeeder extends Seeder
{
    /**
     * Seed the default platform settings.
     */
    public function run(): void
    {
        $settings = [
            'site_name' => ['value' => 'Creavibe', 'type' => 'general'],
            'contact_email' => ['value' => 'support@creavibe.com', 'type' => 'general'],
            'home_page_title' => ['value' => 'Creavibe | Digital PR for Publishers', 'type' => 'general'],
            'hero_title' => ['value' => 'Digital PR That Helps Publishers Grow', 'type' => 'general'],
            'hero_subtitle' => ['value' => 'Scale your link building with Creavibe. Buy high DA backlinks, guest posts, and digital PR placements from verified publishers.', 'type' => 'general'],
            'seo_home_title' => ['value' => 'Creavibe | The #1 Marketplace for High-Authority Backlinks & Digital PR', 'type' => 'seo'],
            'seo_home_desc' => ['value' => 'Scale your link building with Creavibe. Buy high DA backlinks, guest posts, and digital PR placements from 35,000+ verified publishers. Fast 48-hour turnaround.', 'type' => 'seo'],
            'seo_home_keywords' => ['value' => 'digital pr, backlinks, guest posts, publishers, creavibe', 'type' => 'seo'],
            'seo_about_title' => ['value' => 'About Us | Creavibe', 'type' => 'seo'],
            'seo_about_desc' => ['value' => 'Learn about Creavibe, our mission, values, and founder.', 'type' => 'seo'],
            'seo_contact_title' => ['value' => 'Contact Us | Creavibe', 'type' => 'seo'],
            'seo_contact_desc' => ['value' => 'Get in touch with Creavibe using our inquiry form or contact details.', 'type' => 'seo'],
            'seo_privacy_title' => ['value' => 'Privacy Policy | Creavibe', 'type' => 'seo'],
            'seo_privacy_desc' => ['value' => 'Privacy Policy for Creavibe.', 'type' => 'seo'],
            'seo_terms_title' => ['value' => 'Terms & Conditions | Creavibe', 'type' => 'seo'],
            'seo_terms_desc' => ['value' => 'Terms and Conditions for Creavibe.', 'type' => 'seo'],
            'seo_faqs_title' => ['value' => 'FAQs | Creavibe', 'type' => 'seo'],
            'seo_faqs_desc' => ['value' => 'Frequently asked questions about Creavibe.', 'type' => 'seo'],
            'seo_what_is_creavibe_title' => ['value' => 'What Is Creavibe? | Creavibe', 'type' => 'seo'],
            'seo_what_is_creavibe_desc' => ['value' => 'Learn what Creavibe is, how content publication works, and view Creavibe company registration details.', 'type' => 'seo'],
            'seo_blog_title' => ['value' => 'Blog | Creavibe', 'type' => 'seo'],
            'seo_blog_desc' => ['value' => 'SEO tips, link building techniques, tricks, strategies, and case studies from Creavibe.', 'type' => 'seo'],
        ];

        foreach ($settings as $key => $data) {
            Setting::updateOrCreate(['key' => $key], $data);
        }

        Cache::forget('site_settings');
    }
}
