<x-app-layout>
    <div class="content">
        <!-- Header Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">📄 NOCs Management</h5>
                    <p class="mb-0 mt-1 opacity-75">Comprehensive overview of No Objection Certificates - Status tracking and document management</p>
                </div>
                <div class="btn-group">
                    <button class="btn btn-light d-flex align-items-center">
                        <i class="ph-download-simple me-2"></i>Export
                    </button>
                    @can('create', App\Models\Noc::class)
                        <a href="{{ route('nocs.create') }}" class="btn btn-light d-flex align-items-center">
                            <i class="ph-plus-circle me-2"></i>Add New NOC
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <!-- Search and Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" class="row g-3 align-items-end">
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Search NOCs</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="ph-magnifying-glass text-muted"></i>
                            </span>
                            <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" class="form-control border-start-0" placeholder="Search by issue number, subject, or department...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                            <i class="ph-magnifying-glass me-2"></i>Search
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('nocs.index') }}" class="btn btn-light w-100 d-flex align-items-center justify-content-center">
                            <i class="ph-arrow-counter-clockwise me-2"></i>Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- NOCs Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-0 fw-semibold">📋 All NOCs List</h6>
                    <span class="badge bg-primary ms-2">{{ $nocs->total() }} Records</span>
                </div>
                <div class="d-flex align-items-center">
                    @can('create', App\Models\Noc::class)
                        <a href="{{ route('nocs.create') }}" class="btn btn-sm btn-primary d-flex align-items-center">
                            <i class="ph-plus-circle me-1"></i>Add NOC
                        </a>
                    @endcan
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Issue Details</th>
                                <th>Department</th>
                                <th>Subject</th>
                                <th>Nature</th>
                                <th class="text-center">Issue Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Update Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($nocs as $noc)
                            <tr class="border-start border-primary border-3">
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px me-3">
                                            <div class="symbol-label bg-light-primary rounded">
                                                <i class="ph-file-text text-primary"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="fw-semibold text-dark">{{ $noc->issue_no ?? 'N/A' }}</div>
                                            <div class="text-muted small">NOC #{{ $noc->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-semibold">{{ $noc->department ?? '-' }}</span>
                                </td>
                                <td>
                                    <div class="fw-medium">{{ Str::limit($noc->noc_subject, 40) ?? '-' }}</div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">{{ $noc->nature_of_noc ?? '-' }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="text-muted">
                                        {{ $noc->issued_date->format('M d, Y') ?? '-' }}
                                    </div>
                                    <small class="text-muted">
                                        {{ $noc->issued_date->format('h:i A') }}
                                    </small>
                                </td>
                                <td class="text-center">
                                    @if ($noc->nocstatus == 2)
                                        <span class="badge bg-success bg-opacity-20 text-success border border-success border-opacity-25">
                                            <i class="ph-check-circle me-1"></i>Approved
                                        </span>
                                    @elseif ($noc->nocstatus == 3)
                                        <span class="badge bg-danger bg-opacity-20 text-danger border border-danger border-opacity-25">
                                            <i class="ph-x-circle me-1"></i>Rejected
                                        </span>
                                    @else
                                        <span class="badge bg-warning bg-opacity-20 text-warning border border-warning border-opacity-25">
                                            <i class="ph-clock me-1"></i>Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <form method="POST" action="{{ route('nocs.updateStatus', $noc) }}" class="d-inline">
                                        @csrf
                                        <select name="nocstatus" onchange="this.form.submit()"
                                                class="form-select form-select-sm status-select
                                                       @if($noc->nocstatus == 2) border-success
                                                       @elseif($noc->nocstatus == 3) border-danger
                                                       @else border-warning @endif"
                                                style="min-width: 120px;">
                                            <option value="1" {{ $noc->nocstatus == 1 ? 'selected' : '' }} class="text-warning">🟡 Pending</option>
                                            <option value="2" {{ $noc->nocstatus == 2 ? 'selected' : '' }} class="text-success">🟢 Approved</option>
                                            <option value="3" {{ $noc->nocstatus == 3 ? 'selected' : '' }} class="text-danger">🔴 Rejected</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('nocs.upload', $noc) }}"
                                           class="btn btn-sm btn-light btn-icon rounded"
                                           data-bs-toggle="tooltip"
                                           title="Upload Documents">
                                            <i class="ph-upload"></i>
                                        </a>
                                        <a href="{{ route('nocs.show', $noc) }}"
                                           class="btn btn-sm btn-light btn-icon rounded"
                                           data-bs-toggle="tooltip"
                                           title="View Details">
                                            <i class="ph-eye"></i>
                                        </a>
                                        <a href="{{ route('nocs.edit', $noc) }}"
                                           class="btn btn-sm btn-light btn-icon rounded"
                                           data-bs-toggle="tooltip"
                                           title="Edit NOC">
                                            <i class="ph-pen"></i>
                                        </a>
                                        <form action="{{ route('nocs.destroy', $noc) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-light btn-icon rounded text-danger"
                                                    data-bs-toggle="tooltip"
                                                    title="Delete NOC"
                                                    onclick="return confirm('Are you sure you want to delete this NOC?')">
                                                <i class="ph-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="ph-file-text fs-1 text-muted mb-3"></i>
                                        <p class="text-muted mb-2">No NOCs Found</p>
                                        <p class="text-muted mb-3">Get started by creating your first NOC</p>
                                        @can('create', App\Models\Noc::class)
                                            <a href="{{ route('nocs.create') }}" class="btn btn-primary btn-sm">
                                                <i class="ph-plus-circle me-1"></i>Create First NOC
                                            </a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if($nocs->hasPages())
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Showing {{ $nocs->firstItem() ?? 0 }} to {{ $nocs->lastItem() ?? 0 }}
                        of {{ $nocs->total() }} results
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $nocs->links() }}
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
    .status-select {
        transition: all 0.2s ease-in-out;
    }
    .status-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.1);
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Update select border colors based on status
        document.querySelectorAll('.status-select').forEach(select => {
            select.addEventListener('change', function() {
                const value = this.value;
                this.className = 'form-select form-select-sm status-select ';
                if (value == '2') {
                    this.classList.add('border-success');
                } else if (value == '3') {
                    this.classList.add('border-danger');
                } else {
                    this.classList.add('border-warning');
                }
            });
        });

        // Add loading state to status form submissions
        document.querySelectorAll('select[name="nocstatus"]').forEach(select => {
            select.addEventListener('change', function() {
                const originalText = this.innerHTML;
                this.disabled = true;
                this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span>';

                setTimeout(() => {
                    this.disabled = false;
                    this.innerHTML = originalText;
                }, 2000);
            });
        });
    });
    </script>
</x-app-layout>
