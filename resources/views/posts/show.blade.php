<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-sm text-gray-500 mb-6">Published on {{ $post->created_at->format('M d, Y') }}</p>
                
                <div class="prose max-w-none text-gray-800">
                    {!! $post->body !!}
                </div>

                <div class="mt-8">
                    <a href="{{ route('posts.index') }}" class="text-blue-600 hover:underline text-sm font-semibold">&larr; Back to Posts</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>