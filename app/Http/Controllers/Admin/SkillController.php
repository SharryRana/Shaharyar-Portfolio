<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index(Request $request)
    {
        $query = Skill::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('label', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status));

        $items = $query->orderBy('sort_order')->latest()->paginate(10)->withQueryString();
        $activeCount = Skill::active()->count();
        $inactiveCount = Skill::where('status', 'inactive')->count();

        return view('admin.skills.index', compact('items', 'activeCount', 'inactiveCount'));
    }

    public function create()
    {
        $item = new Skill([
            'status' => 'active',
            'sort_order' => (Skill::max('sort_order') ?? 0) + 1,
        ]);

        return view('admin.skills.create', compact('item'));
    }

    public function store(Request $request)
    {
        Skill::create($this->validatedData($request));

        return redirect()->route('skills.index')->with('success', 'Skill added successfully.');
    }

    public function edit(Skill $skill)
    {
        $item = $skill;

        return view('admin.skills.edit', compact('item'));
    }

    public function update(Request $request, Skill $skill)
    {
        $skill->update($this->validatedData($request));

        return redirect()->route('skills.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('skills.index')->with('success', 'Skill deleted successfully.');
    }

    public function toggleStatus(Skill $skill)
    {
        $skill->update(['status' => $skill->status === 'active' ? 'inactive' : 'active']);

        return back()->with('success', 'Skill status updated successfully.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'icon' => ['nullable', 'string', 'max:255'],
            'label' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:active,inactive'],
        ]);
    }
}
