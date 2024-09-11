<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventUser;
use Illuminate\Support\Facades\Auth;

class EventUserController extends Controller
{
    private $eventUser;

    public function __construct(EventUser $eventUser)
    {
        $this->eventUser = $eventUser;
    }

    public function join($event_id)
    {
        $this->eventUser->event_id = $event_id; // the joined event
        $this->eventUser->user_id  = Auth::user()->id;  // who joining the event
        $this->eventUser->save();

        return redirect()->back();
    }

    public function unjoin($event_id)
    {
        $this->eventUser->where('user_id', Auth::user()->id)
            ->where('event_id', $event_id)
            ->delete();

        return redirect()->back();
    }
}
