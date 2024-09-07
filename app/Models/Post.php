<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    // use HasFactory, SoftDeletes;

    # POST - USER
    # a post belongs to a user
    # to get the owner of the post

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    # To get the categories under a post
    public function categoryPost()
    {
        return $this->hasMany(CategoryPost::class);
    }

    # To get the categories with search result
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
//     # to get all the comments under a post
//     public function comments()
//     {
//         return $this->hasMany(Comment::class);
//     }

//     # to get all the likes of a post
//     public function likes()
//     {
//         return $this->hasMany(Like::class);
//     }

//     # return TRUE if the Auth user already liked the post
//     public function isLiked()
//     {
//         return $this->likes()->where('user_id', Auth::user()->id)->exists();
//     }

}
