@extends('layouts.app')

@section('title', 'Manage Products — Sports Warehouse')

@section('content')
<section class="py-6 md:py-10">
    <div class="container-960">
        {{-- Insert Admin Navigation --}}
        @include('admin._nav')
        <div class="pill-heading mb-5"><h1>Products</h1></div>
        {{-- Session Messages --}}
        @if (session('success'))<div class="alert-success">{{ session('success') }}</div>@endif
        @if (session('error'))<div class="alert-error">{{ session('error') }}</div>@endif

        <div class="mb-4 flex gap-3">
            <a href="{{ route('admin.items.create') }}"
               class="inline-block px-5 py-2.5 bg-sw-blue text-white font-semibold rounded hover:bg-sw-teal transition-colors">+ New Product</a>   
        </div>
    {{-- Display Products Table with responsive design --}}
        <div class="bg-white border border-gray-300 rounded-lg overflow-hidden">
    <table class="w-full text-left">
        <thead class="hidden md:table-header-group">
            <tr class="border-b-2 border-gray-200 text-sw-grey text-sm">
                <th class="p-3">ID</th>
                <th class="p-3">Name</th>
                <th class="p-3">Category</th>
                <th class="p-3 text-right">Price</th>
                <th class="p-3">Featured</th>
                <th class="p-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr class="block md:table-row border-b border-gray-200 md:border-gray-100 p-3 md:p-0">
                    <td class="block md:table-cell md:p-3 before:content-['ID:_'] before:font-semibold before:text-sw-grey md:before:content-none">{{ $item->itemId }}</td>
                    <td class="block md:table-cell md:p-3 before:content-['Name:_'] before:font-semibold before:text-sw-grey md:before:content-none">{{ $item->itemName }}</td>
                    <td class="block md:table-cell md:p-3 before:content-['Category:_'] before:font-semibold before:text-sw-grey md:before:content-none">{{ $item->category->categoryName ?? '—' }}</td>
                    <td class="block md:table-cell md:p-3 md:text-right before:content-['Price:_'] before:font-semibold before:text-sw-grey md:before:content-none">
                        @if (!is_null($item->salePrice) && $item->salePrice > 0)
                            <span class="text-sw-orange font-semibold">${{ number_format($item->salePrice, 2) }}</span>
                        @else
                            ${{ number_format($item->price, 2) }}
                        @endif
                    </td>
                    <td class="block md:table-cell md:p-3 before:content-['Featured:_'] before:font-semibold before:text-sw-grey md:before:content-none">{{ $item->featured ? 'Yes' : 'No' }}</td>
                    <td class="block md:table-cell md:p-3 md:text-right whitespace-nowrap mt-2 md:mt-0">
                        <a href="{{ route('admin.items.edit', $item) }}" class="text-sw-blue hover:underline mr-4">Edit</a>
                        <form action="{{ route('admin.items.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr class="block md:table-row"><td class="block md:table-cell p-3 text-sw-grey" colspan="6">No products yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
    </div>
</section>
@endsection