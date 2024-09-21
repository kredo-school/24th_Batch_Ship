<?php

namespace App\Http\Controllers;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\User;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    private $chat;
    private $chatmessage;
    private $user;

    public function __construct(Chat $chat, ChatMessage $chatmessage, User $user){
        $this->chat = $chat;
        $this->chatmessage = $chatmessage;
        $this->user = $user;
    }

    public function index(){
        return view('users.chats.index');
    }
}
