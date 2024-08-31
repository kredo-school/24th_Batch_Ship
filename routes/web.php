<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/search', function () {
    return view('search');
});

Route::get('/post/create', function () {
    return view('users.posts.create');
});

// Route::get('/users', function () {
//     return view('users.community.index');
// });


Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();


//Post
Route::get('/post/index', [PostController::class, 'index'])->name('users.posts.index');
Route::get('/post/show', [PostController::class, 'show'])->name('users.posts.show');
//Route::get('/post/{id}/show', [PostController::class, 'show'])->name('users.posts.show');
Route::get('/post/create', [PostController::class, 'create'])->name('users.posts.create');

Route::get('/search', [HomeController::class, 'search'])->name('search');

//Profile
Route::get('/profile/index', [ProfileController::class, 'index'])->name('users.profile.index');
Route::get('/profile/create', [ProfileController::class, 'create'])->name('users.profile.create');
