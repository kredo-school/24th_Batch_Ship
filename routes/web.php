<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();


Route::get('/', function () {
    return view('users.community.create');

    # Community
Route::get('/community/create',[CommunityController::class,'create'])->name('community.create');
Route::post('/community/store',[CommunityController::class,'store'])->name('community.store');
});





