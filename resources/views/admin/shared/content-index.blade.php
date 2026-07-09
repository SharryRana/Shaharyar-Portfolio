@push('styles')
    <style>
        .content-admin-hero {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            border-radius: var(--border-radius);
            padding: 24px;
            box-shadow: var(--card-shadow);
        }

        .content-admin-card {
            border: 0;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .content-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            font-size: 1.25rem;
            overflow: hidden;
        }

        .content-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        html[data-theme="dark"] .content-admin-card {
            background: #161a2e;
            color: #e2e6f3;
        }

        html[data-theme="dark"] .table {
            color: #e2e6f3;
        }

        .pagination-modern {
            margin-bottom: 0;
        }

        .pagination-modern .page-link {
            border: none;
            border-radius: 12px;
            padding: 10px 15px;
            color: var(--primary);
            font-weight: 500;
            background: rgba(67, 97, 238, 0.08);
            transition: all .25s ease;
        }

        .pagination-modern .page-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(67, 97, 238, 0.25);
            background: rgba(67, 97, 238, 0.15);
        }

        .pagination-modern .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            box-shadow: 0 8px 22px rgba(67, 97, 238, 0.35);
        }

        .pagination-modern .page-item.disabled .page-link {
            opacity: 0.6;
        }

        html[data-theme="dark"] .pagination-modern .page-link {
            background: rgba(226, 230, 243, 0.08);
            color: #e2e6f3;
        }

        html[data-theme="dark"] .pagination-modern .page-link:hover {
            background: rgba(226, 230, 243, 0.15);
        }

        html[data-theme="dark"] .pagination-modern .page-item.active .page-link {
            color: #fff;
        }
    </style>
@endpush

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<section class="content-admin-hero mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h2 class="mb-1">{{ $title }}</h2>
            <p class="mb-0 opacity-75">{{ $subtitle }}</p>
        </div>
        <a href="{{ route($routePrefix . '.create') }}" class="btn btn-light">
            <i class="bi bi-plus-circle"></i> Add New
        </a>
    </div>
</section>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card p-3">
            <div class="text-muted small">Total Items</div>
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
            <div class="col-md-7">
                <label class="form-label">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by title or category">
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
                <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Filter</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Item</th>
                        @foreach($columns as $columnLabel)
                            <th>{{ $columnLabel }}</th>
                        @endforeach
                        <th>Sort</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <span class="content-icon">
                                        @if(!empty($item->image))
                                            <img src="{{ asset($item->image) }}" alt="{{ $item->title }}">
                                        @else
                                            <i class="{{ $item->icon ?: 'bi ' . $emptyIcon }}"></i>
                                        @endif
                                    </span>
                                    <div>
                                        <div class="fw-semibold">{{ $item->title }}</div>
                                        <div class="text-muted small">{{ Str::limit($item->description ?? '', 90) }}</div>
                                    </div>
                                </div>
                            </td>
                            @foreach(array_keys($columns) as $column)
                                <td>{{ $item->{$column} ?? 'N/A' }}</td>
                            @endforeach
                            <td>{{ $item->sort_order }}</td>
                            <td>
                                <form action="{{ route($routePrefix . '.toggle-status', $item) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm {{ $item->status === 'active' ? 'btn-success' : 'btn-outline-secondary' }}" type="submit">
                                        {{ ucfirst($item->status) }}
                                    </button>
                                </form>
                            </td>
                            <td class="text-end">
                                <a href="{{ route($routePrefix . '.edit', $item) }}" class="btn btn-sm btn-primary" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route($routePrefix . '.destroy', $item) }}" method="POST" class="d-inline"
                                    data-confirm="Are you sure you want to delete {{ $item->title }}? This action cannot be undone."
                                    data-confirm-title="Delete item?"
                                    data-confirm-button="Delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($columns) + 4 }}" class="text-center py-5">
                                <i class="bi {{ $emptyIcon }} fs-1 text-primary"></i>
                                <p class="mb-0 mt-2">No records found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3 d-flex justify-content-end">
            {{ $items->links('vendor.pagination.visitors') }}
        </div>
    </div>
</div>
