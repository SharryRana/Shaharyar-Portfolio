<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Service Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $service->name) }}" required placeholder="e.g. Backend Development">
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $service->slug) }}" placeholder="e.g. backend-development (auto-generated if empty)">
        @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">FontAwesome Icon Class</label>
        <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon', $service->icon) }}" placeholder="e.g. fas fa-server">
        @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Headline / Eyebrow</label>
        <input type="text" name="headline" class="form-control @error('headline') is-invalid @enderror" value="{{ old('headline', $service->headline) }}" placeholder="e.g. Scalable Backend Systems Built for Production">
        @error('headline') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Short Description (Cards & Overviews)</label>
        <textarea name="short_description" class="form-control @error('short_description') is-invalid @enderror" rows="2" placeholder="Brief summary of the service...">{{ old('short_description', $service->short_description) }}</textarea>
        @error('short_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Full Page Content</label>
        <textarea name="full_content" class="form-control @error('full_content') is-invalid @enderror" rows="6" placeholder="Detailed content about the service...">{{ old('full_content', $service->full_content) }}</textarea>
        @error('full_content') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Key Points / Benefits (One per line)</label>
        <textarea name="key_points" class="form-control @error('key_points') is-invalid @enderror" rows="5" placeholder="High performance Go and Laravel&#10;RESTful API design&#10;PostgreSQL query optimization">{{ old('key_points', is_array($service->key_points) ? implode("\n", $service->key_points) : $service->key_points) }}</textarea>
        @error('key_points') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Process Steps (One per line)</label>
        <textarea name="process_steps" class="form-control @error('process_steps') is-invalid @enderror" rows="5" placeholder="Requirements analysis&#10;Architecture design&#10;Implementation&#10;Testing & launch">{{ old('process_steps', is_array($service->process_steps) ? implode("\n", $service->process_steps) : $service->process_steps) }}</textarea>
        @error('process_steps') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Technologies (One per line)</label>
        <textarea name="technologies" class="form-control @error('technologies') is-invalid @enderror" rows="5" placeholder="Go&#10;Laravel&#10;PostgreSQL&#10;Redis">{{ old('technologies', is_array($service->technologies) ? implode("\n", $service->technologies) : $service->technologies) }}</textarea>
        @error('technologies') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Sort Order</label>
        <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $service->sort_order ?? 1) }}" min="0">
        @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 align-self-center">
        <div class="form-check form-switch mt-4">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" @checked(old('is_active', $service->is_active ?? true))>
            <label class="form-check-label fw-bold" for="is_active">Active (Visible on frontend)</label>
        </div>
    </div>

    <hr class="my-4">
    <h4>SEO Settings</h4>

    <div class="col-md-6">
        <label class="form-label">Meta Title</label>
        <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title', $service->meta_title) }}">
        @error('meta_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">OG Image</label>
        <input type="file" name="og_image" class="form-control @error('og_image') is-invalid @enderror" accept="image/*">
        @if($service->og_image)
            <div class="mt-2 small text-muted">Current: <a href="{{ asset($service->og_image) }}" target="_blank">View image</a></div>
        @endif
        @error('og_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Meta Description</label>
        <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" rows="2">{{ old('meta_description', $service->meta_description) }}</textarea>
        @error('meta_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="mt-4 text-end">
    <button type="submit" class="btn btn-primary px-4">
        <i class="bi bi-check-circle"></i> {{ $isEdit ? 'Update Service' : 'Create Service' }}
    </button>
</div>
