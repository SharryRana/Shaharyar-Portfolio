<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeaturedProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FeaturedProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = FeaturedProject::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status));

        $items = $query->orderBy('sort_order')->latest()->paginate(10)->withQueryString();
        $activeCount = FeaturedProject::active()->count();
        $inactiveCount = FeaturedProject::where('status', 'inactive')->count();

        return view('admin.projects.index', compact('items', 'activeCount', 'inactiveCount'));
    }

    public function create()
    {
        $item = new FeaturedProject([
            'status' => 'active',
            'sort_order' => (FeaturedProject::max('sort_order') ?? 0) + 1,
        ]);

        return view('admin.projects.create', compact('item'));
    }

    public function store(Request $request)
    {
        FeaturedProject::create($this->validatedData($request));

        return redirect()->route('featured-projects.index')->with('success', 'Featured project added successfully.');
    }

    public function edit(FeaturedProject $featuredProject)
    {
        $item = $featuredProject;

        return view('admin.projects.edit', compact('item'));
    }

    public function update(Request $request, FeaturedProject $featuredProject)
    {
        $featuredProject->update($this->validatedData($request, $featuredProject));

        return redirect()->route('featured-projects.index')->with('success', 'Featured project updated successfully.');
    }

    public function destroy(FeaturedProject $featuredProject)
    {
        $this->deleteImage($featuredProject->image);
        $featuredProject->delete();

        return redirect()->route('featured-projects.index')->with('success', 'Featured project deleted successfully.');
    }

    public function toggleStatus(FeaturedProject $featuredProject)
    {
        $featuredProject->update(['status' => $featuredProject->status === 'active' ? 'inactive' : 'active']);

        return back()->with('success', 'Featured project status updated successfully.');
    }

    private function validatedData(Request $request, ?FeaturedProject $project = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1500'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'icon' => ['nullable', 'string', 'max:255'],
            'tags' => ['nullable', 'string', 'max:1000'],
            'category' => ['nullable', 'string', 'max:255'],
            'project_link' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $data['tags'] = $this->linesToArray($request->input('tags'));

        if ($request->hasFile('image')) {
            $this->deleteImage($project?->image);
            $data['image'] = $this->storeImage($request, 'projects');
        } else {
            unset($data['image']);
        }

        return $data;
    }

    private function linesToArray(?string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $value))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    private function storeImage(Request $request, string $folder): string
    {
        $file = $request->file('image');
        $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path("uploads/{$folder}"), $fileName);

        return "uploads/{$folder}/" . $fileName;
    }

    private function deleteImage(?string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
