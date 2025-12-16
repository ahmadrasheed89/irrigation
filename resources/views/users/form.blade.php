<div class="content">
    <!-- Header Section -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
            <div>
                <h5 class="mb-0 fw-bold">👤 {{ isset($user) ? 'Edit User' : 'Create New User' }}</h5>
                <p class="mb-0 mt-1 opacity-75">Fill in the details below to {{ isset($user) ? 'update' : 'create' }} user account</p>
            </div>
        </div>
    </div>

    <!-- All Form Fields in a Single Well-Spaced Layout -->
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST">
                @csrf
                @if(isset($user))
                    @method('PUT')
                @endif

                <div class="row g-3">
                    <!-- First Name -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label fw-medium">
                                <i class="ph-user me-2 text-primary"></i>
                                First Name
                            </label>
                            <input type="text"
                                   name="first_name"
                                   class="form-control"
                                   value="{{ old('first_name', $user->first_name ?? '') }}"
                                   required
                                   placeholder="Enter first name">
                            @error('first_name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Last Name -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label fw-medium">
                                <i class="ph-user me-2 text-primary"></i>
                                Last Name
                            </label>
                            <input type="text"
                                   name="last_name"
                                   class="form-control"
                                   value="{{ old('last_name', $user->last_name ?? '') }}"
                                   required
                                   placeholder="Enter last name">
                            @error('last_name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Username -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label fw-medium">
                                <i class="ph-at me-2 text-info"></i>
                                Username
                            </label>
                            <input type="text"
                                   name="username"
                                   class="form-control"
                                   value="{{ old('username', $user->username ?? '') }}"
                                   required
                                   placeholder="Enter username">
                            @error('username')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                            <div class="form-text text-muted">Unique login username</div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label fw-medium">
                                <i class="ph-envelope me-2 text-success"></i>
                                Email
                            </label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email', $user->email ?? '') }}"
                                   required
                                   placeholder="Enter email">
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                            <div class="form-text text-muted">Primary email address</div>
                        </div>
                    </div>

                    @if(!isset($user))
                    <!-- Password -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label fw-medium">
                                <i class="ph-lock me-2 text-warning"></i>
                                Password
                            </label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   required
                                   minlength="8"
                                   placeholder="Enter password">
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                            <div class="form-text text-muted">Min. 8 characters</div>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label fw-medium">
                                <i class="ph-lock-key me-2 text-warning"></i>
                                Confirm Password
                            </label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   required
                                   placeholder="Confirm password">
                            <div class="form-text text-muted">Re-enter password</div>
                        </div>
                    </div>
                    @endif

                    <!-- Phone -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label fw-medium">
                                <i class="ph-phone me-2 text-secondary"></i>
                                Phone
                            </label>
                            <input type="text"
                                   name="phone"
                                   class="form-control"
                                   value="{{ old('phone', $user->phone ?? '') }}"
                                   placeholder="Phone number">
                            @error('phone')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    @if(Auth::user()->role == 1)
                    <!-- Role Selection -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label fw-medium">
                                <i class="ph-list-dashes me-2 text-primary"></i>
                                Role
                            </label>
                            <select name="role" class="form-control">
                                <option value="">Select Role</option>
                                <option value="2" {{ isset($user) && $user->role == 2 ? 'selected' : '' }}>Editor</option>
                                <option value="3" {{ isset($user) && $user->role == 3 ? 'selected' : '' }}>User</option>
                                <option value="4" {{ isset($user) && $user->role == 4 ? 'selected' : '' }}>Moderator</option>
                            </select>
                            @error('role')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                            <div class="form-text text-muted">User access level</div>
                        </div>
                    </div>
                    @endif

                    <!-- Status -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label fw-medium">
                                <i class="ph-toggle-right me-2 text-success"></i>
                                Status
                            </label>
                            <div class="status-toggle p-3 border rounded bg-light">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <label class="form-check form-check-solid">
                                            <input class="form-check-input" type="radio" name="status" value="1"
                                                   {{ (old('status', isset($user) ? $user->status : true) ? 'checked' : '') }}>
                                            <span class="form-check-label text-success">
                                                <i class="ph-check-circle me-1"></i>Active
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-check form-check-solid">
                                            <input class="form-check-input" type="radio" name="status" value="0"
                                                   {{ (!old('status', isset($user) ? $user->status : true) ? 'checked' : '') }}>
                                            <span class="form-check-label text-danger">
                                                <i class="ph-x-circle me-1"></i>Inactive
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                @error('status')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                                <div class="form-text text-muted mt-2">Account status</div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Info Card -->
                    <div class="col-md-12">
                        <div class="account-info p-3 border rounded bg-light">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="ph-user-circle text-primary me-2"></i>
                                        <div class="small">
                                            <div class="fw-medium">Personal Info</div>
                                            <div class="text-muted">Name & Contact details</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="ph-shield-check text-success me-2"></i>
                                        <div class="small">
                                            <div class="fw-medium">Account Security</div>
                                            <div class="text-muted">Username & Password</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="ph-gear text-warning me-2"></i>
                                        <div class="small">
                                            <div class="fw-medium">Settings</div>
                                            <div class="text-muted">Role & Status</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="card-footer bg-light mt-4">
                    <div class="d-flex justify-content-between align-items-center py-2">
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
            </form>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    box-shadow: 0 0.125rem 0.375rem rgba(0,0,0,0.05);
}

.form-label {
    font-size: 0.95rem;
    margin-bottom: 0.5rem;
}

.form-group {
    margin-bottom: 1.25rem;
}

.account-info {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
}

.btn {
    font-weight: 500;
}

.card-body {
    padding: 1.5rem !important;
}

.card-footer {
    padding: 1rem 1.5rem !important;
}

.form-control:focus, .form-select:focus {
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.1);
    border-color: #0d6efd;
}

