<?php

namespace App\Http\Controllers;

use App\Models\ClientWork;
use App\Models\FeaturedProject;
use App\Models\Project;
use App\Models\SaasProduct;
use App\Models\Service;
use App\Models\Skill;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        $skills = Skill::active()
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        $featuredSaasProducts = SaasProduct::active()
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $featuredProjects = Project::active()
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        $clientWorks = ClientWork::active()
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        $teamMembers = TeamMember::active()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $services = Service::active()
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $testimonials = Testimonial::active()
            ->orderBy('sort_order')
            ->get();

        // Latest 3 published blog articles from Blog module
        $latestArticles = collect();
        if (Schema::hasTable('articles')) {
            try {
                $latestArticles = \Modules\Blog\Models\Article::with('author')
                    ->where('status', 'Published')
                    ->whereNotNull('published_at')
                    ->where('show_on_blog', true)
                    ->latest('published_at')
                    ->take(3)
                    ->get();
            } catch (\Exception $e) {
                $latestArticles = collect();
            }
        }

        return view('frontend.main', compact(
            'skills',
            'featuredSaasProducts',
            'featuredProjects',
            'clientWorks',
            'teamMembers',
            'services',
            'testimonials',
            'latestArticles',
        ));
    }
}
