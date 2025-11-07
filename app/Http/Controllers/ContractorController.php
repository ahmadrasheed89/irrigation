<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use Illuminate\Http\Request;
use App\Traits\HasSearch;

class ContractorController extends Controller
{
    use  HasSearch;
    public function index(Request $request)
    {
        $filters = $request->only(['q','name','email']);
        $contractors = Contractor::query()->search($filters)->latest()->paginate(12)->appends($filters);
        return view('contractors.index', compact('contractors','filters'));
    }
}
