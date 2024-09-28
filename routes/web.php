<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\EventUserController;


// use App\Http\Controllers\CommentController;
// use App\Http\Controllers\PercentageController;
use App\Http\Controllers\PostCommentController;

use App\Http\Controllers\SelectDataController;
use App\Http\Controllers\BoardCommentController;
use App\Http\Controllers\CommunityUserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InquiryController;

use App\Http\Controllers\Admin\InquiriesController;


Auth::routes();

Route::group(['middleware' => 'auth'], function(){

    Route::get('/search', [HomeController::class, 'search'])->name('search');


    //Profile
    Route::get('/', [ProfileController::class,'index'])->name('users.profile.index');
    Route::get('/profile/{id}', [ProfileController::class,'specificProfile'])->name('users.profile.specificProfile');
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('users.profile.edit');
    Route::get('/profile/{id}/create', [ProfileController::class, 'create'])->name('users.profile.create');
    Route::patch('/profile/store', [ProfileController::class, 'update'])->name('users.profile.update');
    Route::patch('/profile/update', [ProfileController::class, 'profileUpdate'])->name('users.profile.profileUpdate');

    //Post
    Route::get('/post/index', [PostController::class, 'index'])->name('users.posts.index');
    Route::get('/post/{id}/show', [PostController::class, 'show'])->name('users.posts.show');
    Route::get('/post/create', [PostController::class, 'create'])->name('users.posts.create');
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('users.posts.edit');
    Route::post('/post/store', [PostController::class, 'store'])->name('users.posts.store');
    Route::patch('/post/{id}/update', [PostController::class, 'update'])->name('users.posts.update');
    Route::delete('/post/{id}/destroy', [PostController::class, 'destroy'])->name('users.posts.destroy');


    # Community
    Route::get('/community/index', [CommunityController::class,'index'])->name('communities.index');
    Route::get('/community/create',[CommunityController::class,'create'])->name('communities.create');
    Route::post('/community/store',[CommunityController::class,'store'])->name('communities.store');
    Route::get('/community/{id}/show',[CommunityController::class,'show'])->name('communities.show');
    Route::get('/community/{id}/edit', [CommunityController::class, 'edit'])->name('communities.edit');
    Route::patch('/community/{id}/update', [CommunityController::class, 'update'])->name('communities.update');


    // Post Percentage and Comment
    Route::post('/comment/{post_id}/store', [PostCommentController::class, 'store'])->name('comment.store');
    Route::get('/comments/show/{post}', [PostCommentController::class, 'show'])->name('comments.show');
    Route::delete('/comment/{post_id}/destroy', [PostCommentController::class, 'destroy'])->name('comment.destroy');



    # COMMENT
    # BOARDCOMMENT
    Route::post('/comment/{community_id}/store', [BoardCommentController::class, 'store'])->name('boardcomment.store');
    Route::patch('/comment/{id}/update', [BoardCommentController::class, 'update'])->name('boardcomment.update');
    Route::delete('/comment/{id}/destroy', [BoardCommentController::class, 'destroy'])->name('boardcomment.destroy');


    # CommunityUser
    Route::post('/community/{id}/join', [CommunityUserController::class, 'join'])->name('community.join');
    Route::delete('/community/{id}/unjoin', [CommunityUserController::class, 'unjoin'])->name('community.unjoin');

    # Event
    Route::get('/event/{community_id}/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/event/store', [EventController::class, 'store'])->name('event.store');
    Route::get('/event/{id}/show', [EventController::class, 'show'])->name('event.show');
    Route::get('/event/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::patch('/event/{id}/update', [EventController::class, 'update'])->name('event.update');
    Route::delete('/event/{id}/destroy', [EventController::class, 'destroy'])->name('event.destroy');

    # EventUser
    Route::post('/event/{id}/join', [EventUserController::class, 'join'])->name('event.join');
    Route::delete('/event/{id}/unjoin', [EventUserController::class, 'unjoin'])->name('event.unjoin');

    # API
    Route::get('/api/select-data', [SelectDataController::class, 'getData']);

    # Chat
    Route::get('/profile/{profile_id}/chat', [ChatController::class, 'index'])->name('chat.index');
    // Route::post('/profile/{id}/chat', [ChatController::class, 'createChat'])->name('chat.create');
    Route::post('/chat/{profile_id}/messages', [ChatController::class, 'store'])->name('chat.store');

    # Support
    Route::get('/inquiry/create', [InquiryController::class, 'create'])->name('inquiry.create');
    Route::post('/inquiry/store', [InquiryController::class, 'store'])->name('inquiry.store');
    Route::get('/inquiry/{id}/submitted', [InquiryController::class, 'submitted'])->name('inquiry.submitted');

    # for Go to Post, Go to Community for auth user
    Route::get('/auth/post/index', [PostController::class, 'authPostIndex'])->name('auth.postIndex');
    Route::get('/auth/community/index', [CommunityController::class, 'authCommunityIndex'])->name('auth.communityIndex');

    # Category Action
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('users.categories.show');

    # Admin
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function(){
        # Support
        Route::get('/support', [InquiriesController::class,'index'])->name('support');
        Route::delete('/support/{id}/completed', [InquiriesController::class, 'completed'])->name('support.completed');
        Route::patch('/support/{id}/pending', [InquiriesController::class, 'pending'])->name('support.pending');
    });
});
