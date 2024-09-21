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

    public function upcomingEventHost()
    {
        $currentDateTime = now(); // Get the current date and time

        return $this->hasMany(Event::class)
            ->where(DB::raw('CONCAT(date, " ", start_time)'), '>', $currentDateTime) // Exclude previous events
            ->where('host_id', Auth::user()->id)
            ->exists(); // Check if there are any upcoming events hosted by the user
        }
}
