<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TeamMemberController extends Controller
{
    public function index(Request $request)
    {
        $query = TeamMember::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('role', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status));

        $teamMembers = $query->orderBy('sort_order')->latest()->paginate(10)->withQueryString();
        $activeCount = TeamMember::active()->count();
        $inactiveCount = TeamMember::where('status', 'inactive')->count();

        return view('admin.team.index', compact('teamMembers', 'activeCount', 'inactiveCount'));
    }

    public function create()
    {
        $teamMember = new TeamMember([
            'status' => 'active',
            'sort_order' => (TeamMember::max('sort_order') ?? 0) + 1,
        ]);

        return view('admin.team.create', compact('teamMember'));
    }

    public function store(Request $request)
    {
        TeamMember::create($this->validatedData($request));

        return redirect()->route('team-members.index')->with('success', 'Team member added successfully.');
    }

    public function edit(TeamMember $teamMember)
    {
        return view('admin.team.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $teamMember->update($this->validatedData($request, $teamMember));

        return redirect()->route('team-members.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $teamMember)
    {
        $this->deleteImage($teamMember->profile_image);
        $teamMember->delete();

        return redirect()->route('team-members.index')->with('success', 'Team member deleted successfully.');
    }

    public function toggleStatus(TeamMember $teamMember)
    {
        $teamMember->update([
            'status' => $teamMember->status === 'active' ? 'inactive' : 'active',
        ]);

        return back()->with('success', 'Team member status updated successfully.');
    }

    private function validatedData(Request $request, ?TeamMember $teamMember = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'experience_label' => ['nullable', 'string', 'max:255'],
            'projects_label' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
            'mission' => ['nullable', 'string', 'max:2000'],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'tags' => ['nullable', 'string', 'max:2000'],
            'expertise' => ['nullable', 'string', 'max:2000'],
            'stats' => ['nullable', 'string', 'max:2000'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $data['tags'] = $this->linesToArray($request->input('tags'));
        $data['expertise'] = $this->linesToArray($request->input('expertise'));
        $data['stats'] = $this->linesToArray($request->input('stats'));

        if ($request->hasFile('profile_image')) {
            $this->deleteImage($teamMember?->profile_image);
            $data['profile_image'] = $this->storeImage($request);
        } else {
            unset($data['profile_image']);
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

    private function storeImage(Request $request): string
    {
        $file = $request->file('profile_image');
        $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/team-members'), $fileName);

        return 'uploads/team-members/' . $fileName;
    }

    private function deleteImage(?string $path): void
    {
        if (!$path) {
            return;
        }

        $absolutePath = public_path($path);
        if (File::exists($absolutePath)) {
            File::delete($absolutePath);
        }
    }
}
