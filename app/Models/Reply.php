<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'user_id',
        'content',
    ];


    public function postComment()
    {
        return $this->belongsTo(PostComment::class, 'comment_id'); // 'comment_id'が正しいカラム
    }


    // リプライを投稿したユーザーを取得
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
