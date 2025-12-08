    <div class="row">
        <!-- Issue Number Field -->
        @if (isset($noc))
        <div class="col-12 mb-4">
            <div class="alert alert-primary d-flex align-items-center">
                <i class="ph-info fs-4 me-3 text-primary"></i>
                <div>
                    <h6 class="mb-1 fw-semibold">📋 Issue Number</h6>
                    <p class="mb-0 fs-5 text-dark">{{ $noc->issue_no }}</p>
                    <small class="text-muted">This NOC has been assigned an official issue number</small>
                </div>
            </div>
        </div>
        @else
        <div class="col-12 mb-3">
            <label class="form-label fw-semibold">🔢 Issue Number <span class="text-danger">*</span></label>
            <input type="text" name="issue_no"
                   class="form-control {{ $errors->has('issue_no') ? 'is-invalid' : '' }}"
                   required
                   value="{{ old('issue_no', $noc->issue_no ?? '') }}"
                   placeholder="Enter unique issue number...">
            @if($errors->has('issue_no'))
                <div class="invalid-feedback">
                    <i class="ph-warning-circle me-1"></i> {{ $errors->first('issue_no') }}
                </div>
            @else
                <div class="form-text">Assign a unique identification number for this NOC</div>
            @endif
        </div>
        @endif

        <!-- Department Field -->
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">🏢 Department <span class="text-danger">*</span></label>
            <input type="text" name="department"
                   class="form-control {{ $errors->has('department') ? 'is-invalid' : '' }}"
                   required
                   value="{{ old('department', $noc->department ?? '') }}"
                   placeholder="Enter department name...">
            @if($errors->has('department'))
                <div class="invalid-feedback">
                    <i class="ph-warning-circle me-1"></i> {{ $errors->first('department') }}
                </div>
            @else
                <div class="form-text">Specify the concerned department</div>
            @endif
        </div>

        <!-- NOC Subject Field -->
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">📝 NOC Subject <span class="text-danger">*</span></label>
            <input type="text" name="noc_subject"
                   class="form-control {{ $errors->has('noc_subject') ? 'is-invalid' : '' }}"
                   required
                   value="{{ old('noc_subject', $noc->noc_subject ?? '') }}"
                   placeholder="Enter NOC subject title...">
            @if($errors->has('noc_subject'))
                <div class="invalid-feedback">
                    <i class="ph-warning-circle me-1"></i> {{ $errors->first('noc_subject') }}
                </div>
            @else
                <div class="form-text">Brief subject description of the NOC</div>
            @endif
        </div>

        <!-- Nature of NOC Field -->
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">📋 Nature of NOC <span class="text-danger">*</span></label>
            <input type="text" name="nature_of_noc"
                   class="form-control {{ $errors->has('nature_of_noc') ? 'is-invalid' : '' }}"
                   required
                   value="{{ old('nature_of_noc', $noc->nature_of_noc ?? '') }}"
                   placeholder="Describe the nature of NOC...">
            @if($errors->has('nature_of_noc'))
                <div class="invalid-feedback">
                    <i class="ph-warning-circle me-1"></i> {{ $errors->first('nature_of_noc') }}
                </div>
            @else
                <div class="form-text">Type or category of the No Objection Certificate</div>
            @endif
        </div>

        <!-- Issue Date Field -->
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">📅 Issue Date <span class="text-danger">*</span></label>
            <input type="date" name="issued_date"
                   class="form-control {{ $errors->has('issued_date') ? 'is-invalid' : '' }}"
                   required
                   value="{{ old('issued_date', isset($noc) ? $noc->issued_date->format('Y-m-d') : '') }}"
                   id="issueDate">
            @if($errors->has('issued_date'))
                <div class="invalid-feedback">
                    <i class="ph-warning-circle me-1"></i> {{ $errors->first('issued_date') }}
                </div>
            @else
                <div class="form-text">Date when the NOC was issued</div>
            @endif
        </div>

        <!-- Remarks Field -->
        <div class="col-12 mb-4">
            <label class="form-label fw-semibold">💬 Remarks <span class="text-danger">*</span></label>
            <textarea name="remarks"
                      class="form-control {{ $errors->has('remarks') ? 'is-invalid' : '' }}"
                      required
                      rows="4"
                      placeholder="Enter detailed remarks and comments...">{{ old('remarks', $noc->remarks ?? '') }}</textarea>
            @if($errors->has('remarks'))
                <div class="invalid-feedback">
                    <i class="ph-warning-circle me-1"></i> {{ $errors->first('remarks') }}
                </div>
            @else
                <div class="form-text">Provide additional details, comments, or special instructions</div>
            @endif
        </div>
    </div>

    <!-- Display general form errors -->
    @if($errors->any() && !$errors->has('issue_no') && !$errors->has('department') && !$errors->has('noc_subject') && !$errors->has('nature_of_noc') && !$errors->has('remarks') && !$errors->has('issued_date'))
        <div class="alert alert-danger">
            <div class="d-flex align-items-center">
                <i class="ph-warning-circle fs-4 me-2"></i>
                <div>
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Form Actions -->
    <div class="d-flex justify-content-between align-items-center border-top pt-4">
        <div>
            @if(isset($noc))
                <small class="text-muted">
                    <i class="ph-clock me-1"></i>
                    Last updated: {{ $noc->updated_at->format('M d, Y \a\t h:i A') ?? 'Never' }}
                </small>
            @else
                <small class="text-muted">
                    <i class="ph-plus-circle me-1"></i>
                    Create a new NOC record
                </small>
            @endif
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                <i class="ph-x me-2"></i>Cancel
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="ph-paper-plane-tilt me-2"></i>
                {{ isset($noc) ? 'Update NOC' : 'Create NOC' }}
            </button>
        </div>
    </div>
