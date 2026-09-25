<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServicePageController extends Controller
{
    public function index()
    {
        $services = Service::active()
            ->orderBy('sort_order')
            ->get();

        return view('frontend.services.index', compact('services'));
    }

    public function show(string $slug)
    {
        $service = Service::active()
            ->where('slug', $slug)
            ->with('faqs')
            ->firstOrFail();

        $otherServices = Service::active()
            ->where('id', '!=', $service->id)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        return view('frontend.services.show', compact('service', 'otherServices'));
    }
}
