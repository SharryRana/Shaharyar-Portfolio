@php
    $isEdit = $teamMember->exists;
    $tags = old('tags', implode("\n", $teamMember->tags ?? []));
    $expertise = old('expertise', implode("\n", $teamMember->expertise ?? []));
    $stats = old('stats', implode("\n", $teamMember->stats ?? []));
@endphp

@push('styles')
    <style>
        .team-form-card {
            border: 0;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .team-form-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            padding: 22px;
        }

        .team-image-preview {
            width: 112px;
            height: 112px;
            border-radius: 18px;
            object-fit: cover;
            background: rgba(67, 97, 238, 0.08);
            border: 1px solid rgba(67, 97, 238, 0.12);
        }

        .initials-preview {
            width: 112px;
            height: 112px;
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            font-size: 2rem;
            font-weight: 700;
        }

        html[data-theme="dark"] .team-form-card {
            background: #161a2e;
            color: #e2e6f3;
        }
    </style>
@endpush

<div class="card team-form-card">
    <div class="team-form-header d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div>
            <h4 class="mb-1">{{ $isEdit ? 'Edit Team Member' : 'Add Team Member' }}</h4>
            <p class="mb-0 opacity-75">Manage the information shown on the portfolio team cards.</p>
        </div>
        <a href="{{ route('team-members.index') }}" class="btn btn-light">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card-body p-4">
        <form action="{{ $isEdit ? route('team-members.update', $teamMember) : route('team-members.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $teamMember->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Role / Designation</label>
                            <input type="text" name="role" class="form-control @error('role') is-invalid @enderror" value="{{ old('role', $teamMember->role) }}" required>
                            @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Experience Label</label>
                            <input type="text" name="experience_label" class="form-control @error('experience_label') is-invalid @enderror" value="{{ old('experience_label', $teamMember->experience_label) }}" placeholder="5+ Years Experience">
                            @error('experience_label')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Projects Label</label>
                            <input type="text" name="projects_label" class="form-control @error('projects_label') is-invalid @enderror" value="{{ old('projects_label', $teamMember->projects_label) }}" placeholder="500+ Projects">
                            @error('projects_label')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Short Description</label>
                            <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $teamMember->description) }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Mission / Extra Description</label>
                            <textarea name="mission" rows="3" class="form-control @error('mission') is-invalid @enderror">{{ old('mission', $teamMember->mission) }}</textarea>
                            @error('mission')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tags / Badges</label>
                            <textarea name="tags" rows="5" class="form-control @error('tags') is-invalid @enderror" placeholder="One per line">{{ $tags }}</textarea>
                            @error('tags')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Core Expertise / Strengths</label>
                            <textarea name="expertise" rows="5" class="form-control @error('expertise') is-invalid @enderror" placeholder="One per line">{{ $expertise }}</textarea>
                            @error('expertise')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Stats</label>
                            <textarea name="stats" rows="5" class="form-control @error('stats') is-invalid @enderror" placeholder="500+ Projects Delivered">{{ $stats }}</textarea>
                            @error('stats')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="border rounded-4 p-3 h-100">
                        <div class="mb-3 text-center">
                            @if($teamMember->profile_image)
                                <img id="imagePreview" class="team-image-preview" src="{{ asset($teamMember->profile_image) }}" alt="{{ $teamMember->name }}">
                            @else
                                <div id="initialsPreview" class="initials-preview">{{ strtoupper(substr($teamMember->name ?: 'TM', 0, 2)) }}</div>
                                <img id="imagePreview" class="team-image-preview d-none" src="" alt="Profile preview">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Profile Image</label>
                            <input id="profileImageInput" type="file" name="profile_image" class="form-control @error('profile_image') is-invalid @enderror" accept="image/*">
                            <div class="form-text">JPG, PNG, or WebP up to 2MB. Initials are used if empty.</div>
                            @error('profile_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $teamMember->phone) }}">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $teamMember->email) }}">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label">Sort Order</label>
                                <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $teamMember->sort_order ?? 0) }}" min="0" required>
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="active" @selected(old('status', $teamMember->status) === 'active')>Active</option>
                                    <option value="inactive" @selected(old('status', $teamMember->status) === 'inactive')>Inactive</option>
                                </select>
                                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('team-members.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check2-circle"></i> {{ $isEdit ? 'Update Member' : 'Create Member' }}
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        document.getElementById('profileImageInput')?.addEventListener('change', function () {
            const file = this.files?.[0];
            if (!file) return;

            const preview = document.getElementById('imagePreview');
            const initials = document.getElementById('initialsPreview');
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
            initials?.classList.add('d-none');
        });
    </script>
@endpush