<style>
.form-label {
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
    color: #374151;
}

.form-control, .form-select {
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
    transition: all 0.2s ease-in-out;
}

.form-control:focus, .form-select:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    outline: none;
}

.form-control.is-invalid, .form-select.is-invalid {
    border-color: #dc3545;
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
}

.form-text {
    font-size: 0.8rem;
    color: #6b7280;
    margin-top: 0.25rem;
}

.invalid-feedback {
    display: block;
    font-size: 0.8rem;
    color: #dc3545;
    margin-top: 0.25rem;
}

.alert {
    border-radius: 0.5rem;
    border: none;
}

.alert-primary {
    background: rgba(59, 130, 246, 0.1);
    border-left: 4px solid #3b82f6;
}

.alert-danger {
    background: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

.btn {
    border-radius: 0.5rem;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
}

.btn-primary {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    border: none;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.border-top {
    border-color: #e5e7eb !important;
}

.text-danger {
    color: #dc3545 !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set default date to today if no value exists and it's a new form
    const issueDateInput = document.getElementById('issueDate');
    if (issueDateInput && !issueDateInput.value && '{{ isset($noc) }}' !== 'PUT') {
        const today = new Date();
        const formattedDate = today.toISOString().split('T')[0];
        issueDateInput.value = formattedDate;
    }

    // Add character counter for remarks
    const remarksTextarea = document.querySelector('textarea[name="remarks"]');
    if (remarksTextarea) {
        const charCounter = document.createElement('div');
        charCounter.className = 'form-text text-end';
        charCounter.textContent = '0 characters';
        remarksTextarea.parentNode.appendChild(charCounter);

        remarksTextarea.addEventListener('input', function() {
            const length = this.value.length;
            charCounter.textContent = `${length} characters`;
            charCounter.className = `form-text text-end ${length > 1000 ? 'text-warning' : 'text-muted'}`;
        });

        // Trigger initial count
        remarksTextarea.dispatchEvent(new Event('input'));
    }

    // Real-time validation
    const form = document.getElementById('entityForm');
    const inputs = form.querySelectorAll('input[required], textarea[required]');

    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });

        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                validateField(this);
            }
        });
    });

    function validateField(field) {
        if (!field.value.trim() && field.hasAttribute('required')) {
            field.classList.add('is-invalid');
            // Remove any existing custom error message
            const existingError = field.parentNode.querySelector('.custom-error');
            if (existingError) existingError.remove();

            // Add custom error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback custom-error';
            errorDiv.innerHTML = `<i class="ph-warning-circle me-1"></i> This field is required`;
            field.parentNode.appendChild(errorDiv);
        } else {
            field.classList.remove('is-invalid');
            const existingError = field.parentNode.querySelector('.custom-error');
            if (existingError) existingError.remove();
        }
    }

    // Form submission validation
    form.addEventListener('submit', function(e) {
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim() && input.hasAttribute('required')) {
                validateField(input);
                isValid = false;

                // Focus on first invalid field
                if (isValid === false) {
                    input.focus();
                    isValid = null; // Prevent multiple focus calls
                }
            }
        });

        if (!isValid) {
            e.preventDefault();

            // Show general error alert if not already visible
            if (!document.querySelector('.alert-danger')) {
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-danger';
                alertDiv.innerHTML = `
                    <div class="d-flex align-items-center">
                        <i class="ph-warning-circle fs-4 me-2"></i>
                        <div>
                            <strong>Please fill in all required fields before submitting.</strong>
                        </div>
                    </div>
                `;
                form.insertBefore(alertDiv, form.firstChild);
            }
        }
    });

    // Auto-remove validation styling when user starts typing
    form.addEventListener('input', function(e) {
        if (e.target.classList.contains('is-invalid')) {
            e.target.classList.remove('is-invalid');
            const existingError = e.target.parentNode.querySelector('.custom-error');
            if (existingError) existingError.remove();
        }

        // Remove general error alert when user starts correcting
        const generalError = document.querySelector('.alert-danger');
        if (generalError && !form.querySelector('.is-invalid')) {
            generalError.remove();
        }
    });
});
</script>
