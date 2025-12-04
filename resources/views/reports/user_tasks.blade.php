@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h3 class="mb-4">User-Wise Detailed Task Report</h3>
  <div id="userTaskArea">
    <div class="text-center py-5" id="loadingBox">
      <div class="spinner-border text-primary" role="status"></div>
      <p class="mt-2">Loading...</p>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
  const endpoint = "{{ route('reports.user.tasks.data') }}";
  const container = document.getElementById('userTaskArea');

  function showError(msg){
    container.innerHTML = `<div class="alert alert-danger">${msg}</div>`;
  }

  // Fetch and render once (no interval)
  fetch(endpoint, { headers: { 'Accept': 'application/json' } })
    .then(resp => {
      if (!resp.ok) {
        // try to parse JSON error
        return resp.json().then(js => { throw {status: resp.status, body: js}; }).catch(()=>{ throw {status: resp.status, body: null}; });
      }
      return resp.json();
    })
    .then(json => {
      if (!json || !json.success) {
        const err = (json && json.error) ? json.error : 'Invalid response';
        showError('Server error: ' + err);
        console.error('Invalid JSON', json);
        return;
      }

      const users = json.users || [];
      if (users.length === 0) {
        container.innerHTML = '<div class="alert alert-info">No users/tasks found.</div>';
        return;
      }

      container.innerHTML = '';
      users.forEach((u, idx) => {
        const card = document.createElement('div');
        card.className = 'card shadow-sm mb-4';
        card.innerHTML = `
          <div class="card-header bg-dark text-white"><h5 class="m-0">${u.user}</h5></div>
          <div class="card-body">
            <div class="row text-center mb-3">
              ${metric('To Do', u.todo, 'secondary')}
              ${metric('Pending', u.pending, 'warning')}
              ${metric('Progress', u.progress, 'info')}
              ${metric('Done', u.done, 'success')}
            </div>
            <canvas id="chart-${idx}" height="100"></canvas>
            <hr>
            <h6>Tasks</h6>
            ${taskTable(u.tasks)}
          </div>
        `;
        container.appendChild(card);

        // render chart
        new Chart(document.getElementById('chart-' + idx), {
          type: 'bar',
          data: {
            labels: ['To Do','Pending','Progress','Done'],
            datasets: [{ data: [u.todo,u.pending,u.progress,u.done], backgroundColor: ['#6c757d','#ffc107','#17a2b8','#28a745'] }]
          },
          options: { responsive:true, plugins:{legend:{display:false}}, maintainAspectRatio:false }
        });
      });
    })
    .catch(err => {
      console.error('Fetch error', err);
      // If err.body exists show message from server
      if (err && err.body && err.body.error) {
        if (err.status === 401) {
          showError('You are not authenticated. Please log in.');
        } else {
          showError('Server error: ' + (err.body.error || JSON.stringify(err.body)));
        }
      } else {
        showError('Network or server error. See browser console for details.');
      }
    });

  function metric(label, value, color){
    return `<div class="col-md-3"><div class="p-3 bg-${color} text-${color==='warning'?'dark':'white'} rounded"><div class="small">${label}</div><div class="h4 m-0">${value}</div></div></div>`;
  }

  function taskTable(tasks){
    tasks = tasks || [];
    if (!tasks.length) return '<p>No tasks assigned.</p>';
    let rows = '';
    tasks.forEach(t => {
      rows += `<tr><td>${t.id}</td><td>${escapeHtml(t.title)}</td><td>${t.status}</td><td>${t.priority}</td><td>${t.created_at}</td><td>${t.updated_at}</td></tr>`;
    });
    return `<table class="table table-bordered table-sm mt-3"><thead class="table-light"><tr><th>ID</th><th>Title</th><th>Status</th><th>Priority</th><th>Created</th><th>Updated</th></tr></thead><tbody>${rows}</tbody></table>`;
  }

  function escapeHtml(str){
    if (!str) return '';
    return String(str).replace(/[&<>"'`=\/]/g, function(s){ return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;','/':'&#x2F;','`':'&#x60;','=':'&#x3D;'})[s]; });
  }

});
</script>
@endpush
