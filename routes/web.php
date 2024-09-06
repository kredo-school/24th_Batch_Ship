<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CommunityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;

Auth::routes();

Route::group(['middleware' => 'auth'], function(){

    Route::get('/search', [HomeController::class, 'search'])->name('search');

    //Profile
    Route::get('/', [ProfileController::class,'index'])->name('users.profile.index');
    Route::get('/profile/{id}', [ProfileController::class,'specificProfile'])->name('users.profile.specificProfile');
    // Route::get('/{id}/show', [ProfileController::class, 'show'])->name('users.profile.show');
    Route::get('/profile/create', [ProfileController::class, 'create'])->name('users.profile.create');

    //Post
    Route::get('/post/index', [PostController::class, 'index'])->name('users.posts.index');
    Route::get('/post/{id}/show', [PostController::class, 'show'])->name('users.posts.show');
    Route::get('/post/create', [PostController::class, 'create'])->name('users.posts.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('users.posts.store');

    # Community
    Route::get('/community/index', [CommunityController::class,'index'])->name('community.index');
    Route::get('/community/create',[CommunityController::class,'create'])->name('community.create');
    Route::post('/community/store',[CommunityController::class,'store'])->name('community.store');

    # Event
    Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/event/store', [EventController::class, 'store'])->name('event.store');
    Route::get('/event/show', [EventController::class, 'show'])->name('event.show');
    Route::get('/event/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::patch('/event/update', [EventController::class, 'update'])->name('event.update');
    Route::delete('/event/destroy', [EventController::class, 'destroy'])->name('event.destroy');

});
