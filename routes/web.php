<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('users.posts.index');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/post', [PostController::class, 'index'])->name('users.posts.index');
// Route::get('/post/{id}/show', [PostController::class, 'show'])->name('users.posts.show');

//Profile
Route::get('/profile/create', [ProfileController::class, 'create'])->name('users.profile.create');

