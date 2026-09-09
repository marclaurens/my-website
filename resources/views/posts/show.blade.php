<!DOCTYPE html>
<html>
<head>
    <title>{{ $post->title }}</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 700px; margin: 40px auto; padding: 0 20px; line-height: 1.6; }
        small { color: #888; }
    </style>
</head>
<body>
    <p><a href="/">← Back to all posts</a></p>
    <h1>{{ $post->title }}</h1>
    <small>{{ $post->created_at->format('d M Y') }}</small>
    <p>{!! nl2br(e($post->body)) !!}</p>
</body>
</html><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $post->title }}</title>
</head>
<body>
    <a href="{{ route('home') }}">&larr; Back to all posts</a>

    <article style="margin-top: 20px;">
        <h1>{{ $post->title }}</h1>
        <p><em>Status: {{ $post->is_published ? 'Published' : 'Hidden / Draft' }}</em></p>
        <hr>
        <div>
            {!! nl2br(e($post->body)) !!}
        </div>
    </article>

    <br><hr>

    <a href="{{ route('posts.edit', $post) }}">Edit Post</a>

    |

    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this post?');">
        @csrf
        @method('DELETE')
        <button type="submit" style="color: red; background: none; border: none; cursor: pointer; text-decoration: underline;">
            Delete Post
        </button>
    </form>
</body>
</html>