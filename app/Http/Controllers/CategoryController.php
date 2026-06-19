<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::all()->firstWhere('slug', $slug);

        if (!$category) {
            abort(404);
        }

        $items = $category->items;

        return view('category', compact('category', 'items'));
    }
}