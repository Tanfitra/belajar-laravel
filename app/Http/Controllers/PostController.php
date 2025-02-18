<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        // Fetch all categories from the database
        $categories = Category::all();
        
        // Pass the categories to the view
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
}