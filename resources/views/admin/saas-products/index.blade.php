@extends('admin.layouts.master')

@push('styles')
    <style>
        .saas-admin-hero {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            border-radius: var(--border-radius);
            padding: 24px;
            box-shadow: var(--card-shadow);
        }

        .saas-thumb {
            width: 58px;
            height: 58px;
            border-radius: 14px;
            object-fit: cover;
            background: rgba(67, 97, 238, .1);
        }

        .saas-icon {
            width: 58px;
            height: 58px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            font-size: 1.25rem;
        }

        html[data-theme="dark"] .saas-card {
            background: #161a2e;
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

@section('main-content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <section class="saas-admin-hero mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2 class="mb-1">SaaS Products</h2>
                <p class="mb-0 opacity-75">Manage product showcase pages, SEO, screenshots, videos, FAQs, and pricing.</p>
            </div>
            <a href="{{ route('saas-products.create') }}" class="btn btn-light"><i class="bi bi-plus-circle"></i> Add
                Product</a>
        </div>
    </section>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card p-3">
                <div class="text-muted small">Total</div>
                <h3>{{ $products->total() }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <div class="text-muted small">Active</div>
                <h3 class="text-success">{{ $activeCount }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <div class="text-muted small">Inactive</div>
                <h3 class="text-secondary">{{ $inactiveCount }}</h3>
            </div>
        </div>
    </div>

    <div class="card saas-card">
        <div class="card-body p-4">
            <form method="GET" class="row g-3 align-items-end mb-4">
                <div class="col-md-7">
                    <label class="form-label">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="Search product, slug, or category">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">All</option>
                        <option value="active" @selected(request('status') === 'active')>Active</option>
                        <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
                    </select>
                </div>
                <div class="col-md-2 d-grid"><button class="btn btn-primary"><i class="bi bi-search"></i> Filter</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Slug</th>
                            <th>Category</th>
                            <th>Sort</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($product->thumbnail)
                                            <img class="saas-thumb" src="{{ asset($product->thumbnail) }}"
                                                alt="{{ $product->thumbnail_alt ?: $product->title }}">
                                        @else
                                            <span class="saas-icon"><i
                                                    class="{{ $product->icon ?: 'fas fa-layer-group' }}"></i></span>
                                        @endif
                                        <div>
                                            <div class="fw-semibold">{{ $product->title }}</div>
                                            <div class="text-muted small">
                                                {{ Str::limit($product->tagline ?: $product->overview, 90) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="{{ route('projects.show', $product->slug) }}"
                                        target="_blank">{{ $product->slug }}</a></td>
                                <td>{{ $product->category ?: 'N/A' }}</td>
                                <td>{{ $product->sort_order }}</td>
                                <td>
                                    <form action="{{ route('saas-products.toggle-status', $product) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button
                                            class="btn btn-sm {{ $product->status === 'active' ? 'btn-success' : 'btn-outline-secondary' }}">{{ ucfirst($product->status) }}</button>
                                    </form>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('saas-products.edit', $product) }}" class="btn btn-sm btn-primary"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('saas-products.destroy', $product) }}" method="POST" class="d-inline"
                                        data-confirm="Delete {{ $product->title }} and all related screenshots, FAQs, and pricing? This action cannot be undone."
                                        data-confirm-title="Delete SaaS product?"
                                        data-confirm-button="Delete Product">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" type="submit">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">No SaaS products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3 d-flex justify-content-end">
                {{ $products->links('vendor.pagination.visitors') }}
            </div>
        </div>
    </div>
@endsection
