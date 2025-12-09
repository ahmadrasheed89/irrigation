<x-app-layout>
    <div class="content">
        <!-- Header Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">👤 Contractor Details</h5>
                    <p class="mb-0 mt-1 opacity-75">View contractor information and activity</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('contractors.index') }}" class="btn btn-light btn-sm">
                        <i class="ph-arrow-left me-2"></i>Back to Contractors
                    </a>
                    <a href="{{ route('contractors.create') }}" class="btn btn-success btn-sm">
                        <i class="ph-user-plus me-2"></i>New Contractor
                    </a>
                    <a href="{{ route('contractors.edit', $contractor) }}" class="btn btn-primary btn-sm">
                        <i class="ph-pencil-simple me-2"></i>Edit Contractor
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
                            {{ strtoupper(substr($contractor->constractor_name, 0, 1)) }}
                        </div>

                        <h3 class="mb-1">{{ $contractor->constractor_name }}</h3>
                        <div class="text-muted mb-3">{{ $contractor->vendor_no }}</div>
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

                            <form action="{{ route('contractors.destroy', $contractor) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this contractor?')" class="d-grid">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="ph-trash me-2"></i>
                                    Delete Contractor
                                </button>
                            </form>
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
                            Contractor Information
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
                                        {{ $contractor->constractor_name }}
                                    </div>
                                </div>
                            </div>

                            <!-- Vendor Number -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-medium">
                                        <i class="ph-at me-2 text-info"></i>
                                        Vendor Number
                                    </label>
                                    <div class="form-control-plaintext p-2 bg-light rounded">
                                        {{ $contractor->vendor_no }}
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
                                        <span>{{ $contractor->email }}</span>
                                        @if($contractor->email_verified_at)
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
                                        {{ $contractor->phone ?? 'N/A' }}
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
                                    <div class="text-muted small">{{ $contractor->created_at->format('F j, Y \a\t g:i A') }}</div>
                                </div>
                            </div>

                            <!-- Last Updated -->
                            <div class="timeline-item d-flex align-items-start mb-3">
                                <div class="timeline-badge bg-info rounded-circle p-2 me-3 d-flex align-items-center justify-content-center">
                                    <i class="ph-pencil-simple text-white"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold">Last Updated</div>
                                    <div class="text-muted small">{{ $contractor->updated_at->format('F j, Y \a\t g:i A') }}</div>
                                </div>
                            </div>
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
