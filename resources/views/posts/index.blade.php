<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Website - Posts</title>
</head>
<body>
    <h1>All Posts</h1>

    <a href="{{ route('posts.create') }}">+ Create New Post</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <hr>

    @forelse ($posts as $post)
        <article style="margin-bottom: 20px;">
            <h2>
                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
            </h2>
            <p>{{ $post->body }}</p>

            <a href="{{ route('posts.edit', $post) }}">Edit</a>

            |

            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this post?');">
                @csrf
                @method('DELETE')
                <button type="submit" style="color: red; background: none; border: none; cursor: pointer; text-decoration: underline;">
                    Delete
                </button>
            </form>
        </article>
        <hr>
    @empty
        <p>No posts published yet.</p>
    @endforelse
</body>
</html>