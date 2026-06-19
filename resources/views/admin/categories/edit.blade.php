@extends('layouts.app')

@section('title', 'Edit Category — Sports Warehouse')

@section('content')
<section class="py-6 md:py-10">
    <div class="container-960">
        @include('admin._nav')
        <div class="pill-heading mb-5"><h1>Edit Category</h1></div>

        <div class="contact-card max-w-[480px]">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')
                <label for="categoryName" class="contact-label">Name</label>
                <input type="text" id="categoryName" name="categoryName" value="{{ old('categoryName', $category->categoryName) }}" class="contact-input">
                @error('categoryName') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror

                <div class="mt-4">
                    <button type="submit" class="contact-submit">Update Category</button>
                    <a href="{{ route('admin.categories.index') }}" class="ml-3 text-sw-grey hover:underline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection