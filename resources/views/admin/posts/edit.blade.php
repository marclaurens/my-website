<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($errors->any())
                    <div style="background-color: #f8d7da; color: #721c24; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem;">
                        <ul style="margin: 0; padding-left: 1.2rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="title" class="block font-medium text-sm text-gray-700">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; align-items: end;">
                        <div>
                            <label for="category_id" class="block font-medium text-sm text-gray-700">Select Category</label>
                            <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Select Existing --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="new_category" class="block font-medium text-sm text-gray-700">Or Create New Category</label>
                            <input type="text" name="new_category" id="new_category" value="{{ old('new_category') }}" placeholder="e.g. Tutorials" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    <div>
                        <label for="image" class="block font-medium text-sm text-gray-700">Cover Image</label>
                        @if ($post->image_path)
                            <div style="margin-bottom: 1rem;">
                                <img src="{{ Storage::url($post->image_path) }}" alt="Current Cover" style="max-height: 150px; display: block; margin-bottom: 0.5rem;" class="rounded border">
                                <small class="text-gray-500">Current cover image</small>
                            </div>
                        @endif
                        <input type="file" name="image" id="image" accept="image/*" class="mt-1 block w-full">
                    </div>

                    <div>
                        <label for="body" class="block font-medium text-sm text-gray-700">Content</label>
                        <textarea name="body" id="editor">{{ old('body', $post->body) }}</textarea>
                    </div>

                    <fieldset>
                        <label for="is_published" class="inline-flex items-center">
                            <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm">
                            <span class="ml-2 text-sm text-gray-600">Published</span>
                        </label>
                    </fieldset>

                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md text-sm font-semibold hover:bg-blue-600">Update Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

                        fetch('{{ route("admin.posts.upload_image") }}', {
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
</x-app-layout>