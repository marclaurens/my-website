@extends('layouts.app')

@section('title', isset($category) ? "Category: {$category->name}" : 'All Posts')

@section('content')
    @if (isset($category))
        <h1>Posts in "{{ $category->name }}"</h1>
        <p><a href="{{ route('home') }}">&larr; Show all posts</a></p>
    @else
        <h1>Latest Posts</h1>
    @endif

    @if ($categories->isNotEmpty())
        <nav style="margin-bottom: 2rem;">
            <strong>Categories: </strong>
            <a href="{{ route('home') }}" class="{{ !isset($category) ? 'secondary' : '' }}" style="margin-right: 0.5rem;">All</a>
            @foreach ($categories as $cat)
                <a href="{{ route('posts.category', $cat) }}" 
                   style="margin-right: 0.5rem;"
                   class="{{ isset($category) && $category->id === $cat->id ? 'secondary' : '' }}">
                   {{ $cat->name }}
                </a>
            @endforeach
        </nav>
    @endif

    @if ($posts->isEmpty())
        <p>No posts found in this category.</p>
    @else
        @foreach ($posts as $post)
            <article style="margin-bottom: 2rem;">
                @if ($post->image_path)
                    <img src="{{ Storage::url($post->image_path) }}" alt="{{ $post->title }}" class="post-cover">
                @endif

                <h2><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>

                <p>
                    <small>Posted {{ $post->created_at->diffForHumans() }}</small>
                    @if ($post->category)
                        &bull; 
                        <a href="{{ route('posts.category', $post->category) }}">
                            <mark style="font-size: 0.8rem; padding: 0.2rem 0.5rem;">{{ $post->category->name }}</mark>
                        </a>
                    @endif
                </p>

                <div class="post-body">
                    {!! Str::limit(strip_tags($post->body), 200) !!}
                </div>

                <p style="margin-top: 1rem;">
                    <a href="{{ route('posts.show', $post) }}">Read full post &rarr;</a>
                </p>

                @if (session('is_admin'))
                    <hr>
                    <div class="actions">
                        <a href="{{ route('posts.edit', $post) }}" role="button" class="secondary outline">Edit</a>

                        <form action="{{ route('posts.toggle', $post) }}" method="POST" style="margin: 0;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="contrast outline">Hide Post</button>
                        </form>

                        <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this post permanently?');" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="contrast outline">Delete</button>
                        </form>
                    </div>
                @endif
            </article>
        @endforeach
    @endif
@endsection