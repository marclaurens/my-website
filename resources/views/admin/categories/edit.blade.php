@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-6 max-w-2xl">
    <h1 class="text-2xl font-bold mb-6">Edit Category</h1>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="name">Category Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="slug">Slug (optional)</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <p class="text-xs text-gray-500 mt-1">Leave blank to auto-generate from the name.</p>
            @error('slug')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <p class="text-sm text-gray-500 mb-6">Updating this name will affect all {{ $category->posts()->count() }} post(s) using this category.</p>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded">Update Category</button>
        <a href="{{ route('admin.categories.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
    </form>
</div>
@endsection
