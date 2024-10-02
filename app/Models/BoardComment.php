<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoardComment extends Model
{
    use HasFactory;

    protected $table = 'board_comments';
    protected $fillable = ['user_id', 'community_id', 'body', 'image'];

    # To get the info of the owner of the comment
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
