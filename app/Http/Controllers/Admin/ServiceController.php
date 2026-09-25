<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(fn ($query) => $query
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%"));
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $active = $request->status === 'active' ? 1 : 0;
                $query->where('is_active', $active);
            });

        $items = $query->orderBy('sort_order')->latest()->paginate(10)->withQueryString();
        $activeCount = Service::where('is_active', true)->count();
        $inactiveCount = Service::where('is_active', false)->count();

        return view('admin.services.index', compact('items', 'activeCount', 'inactiveCount'));
    }

    public function create()
    {
        $service = new Service([
            'is_active'  => true,
            'sort_order' => (Service::max('sort_order') ?? 0) + 1,
        ]);

        return view('admin.services.create', compact('service'));
    }

    public function store(Request $request)
    {
        $service = Service::create($this->validatedData($request));
        $this->syncFaqs($request, $service);

        return redirect()->route('admin.services.index')->with('success', 'Service added successfully.');
    }

    public function edit(Service $service)
    {
        $service->load('faqs');

        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $service->update($this->validatedData($request, $service));
        $this->syncFaqs($request, $service);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $this->deleteImage($service->og_image);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }

    public function toggleStatus(Service $service)
    {
        $service->update(['is_active' => !$service->is_active]);

        return back()->with('success', 'Service status updated successfully.');
    }

    private function validatedData(Request $request, ?Service $service = null): array
    {
        $slug = $request->input('slug') ?: Str::slug($request->input('name', ''));
        $request->merge(['slug' => $slug]);

        $rules = [
            'name'              => ['required', 'string', 'max:255'],
            'slug'              => ['required', 'string', 'max:255', Rule::unique('services', 'slug')->ignore($service?->id)],
            'icon'              => ['nullable', 'string', 'max:255'],
            'headline'          => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'full_content'      => ['nullable', 'string', 'max:20000'],
            'technologies'      => ['nullable', 'string', 'max:2000'],
            'key_points'        => ['nullable', 'string', 'max:4000'],
            'process_steps'     => ['nullable', 'string', 'max:4000'],
            'is_active'         => ['boolean'],
            'sort_order'        => ['required', 'integer', 'min:0'],
            'meta_title'        => ['nullable', 'string', 'max:255'],
            'meta_description'  => ['nullable', 'string', 'max:500'],
            'og_image'          => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'faqs'              => ['nullable'],
            'faqs.*.question'   => ['nullable', 'string', 'max:255'],
            'faqs.*.answer'     => ['nullable', 'string', 'max:2000'],
            'faqs.*.sort_order' => ['nullable', 'integer', 'min:0'],
        ];

        $data = $request->validate($rules);

        $data['slug']          = Str::slug($data['slug']);
        $data['technologies']  = $this->linesToArray($request->input('technologies'));
        $data['key_points']    = $this->linesToArray($request->input('key_points'));
        $data['process_steps'] = $this->linesToArray($request->input('process_steps'));
        $data['is_active']     = $request->boolean('is_active');

        if ($request->hasFile('og_image')) {
            $this->deleteImage($service?->og_image);
            $data['og_image'] = $this->storeImage($request->file('og_image'));
        } else {
            unset($data['og_image']);
        }

        return $data;
    }

    private function syncFaqs(Request $request, Service $service): void
    {
        $service->faqs()->delete();
        foreach ($this->faqRows($request->input('faqs')) as $index => $faq) {
            $question = trim($faq['question'] ?? '');
            $answer   = trim($faq['answer'] ?? '');
            if ($question && $answer) {
                ServiceFaq::create([
                    'service_id' => $service->id,
                    'question'   => $question,
                    'answer'     => $answer,
                    'sort_order' => $faq['sort_order'] ?? $index + 1,
                ]);
            }
        }
    }

    private function faqRows($value): array
    {
        if (is_array($value)) {
            return array_values($value);
        }

        return collect($this->rows($value))->map(function ($row) {
            [$question, $answer] = array_pad(array_map('trim', explode('|', $row, 2)), 2, null);

            return compact('question', 'answer');
        })->all();
    }

    private function linesToArray(?string $value): array
    {
        return $this->rows($value);
    }

    private function rows(?string $value): array
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
        $file->move(public_path('uploads/services'), $fileName);

        return 'uploads/services/' . $fileName;
    }

    private function deleteImage(?string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
