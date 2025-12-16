<div class="content">
    <!-- Header Section -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
            <div>
                <h5 class="mb-0 fw-bold">🏗️ ADP Information</h5>
                <p class="mb-0 mt-1 opacity-75">Fill in the details below to {{ isset($adp) ? 'update' : 'create' }} the Annual Development Program</p>
            </div>
        </div>
    </div>

    <!-- All Form Fields in a Single Well-Spaced Layout -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                <!-- ADP Code -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-identification-card me-2 text-primary"></i>
                            ADP Code
                        </label>
                        <input type="text"
                               class="form-control"
                               placeholder="Enter unique ADP code"
                               name="adp_code"
                               value="{{ old('adp_code', $adp->adp_code ?? '') }}"
                               required>
                        <x-input-error :messages="$errors->get('adp_code')" class="mt-1" />
                        <div class="form-text text-muted">Unique identifier for the ADP</div>
                    </div>
                </div>

                <!-- Total Allocation -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-currency-circle-dollar me-2 text-success"></i>
                            Total Allocation
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">₨</span>
                            <input type="number"
                                   step="0.01"
                                   name="allocation"
                                   class="form-control"
                                   value="{{ old('allocation', $adp->allocation ?? 0) }}"
                                   required
                                   placeholder="0.00">
                        </div>
                        <x-input-error :messages="$errors->get('allocation')" class="mt-1" />
                        <div class="form-text text-muted">Total budget allocated</div>
                    </div>
                </div>

                <!-- T/S Cost -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-calculator me-2 text-info"></i>
                            T/S Cost
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">₨</span>
                            <input type="number"
                                   step="0.01"
                                   name="adp_t_s_cost"
                                   class="form-control"
                                   value="{{ old('adp_t_s_cost', $adp->adp_t_s_cost ?? 0) }}"
                                   required
                                   placeholder="0.00">
                        </div>
                        <x-input-error :messages="$errors->get('adp_t_s_cost')" class="mt-1" />
                        <div class="form-text text-muted">Total sanctioned cost</div>
                    </div>
                </div>

                <!-- Total Expenditure -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-trend-up me-2 text-success"></i>
                            Total Expenditure
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">₨</span>
                            <input type="number"
                                   step="0.01"
                                   name="expenditure"
                                   class="form-control"
                                   value="{{ old('expenditure', $adp->expenditure ?? 0) }}"
                                   required
                                   placeholder="0.00">
                        </div>
                        <x-input-error :messages="$errors->get('expenditure')" class="mt-1" />
                        <div class="form-text text-muted">Amount spent to date</div>
                    </div>
                </div>

                <!-- Accrued Liability -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-warning-circle me-2 text-warning"></i>
                            Accrued Liability
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">₨</span>
                            <input type="number"
                                   step="0.01"
                                   name="accrued_liability"
                                   class="form-control"
                                   value="{{ old('accrued_liability', $adp->accrued_liability ?? 0) }}"
                                   required
                                   placeholder="0.00">
                        </div>
                        <x-input-error :messages="$errors->get('accrued_liability')" class="mt-1" />
                        <div class="form-text text-muted">Pending financial obligations</div>
                    </div>
                </div>

                <!-- Budget Utilization Indicator -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-gauge me-2 text-primary"></i>
                            Budget Utilization
                        </label>
                        <div class="budget-indicator p-3 border rounded bg-light">
                            @php
                                $allocation = old('allocation', $adp->allocation ?? 0);
                                $expenditure = old('expenditure', $adp->expenditure ?? 0);
                                $utilization = $allocation > 0 ? ($expenditure / $allocation) * 100 : 0;
                                $utilizationColor = $utilization >= 80 ? 'success' :
                                                  ($utilization >= 50 ? 'warning' : 'danger');
                            @endphp
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-semibold">Utilization Rate</span>
                                <span class="badge bg-{{ $utilizationColor }}">{{ number_format($utilization, 1) }}%</span>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 4px;">
                                <div class="progress-bar bg-{{ $utilizationColor }}"
                                     style="width: {{ min($utilization, 100) }}%; border-radius: 4px;">
                                </div>
                            </div>
                            <small class="text-muted mt-2 d-block">
                                ₨{{ number_format($expenditure, 0) }} of ₨{{ number_format($allocation, 0) }} used
                            </small>
                        </div>
                    </div>
                </div>

                <!-- File Upload -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-paperclip me-2 text-secondary"></i>
                            Attach File
                        </label>
                        <div class="file-upload-area border rounded p-3 text-center bg-light" style="cursor: pointer;">
                            <input type="file"
                                   name="attached_files"
                                   class="file-input"
                                   id="fileInput"
                                   accept=".gif,.png,.jpg,.jpeg,.pdf,.doc,.docx"
                                   style="display: none;">
                            <div class="file-upload-content">
                                <i class="ph-cloud-arrow-up fs-2 text-muted mb-2 d-block"></i>
                                <h6 class="mb-1">Drop files here or click to upload</h6>
                                <p class="text-muted mb-2 small">Supports: GIF, PNG, JPG, PDF, DOC • Max 2MB</p>
                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="document.getElementById('fileInput').click()">
                                    <i class="ph-upload-simple me-1"></i>Choose File
                                </button>
                            </div>
                            <div class="file-preview mt-2" id="filePreview">
                                @if(!empty($adp->attached_files))
                                    <div class="alert alert-success d-flex align-items-center py-2">
                                        <i class="ph-file-text me-2"></i>
                                        <div class="flex-grow-1 small">
                                            File attached:
                                            <a href="{{ Storage::url($adp->attached_files) }}"
                                               target="_blank"
                                               class="alert-link">
                                                View Current File
                                            </a>
                                        </div>
                                        <button type="button" class="btn-close btn-close-sm" onclick="removeFilePreview()"></button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('attached_files')" class="mt-2" />
                    </div>
                </div>

                <!-- Remarks -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-note me-2 text-secondary"></i>
                            Remarks & Notes
                        </label>
                        <textarea rows="6"
                                  name="remarks"
                                  class="form-control"
                                  placeholder="Enter additional remarks, notes, or special instructions about this ADP...">{{ old('remarks', $adp->remarks ?? '') }}</textarea>
                        <div class="form-text text-muted">
                            <i class="ph-info me-1"></i> Optional: Add any important notes or context
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
                        {{ isset($adp) ? 'Update ADP' : 'Create ADP' }}
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

