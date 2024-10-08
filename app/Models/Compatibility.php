<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compatibility extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'send_user_id',
        'compatibility',
    ];

    // Compatibility.php
public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function sender()
    {
        return $this->belongsTo(User::class, 'send_user_id');
    }

}
