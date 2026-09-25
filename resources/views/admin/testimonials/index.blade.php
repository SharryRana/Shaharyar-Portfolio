@extends('admin.layouts.master')

@section('title', 'Client Testimonials | Admin')

@section('main-content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<section class="content-admin-hero mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h2 class="mb-1">Testimonials Management</h2>
            <p class="mb-0 opacity-75">Manage client reviews and testimonials displayed on the website.</p>
        </div>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-light">
            <i class="bi bi-plus-circle"></i> Add Testimonial
        </a>
    </div>
</section>

<div class="card content-admin-card">
    <div class="card-body p-4">
        <form method="GET" class="row g-3 align-items-end mb-4">
            <div class="col-md-6">
                <label class="form-label">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by name, company or title">
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="active" @selected(request('status') === 'active')>Active</option>
                    <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
                @if(request()->anyFilled(['search', 'status']))
                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th style="width: 70px;">Order</th>
                        <th>Client</th>
                        <th>Role / Company</th>
                        <th>Rating</th>
                        <th>Review Snippet</th>
                        <th>Status</th>
                        <th style="width: 140px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $item)
                        <tr>
                            <td class="fw-semibold text-muted">#{{ $item->sort_order }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if($item->client_avatar)
                                        <img src="{{ asset($item->client_avatar) }}" class="rounded-circle" style="width: 36px; height: 36px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-primary-subtle text-primary fw-bold d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 0.85rem;">
                                            {{ Str::substr($item->client_name, 0, 1) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="fw-bold">{{ $item->client_name }}</div>
                                        @if($item->project_title)
                                            <div class="text-muted small">{{ $item->project_title }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>{{ $item->client_title ?: '—' }}</div>
                                <div class="text-muted small">{{ $item->company_name }}</div>
                            </td>
                            <td>
                                <div class="text-warning">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= $item->rating ? '-fill' : '' }}"></i>
                                    @endfor
                                </div>
                            </td>
                            <td style="max-width: 250px;">
                                <div class="text-truncate" title="{{ $item->review }}">{{ $item->review }}</div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-status-toggle {{ $item->is_active ? 'btn-success' : 'btn-secondary' }}" data-url="{{ route('admin.testimonials.toggle-status', $item) }}">
                                    {{ $item->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.testimonials.edit', $item) }}" class="btn btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.testimonials.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this testimonial?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                No testimonials found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $testimonials->links() }}
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-status-toggle').forEach(btn => {
        btn.addEventListener('click', function () {
            const url = this.dataset.url;
            fetch(url, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    if (data.is_active) {
                        this.classList.remove('btn-secondary');
                        this.classList.add('btn-success');
                        this.textContent = 'Active';
                    } else {
                        this.classList.remove('btn-success');
                        this.classList.add('btn-secondary');
                        this.textContent = 'Inactive';
                    }
                }
            });
        });
    });
});
</script>
@endpush
@endsection
