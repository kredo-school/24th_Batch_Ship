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

    public function users()
    {
        return $this->belongsToMany(User::class, 'category_user');
    }

    // the communities that belong to the category
    public function communities()
    {
        return $this->belongsToMany(Community::class);
    }

    // events that belong to the category
    public function events()
    {
        return $this->belongsToMany(Event::class, 'category_event');
    }
    

}
