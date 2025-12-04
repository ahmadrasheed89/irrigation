$(function () {
    let table = $("#tagsTable").DataTable({
        ajax: { url: "tags/data", dataSrc: "data" },
        columns: [
            { data: "id" },
            { data: "name" },
            {
                data: "color",
                render: function (d) {
                    return `<span class="badge" style="background:${d}; color:#000">${d}</span>`;
                },
            },
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function (row) {
                    return `<button class="btn btn-sm btn-warning editTag" data-id="${row.id}" data-name="${row.name}" data-color="${row.color}">Edit</button>
                        <button class="btn btn-sm btn-danger deleteTag" data-id="${row.id}">Delete</button>`;
                },
            },
        ],
    });

    const modal = new bootstrap.Modal(document.getElementById("tagModal"));

    $("#createTagBtn").click(function () {
        $("#tagModalTitle").text("Create Tag");
        $("#tag_id").val("");
        $("#tag_name").val("");
        $("#tag_color").val("");
        modal.show();
    });

    $(document).on("click", ".editTag", function () {
        $("#tagModalTitle").text("Edit Tag");
        $("#tag_id").val($(this).data("id"));
        $("#tag_name").val($(this).data("name"));
        $("#tag_color").val($(this).data("color"));
        modal.show();
    });

    $("#tagForm").submit(function (e) {
        e.preventDefault();
        const id = $("#tag_id").val();
        const name = $("#tag_name").val();
        const color = $("#tag_color").val();
        const url = id ? `/tags/${id}` : "/tags/store";
        const method = id ? "PUT" : "POST";

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: url,
            method: method,
            data: { name, color },
            success: function (res) {
                modal.hide();
                table.ajax.reload();
            },
        });
    });

    $(document).on("click", ".deleteTag", function () {
        if (!confirm("Delete tag?")) return;
        const id = $(this).data("id");
        $.ajax({
            url: `/tags/${id}`,
            method: "DELETE",
            data: { _token: "{{ csrf_token() }}" },
            success: function () {
                table.ajax.reload();
            },
        });
    });
});
