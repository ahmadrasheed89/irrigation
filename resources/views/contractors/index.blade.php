<x-app-layout>
    <div class="content">
        <!-- Header Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">👥 Contractors Management</h5>
                </div>
                <div>
                    <a href="{{ route('contractors.create') }}" class="btn btn-light btn-sm">
                        <i class="ph-user-plus me-2"></i>
                        Add Contractor
                    </a>
                </div>
            </div>
        </div>

        <!-- Search & Filters Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-center">
                    <div class="col-md-8">
                        <form action="{{ route('contractors.index') }}" method="GET" class="row g-2">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="ph-magnifying-glass text-muted"></i>
                                    </span>
                                    <input type="text"
                                           name="search"
                                           class="form-control border-start-0"
                                           placeholder="Search users by name, email, or username..."
                                           value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="ph-magnifying-glass me-2"></i>Search
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table Card -->
        <div class="card shadow-sm">
            <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="ph-users me-2 text-primary"></i>
                    Contractors List
                </h5>
                <span class="badge bg-primary rounded-pill">{{ $contractors->total() }} contractors</span>
            </div>

            <div class="card-body p-0">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        <i class="ph-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                        <i class="ph-x-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form id="bulk-action-form" action="{{ route('contractors.bulk.action') }}" method="POST">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="40" class="ps-4">
                                        <input type="checkbox" class="form-check-input" id="select-all">
                                    </th>
                                    <th>
                                        <i class="ph-user me-2 text-muted"></i>
                                        Contractor
                                    </th>
                                    <th>
                                        <i class="ph-envelope me-2 text-muted"></i>
                                        Contact
                                    </th>
                                    <th>
                                        <i class="ph-buildings me-2 text-muted"></i>
                                        Vendor Number
                                    </th>
                                    <th>
                                        <i class="ph-clock me-2 text-muted"></i>
                                        Last Login
                                    </th>
                                    <th class="text-center pe-4">
                                        <i class="ph-gear me-2 text-muted"></i>
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contractors as $contractor)
                                <tr>
                                    <td class="ps-4">
                                        <input type="checkbox"
                                               class="form-check-input contractor-checkbox"
                                               name="ids[]"
                                               value="{{ $contractor->id }}">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center fw-bold">
                                                {{ strtoupper(substr($contractor->constractor_name, 0, 1)) }}
                                            </div>
                                            <div>
                                                    <div class="fw-semibold">{{ $contractor->constractor_name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-medium">{{ $contractor->email }}</div>
                                        @if($contractor->phone)
                                        <div class="text-muted small">{{ $contractor->phone }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-medium">{{ $contractor->vendor_no ?? 'N/A' }}</div>
                                    </td>
                                    <td>
                                        @if($contractor->last_login_at)
                                        <div class="fw-medium">{{ $contractor->last_login_at->format('M j, Y') }}</div>
                                        <div class="text-muted small">{{ $contractor->last_login_at->format('g:i A') }}</div>
                                        @else
                                        <span class="text-muted">Never logged in</span>
                                        @endif
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('contractors.show', $contractor) }}"
                                               class="btn btn-sm btn-outline-teal action-btn"
                                               title="View Details">
                                                <i class="ph-eye"></i>
                                            </a>
                                            <a href="{{ route('contractors.edit', $contractor) }}"
                                               class="btn btn-sm btn-outline-primary action-btn"
                                               title="Edit User">
                                                <i class="ph-pen"></i>
                                            </a>
                                            <form action="{{ route('contractors.destroy', $contractor) }}"
                                                  method="POST"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger action-btn"
                                                        title="Delete User"
                                                        onclick="return confirm('Are you sure you want to delete this user?')">
                                                    <i class="ph-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="py-4">
                                            <i class="ph-users ph-2x text-muted opacity-50 mb-3"></i>
                                            <h6 class="text-muted">No users found</h6>
                                            <p class="text-muted small mb-3">No users match your search criteria</p>
                                            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
                                                <i class="ph-user-plus me-2"></i>Add First User
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($contractors->count() > 0)
                    <div class="card-footer bg-light py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-2">
                                <select name="action" class="form-select form-select-sm" style="width: 150px;" required>
                                    <option value="">Bulk Actions</option>
                                    <option value="activate">Activate</option>
                                    <option value="deactivate">Deactivate</option>
                                    <option value="delete">Delete</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Apply</button>
                            </div>
                            <div>
                                {{ $contractors->links() }}
                            </div>
                        </div>
                    </div>
                    @endif
                </form>
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
        .avatar {
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
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
            // Bulk selection
            const selectAll = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.user-checkbox');

            selectAll.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    if (!checkbox.disabled) {
                        checkbox.checked = this.checked;
                    }
                });
            });



            // Form submission loading state
            const bulkForm = document.getElementById('bulk-action-form');
            const bulkSubmit = bulkForm.querySelector('button[type="submit"]');

            if (bulkForm && bulkSubmit) {
                bulkForm.addEventListener('submit', function() {
                    const selectedAction = bulkForm.querySelector('select[name="action"]').value;
                    if (selectedAction) {
                        bulkSubmit.disabled = true;
                        bulkSubmit.innerHTML = '<i class="ph-spinner ph-spin me-2"></i>Processing...';
                    }
                });
            }
        });
    </script>
</x-app-layout>
