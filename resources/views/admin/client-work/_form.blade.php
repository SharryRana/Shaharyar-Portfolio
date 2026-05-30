@php($isEdit = $item->exists)

@push('styles')
    <style>
        .content-form-card { border: 0; border-radius: var(--border-radius); box-shadow: var(--card-shadow); overflow: hidden; }
        .content-form-header { background: linear-gradient(135deg, var(--primary), var(--secondary)); color: #fff; padding: 22px; }
        .media-preview { width: 112px; height: 112px; border-radius: 18px; object-fit: cover; background: rgba(67, 97, 238, .1); border: 1px solid rgba(67, 97, 238, .12); }
        .icon-preview { width: 96px; height: 96px; border-radius: 18px; display: inline-flex; align-items: center; justify-content: center; background: rgba(67, 97, 238, .1); color: var(--primary); font-size: 2rem; }
        html[data-theme="dark"] .content-form-card { background: #161a2e; color: #e2e6f3; }
    </style>
@endpush

<div class="card content-form-card">
    <div class="content-form-header d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div>
            <h4 class="mb-1">{{ $isEdit ? 'Edit Client Work' : 'Add Client Work' }}</h4>
            <p class="mb-0 opacity-75">Manage client/work category cards on your portfolio.</p>
        </div>
        <a href="{{ route('client-work.index') }}" class="btn btn-light"><i class="bi bi-arrow-left"></i> Back</a>
    </div>
    <div class="card-body p-4">
        <form action="{{ $isEdit ? route('client-work.update', $item) : route('client-work.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($isEdit) @method('PUT') @endif
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Client / Work Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $item->title) }}" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category / Type</label>
                            <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category', $item->category) }}" placeholder="Fintech Software">
                            @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Short Description</label>
                            <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $item->description) }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="border rounded-4 p-3 h-100">
                        <div class="text-center mb-3">
                            @if($item->image)
                                <img id="imagePreview" class="media-preview" src="{{ asset($item->image) }}" alt="{{ $item->title }}">
                            @else
                                <span id="iconBox" class="icon-preview"><i id="iconPreview" class="{{ old('icon', $item->icon ?: 'fas fa-building') }}"></i></span>
                                <img id="imagePreview" class="media-preview d-none" src="" alt="Client work preview">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input id="imageInput" type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon Class</label>
                            <input id="iconInput" type="text" name="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon', $item->icon) }}" placeholder="fas fa-building">
                            @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label">Sort Order</label>
                                <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $item->sort_order ?? 0) }}" min="0" required>
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="active" @selected(old('status', $item->status) === 'active')>Active</option>
                                    <option value="inactive" @selected(old('status', $item->status) === 'inactive')>Inactive</option>
                                </select>
                                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('client-work.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary"><i class="bi bi-check2-circle"></i> {{ $isEdit ? 'Update Client Work' : 'Create Client Work' }}</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        document.getElementById('iconInput')?.addEventListener('input', function () {
            const preview = document.getElementById('iconPreview');
            if (preview) preview.className = this.value || 'fas fa-building';
        });
        document.getElementById('imageInput')?.addEventListener('change', function () {
            const file = this.files?.[0];
            if (!file) return;
            document.getElementById('imagePreview').src = URL.createObjectURL(file);
            document.getElementById('imagePreview').classList.remove('d-none');
            document.getElementById('iconBox')?.classList.add('d-none');
        });
    </script>
@endpush
