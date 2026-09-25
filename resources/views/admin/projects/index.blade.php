@extends('admin.layouts.master')

@section('title', 'Projects | Admin')

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
            <h2 class="mb-1">Projects Management</h2>
            <p class="mb-0 opacity-75">Manage case studies, engineering projects, and portfolio pieces.</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-light">
            <i class="bi bi-plus-circle"></i> Add Project
        </a>
    </div>
</section>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card p-3">
            <div class="text-muted small">Total Projects</div>
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
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by title, slug, or type">
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
                        <th>Title</th>
                        <th>Type</th>
                        <th>Featured</th>
                        <th>Sort</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $project)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $project->title }}</div>
                            <div class="text-muted small">{{ $project->slug }}</div>
                        </td>
                        <td><span class="badge bg-secondary">{{ $project->project_type ?: '' }}</span></td>
                        <td>
                            @if($project->is_featured)
                                <span class="badge bg-warning text-dark"><i class="bi bi-star-fill"></i> Featured</span>
                            @else
                                <span class="text-muted"></span>
                            @endif
                        </td>
                        <td>{{ $project->sort_order }}</td>
                        <td>
                            <form action="{{ route('admin.projects.toggle-status', $project) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm {{ $project->status === 'active' ? 'btn-success' : 'btn-outline-secondary' }}" type="submit">
                                    {{ ucfirst($project->status) }}
                                </button>
                            </form>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-primary" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Delete {{ addslashes($project->title) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="bi bi-folder2-open fs-1 text-primary"></i>
                            <p class="mb-0 mt-2">No projects yet. <a href="{{ route('admin.projects.create') }}">Add the first one.</a></p>
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
