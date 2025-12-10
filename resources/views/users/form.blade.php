<div class="content">
    <!-- Header Section -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 fw-bold">👤 {{ isset($user) ? 'Edit User' : 'Create New User' }}</h5>
                <p class="mb-0 mt-1 opacity-75">Fill in the details below to {{ isset($user) ? 'update' : 'create' }} user account</p>
            </div>
        </div>
    </div>

    <!-- User Information Card -->
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST">
                @csrf
                @if(isset($user))
                    @method('PUT')
                @endif

                <!-- Personal Information Section -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">📝 Personal Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <!-- First Name -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-medium required">
                                        <i class="ph-user me-2 text-primary"></i>
                                        First Name
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="ph-text-aa text-muted"></i>
                                        </span>
                                        <input type="text"
                                               name="first_name"
                                               class="form-control border-start-0"
                                               value="{{ old('first_name', $user->first_name ?? '') }}"
                                               required
                                               placeholder="Enter first name">
                                    </div>
                                    @error('first_name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-medium required">
                                        <i class="ph-user me-2 text-primary"></i>
                                        Last Name
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="ph-text-aa text-muted"></i>
                                        </span>
                                        <input type="text"
                                               name="last_name"
                                               class="form-control border-start-0"
                                               value="{{ old('last_name', $user->last_name ?? '') }}"
                                               required
                                               placeholder="Enter last name">
                                    </div>
                                    @error('last_name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Information Section -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">🔐 Account Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <!-- Username -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-medium required">
                                        <i class="ph-at me-2 text-info"></i>
                                        Username
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="ph-user-circle text-muted"></i>
                                        </span>
                                        <input type="text"
                                               name="username"
                                               class="form-control border-start-0"
                                               value="{{ old('username', $user->username ?? '') }}"
                                               required
                                               placeholder="Enter username">
                                    </div>
                                    @error('username')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text text-muted">Unique username for login</div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-medium required">
                                        <i class="ph-envelope me-2 text-success"></i>
                                        Email
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="ph-at text-muted"></i>
                                        </span>
                                        <input type="email"
                                               name="email"
                                               class="form-control border-start-0"
                                               value="{{ old('email', $user->email ?? '') }}"
                                               required
                                               placeholder="Enter email address">
                                    </div>
                                    @error('email')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text text-muted">User's primary email address</div>
                                </div>
                            </div>
                        </div>

                        @if(!isset($user))
                        <div class="row g-3">
                            <!-- Password -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-medium required">
                                        <i class="ph-lock me-2 text-warning"></i>
                                        Password
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="ph-key text-muted"></i>
                                        </span>
                                        <input type="password"
                                               name="password"
                                               class="form-control border-start-0"
                                               required
                                               minlength="8"
                                               placeholder="Enter password">
                                    </div>
                                    @error('password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text text-muted">Minimum 8 characters</div>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-medium required">
                                        <i class="ph-lock-key me-2 text-warning"></i>
                                        Confirm Password
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="ph-key text-muted"></i>
                                        </span>
                                        <input type="password"
                                               name="password_confirmation"
                                               class="form-control border-start-0"
                                               required
                                               placeholder="Confirm password">
                                    </div>
                                    <div class="form-text text-muted">Re-enter the password</div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Additional Information Section -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">📞 Additional Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <!-- Phone -->
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-medium">
                                        <i class="ph-phone me-2 text-secondary"></i>
                                        Phone
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="ph-phone-call text-muted"></i>
                                        </span>
                                        <input type="text"
                                               name="phone"
                                               class="form-control border-start-0"
                                               value="{{ old('phone', $user->phone ?? '') }}"
                                               placeholder="Enter phone number">
                                    </div>
                                    @error('phone')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text text-muted">Optional contact number</div>
                                </div>
                            </div>
                    @if(Auth::user()->role != 1)
                            <!-- Role Selection -->
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label fw-medium">
                                <i class="ph-list-dashes me-2 text-primary"></i>
                                Role
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="ph-selection text-muted"></i>
                                </span>
                                <select name="role" class="form-control border-start-0">
                                    <option>Select Role</option>
                                    <option value="2" {{  $user->role == 2 ? 'selected' : '' }}>Editor</option>
                                    <option value="3" {{  $user->role == 3 ? 'selected' : '' }}>User</option>
                                    <option value="4" {{  $user->role == 4 ? 'selected' : '' }}>Moderator</option>
                                </select>

                            </div>
                            <x-input-error :messages="$errors->get('adp_id')" class="mt-2" />
                            <div class="form-text text-muted">Select the associated ADP</div>
                        </div>
                    </div>
                    @endif

                            <!-- Status -->
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-medium">
                                        <i class="ph-toggle-right me-2 text-success"></i>
                                        Status
                                    </label>
                                    <div class="status-toggle p-3 border rounded bg-light">
                                        <div class="row g-3">
                                            <div class="col-6">
                                                <label class="form-check form-check-solid">
                                                    <input class="form-check-input" type="radio" name="status" value="1"
                                                           {{ (old('status', $user->status ?? true) ? 'checked' : '') }}>
                                                    <span class="form-check-label text-success">
                                                        <i class="ph-check-circle me-2"></i>Active
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-check form-check-solid">
                                                    <input class="form-check-input" type="radio" name="status" value="0"
                                                           {{ (!old('status', $user->status ?? true) ? 'checked' : '') }}>
                                                    <span class="form-check-label text-danger">
                                                        <i class="ph-x-circle me-2"></i>Inactive
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        @error('status')
                                            <div class="text-danger small mt-2">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text text-muted">User account status</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <a href="{{ route('users.index') }}" class="btn btn-light">
                                    <i class="ph-arrow-left me-2"></i>Cancel
                                </a>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="ph-arrow-clockwise me-2"></i>Reset Form
                                </button>
                                <button type="submit" class="btn btn-primary btn-submit">
                                    <i class="ph-paper-plane-tilt me-2"></i>
                                    {{ isset($user) ? 'Update User' : 'Create User' }}
                                    <span class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.375rem rgba(0,0,0,0.05);
    }
    .input-group-text {
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.1);
        border-color: #0d6efd;
    }
    .btn-submit {
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-submit:hover {
        transform: translateY(-1px);
    }
    .status-toggle {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }
    .form-check-solid .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
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
        // Form submission loading state
        const form = document.querySelector('form');
        const submitBtn = document.querySelector('.btn-submit');

        if (form && submitBtn) {
            const spinner = submitBtn.querySelector('.spinner-border');

            form.addEventListener('submit', function() {
                submitBtn.disabled = true;
                if (spinner) {
                    spinner.classList.remove('d-none');
                }
                submitBtn.innerHTML = `<i class="ph-paper-plane-tilt me-2"></i>Processing... ${spinner ? spinner.outerHTML : ''}`;
            });
        }

        // Real-time password strength check for new users
        const passwordInput = document.querySelector('input[name="password"]');
        const confirmPasswordInput = document.querySelector('input[name="password_confirmation"]');

        if (passwordInput && confirmPasswordInput) {
            function checkPasswordMatch() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (confirmPassword && password !== confirmPassword) {
                    confirmPasswordInput.style.borderColor = '#dc3545';
                } else {
                    confirmPasswordInput.style.borderColor = '#dee2e6';
                }
            }

            passwordInput.addEventListener('input', checkPasswordMatch);
            confirmPasswordInput.addEventListener('input', checkPasswordMatch);
        }
    });
</script>
