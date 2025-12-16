<div class="content">
    <!-- Header Section -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
            <div>
                <h5 class="mb-0 fw-bold">🏷️ {{ isset($nocCategory) ? 'Edit NOC Category' : 'Create NOC Category' }}</h5>
                <p class="mb-0 mt-1 opacity-75">Fill in the details below to {{ isset($nocCategory) ? 'update' : 'create' }} NOC category</p>
            </div>
        </div>
    </div>

    <!-- All Form Fields in a Single Well-Spaced Layout -->
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ isset($nocCategory) ? route('noc-categories.update', $nocCategory) : route('noc-categories.store') }}">
                @csrf
                @if(isset($nocCategory))
                    @method('PUT')
                @endif

                <div class="row g-3">
                    <!-- Category Name -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-medium">
                                <i class="ph-folder me-2 text-primary"></i>
                                Category Name
                            </label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   required
                                   value="{{ old('name', $nocCategory->name ?? '') }}"
                                   placeholder="Enter category name">
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                            <div class="form-text text-muted">Name for NOC category</div>
                        </div>
                    </div>

                    <!-- Category Description -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-medium">
                                <i class="ph-note me-2 text-info"></i>
                                Description
                            </label>
                            <textarea name="description"
                                      class="form-control"
                                      required
                                      rows="2"
                                      placeholder="Enter category description">{{ old('description', $nocCategory->description ?? '') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-1" />
                            <div class="form-text text-muted">Brief description of category</div>
                            <div class="text-end mt-1">
                                <small id="charCount" class="text-muted">0 chars</small>
                            </div>
                        </div>
                    </div>

                    <!-- NOC Category Info -->
                    <div class="col-md-12">
                        <div class="noc-category-info p-3 border rounded bg-light">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="ph-file-text text-primary me-2"></i>
                                        <div class="small">
                                            <div class="fw-medium">NOC Category</div>
                                            <div class="text-muted">Organizes NOC types</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="ph-list-dashes text-success me-2"></i>
                                        <div class="small">
                                            <div class="fw-medium">Organization</div>
                                            <div class="text-muted">Groups related NOCs</div>
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
                                {{ isset($nocCategory) ? 'Update Category' : 'Create Category' }}
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

.noc-category-info {
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
    min-height: 80px;
}
</style>

