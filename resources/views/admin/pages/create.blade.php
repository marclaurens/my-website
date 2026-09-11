@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">Create New Page</h1>

    <form action="{{ route('admin.pages.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="slug">Slug (Optional)</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="leave-empty-to-auto-generate">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="content">Content</label>
            <textarea name="content" id="content">{{ old('content') }}</textarea>
        </div>

        <div class="mb-6 flex items-center space-x-6">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_published" id="is_published" value="1" checked class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded">
                <span class="text-gray-700 font-medium">Publish immediately</span>
            </label>
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_admin_only" id="is_admin_only" value="1" {{ old('is_admin_only') ? 'checked' : '' }} class="mr-2 h-4 w-4 text-purple-600 border-gray-300 rounded">
                <span class="text-gray-700 font-medium">Admin Only (Restricted)</span>
            </label>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded">Save Page</button>
        <a href="{{ route('admin.pages.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
    </form>
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="/build/assets/ckeditor-init-BA9sK04e.css">
<script type="module">
    import('{{ Vite::asset("resources/js/ckeditor-init.js") }}').then(() => {
        window.initCkEditor('#content', {
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


