<style>
.comment-box {
    background: #f9f9f9;
    padding: 12px 15px;
    border-radius: 10px;
    margin-bottom: 12px;
}
.comment-header {
    font-weight: bold;
    font-size: 14px;
}
.comment-time {
    font-size: 12px;
    color: #888;
    margin-left: 6px;
}
.comment-text {
    margin-top: 5px;
    font-size: 14px;
}
.reply-btn {
    font-size: 12px;
    color: #007bff;
    cursor: pointer;
    margin-top: 6px;
}
.reply-container {
    margin-left: 40px;
    border-left: 2px solid #ddd;
    padding-left: 15px;
}
.avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #ddd;
    display: inline-block;
    margin-right: 10px;
}
</style>

<div id="commentsList"></div>

<!-- Reply input -->
<div id="replyBox" style="display:none" class="mt-2">
    <textarea id="replyText" class="form-control" placeholder="Write a reply..."></textarea>
    <button class="btn btn-primary btn-sm mt-2" id="sendReply">Send Reply</button>
</div>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
let taskId = {{ $task->id }};

function loadComments() {
    $.get(`/tasks/${taskId}/comments`, function(res) {
        $("#commentsList").html("");
        res.forEach(c => {
            $("#commentsList").append(`
                <div class="comment-block">
                    <div class="comment-user">${c.user.name}</div>
                    <div>${c.comment}</div>
                    <div class="comment-time">${c.created_at}</div>
                </div>
            `);
        });
    });
}

$("#btnAddComment").click(function() {
    $.post(`/tasks/${taskId}/comments`, {
        comment: $("#newComment").val(),
        _token: "{{ csrf_token() }}"
    }, function() {
        $("#newComment").val("");
        loadComments();
    });
});

loadComments();
</script>
