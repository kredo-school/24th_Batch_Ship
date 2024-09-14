<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityUser extends Model
{
    use HasFactory;

    protected $table = 'community_user';
    //  this is to tell the laravel that we are accessing the community_user table
    protected $fillable = ['community_id', 'user_id'];
    // set the value to false to tell Laravel to not insert the timestamps
    public $timestamps = false;

    # To get the user information
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
