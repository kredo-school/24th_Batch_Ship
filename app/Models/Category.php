<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    

    protected $table = 'categories';
    // this is to tell the laravel that we are accessing the category_post table
    protected $fillable = ['name'];
    public $timestamps = true;


}
