<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ClientWorkController extends Controller
{
    public function index(Request $request)
    {
        $query = ClientWork::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status));

        $items = $query->orderBy('sort_order')->latest()->paginate(10)->withQueryString();
        $activeCount = ClientWork::active()->count();
        $inactiveCount = ClientWork::where('status', 'inactive')->count();

        return view('admin.client-work.index', compact('items', 'activeCount', 'inactiveCount'));
    }

    public function create()
    {
        $item = new ClientWork([
            'status' => 'active',
            'sort_order' => (ClientWork::max('sort_order') ?? 0) + 1,
        ]);

        return view('admin.client-work.create', compact('item'));
    }

    public function store(Request $request)
    {
        ClientWork::create($this->validatedData($request));

        return redirect()->route('client-work.index')->with('success', 'Client work added successfully.');
    }

    public function edit(ClientWork $clientWork)
    {
        $item = $clientWork;

        return view('admin.client-work.edit', compact('item'));
    }

    public function update(Request $request, ClientWork $clientWork)
    {
        $clientWork->update($this->validatedData($request, $clientWork));

        return redirect()->route('client-work.index')->with('success', 'Client work updated successfully.');
    }

    public function destroy(ClientWork $clientWork)
    {
        $this->deleteImage($clientWork->image);
        $clientWork->delete();

        return redirect()->route('client-work.index')->with('success', 'Client work deleted successfully.');
    }

    public function toggleStatus(ClientWork $clientWork)
    {
        $clientWork->update(['status' => $clientWork->status === 'active' ? 'inactive' : 'active']);

        return back()->with('success', 'Client work status updated successfully.');
    }

    private function validatedData(Request $request, ?ClientWork $clientWork = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'icon' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'category' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        if ($request->hasFile('image')) {
            $this->deleteImage($clientWork?->image);
            $data['image'] = $this->storeImage($request);
        } else {
            unset($data['image']);
        }

        return $data;
    }

    private function storeImage(Request $request): string
    {
        $file = $request->file('image');
        $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/client-work'), $fileName);

        return 'uploads/client-work/' . $fileName;
    }

    private function deleteImage(?string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
