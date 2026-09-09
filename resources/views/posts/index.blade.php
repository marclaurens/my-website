@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
        <h1 style="margin: 0;">All Posts</h1>
        
        @if(session('is_admin'))
            <a href="{{ route('posts.drafts') }}" role="button" class="secondary outline">
                View Drafts / Hidden Posts &rarr;
            </a>
        @endif
    </div>

    @forelse ($posts as $post)
        <article>
            <header>
                <h2 style="margin-bottom: 0.25rem;">
                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                </h2>
                <small style="color: var(--pico-muted-color);">
                    Posted on {{ $post->created_at->format('F j, Y') }} ({{ $post->created_at->diffForHumans() }})
                    @if ($post->created_at->ne($post->updated_at))
                        &bull; <strong>Updated {{ $post->updated_at->diffForHumans() }}</strong>
                    @endif
                </small>
            </header>

            @if ($post->image_path)
                <div style="margin-bottom: 1rem;">
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" style="width: 100%; max-height: 400px; object-fit: cover; border-radius: 0.375rem;">
                </div>
            @endif

            <div>
                {!! Illuminate\Support\Str::markdown($post->body) !!}
            </div>

            @if(session('is_admin'))
                <footer>
                    <div class="actions">
                        <form action="{{ route('posts.toggle', $post) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="secondary outline">Hide Post</button>
                        </form>

                        <a href="{{ route('posts.edit', $post) }}" role="button" class="outline">Edit</a>

                        <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="outline secondary">Delete</button>
                        </form>
                    </div>
                </footer>
            @endif
        </article>
    @empty
        <article>
            <p>No published posts yet.</p>
        </article>
    @endforelse
@endsection