<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryCommunity extends Model
{
    use HasFactory;

    protected $table = 'category_community';

    protected $fillable = ['category_id', 'community_id'];

    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
