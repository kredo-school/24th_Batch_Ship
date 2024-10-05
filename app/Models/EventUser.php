<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    use HasFactory;

    //  To tell the laravel that we are accessing the event_user table
    protected $table = 'event_user';

    protected $fillable = ['event_id', 'user_id'];

    // Set the value to false to tell Laravel to not insert the timestamps
    public $timestamps = false;

    # To get the user information
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
