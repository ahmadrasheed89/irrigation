<x-app-layout>
    <div class="content">
        <!-- Header Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">📊 Schemes Management</h5>
                    <p class="mb-0 mt-1 opacity-75">View and manage all schemes in the system</p>
                </div>
            </div>
        </div>

        <!-- Search & Actions Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" class="row g-3 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="ph-magnifying-glass text-muted"></i>
                            </span>
                            <input type="text"
                                   name="q"
                                   value="{{ $filters['q'] ?? '' }}"
                                   class="form-control border-start-0"
                                   placeholder="Search schemes...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="ph-magnifying-glass me-2"></i>Search
                        </button>
                    </div>
                    <div class="col-md-4 text-end">
                        @can('create', App\Models\Scheme::class)
                        <a href="{{ route('schemes.create') }}" class="btn btn-success">
                            <i class="ph-plus me-2"></i>Add Scheme
                        </a>
                        @endcan
                    </div>
                </form>
            </div>
        </div>

        <!-- Data Table Card -->
        <div class="card shadow-sm">
            <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="ph-table me-2 text-primary"></i>
                    Schemes List
                </h5>
                @can('create', App\Models\Scheme::class)
                <a href="{{ route('schemes.create') }}" class="btn btn-primary btn-sm">
                    <i class="ph-plus me-2"></i>Add Scheme
                </a>
                @endcan
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">
                                    <i class="ph-text-aa me-2 text-muted"></i>
                                    Name
                                </th>
                                <th>
                                    <i class="ph-identification-card me-2 text-muted"></i>
                                    ADP
                                </th>
                                <th>
                                    <i class="ph-currency-circle-dollar me-2 text-muted"></i>
                                    Cost
                                </th>
                                <th>
                                    <i class="ph-user me-2 text-muted"></i>
                                    Contractor
                                </th>
                                <th class="text-center pe-4">
                                    <i class="ph-gear me-2 text-muted"></i>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($schemes as $s)
                            <tr>
                                <td class="ps-4 fw-medium">{{ $s->name }}</td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ $s->adp_code }}
                                    </span>
                                </td>
                                <td class="fw-semibold text-success">
                                    ₹{{ number_format($s->sub_work_t_s_cost, 2) }}
                                </td>
                                <td>
                                    @if($s->contractor)
                                    <div class="d-flex align-items-center">
                                        <i class="ph-user-circle me-2 text-warning"></i>
                                        <span>{{ $s->contractor->constractor_name }}</span>
                                    </div>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center pe-4">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('schemes.show', $s) }}"
                                           class="btn btn-sm btn-outline-teal action-btn"
                                           title="View Details">
                                            <i class="ph-eye"></i>
                                        </a>
                                        <a href="{{ route('schemes.edit', $s) }}"
                                           class="btn btn-sm btn-outline-primary action-btn"
                                           title="Edit Scheme">
                                            <i class="ph-pen"></i>
                                        </a>
                                        <form action="{{ route('schemes.destroy', $s) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger action-btn"
                                                    title="Delete Scheme"
                                                    onclick="return confirm('Delete?')">
                                                <i class="ph-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="py-5">
                                        <i class="ph-binoculars fs-1 text-muted opacity-50"></i>
                                        <h6 class="mt-3 text-muted">No records found</h6>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if($schemes->hasPages())
            <div class="card-footer bg-light py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Showing {{ $schemes->firstItem() ?? 0 }} to {{ $schemes->lastItem() ?? 0 }} of {{ $schemes->total() }} entries
                    </div>
                    <div>
                        {{ $schemes->links() }}
                    </div>
                </div>
            </div>
            @endif
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
        .input-group-text {
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }
        .action-btn {
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
        }
        .action-btn:hover {
            transform: translateY(-1px);
        }
        .badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }
        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }
            .btn {
                padding: 0.5rem 1rem;
            }
            .table-responsive {
                font-size: 0.875rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading state to delete buttons
            const deleteForms = document.querySelectorAll('form[action*="destroy"]');

            deleteForms.forEach(form => {
                const button = form.querySelector('button[type="submit"]');

                form.addEventListener('submit', function(e) {
                    if (confirm('Are you sure you want to delete this scheme?')) {
                        button.disabled = true;
                        button.innerHTML = '<i class="ph-spinner ph-spin"></i>';
                    } else {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</x-app-layout>
