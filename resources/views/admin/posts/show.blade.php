@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-6 max-w-4xl">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">{{ $post->title }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.posts.edit', $post) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded">Edit</a>
            <a href="{{ route('admin.posts.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-4 py-2 rounded">Back</a>
        </div>
    </div>

    @if ($post->image_path)
        <img src="{{ Storage::url($post->image_path) }}" alt="{{ $post->title }}" class="w-full h-auto rounded border mb-4">
    @endif

    <div class="bg-white shadow rounded p-6">
        <p class="text-sm text-gray-500 mb-4">
            @if ($post->category)
                <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded mr-2">{{ $post->category->name }}</span>
            @endif
            @if ($post->is_published)
                <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded mr-2">Published</span>
            @else
                <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded mr-2">Draft</span>
            @endif
            Created {{ $post->created_at->format('F j, Y') }}
        </p>

        <div class="prose max-w-none text-gray-800">
            {!! $post->body !!}
        </div>
    </div>
</div>
@endsection
