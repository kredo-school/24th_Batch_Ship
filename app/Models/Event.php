<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'events';

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

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function attendees()
    {
        return $this->hasMany(EventUser::class);
    }

    public function isJoining()
    {
        return $this->attendees()->where('user_id', Auth::user()->id)->exists();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_event', 'event_id', 'category_id');
    }
}
