<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $fillable = ['post_id', 'image_data'];

    public function post()
    {
        return $this->belongsTo(PostImage::class);
    }
}
