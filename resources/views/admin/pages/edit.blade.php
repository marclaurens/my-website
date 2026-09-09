@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">Edit Page</h1>

    <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $page->title) }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="slug">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $page->slug) }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="content">Content</label>
            <textarea name="content" id="content">{{ old('content', $page->content) }}</textarea>
        </div>

        <div class="mb-6 flex items-center">
            <input type="checkbox" name="is_published" id="is_published" value="1" {{ $page->is_published ? 'checked' : '' }} class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded">
            <label for="is_published" class="text-gray-700 font-medium">Published</label>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded">Update Page</button>
        <a href="{{ route('admin.pages.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
    </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#content'), {
            htmlSupport: {
                allow: [{ name: /.*/, attributes: true, classes: true, styles: true }]
            },
            toolbar: [
                'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 
                '|', 'sourceEditing', 'blockQuote', 'insertTable', 'undo', 'redo'
            ]
        })
        .catch(error => console.error(error));
</script>
@endsection