<?php

namespace App\Http\Controllers;

use App\Models\Adp;

class AdpDashboardController extends Controller
{
    public function index()
    {
        // Get ADPs with aggregated expenditure from schemes
        $adps = Adp::with('schemes')->withSum('schemes', 'expenditure')
                    ->withSum('schemes', 'liability')
                    ->withSum('schemes', 'sub_work_t_s_cost')
                    ->orderBy('adp_code')->get();

        return view('adps.dashboard', compact('adps'));
    }

    public function show(Adp $adp)
{
    // Load schemes with selected columns
    $adp->load(['schemes' => function ($query) {
        $query->select(
            'id',
            'adp_id',
            'name',
            'expenditure',
            'liability',
            'bid_cost',
            'physical_progress',
            'financial_progress',
            'sub_work_t_s_cost'
        );
    }]);

    // Calculate totals for the summary row
    $totals = [
        'sub_work_t_s_cost' => $adp->schemes->sum('sub_work_t_s_cost'),
        'expenditure' => $adp->schemes->sum('expenditure'),
        'liability' => $adp->schemes->sum('liability'),
        'physical_progress' => $adp->schemes->avg('physical_progress'),
        'financial_progress' => $adp->schemes->avg('financial_progress'),
    ];

    return view('adps.schemedetail', compact('adp', 'totals'));
}

}

