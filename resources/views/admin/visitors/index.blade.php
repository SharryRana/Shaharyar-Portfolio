@extends('admin.layouts.master')

@push('styles')
    <style>
        /* ---------------- Beautiful Flash Alert ---------------- */
        .flash-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1055;
            min-width: 280px;
            max-width: 360px;
            padding: 14px 18px;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.15);
            animation: slideInRight 0.5s ease, fadeOut 0.5s ease 2.5s forwards;
        }

        .flash-alert i {
            font-size: 1.2rem;
        }

        .flash-alert.success {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: #fff;
        }

        .flash-alert.error {
            background: linear-gradient(135deg, #dc3545, #e55353);
            color: #fff;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(120%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
                transform: translateX(120%);
            }
        }

        /* ---------------- Dark Mode Sync ---------------- */
        html[data-theme="dark"] .flash-alert.success {
            background: linear-gradient(135deg, #198754, #20c997);
        }

        html[data-theme="dark"] .flash-alert.error {
            background: linear-gradient(135deg, #b02a37, #d63384);
        }

        /* ------------------- Card ------------------- */
        .card-custom {
            border: none;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            background: #fff;
            overflow: hidden;
            transition: background .3s ease, box-shadow .3s ease;
        }

        .card-header-custom {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            padding: 18px 22px;
            font-weight: 600;
            font-size: 1.15rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* ------------------- Filters ------------------- */
        .visitor-filter-panel {
            padding: 22px;
            background:
                radial-gradient(circle at top left, rgba(76, 201, 240, .16), transparent 32%),
                linear-gradient(135deg, rgba(67, 97, 238, .08), rgba(63, 55, 201, .04));
            border-bottom: 1px solid rgba(67, 97, 238, .12);
        }

        .visitor-filter-panel .form-label {
            color: #344054;
            font-size: .82rem;
            font-weight: 700;
            letter-spacing: .02em;
            text-transform: uppercase;
        }

        .visitor-filter-panel .form-control,
        .visitor-filter-panel .form-select {
            min-height: 46px;
            border-radius: 14px;
            border-color: rgba(67, 97, 238, .18);
            box-shadow: 0 10px 28px rgba(15, 18, 33, .04);
        }

        .visitor-filter-actions {
            display: flex;
            gap: 10px;
        }

        .visitor-filter-actions .btn {
            min-height: 46px;
            border-radius: 14px;
            font-weight: 700;
        }

        .visitor-summary-line {
            color: #667085;
            font-size: .92rem;
        }

        /* ------------------- Table ------------------- */
        .table-custom {
            overflow: hidden;
        }

        .table-custom thead {
            background: rgba(67, 97, 238, 0.08);
            color: #333;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .table-custom th,
        .table-custom td {
            padding: 14px 16px;
            vertical-align: middle;
            border-color: rgba(0, 0, 0, 0.05);
        }

        .table-custom tbody tr {
            transition: background .2s ease, transform .15s ease;
        }

        .table-custom tbody tr:hover {
            background: rgba(67, 97, 238, 0.06);
            transform: scale(1.01);
        }

        .truncate-text {
            max-width: 260px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            cursor: pointer;
        }

        /* ------------------- Empty State ------------------- */
        .empty-state {
            text-align: center;
            padding: 45px 0;
            color: #777;
        }

        .empty-state i {
            font-size: 42px;
            margin-bottom: 14px;
            color: var(--primary);
        }

        /* ------------------- Pagination ------------------- */
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

        /* ------------------- DARK MODE ------------------- */
        html[data-theme="dark"] .card-custom {
            background: #1f1f2e;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.55);
        }

        html[data-theme="dark"] .table-custom thead {
            background: rgba(226, 230, 243, 0.08);
            color: #e2e6f3;
        }

        html[data-theme="dark"] .table-custom th,
        html[data-theme="dark"] .table-custom td {
            border-color: rgba(255, 255, 255, 0.06);
        }

        html[data-theme="dark"] .table-custom tbody tr {
            color: #d0d3e0;
        }

        html[data-theme="dark"] .table-custom tbody tr:hover {
            background: rgba(226, 230, 243, 0.12);
        }

        html[data-theme="dark"] .visitor-filter-panel {
            background:
                radial-gradient(circle at top left, rgba(76, 201, 240, .12), transparent 32%),
                linear-gradient(135deg, rgba(226, 230, 243, .07), rgba(67, 97, 238, .08));
            border-color: rgba(255, 255, 255, .08);
        }

        html[data-theme="dark"] .visitor-filter-panel .form-label,
        html[data-theme="dark"] .visitor-summary-line {
            color: rgba(226, 230, 243, .78);
        }

        html[data-theme="dark"] .empty-state {
            color: #aaa;
        }

        html[data-theme="dark"] .pagination-modern .page-link {
            background: rgba(226, 230, 243, 0.08);
            color: #e2e6f3;
        }

        html[data-theme="dark"] .pagination-modern .page-link:hover {
            background: rgba(226, 230, 243, 0.15);
        }

        html[data-theme="dark"] .pagination-modern .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
        }

        /* table hover in dark mode adjest color */
        html[data-theme="dark"] .table-custom tbody tr:hover {
            background: #4d6cd1;

        }



        /* ---------------- Elegant Toggle Switch ---------------- */
        .status-switch {
            position: relative;
            display: inline-block;
            width: 52px;
            height: 28px;
            cursor: pointer;
        }

        .status-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .status-slider {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #ddd;
            border-radius: 34px;
            transition: all 0.3s ease;
            box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .status-slider:before {
            content: "";
            position: absolute;
            height: 22px;
            width: 22px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            border-radius: 50%;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.25);
        }

        .status-switch input:checked+.status-slider {
            background: linear-gradient(135deg, #28a745, #20c997);
        }

        .status-switch input:checked+.status-slider:before {
            transform: translateX(24px);
        }

        /* Label next to switch */
        .switch-label {
            margin-left: 10px;
            font-weight: 500;
            color: #444;
        }

        /* Dark Mode */
        html[data-theme="dark"] .status-slider {
            background: #444;
        }

        html[data-theme="dark"] .status-switch input:checked+.status-slider {
            background: linear-gradient(135deg, #198754, #20c997);
        }

        html[data-theme="dark"] .switch-label {
            color: #ddd;
        }
    </style>
@endpush

@section('main-content')
    <div class="row g-3 mb-4">
        <!-- Total Countries -->
        <div class="col-md-4">
            <div class="card-custom p-4 text-center">
                <i class="fas fa-globe fa-2x mb-2 text-primary"></i>
                <h5>Total Countries</h5>
                <h3>{{ $totalCountries }}</h3>
            </div>
        </div>

        <!-- Mobile Visitors -->
        <div class="col-md-4">
            <div class="card-custom p-4 text-center">
                <i class="fas fa-mobile-alt fa-2x mb-2 text-success"></i>
                <h5>Mobile Visitors</h5>
                <h3>{{ $mobileVisitors }}</h3>
            </div>
        </div>

        <!-- Web Visitors -->
        <div class="col-md-4">
            <div class="card-custom p-4 text-center">
                <i class="fas fa-desktop fa-2x mb-2 text-info"></i>
                <h5>Web Visitors</h5>
                <h3>{{ $webVisitors }}</h3>
            </div>
        </div>
    </div>

    <div class="card-custom">
        <div class="card-header-custom">
            <i class="fas fa-users"></i> Visitor Statistics
        </div>
        <form method="GET" class="visitor-filter-panel">
            <div class="row g-3 align-items-end">
                <div class="col-lg-4 col-md-6">
                    <label class="form-label" for="visitorSearch">Search</label>
                    <input id="visitorSearch" type="search" name="search" class="form-control"
                        value="{{ $filters['search'] ?? '' }}"
                        placeholder="IP, country, city, referrer, or browser">
                </div>
                <div class="col-lg-2 col-md-6">
                    <label class="form-label" for="visitorCountry">Country</label>
                    <select id="visitorCountry" name="country" class="form-select">
                        <option value="">All Countries</option>
                        @foreach ($countryOptions as $country)
                            <option value="{{ $country }}" @selected(($filters['country'] ?? '') === $country)>
                                {{ $country }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-6">
                    <label class="form-label" for="visitorDevice">Device</label>
                    <select id="visitorDevice" name="device" class="form-select">
                        <option value="">All Devices</option>
                        <option value="mobile" @selected(($filters['device'] ?? '') === 'mobile')>Mobile</option>
                        <option value="desktop" @selected(($filters['device'] ?? '') === 'desktop')>Desktop/Web</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-6">
                    <label class="form-label" for="visitorStatus">Status</label>
                    <select id="visitorStatus" name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="active" @selected(($filters['status'] ?? '') === 'active')>Active</option>
                        <option value="blocked" @selected(($filters['status'] ?? '') === 'blocked')>Blocked</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-6">
                    <label class="form-label" for="visitorFrom">From</label>
                    <input id="visitorFrom" type="date" name="date_from" class="form-control"
                        value="{{ $filters['date_from'] ?? '' }}">
                </div>
                <div class="col-lg-2 col-md-6">
                    <label class="form-label" for="visitorTo">To</label>
                    <input id="visitorTo" type="date" name="date_to" class="form-control"
                        value="{{ $filters['date_to'] ?? '' }}">
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="visitor-filter-actions">
                        <button class="btn btn-primary flex-fill" type="submit">
                            <i class="bi bi-funnel"></i> Apply Filters
                        </button>
                        <a href="{{ route('visitors.index') }}" class="btn btn-outline-secondary flex-fill">
                            <i class="bi bi-arrow-counterclockwise"></i> Reset
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="visitor-summary-line">
                        Showing {{ $data->firstItem() ?? 0 }} to {{ $data->lastItem() ?? 0 }} of
                        {{ $data->total() }} visitor records.
                    </div>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle table-custom mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>IP Address</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>User Agent</th>
                        <th>Visited At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $visitor)
                        <tr>
                            <td>{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td>
                            <td>{{ $visitor->ip }}</td>
                            <td>{{ $visitor->country ?: 'N/A' }}</td>
                            <td>{{ $visitor->city ?: 'N/A' }}</td>

                            <td>
                                <span class="truncate-text" title="{{ $visitor->user_agent }}">
                                    {{ $visitor->user_agent }}
                                </span>
                            </td>
                            <td>{{ $visitor->created_at->format('d M, Y h:i A') }}</td>
                            <td>
                                <label class="status-switch">
                                    <input type="checkbox" class="status-toggle" data-id="{{ $visitor->id }}"
                                        {{ $visitor->status === 'active' ? 'checked' : '' }}>
                                    <span class="status-slider"></span>
                                </label>
                                <span class="switch-label">{{ ucfirst($visitor->status) }}</span>
                            </td>
                            <td>
                                <form id="{{ $visitor->id . 'delete-form' }}" class="d-inline visitor-delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $visitor->id }}">
                                    <button type="button" class="btn btn-sm btn-outline-danger visitor-delete-btn"
                                        title="Delete"
                                        data-confirm-title="Delete visitor?"
                                        data-confirm-message="Are you sure you want to delete this visitor record? This action cannot be undone."
                                        data-confirm-button="Delete Visitor">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <i class="fas fa-user-slash"></i>
                                    <p>No visitor data available.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-3 d-flex justify-content-end">
            {{ $data->links('vendor.pagination.visitors') }}
        </div>
    </div>

    <div class="card-custom mt-5 mb-4">
        <div class="card-header-custom">
            <i class="fas fa-chart-pie"></i> Visitors by Country
        </div>
        <div class="p-3">
            <canvas id="countryChart" height="120"></canvas>
        </div>
    </div>



    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctx = document.getElementById('countryChart').getContext('2d');
            const countryChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($countryStats->pluck('country')),
                    datasets: [{
                        label: 'Visitors',
                        data: @json($countryStats->pluck('total')),
                        backgroundColor: 'rgba(67, 97, 238, 0.7)',
                        borderColor: 'rgba(67, 97, 238, 1)',
                        borderWidth: 1,
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

        <script>
            // Toggle visitor status
            $(document).on('change', '.status-toggle', function() {
                const visitorId = $(this).data('id');
                const $statusCell = $(this).closest('td');
                const isChecked = $(this).is(':checked');

                $.ajax({
                    url: @json(route('visitor.toggleStatus', [], false)),
                    method: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: visitorId
                    },
                    success: function(response) {
                        $statusCell.find('.switch-label').text(
                            response.newStatus.charAt(0).toUpperCase() + response.newStatus.slice(1)
                        );
                        showFlash(response.message, 'success');
                    },
                    error: function() {
                        // revert checkbox if error
                        $(this).prop('checked', !isChecked);
                        showFlash('Failed to update status. Please try again.', 'error');
                    }.bind(this)
                });
            });


            $(document).on('click', '.visitor-delete-btn', function(event) {
                event.preventDefault();
                const $form = $(this).closest('form');
                const $button = $(this);

                window.showAdminConfirm({
                    title: $button.data('confirm-title') || 'Delete visitor?',
                    message: $button.data('confirm-message') || 'This visitor record will be permanently deleted.',
                    confirmText: $button.data('confirm-button') || 'Delete Visitor',
                    variant: 'danger'
                }).then((confirmed) => {
                    if (!confirmed) {
                        return;
                    }

                    $button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span>');

                    $.ajax({
                        url: @json(route('visitor.delete', [], false)),
                        method: 'DELETE',
                        data: $form.serialize(),
                        success: function() {
                            $form.closest('tr').fadeOut(300, function() {
                                $(this).remove();
                            });

                            showFlash('Visitor deleted successfully.', 'success');
                        },
                        error: function() {
                            showFlash('Failed to delete Visitor. Please try again.', 'error');
                        },
                        complete: function() {
                            $button.prop('disabled', false).html('<i class="bi bi-trash3"></i>');
                        }
                    });
                });
            });

            // Function to show beautiful flash alerts
            function showFlash(message, type) {
                const icon = type === 'success' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>';
                const $alert = $(`<div class="flash-alert ${type}">${icon} ${message}</div>`);

                $('body').append($alert);

                setTimeout(() => {
                    $alert.fadeOut(400, function() {
                        $(this).remove();
                    });
                }, 3000);
            }
        </script>
    @endpush
@endsection
