<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;
    public $timestamps = true;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
     protected $fillable = [ 'user_id', 'post_id', 'percentage', 'comment' ];




     public function post()
     {
         return $this->belongsTo(Post::class);
     }

    public function getPercentage()
    {
        return $this->belongsTo(PostComment::class);

    }


    public function replies()
    {
        return $this->hasMany(Reply::class, 'post_comment_id');
    }
}
