<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // Dashboard view
    public function dashboard()
    {
        return view('reports.dashboard');
    }

    // AJAX data for dashboard charts
    public function data(Request $request)
    {
        // Throughput: completed tasks per week (last 12 weeks)
        $throughput = Task::whereNotNull('updated_at')
            ->where('status', 'done')
            ->where('is_archived', 0)
            ->select(DB::raw("DATE_FORMAT(updated_at, '%Y-%u') as week"), DB::raw('count(*) as total'))
            ->groupBy('week')
            ->orderBy('week', 'asc')
            ->limit(12)
            ->get()
            ->pluck('total', 'week');

        // Tasks by status
        $status = Task::select('status', DB::raw('count(*) as total'))
            ->where('is_archived', 0)
            ->groupBy('status')
            ->pluck('total', 'status');

        // Tasks by priority
        $priority = Task::select('priority', DB::raw('count(*) as total'))
            ->where('is_archived', 0)
            ->groupBy('priority')
            ->pluck('total', 'priority');

        // Tasks per user (current open tasks)
        $perUser = Task::select('assigned_to', DB::raw('count(*) as total'))
            ->where('is_archived',0)
            ->groupBy('assigned_to')
            ->get()
            ->mapWithKeys(function($row){
                $user = User::find($row->assigned_to);
                $name = $user ? $user->username : 'Unassigned';
                return [$name => (int)$row->total];
            });

        // WIP count (in progress + pending)
        $wip = Task::whereIn('status', ['pending','progress'])->where('is_archived',0)->count();

        // Average cycle time: time from created_at -> updated_at for done tasks (days)
        $avgCycle = Task::where('status','done')->where('is_archived',0)
            ->select(DB::raw('AVG(DATEDIFF(updated_at, created_at)) as avg_days'))
            ->value('avg_days');
        $avgCycle = $avgCycle ? round($avgCycle,1) : 0;

        // Aging: tasks in each status by age buckets
        $agingQuery = Task::select('id','title','status','created_at', DB::raw("DATEDIFF(NOW(), created_at) as age_days"))
            ->where('is_archived',0)
            ->get();

        $agingBuckets = [
            '0-3' => 0, '4-7' => 0, '8-14' => 0, '15+' => 0
        ];
        foreach($agingQuery as $t){
            $d = (int)$t->age_days;
            if($d <= 3) $agingBuckets['0-3']++;
            else if($d <=7) $agingBuckets['4-7']++;
            else if($d <=14) $agingBuckets['8-14']++;
            else $agingBuckets['15+']++;
        }

        // Top 10 stale tasks (by age)
        $stale = Task::select('id','title','status',DB::raw("DATEDIFF(NOW(), created_at) as age_days"))
            ->where('is_archived',0)
            ->orderByDesc('age_days')
            ->limit(10)
            ->get();

        return response()->json([
            'throughput' => $throughput,
            'status' => $status,
            'priority' => $priority,
            'perUser' => $perUser,
            'wip' => $wip,
            'avgCycle' => $avgCycle,
            'aging' => $agingBuckets,
            'stale' => $stale
        ]);
    }
}
