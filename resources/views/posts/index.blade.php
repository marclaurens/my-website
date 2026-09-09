<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @forelse($posts as $post)
                    @php
                        $slug = $post->slug ?? Str::slug($post->title);
                    @endphp
                    <div class="mb-6 pb-6 border-b border-gray-200 last:border-b-0 last:mb-0 last:pb-0">
                        <h3 class="text-xl font-bold text-gray-900">
                            <a href="{{ route('posts.show', $slug) }}" class="hover:text-blue-600">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">Published on {{ $post->created_at->format('M d, Y') }}</p>
                        <div class="mt-2 text-gray-700">
                            {!! Str::limit(strip_tags($post->body), 200) !!}
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('posts.show', $slug) }}" class="text-blue-600 hover:underline text-sm font-semibold">Read More &rarr;</a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No posts available yet.</p>
                @endforelse

                <div class="mt-6">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>