@extends('layouts.app')

@section('title', ($q !== '' ? 'Search: ' . $q : 'Search') . ' — Sports Warehouse')

@section('content')

<section class="py-6 md:py-10">
    <div class="container-960">

        {{-- Pill heading --}}
        <div class="pill-heading mb-5">
            <h2>
                @if ($q !== '')
                    Search results for "{{ $q }}"
                @else
                    Search products
                @endif
            </h2>
        </div>

        @if ($q === '')

            {{-- Case 1: User visited /search with no query --}}
            <div class="text-center py-12 text-sw-grey">
                <p class="text-lg">Use the search bar at the top of the page to find products by name.</p>
                <p class="mt-2">
                    Or <a href="{{ route('products.index') }}" class="text-sw-blue hover:underline">browse all products</a>.
                </p>
            </div>

        @elseif ($items->isEmpty())

            {{-- Case 2: Search ran but returned no matches --}}
            <div class="text-center py-12 text-sw-grey">
                <p class="text-lg font-semibold text-gray-800">No results to display.</p>
                <p class="mt-2">We couldn't find any products matching <strong>"{{ $q }}"</strong>.</p>
                <p class="mt-2">
                    Try a different search term, or
                    <a href="{{ route('products.index') }}" class="text-sw-blue hover:underline">browse all products</a>.
                </p>
            </div>

        @else

            {{-- Case 3: Show the matching items --}}
            <p class="text-sw-grey mb-5">
                Found {{ $items->count() }} {{ $items->count() === 1 ? 'product' : 'products' }} matching <strong>"{{ $q }}"</strong>.
            </p>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 md:gap-5">
                @foreach ($items as $item)
                        <a href="{{ route('items.show', $item->slug) }}" class="product-card block no-underline hover:shadow-md transition-shadow">
                        <img src="{{ asset('assets/' . $item->photo_url) }}" alt="{{ $item->itemName }}"
                             width="500" height="500"
                             class="max-w-[100px] w-full h-auto mx-auto mb-2.5">

                        <p class="m-0">
                            @if (!is_null($item->salePrice) && $item->salePrice > 0)
                                <span class="text-sw-orange text-lg font-bold">${{ number_format($item->salePrice, 2) }}</span>
                                <span class="line-through text-gray-400 text-sm ml-1">${{ number_format($item->price, 2) }}</span>
                            @else
                                <span class="text-lg font-bold text-gray-800">${{ number_format($item->price, 2) }}</span>
                            @endif
                        </p>

                        <p class="text-sm text-sw-product mt-1">{{ $item->itemName }}</p>
                    </a>
                @endforeach
            </div>

        @endif

    </div>
</section>

@endsection