<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($category) ? 'Category: ' . $category->name : __('Blog Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Category Filter Bar -->
            @if(isset($categories) && $categories->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 mb-6 flex flex-wrap gap-2">
                    <a href="{{ route('posts.index') }}" class="px-3 py-1 rounded text-sm font-medium {{ !isset($category) ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        All Posts
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('categories.show', $cat->slug) }}" class="px-3 py-1 rounded text-sm font-medium {{ (isset($category) && $category->id === $cat->id) ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @forelse($posts as $post)
                    @php
                        $slug = $post->slug ?? Str::slug($post->title);
                    @endphp
                    <div class="mb-6 pb-6 border-b border-gray-200 last:border-b-0 last:mb-0 last:pb-0">
                        
                        <!-- Clickable Category Badge -->
                        @if($post->category)
                            <a href="{{ route('categories.show', $post->category->slug) }}" class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded mb-2 hover:bg-blue-200">
                                {{ $post->category->name }}
                            </a>
                        @endif

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
                    <p class="text-gray-500">No posts available in this category yet.</p>
                @endforelse

                <div class="mt-6">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>