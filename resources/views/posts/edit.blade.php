@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <h1>Edit Post</h1>

    @if ($errors->any())
        <article style="border-color: red;">
            <ul style="color: red; margin: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </article>
    @endif

    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required>

        <label for="body">Body</label>
        <textarea id="body" name="body" rows="6" required>{{ old('body', $post->body) }}</textarea>

        <fieldset>
            <label>
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                Published (Uncheck to hide/save as draft)
            </label>
        </fieldset>

        <div class="actions">
            <button type="submit">Update Post</button>
            <a href="{{ route('home') }}" role="button" class="secondary outline">Cancel</a>
        </div>
    </form>
@endsection