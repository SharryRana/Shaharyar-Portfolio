<?php

namespace App\Http\Controllers;

use App\Models\SaasProduct;
use Illuminate\Http\Request;

class SaasIndexController extends Controller
{
    public function index(Request $request)
    {
        $query = SaasProduct::active()->orderBy('sort_order');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $products = $query->paginate(12)->withQueryString();

        $categories = SaasProduct::active()
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->sort()
            ->values();

        return view('frontend.saas.index', compact('products', 'categories'));
    }
}
