<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ContractorController extends Controller
{
    public function index(Request $request)
    {
        $contractors = Contractor::latest()->filter(request(['search']))
                    ->paginate(10)
                    ->withQueryString();

        return view('contractors.index', compact('contractors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contractors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'constractor_name' => 'required|string|max:255',
            'vendor_no' => 'required|string|max:255|unique:contractors',
            'email' => 'required|email|max:255|unique:contractors',
            'phone' => 'nullable|string|max:20',
        ]);

        DB::transaction(function () use ($validated) {
            Contractor::create($validated);
        });

        return redirect()->route('contractors.index')
                        ->with('success', 'contractor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contractor $contractor)
    {
        return view('contractors.show', compact('contractor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contractor $contractor)
    {
        return view('contractors.edit', compact('contractor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contractor $contractor)
    {
        $validated = $request->validate([
            'constractor_name' => 'required|string|max:255',
            'vendor_no' => 'required|string|max:255|unique:contractors,vendor_no,' . $contractor->id,
            'email' => 'required|email|max:255|unique:contractors,email,' . $contractor->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $contractor->update($validated);

        return redirect()->route('contractors.index')
                        ->with('success', 'Contractor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contractor $contractor)
    {
        // Prevent users from deleting themselves
        if ($contractor->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $contractor->delete();

        return redirect()->route('contractors.index')
                        ->with('success', 'Contractor deleted successfully.');
    }


    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:contractors,id'
        ]);

        $contractors = Contractor::whereIn('id', $request->ids);

        switch ($request->action) {
            case 'activate':
                $contractors->update(['status' => true]);
                $message = 'Selected contractors activated successfully.';
                break;

            case 'deactivate':
                $contractors->update(['status' => false]);
                $message = 'Selected contractors deactivated successfully.';
                break;

            case 'delete':
                // Prevent self-deletion
                $contractors->where('id', '!=', auth()->id())->delete();
                $message = 'Selected contractors deleted successfully.';
                break;
        }

        return back()->with('success', $message);
    }
}
