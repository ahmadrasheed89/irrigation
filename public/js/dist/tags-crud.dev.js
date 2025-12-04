"use strict";

$(function () {
  var table = $("#tagsTable").DataTable({
    ajax: {
      url: "tags/data",
      dataSrc: "data"
    },
    columns: [{
      data: "id"
    }, {
      data: "name"
    }, {
      data: "color",
      render: function render(d) {
        return "<span class=\"badge\" style=\"background:".concat(d, "; color:#000\">").concat(d, "</span>");
      }
    }, {
      data: null,
      orderable: false,
      searchable: false,
      render: function render(row) {
        return "<button class=\"btn btn-sm btn-warning editTag\" data-id=\"".concat(row.id, "\" data-name=\"").concat(row.name, "\" data-color=\"").concat(row.color, "\">Edit</button>\n                        <button class=\"btn btn-sm btn-danger deleteTag\" data-id=\"").concat(row.id, "\">Delete</button>");
      }
    }]
  });
  var modal = new bootstrap.Modal(document.getElementById("tagModal"));
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
    var id = $("#tag_id").val();
    var name = $("#tag_name").val();
    var color = $("#tag_color").val();
    var url = id ? "/tags/".concat(id) : "/tags/store";
    var method = id ? "PUT" : "POST";
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      },
      url: url,
      method: method,
      data: {
        name: name,
        color: color
      },
      success: function success(res) {
        modal.hide();
        table.ajax.reload();
      }
    });
  });
  $(document).on("click", ".deleteTag", function () {
    if (!confirm("Delete tag?")) return;
    var id = $(this).data("id");
    $.ajax({
      url: "/tags/".concat(id),
      method: "DELETE",
      data: {
        _token: "{{ csrf_token() }}"
      },
      success: function success() {
        table.ajax.reload();
      }
    });
  });
});