<?php

namespace App\Http\Controllers;

use App\Models\{Scheme,Tender,Category,Portfolio,Noc, Adp};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    //public function __construct() { $this->middleware('auth'); }

    public function index()
    {
        $user = Auth::user();
        $stats = [
            'schemes' => Scheme::count(),
            'tenders' => Tender::count(),
            'categories' => Category::count(),
            'portfolios' => Portfolio::count(),
            'nocs' => Noc::count(),
            'nocsApprove' => Noc::where('nocstatus',2)->count(),
            'nocsReject' => Noc::where('nocstatus',3)->count(),
            'nocsPending' => Noc::where('nocstatus',1)->count(),
            'adps' => Adp::count(),
        ];

        // 📊 Monthly data for Schemes & Tenders
        $schemeData = Scheme::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month');

        $tenderData = Tender::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month');

        // 🥧 Category distribution in Tenders
        $categoryData = Tender::join('categories', 'tenders.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('COUNT(tenders.id) as total'))
            ->groupBy('categories.name')
            ->pluck('total', 'categories.name');

            $adps = Adp::with('schemes')->withSum('schemes', 'expenditure')
                    ->withSum('schemes', 'liability')
                    ->withSum('schemes', 'sub_work_t_s_cost')
                    ->latest()->limit(7)->get();

        return view('dashboard', [
            'stats' => $stats,
            'user' => $user,
            'schemeData' => $schemeData,
            'tenderData' => $tenderData,
            'categoryData' => $categoryData,
            'adps' => $adps,
        ]);
    }

    public function allAdp(){
    // Get ADPs with aggregated expenditure from schemes

    }
}
