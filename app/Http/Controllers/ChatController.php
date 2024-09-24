<?php

namespace App\Http\Controllers;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function index($id){
        $user = $this->user->findOrFail($id);
        return view('users.chats.index', compact('user'));
    }

    public function store(Request $request){

        $request->validate(
            [
                'text' => 'required|max:150'
            ]
            // [
            //     'required' => 'You cannot send an empty message.',
            //     'max' => 'The message must not have more than 150 characters.'
            // ]
        );

        $this->chatmessage->text = $request->text;
        $this->chatmessage->user_id = Auth::user()->id;
        // $this->chatmessage->chat_id = $chat_id;
        $this->chatmessage->save();

        return redirect()->back();
    }
}
