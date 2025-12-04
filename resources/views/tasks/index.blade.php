<x-app-layout>
    <div class="content">
        <!-- Header Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">📋 Tasks Management</h5>
                    <p class="mb-0 mt-1 opacity-75">Comprehensive overview of all tasks - Status, Assignees & Priority Tracking</p>
                </div>
                <div class="btn-group">
                    <button class="btn btn-light d-flex align-items-center">
                        <i class="ph-download-simple me-2"></i>Export
                    </button>
                    <button id='createTask' class="btn btn-light d-flex align-items-center">
                        <i class="ph-plus-circle me-2"></i>Add New Task
                    </button>
                </div>
            </div>
        </div>

        <!-- Tasks Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-0 fw-semibold">📋 All Tasks List</h6>
                    <span class="badge bg-primary ms-2" id="tasksCount">0 Records</span>
                </div>
                <div class="d-flex align-items-center">
                    <div class="input-group input-group-sm me-2" style="max-width: 250px;">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="ph-magnifying-glass text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" placeholder="Search tasks...">
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id='tasksTable' class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Task ID/Name</th>
                                {{-- <th>Title</th> --}}
                                <th>Status</th>
                                <th>Assignee</th>
                                <th>Priority</th>
                                <th class="text-center">Due Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination will be handled by DataTables -->
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small" id="tableInfo">
                        Showing 0 to 0 of 0 entries
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.ajax-modal')

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
    .symbol {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .symbol-40px {
        width: 40px;
        height: 40px;
    }
    .symbol-label {
        width: 100%;
        height: 100%;
        border-radius: 0.475rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .btn-icon {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }
    </style>

    <script src='{{ asset('/js/task-crud.js') }}'></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Simple search functionality
        const searchInput = document.querySelector('input[type="text"]');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }

        // You can add DataTables initialization here if needed
        // Example:
        // $('#tasksTable').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     ajax: "{{ route('tasks.data') }}",
        //     columns: [
        //         { data: 'id' },
        //         { data: 'title' },
        //         { data: 'status' },
        //         { data: 'assignee' },
        //         { data: 'priority' },
        //         { data: 'due_date' },
        //         { data: 'actions' }
        //     ]
        // });
    });
    </script>
</x-app-layout>
