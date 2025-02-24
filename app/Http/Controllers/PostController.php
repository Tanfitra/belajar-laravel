<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // public function index()
    // {
    //     $posts = Post::filter(request(['search', 'category', 'author']))->latest()->paginate(9)->withQueryString();
    //     return view('posts', ['title' => 'Blog', 'posts' => $posts]);
    // }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'image' => 'image|file|max:2048',
            'content' => 'required|string',
        ]);
    
        $imageName = null;
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->storeAs('post-images', $imageName, 'public');
        }
    
        $post = new Post();
        $post->title = $request->title;
        $post->author_id = Auth::user()->id;
        $post->category_id = $request->category;
        $post->slug = Str::slug($request->title);
        $post->image = $imageName;
        $post->body = $request->content;
        $post->save();
    
        notyf()
            ->position('x', 'center')->position('y', 'top')
            ->success('Your article has been successfully posted');
        return redirect('/posts');
    }

    public function update(Request $request, Post $post)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|exists:categories,id',
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
    $post->category_id = $request->category;
    $post->body = $request->content;
    $post->save();

    notyf()
        ->position('x', 'center')->position('y', 'top')
        ->success('Your article has been successfully updated');
    return redirect('/profile');
}

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        notyf()
            ->position('x', 'center')->position('y', 'top')
            ->success('Your article has been successfully deleted');
        return redirect('/profile');
    }
}