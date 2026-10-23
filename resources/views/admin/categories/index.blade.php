@extends('layouts.app')

@section('title', 'Manage Categories — Sports Warehouse')

@section('content')
<section class="py-6 md:py-10">
    <div class="container-960">
        @include('admin._nav')
        <div class="pill-heading mb-5"><h1>Categories</h1></div>

        @if (session('success'))<div class="alert-success">{{ session('success') }}</div>@endif
        @if (session('error'))<div class="alert-error">{{ session('error') }}</div>@endif

        <div class="mb-4">
            <a href="{{ route('admin.categories.create') }}"
               class="inline-block px-5 py-2.5 bg-sw-blue text-white font-semibold rounded hover:bg-sw-teal transition-colors">+ New Category</a>
        </div>

        <div class="bg-white border border-gray-300 rounded-lg overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b-2 border-gray-200 text-sw-grey text-sm">
                        <th class="p-3">ID</th>
                        <th class="p-3">Name</th>
                        <th class="p-3"># Items</th>
                        <th class="p-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr class="border-b border-gray-100">
                            <td class="p-3">{{ $category->categoryId }}</td>
                            <td class="p-3">{{ $category->categoryName }}</td>
                            <td class="p-3">{{ $category->items()->count() }}</td>
                            <td class="p-3 text-right whitespace-nowrap">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="text-sw-teal hover:underline mr-4">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="p-3 text-sw-grey">No categories yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection