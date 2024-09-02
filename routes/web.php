<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;




Route::get('/', function () {
    return view('users.community.create');

    # Community
Route::get('/community/create',[CommunityController::class,'create'])->name('community.create');
Route::post('/community/store',[CommunityController::class,'store'])->name('community.store');
});





Route::get('/', function () {
    return view('users.posts.index');
});

Auth::routes();

// Route::group(['middleware' => 'auth'], function(){


    Route::get('/search', function () {
        return view('search');
    });

    Route::get('/post/create', function () {
        return view('users.posts.create');
    });

    // Route::get('/users', function () {
        //     return view('users.community.index');
        // });


        // Route::get('/', function () {
        //     return view('auth.login');
        // });




        //Post
        Route::get('/post/index', [PostController::class, 'index'])->name('users.posts.index');
        Route::get('/post/{id}/show', [PostController::class, 'show'])->name('users.posts.show');
        Route::get('/post/create', [PostController::class, 'create'])->name('users.posts.create');

        Route::get('/search', [HomeController::class, 'search'])->name('search');

        //Profile
        Route::get('/', [ProfileController::class, 'index'])->name('users.profile.index');
        Route::get('/profile/create', [ProfileController::class, 'create'])->name('users.profile.create');




