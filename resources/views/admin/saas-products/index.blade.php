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
                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteSaas{{ $product->id }}"><i class="bi bi-trash3"></i></button>
                                </td>
                            </tr>

                            <div class="modal fade" id="deleteSaas{{ $product->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete SaaS Product</h5><button type="button"
                                                class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">Delete <strong>{{ $product->title }}</strong> and all related
                                            screenshots, FAQs, and pricing?</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('saas-products.destroy', $product) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">No SaaS products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $products->links() }}
        </div>
    </div>
@endsection