.budget-indicator {
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

.file-upload-area {
    border: 2px dashed #d1d5db;
    transition: all 0.3s ease;
}

.file-upload-area:hover {
    border-color: #0d6efd;
    background: rgba(13, 110, 253, 0.05);
}

.file-upload-area.dragover {
    border-color: #0d6efd;
    background: rgba(13, 110, 253, 0.1);
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

textarea.form-control {
    resize: vertical;
    min-height: 120px;
}

/* Pakistani Rupee styling */
.input-group-text {
    font-weight: 600;
    color: #1e40af;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // File upload preview
    const fileInput = document.getElementById('fileInput');
    const filePreview = document.getElementById('filePreview');
    const fileUploadArea = document.querySelector('.file-upload-area');

    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const fileSize = file.size / 1024 / 1024; // MB
            if (fileSize > 2) {
                alert('File size must be less than 2MB');
                fileInput.value = '';
                return;
            }

            filePreview.innerHTML = `
                <div class="alert alert-success d-flex align-items-center py-2">
                    <i class="ph-file-text me-2"></i>
                    <div class="flex-grow-1 small">
                        Selected: ${file.name} (${(fileSize).toFixed(2)} MB)
                    </div>
                    <button type="button" class="btn-close btn-close-sm" onclick="removeFilePreview()"></button>
                </div>
            `;
        }
    });

    // Drag and drop functionality
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        fileUploadArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        fileUploadArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        fileUploadArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight() {
        fileUploadArea.classList.add('dragover');
    }

    function unhighlight() {
        fileUploadArea.classList.remove('dragover');
    }

    fileUploadArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files;
        fileInput.dispatchEvent(new Event('change'));
    }

    // Real-time budget utilization calculation
    const allocationInput = document.querySelector('input[name="allocation"]');
    const expenditureInput = document.querySelector('input[name="expenditure"]');

    function updateBudgetUtilization() {
        const allocation = parseFloat(allocationInput.value) || 0;
        const expenditure = parseFloat(expenditureInput.value) || 0;
        const utilization = allocation > 0 ? (expenditure / allocation) * 100 : 0;

        const utilizationColor = utilization >= 80 ? 'success' :
                               (utilization >= 50 ? 'warning' : 'danger');

        const utilizationCard = document.querySelector('.budget-indicator');
        if (utilizationCard) {
            utilizationCard.querySelector('.badge').textContent = `${utilization.toFixed(1)}%`;
            utilizationCard.querySelector('.badge').className = `badge bg-${utilizationColor}`;
            utilizationCard.querySelector('.progress-bar').style.width = `${Math.min(utilization, 100)}%`;
            utilizationCard.querySelector('.progress-bar').className = `progress-bar bg-${utilizationColor}`;
            utilizationCard.querySelector('small').textContent =
                `₨${expenditure.toLocaleString()} of ₨${allocation.toLocaleString()} used`;
        }
    }

    if (allocationInput && expenditureInput) {
        allocationInput.addEventListener('input', updateBudgetUtilization);
        expenditureInput.addEventListener('input', updateBudgetUtilization);
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

function removeFilePreview() {
    const fileInput = document.getElementById('fileInput');
    const filePreview = document.getElementById('filePreview');

    if (fileInput) fileInput.value = '';
    if (filePreview) filePreview.innerHTML = '';
}
</script>
