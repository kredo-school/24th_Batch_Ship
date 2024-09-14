<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;
    
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

    # To get host info with search result
    public function host()
    {
        return $this->belongsTo(User::class);
    }

    # To get categories with search result
    public function events()
    {
        return $this->belongsToMany(Category::class);
    }

    // The categories that belong to the event.
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_event');
    }
}
