@extends('layouts.app')

@section('title', 'New Product — Sports Warehouse')

@section('content')
<section class="py-6 md:py-10">
    <div class="container-960">
        @include('admin._nav')
        <div class="pill-heading mb-5"><h1>New Product</h1></div>

        <div class="contact-card max-w-[640px]">
            <form action="{{ route('admin.items.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label for="itemName" class="contact-label">Name</label>
                <input type="text" id="itemName" name="itemName" value="{{ old('itemName') }}" class="contact-input">
                @error('itemName') <p class="text-red-600 text-sm mt-1 mb-2">{{ $message }}</p> @enderror

                <label for="categoryId" class="contact-label mt-3">Category</label>
                <select id="categoryId" name="categoryId" class="contact-input">
                    <option value="">-- Select a category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->categoryId }}" @selected(old('categoryId') == $category->categoryId)>
                            {{ $category->categoryName }}
                        </option>
                    @endforeach
                </select>
                @error('categoryId') <p class="text-red-600 text-sm mt-1 mb-2">{{ $message }}</p> @enderror

                <div class="flex gap-4">
                    <div class="flex-1">
                        <label for="price" class="contact-label mt-3">Price ($)</label>
                        <input type="number" step="0.01" min="0" id="price" name="price" value="{{ old('price', 0) }}" class="contact-input">
                        @error('price') <p class="text-red-600 text-sm mt-1 mb-2">{{ $message }}</p> @enderror
                    </div>
                    <div class="flex-1">
                        <label for="salePrice" class="contact-label mt-3">Sale price ($) — optional</label>
                        <input type="number" step="0.01" min="0" id="salePrice" name="salePrice" value="{{ old('salePrice') }}" class="contact-input">
                        @error('salePrice') <p class="text-red-600 text-sm mt-1 mb-2">{{ $message }}</p> @enderror
                    </div>
                </div>

                <label for="description" class="contact-label mt-3">Description</label>
                <textarea id="description" name="description" rows="4" class="contact-input resize-y">{{ old('description') }}</textarea>

                <label class="contact-label mt-3">Photo</label>
                <img id="imagePreview" src="{{ asset('assets/placeholder-image.png') }}" alt="Product photo preview" class="w-28 h-28 object-contain border border-gray-300 rounded mb-2 bg-white">
                <button type="button" id="removePhotoBtn" class="mt-2 text-sm text-red-600 hover:underline">Clear selection</button>
                <input type="file" name="photo" id="imageInput" accept="image/*" class="block w-full text-sm text-sw-grey border border-gray-300 rounded cursor-pointer
                 file:mr-4 file:py-2.5 file:px-4 file:border-0 file:cursor-pointer
                 file:bg-sw-teal file:text-white file:font-semibold hover:file:bg-sw-orange">
                @error('photo') <p class="text-red-600 text-sm mt-1 mb-2">{{ $message }}</p> @enderror
                <label class="inline-flex items-center mt-3">
                    <input type="checkbox" name="featured" value="1" @checked(old('featured')) class="mr-2"> Featured on homepage
                </label>

                <div class="mt-5">
                    <button type="submit" class="contact-submit">Create Product</button>
                    <a href="{{ route('admin.items.index') }}" class="ml-3 text-sw-grey hover:underline">Cancel</a>
                </div>

<script>
                document.addEventListener('DOMContentLoaded', function () {
                const input = document.getElementById('imageInput');
                const preview = document.getElementById('imagePreview');
                const removeBtn = document.getElementById('removePhotoBtn');
                const placeholder = "{{ asset('assets/placeholder-image.png') }}";

                 input.addEventListener('change', function () {
                 if (this.files[0]) preview.src = URL.createObjectURL(this.files[0]);
             });

                removeBtn.addEventListener('click', function () {
                input.value = '';            // clear the chosen file
                preview.src = placeholder;   // back to placeholder
             });
    });
</script>
            </form>
        </div>
    </div>
</section>
@endsection