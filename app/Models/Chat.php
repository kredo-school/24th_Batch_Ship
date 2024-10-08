<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    # To get sender of messages
    public function sender(){
        return $this->belongsTo(User::class, 'sender_id');
    }

    # To get recipient of messages
    public function recipient(){
        return $this->belongsTo(User::class, 'recipient_id');
    }

    # To get chat messages of a chat
    public function messages(){
        return $this->hasMany(ChatMessage::class);
    }

    # To get latest message of a chat
    public function latestMessage(){
        return $this->hasOne(ChatMessage::class)->latestOfMany();
    }

    public function getUnreadMessagesCount($userId)
    {
        return $this->messages()
                    ->where('user_id', '!=', $userId)
                    ->whereNull('read_at')
                    ->count();
    }
}
