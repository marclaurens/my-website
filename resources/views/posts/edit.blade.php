@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <h1>Edit Post</h1>

    @if ($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem;">
            <ul style="margin: 0; padding-left: 1.2rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; align-items: end; margin-bottom: 1rem;">
            <div>
                <label for="category_id">Select Category</label>
                <select name="category_id" id="category_id">
                    <option value="">-- Select Existing --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="new_category">Or Create New Category</label>
                <input type="text" name="new_category" id="new_category" value="{{ old('new_category') }}" placeholder="e.g. Tutorials">
            </div>
        </div>

        <label for="image">Cover Image</label>
        @if ($post->image_path)
            <div style="margin-bottom: 1rem;">
                <img src="{{ Storage::url($post->image_path) }}" alt="Current Cover" style="max-height: 150px; display: block; margin-bottom: 0.5rem;">
                <small>Current cover image</small>
            </div>
        @endif
        <input type="file" name="image" id="image" accept="image/*">

        <label for="body">Content</label>
        <textarea name="body" id="editor">{{ old('body', $post->body) }}</textarea>

        <fieldset>
            <label for="is_published">
                <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                Published
            </label>
        </fieldset>

        <button type="submit">Update Post</button>
    </form>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        class LaravelUploadAdapter {
            constructor(loader) {
                this.loader = loader;
            }

            upload() {
                return this.loader.file
                    .then(file => new Promise((resolve, reject) => {
                        const data = new FormData();
                        data.append('upload', file);
                        data.append('_token', '{{ csrf_token() }}');

                        fetch('{{ route("posts.upload_image") }}', {
                            method: 'POST',
                            body: data,
                            headers: {
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(result => {
                            if (result.url) {
                                resolve({ default: result.url });
                            } else {
                                reject(result.error ? result.error.message : 'Upload failed');
                            }
                        })
                        .catch(error => reject(error));
                    }));
            }

            abort() {}
        }

        function LaravelUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new LaravelUploadAdapter(loader);
            };
        }

        ClassicEditor
            .create(document.querySelector('#editor'), {
                extraPlugins: [LaravelUploadAdapterPlugin],
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection