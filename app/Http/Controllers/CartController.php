<?php

namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{
public function index()
{
    // dd(session('cart'));   // TEMP: dump and die for testing

    $cart = session('cart', []);

    $subtotal = collect($cart)->sum(fn ($line) => $line['price'] * $line['qty']);
    $shipping = empty($cart) ? 0 : 9.95;       // flat $9.95, but $0 on an empty cart
    $total    = $subtotal + $shipping;
    $gst      = $total / 11;                    // GST already inside the total (÷11)

    return view('cart', compact('cart', 'subtotal', 'shipping', 'gst', 'total'));
}

public function add(Request $request, $itemId)
{
    // Look up the item by ID, and if not found, throw a 404 error.
    $item = Item::find($itemId);
    if (! $item) {
        abort(404);
    }
// Confirm a positive integer for the quantity, defaulting to 1 if not provided or invalid.
    $qty = max(1, (int) $request->input('qty', 1));

    $price = (! is_null($item->salePrice) && $item->salePrice > 0)
        ? $item->salePrice
        : $item->price;

    $cart = session('cart', []);
// If the item is already in the cart, just add to the quantity. Otherwise, add a new line for it.
    if (isset($cart[$itemId])) {
        $cart[$itemId]['qty'] += $qty;          
    } else {
        // Just store the bits needed to display the cart and calculate totals.
        $cart[$itemId] = [
            'itemId' => $item->itemId,
            'name'   => $item->itemName,
            'slug'   => $item->slug,
            'photo'  => $item->photo,
            'price'  => (float) $price,
            'qty'    => $qty,
        ];
    }

    session(['cart' => $cart]);

    return redirect()->route('cart.index')
        ->with('status', $item->itemName . ' was added to your cart.');
}

    public function update(Request $request)
{
    $cart = session('cart', []);

    foreach ($request->input('qty', []) as $itemId => $qty) {
        if (! isset($cart[$itemId])) {
            continue;                       // ignore anything not actually in the cart
        }
        $qty = (int) $qty;
        if ($qty < 1) {
            unset($cart[$itemId]);          // qty 0 = remove the line
        } else {
            $cart[$itemId]['qty'] = $qty;
        }
    }

    session(['cart' => $cart]);
    return redirect()->route('cart.index')->with('status', 'Your cart has been updated.');
}

    public function remove($itemId)
{
    $cart = session('cart', []);
    unset($cart[$itemId]);                  // drop that key from the array
    session(['cart' => $cart]);
    return redirect()->route('cart.index')->with('status', 'Item removed from your cart.');
}

}
