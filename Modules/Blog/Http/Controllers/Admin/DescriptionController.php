<?php

namespace Modules\Blog\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Blog\Models\Description;
use Illuminate\Http\Request;

class DescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $descriptions = Description::orderBy('order')->get();
        return view('blog::admin.descriptions.index', compact('descriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog::admin.descriptions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        Description::create($validated);

        return redirect()->route('blog-admin.descriptions.index')->with('success', 'Description created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Description $description)
    {
        return view('blog::admin.descriptions.edit', compact('description'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Description $description)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $description->update($validated);

        return redirect()->route('blog-admin.descriptions.index')->with('success', 'Description updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Description $description)
    {
        $description->delete();
        return redirect()->route('blog-admin.descriptions.index')->with('success', 'Description deleted successfully!');
    }
}
