@extends('admin.layouts.master')

@section('title', 'Experience | Admin')

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
            <h2 class="mb-1">Experience Management</h2>
            <p class="mb-0 opacity-75">Manage work history, positions, and company roles.</p>
        </div>
        <a href="{{ route('admin.experiences.create') }}" class="btn btn-light">
            <i class="bi bi-plus-circle"></i> Add Experience
        </a>
    </div>
</section>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card p-3">
            <div class="text-muted small">Visible Records</div>
            <h3 class="mb-0 text-success">{{ $visibleCount }}</h3>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-3">
            <div class="text-muted small">Hidden Records</div>
            <h3 class="mb-0 text-secondary">{{ $hiddenCount }}</h3>
        </div>
    </div>
</div>

<div class="card content-admin-card">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Role & Company</th>
                        <th>Type & Location</th>
                        <th>Duration</th>
                        <th>Sort</th>
                        <th>Visibility</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $experience)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                @if($experience->company_logo)
                                    <img src="{{ asset($experience->company_logo) }}" alt="{{ $experience->company }}" class="rounded" style="width: 40px; height: 40px; object-fit: contain;">
                                @else
                                    <span class="content-icon fs-5">
                                        <i class="bi bi-building"></i>
                                    </span>
                                @endif
                                <div>
                                    <div class="fw-semibold">{{ $experience->role }}</div>
                                    <div class="text-muted small">{{ $experience->company }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>{{ $experience->employment_type ?: '' }}</div>
                            <div class="text-muted small">{{ $experience->location ?: '' }}</div>
                        </td>
                        <td>
                            <div>
                                {{ $experience->start_date ? $experience->start_date->format('M Y') : '' }}
                                {{ $experience->is_current ? 'Present' : ($experience->end_date ? $experience->end_date->format('M Y') : '') }}
                            </div>
                            @if($experience->duration)
                                <div class="text-muted small">({{ $experience->duration }})</div>
                            @endif
                        </td>
                        <td>{{ $experience->sort_order }}</td>
                        <td>
                            <form action="{{ route('admin.experiences.toggle-status', $experience) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm {{ $experience->is_visible ? 'btn-success' : 'btn-outline-secondary' }}" type="submit">
                                    {{ $experience->is_visible ? 'Visible' : 'Hidden' }}
                                </button>
                            </form>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.experiences.edit', $experience) }}" class="btn btn-sm btn-primary" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.experiences.destroy', $experience) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Delete {{ addslashes($experience->role) }} at {{ addslashes($experience->company) }}?')">
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
                            <i class="bi bi-person-workspace fs-1 text-primary"></i>
                            <p class="mb-0 mt-2">No experience records found.</p>
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
