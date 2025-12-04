<x-app-layout>
    <div class="content">
        <!-- Header Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">Tender Management</h5>
                    <p class="mb-0 mt-1 opacity-75">Browse and manage all tender schemes</p>
                </div>
                @can('create', App\Models\Tender::class)
                    <a href="{{ route('tenders.create') }}" class="btn btn-light d-flex align-items-center">
                        <i class="ph-plus-circle me-2"></i> Add New Tender
                    </a>
                @endcan
            </div>
        </div>

        <!-- Filters Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0 fw-semibold">Search & Filter</h6>
            </div>
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-medium">Search</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="ph-magnifying-glass text-muted"></i>
                            </span>
                            <input type="text" name="q" value="{{ $filters['q'] ?? '' }}"
                                   class="form-control border-start-0" placeholder="Search tenders...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium">Scheme</label>
                        <select name="scheme_id" class="form-select">
                            <option value="">All schemes</option>
                            @foreach($schemes as $id=>$name)
                            <option value="{{ $id }}" {{ (isset($filters['scheme_id']) && $filters['scheme_id']==$id)?'selected':''}}>
                                {{ $name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium">Category</label>
                        <select name="category_id" class="form-select">
                            <option value="">All categories</option>
                            @foreach($categories as $id=>$name)
                            <option value="{{ $id }}" {{ (isset($filters['category_id']) && $filters['category_id']==$id)?'selected':''}}>
                                {{ $name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                            <i class="ph-magnifying-glass me-2"></i> Search
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Results Summary -->
        @if(isset($filters['q']) || isset($filters['scheme_id']) || isset($filters['category_id']))
        <div class="alert alert-info d-flex align-items-center mb-4">
            <i class="ph-info me-2 fs-5"></i>
            <div>
                <span class="fw-medium">Showing filtered results</span>
                @if(isset($filters['q']))
                    <span class="badge bg-primary ms-2">Search: "{{ $filters['q'] }}"</span>
                @endif
                @if(isset($filters['scheme_id']))
                    <span class="badge bg-secondary ms-2">Scheme: {{ $schemes[$filters['scheme_id']] ?? '' }}</span>
                @endif
                @if(isset($filters['category_id']))
                    <span class="badge bg-secondary ms-2">Category: {{ $categories[$filters['category_id']] ?? '' }}</span>
                @endif
            </div>
        </div>
        @endif

        <!-- Schemes Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-semibold">Tender Schemes ({{ $schemesList->total() }})</h6>
                <span class="text-muted small">Page {{ $schemesList->currentPage() }} of {{ $schemesList->lastPage() }}</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Scheme Name</th>
                                <th>Cost</th>
                                <th>Created Date</th>
                                <th>Upload Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($schemesList as $scheme)
                            <tr class="border-start border-primary border-3">
                                <td class="ps-4">
                                    <div class="fw-semibold">{{ $scheme->name ?? '-' }}</div>
                                    <small class="text-muted">ID: {{ $scheme->id }}</small>
                                </td>
                                <td>
                                    @if($scheme->sub_work_t_s_cost)
                                        <span class="fw-medium text-success">₹{{ number_format($scheme->sub_work_t_s_cost) }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="text-muted">{{ $scheme->created_at->format('M d, Y') }}</div>
                                    <small class="text-muted">{{ $scheme->created_at->diffForHumans() }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <i class="ph-folders me-1"></i> Manage Files
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('tenders.show', $scheme) }}"
                                       class="btn btn-sm btn-outline-primary d-inline-flex align-items-center"
                                       title="Upload and manage files">
                                        <i class="ph-upload me-1"></i> Upload Files
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="ph-folders fs-1 text-muted mb-3"></i>
                                        <p class="text-muted mb-2">No tender schemes found</p>
                                        @can('create', App\Models\Tender::class)
                                            <a href="{{ route('tenders.create') }}" class="btn btn-primary btn-sm">
                                                <i class="ph-plus-circle me-1"></i> Create First Tender
                                            </a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if($schemesList->hasPages())
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Showing {{ $schemesList->firstItem() ?? 0 }} to {{ $schemesList->lastItem() ?? 0 }}
                        of {{ $schemesList->total() }} results
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $schemesList->links() }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <style>
    .table > :not(caption) > * > * {
        padding: 0.75rem 0.5rem;
        vertical-align: middle;
    }
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.375rem rgba(0,0,0,0.05);
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
        transform: translateY(-1px);
        transition: all 0.2s ease;
    }
    .badge {
        font-size: 0.75rem;
    }
    .input-group-text {
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.1);
        border-color: #0d6efd;
    }
    </style>
</x-app-layout>
