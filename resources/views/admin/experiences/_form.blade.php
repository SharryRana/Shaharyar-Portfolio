<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Company Name <span class="text-danger">*</span></label>
        <input type="text" name="company" class="form-control @error('company') is-invalid @enderror" value="{{ old('company', $experience->company) }}" required placeholder="e.g. Creavibe / Acme Corp">
        @error('company') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Role / Job Title <span class="text-danger">*</span></label>
        <input type="text" name="role" class="form-control @error('role') is-invalid @enderror" value="{{ old('role', $experience->role) }}" required placeholder="e.g. Full-Stack Software Engineer">
        @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Location</label>
        <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $experience->location) }}" placeholder="e.g. Remote / New York, USA">
        @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Employment Type</label>
        <select name="employment_type" class="form-select @error('employment_type') is-invalid @enderror">
            <option value="">Select Type</option>
            @foreach(['Full-time', 'Part-time', 'Contract', 'Freelance', 'Internship'] as $type)
                <option value="{{ $type }}" @selected(old('employment_type', $experience->employment_type) === $type)>{{ $type }}</option>
            @endforeach
        </select>
        @error('employment_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Start Date <span class="text-danger">*</span></label>
        <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', $experience->start_date ? $experience->start_date->format('Y-m-d') : '') }}" required>
        @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">End Date</label>
        <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', $experience->end_date ? $experience->end_date->format('Y-m-d') : '') }}" @if(old('is_current', $experience->is_current)) disabled @endif>
        @error('end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 align-self-center">
        <div class="form-check form-switch mt-4">
            <input class="form-check-input" type="checkbox" name="is_current" id="is_current" value="1" @checked(old('is_current', $experience->is_current)) onchange="document.getElementById('end_date').disabled = this.checked">
            <label class="form-check-label fw-bold" for="is_current">Currently Work Here</label>
        </div>
    </div>

    <div class="col-12">
        <label class="form-label">Description (Role Overview)</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Brief overview of responsibilities and focus areas...">{{ old('description', $experience->description) }}</textarea>
        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Key Achievements / Highlights (One per line)</label>
        <textarea name="highlights" class="form-control @error('highlights') is-invalid @enderror" rows="5" placeholder="Led engineering team of 5&#10;Built multi-tenant SaaS architecture&#10;Optimized database queries by 40%">{{ old('highlights', is_array($experience->highlights) ? implode("\n", $experience->highlights) : $experience->highlights) }}</textarea>
        @error('highlights') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Technologies Used (One per line)</label>
        <textarea name="technologies" class="form-control @error('technologies') is-invalid @enderror" rows="5" placeholder="Laravel&#10;Go&#10;Vue.js&#10;PostgreSQL">{{ old('technologies', is_array($experience->technologies) ? implode("\n", $experience->technologies) : $experience->technologies) }}</textarea>
        @error('technologies') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Company Website URL</label>
        <input type="url" name="company_url" class="form-control @error('company_url') is-invalid @enderror" value="{{ old('company_url', $experience->company_url) }}" placeholder="https://example.com">
        @error('company_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Company Logo</label>
        <input type="file" name="company_logo" class="form-control @error('company_logo') is-invalid @enderror" accept="image/*">
        @if($experience->company_logo)
            <div class="mt-2 small text-muted">Current Logo: <img src="{{ asset($experience->company_logo) }}" height="30" class="ms-1"></div>
        @endif
        @error('company_logo') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Sort Order</label>
        <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $experience->sort_order ?? 1) }}" min="0">
        @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 align-self-center">
        <div class="form-check form-switch mt-4">
            <input class="form-check-input" type="checkbox" name="is_visible" id="is_visible" value="1" @checked(old('is_visible', $experience->is_visible ?? true))>
            <label class="form-check-label fw-bold" for="is_visible">Visible on Portfolio Timeline</label>
        </div>
    </div>
</div>

<div class="mt-4 text-end">
    <button type="submit" class="btn btn-primary px-4">
        <i class="bi bi-check-circle"></i> {{ $isEdit ? 'Update Experience' : 'Add Experience' }}
    </button>
</div>
