<?php

namespace App\Http\Controllers;

use App\Models\NocCategory;
use App\Http\Requests\StoreNocCategoryRequest;
use App\Http\Requests\UpdateNocCategoryRequest;
use Illuminate\Http\Request;


class NocCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $nocCategories = NocCategory::latest()->filter(request(['search']))
                    ->paginate(10)
                    ->withQueryString();

        return view('noc_categories.index', compact('nocCategories'));
    }
 public function create()
    {
        return view('noc_categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:noc_categories,name',
            'description' => 'nullable|string',
        ]);

        NocCategory::create($validated);

        return redirect()->route('noc-categories.index')->with('success', 'Category created successfully.');
    }

    public function show(NocCategory $nocCategory)
    {
        return view('noc_categories.show', compact('nocCategory'));
    }

    public function edit(NocCategory $nocCategory)
    {
        return view('noc_categories.edit', compact('nocCategory'));
    }

    public function update(Request $request, NocCategory $nocCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:noc_categories,name,' . $nocCategory->id,
            'description' => 'nullable|string',
        ]);

        $nocCategory->update($validated);

        return redirect()->route('noc-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(NocCategory $nocCategory)
    {
        $nocCategory->delete();
        return redirect()->route('noc-categories.index')->with('success', 'Category deleted successfully.');
    }
}
