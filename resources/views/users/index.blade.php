<x-app-layout>
    <div class="content">
        <!-- Header Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">👥 User Management</h5>
                    <p class="mb-0 mt-1 opacity-75">Manage system users and their permissions</p>
                </div>
                <div>
                    <a href="{{ route('users.create') }}" class="btn btn-light btn-sm">
                        <i class="ph-user-plus me-2"></i>
                        Add User
                    </a>
                </div>
            </div>
        </div>

        <!-- Search & Filters Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-center">
                    <div class="col-md-8">
                        <form action="{{ route('users.index') }}" method="GET" class="row g-2">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="ph-funnel text-muted"></i>
                                    </span>
                                    <select name="status" class="form-control border-start-0" onchange="this.form.submit()">
                                        <option value="">All Status</option>
                                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
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
                    Users List
                </h5>
                <span class="badge bg-primary rounded-pill">{{ $users->total() }} users</span>
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

                <form id="bulk-action-form" action="{{ route('users.bulk.action') }}" method="POST">
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
                                        User
                                    </th>
                                    <th>
                                        <i class="ph-envelope me-2 text-muted"></i>
                                        Contact
                                    </th>
                                    <th>
                                        <i class="ph-buildings me-2 text-muted"></i>
                                        Department
                                    </th>
                                    <th>
                                        <i class="ph-toggle-right me-2 text-muted"></i>
                                        Status
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
                                @forelse($users as $user)
                                <tr>
                                    <td class="ps-4">
                                        <input type="checkbox"
                                               class="form-check-input user-checkbox"
                                               name="ids[]"
                                               value="{{ $user->id }}"
                                               {{ $user->id == auth()->id() ? 'disabled' : '' }}>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center fw-bold">
                                                {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $user->full_name }}</div>
                                                <div class="text-muted small">{{ $user->username }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-medium">{{ $user->email }}</div>
                                        @if($user->phone)
                                        <div class="text-muted small">{{ $user->phone }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-medium">{{ $user->department ?? 'N/A' }}</div>
                                        <div class="text-muted small">{{ $user->position ?? 'N/A' }}</div>
                                    </td>
                                    <td>
                                        {!! $user->status_badge !!}
                                    </td>
                                    <td>
                                        @if($user->last_login_at)
                                        <div class="fw-medium">{{ $user->last_login_at->format('M j, Y') }}</div>
                                        <div class="text-muted small">{{ $user->last_login_at->format('g:i A') }}</div>
                                        @else
                                        <span class="text-muted">Never logged in</span>
                                        @endif
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('users.show', $user) }}"
                                               class="btn btn-sm btn-outline-teal action-btn"
                                               title="View Details">
                                                <i class="ph-eye"></i>
                                            </a>
                                            <a href="{{ route('users.edit', $user) }}"
                                               class="btn btn-sm btn-outline-primary action-btn"
                                               title="Edit User">
                                                <i class="ph-pen"></i>
                                            </a>
                                            <button type="button"
                                                    class="btn btn-sm btn-outline-warning action-btn"
                                                    title="Change Password"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#passwordModal"
                                                    data-user-id="{{ $user->id }}"
                                                    data-user-name="{{ $user->full_name }}">
                                                <i class="ph-key"></i>
                                            </button>
                                            <form action="{{ route('users.destroy', $user) }}"
                                                  method="POST"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger action-btn"
                                                        title="Delete User"
                                                        onclick="return confirm('Are you sure you want to delete this user?')"
                                                        {{ $user->id == auth()->id() ? 'disabled' : '' }}>
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

                    @if($users->count() > 0)
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
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <!-- Password Update Modal -->
    <div class="modal fade" id="passwordModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="passwordForm" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="mb-3">
                            <label class="form-label fw-medium">New Password</label>
                            <input type="password" name="password" class="form-control" required minlength="8" placeholder="Enter new password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required placeholder="Confirm new password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </div>
                </div>
            </form>
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

            // Password modal
            const passwordModal = document.getElementById('passwordModal');
            passwordModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const userId = button.getAttribute('data-user-id');
                const userName = button.getAttribute('data-user-name');

                const form = document.getElementById('passwordForm');
                form.action = `/users/${userId}/password`;

                const modalTitle = passwordModal.querySelector('.modal-title');
                modalTitle.textContent = `Change Password - ${userName}`;
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
