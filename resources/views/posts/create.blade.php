@extends('layouts.app')

@section('title', 'Create New Post')

@section('content')
    <h1>Create New Post</h1>

    @if ($errors->any())
        <article style="border-color: red;">
            <ul style="color: red; margin: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </article>
    @endif

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" required>

        <label for="body">Body</label>
        <textarea id="body" name="body" rows="6" required>{{ old('body') }}</textarea>

        <fieldset>
            <label>
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }}>
                Published (Uncheck to save as draft/hidden)
            </label>
        </fieldset>

        <div class="actions">
            <button type="submit">Publish Post</button>
            <a href="{{ route('home') }}" role="button" class="secondary outline">Cancel</a>
        </div>
    </form>
@endsection