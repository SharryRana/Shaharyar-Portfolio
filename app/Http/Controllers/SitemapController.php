<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\SaasProduct;
use App\Models\Service;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;

class SitemapController extends Controller
{
    public function index()
    {
        $staticPages = [
            ['url' => route('home'),            'priority' => '1.0', 'changefreq' => 'weekly'],
            ['url' => route('about'),           'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('skills'),          'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => route('experience'),      'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => route('saas.index'),      'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('projects.index'),  'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('services.index'),  'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('blog.index'),      'priority' => '0.8', 'changefreq' => 'daily'],
            ['url' => route('faqs'),            'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('privacy'),         'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => route('terms'),           'priority' => '0.5', 'changefreq' => 'yearly'],
            ['url' => route('contact'),         'priority' => '0.6', 'changefreq' => 'yearly'],
        ];

        $saasProducts = SaasProduct::active()
            ->orderBy('sort_order')
            ->get(['slug', 'updated_at']);

        $projects = Project::active()
            ->orderBy('sort_order')
            ->get(['slug', 'updated_at']);

        $services = Service::active()
            ->orderBy('sort_order')
            ->get(['slug', 'updated_at']);

        $articles = collect();
        if (Schema::hasTable('articles')) {
            try {
                $articles = \Modules\Blog\Models\Article::where('status', 'Published')
                    ->whereNotNull('published_at')
                    ->where('show_on_blog', true)
                    ->orderByDesc('published_at')
                    ->get(['slug', 'updated_at']);
            } catch (\Exception $e) {
                $articles = collect();
            }
        }

        $content = view('frontend.sitemap', compact(
            'staticPages', 'saasProducts', 'projects', 'services', 'articles'
        ))->render();

        return Response::make($content, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
        ]);
    }
}
