<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/search', function () {
//     return view('search');
// });
// Route::get('/users', function () {
//     return view('users.community.index');
// });

// // Route::get('/post/create', function () {
// //     return view('users.posts.create');
// });

// Route::get('/', function () {
//     return view('post.create');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Post
Route::get('/post/index', [PostController::class, 'index'])->name('users.posts.index');
Route::get('/post/{id}/show', [PostController::class, 'show'])->name('users.posts.show');
Route::get('/post/create', [PostController::class, 'create'])->name('users.posts.create');

// Route::get('/search', [HomeController::class,'search'])->name('search');
