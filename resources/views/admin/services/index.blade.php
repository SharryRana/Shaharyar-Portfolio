@extends('admin.layouts.master')

@section('title', 'Services | Admin')

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
            <h2 class="mb-1">Services Management</h2>
            <p class="mb-0 opacity-75">Manage technical services offered by Creavibe.</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="btn btn-light">
            <i class="bi bi-plus-circle"></i> Add Service
        </a>
    </div>
</section>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card p-3">
            <div class="text-muted small">Total Services</div>
            <h3 class="mb-0">{{ $items->total() }}</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <div class="text-muted small">Active</div>
            <h3 class="mb-0 text-success">{{ $activeCount }}</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <div class="text-muted small">Inactive</div>
            <h3 class="mb-0 text-secondary">{{ $inactiveCount }}</h3>
        </div>
    </div>
</div>

<div class="card content-admin-card">
    <div class="card-body p-4">
        <form method="GET" class="row g-3 align-items-end mb-4">
            <div class="col-md-6">
                <label class="form-label">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by name or slug">
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="active" @selected(request('status') === 'active')>Active</option>
                    <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
                </select>
            </div>
            <div class="col-md-3 d-grid">
                <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Filter</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Service Name</th>
                        <th>Slug</th>
                        <th>Sort Order</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $service)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <span class="content-icon fs-5">
                                    <i class="{{ $service->icon ?: 'fas fa-cogs' }}"></i>
                                </span>
                                <div>
                                    <div class="fw-semibold">{{ $service->name }}</div>
                                    <div class="text-muted small">{{ Str::limit($service->short_description ?? '', 80) }}</div>
                                </div>
                            </div>
                        </td>
                        <td><code>{{ $service->slug }}</code></td>
                        <td>{{ $service->sort_order }}</td>
                        <td>
                            <form action="{{ route('admin.services.toggle-status', $service) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm {{ $service->is_active ? 'btn-success' : 'btn-outline-secondary' }}" type="submit">
                                    {{ $service->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-primary" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Delete {{ addslashes($service->name) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="bi bi-briefcase fs-1 text-primary"></i>
                            <p class="mb-0 mt-2">No services found.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3 d-flex justify-content-end">
            {{ $items->links() }}
        </div>
    </div>
</div>

@endsection
