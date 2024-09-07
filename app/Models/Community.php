<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Community extends Model
{
    use HasFactory , SoftDeletes;

    # to get the owner of the community

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    # To get the categories under a community
    public function categoryCommunity()
    {
        return $this->hasMany(categoryCommunity::class);
    }
}
