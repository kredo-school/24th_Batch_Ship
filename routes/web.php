<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('users.community.index');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/post', [PostController::class, 'index'])->name('users.posts.index');
// Route::get('/post/{id}/show', [PostController::class, 'show'])->name('users.posts.show');
