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

    public function index(){
        # get all chats
        $all_chats = Chat::where('sender_id', Auth::id())
                        ->orWhere('recipient_id', Auth::id())
                        ->get();

        return view('users.chats.index', compact('all_chats'));
    }

    //  create new chat
    public function createChat(Request $request, $id){
        $sender_id = Auth::id();
        $recipient_id = $id;

        # check if a chat already exists
        $chat = Chat::where(function($query) use ($sender_id, $recipient_id) {
            $query->where('sender_id', $sender_id)
                  ->where('recipient_id', $recipient_id);
        })
        ->orWhere(function($query) use ($sender_id, $recipient_id) {
            $query->where('sender_id', $recipient_id)
                  ->where('recipient_id', $sender_id);
        })
        ->first();

        if ($chat) {
            // Conversation exists
            return redirect()->route('chat.index', ['chat' => $chat->id]);

        } else {
            // No conversation exists yet
            $this->chat->sender_id = Auth::user()->id;
            $this->chat->recipient_id = $id;
            $this->chat->save();
            return redirect()->route('chat.index', ['chat' => $chat->id]);
        }
    }

    # store each messages
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
