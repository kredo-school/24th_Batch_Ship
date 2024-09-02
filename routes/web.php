<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CommunityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;


Auth::routes();

Route::group(['middleware' => 'auth'], function(){

    Route::get('/search', [HomeController::class, 'search'])->name('search');

    //Profile
    Route::get('/', [ProfileController::class, 'index'])->name('users.profile.index');
    Route::get('/profile/create', [ProfileController::class, 'create'])->name('users.profile.create');

    //Post
    Route::get('/post/index', [PostController::class, 'index'])->name('users.posts.index');
    Route::get('/post/{id}/show', [PostController::class, 'show'])->name('users.posts.show');
    Route::get('/post/create', [PostController::class, 'create'])->name('users.posts.create');

    # Community
    Route::get('community/index', [CommunityController::class,'index'])->name('community.index');
    Route::get('/community/create',[CommunityController::class,'create'])->name('community.create');
    Route::post('/community/store',[CommunityController::class,'store'])->name('community.store');
        
});
