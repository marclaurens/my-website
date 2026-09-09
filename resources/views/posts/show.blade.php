@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <p><a href="{{ route('home') }}">&larr; Back to all posts</a></p>

    <article>
        <header>
            <h1>{{ $post->title }}</h1>
            <p style="margin-bottom: 0;">
                <small style="color: var(--pico-muted-color);">
                    Posted on {{ $post->created_at->format('F j, Y \a\t g:i A') }} &bull; Status: {{ $post->is_published ? 'Published' : 'Hidden / Draft' }}
                </small>
            </p>
        </header>

        <div>
            {!! nl2br(e($post->body)) !!}
        </div>

        <footer>
            <div class="actions">
                <a href="{{ route('posts.edit', $post) }}" role="button" class="outline">Edit Post</a>

                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="outline secondary">Delete Post</button>
                </form>
            </div>
        </footer>
    </article>
@endsection