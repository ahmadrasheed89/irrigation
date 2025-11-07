<?php
namespace App\Http\Controllers;

use App\Models\Tender;
use App\Models\Scheme;
use App\Models\Category;
use App\Http\Requests\StoreTenderRequest;
use App\Traits\HandlesFileUploads;
use Illuminate\Http\Request;
use App\Http\Controllers\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

class TenderController extends Controller
{
    use HandlesFileUploads;

    public function index(Request $request)
    {
        //$tenders = Tender::with(['scheme', 'category'])->paginate(10);
        $schemes = Scheme::pluck('name','id');
        $categories = Category::pluck('name','id');
        $filters = $request->only(['q','description','date','scheme_id','category_id']);
        $schemesList = Scheme::query()
                    ->paginate(100)
                    ->appends($filters);
        //$tenders = Tender::with('category')->get();
        //$categoryTypes = Category::all(); // our 6 fixed types

        //return view('tenders.index', compact('tenders', 'categoryTypes'));
        return view('tenders.index', compact('schemesList','filters','schemes','categories'));
    }

    public function create()
    {
        $schemes = Scheme::all();
        $categories = Category::all();
        return view('tenders.create', compact('schemes', 'categories'));
    }

    public function store(StoreTenderRequest $request)
    {
        $paths = [];
        if ($request->hasFile('attached_files')) {
            $paths = $this->uploadMultipleFiles($request->file('attached_files'), 'tenders');
        }

        Tender::create([
            'scheme_id' => $request->scheme_id,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'user_id' => auth()->id(),
            'date' => $request->date,
            'attached_files' => $paths,
        ]);


        return redirect()->route('tenders.show',[$request->scheme_id])->with('success', 'Tender created successfully.');
    }

    public function show( $schemeId)
    {
        // Get the scheme


        // // Get all tenders under this scheme
        // $tenders = Tender::where('scheme_id', $schemeId)->get();
        $allCategories = Category::all();
        $tenders = Tender::with(['scheme', 'category'])->where('scheme_id', $schemeId)->get();

        $scheme = Scheme::select('name')->findOrFail($schemeId);
        $schemeName = $scheme->name;

        return view('tenders.show', compact('tenders','allCategories', 'schemeId', 'schemeName'));
    }

    public function edit(Tender $tender)
    {
        $schemes = Scheme::all();
        $categories = Category::all();
        return view('tenders.edit', compact('tender', 'schemes', 'categories'));
    }

    public function update(StoreTenderRequest $request, Tender $tender)
    {
        $paths = $tender->attached_files ?? [];
        if ($request->hasFile('attached_files')) {
            $paths = array_merge($paths, $this->uploadMultipleFiles($request->file('attached_files'), 'tenders'));
        }

        $tender->update([
            'scheme_id' => $request->scheme_id,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'date' => $request->date,
            'attached_files' => $paths,
        ]);

        return redirect()->route('tenders.index')->with('success', 'Tender updated successfully.');
    }

    public function destroy(Tender $tender)
    {
         // Assuming your image is stored in the 'public' disk (e.g., storage/app/public/images)
    $imagePath = $tender->attached_files[0] ?? ''; // Path relative to the disk's root

    if (Storage::disk('public')->exists($imagePath)) {
        Storage::disk('public')->delete($imagePath);
    }
       $schemeId = $tender->scheme_id;
       $tender->delete();
        return redirect()->route('tenders.show',[$schemeId])->with(['success' => 'Tender deleted.', 'schemeId' => $schemeId]);

    }
}
