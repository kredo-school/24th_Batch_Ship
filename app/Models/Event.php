<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;
    
    public function user()
    {
        return $this->belongsTo(User::class);/* ->withTrashed() */
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
}
