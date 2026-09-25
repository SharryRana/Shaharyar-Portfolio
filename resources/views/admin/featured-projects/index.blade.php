@extends('admin.layouts.master')

@section('title', 'Homepage Projects | Admin')

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
            <h2 class="mb-1">Homepage Projects</h2>
            <p class="mb-0 opacity-75">Manage the project cards displayed on the homepage (legacy FeaturedProject cards).</p>
        </div>
        <a href="{{ route('admin.featured-projects.create') }}" class="btn btn-light">
            <i class="bi bi-plus-circle"></i> Add Project Card
        </a>
    </div>
</section>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card p-3">
            <div class="text-muted small">Total</div>
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

<div class="card">
    <div class="card-body p-4">
        <form method="GET" class="row g-3 align-items-end mb-4">
            <div class="col-md-7">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by title or category">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="active" @selected(request('status') === 'active')>Active</option>
                    <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Filter</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Sort</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $item->title }}</div>
                            <div class="text-muted small">{{ \Illuminate\Support\Str::limit($item->description, 70) }}</div>
                        </td>
                        <td>{{ $item->category ?: '' }}</td>
                        <td>{{ $item->sort_order }}</td>
                        <td>
                            <form action="{{ route('admin.featured-projects.toggle-status', $item) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm {{ $item->status === 'active' ? 'btn-success' : 'btn-outline-secondary' }}" type="submit">
                                    {{ ucfirst($item->status) }}
                                </button>
                            </form>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.featured-projects.edit', $item) }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.featured-projects.destroy', $item) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Delete {{ addslashes($item->title) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="bi bi-window-stack fs-1 text-primary"></i>
                            <p class="mb-0 mt-2">No project cards yet.</p>
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
