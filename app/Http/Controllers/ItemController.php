<?php

namespace App\Http\Controllers;

use App\Models\Item;

class ItemController extends Controller
{
    public function show($slug)
    {
        $item = Item::all()->firstWhere('slug', $slug);

        if (!$item) {
            abort(404);
        }

        return view('item', compact('item'));
    }
}