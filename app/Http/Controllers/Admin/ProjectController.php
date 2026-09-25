<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectScreenshot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(fn ($query) => $query
                    ->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('project_type', 'like', "%{$search}%"));
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status));

        $items = $query->orderBy('sort_order')->latest()->paginate(10)->withQueryString();
        $activeCount = Project::active()->count();
        $inactiveCount = Project::where('status', 'inactive')->count();

        return view('admin.projects.index', compact('items', 'activeCount', 'inactiveCount'));
    }

    public function create()
    {
        $project = new Project([
            'status'     => 'active',
            'sort_order' => (Project::max('sort_order') ?? 0) + 1,
        ]);

        return view('admin.projects.create', compact('project'));
    }

    public function store(Request $request)
    {
        $project = Project::create($this->validatedData($request));
        $this->syncScreenshots($request, $project);

        return redirect()->route('admin.projects.index')->with('success', 'Project added successfully.');
    }

    public function edit(Project $project)
    {
        $project->load('screenshots');

        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $project->update($this->validatedData($request, $project));
        $this->syncScreenshots($request, $project);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $this->deleteImage($project->thumbnail);
        $this->deleteImage($project->og_image);
        foreach ($project->screenshots as $screenshot) {
            $this->deleteImage($screenshot->image);
        }
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }

    public function toggleStatus(Project $project)
    {
        $project->update(['status' => $project->status === 'active' ? 'inactive' : 'active']);

        return back()->with('success', 'Project status updated successfully.');
    }

    private function validatedData(Request $request, ?Project $project = null): array
    {
        $slug = $request->input('slug') ?: Str::slug($request->input('title', ''));
        $request->merge(['slug' => $slug]);

        $rules = [
            'title'            => ['required', 'string', 'max:255'],
            'slug'             => ['required', 'string', 'max:255', Rule::unique('projects', 'slug')->ignore($project?->id)],
            'tagline'          => ['nullable', 'string', 'max:255'],
            'summary'          => ['nullable', 'string', 'max:500'],
            'overview'         => ['nullable', 'string', 'max:8000'],
            'problem'          => ['nullable', 'string', 'max:4000'],
            'solution'         => ['nullable', 'string', 'max:4000'],
            'my_role'          => ['nullable', 'string', 'max:1000'],
            'architecture'     => ['nullable', 'string', 'max:4000'],
            'challenges'       => ['nullable', 'string', 'max:4000'],
            'results'          => ['nullable', 'string', 'max:4000'],
            'tech_stack'       => ['nullable', 'string', 'max:2000'],
            'highlights'       => ['nullable', 'string', 'max:2000'],
            'project_type'     => ['nullable', 'string', 'max:255'],
            'thumbnail'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'thumbnail_alt'    => ['nullable', 'string', 'max:255'],
            'demo_url'         => ['nullable', 'url', 'max:255'],
            'github_url'       => ['nullable', 'url', 'max:255'],
            'is_featured'      => ['boolean'],
            'project_date'     => ['nullable', 'date'],
            'sort_order'       => ['required', 'integer', 'min:0'],
            'status'           => ['required', 'in:active,inactive'],
            'meta_title'       => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'og_image'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'focus_keyword'    => ['nullable', 'string', 'max:255'],
            'screenshots.*'    => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ];

        $data = $request->validate($rules);

        $data['slug']       = Str::slug($data['slug']);
        $data['tech_stack'] = $this->linesToArray($request->input('tech_stack'));
        $data['highlights'] = $this->linesToArray($request->input('highlights'));
        $data['is_featured'] = $request->boolean('is_featured');

        foreach (['thumbnail', 'og_image'] as $field) {
            if ($request->hasFile($field)) {
                $this->deleteImage($project?->{$field});
                $data[$field] = $this->storeImage($request->file($field));
            } else {
                unset($data[$field]);
            }
        }

        return $data;
    }

    private function syncScreenshots(Request $request, Project $project): void
    {
        foreach ($request->input('existing_screenshots', []) as $id => $data) {
            $screenshot = $project->screenshots()->find($id);
            if (!$screenshot) {
                continue;
            }
            if (!empty($data['delete'])) {
                $this->deleteImage($screenshot->image);
                $screenshot->delete();
                continue;
            }
            $screenshot->update([
                'alt_text'   => $data['alt_text'] ?? null,
                'title'      => $data['title'] ?? null,
                'sort_order' => $data['sort_order'] ?? 0,
            ]);
        }

        foreach ($request->file('screenshots', []) as $index => $file) {
            ProjectScreenshot::create([
                'project_id' => $project->id,
                'image'      => $this->storeImage($file),
                'alt_text'   => $request->input("screenshot_alt.{$index}") ?: $project->title . ' screenshot',
                'title'      => $request->input("screenshot_title.{$index}") ?: $project->title,
                'sort_order' => $project->screenshots()->max('sort_order') + 1,
            ]);
        }
    }

    private function linesToArray(?string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $value))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    private function storeImage($file): string
    {
        $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/projects'), $fileName);

        return 'uploads/projects/' . $fileName;
    }

    private function deleteImage(?string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
