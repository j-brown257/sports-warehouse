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
            // Split into individual words so a natural phrase (typed, or
            // spoken via voice search) like "nike shoes" can match a brand
            // word and a category word separately, rather than needing the
            // exact phrase "nike shoes" to appear somewhere verbatim.
            $words = preg_split('/\s+/', $q);

            // Every word must match SOMETHING (combined with AND), but each
            // word is allowed to match in any of the item name, brand, or
            // category name (combined with OR). So "nike shoes" requires a
            // "nike" match (via brand) AND a "shoes" match (via category),
            // rather than returning every shoe or everything Nike-branded.
            $items = Item::where(function ($query) use ($words) {
                foreach ($words as $word) {
                    $query->where(function ($sub) use ($word) {
                        $sub->where('itemName', 'LIKE', '%' . $word . '%')
                            ->orWhere('brand', 'LIKE', '%' . $word . '%')
                            ->orWhereHas('category', function ($catQuery) use ($word) {
                                $catQuery->where('categoryName', 'LIKE', '%' . $word . '%');
                            });
                    });
                }
            })
                ->orderBy('itemName')
                ->get();
        }

        return view('search', compact('q', 'items'));
    }
}
