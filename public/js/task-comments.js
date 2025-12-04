$(function () {
    $("#commentForm").on("submit", function (e) {
        e.preventDefault();
        const data = $(this).serialize();
        $.post('{{ route("task-comments.store") }}', data, function (res) {
            if (res.success) {
                // append comment to list (use returned comment)
                const c = res.comment;
                const html = `<li class="list-group-item d-flex justify-content-between align-items-start">
                    <div>
                        <strong>${c.user.name}</strong>
                        <div class="small text-muted">just now</div>
                        <div class="mt-1">${escapeHtml(c.comment)}</div>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-danger deleteCommentBtn" data-id="${
                            c.id
                        }">Delete</button>
                    </div>
                </li>`;
                $("#commentsList").append(html);
                $("#commentForm")[0].reset();
            }
        });
    });

    $(document).on("click", ".deleteCommentBtn", function () {
        if (!confirm("Delete comment?")) return;
        const id = $(this).data("id");
        const btn = $(this);
        $.ajax({
            url: "/task-comments/" + id,
            method: "DELETE",
            data: { _token: "{{ csrf_token() }}" },
            success: function (res) {
                if (res.success) btn.closest("li").remove();
            },
        });
    });

    function escapeHtml(s) {
        return String(s).replace(/[&<>"'`=\/]/g, function (c) {
            return {
                "&": "&amp;",
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#39;",
                "/": "&#x2F;",
                "`": "&#x60;",
                "=": "&#x3D;",
            }[c];
        });
    }
});
