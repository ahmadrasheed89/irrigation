<div class="content">
    <!-- Header Section -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
            <div>
                <h5 class="mb-0 fw-bold">📋 Scheme Information</h5>
                <p class="mb-0 mt-1 opacity-75">Fill in the details below to {{ isset($scheme) ? 'update' : 'create' }} the scheme</p>
            </div>
        </div>
    </div>

    <!-- All Form Fields in a Single Well-Spaced Layout -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                <!-- ADP Selection -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-list-dashes me-2 text-primary"></i>
                            ADP
                        </label>
                        @if (isset($adpId))
                        <input type="hidden" name="adp_id" value="{{ $adps[0]->id }}" />
                        <input type="text" class="form-control" value="{{ $adps[0]->adp_code }}" readonly>
                        @else
                        <select name="adp_id" class="form-control">
                            @foreach($adps as $adp)
                                <option value="{{ $adp->id }}" {{ (isset($scheme)) && $scheme->adp_id == $adp->id ? 'selected' : '' }}>{{ $adp->adp_code }}</option>
                            @endforeach
                        </select>
                        @endif
                        <x-input-error :messages="$errors->get('adp_id')" class="mt-1" />
                        <div class="form-text text-muted">Associated ADP</div>
                    </div>
                </div>

                <!-- Scheme Name -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-text-aa me-2 text-info"></i>
                            Scheme Name
                        </label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               required
                               value="{{ old('name', $scheme->name ?? '') }}"
                               placeholder="Enter scheme name">
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        <div class="form-text text-muted">Full name of the scheme</div>
                    </div>
                </div>

                <!-- Expenditure -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-currency-circle-dollar me-2 text-success"></i>
                            Expenditure
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">₨</span>
                            <input type="number"
                                   step="0.01"
                                   name="expenditure"
                                   class="form-control"
                                   required
                                   value="{{ old('expenditure', $scheme->expenditure ?? '') }}"
                                   placeholder="0.00">
                        </div>
                        <x-input-error :messages="$errors->get('expenditure')" class="mt-1" />
                        <div class="form-text text-muted">Total expenditure</div>
                    </div>
                </div>

                <!-- Physical Progress -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-chart-line me-2 text-primary"></i>
                            Physical Progress
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">%</span>
                            <input type="number"
                                   step="0.01"
                                   name="physical_progress"
                                   class="form-control"
                                   required
                                   value="{{ old('physical_progress', $scheme->physical_progress ?? '') }}"
                                   placeholder="0.00">
                        </div>
                        <x-input-error :messages="$errors->get('physical_progress')" class="mt-1" />
                        <div class="form-text text-muted">Physical progress percentage</div>
                    </div>
                </div>

                <!-- Financial Progress -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-trend-up me-2 text-success"></i>
                            Financial Progress
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">%</span>
                            <input type="number"
                                   step="0.01"
                                   name="financial_progress"
                                   class="form-control"
                                   required
                                   value="{{ old('financial_progress', $scheme->financial_progress ?? '') }}"
                                   placeholder="0.00">
                        </div>
                        <x-input-error :messages="$errors->get('financial_progress')" class="mt-1" />
                        <div class="form-text text-muted">Financial progress percentage</div>
                    </div>
                </div>

                <!-- Contractor Selection -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-user me-2 text-warning"></i>
                            Contractor
                        </label>
                        <select name="contractor_id" class="form-control">
                            <option value="">Select Contractor</option>
                            @foreach($contractors as $contractor)
                                <option value="{{ $contractor->id }}" {{ (isset($scheme)) && $scheme->contractor_id == $contractor->id ? 'selected' : '' }}>{{ $contractor->constractor_name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('contractor_id')" class="mt-1" />
                        <div class="form-text text-muted">Select contractor</div>
                    </div>
                </div>

                <!-- Contractor Premium -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-star me-2 text-warning"></i>
                            Contractor Premium
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">₨</span>
                            <input type="number"
                                   step="0.01"
                                   name="contractor_premium"
                                   class="form-control"
                                   value="{{ old('contractor_premium', $scheme->contractor_premium ?? '') }}"
                                   placeholder="0.00">
                        </div>
                        <x-input-error :messages="$errors->get('contractor_premium')" class="mt-1" />
                        <div class="form-text text-muted">Premium amount</div>
                    </div>
                </div>

                <!-- Bid Cost -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-calculator me-2 text-info"></i>
                            Bid Cost
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">₨</span>
                            <input type="number"
                                   step="0.01"
                                   name="bid_cost"
                                   class="form-control"
                                   value="{{ old('bid_cost', $scheme->bid_cost ?? '') }}"
                                   placeholder="0.00">
                        </div>
                        <x-input-error :messages="$errors->get('bid_cost')" class="mt-1" />
                        <div class="form-text text-muted">Cost in bid</div>
                    </div>
                </div>

                <!-- TS Cost -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-money me-2 text-info"></i>
                            TS Cost
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">₨</span>
                            <input type="number"
                                   step="0.01"
                                   name="sub_work_t_s_cost"
                                   class="form-control"
                                   value="{{ old('sub_work_t_s_cost', $scheme->sub_work_t_s_cost ?? '') }}"
                                   placeholder="0.00">
                        </div>
                        <x-input-error :messages="$errors->get('sub_work_t_s_cost')" class="mt-1" />
                        <div class="form-text text-muted">TS cost for sub-work</div>
                    </div>
                </div>

                <!-- Liability -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-warning-circle me-2 text-danger"></i>
                            Liability
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">₨</span>
                            <input type="number"
                                   step="0.01"
                                   name="liability"
                                   class="form-control"
                                   value="{{ old('liability', $scheme->liability ?? 0) }}"
                                   required
                                   placeholder="0.00">
                        </div>
                        <x-input-error :messages="$errors->get('liability')" class="mt-1" />
                        <div class="form-text text-muted">Pending obligations</div>
                    </div>
                </div>

                <!-- Progress Visualization -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-gauge me-2 text-primary"></i>
                            Progress Summary
                        </label>
                        <div class="progress-summary p-3 border rounded bg-light">
                            @php
                                $physicalProgress = old('physical_progress', $scheme->physical_progress ?? 0);
                                $financialProgress = old('financial_progress', $scheme->financial_progress ?? 0);
                                $physicalColor = $physicalProgress >= 80 ? 'success' :
                                               ($physicalProgress >= 50 ? 'warning' : 'danger');
                                $financialColor = $financialProgress >= 80 ? 'success' :
                                                ($financialProgress >= 50 ? 'warning' : 'danger');
                            @endphp

                            <div class="mb-2">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="small fw-medium">Physical</span>
                                    <span class="small badge bg-{{ $physicalColor }}">{{ number_format($physicalProgress, 1) }}%</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-{{ $physicalColor }}"
                                         style="width: {{ min($physicalProgress, 100) }}%"></div>
                                </div>
                            </div>

                            <div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="small fw-medium">Financial</span>
                                    <span class="small badge bg-{{ $financialColor }}">{{ number_format($financialProgress, 1) }}%</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-{{ $financialColor }}"
                                         style="width: {{ min($financialProgress, 100) }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between align-items-center py-2">
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

.progress-summary {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
}

.progress {
    background-color: #e5e7eb;
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

.input-group-text {
    background-color: #f8f9fa;
    border-color: #dee2e6;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.form-control:focus, .form-select:focus {
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.1);
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

/* Pakistani Rupee styling */
.input-group-text {
    font-weight: 600;
    color: #1e40af;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Real-time progress update
    const physicalProgressInput = document.querySelector('input[name="physical_progress"]');
    const financialProgressInput = document.querySelector('input[name="financial_progress"]');

    function updateProgressSummary() {
        const physicalProgress = parseFloat(physicalProgressInput.value) || 0;
        const financialProgress = parseFloat(financialProgressInput.value) || 0;

        const physicalColor = physicalProgress >= 80 ? 'success' :
                            (physicalProgress >= 50 ? 'warning' : 'danger');
        const financialColor = financialProgress >= 80 ? 'success' :
                             (financialProgress >= 50 ? 'warning' : 'danger');

        const summary = document.querySelector('.progress-summary');
        if (summary) {
            // Update physical progress
            const physicalBadge = summary.querySelectorAll('.badge')[0];
            const physicalBar = summary.querySelectorAll('.progress-bar')[0];
            if (physicalBadge) {
                physicalBadge.textContent = `${physicalProgress.toFixed(1)}%`;
                physicalBadge.className = `small badge bg-${physicalColor}`;
            }
            if (physicalBar) {
                physicalBar.style.width = `${Math.min(physicalProgress, 100)}%`;
                physicalBar.className = `progress-bar bg-${physicalColor}`;
            }

            // Update financial progress
            const financialBadge = summary.querySelectorAll('.badge')[1];
            const financialBar = summary.querySelectorAll('.progress-bar')[1];
            if (financialBadge) {
                financialBadge.textContent = `${financialProgress.toFixed(1)}%`;
                financialBadge.className = `small badge bg-${financialColor}`;
            }
            if (financialBar) {
                financialBar.style.width = `${Math.min(financialProgress, 100)}%`;
                financialBar.className = `progress-bar bg-${financialColor}`;
            }
        }
    }

    if (physicalProgressInput && financialProgressInput) {
        physicalProgressInput.addEventListener('input', updateProgressSummary);
        financialProgressInput.addEventListener('input', updateProgressSummary);
    }

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
