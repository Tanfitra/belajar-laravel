<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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
            'content' => 'required|string',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->author_id = Auth::user()->id;
        $post->category_id = $request->category;
        $post->slug = Str::slug($request->title);
        $post->body = $request->content;
        $post->save();

        notyf()
            ->position('x', 'center')->position('y', 'top')
            ->success('Your article has been successfully posted');
        return redirect('/posts');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'content' => 'required|string',
        ]);

        $post->title = $request->title;
        $post->category_id = $request->category;
        $post->body = $request->content;
        $post->save();

        notyf()
            ->position('x', 'center')->position('y', 'top')
            ->success('Your article has been successfully updated');
        return redirect('/profile');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        notyf()
            ->position('x', 'center')->position('y', 'top')
            ->success('Your article has been successfully deleted');
        return redirect('/profile');
    }
}