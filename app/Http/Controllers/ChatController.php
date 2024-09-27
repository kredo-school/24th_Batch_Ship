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

    public function index($profile_id){
        # GET ALL CHATS
        $all_chats = Chat::where('sender_id', Auth::id())
                        ->orWhere('recipient_id', Auth::id())
                        ->get();
        
        # GET ALL MESSAGES
        $sender_id = Auth::id();
        $recipient_id = $profile_id;

        // identify chat
        $chats = Chat::where(function($query) use ($sender_id, $recipient_id) {
            $query->where('sender_id', $sender_id)
                  ->where('recipient_id', $recipient_id)
                  ->with('messages');
        })
        ->orWhere(function($query) use ($sender_id, $recipient_id) {
            $query->where('sender_id', $recipient_id)
                  ->where('recipient_id', $sender_id)
                  ->with('messages');
        })
        ->get();

        $all_messages = $chats->flatMap(function($chat){
            return $chat->messages;
        });

        return view('users.chats.index', compact('all_chats', 'profile_id', 'all_messages'));
    }

    # STORE MESSAGES
    public function store(Request $request, $profile_id){
        $sender_id = Auth::id();
        $recipient_id = $profile_id;

        // identify chat
        $chat = Chat::where(function($query) use ($sender_id, $recipient_id) {
            $query->where('sender_id', $sender_id)
                  ->where('recipient_id', $recipient_id);
        })
        ->orWhere(function($query) use ($sender_id, $recipient_id) {
            $query->where('sender_id', $recipient_id)
                  ->where('recipient_id', $sender_id);
        })
        ->first();

        // check if a chat already exists
        if ($chat) {
            // Conversation exists
            $request->validate(
                [   // RULES
                    'text' => 'required|max:150'
                ],
                [   // ERROE MESSAGES
                    'required' => 'You cannot send an empty message.',
                    'max' => 'The message must not have more than 150 characters.'
                ]
            );

            $this->chatmessage->text = $request->text;
            $this->chatmessage->user_id = Auth::user()->id;
            $this->chatmessage->chat_id = $chat->id;
            $this->chatmessage->save();
            // return redirect()->route('chat.index', ['chat' => $chat->id]);

        } else {
            // No conversation exists yet
            $this->chat->sender_id = Auth::user()->id;
            $this->chat->recipient_id = $profile_id;
            $this->chat->save();

            $request->validate(
                [   // RULES
                    'text' => 'required|max:150'
                ],
                [   // ERROE MESSAGES
                    'required' => 'You cannot send an empty message.',
                    'max' => 'The message must not have more than 150 characters.'
                ]
            );

            $this->chatmessage->text = $request->text;
            $this->chatmessage->user_id = Auth::user()->id;
            $this->chatmessage->chat_id = $this->chat->id;
            $this->chatmessage->save();
            // return redirect()->route('chat.index');
        }

        return redirect()->back();
    }

    public function identifyChat(){

    }
}
