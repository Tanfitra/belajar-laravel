<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfilePostController extends Controller
{
    /**
     * Display a listing of the authenticated user's posts.
     */
    public function index()
    {
        $user = User::with(['posts' => function($query) {
            $query->orderBy('created_at', 'desc');
        }])->find(Auth::id());

        return view('profile.posts.index', [
            'title' => 'My Posts',
            'user' => $user,
        ]);
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        $categories = Category::all();
        return view('profile.posts.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|array',
            'category.*' => 'exists:categories,id',
            'image' => 'nullable|image|file|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->storeAs('post-images', $imageName, 'public');
        }

        $post = new Post();
        $post->title = $request->title;
        $post->author_id = Auth::id();
        $post->slug = Str::slug($request->title);
        $post->image = $imageName;
        $post->body = $request->content;
        $post->save();

        // Attach multiple categories
        $post->categories()->sync($request->category);

        notyf()
            ->position('x', 'center')->position('y', 'top')
            ->success('Your article has been successfully posted');

        return redirect('/profile/posts');
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit(Post $post)
    {
        // Ensure the authenticated user owns the post
        if ($post->author_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $categories = Category::all();
        return view('profile.posts.edit', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Ensure the authenticated user owns the post
        if ($post->author_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|array',
            'category.*' => 'exists:categories,id',
            'image' => 'nullable|image|file|max:2048',
            'content' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete('post-images/' . $post->image);
            }

            $imagePath = $request->file('image')->store('post-images', 'public');
            $post->image = basename($imagePath);
        }

        $post->title = $request->title;
        $post->body = $request->content;
        $post->save();

        if ($request->has('category')) {
            $post->categories()->sync($request->category);
        }

        notyf()
            ->position('x', 'center')->position('y', 'top')
            ->success('Your article has been successfully updated');

        return redirect('/profile/posts');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(Post $post)
    {
        // Ensure the authenticated user owns the post
        if ($post->author_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($post->image) {
            Storage::disk('public')->delete('post-images/' . $post->image);
        }

        $post->delete();

        notyf()
            ->position('x', 'center')->position('y', 'top')
            ->success('Your article has been successfully deleted');

        return redirect('/profile/posts');
    }
}