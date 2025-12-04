// AJAX CRUD DataTables for tasks with modern design patterns
$(function () {
    const csrfToken = $("meta[name=csrf-token]").attr("content");

    // Enhanced DataTables configuration
    const tasksTable = $("#tasksTable").DataTable({
        processing: true,
        serverSide: false, // Keep client-side to avoid pagination issues
        ajax: {
            url: "/tasks/data",
            dataSrc: "data",
        },
        columns: [
            {
                data: "id",
                render: function (data, type, row) {
                    return `
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-40px me-3">
                                <div class="symbol-label bg-light-primary rounded">
                                    <i class="ph-clipboard-text text-primary"></i>
                                </div>
                            </div>
                            <div>
                                <div class="fw-semibold text-dark">${data}</div>
                                <div class="text-muted small">${
                                    row.title || "No title"
                                }</div>
                            </div>
                        </div>
                    `;
                },
            },
            {
                data: "status",
                render: function (data, type, row) {
                    const statusConfig = {
                        todo: { class: "danger", text: "To Do", progress: 5 },
                        pending: {
                            class: "warning",
                            text: "Pending",
                            progress: 25,
                        },
                        progress: {
                            class: "primary",
                            text: "In Progress",
                            progress: 60,
                        },
                        done: {
                            class: "success",
                            text: "Completed",
                            progress: 100,
                        },
                    };
                    const status = statusConfig[data] || statusConfig.todo;

                    return `
                        <div class="small text-muted">Task Progress</div>
                        <div class="progress" style="height: 6px; width: 120px;">
                            <div class="progress-bar bg-${status.class}" style="width: ${status.progress}%"></div>
                        </div>
                        <small class="text-${status.class} fw-semibold">${status.progress}%</small>
                    `;
                },
            },
            {
                data: "assignee.username",
                defaultContent: "",
                render: function (data, type, row) {
                    if (!data) {
                        return '<span class="text-muted small">Unassigned</span>';
                    }
                    const initials = data
                        .split(" ")
                        .map((n) => n[0])
                        .join("")
                        .toUpperCase()
                        .substring(0, 2);
                    return `
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-30px me-2">
                                <div class="symbol-label bg-light-success rounded">
                                    <span class="text-success fw-bold small">${initials}</span>
                                </div>
                            </div>
                            <div>
                                <div class="fw-semibold">${data}</div>
                                <div class="text-muted small">${
                                    row.assignee?.role || "User"
                                }</div>
                            </div>
                        </div>
                    `;
                },
            },
            {
                data: "priority",
                className: "text-center",
                render: function (data) {
                    const priorityConfig = {
                        1: { class: "danger", label: "High" },
                        2: { class: "warning", label: "Medium" },
                        3: { class: "success", label: "Low" },
                    };
                    const priority =
                        priorityConfig[data] || priorityConfig.medium;

                    return `
                        <span class="badge bg-${priority.class} bg-opacity-20 text-${priority.class} border border-${priority.class} border-opacity-25">
                            <span class="priority-dot priority-${priority.class}"></span>
                            ${priority.label}
                        </span>
                    `;
                },
            },
            {
                data: "due_date",
                className: "text-center",
                defaultContent: "----",
                render: function (data) {
                    if (!data)
                        return '<span class="text-muted">No due date</span>';

                    const dueDate = new Date(data);
                    const today = new Date();
                    const isOverdue = dueDate < today;

                    return `
                        <div class="${
                            isOverdue ? "text-danger" : "text-muted"
                        }">
                            ${dueDate.toLocaleDateString("en-US", {
                                month: "short",
                                day: "numeric",
                                year: "numeric",
                            })}
                        </div>
                        <small class="${
                            isOverdue ? "text-danger" : "text-muted"
                        }">
                            ${
                                isOverdue
                                    ? "Overdue"
                                    : dueDate.toLocaleTimeString("en-US", {
                                          hour: "numeric",
                                          minute: "2-digit",
                                      })
                            }
                        </small>
                    `;
                },
            },
            {
                data: null,
                className: "text-center",
                render: function (data, type, row) {
                    return `
                        <div class="d-flex justify-content-center gap-1">
                            <button data-id="${data.id}" class="btn btn-sm btn-light btn-icon rounded view"
                                    data-bs-toggle="tooltip" title="View Details">
                                <i class="ph-eye"></i>
                            </button>
                            <button data-id="${data.id}" class="btn btn-sm btn-light btn-icon rounded edit"
                                    data-bs-toggle="tooltip" title="Edit Task">
                                <i class="ph-pen"></i>
                            </button>
                            <button data-id="${data.id}" class="btn btn-sm btn-light btn-icon rounded text-danger delete"
                                    data-bs-toggle="tooltip" title="Delete Task">
                                <i class="ph-trash"></i>
                            </button>
                        </div>
                    `;
                },
                orderable: false,
            },
        ],
        // Keep existing pagination and search behavior
        language: {
            emptyTable: "No tasks found",
            zeroRecords: "No matching tasks found",
        },
        drawCallback: function (settings) {
            // Initialize tooltips after table redraw
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Update summary cards with current data
            updateSummaryCards(settings.json);
        },
    });

    // Create Task Modal Handler - Same as original
    $("#createTask").on("click", function () {
        $.get("/tasks/create", function (html) {
            $("#ajaxModalTitle").text("Create Task");
            $("#ajaxModalBody").html(html);
            new bootstrap.Modal(document.getElementById("ajaxModal")).show();
            bindForm(tasksTable);
        });
    });

    // Table Action Handlers - Same functionality as original
    $("#tasksTable tbody").on("click", "button", function () {
        const id = $(this).data("id");

        if ($(this).hasClass("view")) {
            $.get("/tasks/" + id, function (html) {
                $("#ajaxModalTitle").text("View Task");
                $("#ajaxModalBody").html(html);
                new bootstrap.Modal(
                    document.getElementById("ajaxModal")
                ).show();
            });
        } else if ($(this).hasClass("edit")) {
            $.get("/tasks/" + id + "/edit", function (html) {
                $("#ajaxModalTitle").text("Edit Task");
                $("#ajaxModalBody").html(html);
                new bootstrap.Modal(
                    document.getElementById("ajaxModal")
                ).show();
                bindForm(tasksTable);
            });
        } else if ($(this).hasClass("delete")) {
            if (confirm("Are you sure you want to delete this task?")) {
                $.ajax({
                    url: "/tasks/" + id,
                    method: "POST",
                    data: {
                        _method: "DELETE",
                        _token: csrfToken,
                    },
                }).done(function () {
                    tasksTable.ajax.reload();
                });
            }
        }
    });

    // Form Binding - Same functionality as original
    function bindForm(table) {
        $("#entityForm").on("submit", function (e) {
            e.preventDefault();
            const url = $(this).attr("action");
            const data = $(this).serialize();

            $.post(url, data + "&_token=" + csrfToken)
                .done(function (res) {
                    if (res.success) {
                        bootstrap.Modal.getInstance(
                            document.getElementById("ajaxModal")
                        ).hide();
                        table.ajax.reload();
                    }
                })
                .fail(function (xhr) {
                    alert("Error saving task");
                });
        });
    }

    // Update Summary Cards with current table data
    function updateSummaryCards(jsonData) {
        if (!jsonData || !jsonData.data) return;

        const tasks = jsonData.data;
        const totalTasks = tasks.length;
        const completedTasks = tasks.filter(
            (task) => task.status === "done"
        ).length;
        const inProgressTasks = tasks.filter(
            (task) => task.status === "progress"
        ).length;
        const overdueTasks = tasks.filter((task) => {
            if (!task.due_date) return false;
            return (
                new Date(task.due_date) < new Date() && task.status !== "done"
            );
        }).length;

        // Update DOM elements
        $("#totalTasks").text(totalTasks);
        $("#completedTasks").text(completedTasks);
        $("#inProgressTasks").text(inProgressTasks);
        $("#overdueTasks").text(overdueTasks);
        $("#tasksCount").text(totalTasks + " Records");

        // Update progress bars
        const progressPercentage =
            totalTasks > 0 ? (inProgressTasks / totalTasks) * 100 : 0;
        const overduePercentage =
            totalTasks > 0 ? (overdueTasks / totalTasks) * 100 : 0;

        $(".progress-bar.bg-warning").css("width", progressPercentage + "%");
        $(".progress-bar.bg-info").css("width", overduePercentage + "%");
    }

    // Initialize tooltips on page load
    $(document).ready(function () {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
});
