@csrf

<div class="row g-3">
    <div class="col-md-6">
        <label for="client_name" class="form-label">Client Name <span class="text-danger">*</span></label>
        <input type="text" name="client_name" id="client_name" class="form-control @error('client_name') is-invalid @enderror" value="{{ old('client_name', $testimonial->client_name ?? '') }}" required placeholder="Alexander Wright">
        @error('client_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="client_title" class="form-label">Client Role / Title</label>
        <input type="text" name="client_title" id="client_title" class="form-control @error('client_title') is-invalid @enderror" value="{{ old('client_title', $testimonial->client_title ?? '') }}" placeholder="Founder & CEO">
        @error('client_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="company_name" class="form-label">Company Name</label>
        <input type="text" name="company_name" id="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name', $testimonial->company_name ?? '') }}" placeholder="Vanguard SaaS Solutions">
        @error('company_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="project_title" class="form-label">Associated Project / Service</label>
        <input type="text" name="project_title" id="project_title" class="form-control @error('project_title') is-invalid @enderror" value="{{ old('project_title', $testimonial->project_title ?? '') }}" placeholder="SaaS Platform Development">
        @error('project_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label for="rating" class="form-label">Rating (Stars 1 to 5) <span class="text-danger">*</span></label>
        <select name="rating" id="rating" class="form-select @error('rating') is-invalid @enderror" required>
            @for($r = 5; $r >= 1; $r--)
                <option value="{{ $r }}" @selected(old('rating', $testimonial->rating ?? 5) == $r)>{{ $r }} Stars ({{ str_repeat('★', $r) }})</option>
            @endfor
        </select>
        @error('rating') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label for="sort_order" class="form-label">Sort Order <span class="text-danger">*</span></label>
        <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $testimonial->sort_order ?? $nextSort ?? 0) }}" required min="0">
        @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 d-flex align-items-center mt-4">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" @checked(old('is_active', $testimonial->is_active ?? true))>
            <label class="form-check-label fw-bold" for="is_active">Active (Visible on Site)</label>
        </div>
    </div>

    <div class="col-12">
        <label for="review" class="form-label">Review Content <span class="text-danger">*</span></label>
        <textarea name="review" id="review" rows="5" class="form-control @error('review') is-invalid @enderror" required placeholder="Write client feedback here...">{{ old('review', $testimonial->review ?? '') }}</textarea>
        @error('review') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label for="client_avatar" class="form-label">Client Avatar / Photo (Optional)</label>
        @if(isset($testimonial) && $testimonial->client_avatar)
            <div class="mb-2">
                <img src="{{ asset($testimonial->client_avatar) }}" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
            </div>
        @endif
        <input type="file" name="client_avatar" id="client_avatar" class="form-control @error('client_avatar') is-invalid @enderror">
        @error('client_avatar') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">Save Testimonial</button>
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
