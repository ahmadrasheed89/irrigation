<x-app-layout>
    <div class="content">
        <!-- Header Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">👤 User Details</h5>
                    <p class="mb-0 mt-1 opacity-75">View user information and activity</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('users.index') }}" class="btn btn-light btn-sm">
                        <i class="ph-arrow-left me-2"></i>Back to Users
                    </a>
                    <a href="{{ route('users.create') }}" class="btn btn-success btn-sm">
                        <i class="ph-user-plus me-2"></i>New User
                    </a>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-primary btn-sm">
                        <i class="ph-pencil-simple me-2"></i>Edit User
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column - Profile & Actions -->
            <div class="col-md-4">
                <!-- Profile Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body text-center">
                        <div class="avatar avatar-xxl bg-primary text-white rounded-circle mb-3 d-flex align-items-center justify-content-center mx-auto fw-bold"
                             style="width: 100px; height: 100px; font-size: 2rem;">
                            {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
                        </div>

                        <h3 class="mb-1">{{ $user->full_name }}</h3>
                        <div class="text-muted mb-3">{{ $user->username }}</div>
                        {!! $user->status_badge !!}

                        <div class="mt-4 pt-3 border-top">
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-muted small">Role</div>
                                    <div class="fw-semibold">User</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted small">Department</div>
                                    <div class="fw-semibold">{{ $user->department ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">
                            <i class="ph-lightning me-2 text-warning"></i>
                            Quick Actions
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-primary">
                                <i class="ph-pencil-simple me-2"></i>
                                Edit Profile
                            </a>

                            <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                    data-bs-target="#passwordModal">
                                <i class="ph-key me-2"></i>
                                Change Password
                            </button>

                            @if($user->id !== auth()->id())
                            <form action="{{ route('users.status.update', $user) }}" method="POST" class="d-grid">
                                @csrf
                                <input type="hidden" name="status" value="{{ $user->status ? 0 : 1 }}">
                                <button type="submit" class="btn btn-{{ $user->status ? 'outline-warning' : 'outline-success' }}">
                                    <i class="ph-{{ $user->status ? 'user-circle-minus' : 'user-circle-plus' }} me-2"></i>
                                    {{ $user->status ? 'Deactivate User' : 'Activate User' }}
                                </button>
                            </form>

                            <form action="{{ route('users.destroy', $user) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this user?')" class="d-grid">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="ph-trash me-2"></i>
                                    Delete User
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - User Information & Timeline -->
            <div class="col-md-8">
                <!-- User Information Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">
                            <i class="ph-info me-2 text-primary"></i>
                            User Information
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <!-- Full Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-medium">
                                        <i class="ph-user me-2 text-primary"></i>
                                        Full Name
                                    </label>
                                    <div class="form-control-plaintext p-2 bg-light rounded">
                                        {{ $user->full_name }}
                                    </div>
                                </div>
                            </div>

                            <!-- Username -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-medium">
                                        <i class="ph-at me-2 text-info"></i>
                                        Username
                                    </label>
                                    <div class="form-control-plaintext p-2 bg-light rounded">
                                        {{ $user->username }}
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-medium">
                                        <i class="ph-envelope me-2 text-success"></i>
                                        Email Address
                                    </label>
                                    <div class="form-control-plaintext p-2 bg-light rounded d-flex justify-content-between align-items-center">
                                        <span>{{ $user->email }}</span>
                                        @if($user->email_verified_at)
                                        <span class="badge bg-success">Verified</span>
                                        @else
                                        <span class="badge bg-warning">Unverified</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-medium">
                                        <i class="ph-phone me-2 text-secondary"></i>
                                        Phone Number
                                    </label>
                                    <div class="form-control-plaintext p-2 bg-light rounded">
                                        {{ $user->phone ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>

                            <!-- Department -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-medium">
                                        <i class="ph-buildings me-2 text-warning"></i>
                                        Department
                                    </label>
                                    <div class="form-control-plaintext p-2 bg-light rounded">
                                        {{ $user->department ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>

                            <!-- Position -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-medium">
                                        <i class="ph-briefcase me-2 text-info"></i>
                                        Position
                                    </label>
                                    <div class="form-control-plaintext p-2 bg-light rounded">
                                        {{ $user->position ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>

                            <!-- Account Status -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-medium">
                                        <i class="ph-toggle-right me-2 text-success"></i>
                                        Account Status
                                    </label>
                                    <div class="p-2">
                                        {!! $user->status_badge !!}
                                    </div>
                                </div>
                            </div>

                            <!-- Last Login -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-medium">
                                        <i class="ph-clock me-2 text-primary"></i>
                                        Last Login
                                    </label>
                                    <div class="form-control-plaintext p-2 bg-light rounded">
                                        @if($user->last_login_at)
                                            <div class="fw-medium">{{ $user->last_login_at->format('M j, Y g:i A') }}</div>
                                            <small class="text-muted">IP: {{ $user->last_login_ip }}</small>
                                        @else
                                            <span class="text-muted">Never logged in</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Timeline Card -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">
                            <i class="ph-timeline me-2 text-info"></i>
                            Account Timeline
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <!-- Account Created -->
                            <div class="timeline-item d-flex align-items-start mb-3">
                                <div class="timeline-badge bg-success rounded-circle p-2 me-3 d-flex align-items-center justify-content-center">
                                    <i class="ph-user-plus text-white"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold">Account Created</div>
                                    <div class="text-muted small">{{ $user->created_at->format('F j, Y \a\t g:i A') }}</div>
                                </div>
                            </div>

                            <!-- Last Updated -->
                            <div class="timeline-item d-flex align-items-start mb-3">
                                <div class="timeline-badge bg-info rounded-circle p-2 me-3 d-flex align-items-center justify-content-center">
                                    <i class="ph-pencil-simple text-white"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold">Last Updated</div>
                                    <div class="text-muted small">{{ $user->updated_at->format('F j, Y \a\t g:i A') }}</div>
                                </div>
                            </div>

                            <!-- Last Login -->
                            @if($user->last_login_at)
                            <div class="timeline-item d-flex align-items-start">
                                <div class="timeline-badge bg-primary rounded-circle p-2 me-3 d-flex align-items-center justify-content-center">
                                    <i class="ph-sign-in text-white"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold">Last Login</div>
                                    <div class="text-muted small">{{ $user->last_login_at->format('F j, Y \a\t g:i A') }}</div>
                                    <small class="text-muted">IP: {{ $user->last_login_ip }}</small>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Password Update Modal -->
    <div class="modal fade" id="passwordModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('users.password.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="ph-key me-2 text-warning"></i>
                            Change Password for {{ $user->full_name }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-medium required">New Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="ph-lock text-muted"></i>
                                </span>
                                <input type="password"
                                       name="password"
                                       class="form-control border-start-0 @error('password') is-invalid @enderror"
                                       required
                                       minlength="8"
                                       autocomplete="new-password"
                                       placeholder="Enter new password">
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                            <div class="form-text text-muted">Minimum 8 characters</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium required">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="ph-lock-key text-muted"></i>
                                </span>
                                <input type="password"
                                       name="password_confirmation"
                                       class="form-control border-start-0"
                                       required
                                       autocomplete="new-password"
                                       placeholder="Confirm new password">
                            </div>
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
        .avatar {
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
        }
        .avatar-xxl {
            width: 100px;
            height: 100px;
            font-size: 2rem;
        }
        .timeline-badge {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
        }
        .form-control-plaintext {
            min-height: 2.5rem;
            display: flex;
            align-items: center;
        }
        .btn {
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-1px);
        }
        .input-group-text {
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }
        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }
            .btn {
                padding: 0.5rem 1rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password strength indicator for modal
            const passwordInput = document.querySelector('#passwordModal input[name="password"]');

            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    const password = this.value;
                    const strength = checkPasswordStrength(password);

                    // You can add visual feedback for password strength here
                    console.log('Password strength:', strength);
                });
            }

            function checkPasswordStrength(password) {
                let strength = 0;
                if (password.length >= 8) strength++;
                if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
                if (password.match(/\d/)) strength++;
                if (password.match(/[^a-zA-Z\d]/)) strength++;
                return strength;
            }
        });
    </script>
</x-app-layout>
