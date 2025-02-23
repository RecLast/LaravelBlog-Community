<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Add home route that redirects to welcome page
Route::redirect('/home', '/')->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Forum routes
    Route::resource('forums', ForumController::class);
    Route::get('/forums/{forum}/posts/create', [ForumController::class, 'createPost'])->name('forums.posts.create');
    Route::post('/forums/{forum}/posts', [ForumController::class, 'storePost'])->name('forums.posts.store');
    
    // Blog routes
    Route::resource('blogs', BlogController::class);
    Route::patch('/blogs/{blog}/toggle-publish', [BlogController::class, 'togglePublish'])->name('blogs.toggle-publish');
    Route::post('/blogs/{blog}/comments', [App\Http\Controllers\BlogCommentController::class, 'store'])->name('blogs.comments.store');
    Route::delete('/blogs/{blog}/comments/{comment}', [App\Http\Controllers\BlogCommentController::class, 'destroy'])->name('blogs.comments.destroy');
    
    // Video routes
    Route::resource('videos', VideoController::class);
    Route::post('/videos/{video}/comments', [App\Http\Controllers\VideoCommentController::class, 'store'])->name('videos.comments.store');
    Route::delete('/videos/{video}/comments/{comment}', [App\Http\Controllers\VideoCommentController::class, 'destroy'])->name('videos.comments.destroy');

    // Group routes
    Route::resource('groups', GroupController::class);
    Route::post('/groups/{group}/join', [GroupController::class, 'join'])->name('groups.join');
    Route::delete('/groups/{group}/leave', [GroupController::class, 'leave'])->name('groups.leave');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users.index');
    Route::get('/roles', [App\Http\Controllers\AdminController::class, 'roles'])->name('roles.index');
    
    // Admin Blog routes
    Route::resource('blogs', App\Http\Controllers\Admin\BlogController::class);
    
    // Admin Forum routes
    Route::resource('forums', App\Http\Controllers\Admin\ForumController::class);
    
    // Admin Video routes
    Route::resource('videos', App\Http\Controllers\Admin\VideoController::class);
    
    // Admin Group routes
    Route::resource('groups', App\Http\Controllers\Admin\GroupController::class);
    
    // Admin Category routes
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    
    // Admin Comment routes
    Route::resource('comments', App\Http\Controllers\Admin\CommentController::class);
    
    // Admin Achievement routes
    Route::resource('achievements', App\Http\Controllers\Admin\AchievementController::class);
    
    // Admin Settings routes
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});

require __DIR__.'/auth.php';
