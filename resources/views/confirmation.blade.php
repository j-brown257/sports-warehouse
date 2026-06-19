@extends('layouts.app')

@section('title', 'Order Confirmation — Sports Warehouse')

@section('content')
<section class="py-6 md:py-10">
    <div class="container-960">
        <div class="bg-white border border-gray-300 rounded-lg p-8 text-center">

            <div class="text-green-600 text-5xl mb-3"><i class="fas fa-check-circle"></i></div>
            <h1 class="text-2xl font-bold text-sw-dark mb-2">Thank you for your order!</h1>
            <p class="text-sw-grey mb-4">Please keep your order number for future reference.</p>

            <div class="inline-block bg-sw-dark text-white text-xl font-bold rounded px-6 py-3 mb-6">
                Order #{{ $order->shoppingOrderId }}
            </div>

            @php
                $subtotal = $order->items->sum(fn ($line) => $line->price * $line->quantity);
                $shipping = 9.95;
                $total    = $subtotal + $shipping;
            @endphp

            <div class="max-w-[420px] mx-auto text-left bg-gray-50 border border-gray-300 rounded-lg p-4 text-sm">
                <h2 class="text-base font-semibold mb-3">What you ordered</h2>
                @foreach ($order->items as $line)
                    <div class="flex justify-between py-1">
                        <span class="text-sw-grey">{{ $line->item->itemName ?? 'Item #' . $line->itemId }} ×{{ $line->quantity }}</span>
                        <span>${{ number_format($line->price * $line->quantity, 2) }}</span>
                    </div>
                @endforeach
                <div class="flex justify-between py-1 border-t border-gray-200 mt-2 pt-2">
                    <span class="text-sw-grey">Shipping</span><span>${{ number_format($shipping, 2) }}</span>
                </div>
                <div class="flex justify-between border-t-2 border-gray-300 mt-2 pt-2 font-bold text-base">
                    <span>Total paid</span><span>${{ number_format($total, 2) }}</span>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('home') }}"
                   class="inline-block px-6 py-2.5 bg-sw-blue text-white font-semibold rounded hover:bg-sw-orange transition-colors">
                    Continue shopping
                </a>
            </div>
        </div>
    </div>
</section>
@endsection