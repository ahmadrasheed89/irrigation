<x-app-layout>
    <div class="content">
        <!-- Header Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">Scheme: {{ $schemeName }}</h5>
                    <p class="mb-0 mt-1 opacity-75">Manage tender documents for each category</p>
                </div>
                <a href="{{ route('tenders.index') }}" class="btn btn-light">
                    <i class="ph-arrow-left me-2"></i> Back to List
                </a>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card border-0 bg-success bg-opacity-10">
                    <div class="card-body py-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-check-circle fs-2 text-success"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0">{{ $tenders->count() }}</h4>
                                <p class="mb-0 text-muted">Uploaded Categories</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 bg-warning bg-opacity-10">
                    <div class="card-body py-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-clock fs-2 text-warning"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0">{{ $allCategories->count() - $tenders->count() }}</h4>
                                <p class="mb-0 text-muted">Pending Categories</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 bg-info bg-opacity-10">
                    <div class="card-body py-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-folders fs-2 text-info"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0">{{ $allCategories->count() }}</h4>
                                <p class="mb-0 text-muted">Total Categories</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h6 class="mb-0 fw-semibold">Category-wise Tender Status</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Category</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Attached Files</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($allCategories as $category)
                                @php
                                    $tender = $tenders->firstWhere('category_id', $category->id);
                                @endphp
                                <tr class="{{ $tender ? 'border-start border-success border-3' : 'border-start border-warning border-3' }}">
                                    <td class="ps-4 fw-semibold">{{ $category->name }}</td>
                                    <td>
                                        <span class="text-truncate d-inline-block" style="max-width: 200px;"
                                              title="{{ $category->description }}">
                                            {{ $category->description }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($tender)
                                            <span class="badge bg-success rounded-pill">
                                                <i class="ph-check-circle me-1"></i> Uploaded
                                            </span>
                                        @else
                                            <span class="badge bg-warning rounded-pill">
                                                <i class="ph-clock me-1"></i> Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($tender)
                                            <span class="text-muted">{{ $tender->date->format('M d, Y') }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($tender)
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach($tender->attached_files ?? [] as $file)
                                                    <a href="{{ asset('storage/'.$file) }}" target="_blank"
                                                       class="btn btn-sm btn-outline-success d-flex align-items-center">
                                                        <i class="ph-eye me-1"></i> View
                                                    </a>
                                                @endforeach
                                            </div>
                                        @else
                                            <button class="btn btn-sm btn-primary uploadBtn d-flex align-items-center"
                                                data-category-id="{{ $category->id }}"
                                                data-scheme-id="{{ $schemeId }}">
                                                <i class="ph-upload me-1"></i> Upload
                                            </button>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($tender)
                                            <form action="{{ route('tenders.destroy', $tender) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this tender?')">
                                                    <i class="ph-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="ph-folders fs-1 text-muted mb-2"></i>
                                            <p class="text-muted mb-0">No categories found</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('tenders.store') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="uploadModalLabel">
                            <i class="ph-upload me-2"></i> Upload Tender Documents
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        @csrf
                        <input type="hidden" name="category_id" id="category_id">
                        <input type="hidden" name="scheme_id" id="scheme_id">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Enter description for these documents"></textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Created Date</label>
                            <input type="date" name="date" class="form-control" required>
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label fw-semibold">Select Files</label>
                            <input type="file" name="attached_files[]" id="file" class="form-control" multiple required>
                            <div class="form-text">You can select multiple files at once.</div>
                        </div>

                        <div id="uploadAlert"></div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ph-upload me-2"></i> Upload Files
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
    $(function() {
        let uploadModal = new bootstrap.Modal(document.getElementById('uploadModal'));

        // Open modal and set IDs
        $('.uploadBtn').click(function() {
            let categoryId = $(this).data('category-id');
            let schemeId = $(this).data('scheme-id');
            $('#category_id').val(categoryId);
            $('#scheme_id').val(schemeId);
            $('#uploadAlert').html('');
            $('#file').val('');
            uploadModal.show();
        });

        // Handle form submission
        $('form').on('submit', function() {
            // Show loading state on submit button
            const submitBtn = $(this).find('button[type="submit"]');
            const originalText = submitBtn.html();
            submitBtn.prop('disabled', true).html('<i class="ph-circle-notch ph-spin me-2"></i> Uploading...');

            // Re-enable button if form submission fails
            setTimeout(function() {
                submitBtn.prop('disabled', false).html(originalText);
            }, 5000);
        });
    });
    </script>

    <style>
    .table > :not(caption) > * > * {
        padding: 0.75rem 0.5rem;
    }
    .badge {
        font-size: 0.75rem;
    }
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.375rem rgba(0,0,0,0.05);
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
    }
    </style>
</x-app-layout>
