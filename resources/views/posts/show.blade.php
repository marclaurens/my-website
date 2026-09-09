<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <!-- Category Badge & Date -->
                <div class="flex items-center space-x-3 mb-6">
                    @if($post->category)
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                            {{ $post->category->name }}
                        </span>
                    @endif
                    <p class="text-sm text-gray-500">Published on {{ $post->created_at->format('M d, Y') }}</p>
                </div>
                
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