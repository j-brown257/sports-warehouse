<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('category')->orderBy('itemName')->get();
        return view('admin.items.index', ['items' => $items]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.items.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'itemName'    => 'required|string|max:150',
            'categoryId'  => 'required|exists:category,categoryId',
            'price'       => 'required|numeric|min:0',
            'salePrice'   => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:2000',
            'photo'       => 'nullable|image|max:2048',
            'featured'    => 'nullable|boolean',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets'), $filename);
            $validated['photo'] = $filename;
        }

        $validated['featured'] = $request->boolean('featured');

        Item::create($validated);

        return redirect()->route('admin.items.index')->with('success', 'Item created.');
    }

    public function show(Item $item)
    {
        //
    }

    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('admin.items.edit', ['item' => $item, 'categories' => $categories]);
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'itemName'    => 'required|string|max:150',
            'categoryId'  => 'required|exists:category,categoryId',
            'price'       => 'required|numeric|min:0',
            'salePrice'   => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:2000',
            'photo'       => 'nullable|image|max:2048',
            'featured'    => 'nullable|boolean',
        ]);

if ($request->hasFile('photo')) {
    $file = $request->file('photo');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('assets'), $filename);
    $validated['photo'] = $filename;          // 1. new file uploaded
} elseif ($request->boolean('remove_photo')) {
    $validated['photo'] = null;               // 2. user asked to remove it
} else {
    unset($validated['photo']);               // 3. leave the existing photo alone
}

        $validated['featured'] = $request->boolean('featured');

        $item->update($validated);

        return redirect()->route('admin.items.index')->with('success', 'Item updated.');
    }

    public function destroy(Item $item)
    {
        try {
            $item->delete();
            return redirect()->route('admin.items.index')->with('success', 'Item deleted.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.items.index')
                ->with('error', 'Cannot delete this item — it appears in existing orders.');
        }
    }
}