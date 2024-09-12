<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    use HasFactory;

    protected $table = 'event_user';
    //  this is to tell the laravel that we are accessing the event_user table
    protected $fillable = ['event_id', 'user_id'];
    // set the value to false to tell Laravel to not insert the timestamps
    public $timestamps = false;

    # To get the name of the user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
