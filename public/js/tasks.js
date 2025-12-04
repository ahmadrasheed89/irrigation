// Simple AJAX + Sortable integration for tasks
document.addEventListener('DOMContentLoaded', function(){
  const forms = { taskForm: document.getElementById('taskForm') };
  if(forms.taskForm){
    forms.taskForm.addEventListener('submit', function(e){
      e.preventDefault();
      const data = new FormData(forms.taskForm);
      fetch('/tasks', {method:'POST', headers:{'X-Requested-With':'XMLHttpRequest'}, body: data})
        .then(r=>r.json()).then(task=>{ location.reload(); }).catch(console.error);
    });
  }

  document.querySelectorAll('.task-list').forEach(listEl=>{
    new Sortable(listEl, {
      group: 'tasks',
      animation: 150,
      onAdd: function(evt){
        const item = evt.item;
        const taskId = item.getAttribute('data-id');
        const status = evt.to.parentElement.getAttribute('data-status') || evt.to.id.replace('board-','');
        fetch('/tasks/'+taskId, {
          method: 'POST',
          headers: {'X-Requested-With':'XMLHttpRequest','X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.getAttribute('content') || ''},
          body: new URLSearchParams({'_method':'PUT','status': status})
        }).then(r=>r.json()).then(()=>{}).catch(console.error);
      }
    });
  });
});
