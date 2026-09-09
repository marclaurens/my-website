<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // Public: List published posts for visitors
    public function publicIndex()
    {
        $posts = Post::with('category')->where('is_published', true)->latest()->paginate(10);
        $categories = Category::orderBy('name')->get();

        return view('posts.index', compact('posts', 'categories'));
    }

    // Public: Show a single published post by slug for visitors
    public function publicShow($slug)
    {
        $post = Post::with('category')
            ->where('is_published', true)
            ->get()
            ->first(function ($p) use ($slug) {
                $postSlug = $p->slug ?? \Illuminate\Support\Str::slug($p->title);
                return $postSlug === $slug;
            });

        if (!$post) {
            abort(404);
        }

        return view('posts.show', compact('post'));
    }

    // Public: List published posts filtered by category for visitors
    public function publicByCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $posts = Post::with('category')
            ->where('category_id', $category->id)
            ->where('is_published', true)
            ->latest()
            ->paginate(10);
            
        $categories = Category::orderBy('name')->get();

        return view('posts.index', compact('posts', 'categories', 'category'));
    }

    public function index()
    {
        $posts = Post::with('category')->where('is_published', true)->latest()->get();
        $categories = Category::orderBy('name')->get();

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    public function byCategory(Category $category)
    {
        $posts = $category->posts()
            ->with('category')
            ->where('is_published', true)
            ->latest()
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('admin.posts.index', compact('posts', 'categories', 'category'));
    }

    public function drafts()
    {
        $posts = Post::with('category')->where('is_published', false)->latest()->get();
        return view('admin.posts.drafts', compact('posts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'new_category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if (!empty($request->new_category)) {
            $categoryName = trim($request->new_category);
            $category = Category::firstOrCreate(
                ['name' => $categoryName],
                ['slug' => Str::slug($categoryName)]
            );
            $validated['category_id'] = $category->id;
        }

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('posts', 'public');
        }

        $validated['is_published'] = $request->boolean('is_published');
        $validated['slug'] = Str::slug($validated['title']);

        Post::create($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        $post->load('category');
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'new_category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if (!empty($request->new_category)) {
            $categoryName = trim($request->new_category);
            $category = Category::firstOrCreate(
                ['name' => $categoryName],
                ['slug' => Str::slug($categoryName)]
            );
            $validated['category_id'] = $category->id;
        }

        if ($request->hasFile('image')) {
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('posts', 'public');
        }

        $validated['is_published'] = $request->boolean('is_published');
        $validated['slug'] = Str::slug($validated['title']);

        $post->update($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully!');
    }

    public function togglePublish(Post $post)
    {
        $post->update(['is_published' => !$post->is_published]);

        $status = $post->is_published ? 'published' : 'hidden';
        return back()->with('success', "Post has been {$status}!");
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:10240',
        ]);

        $path = $request->file('upload')->store('editor-images', 'public');

        return response()->json([
            'url' => Storage::url($path)
        ]);
    }
}