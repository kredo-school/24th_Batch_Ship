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
        return $this->belongsToMany(User::class,'category_user', 'category_id', 'user_id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post', 'category_id', 'post_id');
    }
    

    // the communities that belong to the category
    public function communities()
    {
        return $this->belongsToMany(Community::class);
    }

    // events that belong to the category
    public function events()
    {
        return $this->belongsToMany(Event::class, 'category_event', 'category_id', 'event_id');
    }     

    // for search result for event with category 
    public function categoryEvent()
    {
        return $this->belongsToMany(Event::class); 
    }

    // relation with posts, communities, events for auth user
    public function relatedPosts()
    {
        return $this->belongsToMany(Post::class, 'category_post', 'category_id', 'post_id');
    }    

    public function relatedCommunities()
    {
        return $this->belongsToMany(Community::class, 'category_community', 'category_id', 'community_id');
    }
    
    public function relatedEvents()
    {
        return $this->belongsToMany(Event::class, 'category_event', 'category_id', 'event_id');
    }
    


}
