<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Community extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = 'communities';

    # to get the owner of the community
    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    # To get the categories under a community
    public function categoryCommunity()
    {
        return $this->hasMany(categoryCommunity::class);
    }

    # To get host avatar with search result
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_community');
    }

    # Post has many comments
    # To get all the comments of a community
    public function comments()
    {
         return $this->hasMany(BoardComment::class)->latest();
    }

    # To get all members of the community
    public function members()
    {
        return $this->hasMany(CommunityUser::class);
    }

    # return TRUE if the Auth user is already joining the community
    public function isJoining()
    {
        return $this->members()->where('user_id', Auth::user()->id)->exists();
    }

    # Community has many events
    public function events()
    {
        return $this->hasMany(Event::class)->orderBy('date')->orderBy('start_time');
    }

    # Check if the user is the event host or an attendee for active events
    private function activeEvent($isEventHost = true)
    {
        $currentDateTime = now();
        $currentDateString = $currentDateTime->toDateString();
        $currentTimeString = $currentDateTime->toTimeString();

        $events = $this->events(); // Access the events related to this community

        // Check if the user is the host; if so, filter events by host_id
        if ($isEventHost) {
            $events->where('host_id', Auth::id());
        } else { // If the user is an attendee, filter events by user_id in the event_user_table
            $events->whereHas('attendees', function ($q) {
                $q->where('user_id', Auth::id()); // Check if the current user is an attendee
            });
        }

        // Check if the event date is in the future or if it is today and the end time is still in the future
        return $events->where(function ($q) use ($currentDateString, $currentTimeString) {
            $q->whereDate('date', '>', $currentDateString)
            ->orWhere(function ($q) use ($currentDateString, $currentTimeString) {
                $q->whereDate('date', $currentDateString)
                    ->where('end_time', '>', $currentTimeString);
            });
        })->exists();
    }

    # For active events hosted by the user
    public function activeEventHost()
    {
        return $this->activeEvent(true);
    }

    # For active events attended by the user
    public function activeEventAttendee()
    {
        return $this->activeEvent(false);
    }

    public function percentage()
    {
        return $this->hasMany(InterestRate::class);
    }

}