.status-toggle {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
}

.form-check-solid .form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.btn-submit {
    transition: all 0.3s ease;
}

.btn-submit:hover:not(:disabled) {
    transform: translateY(-1px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Make form compact but readable */
.row.g-3 {
    row-gap: 1.5rem !important;
}

.form-text {
    font-size: 0.85rem;
    margin-top: 0.25rem;
}

.form-check-label {
    font-size: 0.9rem;
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

    // Real-time password match check for new users
    const passwordInput = document.querySelector('input[name="password"]');
    const confirmPasswordInput = document.querySelector('input[name="password_confirmation"]');

    if (passwordInput && confirmPasswordInput) {
        function checkPasswordMatch() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            if (confirmPassword && password !== confirmPassword) {
                confirmPasswordInput.style.borderColor = '#dc3545';
                confirmPasswordInput.style.boxShadow = '0 0 0 0.2rem rgba(220, 53, 69, 0.1)';
            } else {
                confirmPasswordInput.style.borderColor = '#dee2e6';
                confirmPasswordInput.style.boxShadow = '';
            }
        }

        passwordInput.addEventListener('input', checkPasswordMatch);
        confirmPasswordInput.addEventListener('input', checkPasswordMatch);
    }

    // Real-time password strength indicator for new users
    if (passwordInput) {
        function checkPasswordStrength() {
            const password = passwordInput.value;
            const strengthIndicator = document.getElementById('passwordStrength');

            if (!strengthIndicator) {
                const indicatorDiv = document.createElement('div');
                indicatorDiv.id = 'passwordStrength';
                indicatorDiv.className = 'mt-2 small';
                passwordInput.parentNode.appendChild(indicatorDiv);
            }

            const indicator = document.getElementById('passwordStrength');
            if (password.length === 0) {
                indicator.innerHTML = '';
                return;
            }

            let strength = 0;
            let feedback = '';
            let color = 'text-danger';

            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            switch(strength) {
                case 0:
                case 1:
                    feedback = 'Weak password';
                    color = 'text-danger';
                    break;
                case 2:
                    feedback = 'Moderate password';
                    color = 'text-warning';
                    break;
                case 3:
                    feedback = 'Good password';
                    color = 'text-info';
                    break;
                case 4:
                    feedback = 'Strong password';
                    color = 'text-success';
                    break;
            }

            indicator.innerHTML = `<span class="${color}"><i class="ph-info me-1"></i>${feedback}</span>`;
        }

        passwordInput.addEventListener('input', checkPasswordStrength);
    }
});
</script>
