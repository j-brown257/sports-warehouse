@extends('layouts.app')

@section('title', 'Edit Product — Sports Warehouse')

@section('content')
<section class="py-6 md:py-10">
    <div class="container-960">
        @include('admin._nav')
        <div class="pill-heading mb-5"><h1>Edit Product</h1></div>

        <div class="contact-card max-w-[640px]">
            <form action="{{ route('admin.items.update', $item) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label for="itemName" class="contact-label">Name</label>
                <input type="text" id="itemName" name="itemName" value="{{ old('itemName', $item->itemName) }}" class="contact-input">
                @error('itemName') <p class="text-red-600 text-sm mt-1 mb-2">{{ $message }}</p> @enderror

                <label for="categoryId" class="contact-label mt-3">Category</label>
                <select id="categoryId" name="categoryId" class="contact-input">
                    <option value="">-- Select a category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->categoryId }}" @selected(old('categoryId', $item->categoryId) == $category->categoryId)>
                            {{ $category->categoryName }}
                        </option>
                    @endforeach
                </select>
                @error('categoryId') <p class="text-red-600 text-sm mt-1 mb-2">{{ $message }}</p> @enderror

                <div class="flex gap-4">
                    <div class="flex-1">
                        <label for="price" class="contact-label mt-3">Price ($)</label>
                        <input type="number" step="0.01" min="0" id="price" name="price" value="{{ old('price', $item->price) }}" class="contact-input">
                        @error('price') <p class="text-red-600 text-sm mt-1 mb-2">{{ $message }}</p> @enderror
                    </div>
                    <div class="flex-1">
                        <label for="salePrice" class="contact-label mt-3">Sale price ($) — optional</label>
                        <input type="number" step="0.01" min="0" id="salePrice" name="salePrice" value="{{ old('salePrice', $item->salePrice) }}" class="contact-input">
                        @error('salePrice') <p class="text-red-600 text-sm mt-1 mb-2">{{ $message }}</p> @enderror
                    </div>
                </div>

                <label for="description" class="contact-label mt-3">Description</label>
                <textarea id="description" name="description" rows="4" class="contact-input resize-y">{{ old('description', $item->description) }}</textarea>

                <label class="contact-label mt-3">Photo</label>
                <img id="imagePreview" src="{{ $item->photo_url }}" alt="{{ $item->itemName }}" class="h-28 object-contain border rounded mb-2">
                <input type="file" name="photo" id="imageInput" accept="image/*" class="block w-full text-sm text-sw-grey border border-gray-300 rounded cursor-pointer
                 file:mr-4 file:py-2.5 file:px-4 file:border-0 file:cursor-pointer
                 file:bg-sw-teal file:text-white file:font-semibold hover:file:bg-sw-orange">
                <p class="text-xs text-sw-grey mb-1">Leave empty to keep the current photo.</p>
                @error('photo') <p class="text-red-600 text-sm mt-1 mb-2">{{ $message }}</p> @enderror

                <label class="inline-flex items-center mt-3">
                    <input type="checkbox" name="featured" value="1" @checked(old('featured', $item->featured)) class="mr-2"> Featured on homepage
                </label>
                <input type="hidden" name="remove_photo" id="removePhoto" value="0">
<button type="button" id="removePhotoBtn" class="mt-2 text-sm text-red-600 hover:underline">Remove photo</button>
                <div class="mt-5">
                    <button type="submit" class="contact-submit">Update Product</button>
                    <a href="{{ route('admin.items.index') }}" class="ml-3 text-sw-grey hover:underline">Cancel</a>
                </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('imageInput');
    const preview = document.getElementById('imagePreview');
    const removeFlag = document.getElementById('removePhoto');
    const removeBtn = document.getElementById('removePhotoBtn');
    const placeholder = "{{ asset('assets/placeholder-image.png') }}";

    input.addEventListener('change', function () {
        if (this.files[0]) {
            preview.src = URL.createObjectURL(this.files[0]);
            removeFlag.value = '0';      // choosing a file means "not removing"
        }
    });

    removeBtn.addEventListener('click', function () {
        input.value = '';               // clear any chosen file
        preview.src = placeholder;      // show placeholder
        removeFlag.value = '1';         // tell the server to clear the saved photo
    });
});
</script>
            </form>
        </div>
    </div>
</section>
@endsection