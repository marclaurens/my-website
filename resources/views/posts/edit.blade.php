<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="title">Title</label><br>
            <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required>
        </div>

        <br>

        <div>
            <label for="body">Body</label><br>
            <textarea id="body" name="body" rows="6" required>{{ old('body', $post->body) }}</textarea>
        </div>

        <br>

        <div>
            <label>
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                Published (Uncheck to hide/save as draft)
            </label>
        </div>

        <br>

        <button type="submit">Update Post</button>
        <a href="{{ route('home') }}">Cancel</a>
    </form>
</body>
</html>