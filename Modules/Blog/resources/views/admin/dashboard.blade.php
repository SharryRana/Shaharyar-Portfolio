@extends('blog::admin.layouts.master')
@section('main-content')
    <div id="view-dashboard">
        <!-- Dashboard Stats -->
        <div class="row">
            <!-- Total Visitors -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-4">
                <div class="card stat-card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Total Visitors</h6>
                                <h2 class="card-text">{{ null }}</h2>
                                <p class="card-text"><small><i class="bi bi-people"></i> Total number of site visitors</small>
                                </p>
                            </div>
                            <i class="bi bi-people fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Visitors -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-4">
                <div class="card stat-card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Active Visitors</h6>
                                <h2 class="card-text">{{ null }}</h2>
                                <p class="card-text"><small><i class="bi bi-check-circle"></i> Currently active</small></p>
                            </div>
                            <i class="bi bi-person-check fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Messages -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-4">
                <div class="card stat-card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Total Messages</h6>
                                <h2 class="card-text">{{ null }}</h2>
                                <p class="card-text"><small><i class="bi bi-envelope"></i> Messages received</small></p>
                            </div>
                            <i class="bi bi-envelope fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Unread Messages -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-4">
                <div class="card stat-card bg-danger text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Unread Messages</h6>
                                <h2 class="card-text">{{ null }}</h2>
                                <p class="card-text"><small><i class="bi bi-envelope-exclamation"></i> Need
                                        attention</small></p>
                            </div>
                            <i class="bi bi-envelope-exclamation fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row">
            <!-- Visitors per Month -->
            <div class="col-xl-8 col-lg-7 mb-4">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Visitors Per Month</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="height:300px">
                            <canvas id="visitorsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Messages per Month -->
            <div class="col-xl-4 col-lg-5 mb-4">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Messages Per Month</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="height:300px">
                            <canvas id="messagesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Messages -->
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Recent Messages</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const monthLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    </script>
@endpush
