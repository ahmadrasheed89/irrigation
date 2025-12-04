// Task stage order
const stageOrder = ["todo", "pending", "progress", "done"];

// Initialize Sortable (smooth drag-drop)
document.querySelectorAll(".kanban-column").forEach((column) => {
    new Sortable(column, {
        group: "kanban-group",
        animation: 150,
        ghostClass: "drag-ghost",

        async onEnd(evt) {
            let card = evt.item;
            let task_id = card.dataset.id;
            let newStatus = evt.to.dataset.status;
            let oldStatus = evt.from.dataset.status;

            // 1️⃣ Detect move direction
            let oldIndex = stageOrder.indexOf(oldStatus);
            let newIndex = stageOrder.indexOf(newStatus);

            // 2️⃣ Determine movement type
            let isForward = newIndex > oldIndex;
            let isBackward = newIndex < oldIndex;

            // 3️⃣ Confirmation when moving forward
            if (isForward && newStatus !== "done") {
                const res = await Swal.fire({
                    icon: "question",
                    title: "Move task forward?",
                    text: "Are you sure you want to move this task ahead?",
                    showCancelButton: true,
                    confirmButtonText: "Yes, move forward",
                });

                if (!res.isConfirmed) {
                    evt.from.appendChild(card); // revert
                    return;
                }
            }

            // 4️⃣ Confirmation when moving backward
            if (isBackward) {
                const res = await Swal.fire({
                    icon: "warning",
                    title: "Move task backward?",
                    text: "Are you sure you want to move the task to a previous stage?",
                    showCancelButton: true,
                    confirmButtonText: "Yes, move back",
                });

                if (!res.isConfirmed) {
                    evt.from.appendChild(card);
                    return;
                }
            }

            // 5️⃣ Auto-finish when moved to DONE
            if (newStatus === "done") {
                Swal.fire({
                    icon: "success",
                    title: "Task Completed!",
                    timer: 1500,
                    showConfirmButton: false,
                });

                // Hide after 2 seconds
                setTimeout(() => {
                    card.style.opacity = "0";
                    setTimeout(() => card.remove(), 500);
                }, 2000);
            }

            // 6️⃣ Update DB (finalize)
            fetch("/tasks/update-status", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        "meta[name=csrf-token]"
                    ).content,
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ task_id, status: newStatus }),
            });
        },
    });
});

// 7️⃣ User assignment confirmation
document.addEventListener("change", async function (e) {
    if (e.target.classList.contains("assignUserSelect")) {
        let task_id = e.target.dataset.task;
        let user_id = e.target.value;

        // Ask confirmation
        const res = await Swal.fire({
            icon: "question",
            title: "Reassign Task?",
            text: "Do you really want to change the assigned user?",
            showCancelButton: true,
            confirmButtonText: "Yes, change user",
        });

        if (!res.isConfirmed) {
            e.target.value = e.target.getAttribute("data-prev") || "";
            return;
        }

        // Save previous value for future rollback
        e.target.setAttribute("data-prev", user_id);

        // Update backend
        fetch("/tasks/update-user", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector("meta[name=csrf-token]")
                    .content,
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ task_id, user_id }),
        });
    }
});
// Update card background color dynamically
const statusColorMap = {
    todo: "#f8d7da",
    pending: "#fff3cd",
    progress: "#cff4fc",
    done: "#d1e7dd",
};

card.style.background = statusColorMap[newStatus];

// update border color
card.setAttribute("data-status", newStatus);

document.addEventListener("DOMContentLoaded", function () {
    const statusColorMap = {
        todo: "#f8d7da",
        pending: "#fff3cd",
        progress: "#cff4fc",
        done: "#d1e7dd",
    };

    const borderColorMap = {
        todo: "#dc3545",
        pending: "#ffc107",
        progress: "#0dcaf0",
        done: "#198754",
    };

    document.querySelectorAll(".kanban-column").forEach((col) => {
        new Sortable(col, {
            group: "tasks",
            animation: 150,
            ghostClass: "drag-ghost",

            onEnd: function (evt) {
                const card = evt.item;
                const newStatus = evt.to.dataset.status;
                const taskId = card.dataset.id;

                // 🟦 Update UI instantly (NO REFRESH)
                card.style.background = statusColorMap[newStatus];
                card.style.borderLeft = `5px solid ${borderColorMap[newStatus]}`;
                card.setAttribute("data-status", newStatus);

                // 🟩 Update progress bar immediately
                const progressMap = {
                    todo: 5,
                    pending: 25,
                    progress: 60,
                    done: 100,
                };

                const bar = card.querySelector(".progress-bar");
                if (bar) {
                    bar.style.width = progressMap[newStatus] + "%";

                    // also change bar color
                    bar.className = "progress-bar";
                    if (newStatus === "todo") bar.classList.add("bg-danger");
                    if (newStatus === "pending")
                        bar.classList.add("bg-warning");
                    if (newStatus === "progress") bar.classList.add("bg-info");
                    if (newStatus === "done") bar.classList.add("bg-success");
                }

                // 🟧 Send to backend
                fetch("/tasks/update-status", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content,
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        task_id: taskId,
                        status: newStatus,
                    }),
                });
            },
        });
    });
});
