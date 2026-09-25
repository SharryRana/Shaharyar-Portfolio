<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $query = Testimonial::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('client_name', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('client_title', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $testimonials = $query->orderBy('sort_order')->orderByDesc('id')->paginate(10)->withQueryString();

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        $maxSort = Testimonial::max('sort_order') ?? 0;
        $nextSort = $maxSort + 1;

        return view('admin.testimonials.create', compact('nextSort'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name'   => ['required', 'string', 'max:255'],
            'client_title'  => ['nullable', 'string', 'max:255'],
            'company_name'  => ['nullable', 'string', 'max:255'],
            'client_avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'rating'        => ['required', 'integer', 'between:1,5'],
            'review'        => ['required', 'string', 'max:2000'],
            'project_title' => ['nullable', 'string', 'max:255'],
            'sort_order'    => ['required', 'integer', 'min:0'],
            'is_active'     => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('client_avatar')) {
            $file = $request->file('client_avatar');
            $filename = time() . '-' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/testimonials';
            $file->move(public_path($path), $filename);
            $validated['client_avatar'] = $path . '/' . $filename;
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'client_name'   => ['required', 'string', 'max:255'],
            'client_title'  => ['nullable', 'string', 'max:255'],
            'company_name'  => ['nullable', 'string', 'max:255'],
            'client_avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'rating'        => ['required', 'integer', 'between:1,5'],
            'review'        => ['required', 'string', 'max:2000'],
            'project_title' => ['nullable', 'string', 'max:255'],
            'sort_order'    => ['required', 'integer', 'min:0'],
            'is_active'     => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('client_avatar')) {
            if ($testimonial->client_avatar && file_exists(public_path($testimonial->client_avatar))) {
                @unlink(public_path($testimonial->client_avatar));
            }

            $file = $request->file('client_avatar');
            $filename = time() . '-' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/testimonials';
            $file->move(public_path($path), $filename);
            $validated['client_avatar'] = $path . '/' . $filename;
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->client_avatar && file_exists(public_path($testimonial->client_avatar))) {
            @unlink(public_path($testimonial->client_avatar));
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }

    public function toggleStatus(Testimonial $testimonial)
    {
        $testimonial->update(['is_active' => !$testimonial->is_active]);

        return response()->json([
            'success'   => true,
            'is_active' => $testimonial->is_active,
            'message'   => 'Status updated successfully.',
        ]);
    }
}
