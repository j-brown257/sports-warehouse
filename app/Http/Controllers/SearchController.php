<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // Get the search query from the URL (e.g. ?q=soccer), trim whitespace
        $q = trim($request->input('q', ''));

        if ($q === '') {
            // No search term entered — return an empty collection
            $items = collect();
        } else {
            // Use SQL LIKE with wildcards to match anywhere in the item name
            $items = Item::where('itemName', 'LIKE', '%' . $q . '%')
                ->orderBy('itemName')
                ->get();
        }

        return view('search', compact('q', 'items'));
    }
}