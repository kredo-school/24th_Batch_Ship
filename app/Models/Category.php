<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function index()
    {
        $categories = Category::all();
        return view('users.posts.crate');
    }

    public function categoryPost()
    {
        return $this->hasMany(Category::class);
    }

    protected $table = 'category_post';
    // this is to tell the laravel that we are accessing the category_post table
    protected $fillable = ['category_id', 'post_id'];
    public $timestamps = false;

    # To get the name of the category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function create()
{
    $all_categories = Category::all();
    return view('post.create', compact('all_categories'));
}
}
