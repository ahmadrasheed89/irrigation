<x-app-layout>
    <div class="content">
        <!-- Header Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">🔍 Task Explorer</h5>
                    <p class="mb-0 mt-1 opacity-75">Browse and filter tasks across different statuses</p>
                </div>
                <button class="btn btn-light d-flex align-items-center">
                    <i class="ph-export me-2"></i>Export
                </button>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-primary bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-list-checks fs-2 text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0" id="totalTasks">—</h4>
                                <p class="mb-0 text-muted">Total Tasks</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-warning bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-gear fs-2 text-warning"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0" id="inProgressTasks">—</h4>
                                <p class="mb-0 text-muted">In Progress</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-success bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-check-circle fs-2 text-success"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0" id="completedTasks">—</h4>
                                <p class="mb-0 text-muted">Completed</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-info bg-opacity-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ph-clock fs-2 text-info"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0" id="pendingTasks">—</h4>
                                <p class="mb-0 text-muted">Pending Review</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0 fw-semibold">🔍 Search & Filter Tasks</h6>
            </div>
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <div class="col-xl-3 col-md-6">
                        <label class="form-label fw-medium">Search Task</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="ph-magnifying-glass text-muted"></i>
                            </span>
                            <input
                                type="text"
                                id="taskSearch"
                                class="form-control border-start-0"
                                placeholder="Search by title, description..."
                            />
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <label class="form-label fw-medium">Assignees</label>
                        <select id="filterUser" class="form-select">
                            <option value="">All Users</option>
                            @foreach($users as $u)
                            <option value="{{ $u->id }}">{{ $u->username }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- <div class="col-xl-3 col-md-6">
                        <label class="form-label fw-medium">Departments</label>
                        <select id="filterDept" class="form-select">
                            <option value="">All Departments</option>
                            @foreach($departments as $d)
                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="col-xl-3 col-md-6">
                        <label class="form-label fw-medium">&nbsp;</label>
                        <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center" id="btnSearch">
                            <i class="ph-magnifying-glass me-2"></i>Search Tasks
                        </button>
                    </div>
                </div>

                <!-- Quick Filter Chips -->
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="d-flex flex-wrap gap-2" id="quickFilters">
                            <span class="badge bg-light text-dark border cursor-pointer" data-user="">All Users</span>
                            {{-- <span class="badge bg-light text-dark border cursor-pointer" data-dept="">All Departments</span> --}}
                            <span class="badge bg-primary text-white cursor-pointer" data-search="">Clear Search</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kanban Board -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h6 class="mb-0 fw-semibold">📋 Task Board</h6>
            </div>
            <div class="card-body p-0">
                <div class="column-container">
                    <!-- TO DO Column -->
                    <div class="status-column">
                        <div class="status-title bg-danger text-white">
                            <div class="d-flex align-items-center">
                                <i class="ph-timer me-2"></i>TO DO
                            </div>
                            <span class="status-count" id="todoCount">0</span>
                        </div>
                        <div class="items" id="todoCol"></div>
                    </div>

                    <!-- PENDING Column -->
                    <div class="status-column">
                        <div class="status-title bg-warning text-dark">
                            <div class="d-flex align-items-center">
                                <i class="ph-clock me-2"></i>PENDING
                            </div>
                            <span class="status-count" id="pendingCount">0</span>
                        </div>
                        <div class="items" id="pendingCol"></div>
                    </div>

                    <!-- IN PROGRESS Column -->
                    <div class="status-column">
                        <div class="status-title bg-primary text-white">
                            <div class="d-flex align-items-center">
                                <i class="ph-gear me-2"></i>IN PROGRESS
                            </div>
                            <span class="status-count" id="progressCount">0</span>
                        </div>
                        <div class="items" id="progressCol"></div>
                    </div>

                    <!-- DONE Column -->
                    <div class="status-column">
                        <div class="status-title bg-success text-white">
                            <div class="d-flex align-items-center">
                                <i class="ph-check-circle me-2"></i>DONE
                            </div>
                            <span class="status-count" id="doneCount">0</span>
                        </div>
                        <div class="items" id="doneCol"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function render(col, list, status) {
        let container = $(`${col} .items`).length ? $(`${col} .items`) : $(col);
        container.empty();

        // Update column count
        $(`#${status}Count`).text(list.length);

        if (list.length === 0) {
            container.append(`
                <div class="empty-state">
                    <i class="ph-open-tray"></i>
                    <p class="mb-0">No tasks found</p>
                    <small class="text-muted">Try adjusting your filters</small>
                </div>
            `);
            return;
        }

        list.forEach(t => {
            const userInitials = t.assignee?.username ?
                t.assignee.username.substring(0, 2).toUpperCase() : 'NA';

            container.append(`
                <div class="item-card ${status}">
                    <div class="task-title">${t.title}</div>
                    <div class="task-meta">
                        <span class="user-avatar" title="${t.assignee?.username || 'Unassigned'}">
                            ${userInitials}
                        </span>
                        <span class="status-badge bg-light text-dark border">
                            ${t.status}
                        </span>
                        <small>
                            <i class="ph-user me-1"></i>${t.assignee?.username || 'Unassigned'}
                        </small>
                    </div>
                    ${t.due_date ? `
                    <div class="task-meta mt-2">
                        <small class="text-warning">
                            <i class="ph-calendar me-1"></i>Due: ${new Date(t.due_date).toLocaleDateString()}
                        </small>
                    </div>
                    ` : ''}
                </div>
            `);
        });
    }

    function updateStats(data) {
        const total = (data.todo?.length || 0) + (data.pending?.length || 0) +
                     (data.progress?.length || 0) + (data.done?.length || 0);

        $('#totalTasks').text(total);
        $('#inProgressTasks').text(data.progress?.length || 0);
        $('#completedTasks').text(data.done?.length || 0);
        $('#pendingTasks').text(data.pending?.length || 0);
    }

    function loadTasks() {
        $.get("{{ route('task.explorer.search') }}", {
            user_id: $("#filterUser").val(),
            department_id: $("#filterDept").val(),
            search: $("#taskSearch").val()
        }, function(res) {
            render("#todoCol", res.todo || [], 'todo');
            render("#pendingCol", res.pending || [], 'pending');
            render("#progressCol", res.progress || [], 'progress');
            render("#doneCol", res.done || [], 'done');

            updateStats(res);

        }).fail(function(xhr) {
            console.log("ERROR", xhr.responseText);
            // Show error state
            $('.items').html(`
                <div class="empty-state">
                    <i class="ph-warning-circle"></i>
                    <p class="mb-0">Failed to load tasks</p>
                    <small class="text-muted">Please try again</small>
                </div>
            `);
        });
    }

    // Event handlers
    $("#btnSearch").click(loadTasks);
    $("#filterUser").change(loadTasks);
    $("#filterDept").change(loadTasks);
    $("#taskSearch").keyup(loadTasks);

    // Quick filter chips
    $('#quickFilters .badge').click(function() {
        const user = $(this).data('user');
        const dept = $(this).data('dept');
        const search = $(this).data('search');

        if (user !== undefined) $('#filterUser').val(user);
        if (dept !== undefined) $('#filterDept').val(dept);
        if (search !== undefined) $('#taskSearch').val(search);

        loadTasks();
    });

    // Initial load
    $(document).ready(function() {
        loadTasks();
    });
    </script>

    <style>
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.375rem rgba(0,0,0,0.05);
    }
    .table > :not(caption) > * > * {
        padding: 0.75rem 0.5rem;
        vertical-align: middle;
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

    .column-container {
        display: flex;
        gap: 20px;
        overflow-x: auto;
        padding: 10px;
    }

    .status-column {
        flex: 1;
        min-width: 280px;
        background: #fff;
        padding: 0;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        border: 1px solid #e9ecef;
        min-height: 600px;
        transition: all 0.3s ease;
    }

    .status-column:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }

    .status-title {
        font-weight: 600;
        margin-bottom: 0;
        padding: 20px;
        border-radius: 12px 12px 0 0;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .status-count {
        background: rgba(255,255,255,0.3);
        border-radius: 20px;
        padding: 4px 12px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .items {
        padding: 16px;
        min-height: 400px;
    }

    .item-card {
        background: white;
        padding: 16px;
        margin-bottom: 12px;
        border-radius: 8px;
        border-left: 4px solid;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 1px solid #f1f3f4;
    }

    .item-card:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        transform: translateY(-1px);
    }

    .item-card.todo { border-left-color: #ef4444; }
    .item-card.pending { border-left-color: #f59e0b; }
    .item-card.progress { border-left-color: #3b82f6; }
    .item-card.done { border-left-color: #10b981; }

    .task-title {
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 8px;
        font-size: 0.95rem;
        line-height: 1.4;
    }

    .task-meta {
        font-size: 0.8rem;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .user-avatar {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.6rem;
        font-weight: 600;
    }

    .status-badge {
        font-size: 0.7rem;
        padding: 4px 8px;
        border-radius: 6px;
        font-weight: 500;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #9ca3af;
    }

    .empty-state i {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .column-container {
            flex-direction: column;
        }
        .status-column {
            min-width: 100%;
        }
    }
    </style>
</x-app-layout>
