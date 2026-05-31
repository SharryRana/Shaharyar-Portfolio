<?php

namespace Modules\Blog\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Blog\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::latest()->paginate(15)->withQueryString();

        return view('blog::admin.blog-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('blog::admin.blog-categories.create', ['category' => new BlogCategory(['is_active' => true])]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateCategory($request);
        $validated['slug'] = $this->uniqueSlug($validated['slug'] ?: $validated['name']);
        $validated['is_active'] = $request->has('is_active');

        $category = BlogCategory::create($validated);

        recordActivity('Created blog category: '.$category->name, 'blog_category_created');

        return redirect()->route('blog-admin.blog-categories.index')->with('success', 'Blog category created successfully');
    }

    public function edit(BlogCategory $blogCategory)
    {
        return view('blog::admin.blog-categories.edit', ['category' => $blogCategory]);
    }

    public function update(Request $request, BlogCategory $blogCategory)
    {
        $validated = $this->validateCategory($request, $blogCategory);
        $validated['slug'] = $this->uniqueSlug($validated['slug'] ?: $validated['name'], $blogCategory->id);
        $validated['is_active'] = $request->has('is_active');

        $blogCategory->update($validated);

        recordActivity('Updated blog category: '.$blogCategory->name, 'blog_category_updated');

        return redirect()->route('blog-admin.blog-categories.index')->with('success', 'Blog category updated successfully');
    }

    public function toggleStatus(BlogCategory $blogCategory)
    {
        $blogCategory->update(['is_active' => ! $blogCategory->is_active]);

        recordActivity(($blogCategory->is_active ? 'Activated blog category: ' : 'Deactivated blog category: ').$blogCategory->name, 'blog_category_status_updated');

        return back()->with('success', 'Blog category status updated successfully');
    }

    public function destroy(BlogCategory $blogCategory)
    {
        $name = $blogCategory->name;
        $blogCategory->delete();

        recordActivity('Deleted blog category: '.$name, 'blog_category_deleted');

        return redirect()->route('blog-admin.blog-categories.index')->with('success', 'Blog category deleted successfully');
    }

    public function resolveSlug(Request $request)
    {
        $request->validate([
            'value' => ['nullable', 'string', 'max:255'],
            'ignore_id' => ['nullable', 'integer'],
        ]);

        return response()->json([
            'slug' => $this->uniqueSlug($request->input('value'), $request->integer('ignore_id') ?: null),
        ]);
    }

    private function validateCategory(Request $request, ?BlogCategory $category = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
            ],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
        ]);
    }

    private function uniqueSlug(?string $value, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug((string) $value) ?: 'category';
        $slug = $baseSlug;
        $suffix = 1;

        while (
            BlogCategory::withTrashed()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
                ->exists()
        ) {
            $slug = $baseSlug.'-'.$suffix;
            $suffix++;
        }

        return $slug;
    }
}
