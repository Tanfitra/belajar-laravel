<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfilePostController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'About']);
});

Route::get('/posts', function () {
    return view('posts', [
        'title' => 'Blog',
        'posts' => Post::filter(request(['search', 'category', 'author']))->latest()->paginate(9)->withQueryString(),
        'categories' => Category::all()
    ]);
});

Route::prefix('profile')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('profile.index', [
            'title' => 'My Profile',
            'user' => User::with(['posts' => function($query) {
                $query->orderBy('created_at', 'desc');
            }])->find(Auth::id()),
        ]);
    });

    Route::post('/profile/posts/upload', [ProfilePostController::class, 'upload'])->name('profile.posts.upload');
    Route::get('/posts', [ProfilePostController::class, 'index'])->name('profile.posts');
    Route::get('/posts/create', [ProfilePostController::class, 'create'])->name('profile.posts.create');
    Route::post('/posts', [ProfilePostController::class, 'store'])->name('profile.posts.store');
    Route::get('/posts/{post}/edit', [ProfilePostController::class, 'edit'])->name('profile.posts.edit');
    Route::put('/posts/{post}', [ProfilePostController::class, 'update'])->name('profile.posts.update');
    Route::delete('/posts/{post}', [ProfilePostController::class, 'destroy'])->name('profile.posts.destroy');
});

Route::get('/posts/{post:slug}', function (Post $post) {
    return view('post', ['title' => 'Single Post', 'post' => $post]);
});

Route::get('/authors/{user:username}', function (User $user) {
    // $posts = $user->posts->load(['author', 'category']);
    return view('posts', ['title' => count($user->posts) . ' Articles by ' . $user->name, 'posts' => $user->posts]);
});

Route::get('/categories/{category:slug}', function (Category $category) {
    // $posts = $category->posts->load(['author', 'category']);
    return view('posts', ['title' => 'Articles in ' . $category->name, 'posts' => $category->posts]);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contacts']);
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/email/verify', function () {
    return view('mails.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/profile');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');