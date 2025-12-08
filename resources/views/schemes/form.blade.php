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
        .form-section {
            margin-bottom: 1.5rem;
        }
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .form-text {
            font-size: 0.8rem;
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
</head>
<body>
    <div class="content">
        <!-- Header Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">📋 Scheme Information</h5>
                    <p class="mb-0 mt-1 opacity-75">Fill in the details below to {{ isset($scheme) ? 'update' : 'create' }} the scheme</p>
                </div>
            </div>
        </div>

        <!-- Scheme Details Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0 fw-semibold">📝 Basic Details</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <!-- ADP Selection -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-medium">
                                <i class="ph-list-dashes me-2 text-primary"></i>
                                ADP
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="ph-selection text-muted"></i>
                                </span>
                                @if (isset($adpId))
                                <input type="hidden" name="adp_id" value="{{  $adps[0]->id}}" />
                                <label class="form-control border-start-0}}">{{ $adps[0]->adp_code }}</label>
                                @else
                                <select name="adp_id" class="form-control border-start-0">
                                    @foreach($adps as $adp)
                                        <option value="{{ $adp->id }}" {{ (isset($scheme)) && $scheme->adp_id == $adp->id ? 'selected' : '' }}>{{ $adp->adp_code }}</option>
                                    @endforeach
                                </select>
                                @endif

                            </div>
                            <x-input-error :messages="$errors->get('adp_id')" class="mt-2" />
                            <div class="form-text text-muted">Select the associated ADP</div>
                        </div>
                    </div>

                    <!-- Scheme Name -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-medium">
                                <i class="ph-text-aa me-2 text-info"></i>
                                Scheme Name
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="ph-textbox text-muted"></i>
                                </span>
                                <input type="text"
                                       name="name"
                                       class="form-control border-start-0"
                                       required
                                       value="{{ old('name', $scheme->name ?? '') }}"
                                       placeholder="Enter scheme name">
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            <div class="form-text text-muted">Full name of the scheme</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Financial Information Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0 fw-semibold">💰 Financial Details</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <!-- Expenditure -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-medium">
                                <i class="ph-currency-circle-dollar me-2 text-success"></i>
                                Expenditure
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="ph-currency-pkr text-muted"></i>
                                </span>
                                <input type="number"
                                       step="0.01"
                                       name="expenditure"
                                       class="form-control border-start-0"
                                       required
                                       value="{{ old('expenditure', $scheme->expenditure ?? '') }}"
                                       placeholder="0.00">
                            </div>
                            <x-input-error :messages="$errors->get('expenditure')" class="mt-2" />
                            <div class="form-text text-muted">Total expenditure for this scheme</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contractor Information Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0 fw-semibold">👷 Contractor Details</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <!-- Contractor Selection -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-medium">
                                <i class="ph-user me-2 text-warning"></i>
                                Contractor
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="ph-users text-muted"></i>
                                </span>
                                <select name="contractor_id" class="form-control border-start-0">
                                    <option value="">Select Contractor</option>
                                    @foreach($contractors as $contractor)
                                        <option value="{{ $contractor->id }}" {{ (isset($scheme)) && $scheme->contractor_id == $contractor->id ? 'selected' : '' }}>{{ $contractor->constractor_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('contractor_id')" class="mt-2" />
                            <div class="form-text text-muted">Select the contractor for this scheme</div>
                        </div>
                    </div>

                    <!-- Contractor Premium -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-medium">
                                <i class="ph-trend-up me-2 text-success"></i>
                                Contractor Premium
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="ph-currency-pkr text-muted"></i>
                                </span>
                                <input type="number"
                                       step="0.01"
                                       name="contractor_premium"
                                       class="form-control border-start-0"
                                       value="{{ old('contractor_premium', $scheme->contractor_premium ?? '') }}"
                                       placeholder="0.00">
                            </div>
                            <x-input-error :messages="$errors->get('contractor_premium')" class="mt-2" />
                            <div class="form-text text-muted">Premium amount for the contractor</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cost Information Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0 fw-semibold">📊 Cost Details</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <!-- Bid Cost -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-medium">
                                <i class="ph-calculator me-2 text-info"></i>
                                Bid Cost
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="ph-currency-pk text-muted"></i>
                                </span>
                                <input type="number"
                                       step="0.01"
                                       name="bid_cost"
                                       class="form-control border-start-0"
                                       value="{{ old('bid_cost', $scheme->bid_cost ?? '') }}"
                                       placeholder="0.00">
                            </div>
                            <x-input-error :messages="$errors->get('bid_cost')" class="mt-2" />
                            <div class="form-text text-muted">Cost submitted in the bid</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-medium">
                                <i class="ph-money me-2 text-info"></i>
                                TS Cost
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="ph-currency-pk text-muted"></i>
                                </span>
                                <input type="number"
                                       step="0.01"
                                       name="sub_work_t_s_cost"
                                       class="form-control border-start-0"
                                       value="{{ old('sub_work_t_s_cost', $scheme->sub_work_t_s_cost ?? '') }}"
                                       placeholder="0.00">
                            </div>
                            <x-input-error :messages="$errors->get('sub_work_t_s_cost')" class="mt-2" />
                            <div class="form-text text-muted">Cost submitted in the bid</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label class="form-label fw-medium">
                            <i class="ph-warning-circle me-2 text-warning"></i>
                            Liability
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="ph-currency-pk text-muted"></i>
                            </span>
                            <input type="number"
                                   step="0.01"
                                   name="liability"
                                   class="form-control border-start-0"
                                   value="{{ old('liability', $scheme->liability ?? 0) }}"
                                   required
                                   placeholder="0.00">
                        </div>
                        <x-input-error :messages="$errors->get('liability')" class="mt-2" />
                        <div class="form-text text-muted">Pending financial obligations</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ url()->previous() }}" class="btn btn-light">
                            <i class="ph-arrow-left me-2"></i>Cancel
                        </a>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="reset" class="btn btn-outline-secondary">
                            <i class="ph-arrow-clockwise me-2"></i>Reset Form
                        </button>
                        <button type="submit" class="btn btn-primary btn-submit">
                            <i class="ph-paper-plane-tilt me-2"></i>
                            {{ isset($scheme) ? 'Update Scheme' : 'Create Scheme' }}
                            <span class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
