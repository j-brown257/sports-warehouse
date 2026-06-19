@extends('layouts.app')

@section('title', $item->itemName . ' — Sports Warehouse')

@section('content')

<section class="py-6 md:py-10">
    <div class="container-960">

        {{-- Breadcrumb (Home › Category › Item name) --}}
        @if ($item->category)
            <nav class="text-sm text-sw-grey mb-4" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-sw-blue hover:underline">Home</a>
                <span class="mx-2">›</span>
                <a href="{{ route('categories.show', $item->category->slug) }}" class="hover:text-sw-blue hover:underline">{{ $item->category->categoryName }}</a>
                <span class="mx-2">›</span>
                <span class="text-gray-800">{{ $item->itemName }}</span>
            </nav>
        @endif

        {{-- Product detail card --}}
        <div class="bg-white border border-gray-200 rounded-lg p-5 md:p-8">
            <div class="md:flex md:gap-8 md:items-start">

                {{-- Photo (left column on desktop, top on mobile) --}}
                <div class="md:w-1/2 mb-6 md:mb-0">
                    <img src="{{ $item->photo_url }}"
                         alt="{{ $item->itemName }}"
                         class="w-full max-w-[400px] h-auto mx-auto">
                </div>

                {{-- Info (right column on desktop) --}}
                <div class="md:w-1/2">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">{{ $item->itemName }}</h1>

                    {{-- Price treatment --}}
                    <div class="mb-5">
                        @if (!is_null($item->salePrice) && $item->salePrice > 0)
                            <span class="text-sw-orange text-3xl font-bold">${{ number_format($item->salePrice, 2) }}</span>
                            <span class="line-through text-gray-400 text-lg ml-2">${{ number_format($item->price, 2) }}</span>
                            <span class="block text-sm text-sw-orange font-semibold mt-1">On sale!</span>
                        @else
                            <span class="text-3xl font-bold text-gray-800">${{ number_format($item->price, 2) }}</span>
                        @endif
                    </div>

                    {{-- Description --}}
                    @if ($item->description)
                        <h2 class="text-lg font-semibold text-gray-800 mb-2">Description</h2>
                        <p class="text-base text-sw-grey leading-relaxed">{{ $item->description }}</p>
                    @endif
                    <form action="{{ route('cart.add', $item->itemId) }}" method="POST" class="mt-6 flex items-end gap-3">
                    @csrf
                        <div>
                        <label for="qty" class="block mb-1 text-sm text-sw-grey">Quantity</label>
                        <input type="number" id="qty" name="qty" value="1" min="1" class="w-20 px-3 py-2 border border-gray-300 rounded text-sw-grey bg-white focus:outline-2 focus:outline-sw-blue focus:border-sw-blue">
                        </div>
                        <button type="submit" class="h-[42px] px-6 bg-sw-orange text-white font-semibold rounded hover:bg-sw-teal transition-colors">
                        <i class="fas fa-shopping-cart mr-2"></i>Add to Cart    
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- "Back to category" link --}}
        @if ($item->category)
            <div class="mt-6 text-center">
                <a href="{{ route('categories.show', $item->category->slug) }}" class="text-sw-blue hover:underline">
                    ← Back to {{ $item->category->categoryName }}
                </a>
            </div>
        @endif

    </div>
</section>

@endsection