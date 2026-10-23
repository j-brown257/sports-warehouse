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

    // Strip spaces from the card number before validating (matches the JS check,
    // which allows "4111 1111 1111 1111" but tests the digits-only version)
    $request->merge([
        'creditCardNumber' => preg_replace('/\s+/', '', (string) $request->input('creditCardNumber')),
    ]);

    // Server-side validation — mirrors the client-side JS rules, since JS can be
    // bypassed (disabled, or the endpoint hit directly), so this is the real gatekeeper
    $validated = $request->validate([
        'firstName'        => 'required|string|max:50',
        'lastName'         => 'required|string|max:50',
        'address'          => 'required|string|max:200',
        'contactNumber'    => ['required', 'regex:/^[0-9 +()-]{6,20}$/'],
        'email'            => 'required|email|max:255',
        'creditCardNumber' => ['required', 'regex:/^[0-9]{13,16}$/'],
        'expiryDate'       => ['required', 'regex:/^(0[1-9]|1[0-2])\/[0-9]{2}$/'],
        'nameOnCard'       => 'required|string|max:50',
        'csv'              => ['required', 'regex:/^[0-9]{3}$/'],
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
