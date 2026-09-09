@extends('layouts.app')

@section('title', 'Manage Categories')

@section('content')
    <h1>Manage Categories</h1>

    <article style="margin-bottom: 2rem;">
        <h3>Create New Category</h3>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div style="display: flex; gap: 1rem; align-items: flex-end;">
                <div style="flex: 1; margin-bottom: 0;">
                    <label for="name">Category Name</label>
                    <input type="text" id="name" name="name" placeholder="e.g. Technology, Tutorials..." value="{{ old('name') }}" required>
                </div>
                <button type="submit" style="width: auto; margin-bottom: 0;">Add Category</button>
            </div>
            @error('name')
                <p style="color: red;"><small>{{ $message }}</small></p>
            @enderror
        </form>
    </article>

    <h2>Existing Categories</h2>

    @if ($categories->isEmpty())
        <p>No categories found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Total Posts</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td><strong>{{ $category->name }}</strong></td>
                        <td><code>{{ $category->slug }}</code></td>
                        <td>{{ $category->posts_count }} {{ Str::plural('post', $category->posts_count) }}</td>
                        <td style="text-align: right;">
                            <div style="display: inline-flex; gap: 0.5rem; justify-content: flex-end;">
                                <a href="{{ route('categories.edit', $category) }}" role="button" class="secondary outline" style="padding: 0.25rem 0.5rem; font-size: 0.85rem;">Edit</a>

                                <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category? Posts will become uncategorized.');" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="contrast outline" style="padding: 0.25rem 0.5rem; font-size: 0.85rem;">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection