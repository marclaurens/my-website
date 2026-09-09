@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    <h1>All Posts</h1>

    @forelse ($posts as $post)
        <article>
            <header>
                <h2 style="margin-bottom: 0.25rem;">
                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                </h2>
                <small style="color: var(--pico-muted-color);">
                    Posted on {{ $post->created_at->format('F j, Y') }} ({{ $post->created_at->diffForHumans() }})
                </small>
            </header>

            <p>{{ $post->body }}</p>

            <footer>
                <div class="actions">
                    <a href="{{ route('posts.edit', $post) }}" role="button" class="outline">Edit</a>

                    <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="outline secondary">Delete</button>
                    </form>
                </div>
            </footer>
        </article>
    @empty
        <article>
            <p>No published posts yet.</p>
        </article>
    @endforelse
@endsection