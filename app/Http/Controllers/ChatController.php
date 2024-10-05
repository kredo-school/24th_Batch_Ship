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
        $sender_id = Auth::user()->id;
        // condition to figure out user is sender or recipient 
        // get latest chat
        $latest_chat = Chat::where('sender_id', $sender_id)
                            ->orWhere('recipient_id', $sender_id)
                            ->with(['latestMessage' => function($query){
                                $query->latest('created_at');
                            }])
                            ->latest('updated_at')
                            ->first();

        // get recipient_id or sender_id from latest chat
        if ($latest_chat){
            if ($latest_chat->sender_id === $sender_id){
                $recipient_id = $latest_chat->recipient_id;
            } else {
                $recipient_id = $latest_chat->sender_id;
            }
        }

        //  pass recipient_id
        return $this->getAllChat($recipient_id);
    }

    # to store messages
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

            $chat->touch();

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
        }

        return redirect()->back();
    }

    # process to get chats and messages
    public function getAllChat($profile_id){

        // get all messages
        $sender_id = Auth::id();
        $recipient_id = $profile_id;
        $recipientData = User::findOrFail($profile_id);

        // identify chat
        $chats = Chat::where(function($query) use ($sender_id, $recipient_id) { // for the case sender_id = Auth user
            $query->where('sender_id', $sender_id)
                  ->where('recipient_id', $recipient_id)
                  ->with('messages')
                  ->with('sender')
                  ->with('recipient');
        })
        ->orWhere(function($query) use ($sender_id, $recipient_id) {    // for the case sender_id != Auth user
            $query->where('sender_id', $recipient_id)
                  ->where('recipient_id', $sender_id)
                  ->with('messages')
                  ->with('sender')
                  ->with('recipient');
        })
        ->get();
        
        $all_messages = $chats->flatMap(function($chat){
            return $chat->messages;
        });

        $chat = $chats->first();

        // mark unread message as read
        ChatMessage::where('chat_id', $chat->id)
        ->where('user_id', '!=', Auth::user()->id)
        ->whereNull('read_at')
        ->update(['read_at' => now()]);

        // get all chats
        $all_chats = Chat::where('sender_id', Auth::id())
                    ->orWhere('recipient_id', Auth::id())
                    ->orderBy('updated_at', 'desc')
                    ->get()
                    ->map(function ($chat) {
                        $chat->unread_count = $chat->getUnreadMessagesCount(Auth::id());
                        return $chat;
                    });

        return view('users.chats.index', compact('all_chats', 'profile_id', 'all_messages', 'chat', 'recipientData'));
    }

    // public function search(Request $request){
    //     $sender_id = Auth::id();

    //     $chat = Chat::where(function($query) use ($sender_id) {
    //         $query->where('sender_id', $sender_id)
    //               ->where('recipient_id', $sender_id);
    //     })
    //     ->first();

    //     $users = $chat->user->where('username','like', '%'. $request->search . '%')->get();

    //     return view('users.chats.index')->with('users', $users)
    //                                     ->with('search', $request->search);
    // }
}
