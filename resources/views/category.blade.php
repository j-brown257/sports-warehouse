@extends('layouts.app')

@section('title', $category->categoryName . ' — Sports Warehouse')

@section('content')

<section class="py-6 md:py-10">
    <div class="container-960">

        {{-- Pill heading shows the current category name --}}
        <div class="pill-heading mb-5">
            <h2>{{ $category->categoryName }}</h2>
        </div>

        @if ($items->isEmpty())

            {{-- Empty state: this category has no products yet (our Sale test case) --}}
            <div class="text-center py-12 text-sw-grey">
                <p class="text-lg">There are no products in this category yet.</p>
                <p class="mt-2">
                    Please check back soon, or
                    <a href="{{ route('home') }}" class="text-sw-blue hover:underline">browse our home page</a>.
                </p>
            </div>

        @else

            {{-- Product grid: 2 cols mobile, 5 cols desktop (matching home featured) --}}
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 md:gap-5">
                    @foreach ($items as $item)
                        <a href="{{ route('items.show', $item->slug) }}" class="product-card block no-underline hover:shadow-md transition-shadow">
                        <img src="{{ $item->photo_url }}"
                             alt="{{ $item->itemName }}"
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