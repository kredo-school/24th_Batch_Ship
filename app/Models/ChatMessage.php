<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    #a user the message belongs to
    public function user(){
        return $this->belongsTo(User::class);
    }

    #a chat the message belongs to ?
    public function chat(){
        return $this->belongsTo(Chat::class);
    }
}
