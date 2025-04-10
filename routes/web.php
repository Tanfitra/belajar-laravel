<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProfilePostController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/posts', function () {
    return view('posts', [
        'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->where('status', 'approved')->paginate(9)->withQueryString(),
        'categories' => Category::all()
    ]);
});

Route::prefix('profile')->middleware(['auth', 'verified', 'role:author'])->group(function () {
    Route::get('/', function () {
        return view('profile.index', [
            'user' => User::with(['posts' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])->find(Auth::id()),
        ]);
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('settings');
        Route::put('/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile');
        Route::put('/password', [SettingsController::class, 'updatePassword'])->name('settings.password');
    });

    Route::post('/profile/posts/upload', [ProfilePostController::class, 'upload'])->name('profile.posts.upload');
    Route::get('/posts', [ProfilePostController::class, 'index'])->name('profile.posts');
    Route::get('/posts/create', [ProfilePostController::class, 'create'])->name('profile.posts.create');
    Route::post('/posts', [ProfilePostController::class, 'store'])->name('profile.posts.store');
    Route::get('/posts/{post}/edit', [ProfilePostController::class, 'edit'])->name('profile.posts.edit');
    Route::put('/posts/{post}', [ProfilePostController::class, 'update'])->name('profile.posts.update');
    Route::delete('/posts/{post}', [ProfilePostController::class, 'destroy'])->name('profile.posts.destroy');
});

Route::get('/posts/@{username}/{post:slug}', function ($username, Post $post) {
    if ($post->author->username !== $username) {
        abort(404);
    }
    return view('post', ['post' => $post]);
})->name('post.show');

Route::get('/authors/{user:username}', function (User $user) {
    // $posts = $user->posts->load(['author', 'category']);
    return view('posts', ['posts' => $user->posts]);
});

Route::get('/categories/{category:slug}', function (Category $category) {
    // $posts = $category->posts->load(['author', 'category']);
    return view('posts', ['posts' => $category->posts]);
});

Route::prefix('admin')->middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/', function () {
        return view('admin.index', [
            'totalPosts' => Post::count(),
            'totalPendingPosts' => Post::where('status', 'pending')->count(),
            'totalApprovedPosts' => Post::where('status', 'approved')->count(),
            'totalCategories' => Category::count(),
            'totalUsers' => User::count(),
        ]);
    })->name('admin.dashboard');
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
    });
    Route::prefix('posts')->group(function () {
        Route::get('/approval', [ProfilePostController::class, 'pending'])->name('admin.posts.approval.index');
        Route::put('/{post}/approve', [ProfilePostController::class, 'approve'])->name('admin.posts.approve');
    });
});

Route::get('/contact', function () {
    return view('contact');
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
