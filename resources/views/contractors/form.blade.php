<div class="content">
    <!-- Header Section -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 fw-bold">👤 {{ isset($contractor) ? 'Edit Contractor' : 'Create New Contractor' }}</h5>
                <p class="mb-0 mt-1 opacity-75">Fill in the details below to {{ isset($contractor) ? 'update' : 'create' }} contractor account</p>
            </div>
        </div>
    </div>

    <!-- User Information Card -->
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ isset($contractor) ? route('contractors.update', $contractor) : route('contractors.store') }}" method="POST">
                @csrf
                @if(isset($contractor))
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
                                        Name
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="ph-text-aa text-muted"></i>
                                        </span>
                                        <input type="text"
                                               name="constractor_name"
                                               class="form-control border-start-0"
                                               value="{{ old('constractor_name', $contractor->constractor_name ?? '') }}"
                                               required
                                               placeholder="Enter contractor name">
                                    </div>
                                    @error('constractor_name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Vendor Number -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-medium">
                                        <i class="ph-phone me-2 text-secondary"></i>
                                        Vendor Number
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="ph-phone-env text-muted"></i>
                                        </span>
                                        <input type="text"
                                               name="vendor_no"
                                               class="form-control border-start-0"
                                               value="{{ old('vendor_no', $contractor->vendor_no ?? '') }}"
                                               placeholder="Enter vendor number">
                                    </div>
                                    @error('vendor_no')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
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
                                               value="{{ old('email', $contractor->email ?? '') }}"
                                               required
                                               placeholder="Enter email address">
                                    </div>
                                    @error('email')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text text-muted">User's primary email address</div>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6">
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
                                               value="{{ old('phone', $contractor->phone ?? '') }}"
                                               placeholder="Enter phone number">
                                    </div>
                                    @error('phone')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text text-muted">Primary contact number</div>
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
                                <a href="{{ route('contractors.index') }}" class="btn btn-light">
                                    <i class="ph-arrow-left me-2"></i>Cancel
                                </a>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="ph-arrow-clockwise me-2"></i>Reset Form
                                </button>
                                <button type="submit" class="btn btn-primary btn-submit">
                                    <i class="ph-paper-plane-tilt me-2"></i>
                                    {{ isset($contractor) ? 'Update Contractor' : 'Create Contractor' }}
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
    });
</script>
