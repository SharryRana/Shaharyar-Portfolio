<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Blog\Models\BlogCategory;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('blog::Category.category');
    }

    public function admin_index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::whereNull('parent_id')->get();

        return view('blog::admin.category.category', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:blog_categories,id',
            'order' => 'integer|min:0',
            'status' => 'in:active,inactive',
            'image' => 'nullable|image|max:2048'
        ]);



        // Handle image
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blog/categories', 'public');
        }

        // Generate base slug
        $slug = Str::slug($validated['name']);

        // Make sure slug is unique
        $count = BlogCategory::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        $validated['slug'] = $slug;

        $category = BlogCategory::create($validated);

        return response()->json([
            'message' => 'Category created successfully',
            'category' => $category
        ]);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('blog::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('blog::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
