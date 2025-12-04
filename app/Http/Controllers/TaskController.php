<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Events\TaskUpdated;
use App\Models\Task; use App\Models\User; use App\Models\Department;

class TaskController extends Controller
{
    public function index(){ $users = User::all(); $departments = Department::all(); return view('tasks.index', compact('users','departments')); }

    public function data(){ $tasks = Task::with('assignee','department')->get(); return response()->json(['data'=>$tasks]); }

    public function create(){ return view('tasks.partials.form', ['task'=>new Task(),'method'=>'POST','action'=>route('tasks.store')]); }
    public function store(Request $r){ $data = $r->validate(['title'=>'required']); $task = Task::create($r->all()); return response()->json(['success'=>true,'task'=>$task]); }
    public function show(Task $task){ return view('tasks.show', compact('task')); }
    public function edit(Task $task){ return view('tasks.partials.form', ['task'=>$task,'method'=>'PUT','action'=>route('tasks.update',$task->id)]); }
    public function update(Request $r, Task $task){ $task->update($r->all()); return response()->json(['success'=>true,'task'=>$task]); }
    public function destroy(Task $task){ //$task->delete();
     return response()->json(['success'=>true]); }

    // Kanban
    public function kanban()
    {
        $tasks = Task::with('assignee')->get();
        $users = User::select('id','username')->get();
        $columns = ['todo'=>'To Do','pending'=>'Pending','progress'=>'In Progress','done'=>'Done'];
        return view('tasks.kanban', compact('tasks','columns','users'));
    }

    public function updateStatus(Request $request)
{
    $request->validate([
        'task_id' => 'required|exists:tasks,id',
        'status'  => 'required|string',
    ]);

    $task = Task::findOrFail($request->task_id);
    $task->status = $request->status;
    $task->save();

    // Broadcast event
    broadcast(new TaskUpdated($task))->toOthers();

    return response()->json(['success' => true, 'task' => $task]);
}

public function updateUser(Request $request)
{
    $request->validate([
        'task_id' => 'required|exists:tasks,id',
        'user_id' => 'nullable|exists:users,id',
    ]);

    $task = Task::findOrFail($request->task_id);
    $task->assigned_to = $request->user_id;
    $task->save();

    // Broadcast event
    broadcast(new TaskUpdated($task))->toOthers();

    return response()->json(['success' => true, 'task' => $task]);
}

public function archive(Request $request)
{
    Task::where('id', $request->task_id)->update(['is_archived' => 1]);
    return response()->json(['success' => true]);
}

}
