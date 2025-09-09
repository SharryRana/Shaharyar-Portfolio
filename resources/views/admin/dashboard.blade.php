@extends('admin.layouts.master')
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
                                <h2 class="card-text">{{ $totalVisitors }}</h2>
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
                                <h2 class="card-text">{{ $activeVisitors }}</h2>
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
                                <h2 class="card-text">{{ $totalMessages }}</h2>
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
                                <h2 class="card-text">{{ $unreadMessages }}</h2>
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
                            @forelse ($recentMessages as $message)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">{{ $message->subject ?? 'No Subject' }}</h6>
                                        <small class="text-muted">{{ $message->name }} ({{ $message->email }})</small><br>
                                        <small>{{ Str::limit($message->message, 80) }}</small>
                                    </div>
                                    <span
                                        class="badge {{ $message->read_or_not == 0 ? 'bg-danger' : 'bg-success' }} rounded-pill">
                                        {{ $message->read_or_not == 0 ? 'Unread' : 'Read' }}
                                    </span>
                                </li>
                            @empty
                                <li class="list-group-item text-center">No recent messages found.</li>
                            @endforelse
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


        // Visitors Chart
        const visitorsCanvas = document.getElementById('visitorsChart');
        if (visitorsCanvas) {
            new Chart(visitorsCanvas, {
                type: 'line',
                data: {
                    labels: monthLabels,
                    datasets: [{
                        label: 'Visitors',
                        data: @json(array_values($visitorStats)),
                        borderColor: '#4361ee',
                        backgroundColor: 'rgba(67, 97, 238, 0.1)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }

        // Messages Chart
        const messagesCanvas = document.getElementById('messagesChart');
        if (messagesCanvas) {
            new Chart(messagesCanvas, {
                type: 'bar',
                data: {
                    labels: monthLabels,
                    datasets: [{
                        label: 'Messages',
                        data: @json(array_values($messageStats)),
                        backgroundColor: '#f72585'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }
    </script>
@endpush
