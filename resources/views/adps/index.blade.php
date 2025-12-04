<x-app-layout>
    <div class="content">
        <!-- Header Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">🏗️ ADPs Management</h5>
                    <p class="mb-0 mt-1 opacity-75">Comprehensive overview of Annual Development Programs - Allocation, Expenditure & Progress Tracking</p>
                </div>
                <div class="btn-group">
                    <button class="btn btn-light d-flex align-items-center">
                        <i class="ph-download-simple me-2"></i>Export
                    </button>
                    <a href="{{ route('adps.create') }}" class="btn btn-light d-flex align-items-center">
                        <i class="ph-plus-circle me-2"></i>Add New ADP
                    </a>
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
                                <h4 class="mb-0">{{ $adps->count() }}</h4>
                                <p class="mb-0 text-muted">Total ADPs</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-success bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-currency-circle-dollar fs-2 text-success"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0">Rs.{{ number_format($adps->sum('allocation') / 10000000, 1) }}Cr</h4>
                                <p class="mb-0 text-muted">Total Allocation</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-warning bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-trend-up fs-2 text-warning"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0">Rs.{{ number_format($adps->sum('schemes_sum_expenditure') / 10000000, 1) }}Cr</h4>
                                <p class="mb-0 text-muted">Total Expenditure</p>
                            </div>
                        </div>
                        @php
                            $totalAllocation = $adps->sum('allocation');
                            $totalExpenditure = $adps->sum('schemes_sum_expenditure');
                            $utilization = $totalAllocation > 0 ? ($totalExpenditure / $totalAllocation) * 100 : 0;
                        @endphp
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-warning" style="width: {{ min($utilization, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-info bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-warning-circle fs-2 text-info"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0">Rs.{{ number_format($adps->sum('schemes_sum_liability') / 10000000, 1) }}Cr</h4>
                                <p class="mb-0 text-muted">Accrued Liability</p>
                            </div>
                        </div>
                        @php
                            $liabilityPercentage = $totalAllocation > 0 ? ($adps->sum('schemes_sum_liability') / $totalAllocation) * 100 : 0;
                        @endphp
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-info" style="width: {{ min($liabilityPercentage, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ADPs Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-0 fw-semibold">📋 All ADPs List</h6>
                    <span class="badge bg-primary ms-2">{{ $adps->count() }} Records</span>
                </div>
                <div class="d-flex align-items-center">
                    <div class="input-group input-group-sm me-2" style="max-width: 250px;">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="ph-magnifying-glass text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" placeholder="Search ADPs...">
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">ADP Code</th>
                                <th>Financial Details</th>
                                <th class="text-end">Allocation</th>
                                <th class="text-end">Bid Cost</th>
                                <th class="text-end">T.S Cost</th>
                                <th class="text-end">Expenditure</th>
                                <th class="text-end">Liability</th>
                                <th>Progress</th>
                                <th class="text-center">Created Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($adps as $adp)
                                @php
                                    $utilization = $adp->allocation > 0 ? ($adp->schemes_sum_expenditure / $adp->allocation) * 100 : 0;
                                    $progressColor = $utilization >= 80 ? 'success' :
                                                   ($utilization >= 50 ? 'warning' : 'danger');
                                    $schemesCount = $adp->schemes_count ?? 0;
                                @endphp
                                <tr class="border-start border-primary border-3">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-40px me-3">
                                                <div class="symbol-label bg-light-primary rounded">
                                                    <i class="ph-buildings text-primary"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="{{ route('adps.schemedetail', $adp) }}" class="fw-semibold text-dark text-decoration-none">
                                                    {{ $adp->adp_code ?? 'N/A' }}
                                                </a>
                                                <div class="text-muted small">
                                                    {{ $schemesCount }} scheme{{ $schemesCount != 1 ? 's' : '' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small text-muted">Budget Utilization</div>
                                        <div class="progress" style="height: 6px; width: 120px;">
                                            <div class="progress-bar bg-{{ $progressColor }}"
                                                 style="width: {{ min($utilization, 100) }}%"
                                                 title="{{ number_format($utilization, 1) }}% Utilized">
                                            </div>
                                        </div>
                                        <small class="text-{{ $progressColor }} fw-semibold">
                                            {{ number_format($utilization, 1) }}%
                                        </small>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-bold text-primary">Rs.{{ number_format($adp->allocation, 0) }}</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-bold text-info">Rs.{{ number_format($adp->adp_t_s_cost, 0) }}</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-bold text-secondary">Rs.{{ number_format($adp->schemes_sum_sub_work_t_s_cost, 0) }}</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-bold text-success">Rs.{{ number_format($adp->schemes_sum_expenditure, 0) }}</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-bold text-warning">Rs.{{ number_format($adp->schemes_sum_liability, 0) }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                                <div class="progress-bar bg-primary"
                                                     style="width: {{ min($utilization, 100) }}%">
                                                </div>
                                            </div>
                                            <small class="fw-semibold text-primary" style="min-width: 40px;">
                                                {{ number_format($utilization, 0) }}%
                                            </small>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="text-muted">
                                            {{ $adp->created_at->format('M d, Y') }}
                                        </div>
                                        <small class="text-muted">
                                            {{ $adp->created_at->format('h:i A') }}
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('schemes.schemeCreate', $adp) }}"
                                               class="btn btn-sm btn-light btn-icon rounded"
                                               data-bs-toggle="tooltip"
                                               title="Add Schemes">
                                                <i class="ph-plus text-success fs-4"></i>
                                            </a>
                                            <a href="{{ route('adps.schemedetail', $adp) }}"
                                               class="btn btn-sm btn-light btn-icon rounded"
                                               data-bs-toggle="tooltip"
                                               title="View Details">
                                                <i class="ph-eye"></i>
                                            </a>
                                            <a href="{{ route('adps.show', $adp) }}"
                                               class="btn btn-sm btn-light btn-icon rounded"
                                               data-bs-toggle="tooltip"
                                               title="View Summary">
                                                <i class="ph-info"></i>
                                            </a>
                                            <a href="{{ route('adps.edit', $adp) }}"
                                               class="btn btn-sm btn-light btn-icon rounded"
                                               data-bs-toggle="tooltip"
                                               title="Edit ADP">
                                                <i class="ph-pen"></i>
                                            </a>
                                            <form action="{{ route('adps.destroy', $adp) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-light btn-icon rounded text-danger"
                                                        data-bs-toggle="tooltip"
                                                        title="Delete ADP"
                                                        onclick="return confirm('Are you sure you want to delete this ADP?')">
                                                    <i class="ph-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="ph-buildings fs-1 text-muted mb-3"></i>
                                            <p class="text-muted mb-2">No ADPs Found</p>
                                            <p class="text-muted mb-3">Get started by creating your first ADP</p>
                                            <a href="{{ route('adps.create') }}" class="btn btn-primary btn-sm">
                                                <i class="ph-plus-circle me-1"></i>Create First ADP
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if($adps->hasPages())
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Showing {{ $adps->firstItem() ?? 0 }} to {{ $adps->lastItem() ?? 0 }}
                        of {{ $adps->total() }} results
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $adps->links() }}
                    </div>
                </div>
            </div>
            @endif
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
    .input-group-text {
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.1);
        border-color: #0d6efd;
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Simple search functionality
        const searchInput = document.querySelector('input[type="text"]');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });
    </script>
</x-app-layout>
