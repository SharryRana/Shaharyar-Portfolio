<?php

namespace Modules\Blog\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Blog\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'in:'.implode(',', array_keys(Faq::categories()))],
            'status' => ['nullable', 'string', 'in:active,inactive'],
        ]);

        $faqs = Faq::query()
            ->when($filters['search'] ?? null, function ($query, string $search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where('question', 'like', '%'.$search.'%')
                        ->orWhere('answer', 'like', '%'.$search.'%');
                });
            })
            ->when($filters['category'] ?? null, fn ($query, string $category) => $query->where('category', $category))
            ->when(($filters['status'] ?? null) === 'active', fn ($query) => $query->where('is_active', true))
            ->when(($filters['status'] ?? null) === 'inactive', fn ($query) => $query->where('is_active', false))
            ->orderBy('category')
            ->orderBy('order')
            ->paginate(15)
            ->withQueryString();

        return view('blog::admin.faqs.index', [
            'faqs' => $faqs,
            'categories' => Faq::categories(),
            'filters' => $filters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Faq::categories();
        $categoryStats = $this->categoryStats();

        return view('blog::admin.faqs.create', compact('categories', 'categoryStats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|in:' . implode(',', array_keys(Faq::categories())),
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        Faq::create($validated);

        return redirect()->route('blog-admin.faqs.index')->with('success', 'FAQ created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        $categories = Faq::categories();
        $categoryStats = $this->categoryStats($faq);

        return view('blog::admin.faqs.edit', compact('faq', 'categories', 'categoryStats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'category' => 'required|string|in:' . implode(',', array_keys(Faq::categories())),
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $faq->update($validated);

        return redirect()->route('blog-admin.faqs.index')->with('success', 'FAQ updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('blog-admin.faqs.index')->with('success', 'FAQ deleted successfully!');
    }

    private function categoryStats(?Faq $currentFaq = null): array
    {
        $stats = [];

        foreach (Faq::categories() as $category => $label) {
            $query = Faq::where('category', $category);

            if ($currentFaq) {
                $query->whereKeyNot($currentFaq->id);
            }

            $count = (clone $query)->count();
            $maxOrder = (clone $query)->max('order') ?? 0;

            $stats[$category] = [
                'count' => $count,
                'next_order' => $maxOrder + 1,
            ];
        }

        return $stats;
    }
}
