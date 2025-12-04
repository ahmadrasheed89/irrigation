$(function(){
    // Attach tags (comma separated names or ids)
    $('#attachTagsBtn').on('click', function(){
        const taskId = $('#taskTagsSection').data('task-id');
        const raw = $('#taskTagInput').val().trim();
        if(!raw) return;
        const arr = raw.split(',').map(s => s.trim()).filter(Boolean);
        const data = new URLSearchParams();
        arr.forEach(t => data.append('tags[]', t));
        data.append('_token', '{{ csrf_token() }}');

        fetch(`/tasks/${taskId}/tags`, { method:'POST', body: data })
        .then(r => r.json())
        .then(json => {
            if(json.success) {
                // render tags list
                const list = document.getElementById('taskTagsList');
                list.innerHTML = '';
                json.tags.forEach(t => {
                    const span = document.createElement('span');
                    span.className = 'badge me-1';
                    span.style.background = t.color || '#6c757d';
                    span.style.color = '#fff';
                    span.innerHTML = `${t.name} <a href="#" class="text-light ms-1 detachTag" data-tag="${t.id}" data-task="${taskId}">&times;</a>`;
                    list.appendChild(span);
                });
                $('#taskTagInput').val('');
            }
        });
    });

    // add existing tag button
    $(document).on('click', '.addExistingTag', function(){
        const name = $(this).data('name');
        const input = $('#taskTagInput').val();
        $('#taskTagInput').val(input ? input + ', ' + name : name);
    });

    // detach tag
    $(document).on('click', '.detachTag', function(e){
        e.preventDefault();
        const tagId = $(this).data('tag');
        const taskId = $(this).data('task');
        if(!confirm('Remove tag?')) return;
        fetch(`/tasks/${taskId}/tags/${tagId}/detach`, { method:'POST', headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}' } })
            .then(r => r.json())
            .then(json => {
                if(json.success) $(this).closest('.badge').remove();
            }.bind(this));
    });

});
