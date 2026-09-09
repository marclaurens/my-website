@extends('layouts.app')

@section('title', 'Hidden / Draft Posts')

@section('content')
    <h1>Hidden / Draft Posts</h1>

    @forelse ($posts as $post)
        <article>
            <header>
                <h2 style="margin-bottom: 0.25rem;">
                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                </h2>
                <small style="color: var(--pico-muted-color);">
                    Created on {{ $post->created_at->format('F j, Y') }} ({{ $post->created_at->diffForHumans() }})
                    @if ($post->created_at->ne($post->updated_at))
                        &bull; <strong>Updated {{ $post->updated_at->diffForHumans() }}</strong>
                    @endif
                    &bull; <mark>Hidden / Draft</mark>
                </small>
            </header>

            <p>{{ $post->body }}</p>

            <footer>
                <div class="actions">
                    <form action="{{ route('posts.toggle', $post) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit">Publish Now</button>
                    </form>

                    <a href="{{ route('posts.edit', $post) }}" role="button" class="outline">Edit</a>

                    <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this draft?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="outline secondary">Delete</button>
                    </form>
                </div>
            </footer>
        </article>
    @empty
        <article>
            <p>No hidden or draft posts found.</p>
        </article>
    @endforelse
@endsection