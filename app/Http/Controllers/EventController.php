<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class EventController extends Controller
{
    private $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function create()
    {
        return view('users.events.create');
    }

    public function store(Request $request)
    {
       $request->validate([
            'community_id' => 'required',
            'title'        => 'required|string|max:255',
            'date'         => 'required|date',
            'start_time'   => 'required|date_format:H:i',
            'end_time'     => 'required|date_format:H:i|after:start_time',
            'location'     => 'required|string|max:255',
            'price'        => 'required|string|max:255',
            'description'  => 'required|string',
            'image'        => 'required|mimes:jpeg,jpg,png,gif|max:1048'
       ]);

       $this->event->host_id      = Auth::user()->id;
       $this->event->community_id = $request->community_id;
       $this->event->title        = $request->title;
       $this->event->date         = $request->date;
       $this->event->start_time   = $request->start_time;
       $this->event->end_time     = $request->end_time;
       $this->event->location     = $request->location;
       $this->event->price        = $request->price;
       $this->event->description  = $request->description;
       $this->event->image        = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
       $this->event->save();

       return redirect()->route('event.show');
    }

    public function show()
    {
        return view('users.events.show');
    }

    public function edit()
    {
        return view('users.events.edit');
    }
}
