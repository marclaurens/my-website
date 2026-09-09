<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', true)->latest()->get();
        return view('posts.index', ['posts' => $posts]);
    }

    public function drafts()
    {
        $posts = Post::where('is_published', false)->latest()->get();
        return view('posts.drafts', ['posts' => $posts]);
    }

    public function togglePublish(Post $post)
    {
        $post->update(['is_published' => !$post->is_published]);

        $status = $post->is_published ? 'published' : 'hidden';
        return back()->with('success', "Post has been {$status}!");
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('posts', 'public');
        }

        $validated['is_published'] = $request->boolean('is_published');

        Post::create($validated);

        return redirect('/')->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('posts', 'public');
        }

        $validated['is_published'] = $request->boolean('is_published');

        $post->update($validated);

        return redirect('/')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }

        $post->delete();

        return redirect('/')->with('success', 'Post deleted successfully!');
    }
}