<x-app-layout>
    <div class="content">
        <!-- Header Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">📄 ADP Details</h5>
                    <p class="mb-0 mt-1 opacity-75">Complete information for ADP: <strong>{{ $adp->adp_code }}</strong></p>
                </div>
                <div class="btn-group">
                    <a href="{{ route('adps.index') }}" class="btn btn-light d-flex align-items-center">
                        <i class="ph-arrow-left me-2"></i>Back to List
                    </a>
                    <a href="{{ route('adps.edit', $adp) }}" class="btn btn-light d-flex align-items-center">
                        <i class="ph-pencil-simple me-2"></i>Edit ADP
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
                                <i class="ph-identification-card fs-2 text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0">{{ $adp->adp_code }}</h4>
                                <p class="mb-0 text-muted">ADP Code</p>
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
                                <i class="ph-coin fs-2 text-success"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0">₹{{ number_format($adp->allocation, 0) }}</h4>
                                <p class="mb-0 text-muted">Total Allocation</p>
                            </div>
                        </div>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-success" style="width: 100%"></div>
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
                                <h4 class="mb-0">₹{{ number_format($adp->total_expenditure, 0) }}</h4>
                                <p class="mb-0 text-muted">Total Expenditure</p>
                            </div>
                        </div>
                        @php
                            $utilization = $adp->allocation > 0 ? ($adp->total_expenditure / $adp->allocation) * 100 : 0;
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
                                <h4 class="mb-0">₹{{ number_format($adp->accured_liability, 0) }}</h4>
                                <p class="mb-0 text-muted">Accrued Liability</p>
                            </div>
                        </div>
                        @php
                            $liabilityPercentage = $adp->allocation > 0 ? ($adp->accured_liability / $adp->allocation) * 100 : 0;
                        @endphp
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-info" style="width: {{ min($liabilityPercentage, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <div class="col-lg-8">
                <!-- ADP Information Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">🏗️ ADP Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="detail-item border rounded p-3 bg-light">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ph-identification-card fs-3 text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <label class="form-label text-muted mb-1">ADP Code</label>
                                            <div class="fw-semibold">{{ $adp->adp_code ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item border rounded p-3 bg-light">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ph-coin fs-3 text-success"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <label class="form-label text-muted mb-1">Total Allocation</label>
                                            <div class="fw-semibold">₹{{ number_format($adp->allocation, 2) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item border rounded p-3 bg-light">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ph-calculator fs-3 text-info"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <label class="form-label text-muted mb-1">ADP T/S Cost</label>
                                            <div class="fw-semibold">₹{{ number_format($adp->adp_t_s_cost, 2) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item border rounded p-3 bg-light">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ph-trend-up fs-3 text-warning"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <label class="form-label text-muted mb-1">Total Expenditure</label>
                                            <div class="fw-semibold">₹{{ number_format($adp->total_expenditure, 2) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item border rounded p-3 bg-light">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ph-warning-circle fs-3 text-danger"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <label class="form-label text-muted mb-1">Accrued Liability</label>
                                            <div class="fw-semibold">₹{{ number_format($adp->accured_liability, 2) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item border rounded p-3 bg-light">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ph-user fs-3 text-secondary"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <label class="form-label text-muted mb-1">Created By</label>
                                            <div class="fw-semibold">{{ $adp->user->name ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Progress Overview -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">📊 Budget Utilization</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="progress-card border rounded p-4 bg-light">
                                    <label class="form-label text-muted mb-3">Budget Utilization</label>
                                    <div class="progress mb-3" style="height: 12px; border-radius: 6px;">
                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                             style="width: {{ min($utilization, 100) }}%; border-radius: 6px;">
                                        </div>
                                    </div>
                                    <div class="fw-bold fs-4 text-success mb-2">{{ number_format($utilization, 2) }}%</div>
                                    <small class="text-muted">₹{{ number_format($adp->total_expenditure, 0) }} of ₹{{ number_format($adp->allocation, 0) }} used</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="progress-card border rounded p-4 bg-light">
                                    <label class="form-label text-muted mb-3">Liability Ratio</label>
                                    <div class="progress mb-3" style="height: 12px; border-radius: 6px;">
                                        <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated"
                                             style="width: {{ min($liabilityPercentage, 100) }}%; border-radius: 6px;">
                                        </div>
                                    </div>
                                    <div class="fw-bold fs-4 text-warning mb-2">{{ number_format($liabilityPercentage, 2) }}%</div>
                                    <small class="text-muted">₹{{ number_format($adp->accured_liability, 0) }} of total allocation</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- File Attachment Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">📎 Attached Files</h6>
                    </div>
                    <div class="card-body">
                        @if($adp->attached_files)
                            <div class="text-center">
                                <div class="mb-3">
                                    <i class="ph-file-text fs-1 text-primary"></i>
                                </div>
                                <div class="fw-semibold mb-3">Attached Document</div>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ Storage::url($adp->attached_files) }}"
                                       target="_blank"
                                       class="btn btn-primary btn-sm d-flex align-items-center">
                                        <i class="ph-download-simple me-1"></i>Download
                                    </a>
                                    <a href="{{ Storage::url($adp->attached_files) }}"
                                       target="_blank"
                                       class="btn btn-outline-primary btn-sm d-flex align-items-center">
                                        <i class="ph-eye me-1"></i>View
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-3">
                                <i class="ph-file-x fs-1 text-muted mb-3 d-block"></i>
                                <h6 class="text-muted">No File Attached</h6>
                                <p class="text-muted small mb-0">No documents have been uploaded for this ADP</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">⚡ Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('adps.schemedetail', $adp) }}" class="btn btn-outline-primary text-start d-flex align-items-center">
                                <i class="ph-list-checks me-2"></i>View Schemes
                            </a>
                            <a href="{{ route('adps.edit', $adp) }}" class="btn btn-outline-success text-start d-flex align-items-center">
                                <i class="ph-pencil-simple me-2"></i>Edit ADP
                            </a>
                            <a href="{{ route('adps.index') }}" class="btn btn-outline-secondary text-start d-flex align-items-center">
                                <i class="ph-arrow-left me-2"></i>Back to List
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Summary Card -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">📋 Summary</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                            <span class="text-muted">Remaining Budget</span>
                            <span class="fw-semibold text-success">
                                ₹{{ number_format($adp->allocation - $adp->total_expenditure, 2) }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                            <span class="text-muted">Utilization Status</span>
                            <span class="badge bg-{{ $utilization >= 80 ? 'success' : ($utilization >= 50 ? 'warning' : 'info') }}">
                                {{ $utilization >= 80 ? 'High' : ($utilization >= 50 ? 'Moderate' : 'Low') }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                            <span class="text-muted">Created Date</span>
                            <span class="fw-semibold">{{ $adp->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Last Updated</span>
                            <span class="fw-semibold">{{ $adp->updated_at->format('M d, Y') }}</span>
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
    .detail-item {
        transition: all 0.3s ease;
    }
    .detail-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation to progress bars
        const progressBars = document.querySelectorAll('.progress-bar');
        progressBars.forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
                bar.style.transition = 'width 1.5s ease-in-out';
            }, 300);
        });

        // Add hover effects to cards
        const cards = document.querySelectorAll('.card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.transition = 'all 0.2s ease';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = '';
            });
        });
    });
    </script>
</x-app-layout>
