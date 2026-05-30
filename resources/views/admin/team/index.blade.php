@extends('admin.layouts.master')

@push('styles')
    <style>
        .team-admin-hero {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            border-radius: var(--border-radius);
            padding: 24px;
            box-shadow: var(--card-shadow);
        }

        .team-admin-card {
            border: 0;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .team-admin-avatar {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            object-fit: cover;
        }

        .team-admin-initials {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            font-weight: 700;
        }

        .team-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            border-radius: 999px;
            padding: 5px 10px;
            font-size: .8rem;
            background: rgba(67, 97, 238, .1);
            color: var(--primary);
        }

        html[data-theme="dark"] .team-admin-card {
            background: #161a2e;
            color: #e2e6f3;
        }

        html[data-theme="dark"] .table {
            color: #e2e6f3;
        }
    </style>
@endpush

@section('main-content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <section class="team-admin-hero mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2 class="mb-1">Team Management</h2>
                <p class="mb-0 opacity-75">Add, edit, reorder, and publish team members on your portfolio.</p>
            </div>
            <a href="{{ route('team-members.create') }}" class="btn btn-light">
                <i class="bi bi-plus-circle"></i> Add Team Member
            </a>
        </div>
    </section>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card p-3">
                <div class="text-muted small">Total Members</div>
                <h3 class="mb-0">{{ $teamMembers->total() }}</h3>
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

    <div class="card team-admin-card">
        <div class="card-body p-4">
            <form method="GET" class="row g-3 align-items-end mb-4">
                <div class="col-md-7">
                    <label class="form-label">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by name, role, or email">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="active" @selected(request('status') === 'active')>Active</option>
                        <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search"></i> Filter
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Member</th>
                            <th>Tags</th>
                            <th>Sort</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teamMembers as $member)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($member->profile_image)
                                            <img class="team-admin-avatar" src="{{ asset($member->profile_image) }}" alt="{{ $member->name }}">
                                        @else
                                            <span class="team-admin-initials">{{ strtoupper(substr($member->name, 0, 2)) }}</span>
                                        @endif
                                        <div>
                                            <div class="fw-semibold">{{ $member->name }}</div>
                                            <div class="text-muted small">{{ $member->role }}</div>
                                            <div class="text-muted small">{{ $member->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @foreach(array_slice($member->tags ?? [], 0, 3) as $tag)
                                        <span class="team-badge mb-1">{{ $tag }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $member->sort_order }}</td>
                                <td>
                                    <form action="{{ route('team-members.toggle-status', $member) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm {{ $member->status === 'active' ? 'btn-success' : 'btn-outline-secondary' }}" type="submit">
                                            {{ ucfirst($member->status) }}
                                        </button>
                                    </form>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('team-members.edit', $member) }}" class="btn btn-sm btn-primary" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteTeamModal{{ $member->id }}" title="Delete">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="deleteTeamModal{{ $member->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete Team Member</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete <strong>{{ $member->name }}</strong>? This action cannot be undone.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('team-members.destroy', $member) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="bi bi-people fs-1 text-primary"></i>
                                    <p class="mb-0 mt-2">No team members found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $teamMembers->links() }}
            </div>
        </div>
    </div>
@endsection
