@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <article>
        @if ($post->image_path)
            <img src="{{ Storage::url($post->image_path) }}" alt="{{ $post->title }}" class="post-cover" style="margin-bottom: 1.5rem;">
        @endif

        <h1>{{ $post->title }}</h1>

        <p>
            <small>Published {{ $post->created_at->format('F j, Y') }}</small>
            @if ($post->category)
                &bull; <mark style="font-size: 0.8rem; padding: 0.2rem 0.5rem;">{{ $post->category->name }}</mark>
            @endif
        </p>

        <div class="post-content">
            {!! $post->body !!}
        </div>

        @if (session('is_admin'))
            <hr>
            <div class="actions">
                <a href="{{ route('posts.edit', $post) }}" role="button" class="secondary outline">Edit</a>

                <form action="{{ route('posts.toggle', $post) }}" method="POST" style="margin: 0;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="contrast outline">{{ $post->is_published ? 'Hide Post' : 'Publish Post' }}</button>
                </form>

                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this post permanently?');" style="margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="contrast outline">Delete</button>
                </form>
            </div>
        @endif
    </article>
@endsection