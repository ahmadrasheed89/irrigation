<x-app-layout>
    <div class="content">
        <!-- Header Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">📊 ADP Scheme Details</h5>
                    <p class="mb-0 mt-1 opacity-75">Comprehensive overview of {{ $adp->adp_code }} - Allocation, Expenditure & Progress Tracking</p>
                </div>
                <div class="btn-group">
                    <a href="{{ url()->previous() }}" class="btn btn-light d-flex align-items-center">
                        <i class="ph-arrow-left me-2"></i>Back to Dashboard
                    </a>
                    <button class="btn btn-light d-flex align-items-center">
                        <i class="ph-download-simple me-2"></i>Export Report
                    </button>
                </div>
            </div>
        </div>

        <!-- Key Metrics Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-primary bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-currency-circle-dollar fs-2 text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0">Rs.{{ number_format($adp->allocation, 0) }}</h4>
                                <p class="mb-0 text-muted">Total Allocation</p>
                            </div>
                        </div>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-primary" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-success bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-trend-up fs-2 text-success"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0">Rs.{{ number_format($totals['expenditure'], 0) }}</h4>
                                <p class="mb-0 text-muted">Total Expenditure</p>
                            </div>
                        </div>
                        @php
                            $expenditurePercentage = $adp->allocation > 0 ? ($totals['expenditure'] / $adp->allocation) * 100 : 0;
                        @endphp
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-success" style="width: {{ min($expenditurePercentage, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-warning bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-warning-circle fs-2 text-warning"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0">Rs.{{ number_format($totals['liability'], 0) }}</h4>
                                <p class="mb-0 text-muted">Total Liability</p>
                            </div>
                        </div>
                        @php
                            $liabilityPercentage = $adp->allocation > 0 ? ($totals['liability'] / $adp->allocation) * 100 : 0;
                        @endphp
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-warning" style="width: {{ min($liabilityPercentage, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-info bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-list-checks fs-2 text-info"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0">{{ $adp->schemes->count() }}</h4>
                                <p class="mb-0 text-muted">Total Schemes</p>
                            </div>
                        </div>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-info" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Overview -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">📈 Physical Progress</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <h2 class="text-primary">{{ number_format($totals['physical_progress'], 1) }}%</h2>
                            <small class="text-muted">Average Physical Progress</small>
                        </div>
                        <div class="progress" style="height: 12px; border-radius: 6px;">
                            <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated"
                                 style="width: {{ $totals['physical_progress'] }}%; border-radius: 6px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">💰 Financial Progress</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <h2 class="text-success">{{ number_format($totals['financial_progress'], 1) }}%</h2>
                            <small class="text-muted">Average Financial Progress</small>
                        </div>
                        <div class="progress" style="height: 12px; border-radius: 6px;">
                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                 style="width: {{ $totals['financial_progress'] }}%; border-radius: 6px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Schemes Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-0 fw-semibold">🏗️ Schemes Under ADP: <strong class="text-primary">{{ $adp->adp_code }}</strong></h6>
                    <span class="badge bg-primary ms-2">{{ $adp->schemes->count() }} Schemes</span>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Scheme Name</th>
                                <th class="text-end">Bid Cost</th>
                                <th class="text-end">T.S Cost</th>
                                <th class="text-end">Expenditure</th>
                                <th class="text-end">Liability</th>
                                <th>Physical Progress</th>
                                <th>Financial Progress</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($adp->schemes as $index => $scheme)
                                @php
                                    $physicalColor = $scheme->physical_progress >= 80 ? 'success' :
                                                   ($scheme->physical_progress >= 50 ? 'warning' : 'danger');
                                    $financialColor = $scheme->financial_progress >= 80 ? 'success' :
                                                    ($scheme->financial_progress >= 50 ? 'warning' : 'danger');
                                    $overallStatus = $scheme->physical_progress >= 80 && $scheme->financial_progress >= 80 ? 'Completed' :
                                                   ($scheme->physical_progress >= 50 ? 'In Progress' : 'Not Started');
                                    $statusColor = $overallStatus == 'Completed' ? 'success' :
                                                 ($overallStatus == 'In Progress' ? 'warning' : 'secondary');
                                @endphp
                                <tr class="border-start border-primary border-3">
                                    <td class="ps-4 fw-semibold">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $scheme->name }}</div>
                                        <small class="text-muted">Code: SCH-{{ $scheme->id }}</small>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-bold">Rs.{{ number_format($scheme->bid_cost, 0) }}</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-bold text-primary">Rs.{{ number_format($scheme->sub_work_t_s_cost, 0) }}</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-bold text-success">Rs.{{ number_format($scheme->expenditure, 0) }}</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-bold text-warning">Rs.{{ number_format($scheme->liability, 0) }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 me-2" style="height: 8px; border-radius: 4px;">
                                                <div class="progress-bar bg-{{ $physicalColor }} progress-bar-striped"
                                                     style="width: {{ $scheme->physical_progress }}%; border-radius: 4px;">
                                                </div>
                                            </div>
                                            <small class="fw-semibold text-{{ $physicalColor }}" style="min-width: 45px;">
                                                {{ $scheme->physical_progress }}%
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 me-2" style="height: 8px; border-radius: 4px;">
                                                <div class="progress-bar bg-{{ $financialColor }} progress-bar-striped"
                                                     style="width: {{ $scheme->financial_progress }}%; border-radius: 4px;">
                                                </div>
                                            </div>
                                            <small class="fw-semibold text-{{ $financialColor }}" style="min-width: 45px;">
                                                {{ $scheme->financial_progress }}%
                                            </small>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $statusColor }} rounded-pill">
                                            {{ $overallStatus }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light fw-bold">
                            <tr>
                                <td colspan="2" class="ps-4">Totals / Averages</td>
                                <td class="text-end">Rs.{{ number_format($adp->schemes->sum('bid_cost'), 0) }}</td>
                                <td class="text-end">Rs.{{ number_format($totals['sub_work_t_s_cost'], 0) }}</td>
                                <td class="text-end">Rs.{{ number_format($totals['expenditure'], 0) }}</td>
                                <td class="text-end">Rs.{{ number_format($totals['liability'], 0) }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress flex-grow-1 me-2" style="height: 8px; border-radius: 4px;">
                                            <div class="progress-bar bg-primary"
                                                 style="width: {{ $totals['physical_progress'] }}%; border-radius: 4px;">
                                            </div>
                                        </div>
                                        <small class="fw-semibold text-primary" style="min-width: 45px;">
                                            {{ number_format($totals['physical_progress'], 1) }}%
                                        </small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress flex-grow-1 me-2" style="height: 8px; border-radius: 4px;">
                                            <div class="progress-bar bg-success"
                                                 style="width: {{ $totals['financial_progress'] }}%; border-radius: 4px;">
                                            </div>
                                        </div>
                                        <small class="fw-semibold text-success" style="min-width: 45px;">
                                            {{ number_format($totals['financial_progress'], 1) }}%
                                        </small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @php
                                        $overallAvg = ($totals['physical_progress'] + $totals['financial_progress']) / 2;
                                        $finalStatus = $overallAvg >= 80 ? 'On Track' :
                                                     ($overallAvg >= 50 ? 'Moderate' : 'Needs Attention');
                                        $finalColor = $finalStatus == 'On Track' ? 'success' :
                                                    ($finalStatus == 'Moderate' ? 'warning' : 'danger');
                                    @endphp
                                    <span class="badge bg-{{ $finalColor }} rounded-pill">
                                        {{ $finalStatus }}
                                    </span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Summary Footer -->
            <div class="card-footer bg-light">
                <div class="row text-center">
                    <div class="col-md-3 border-end">
                        <div class="fw-bold text-primary fs-4">Rs.{{ number_format($adp->allocation, 0) }}</div>
                        <small class="text-muted">Total Allocation</small>
                    </div>
                    <div class="col-md-3 border-end">
                        <div class="fw-bold text-success fs-4">Rs.{{ number_format($totals['expenditure'], 0) }}</div>
                        <small class="text-muted">Total Expenditure</small>
                    </div>
                    <div class="col-md-3 border-end">
                        @php
                            $utilization = $adp->allocation > 0 ? ($totals['expenditure'] / $adp->allocation) * 100 : 0;
                        @endphp
                        <div class="fw-bold text-info fs-4">{{ number_format($utilization, 1) }}%</div>
                        <small class="text-muted">Budget Utilization</small>
                    </div>
                    <div class="col-md-3">
                        <div class="fw-bold text-warning fs-4">Rs.{{ number_format($totals['liability'], 0) }}</div>
                        <small class="text-muted">Pending Liability</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    .table > :not(caption) > * > * {
        padding: 0.75rem 0.5rem;
        vertical-align: middle;
    }
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.375rem rgba(0,0,0,0.05);
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add hover effects to table rows
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.backgroundColor = 'rgba(0,0,0,0.02)';
            });
            row.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '';
            });
        });

        // Animate progress bars on scroll
        const progressBars = document.querySelectorAll('.progress-bar');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const progressBar = entry.target;
                    const width = progressBar.style.width;
                    progressBar.style.width = '0%';
                    setTimeout(() => {
                        progressBar.style.width = width;
                        progressBar.style.transition = 'width 1s ease-in-out';
                    }, 100);
                }
            });
        });

        progressBars.forEach(bar => observer.observe(bar));
    });
    </script>
</x-app-layout>
