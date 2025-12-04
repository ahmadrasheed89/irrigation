<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Department;
use Illuminate\Http\Request;

class TaskSearchController extends Controller
{
    public function index()
    {
        return view('task_explorer.index', [
            'users' => User::all(),
            'departments' => Department::all()
        ]);
    }

    public function search(Request $request)
    {
        $query = Task::with('assignee', 'department');

        // Filter by user
        if ($request->user_id) {
            $query->where('assigned_to', $request->user_id);
        }

        // Filter by department
        if ($request->department_id) {
            $query->where('department_id', $request->department_id);
        }

        // Filter by task title keyword
        if ($request->search) {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }

        // Group by status for UI
        $result = [
            'todo' => $query->clone()->where('status', 'todo')->get(),
            'pending' => $query->clone()->where('status', 'pending')->get(),
            'progress' => $query->clone()->where('status', 'progress')->get(),
            'done' => $query->clone()->where('status', 'done')->get(),
        ];

        return response()->json($result);
    }
}
