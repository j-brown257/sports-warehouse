<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;    
use App\Models\ShoppingOrder;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function show()
{
    $cart = session('cart', []);

    if (empty($cart)) {
        return redirect()->route('cart.index');   // nothing to check out
    }

    $subtotal = collect($cart)->sum(fn ($line) => $line['price'] * $line['qty']);
    $shipping = 9.95;
    $total    = $subtotal + $shipping;
    $gst      = $total / 11;

    return view('checkout', compact('cart', 'subtotal', 'shipping', 'gst', 'total'));
}

public function store(Request $request)
{
    $cart = session('cart', []);
    if (empty($cart)) {
        return redirect()->route('cart.index');
    }

    // Server-side validation (also client-side in the form, but this is the final gatekeeper)
    $validated = $request->validate([
        'firstName'        => 'required|string|max:50',
        'lastName'         => 'required|string|max:50',
        'address'          => 'required|string|max:200',
        'contactNumber'    => 'required|string|max:20',
        'email'            => 'required|email|max:255',
        'creditCardNumber' => 'required|string|max:20',
        'expiryDate'       => 'required|string|max:10',
        'nameOnCard'       => 'required|string|max:50',
        'csv'              => 'required|string|max:3',
    ]);

    // Save the order + its lines together; roll back if any part fails
    $order = DB::transaction(function () use ($validated, $cart) {
        $order = ShoppingOrder::create([
            'orderDate' => now(),
            ...$validated,          // spreads the validated fields into the array
        ]);

        foreach ($cart as $line) {
            $order->items()->create([
                'itemId'   => $line['itemId'],
                'quantity' => $line['qty'],
                'price'    => $line['price'],
            ]);
        }

        return $order;
    });

    session()->forget('cart');   // empty the cart so a refresh can't re-order

    return redirect()->route('order.confirmation', $order->shoppingOrderId);

    // dd($request->all());   // TEMP — for testing that the form submits correctly
}

public function confirmation($id)
{
    $order = ShoppingOrder::with('items.item')->findOrFail($id);
    return view('confirmation', compact('order'));
}

}
