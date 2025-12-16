<div class="content">
    <!-- Header Section -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
            <div>
                <h5 class="mb-0 fw-bold">👤 Portfolio Information</h5>
                <p class="mb-0 mt-1 opacity-75">Fill in the details below to {{ isset($portfolio) ? 'update' : 'create' }} the portfolio</p>
            </div>
        </div>
    </div>

    <!-- All Form Fields in a Single Well-Spaced Layout -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                <!-- Full Name -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-user-circle me-2 text-primary"></i>
                            Full Name
                        </label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               required
                               value="{{ old('name', $portfolio->name ?? '') }}"
                               placeholder="Enter full name">
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        <div class="form-text text-muted">Complete name of the person</div>
                    </div>
                </div>

                <!-- Designation -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-briefcase me-2 text-info"></i>
                            Designation
                        </label>
                        <input type="text"
                               name="designation"
                               class="form-control"
                               required
                               value="{{ old('designation', $portfolio->designation ?? '') }}"
                               placeholder="Enter designation">
                        <x-input-error :messages="$errors->get('designation')" class="mt-1" />
                        <div class="form-text text-muted">Job title/position</div>
                    </div>
                </div>

                <!-- Personal No -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-identification-badge me-2 text-success"></i>
                            Personal No
                        </label>
                        <input type="text"
                               name="personal_no"
                               class="form-control"
                               required
                               value="{{ old('personal_no', $portfolio->personal_no ?? '') }}"
                               placeholder="Enter personal number">
                        <x-input-error :messages="$errors->get('personal_no')" class="mt-1" />
                        <div class="form-text text-muted">Employee/Personal number</div>
                    </div>
                </div>

                <!-- CNIC -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-identification-card me-2 text-warning"></i>
                            CNIC
                        </label>
                        <input type="text"
                               name="cnic"
                               class="form-control"
                               required
                               value="{{ old('cnic', $portfolio->cnic ?? '') }}"
                               placeholder="XXXXX-XXXXXXX-X">
                        <x-input-error :messages="$errors->get('cnic')" class="mt-1" />
                        <div class="form-text text-muted">National identity card number</div>
                    </div>
                </div>

                <!-- Duty Station -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-buildings me-2 text-secondary"></i>
                            Duty Station
                        </label>
                        <input type="text"
                               name="duty_station"
                               class="form-control"
                               required
                               value="{{ old('duty_station', $portfolio->duty_station ?? '') }}"
                               placeholder="Enter duty station">
                        <x-input-error :messages="$errors->get('duty_station')" class="mt-1" />
                        <div class="form-text text-muted">Office/Work location</div>
                    </div>
                </div>

                <!-- File Upload -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-paperclip me-2 text-danger"></i>
                            Attach Files
                        </label>
                        <div class="file-upload-area border rounded p-3 text-center bg-light" style="cursor: pointer;">
                            <input type="file"
                                   name="file_path[]"
                                   class="file-input"
                                   id="fileInput"
                                   multiple
                                   accept=".gif,.png,.jpg,.jpeg,.pdf,.doc,.docx"
                                   style="display: none;">
                            <div class="file-upload-content">
                                <i class="ph-cloud-arrow-up fs-2 text-muted mb-2 d-block"></i>
                                <h6 class="mb-1">Drop files here or click to upload</h6>
                                <p class="text-muted mb-2 small">Supports: Images, PDF, DOC • Max 5MB per file</p>
                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="document.getElementById('fileInput').click()">
                                    <i class="ph-upload-simple me-1"></i>Choose Files
                                </button>
                            </div>
                            <div class="file-preview mt-2" id="filePreview">
                                @if(!empty($portfolio->file_path))
                                    @foreach($portfolio->file_path as $file)
                                        <div class="alert alert-success d-flex align-items-center py-2 mb-1">
                                            <i class="ph-file-text me-2"></i>
                                            <div class="flex-grow-1 small">
                                                <a href="{{ Storage::url($file) }}"
                                                   target="_blank"
                                                   class="alert-link">
                                                    View File
                                                </a>
                                            </div>
                                            <button type="button" class="btn-close btn-close-sm" onclick="removeFilePreview(this)"></button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('file_path')" class="mt-2" />
                        <div class="form-text text-muted">Upload multiple files if needed</div>
                    </div>
                </div>

                <!-- Description -->
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-note me-2 text-secondary"></i>
                            Description
                        </label>
                        <textarea name="description"
                                  class="form-control"
                                  rows="4"
                                  placeholder="Enter additional description or details...">{{ old('description', $portfolio->description ?? '') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-1" />
                        <div class="form-text text-muted">
                            <i class="ph-info me-1"></i> Optional: Add any additional information
                        </div>
                    </div>
                </div>

                <!-- Info Summary -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-medium">
                            <i class="ph-info me-2 text-primary"></i>
                            Information Summary
                        </label>
                        <div class="info-summary p-3 border rounded bg-light">
                            <div class="d-flex align-items-center mb-2">
                                <i class="ph-user text-primary me-2"></i>
                                <div class="small">
                                    <div class="fw-medium">Personal Details</div>
                                    <div class="text-muted">Name, CNIC, Personal No</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="ph-briefcase text-info me-2"></i>
                                <div class="small">
                                    <div class="fw-medium">Professional Details</div>
                                    <div class="text-muted">Designation & Duty Station</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="ph-file-text text-success me-2"></i>
                                <div class="small">
                                    <div class="fw-medium">Documentation</div>
                                    <div class="text-muted">Attach supporting files</div>
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
                        {{ isset($portfolio) ? 'Update Portfolio' : 'Create Portfolio' }}
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

.info-summary {
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
    min-height: 100px;
}

.input-group-text {
    background-color: #f8f9fa;
    border-color: #dee2e6;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // File upload preview
    const fileInput = document.getElementById('fileInput');
    const filePreview = document.getElementById('filePreview');
    const fileUploadArea = document.querySelector('.file-upload-area');

    fileInput.addEventListener('change', function(e) {
        const files = e.target.files;
        if (files.length > 0) {
            let previewHTML = '';
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileSize = file.size / 1024 / 1024; // MB

                if (fileSize > 5) {
                    alert(`File "${file.name}" exceeds 5MB limit`);
                    fileInput.value = '';
                    return;
                }

                previewHTML += `
                    <div class="alert alert-success d-flex align-items-center py-2 mb-1">
                        <i class="ph-file-text me-2"></i>
                        <div class="flex-grow-1 small">
                            ${file.name} (${fileSize.toFixed(2)} MB)
                        </div>
                        <button type="button" class="btn-close btn-close-sm" onclick="removeFilePreview(this)"></button>
                    </div>
                `;
            }
            filePreview.innerHTML = previewHTML;
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

function removeFilePreview(button) {
    const filePreview = document.getElementById('filePreview');
    const alertDiv = button.closest('.alert');

    if (alertDiv) {
        alertDiv.remove();
    }

    // Clear file input if all previews are removed
    if (filePreview.children.length === 0) {
        const fileInput = document.getElementById('fileInput');
        if (fileInput) fileInput.value = '';
    }
}
</script>
