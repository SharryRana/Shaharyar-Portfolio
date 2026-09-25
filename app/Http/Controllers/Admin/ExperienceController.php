<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ExperienceController extends Controller
{
    public function index()
    {
        $items = Experience::orderBy('sort_order', 'desc')->latest()->paginate(15)->withQueryString();
        $visibleCount = Experience::where('is_visible', true)->count();
        $hiddenCount  = Experience::where('is_visible', false)->count();

        return view('admin.experiences.index', compact('items', 'visibleCount', 'hiddenCount'));
    }

    public function create()
    {
        $experience = new Experience([
            'is_visible'  => true,
            'is_current'  => false,
            'sort_order'  => (Experience::max('sort_order') ?? 0) + 1,
        ]);

        return view('admin.experiences.create', compact('experience'));
    }

    public function store(Request $request)
    {
        Experience::create($this->validatedData($request));

        return redirect()->route('admin.experiences.index')->with('success', 'Experience added successfully.');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $experience->update($this->validatedData($request, $experience));

        return redirect()->route('admin.experiences.index')->with('success', 'Experience updated successfully.');
    }

    public function destroy(Experience $experience)
    {
        $this->deleteImage($experience->company_logo);
        $experience->delete();

        return redirect()->route('admin.experiences.index')->with('success', 'Experience deleted successfully.');
    }

    public function toggleStatus(Experience $experience)
    {
        $experience->update(['is_visible' => !$experience->is_visible]);

        return back()->with('success', 'Experience visibility updated successfully.');
    }

    private function validatedData(Request $request, ?Experience $experience = null): array
    {
        $data = $request->validate([
            'company'         => ['required', 'string', 'max:255'],
            'role'            => ['required', 'string', 'max:255'],
            'location'        => ['nullable', 'string', 'max:255'],
            'employment_type' => ['nullable', 'string', 'max:100'],
            'start_date'      => ['required', 'date'],
            'end_date'        => ['nullable', 'date', 'after_or_equal:start_date'],
            'is_current'      => ['boolean'],
            'description'     => ['nullable', 'string', 'max:2000'],
            'highlights'      => ['nullable', 'string', 'max:4000'],
            'technologies'    => ['nullable', 'string', 'max:2000'],
            'company_url'     => ['nullable', 'url', 'max:255'],
            'company_logo'    => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'sort_order'      => ['required', 'integer', 'min:0'],
            'is_visible'      => ['boolean'],
        ]);

        $data['highlights']   = $this->linesToArray($request->input('highlights'));
        $data['technologies'] = $this->linesToArray($request->input('technologies'));
        $data['is_current']   = $request->boolean('is_current');
        $data['is_visible']   = $request->boolean('is_visible');

        // If current, clear end_date
        if ($data['is_current']) {
            $data['end_date'] = null;
        }

        if ($request->hasFile('company_logo')) {
            $this->deleteImage($experience?->company_logo);
            $data['company_logo'] = $this->storeImage($request->file('company_logo'));
        } else {
            unset($data['company_logo']);
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

    private function storeImage($file): string
    {
        $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/experience'), $fileName);

        return 'uploads/experience/' . $fileName;
    }

    private function deleteImage(?string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
