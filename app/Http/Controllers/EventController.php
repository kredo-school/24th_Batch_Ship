<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
            'address'      => 'required|string|max:255',
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
       $this->event->address      = $request->address;
       $this->event->price        = $request->price;
       $this->event->description  = $request->description;
       $this->event->image        = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
       $this->event->save();

       return redirect()->route('event.show', $this->event->id);
    }

    public function show($id)
    {
        $event = $this->event->findOrFail($id);

        $date = Carbon::parse($event->date)->format('Y/m/d');
        $startTime = Carbon::parse($event->start_time)->format('H:i');
        $endTime = Carbon::parse($event->end_time)->format('H:i');

        return view('users.events.show', compact('event', 'date', 'startTime', 'endTime'));
    }

    public function edit($id)
    {
        $event = $this->event->findOrFail($id);

        // # if the Auth user is NOT the host of the event, redirect to show page.
        // if(Auth::user()->id != $event->user->id){
        //     return redirect()->route('users.events.show');
        // }

        $date = Carbon::parse($event->date)->format('Y/m/d');
        $startTime = Carbon::parse($event->start_time)->format('H:i');
        $endTime = Carbon::parse($event->end_time)->format('H:i');

        return view('users.events.edit', compact('event', 'date', 'startTime', 'endTime'));
    }

    public function destroy($id)
    {
        $event = $this->event->findOrFail($id);
        $event->delete();

        return redirect()->route('communities.index');
    }
}
