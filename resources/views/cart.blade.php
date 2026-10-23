@extends('layouts.app')

@section('title', 'Your Shopping Cart — Sports Warehouse')

@section('content')
<section class="py-6 md:py-10">
    <div class="container-960">

        <div class="pill-heading mb-5">
            <h1>Your Shopping Cart</h1>
        </div>

        @if (session('status'))
            <div class="alert-success">{{ session('status') }}</div>
        @endif

        @if (empty($cart))
            <div class="bg-white border border-gray-300 rounded-lg p-8 text-center">
                <p class="text-lg text-sw-grey mb-4">Your cart is empty.</p>
                <a href="{{ route('products.index') }}"
                   class="inline-block px-6 py-2.5 bg-sw-orange text-white font-semibold rounded hover:bg-sw-teal transition-colors">
                    Browse products
                </a>
            </div>
        @else
            {{-- One form updates every quantity at once --}}
            <form action="{{ route('cart.update') }}" method="POST">
                @csrf
                @method('PATCH')
                {{-- Cart items --}}
                <div class="bg-white border border-gray-300 rounded-lg overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b-2 border-gray-200 text-sw-grey text-sm">
                                <th class="p-3" colspan="2">Item</th>
                                <th class="p-3">Qty</th>
                                <th class="p-3 text-right">Price</th>
                                <th class="p-3 text-right">Line total</th>
                                <th class="p-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Cart items --}}
                            @foreach ($cart as $line)
                                <tr class="border-b border-gray-100">
                                    <td class="p-3 w-[70px]">
                                        <img src="{{ asset('assets/' . $line['photo']) }}" alt="{{ $line['name'] }}" width="500" height="500" class="w-14 h-14 object-contain" onerror="this.src='{{ asset('assets/placeholder-image.png') }}'">
                                    </td>
                                    <td class="p-3">
                                        <a href="{{ route('items.show', $line['slug']) }}"
                                           class="text-sw-product hover:underline">{{ $line['name'] }}</a>
                                    </td>
                                    <td class="p-3">
                                        <input type="number" name="qty[{{ $line['itemId'] }}]"
                                               value="{{ $line['qty'] }}" min="0"
                                               class="w-16 px-2 py-1.5 border border-gray-300 rounded text-sw-grey">
                                    </td>
                                    <td class="p-3 text-right">${{ number_format($line['price'], 2) }}</td>
                                    <td class="p-3 text-right font-semibold">${{ number_format($line['price'] * $line['qty'], 2) }}</td>
                                    <td class="p-3 text-center">
                                        <button type="submit" form="remove-{{ $line['itemId'] }}"
                                                class="text-red-600 hover:text-red-800 font-bold"
                                                title="Remove">✕</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Totals: Subtotal / Shipping / GST / TOTAL (as per wireframe) --}}
                <div class="flex justify-end mt-5">
                    <div class="w-full md:w-[320px] bg-gray-50 border border-gray-300 rounded-lg p-4 text-sm">
                        <div class="flex justify-between py-1">
                            <span class="text-sw-grey">Subtotal</span><span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between py-1">
                            <span class="text-sw-grey">Shipping</span><span>${{ number_format($shipping, 2) }}</span>
                        </div>
                        <div class="flex justify-between py-1 text-sw-grey italic">
                            <span>GST (included)</span><span>${{ number_format($gst, 2) }}</span>
                        </div>
                        <div class="flex justify-between border-t-2 border-gray-300 mt-2 pt-2 font-bold text-base">
                            <span>TOTAL</span><span>${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
                {{-- Action buttons --}}
                <div class="flex flex-col md:flex-row justify-between gap-3 mt-5">
                    <a href="{{ route('products.index') }}" class="text-center px-6 py-2.5 bg-white border border-sw-blue text-sw-blue font-semibold rounded hover:bg-sw-blue hover:text-white transition-colors">
                    ← Continue Shopping
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-white border border-gray-400 text-sw-grey font-semibold rounded hover:bg-gray-100 transition-colors">
                    Update cart
                    </button>
                    <a href="{{ route('checkout.show') }}" class="text-center px-6 py-2.5 bg-sw-orange text-white font-semibold rounded hover:bg-sw-teal transition-colors">
                    Checkout →
                    </a>
                </div>
            </form>
            {{-- Remove forms  --}}
            @foreach ($cart as $line)
                <form id="remove-{{ $line['itemId'] }}" action="{{ route('cart.remove', $line['itemId']) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
        @endif

    </div>
</section>
@endsection