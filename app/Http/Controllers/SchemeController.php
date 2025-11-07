<?php
namespace App\Http\Controllers;

use App\Models\Scheme;
use App\Models\Contractor;
use App\Models\Adp;
use Illuminate\Http\Request;

class SchemeController extends Controller
{
    //ublic function __construct() { $this->authorizeResource(Scheme::class, 'scheme'); }

    public function index(Request $request)
    {
        $filters = $request->only(['q','name','adp_code','cost']);

        $schemes = Scheme::query()
            ->with('contractor')
            ->when($filters['contractor_id'] ?? null, fn($q, $v) => $q->where('contractor_id', $v))
            ->when($filters['q'] ?? null, fn($q, $v) =>
                $q->where(function ($inner) use ($v) {
                    $inner->where('scheme.name', 'like', "%{$v}%")
                        ->orWhere('cost', 'like', "%{$v}%")
                        ->orWhere('adp_code', 'like', "%{$v}%");
                })
            )
           // ->when($filters['status'] ?? null, fn($q, $v) => $q->where('status', $v))
          //  ->when($filters['date_from'] ?? null, fn($q, $v) => $q->whereDate('created_at', '>=', $v))
           // ->when($filters['date_to'] ?? null, fn($q, $v) => $q->whereDate('created_at', '<=', $v))
            ->latest()
            ->paginate(12)
            ->appends($filters);


        $contractors = Contractor::all();
        return view('schemes.index', data: compact('schemes','filters','contractors'));
    }

    public function create()
    {
        $contractors = Contractor::all();
        $adps = Adp::all();
        return view('schemes.create', compact('contractors','adps'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'expenditure' => 'required|numeric|min:0',
            'adp_code' => 'required|string',
            'contractor_id' => 'required|exists:contractors,id',
            'adp_id' => 'required|exists:adps,id',
            'contractor_premium' => 'nullable|numeric|min:0',
            'bid_cost' => 'required|numeric|min:0',
        ]);

        Scheme::create($validated);

        return redirect()->route('schemes.index')->with('success', 'Scheme created successfully.');
    }

    public function show(Scheme $scheme)
    {
        $scheme->load('contractor');
        return view('schemes.show', compact('scheme'));
    }

    public function edit(Scheme $scheme)
    {
        $contractors = Contractor::all();
        $adps = Adp::all();
        return view('schemes.edit', compact('scheme', 'contractors', 'adps'));
    }

    public function update(Request $request, Scheme $scheme)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'expenditure' => 'required|numeric|min:0',
            'adp_code' => 'required|string',
            'contractor_id' => 'required|exists:contractors,id',
            'adp_id' => 'required|exists:contractors,id',
            'contractor_premium' => 'required|numeric|min:0',
            'bid_cost' => 'required|numeric|min:0',
        ]);

        $scheme->update($validated);

        return redirect()->route('schemes.index')->with('success', 'Scheme updated successfully.');
    }

    public function destroy(Scheme $scheme)
    {
        $scheme->delete();
        return redirect()->route('schemes.index')->with('success', 'Scheme deleted successfully.');
    }
}
