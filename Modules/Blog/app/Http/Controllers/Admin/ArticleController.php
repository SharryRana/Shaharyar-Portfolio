<?php

namespace Modules\Blog\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Blog\Models\Author;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'in:Published,Draft'],
            'category' => ['nullable', 'string', 'max:255'],
            'author_id' => ['nullable', 'integer'],
            'visibility' => ['nullable', 'string', 'in:listed,hidden'],
            'trending' => ['nullable', 'string', 'in:yes,no'],
        ]);

        $articles = Article::with(['author', 'blogCategory'])
            ->when($filters['search'] ?? null, function ($query, string $search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where('title', 'like', '%'.$search.'%')
                        ->orWhere('slug', 'like', '%'.$search.'%')
                        ->orWhere('excerpt', 'like', '%'.$search.'%')
                        ->orWhere('author_name', 'like', '%'.$search.'%')
                        ->orWhere('category', 'like', '%'.$search.'%')
                        ->orWhereHas('blogCategory', fn ($query) => $query->where('name', 'like', '%'.$search.'%'))
                        ->orWhereHas('author', fn ($query) => $query->where('name', 'like', '%'.$search.'%'));
                });
            })
            ->when($filters['status'] ?? null, fn ($query, string $status) => $query->where('status', $status))
            ->when($filters['category'] ?? null, function ($query, string $category) {
                $query->where(function ($query) use ($category) {
                    $query
                        ->where('category', $category)
                        ->orWhereHas('blogCategory', fn ($query) => $query->where('name', $category));
                });
            })
            ->when($filters['author_id'] ?? null, fn ($query, int $authorId) => $query->where('author_id', $authorId))
            ->when(($filters['visibility'] ?? null) === 'listed', fn ($query) => $query->where('show_on_blog', true))
            ->when(($filters['visibility'] ?? null) === 'hidden', fn ($query) => $query->where('show_on_blog', false))
            ->when(($filters['trending'] ?? null) === 'yes', fn ($query) => $query->where('is_trending', true))
            ->when(($filters['trending'] ?? null) === 'no', fn ($query) => $query->where('is_trending', false))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('blog::admin.articles.index', [
            'articles' => $articles,
            'authors' => Author::withTrashed()->orderBy('name')->get(),
            'categories' => BlogCategory::withTrashed()->orderBy('name')->get(),
            'filters' => $filters,
        ]);
    }

    public function create()
    {
        $categories = $this->categoriesForForm();
        $authors = $this->authorsForForm();

        return view('blog::admin.articles.create', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'blog_category_id' => ['required_without:category', 'nullable', 'integer', 'exists:blog_categories,id'],
            'category' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'content' => 'required',
            'excerpt' => 'nullable',
            'status' => 'required',
            'author_id' => 'required|exists:authors,id',
            'show_on_blog' => 'nullable|boolean',
            'is_trending' => 'nullable|boolean',
            'image' => 'nullable|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_title' => 'nullable|string|max:255',
            'image_alt_text' => 'nullable|string|max:255',
            'image_description' => 'nullable|string',
            'image_caption' => 'nullable|string',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
        ]);

        if ($request->hasFile('image_file')) {
            $validated['image'] = $this->uploadPublicImage($request, 'image_file', 'uploads/articles');
        }

        $category = $this->resolveCategory($validated['blog_category_id'] ?? null, $validated['category'] ?? null);
        $validated['blog_category_id'] = $category->id;
        $validated['category'] = $category->name;
        $validated['content'] = $this->normalizeArticleLinks($validated['content']);
        $validated['slug'] = $this->uniqueSlug($request->input('slug') ?: $request->title);
        $validated['published_at'] = $request->status === 'Published' ? now() : null;
        $validated['show_on_blog'] = $request->has('show_on_blog');
        $validated['is_trending'] = $request->has('is_trending') && $validated['show_on_blog'];

        // Strip upload-only fields from validated data
        unset($validated['image_file']);

        if ($validated['is_trending']) {
            Article::where('is_trending', true)->update(['is_trending' => false]);
        }

        Article::create($validated);

        recordActivity('Published new article: '.$validated['title'], 'article_created');

        return redirect()->route('blog-admin.articles.index')->with('success', 'Article created successfully');
    }

    public function edit(Article $article)
    {
        $categories = $this->categoriesForForm($article);
        $article->load(['author', 'blogCategory']);
        $authors = $this->authorsForForm($article);

        return view('blog::admin.articles.edit', compact('article', 'categories', 'authors'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'blog_category_id' => ['required_without:category', 'nullable', 'integer', 'exists:blog_categories,id'],
            'category' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'content' => 'required',
            'excerpt' => 'nullable',
            'status' => 'required',
            'author_id' => 'required|exists:authors,id',
            'show_on_blog' => 'nullable|boolean',
            'is_trending' => 'nullable|boolean',
            'image' => 'nullable|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_title' => 'nullable|string|max:255',
            'image_alt_text' => 'nullable|string|max:255',
            'image_description' => 'nullable|string',
            'image_caption' => 'nullable|string',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
        ]);

        if ($request->hasFile('image_file')) {
            $validated['image'] = $this->uploadPublicImage($request, 'image_file', 'uploads/articles');
        }

        $category = $this->resolveCategory($validated['blog_category_id'] ?? null, $validated['category'] ?? null);
        $validated['blog_category_id'] = $category->id;
        $validated['category'] = $category->name;
        $validated['content'] = $this->normalizeArticleLinks($validated['content']);
        $validated['slug'] = $this->uniqueSlug($request->input('slug') ?: $request->title, $article->id);
        $validated['show_on_blog'] = $request->has('show_on_blog');
        $validated['is_trending'] = $request->has('is_trending') && $validated['show_on_blog'];

        if ($request->status === 'Published' && ! $article->published_at) {
            $validated['published_at'] = now();
        }

        // Strip upload-only fields from validated data
        unset($validated['image_file']);

        if ($validated['is_trending']) {
            Article::whereKeyNot($article->id)->where('is_trending', true)->update(['is_trending' => false]);
        }

        $article->update($validated);

        recordActivity('Updated article: '.$article->title, 'article_updated');

        return redirect()->route('blog-admin.articles.index')->with('success', 'Article updated successfully');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
        ]);

        $path = public_path('uploads/articles');

        if (! is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $file = $request->file('upload');
        $fileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $fileName = ($fileName ?: 'article-image').'_'.time().'.'.$file->getClientOriginalExtension();

        $file->move($path, $fileName);

        $url = '/uploads/articles/'.$fileName;

        return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
    }

    public function resolveSlug(Request $request)
    {
        $request->validate([
            'value' => ['nullable', 'string', 'max:255'],
            'ignore_id' => ['nullable', 'integer'],
        ]);

        $slug = $this->uniqueSlug($request->input('value'), $request->integer('ignore_id') ?: null);

        return response()->json(['slug' => $slug]);
    }

    private function uploadPublicImage(Request $request, string $field, string $directory): string
    {
        $path = public_path($directory);

        if (! is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $file = $request->file($field);
        $imageName = Str::uuid().'.'.$file->extension();
        $file->move($path, $imageName);

        return asset($directory.'/'.$imageName);
    }

    private function uniqueSlug(?string $value, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug((string) $value);
        $baseSlug = $baseSlug !== '' ? $baseSlug : 'article';
        $slug = $baseSlug;
        $suffix = 1;

        while (
            Article::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
                ->exists()
        ) {
            $slug = $baseSlug.'-'.$suffix;
            $suffix++;
        }

        return $slug;
    }

    private function normalizeArticleLinks(string $html): string
    {
        if (! class_exists(\DOMDocument::class)) {
            return $html;
        }

        $previousErrors = libxml_use_internal_errors(true);
        $document = new \DOMDocument('1.0', 'UTF-8');
        $document->loadHTML('<?xml encoding="UTF-8"><div>'.$html.'</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        foreach ($document->getElementsByTagName('a') as $link) {
            $link->removeAttribute('data-link-follow');

            $tokens = preg_split('/\s+/', strtolower((string) $link->getAttribute('rel'))) ?: [];
            $relTokens = collect($tokens)
                ->map(fn ($token) => trim($token))
                ->filter()
                ->reject(fn ($token) => $token === 'dofollow')
                ->values();

            if ($link->getAttribute('target') === '_blank') {
                $relTokens = $relTokens->merge(['noopener', 'noreferrer']);
            } else {
                $link->removeAttribute('target');
                $relTokens = $relTokens->reject(fn ($token) => in_array($token, ['noopener', 'noreferrer'], true));
            }

            $rel = $relTokens->unique()->sort()->implode(' ');

            if ($rel !== '') {
                $link->setAttribute('rel', $rel);
            } else {
                $link->removeAttribute('rel');
            }
        }

        $container = $document->getElementsByTagName('div')->item(0);
        $normalized = '';

        foreach ($container?->childNodes ?? [] as $childNode) {
            $normalized .= $document->saveHTML($childNode);
        }

        libxml_clear_errors();
        libxml_use_internal_errors($previousErrors);

        return $normalized ?: $html;
    }

    private function authorsForForm(?Article $article = null)
    {
        $authors = Author::where('is_active', true)
            ->orderBy('name')
            ->get();

        if ($article?->author && ! $authors->contains('id', $article->author->id)) {
            $authors->push($article->author);
        }

        return $authors->sortBy('name')->values();
    }

    private function categoriesForForm(?Article $article = null)
    {
        $categories = BlogCategory::where('is_active', true)
            ->orderBy('name')
            ->get();

        if ($article?->blogCategory && ! $categories->contains('id', $article->blogCategory->id)) {
            $categories->push($article->blogCategory);
        }

        return $categories->sortBy('name')->values();
    }

    private function resolveCategory(?int $categoryId, ?string $legacyCategory): BlogCategory
    {
        if ($categoryId) {
            return BlogCategory::withTrashed()->findOrFail($categoryId);
        }

        $categoryName = trim((string) $legacyCategory);

        if ($categoryName === '') {
            abort(422, 'Blog category is required.');
        }

        $category = BlogCategory::withTrashed()
            ->where('name', $categoryName)
            ->orWhere('slug', Str::slug($categoryName))
            ->first();

        if ($category) {
            return $category;
        }

        return BlogCategory::create([
            'name' => $categoryName,
            'slug' => $this->uniqueCategorySlug($categoryName),
            'is_active' => true,
        ]);
    }

    private function uniqueCategorySlug(string $value): string
    {
        $baseSlug = Str::slug($value) ?: 'category';
        $slug = $baseSlug;
        $suffix = 1;

        while (BlogCategory::withTrashed()->where('slug', $slug)->exists()) {
            $slug = $baseSlug.'-'.$suffix;
            $suffix++;
        }

        return $slug;
    }

    public function destroy(Article $article)
    {
        $title = $article->title;
        $article->delete();

        recordActivity('Deleted article: '.$title, 'article_deleted');

        return redirect()->route('blog-admin.articles.index')->with('success', 'Article deleted successfully');
    }
}
