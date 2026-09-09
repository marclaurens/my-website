@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <h1>Edit Post</h1>

    @if ($errors->any())
        <div style="color: var(--pico-del-color); margin-bottom: 1rem;">
            <ul>
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
        <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required>

        <label for="image">Cover Image (optional)</label>
        @if ($post->image_path)
            <div style="margin-bottom: 1rem;">
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="Current Image" style="max-height: 150px; border-radius: 4px; display: block; margin-bottom: 0.5rem;">
                <small style="color: var(--pico-muted-color);">Select a new file to replace this cover image.</small>
            </div>
        @endif
        <input type="file" id="image" name="image" accept="image/*">

        <label for="body">Content</label>
        <textarea id="body" name="body" rows="8">{{ old('body', $post->body) }}</textarea>

        <fieldset>
            <label for="is_published">
                <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                Published
            </label>
        </fieldset>

        <div class="actions">
            <button type="submit">Update Post</button>
            <a href="{{ route('home') }}" role="button" class="secondary outline">Cancel</a>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-build-classic@39.0.1/build/ckeditor.js"></script>
    <script>
        class LaravelUploadAdapter {
            constructor(loader) {
                this.loader = loader;
            }

            upload() {
                return this.loader.file.then(file => new Promise((resolve, reject) => {
                    const data = new FormData();
                    data.append('upload', file);
                    data.append('_token', '{{ csrf_token() }}');

                    fetch('{{ route("posts.upload_image") }}', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json'
                        },
                        body: data
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => {
                                throw new Error(err.message || `Upload failed with status ${response.status}`);
                            });
                        }
                        return response.json();
                    })
                    .then(result => {
                        resolve({
                            default: result.url
                        });
                    })
                    .catch(error => {
                        reject(error.message || 'Image upload failed');
                    });
                }));
            }

            abort() {}
        }

        function CustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new LaravelUploadAdapter(loader);
            };
        }

        document.addEventListener('DOMContentLoaded', function () {
            const editorElement = document.querySelector('#body');
            if (editorElement) {
                ClassicEditor
                    .create(editorElement, {
                        extraPlugins: [CustomUploadAdapterPlugin]
                    })
                    .catch(error => {
                        console.error('CKEditor Error:', error);
                    });
            }
        });
    </script>
@endsection