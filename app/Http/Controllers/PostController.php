<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $posts = Post::latest()->filter(request(['search', 'category', 'author']))->where('status', 'approved')->paginate(9)->withQueryString();

        return view('posts.index', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }
}
