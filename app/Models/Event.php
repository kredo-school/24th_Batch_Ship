<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'category_event';
    protected $fillable = [
        'host_id',
        'community_id',
        'title',
        'date',
        'start_time',
        'end_time',
        'address',
        'price',
        'description',
        'image'
    ];
    
    # to get event host information
    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');/* ->withTrashed() */
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    # to get all attendees for the event
    public function attendees()
    {
        return $this->hasMany(EventUser::class);
    }

    # return TRUE if the Auth user is already joining the event
    public function isJoining()
    {
        return $this->attendees()->where('user_id', Auth::user()->id)->exists();
    }

    # To get categories with search result
    public function events()
    {
        return $this->belongsToMany(Category::class);
    }

    // The categories that belong to the event.
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_event', 'event_id', 'category_id');
    }  

   # To get the categories with event
   public function categoryEvent()
   {
       return $this->hasMany(CategoryEvent::class, 'event_id');
   }
}
