<x-admin-layout>
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">Create New Post</h1>

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="category_id">Category</label>
            <select name="category_id" id="category_id" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- None --</option>
                @foreach($categories ?? [] as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="new_category">Or create a new category (optional)</label>
            <input type="text" name="new_category" id="new_category" value="{{ old('new_category') }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Leave blank to use the dropdown above">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="body">Content</label>
            <textarea name="body" id="body">{{ old('body') }}</textarea>
            @error('body')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="image">Featured Image (optional)</label>
            <input type="file" name="image" id="image" accept="image/*" class="w-full text-sm text-gray-500">
            @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6 flex items-center space-x-6">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded">
                <span class="text-gray-700 font-medium">Publish immediately</span>
            </label>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded">Save Post</button>
        <a href="{{ route('admin.posts.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
    </form>
</div>

    @push('scripts')
<link rel="stylesheet" href="/build/assets/ckeditor-init-BA9sK04e.css">
        @php
            $pagesForEditor = \App\Models\Page::orderBy('title')->get()->map(function ($p) {
                return ['title' => $p->title, 'slug' => $p->slug, 'url' => '/page/' . $p->slug, 'published' => (bool) $p->is_published];
            })->values()->all();
        @endphp
<script type="module">
    import('{{ Vite::asset("resources/js/ckeditor-init.js") }}').then(() => {
        window.initCkEditor('#body', {
            pages: @json($pagesForEditor),
            simpleUpload: {
                uploadUrl: '{{ route("admin.posts.upload_image") }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        }).catch(err => console.error('[CKEditor] init failed', err));
    }).catch(err => console.error('[CKEditor] module load failed', err));
</script>
@endpush
</x-admin-layout>
