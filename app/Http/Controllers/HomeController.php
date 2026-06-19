<?php

namespace App\Http\Controllers;

use App\Models\Item;

class HomeController extends Controller
{
    public function index()
    {
        $featuredItems = Item::where('featured', 1)->get();
        return view('home', compact('featuredItems'));
    }
}