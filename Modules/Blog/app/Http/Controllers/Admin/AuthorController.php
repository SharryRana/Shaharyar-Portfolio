<?php

namespace Modules\Blog\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Blog\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'in:active,inactive'],
        ]);

        $authors = Author::withCount('articles')
            ->when($filters['search'] ?? null, function ($query, string $search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where('name', 'like', '%'.$search.'%')
                        ->orWhere('designation', 'like', '%'.$search.'%')
                        ->orWhere('bio', 'like', '%'.$search.'%');
                });
            })
            ->when(($filters['status'] ?? null) === 'active', fn ($query) => $query->where('is_active', true))
            ->when(($filters['status'] ?? null) === 'inactive', fn ($query) => $query->where('is_active', false))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('blog::admin.authors.index', [
            'authors' => $authors,
            'filters' => $filters,
        ]);
    }

    public function create()
    {
        return view('blog::admin.authors.create', ['author' => new Author(['is_active' => true])]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateAuthor($request);

        if ($request->hasFile('avatar_file')) {
            $validated['avatar'] = $this->uploadPublicImage($request, 'avatar_file', 'uploads/authors');
        }

        if ($request->hasFile('signature_file')) {
            $validated['signature'] = $this->uploadPublicImage($request, 'signature_file', 'uploads/signatures');
        }

        $validated['is_active'] = $request->has('is_active');
        unset($validated['avatar_file'], $validated['signature_file']);

        $author = Author::create($validated);

        recordActivity('Created author: '.$author->name, 'author_created');

        return redirect()->route('blog-admin.authors.index')->with('success', 'Author created successfully');
    }

    public function edit(Author $author)
    {
        return view('blog::admin.authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $validated = $this->validateAuthor($request);

        if ($request->hasFile('avatar_file')) {
            $validated['avatar'] = $this->uploadPublicImage($request, 'avatar_file', 'uploads/authors');
        }

        if ($request->hasFile('signature_file')) {
            $validated['signature'] = $this->uploadPublicImage($request, 'signature_file', 'uploads/signatures');
        }

        $validated['is_active'] = $request->has('is_active');
        unset($validated['avatar_file'], $validated['signature_file']);

        $author->update($validated);

        recordActivity('Updated author: '.$author->name, 'author_updated');

        return redirect()->route('blog-admin.authors.index')->with('success', 'Author updated successfully');
    }

    public function toggleStatus(Author $author)
    {
        $author->update(['is_active' => ! $author->is_active]);

        recordActivity(($author->is_active ? 'Activated author: ' : 'Deactivated author: ').$author->name, 'author_status_updated');

        return back()->with('success', 'Author status updated successfully');
    }

    public function destroy(Author $author)
    {
        $name = $author->name;
        $author->delete();

        recordActivity('Deleted author: '.$name, 'author_deleted');

        return redirect()->route('blog-admin.authors.index')->with('success', 'Author deleted successfully');
    }

    private function validateAuthor(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'avatar_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'signature_file' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'bio' => ['nullable', 'string'],
            'designation' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);
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
}
