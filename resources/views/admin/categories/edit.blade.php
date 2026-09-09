@extends('layouts.app')

@section('title', "Edit Category: {$category->name}")

@section('content')
    <h1>Edit Category</h1>

    <article>
        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="name">Category Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required>
            @error('name')
                <p style="color: red;"><small>{{ $message }}</small></p>
            @enderror

            <p><small>Updating this name will instantly reflect across all {{ $category->posts()->count() }} post(s) currently using this category.</small></p>

            <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                <button type="submit">Update Category</button>
                <a href="{{ route('categories.index') }}" role="button" class="secondary outline">Cancel</a>
            </div>
        </form>
    </article>
@endsection