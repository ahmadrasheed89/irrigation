<?php

namespace App\Http\Controllers;

use App\Models\Adp;
use App\Http\Requests\StoreAdpRequest;
use App\Http\Requests\UpdateAdpRequest;
use Illuminate\Support\Facades\Storage;

class AdpController extends Controller
{
    public function __construct()
    {
        //$this->authorizeResource(Adp::class, 'adp');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adps = Adp::latest()->paginate(10);
        return view('adps.index', compact('adps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdpRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();

        // if ($request->hasFile('attached_files')) {
        //     $data['attached_files'] = $request->file('attached_files')->store('adp_files', 'public');
        // }

        Adp::create($data);

        return redirect()->route('adps.index')->with('success', 'ADP created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Adp $adp)
    {
        return view('adps.show', compact('adp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Adp $adp)
    {
        return view('adps.edit', compact('adp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdpRequest $request, Adp $adp)
    {
       $data = $request->all();

        // if ($request->hasFile('attached_files')) {
        //     if ($adp->attached_files) {
        //         Storage::disk('public')->delete($adp->attached_files);
        //     }
        //     $data['attached_files'] = $request->file('attached_files')->store('adp_files', 'public');
        // }

        $adp->update($data);

        return redirect()->route('adps.index')->with('success', 'ADP updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Adp $adp)
    {
        if ($adp->attached_files) {
            Storage::disk('public')->delete($adp->attached_files);
        }
        $adp->delete();
        return redirect()->route('adps.index')->with('success', 'ADP deleted successfully.');
    }
}
