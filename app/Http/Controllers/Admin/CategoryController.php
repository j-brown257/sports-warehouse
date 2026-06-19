<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'categoryName' => ['required', 'string', 'max:50', Rule::unique('category', 'categoryName')],
        ]);

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category created.');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'categoryName' => [
                'required', 'string', 'max:50',
                Rule::unique('category', 'categoryName')->ignore($category->categoryId, 'categoryId'),
            ],
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated.');
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('admin.categories.index')->with('success', 'Category deleted.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Cannot delete this category — it still has items linked to it.');
        }
    }
}