<?php

namespace App\Http\Controllers;

use App\Models\Item;

class ProductController extends Controller
{
    public function index()
    {
        // Fetch all items, sorted alphabetically by name
        $items = Item::orderBy('itemName')->get();

        // Create a "fake" category object so we can reuse the category.blade.php view
        // (the view just expects something with a categoryName property)
        $category = (object) ['categoryName' => 'All Products'];

        return view('category', compact('category', 'items'));
    }
}