<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;
    public $timestamps = true;
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
     protected $fillable = [ 'user_id', 'post_id', 'percentage', 'comment_body' ];


     public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
