<x-app-layout>
    <div class="content">
        <!-- Header Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">📊 Dashboard Overview</h5>
                    <p class="mb-0 mt-1 opacity-75">Comprehensive analytics and performance insights for better decision making</p>
                </div>
                <div class="btn-group">
                    <button class="btn btn-light d-flex align-items-center">
                        <i class="ph-download-simple me-2"></i>Export Report
                    </button>
                    <button class="btn btn-light d-flex align-items-center">
                        <i class="ph-clock-counter-clockwise me-2"></i>Refresh Data
                    </button>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-primary bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-buildings fs-2 text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0">{{ $stats['adps'] }}</h4>
                                <p class="mb-0 text-muted">Total ADPs</p>
                            </div>
                        </div>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-primary" style="width: 75%"></div>
                        </div>
                    </div>
                    <a href="{{ route('adps.dashboard') }}" class="stretched-link"></a>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-success bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-gavel fs-2 text-success"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0">{{ $stats['tenders'] }}</h4>
                                <p class="mb-0 text-muted">Active Tenders</p>
                            </div>
                        </div>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-success" style="width: 60%"></div>
                        </div>
                    </div>
                    <a href="{{ route('tenders.index') }}" class="stretched-link"></a>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-info bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-file-text fs-2 text-info"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0">{{ $stats['nocs'] }}</h4>
                                <p class="mb-0 text-muted">NOCs Processed</p>
                            </div>
                        </div>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-info" style="width: 85%"></div>
                        </div>
                    </div>
                    <a href="{{ route('nocs.index') }}" class="stretched-link"></a>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                @php
                    $totalAllocation = $adps->sum('allocation');
                    $totalExpenditure = $adps->sum('schemes_sum_expenditure');
                    $utilizationRate = $totalAllocation > 0 ? ($totalExpenditure / $totalAllocation) * 100 : 0;
                @endphp
                <div class="card border-0 bg-warning bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-trend-up fs-2 text-warning"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0">{{ number_format($utilizationRate, 1) }}%</h4>
                                <p class="mb-0 text-muted">Budget Utilization</p>
                            </div>
                        </div>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-warning" style="width: {{ $utilizationRate }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Advanced Analytics Section -->
        <div class="row">
            <!-- Main Charts Column -->
            <div class="col-xl-8">
                <!-- Performance Overview Chart -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0 fw-semibold">📈 Performance Overview</h6>
                            <span class="badge bg-primary ms-2">Real-time</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <select class="form-select form-select-sm me-2" style="width: 120px;" id="chartPeriod">
                                <option value="monthly">Monthly</option>
                                <option value="quarterly">Quarterly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-light active" data-period="30d">30D</button>
                                <button class="btn btn-light" data-period="90d">90D</button>
                                <button class="btn btn-light" data-period="1y">1Y</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="performanceChart" height="300"></canvas>
                    </div>
                </div>

                <!-- Financial Analytics Row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h6 class="mb-0 fw-semibold">💰 Budget Distribution</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="budgetChart" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h6 class="mb-0 fw-semibold">📊 Utilization Trends</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="utilizationChart" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Column -->
            <div class="col-xl-4">
                <!-- Latest ADPs -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0 fw-semibold">📋 Latest ADPs</h6>
                            <span class="badge bg-primary ms-2">{{ $adps->count() }}</span>
                        </div>
                        <a href="{{ route('adps.dashboard') }}" class="btn btn-sm btn-light">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">ADP Code</th>
                                        <th class="text-end">Allocation</th>
                                        <th class="text-end">Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($adps->take(5) as $adp)
                                    @php
                                        $utilization = $adp->allocation > 0 ? ($adp->schemes_sum_expenditure / $adp->allocation) * 100 : 0;
                                        $progressColor = $utilization >= 80 ? 'success' : ($utilization >= 50 ? 'warning' : 'danger');
                                    @endphp
                                    <tr class="cursor-pointer border-start border-primary border-3" onclick="window.location='{{ route('adps.schemedetail', $adp) }}'">
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-40px me-3">
                                                    <div class="symbol-label bg-light-primary rounded">
                                                        <i class="ph-buildings text-primary"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold text-dark">{{ $adp->adp_code ?? '-' }}</div>
                                                    <div class="text-muted small">{{ Str::limit($adp->name, 20) ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <span class="fw-bold text-primary">₹{{ number_format($adp->allocation, 0) }}</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex align-items-center justify-content-end">
                                                <div class="progress flex-grow-1 me-2" style="height: 6px; width: 60px;">
                                                    <div class="progress-bar bg-{{ $progressColor }}" style="width: {{ min($utilization, 100) }}%"></div>
                                                </div>
                                                <small class="fw-semibold text-{{ $progressColor }}" style="min-width: 40px;">
                                                    {{ number_format($utilization, 0) }}%
                                                </small>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="ph-buildings fs-1 text-muted mb-3"></i>
                                                <p class="text-muted mb-2">No ADPs Found</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Quick Analytics -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">⚡ Quick Analytics</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6 mb-3">
                                <div class="border rounded p-3 bg-primary bg-opacity-5">
                                    <div class="fw-bold text-primary fs-4">{{ $adps->count() }}</div>
                                    <small class="text-muted">Total ADPs</small>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="border rounded p-3 bg-success bg-opacity-5">
                                    <div class="fw-bold text-success fs-4">{{ $stats['tenders'] }}</div>
                                    <small class="text-muted">Active Tenders</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="border rounded p-3 bg-info bg-opacity-5">
                                    <div class="fw-bold text-info fs-4">₹{{ number_format($totalAllocation / 10000000, 1) }}Cr</div>
                                    <small class="text-muted">Total Allocation</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="border rounded p-3 bg-warning bg-opacity-5">
                                    <div class="fw-bold text-warning fs-4">₹{{ number_format($totalExpenditure / 10000000, 1) }}Cr</div>
                                    <small class="text-muted">Total Spent</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Performance Metrics -->
                <div class="card shadow-sm mt-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">📊 Performance Metrics</h6>
                    </div>
                    <div class="card-body">
                        @php
                            $completedProjects = $adps->where('schemes_sum_expenditure', '>=', 0.9 * $totalAllocation)->count();
                            $onTrackProjects = $adps->whereBetween('schemes_sum_expenditure', [0.5 * $totalAllocation, 0.9 * $totalAllocation])->count();
                            $delayedProjects = $adps->where('schemes_sum_expenditure', '<', 0.5 * $totalAllocation)->count();
                        @endphp
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted">Completed Projects</span>
                                <span class="fw-semibold text-success">{{ $completedProjects }}</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-success" style="width: {{ ($completedProjects / $adps->count()) * 100 }}%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted">On Track</span>
                                <span class="fw-semibold text-warning">{{ $onTrackProjects }}</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-warning" style="width: {{ ($onTrackProjects / $adps->count()) * 100 }}%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted">Delayed</span>
                                <span class="fw-semibold text-danger">{{ $delayedProjects }}</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-danger" style="width: {{ ($delayedProjects / $adps->count()) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.375rem rgba(0,0,0,0.05);
    }
    .table > :not(caption) > * > * {
        padding: 0.75rem 0.5rem;
        vertical-align: middle;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
    }
    .cursor-pointer {
        cursor: pointer;
    }
    .symbol {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .symbol-40px {
        width: 40px;
        height: 40px;
    }
    .symbol-label {
        width: 100%;
        height: 100%;
        border-radius: 0.475rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .btn-icon {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Enhanced data with more analytics
        const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

        // Enhanced data from Laravel with additional metrics
        const schemeData = @json($schemeData);
        const tenderData = @json($tenderData);
        const budgetData = @json($budgetData ?? []);
        const utilizationData = @json($utilizationData ?? []);
        const categoryLabels = @json($categoryData->keys());
        const categoryValues = @json($categoryData->values());

        // Performance Chart (Multi-axis Line Chart)
        new Chart(document.getElementById("performanceChart"), {
            type: 'line',
            data: {
                labels: months.slice(0, 6), // Last 6 months
                datasets: [
                    {
                        label: "Budget Utilization %",
                        data: utilizationData.length ? utilizationData : [65, 72, 68, 80, 75, 82],
                        borderColor: "rgb(59, 130, 246)",
                        backgroundColor: "rgba(59, 130, 246, 0.1)",
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        yAxisID: 'y'
                    },
                    {
                        label: "Schemes Completed",
                        data: schemeData.length ? Object.values(schemeData).slice(0, 6) : [12, 19, 15, 22, 18, 25],
                        borderColor: "rgb(16, 185, 129)",
                        backgroundColor: "rgba(16, 185, 129, 0.1)",
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        yAxisID: 'y1'
                    },
                    {
                        label: "Tenders Published",
                        data: tenderData.length ? Object.values(tenderData).slice(0, 6) : [8, 12, 10, 15, 14, 18],
                        borderColor: "rgb(245, 158, 11)",
                        backgroundColor: "rgba(245, 158, 11, 0.1)",
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Utilization %'
                        },
                        min: 0,
                        max: 100
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Count'
                        },
                        grid: {
                            drawOnChartArea: false,
                        },
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        mode: 'index',
                        intersect: false
                    }
                }
            }
        });

        // Budget Distribution Chart (Doughnut with enhanced styling)
        new Chart(document.getElementById("budgetChart"), {
            type: 'doughnut',
            data: {
                labels: ['Allocated', 'Utilized', 'Pending', 'Liability'],
                datasets: [{
                    data: [
                        {{ $totalAllocation }},
                        {{ $totalExpenditure }},
                        {{ max($totalAllocation - $totalExpenditure, 0) }},
                        {{ $adps->sum('accured_liability') }}
                    ],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(156, 163, 175, 0.8)',
                        'rgba(245, 158, 11, 0.8)'
                    ],
                    borderColor: [
                        'rgb(59, 130, 246)',
                        'rgb(16, 185, 129)',
                        'rgb(156, 163, 175)',
                        'rgb(245, 158, 11)'
                    ],
                    borderWidth: 2,
                    borderRadius: 6,
                    spacing: 4
                }]
            },
            options: {
                responsive: true,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.parsed;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                return `${context.label}: ₹${(value/10000000).toFixed(1)}Cr (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Utilization Trends Chart (Bar with trend line)
        new Chart(document.getElementById("utilizationChart"), {
            type: 'bar',
            data: {
                labels: ['Q1', 'Q2', 'Q3', 'Q4'],
                datasets: [
                    {
                        label: 'Utilization Rate',
                        data: [65, 72, 68, 78],
                        backgroundColor: 'rgba(59, 130, 246, 0.7)',
                        borderColor: 'rgb(59, 130, 246)',
                        borderWidth: 1,
                        borderRadius: 6,
                        order: 2
                    },
                    {
                        label: 'Target',
                        data: [70, 70, 70, 70],
                        type: 'line',
                        borderColor: 'rgb(239, 68, 68)',
                        borderWidth: 2,
                        borderDash: [5, 5],
                        fill: false,
                        pointRadius: 0,
                        order: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        title: {
                            display: true,
                            text: 'Utilization %'
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });

        // Period selector functionality
        document.querySelectorAll('[data-period]').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('[data-period]').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                // Implement period change logic here
                console.log('Period changed to:', this.dataset.period);
            });
        });

        // Chart period selector
        document.getElementById('chartPeriod').addEventListener('change', function(e) {
            console.log('Chart period changed to:', e.target.value);
            // Implement AJAX call to fetch new data based on period
        });
    });
    </script>
</x-app-layout>
