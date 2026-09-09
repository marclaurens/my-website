@extends('layouts.app')

@section('title', 'Draft Posts')

@section('content')
    <h1>Draft Posts</h1>

    @if ($posts->isEmpty())
        <p>No drafts available.</p>
    @else
        @foreach ($posts as $post)
            <article style="margin-bottom: 2rem;">
                @if ($post->image_path)
                    <img src="{{ Storage::url($post->image_path) }}" alt="{{ $post->title }}" class="post-cover">
                @endif

                <h2><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>

                <p><small>Created {{ $post->created_at->diffForHumans() }}</small></p>

                <div class="post-body">
                    {!! Str::limit(strip_tags($post->body), 200) !!}
                </div>

                <p style="margin-top: 1rem;">
                    <a href="{{ route('posts.show', $post) }}">Preview draft &rarr;</a>
                </p>

                <hr>

                <div class="actions">
                    <a href="{{ route('posts.edit', $post) }}" role="button" class="secondary outline">Edit</a>

                    <form action="{{ route('posts.toggle', $post) }}" method="POST" style="margin: 0;">
                        @csrf
                        @method('PATCH')
                        <button type="submit">Publish Now</button>
                    </form>

                    <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this draft permanently?');" style="margin: 0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="contrast outline">Delete</button>
                    </form>
                </div>
            </article>
        @endforeach
    @endif
@endsection