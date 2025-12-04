<x-app-layout>
    <div class="content">
        <!-- Header Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">📊 Task Analytics Dashboard</h5>
                    <p class="mb-0 mt-1 opacity-75">Real-time insights into task performance and team productivity</p>
                </div>
                <div class="btn-group">
                    <a href="{{ url()->previous() }}" class="btn btn-light d-flex align-items-center">
                        <i class="ph-arrow-left me-2"></i>Back
                    </a>
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                            <i class="ph-download-simple me-2"></i>Export
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="ph-file-pdf me-2"></i>PDF Report
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="ph-file-csv me-2"></i>Excel Data
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="ph-printer me-2"></i>Print
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- KPI Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-primary bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-list-checks fs-2 text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0" id="kpi-total">—</h4>
                                <p class="mb-0 text-muted">Total Tasks</p>
                            </div>
                        </div>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-primary" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-success bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-check-circle fs-2 text-success"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0" id="kpi-throughput">—</h4>
                                <p class="mb-0 text-muted">Completed (12 weeks)</p>
                            </div>
                        </div>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-success" style="width: 70%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-info bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-timer fs-2 text-info"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0" id="kpi-cycle">—</h4>
                                <p class="mb-0 text-muted">Avg Cycle Time (days)</p>
                            </div>
                        </div>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-info" style="width: 60%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-warning bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-gear fs-2 text-warning"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0" id="kpi-wip">—</h4>
                                <p class="mb-0 text-muted">Work In Progress</p>
                            </div>
                        </div>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-warning" style="width: 45%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row 1 -->
        <div class="row mb-4">
            <!-- Throughput Chart -->
            <div class="col-xl-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-semibold">📈 Task Completion Trend</h6>
                        <div>
                            <select class="form-select form-select-sm" id="time-period">
                                <option value="12">Last 12 Weeks</option>
                                <option value="8">Last 8 Weeks</option>
                                <option value="4">Last 4 Weeks</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="chartThroughput" height="280"></canvas>
                    </div>
                </div>
            </div>

            <!-- Status Distribution -->
            <div class="col-xl-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">🎯 Task Status Distribution</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="chartStatus" height="280"></canvas>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="row text-center" id="status-summary">
                            <!-- Dynamic status summary will be inserted here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row 2 -->
        <div class="row mb-4">
            <!-- Priority Distribution -->
            <div class="col-xl-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">🚨 Tasks by Priority</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="chartPriority" height="220"></canvas>
                    </div>
                </div>
            </div>

            <!-- User Workload -->
            <div class="col-xl-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">👥 Team Workload</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="chartPerUser" height="220"></canvas>
                    </div>
                </div>
            </div>

            <!-- Aging Analysis -->
            <div class="col-xl-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">⏰ Task Aging Analysis</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-2 text-center" id="agingBuckets">
                            <!-- Aging buckets will be inserted here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Row -->
        <div class="row">
            <!-- Stale Tasks -->
            <div class="col-xl-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light d-flex align-items-center">
                        <h6 class="mb-0 fw-semibold">⚠️ Attention Required</h6>
                        <span class="badge bg-danger ms-2" id="stale-count">0</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Task Title</th>
                                        <th>Age</th>
                                        <th>Status</th>
                                        <th class="pe-4">Priority</th>
                                    </tr>
                                </thead>
                                <tbody id="staleList">
                                    <!-- Stale tasks will be inserted here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Performance Metrics & Quick Actions -->
            <div class="col-xl-6">
                <!-- Performance Metrics -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">📋 Performance Summary</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3" id="performance-metrics">
                            <!-- Performance metrics will be inserted here -->
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">⚡ Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-6">
                                <button class="btn btn-outline-primary w-100 btn-sm d-flex align-items-center justify-content-center">
                                    <i class="ph-plus-circle me-1"></i>New Task
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-outline-success w-100 btn-sm d-flex align-items-center justify-content-center">
                                    <i class="ph-export me-1"></i>Export Data
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-outline-info w-100 btn-sm d-flex align-items-center justify-content-center">
                                    <i class="ph-funnel me-1"></i>Filter Tasks
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-outline-warning w-100 btn-sm d-flex align-items-center justify-content-center">
                                    <i class="ph-clock me-1"></i>Set Reminder
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const colors = {
            primary: '#4e79a7',
            success: '#59a14f',
            warning: '#edc949',
            danger: '#e15759',
            info: '#76b7b2',
            secondary: '#b07aa1',
            dark: '#343a40'
        };

        // Initialize charts with better styling
        const ctxThroughput = document.getElementById('chartThroughput');
        const ctxStatus = document.getElementById('chartStatus');
        const ctxPriority = document.getElementById('chartPriority');
        const ctxPerUser = document.getElementById('chartPerUser');

        const chartThroughput = new Chart(ctxThroughput, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Tasks Completed',
                    data: [],
                    tension: 0.4,
                    borderColor: colors.primary,
                    backgroundColor: 'rgba(78, 121, 167, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    pointBackgroundColor: colors.primary,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: { size: 12 },
                        bodyFont: { size: 13 }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { drawBorder: false },
                        ticks: { stepSize: 1 }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });

        const chartStatus = new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    data: [],
                    backgroundColor: [
                        colors.success,
                        colors.primary,
                        colors.warning,
                        colors.danger,
                        colors.info,
                        colors.secondary
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
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
                            font: { size: 11 }
                        }
                    }
                }
            }
        });

        const chartPriority = new Chart(ctxPriority, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Tasks',
                    data: [],
                    backgroundColor: [
                        colors.danger,
                        colors.warning,
                        colors.primary,
                        colors.info
                    ],
                    borderWidth: 0,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { drawBorder: false }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });

        const chartPerUser = new Chart(ctxPerUser, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Open Tasks',
                    data: [],
                    backgroundColor: colors.primary,
                    borderWidth: 0,
                    borderRadius: 4
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: { drawBorder: false }
                    },
                    y: {
                        grid: { display: false }
                    }
                }
            }
        });

        function render(data) {
            // Update KPIs
            const total = (Object.values(data.status || {}).reduce((a, b) => a + (b || 0), 0)) || 0;
            document.getElementById('kpi-total').textContent = total.toLocaleString();
            document.getElementById('kpi-throughput').textContent =
                Object.values(data.throughput || {}).reduce((a, b) => a + (b || 0), 0);
            document.getElementById('kpi-cycle').textContent = data.avgCycle || '0';
            document.getElementById('kpi-wip').textContent = data.wip || '0';

            // Throughput Chart
            const throughputLabels = Object.keys(data.throughput || {});
            const throughputData = Object.values(data.throughput || {});
            chartThroughput.data.labels = throughputLabels;
            chartThroughput.data.datasets[0].data = throughputData;
            chartThroughput.update();

            // Status Chart
            chartStatus.data.labels = Object.keys(data.status || {});
            chartStatus.data.datasets[0].data = Object.values(data.status || {});
            chartStatus.update();

            // Status Summary
            const statusSummary = document.getElementById('status-summary');
            if (statusSummary) {
                let summaryHtml = '';
                Object.keys(data.status || {}).forEach((status, index) => {
                    const count = data.status[status];
                    const percentage = total > 0 ? ((count / total) * 100).toFixed(1) : 0;
                    summaryHtml += `
                        <div class="col-4">
                            <div class="small text-muted">${status}</div>
                            <div class="fw-bold">${count}</div>
                            <small class="text-muted">${percentage}%</small>
                        </div>
                    `;
                });
                statusSummary.innerHTML = summaryHtml;
            }

            // Priority Chart
            chartPriority.data.labels = Object.keys(data.priority || {});
            chartPriority.data.datasets[0].data = Object.values(data.priority || {});
            chartPriority.update();

            // Per User Chart
            chartPerUser.data.labels = Object.keys(data.perUser || {});
            chartPerUser.data.datasets[0].data = Object.values(data.perUser || {});
            chartPerUser.update();

            // Aging Buckets
            const agingBuckets = document.getElementById('agingBuckets');
            if (agingBuckets && data.aging) {
                let agingHtml = '';
                const agingColors = [colors.success, colors.primary, colors.warning, colors.danger];
                let colorIndex = 0;

                for(const [key, value] of Object.entries(data.aging)) {
                    agingHtml += `
                        <div class="col-6">
                            <div class="card border-0 text-white text-center p-3"
                                 style="background: ${agingColors[colorIndex % agingColors.length]}">
                                <div class="h3 mb-1">${value}</div>
                                <small>${key} days</small>
                            </div>
                        </div>
                    `;
                    colorIndex++;
                }
                agingBuckets.innerHTML = agingHtml;
            }

            // Stale Tasks
            const staleList = document.getElementById('staleList');
            const staleCount = document.getElementById('stale-count');
            if (staleList && data.stale) {
                let staleHtml = '';
                data.stale.forEach(task => {
                    const priorityClass = task.priority === 'High' ? 'badge bg-danger' :
                                        task.priority === 'Medium' ? 'badge bg-warning' : 'badge bg-info';
                    staleHtml += `
                        <tr>
                            <td class="ps-4">
                                <div class="fw-semibold">${task.title}</div>
                                <small class="text-muted">Created: ${task.created_date || 'N/A'}</small>
                            </td>
                            <td>
                                <span class="badge bg-dark">${task.age_days} days</span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">${task.status}</span>
                            </td>
                            <td class="pe-4">
                                <span class="${priorityClass}">${task.priority || 'Normal'}</span>
                            </td>
                        </tr>
                    `;
                });
                staleList.innerHTML = staleHtml;
                staleCount.textContent = data.stale.length;
            }

            // Performance Metrics
            const performanceMetrics = document.getElementById('performance-metrics');
            if (performanceMetrics) {
                const completionRate = total > 0 ? ((data.throughput ? Object.values(data.throughput).reduce((a, b) => a + b, 0) : 0) / total * 100).toFixed(1) : 0;
                performanceMetrics.innerHTML = `
                    <div class="col-6">
                        <div class="text-center p-3 border rounded bg-light">
                            <div class="h4 text-success mb-1">${completionRate}%</div>
                            <small class="text-muted">Completion Rate</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center p-3 border rounded bg-light">
                            <div class="h4 text-primary mb-1">${data.avgCycle || 0}</div>
                            <small class="text-muted">Avg Cycle Days</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center p-3 border rounded bg-light">
                            <div class="h4 text-warning mb-1">${data.wip || 0}</div>
                            <small class="text-muted">Work In Progress</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center p-3 border rounded bg-light">
                            <div class="h4 text-info mb-1">${data.stale ? data.stale.length : 0}</div>
                            <small class="text-muted">Stale Tasks</small>
                        </div>
                    </div>
                `;
            }
        }

        // Initial data fetch
        fetch('{{ route("reports.data") }}')
            .then(response => response.json())
            .then(data => render(data))
            .catch(error => console.error('Error fetching data:', error));

        // Auto-refresh every 60 seconds
        setInterval(() => {
            fetch('{{ route("reports.data") }}')
                .then(response => response.json())
                .then(data => render(data))
                .catch(error => console.error('Error fetching data:', error));
        }, 60000);

        // Time period selector
        document.getElementById('time-period')?.addEventListener('change', function(e) {
            // Implement period change logic here
            console.log('Time period changed to:', e.target.value);
        });
    });
    </script>

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
    .badge {
        font-size: 0.75rem;
    }
    .progress-bar-striped {
        background-image: linear-gradient(45deg, rgba(255,255,255,0.15) 25%, transparent 25%, transparent 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, transparent 75%, transparent);
        background-size: 1rem 1rem;
    }
    .progress-bar-animated {
        animation: progress-bar-stripes 1s linear infinite;
    }
    @keyframes progress-bar-stripes {
        0% { background-position: 1rem 0; }
        100% { background-position: 0 0; }
    }
    </style>
</x-app-layout>
