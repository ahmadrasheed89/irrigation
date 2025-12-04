<form id='entityForm' method='POST' action='{{ $action }}'>
    @csrf
    @if($method=='PUT')
        <input type='hidden' name='_method' value='PUT'>
    @endif

    <div class="row">
        <!-- Title Field -->
        <div class="col-12 mb-3">
            <label class="form-label fw-semibold">📝 Task Title</label>
            <input name='title' class='form-control form-control-lg'
                   value='{{ $task->title ?? '' }}'
                   placeholder="Enter task title...">
            <div class="form-text">Give your task a clear and descriptive title</div>
        </div>

        <!-- Description Field -->
        <div class="col-12 mb-3">
            <label class="form-label fw-semibold">📋 Description</label>
            <textarea name='description' class='form-control'
                      rows="4"
                      placeholder="Describe the task details, requirements, and objectives...">{{ $task->description ?? '' }}</textarea>
            <div class="form-text">Provide detailed information about the task</div>
        </div>

        <!-- Assignee and Priority Row -->
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">👤 Assignee</label>
            <select name='assigned_to' class='form-select'>
                <option value=''>-- Select Assignee --</option>
                @foreach(App\Models\User::all() as $u)
                    <option value='{{ $u->id }}' {{ ($task->assigned_to ?? '') == $u->id ? 'selected' : '' }}>
                        {{ $u->username }}
                    </option>
                @endforeach
            </select>
            <div class="form-text">Assign this task to a team member</div>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">🚦 Priority</label>
            <select name='priority' class='form-select'>
                <option value='1' {{ ($task->priority ?? 2) == 1 ? 'selected' : '' }} class="text-danger">
                    🔴 High Priority
                </option>
                <option value='2' {{ ($task->priority ?? 2) == 2 ? 'selected' : '' }} class="text-warning">
                    🟡 Medium Priority
                </option>
                <option value='3' {{ ($task->priority ?? 2) == 3 ? 'selected' : '' }} class="text-success">
                    🟢 Low Priority
                </option>
            </select>
            <div class="form-text">Set the task priority level</div>
        </div>

        <!-- Due Date Field -->
        <div class="col-12 mb-4">
            <label class="form-label fw-semibold">📅 Due Date</label>
            <input type='date' name='due_date' id="due_date"
                   class='form-control'
                   value='{{ $task->due_date ?? '' }}'
                   min="{{ date('Y-m-d') }}">
            <div class="form-text">Set the deadline for this task</div>
        </div>

        {{-- Department Field (Commented but styled) --}}
        {{-- <div class="col-12 mb-3">
            <label class="form-label fw-semibold">🏢 Department</label>
            <select name='department_id' class='form-select'>
                <option value=''>-- Select Department --</option>
                @foreach(App\Models\Department::all() as $d)
                    <option value='{{ $d->id }}' {{ ($task->department_id ?? '') == $d->id ? 'selected' : '' }}>
                        {{ $d->name }}
                    </option>
                @endforeach
            </select>
            <div class="form-text">Assign to a specific department</div>
        </div> --}}
    </div>

    <!-- Form Actions -->
    <div class="d-flex justify-content-between align-items-center border-top pt-4">
        <div>
            @if($method == 'PUT')
                <small class="text-muted">Last updated: {{ $task->updated_at->format('M d, Y \a\t h:i A') ?? 'Never' }}</small>
            @else
                <small class="text-muted">Create a new task</small>
            @endif
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                <i class="ph-x me-2"></i>Cancel
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="ph-floppy-disk me-2"></i>
                {{ $method == 'PUT' ? 'Update Task' : 'Create Task' }}
            </button>
        </div>
    </div>
</form>

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

.form-control-lg {
    font-size: 1.1rem;
    font-weight: 500;
}

.form-text {
    font-size: 0.8rem;
    color: #6b7280;
    margin-top: 0.25rem;
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date to today for due date
    const dueDateInput = document.getElementById('due_date');
    if (dueDateInput && !dueDateInput.value) {
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        dueDateInput.min = tomorrow.toISOString().split('T')[0];
    }

    // Add character counter for description
    const descriptionTextarea = document.querySelector('textarea[name="description"]');
    if (descriptionTextarea) {
        const charCounter = document.createElement('div');
        charCounter.className = 'form-text text-end';
        charCounter.textContent = '0 characters';
        descriptionTextarea.parentNode.appendChild(charCounter);

        descriptionTextarea.addEventListener('input', function() {
            const length = this.value.length;
            charCounter.textContent = `${length} characters`;
            charCounter.className = `form-text text-end ${length > 500 ? 'text-warning' : 'text-muted'}`;
        });

        // Trigger initial count
        descriptionTextarea.dispatchEvent(new Event('input'));
    }

    // Form validation enhancement
    const form = document.getElementById('entityForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const titleInput = document.querySelector('input[name="title"]');
            if (titleInput && !titleInput.value.trim()) {
                e.preventDefault();
                titleInput.focus();
                titleInput.style.borderColor = '#ef4444';
                return false;
            }
        });
    }
});
</script>
