<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNocCategoryRequest;
use App\Models\Noc;
use App\Models\NocFile;
use App\Models\NocCategory;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNocRequest;
use App\Http\Requests\UpdateNocRequest;
use Illuminate\Support\Facades\Storage;
use App\Traits\HandlesFileUploads;

class NocController extends Controller
{
    use HandlesFileUploads;

        public function __construct()
    {
        //$this->authorizeResource(Adp::class, 'adp');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['q','issue_number','department','nature_of_noc','noc_subject']);
        $nocs = Noc::query()
                    ->paginate(12)
                    ->appends($filters);
        return view('nocs.index', compact('nocs','filters'));
        // $nocs = Noc::latest()->paginate(10);
        // return view('nocs.index', compact('nocs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('nocs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNocRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        if ($request->hasFile('attached_files')) {
            $data['attached_files'] = $request->file('attached_files')->store('noc_files', 'public');
        }

        Noc::create($data);

        return redirect()->route('nocs.index')->with('success', 'NOC Request created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Noc $noc)
    {
        return view('nocs.show', compact('noc'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Noc $noc)
    {
        return view('nocs.edit', compact('noc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNocRequest $request, Noc $noc)
    {
       $data = $request->validated();
       //dd($data);

        if ($request->hasFile('attached_files')) {
            if ($noc->attached_files) {
                Storage::disk('public')->delete($noc->attached_files);
            }
            $data['attached_files'] = $request->file('attached_files')->store('noc_files', 'public');
        }

        $noc->update($data);

        return redirect()->route('nocs.index')->with('success', 'NOC updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Noc $noc)
    {
        if ($noc->attached_files) {
            Storage::disk('public')->delete($noc->attached_files);
        }
        $noc->delete();
        return redirect()->route('nocs.index')->with('success', 'Noc deleted successfully.');
    }

    // Update status
    public function updateStatus(Request $request, Noc $noc)
    {
        $request->validate([
            'nocstatus' => 'required|in:0,1,2,3',
        ]);

        $noc->update(['nocstatus' => $request->nocstatus]);

        return redirect()->back()->with('success', 'Status updated successfully!');
    }

    public function upload($nocId){

        $allNocCategories = NocCategory::all();
        $nocFiles = NocFile::with(['noc', 'nocCategory'])->where('noc_id', $nocId)->get();
//dd($nocFiles);
        $nocName = !empty($nocFiles) ? $nocFiles[0]->noc->issue_no : Noc::select('issue_no')->findOrFail($nocId);

        return view('nocs.upload', compact('nocFiles','allNocCategories', 'nocId', 'nocName'));
    }


    public function uploadFile(StoreNocCategoryRequest $request)
    {
        $paths = [];
        if ($request->hasFile('attached_files')) {
            $paths = $this->uploadMultipleFiles($request->file('attached_files'), 'nocs');
        }

        NocFile::create([
            'noc_id' => $request->noc_id,
            'noc_category_id' => $request->noc_category_id,
            'description' => $request->description,
            'user_id' => auth()->id(),
            'date' => $request->date,
            'attached_files' => $paths,
        ]);


        return redirect()->route('nocs.upload',[$request->noc_id])->with('success', 'Tender created successfully.');
    }

    public function uploadDestroy(NocFile $nocFile)
    {
         // Assuming your image is stored in the 'public' disk (e.g., storage/app/public/images)
    $imagePath = $nocFile->attached_files[0] ?? ''; // Path relative to the disk's root

    if (Storage::disk('public')->exists($imagePath)) {
        Storage::disk('public')->delete($imagePath);
    }
       $nocId = $nocFile->noc_id;
       $nocFile->delete();
        return redirect()->route('nocs.upload',[$nocId])->with(['success' => 'Tender deleted.', 'nocId' => $nocId]);

    }
}
