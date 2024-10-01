<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Post extends Model

{
    // use HasFactory, SoftDeletes;

    protected $table = 'posts';
    protected $fillable = ['description', 'image','user_id'];
    public $timestamps = true;
    // use HasFactory, SoftDeletes;

    # POST - USER
    # a post belongs to a user
    # to get the owner of the post

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    # To get the categories under a post
    public function categoryPost()
    {
        return $this->hasMany(CategoryPost::class);
    }

    # To get the categories with search result
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post', 'post_id', 'category_id');
    }
    
    
//     # to get all the comments under a post
//     public function comments()
//     {
//         return $this->hasMany(Comment::class);
//     }

     # to get all the comments under a post
     public function comments()
     {
         return $this->hasMany(PostComment::class);
     }

     public function percentage()
     {
         return $this->hasMany(PostComment::class);
        //  ->where('post_id', $this->id);
     }
     # to get all the likes of a post
    //  public function percentage()
    //  {
    //      return $this->hasMany(Percentage::class);
    //  }

        # To get multiple images
        public function images()
        {
            return $this->hasMany(postImage::class);
        }
        

}
