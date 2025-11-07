<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   //public function __construct() { $this->authorizeResource(Category::class, 'category'); }

    public function index(Request $request)
    {
        $filters = $request->only(['q','name','description']);
        $categories = Category::query()
        ->when($filters['q'] ?? null, fn($q, $v) =>
            $q->where(function ($inner) use ($v) {
                $inner->where('name', 'like', "%{$v}%")
                    ->orWhere('description', 'like', "%{$v}%");
            })
        )
        ->latest()
        ->paginate(12)
        ->appends($filters);
        return view('categories.index', compact('categories','filters'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
