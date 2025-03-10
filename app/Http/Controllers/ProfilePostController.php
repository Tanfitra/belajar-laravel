<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Helpers\PostHelper;

class ProfilePostController extends Controller
{
    /**
     * Display a listing of the authenticated user's posts.
     */
    public function index()
    {
        $user = User::with(['posts' => function ($query) {
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
        ]);

        $firstImage = PostHelper::extractFirstImage($request->content);

        $post = new Post();
        $post->title = $request->title;
        $post->author_id = Auth::id();
        $post->slug = Str::slug($request->title);
        $post->body = $request->content;

        if ($firstImage) {
            $post->image = 'post-images/' . $firstImage;
        }

        $post->save();

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
        if ($post->author_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|array',
            'category.*' => 'exists:categories,id',
            'content' => 'required|string',
        ]);

        $firstImage = PostHelper::extractFirstImage($request->content);

        $post->title = $request->title;
        
        $post->body = $request->content;

        if ($firstImage) {
            $post->image = 'post-images/' . $firstImage;
        }

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

        if ($post->author_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();

        notyf()
            ->position('x', 'center')->position('y', 'top')
            ->success('Your article has been successfully deleted');

        return redirect('/profile/posts');
    }

    /**
     * Handle image uploads from Trix editor.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('post-images', $imageName, 'public');

            return response()->json([
                'url' => asset('storage/post-images/' . $imageName),
            ]);
        }

        return response()->json(['error' => 'Image upload failed.'], 400);
    }
}
