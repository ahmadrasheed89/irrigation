<x-app-layout>
    <style>
        .kanban-column {
            min-height: 600px;
            transition: all 0.3s ease;
        }

        .task-card {
            cursor: grab;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 12px;
            border-left: 4px solid;
        }

        .task-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .task-card:active {
            cursor: grabbing;
            transform: rotate(2deg);
        }

        .task-card[data-status="todo"] {
            border-left-color: #ef4444;
            background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
        }

        .task-card[data-status="pending"] {
            border-left-color: #f59e0b;
            background: linear-gradient(135deg, #fffbeb 0%, #fed7aa 100%);
        }

        .task-card[data-status="progress"] {
            border-left-color: #3b82f6;
            background: linear-gradient(135deg, #eff6ff 0%, #bfdbfe 100%);
        }

        .task-card[data-status="done"] {
            border-left-color: #10b981;
            background: linear-gradient(135deg, #ecfdf5 0%, #a7f3d0 100%);
        }

        .column-header {
            border-radius: 12px 12px 0 0;
            padding: 1rem 1.25rem;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .column-count {
            background: rgba(255,255,255,0.3);
            border-radius: 20px;
            padding: 2px 10px;
            font-size: 0.8rem;
            margin-left: 8px;
        }

        .drag-ghost {
            opacity: 0.8;
            transform: rotate(5deg);
        }

        .progress-bar {
            border-radius: 10px;
            transition: width 0.5s ease;
        }

        .user-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .task-meta {
            font-size: 0.75rem;
            opacity: 0.8;
        }

        .priority-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 4px;
        }

        .priority-high { background: #ef4444; }
        .priority-medium { background: #f59e0b; }
        .priority-low { background: #10b981; }

        .kanban-column.drag-over {
            background: rgba(59, 130, 246, 0.05);
            border: 2px dashed #3b82f6;
            border-radius: 12px;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
    </style>

    <div class="content">
        <!-- Page Header -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">📋 Task Board</h5>
                    <p class="mb-0 mt-1 opacity-75">Drag and drop tasks to update their status - Visual project management</p>
                </div>
                <div class="btn-group">
                    <a href="{{ url()->previous() }}" class="btn btn-light d-flex align-items-center">
                        <i class="ph-arrow-left me-2"></i>Back to Dashboard
                    </a>
                    <button class="btn btn-light d-flex align-items-center">
                        <i class="ph-plus-circle me-2"></i>New Task
                    </button>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row mb-4">
            @foreach($columns as $key => $label)
            @php
                $count = $tasks->where('status', $key)->count();
                $colors = [
                    'todo' => ['bg' => 'bg-danger bg-opacity-10', 'text' => 'text-danger', 'icon' => 'ph-clock'],
                    'pending' => ['bg' => 'bg-warning bg-opacity-10', 'text' => 'text-warning', 'icon' => 'ph-list-checks'],
                    'progress' => ['bg' => 'bg-primary bg-opacity-10', 'text' => 'text-primary', 'icon' => 'ph-trend-up'],
                    'done' => ['bg' => 'bg-success bg-opacity-10', 'text' => 'text-success', 'icon' => 'ph-check-circle']
                ];
                $color = $colors[$key];
            @endphp
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 {{ $color['bg'] }}">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="{{ $color['icon'] }} fs-2 {{ $color['text'] }}"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0 {{ $color['text'] }}">{{ $count }}</h4>
                                <p class="mb-0 text-muted">{{ $label }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Kanban Board -->
        <div class="row">
            @foreach($columns as $key => $label)
            @php
                $columnTasks = $tasks->where('status', $key);
                $count = $columnTasks->count();

                $headerColors = [
                    'todo' => 'bg-danger text-white',
                    'pending' => 'bg-warning text-dark',
                    'progress' => 'bg-primary text-white',
                    'done' => 'bg-success text-white'
                ];
                $headerClass = $headerColors[$key];
            @endphp

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header {{ $headerClass }} column-header d-flex align-items-center">
                        <div class="flex-grow-1">
                            <i class="ph ph-caret-right me-2"></i>
                            {{ $label }}
                        </div>
                        <span class="column-count">{{ $count }}</span>
                    </div>

                    <div class="card-body p-3 kanban-column" id="column-{{ $key }}" data-status="{{ $key }}">
                        @if($columnTasks->count() > 0)
                            @foreach($columnTasks as $task)
                            @php
                                $statusColors = [
                                    'todo' => '#fef2f2',
                                    'pending' => '#fffbeb',
                                    'progress' => '#eff6ff',
                                    'done' => '#ecfdf5'
                                ];

                                $progressMap = [
                                    'todo' => 5,
                                    'pending' => 25,
                                    'progress' => 60,
                                    'done' => 100
                                ];

                                $priorityClasses = [
                                    1 => ['class' => 'priority-high', 'label' => 'High'],
                                    2 => ['class' => 'priority-medium', 'label' => 'Medium'],
                                    3 => ['class' => 'priority-low', 'label' => 'Low']
                                ];
                                $priority = $priorityClasses[$task->priority] ?? $priorityClasses[2];
                            @endphp

                            <div class="task-card card p-3"
                                 data-id="{{ $task->id }}"
                                 data-status="{{ $task->status }}">

                                <!-- Task Header -->
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.9rem;">
                                        {{ Str::limit($task->title, 40) }}
                                    </h6>
                                    <span class="badge bg-light text-dark border">
                                        <span class="{{ $priority['class'] }} priority-dot"></span>
                                        {{ $priority['label'] }}
                                    </span>
                                </div>

                                <!-- Task Description -->
                                @if($task->description)
                                <p class="task-meta mb-2 text-muted" style="font-size: 0.75rem;">
                                    {{ Str::limit($task->description, 60) }}
                                </p>
                                @endif

                                <!-- Progress Bar -->
                                <div class="progress mb-3" style="height: 6px; background: rgba(0,0,0,0.1);">
                                    <div class="progress-bar
                                        @if($task->status=='todo') bg-danger
                                        @elseif($task->status=='pending') bg-warning
                                        @elseif($task->status=='progress') bg-info
                                        @else bg-success
                                        @endif"
                                        style="width: {{ $progressMap[$task->status] }}%; border-radius: 10px;">
                                    </div>
                                </div>

                                <!-- Assignee & Actions -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        @if($task->assignee)
                                        <div class="user-avatar me-2" title="{{ $task->assignee->username }}">
                                            {{ strtoupper(substr($task->assignee->username, 0, 2)) }}
                                        </div>
                                        <small class="text-muted" style="font-size: 0.7rem;">
                                            {{ $task->assignee->username }}
                                        </small>
                                        @else
                                        <small class="text-muted" style="font-size: 0.7rem;">
                                            Unassigned
                                        </small>
                                        @endif
                                    </div>

                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light border-0 py-1 px-2"
                                                data-bs-toggle="dropdown">
                                            <i class="ph-dots-three-outline-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">
                                                <i class="ph-eye me-2"></i>View Details
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="ph-pencil-simple me-2"></i>Edit
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#">
                                                <i class="ph-trash me-2"></i>Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Assign User Dropdown -->
                                <select class="form-select form-select-sm mt-3 assignUserSelect"
                                        data-task="{{ $task->id }}"
                                        style="font-size: 0.75rem; border-radius: 8px;">
                                    <option value="">Assign to...</option>
                                    @foreach($users as $u)
                                        <option value="{{ $u->id }}" @selected($u->id == $task->assigned_to)>
                                            {{ $u->username }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- Due Date -->
                                @if($task->due_date)
                                <div class="mt-2 text-end">
                                    <small class="text-muted" style="font-size: 0.65rem;">
                                        <i class="ph-calendar me-1"></i>
                                        {{ \Carbon\Carbon::parse($task->due_date)->format('M d') }}
                                    </small>
                                </div>
                                @endif
                            </div>
                            @endforeach
                        @else
                            <div class="empty-state">
                                <i class="ph ph-open-tray"></i>
                                <p class="mb-0">No tasks in this column</p>
                                <small class="text-muted">Drag tasks here or create new ones</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src='{{ asset('/js/kanban.js') }}'></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Enhanced drag and drop functionality
        const taskCards = document.querySelectorAll('.task-card');
        const columns = document.querySelectorAll('.kanban-column');

        // Add drag events
        taskCards.forEach(card => {
            card.setAttribute('draggable', 'true');

            card.addEventListener('dragstart', (e) => {
                e.dataTransfer.setData('text/plain', card.dataset.id);
                card.classList.add('drag-ghost');
                setTimeout(() => card.style.display = 'none', 0);
            });

            card.addEventListener('dragend', (e) => {
                card.classList.remove('drag-ghost');
                card.style.display = 'block';
            });
        });

        // Column drag events
        columns.forEach(column => {
            column.addEventListener('dragover', (e) => {
                e.preventDefault();
                column.classList.add('drag-over');
            });

            column.addEventListener('dragleave', (e) => {
                if (!column.contains(e.relatedTarget)) {
                    column.classList.remove('drag-over');
                }
            });

            column.addEventListener('drop', (e) => {
                e.preventDefault();
                column.classList.remove('drag-over');

                const taskId = e.dataTransfer.getData('text/plain');
                const newStatus = column.dataset.status;

                // Update task status via AJAX
                updateTaskStatus(taskId, newStatus);
            });
        });

        function updateTaskStatus(taskId, newStatus) {
            fetch(`/tasks/${taskId}/status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Optional: Show success message
                    console.log('Task status updated successfully');
                }
            })
            .catch(error => console.error('Error:', error));
        }

        // User assignment
        document.querySelectorAll('.assignUserSelect').forEach(select => {
            select.addEventListener('change', function() {
                const taskId = this.dataset.task;
                const userId = this.value;

                fetch(`/tasks/${taskId}/assign`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ user_id: userId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success feedback
                        const badge = document.createElement('span');
                        badge.className = 'badge bg-success ms-2';
                        badge.textContent = 'Updated';
                        this.parentNode.appendChild(badge);

                        setTimeout(() => badge.remove(), 2000);
                    }
                });
            });
        });
    });
    </script>

    <style>
    .card-statistic {
        border: none;
        border-radius: 12px;
        transition: transform 0.2s;
        overflow: hidden;
    }
    .card-statistic:hover {
        transform: translateY(-3px);
    }
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
    }
    .bg-gradient-danger { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%) !important; }
    .bg-gradient-warning { background: linear-gradient(135deg, #ffd89b 0%, #19547b 100%) !important; }
    .bg-gradient-primary { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%) !important; }
    .bg-gradient-success { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%) !important; }
    </style>

</x-app-layout>
