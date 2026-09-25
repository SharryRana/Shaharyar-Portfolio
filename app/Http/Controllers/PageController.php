<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\SaasProduct;
use App\Models\Service;
use App\Models\Skill;

class PageController extends Controller
{
    public function about()
    {
        $skills = Skill::active()
            ->orderBy('sort_order')
            ->get();

        $experiences = Experience::visible()
            ->orderBy('sort_order')
            ->orderByDesc('start_date')
            ->take(4)
            ->get();

        return view('frontend.about', compact('skills', 'experiences'));
    }

    public function skills()
    {
        $skills = Skill::active()
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('frontend.skills', compact('skills'));
    }

    public function experience()
    {
        $experiences = Experience::visible()
            ->orderBy('sort_order')
            ->orderByDesc('start_date')
            ->get();

        return view('frontend.experience', compact('experiences'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function faqs()
    {
        $servicesWithFaqs = Service::active()
            ->whereHas('faqs')
            ->with('faqs')
            ->orderBy('sort_order')
            ->get();

        $saasProductsWithFaqs = SaasProduct::active()
            ->whereHas('faqs')
            ->with('faqs')
            ->orderBy('sort_order')
            ->get();

        return view('frontend.faqs', compact('servicesWithFaqs', 'saasProductsWithFaqs'));
    }

    public function privacy()
    {
        return view('frontend.privacy');
    }

    public function terms()
    {
        return view('frontend.terms');
    }
}
