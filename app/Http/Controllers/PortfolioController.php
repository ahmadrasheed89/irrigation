<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\HandlesFileUploads;


class PortfolioController extends Controller
{
    use HandlesFileUploads;
    //public function __construct() { $this->authorizeResource(Portfolio::class, 'portfolio'); }

    public function index(Request $request)
    {
        $filters = $request->only(['q','title']);
        $portfolios=Portfolio::query()
        ->when($filters['q'] ?? null, fn($q, $v) =>
            $q->where(function ($inner) use ($v) {
                $inner->where('title', 'like', "%{$v}%")
                    ->orWhere('description', 'like', "%{$v}%");
            })
        )
        ->latest()
        ->paginate(12)
        ->appends($filters);
        return view('portfolios.index', compact('portfolios','filters'));
    }

    public function create()
    {
        return view('portfolios.create');
    }

    public function store(Request $request)
    {
        $paths = [];
        if ($request->hasFile('file_path')) {
            $paths = $this->uploadMultipleFiles($request->file('file_path'), 'portfolios');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required',
            'personal_no' => 'required',
            'cnic' => 'required',
            'duty_station' => 'required',
            'description' => 'nullable|string',
            'file_path.*' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg', // max 10MB
        ]);

          Portfolio::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'personal_no' => $request->personal_no,
            'cnic' => $request->cnic,
            'duty_station' => $request->duty_station,
            'description' => $request->description,
            'file_path' => $paths,
        ]);

        return redirect()->route('portfolios.index')->with('success', 'Portfolio created successfully.');
    }

    public function show(Portfolio $portfolio)
    {
        return view('portfolios.show', compact('portfolio'));
    }

    public function edit(Portfolio $portfolio)
    {
        return view('portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
           'name' => 'required|string|max:255',
            'designation' => 'required',
            'personal_no' => 'required',
            'cnic' => 'required',
            'duty_station' => 'required',
            'description' => 'nullable|string',
            'file_path.*' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg', // max 10MB
        ]);

        if ($request->hasFile('file_path')) {
            if ($portfolio->file_path) {
                Storage::disk('public')->delete($portfolio->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('portfolios', 'public');
        }

        $portfolio->update($validated);
        return redirect()->route('portfolios.index')->with('success', 'Portfolio updated successfully.');
    }

    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->file_path) {
            Storage::disk('public')->delete($portfolio->file_path);
        }
        $portfolio->delete();
        return redirect()->route('portfolios.index')->with('success', 'Portfolio deleted successfully.');
    }
}
