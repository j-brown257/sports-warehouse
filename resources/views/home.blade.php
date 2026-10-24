@extends('layouts.app')

@section('title', 'Sports Warehouse — Home')

@section('content')
<h1 class="sr-only">Sports Warehouse — Home</h1>

{{-- Banner (desktop only) --}}
<div class="hidden md:block">
    <div class="container-960 py-2">
        <a href="{{ route('categories.show', 'balls') }}">
            <img src="{{ asset('assets/banner.jpg') }}" alt="Shop our range of sports balls" width="961" height="340" class="w-full h-auto block">
        </a>
    </div>
</div>

{{-- Featured products --}}
<section class="py-6 md:py-10">
    <div class="container-960">

        <div class="pill-heading mb-5">
            <h2>Featured Products</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 md:gap-5">
            @foreach ($featuredItems as $item)
                <a href="{{ route('items.show', $item->slug) }}" class="product-card block no-underline hover:shadow-md transition-shadow">
                    <img src="{{ $item->photo_url }}"
                         alt="{{ $item->itemName }}"
                         width="500" height="500"
                         class="max-w-[100px] w-full h-auto mx-auto mb-2.5">

                    <p class="m-0">
                        @if (!is_null($item->salePrice) && $item->salePrice > 0)
                            <span class="text-sw-orange-dark text-lg font-bold">${{ number_format($item->salePrice, 2) }}</span>
                            <span class="line-through text-gray-400 text-sm ml-1">${{ number_format($item->price, 2) }}</span>
                        @else
                            <span class="text-lg font-bold text-gray-800">${{ number_format($item->price, 2) }}</span>
                        @endif
                    </p>

                    <p class="text-sm text-sw-product mt-1">{{ $item->itemName }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Brands & partnerships --}}
<section class="pb-10">

{{-- Heading: full container width on desktop --}}
<div class="container-960">
    <div class="pill-heading">
        <h2>Our brands and partnerships</h2>
    </div>
</div>

{{-- Brands inner: max-w-960 --}}
<div class="max-w-[960px] mx-auto md:pr-5 md:flex md:items-center">

        <div class="md:w-[300px] md:flex-shrink-0 px-5 py-4">
            <p class="text-base text-gray-800 m-0">
                These are some of our top brands and partnerships.<br>
                <a href="#" class="text-sw-teal font-semibold no-underline hover:underline">The best of the best is here.</a>
            </p>
        </div>

        <div class="bg-sw-dark md:flex-1 px-4 py-4 md:pl-10 md:pr-2.5 md:py-5 md:rounded-l-[50px]">
            <div class="grid grid-cols-3 md:flex md:justify-between gap-4 md:gap-5 items-center">
                @foreach ([
                    ['file' => 'logo_nike.png',       'alt' => 'Nike',        'w' => 81, 'h' => 29],
                    ['file' => 'logo_adidas.png',     'alt' => 'Adidas',      'w' => 81, 'h' => 53],
                    ['file' => 'logo_skins.png',      'alt' => 'Skins',       'w' => 81, 'h' => 19],
                    ['file' => 'logo_asics.png',      'alt' => 'Asics',       'w' => 81, 'h' => 27],
                    ['file' => 'logo_newbalance.png', 'alt' => 'New Balance', 'w' => 81, 'h' => 43],
                    ['file' => 'logo_wilson.png',     'alt' => 'Wilson',      'w' => 81, 'h' => 19],
                ] as $brand)
                    <img src="{{ asset('assets/' . $brand['file']) }}"
                         alt="{{ $brand['alt'] }} logo"
                         width="{{ $brand['w'] }}" height="{{ $brand['h'] }}"
                         class="max-h-8 md:max-h-10 object-contain brightness-0 invert mx-auto md:mx-0">
                @endforeach
            </div>
        </div>
    </div>
</section>


@endsection