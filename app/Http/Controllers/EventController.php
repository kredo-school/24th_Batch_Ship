<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EventController extends Controller
{
    private $event;
    private $community;

    public function __construct(Event $event, Community $community)
    {
        $this->event = $event;
        $this->community = $community;
    }

    public function create($id)
    {
        // $id - ID of the community want to create new event for
        $community = $this->community->findOrFail($id);

        # if the Auth user is NOT the owner or member of the community, redirect to community show page.
        if(Auth::user()->id != $community->owner_id && !$community->members->contains('user_id', Auth::user()->id)){
            return redirect()->route('communities.show', $id);
        }

        return view('users.events.create', compact('community'));
    }

    public function store(Request $request)
    {
        # 1. Validate the form data
        $request->validate([
            'community_id' => 'required',
            'event_title'  => 'required|string|max:255',
            'date'         => 'required|date',
            'start_time'   => 'required|date_format:H:i',
            'end_time'     => 'required|date_format:H:i|after:start_time',
            'address'      => 'required|string|max:255',
            // 'latitude'     => 'required|numeric', // for location map
            // 'longitude'    => 'required|numeric', // for location map
            'price'        => 'required|string|max:255',
            'description'  => 'required|string',
            'image'        => 'required|mimes:jpeg,jpg,png,gif|max:1048'
        ]);
    
        # 2. Save the event
        $this->event->host_id      = Auth::user()->id;
        $this->event->community_id = $request->community_id;
        $this->event->title        = $request->event_title;
        $this->event->date         = $request->date;
        $this->event->start_time   = $request->start_time;
        $this->event->end_time     = $request->end_time;
        $this->event->address      = $request->address;
        // $this->event->latitude     = $request->latitude; // for location map
        // $this->event->longitude    = $request->longitude; // for location map
        $this->event->price        = $request->price;
        $this->event->description  = $request->description;
        $this->event->image        = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        $this->event->save();
    
        # 3. Redirect to Show Event page
        return redirect()->route('event.show', $this->event->id);
    }
    
    public function show($id)
    {
        // $id - ID of the event
        $event = $this->event->findOrFail($id);

        // Date and Time
        $date = Carbon::parse($event->date)->format('Y/m/d');
        $startTime = Carbon::parse($event->start_time)->format('H:i');
        $endTime = Carbon::parse($event->end_time)->format('H:i');
        $currentDateTime = Carbon::now();
        $currentDate = Carbon::today(); // Use Carbon to get the current date without time

        // Check user's participation status and community membership related to the event
        $isJoining = false;
        $isCommunityOwner = false;
        $isCommunityMember = false;
        // Check if the user is logged in and is not the host of the event
        if (Auth::check() && Auth::user()->id !== $event->host_id) {
            // Check if the user is currently joining the event
            $isJoining = $event->isJoining();
            // Check if the user is the owner of the community associated with this event
            $isCommunityOwner = $event->community->owner_id === Auth::user()->id;
            // Check if the user is a member of the community associated with this event
            $isCommunityMember = $event->community->members->contains('user_id', Auth::user()->id);
        }

        // Get the community categories
        $all_categories = $event->community->categoryCommunity;

        // Get attendees with reviews
        $attendeesWithReviews = $this->getAttendeesWithReviews($event);

        // For location map
        $encodedAddress = urlencode($event->address);

        return view('users.events.show', compact('event', 'date', 'startTime', 'endTime', 'currentDateTime', 'currentDate', 'isJoining', 'isCommunityOwner', 'isCommunityMember', 'all_categories', 'attendeesWithReviews', 'encodedAddress'));
    }

    public function getAttendeesWithReviews($event)
    {
        // Get attendees and reviews from the event
        $all_attendees = $event->attendees;
        $all_reviews = $event->eventReviews;

        // Create a collection associating attendees with their corresponding reviews
        $attendeesWithReviews = collect();

        foreach ($all_attendees as $attendee) {
            // Find the review for this attendee, if the attendee has reviewed this event
            $attendeeReview = $all_reviews->where('user_id', $attendee->user_id)->first();

            // Add attendee and their review (if any) to the collection
            $attendeesWithReviews->push([
                'attendee' => $attendee,
                'review' => $attendeeReview,
            ]);
        }

        return $attendeesWithReviews;
    }

    public function sort(Request $request, $id)
    {
        // Retrieve the event using the event ID
        $event = $this->event->findOrFail($id);

        // Get attendees with reviews
        $attendeesWithReviews = $this->getAttendeesWithReviews($event);

        // Get the sort condition from the request
        $sort = $request->input('sort', null);

        // Define sorting functions
        $sortFunctions = [
            'review_rate' => fn($attendee) => $attendee['review']->review_rate ?? 0,
            'created_at' => fn($attendee) => $attendee['review']->created_at ?? null
        ];

        // Apply sorting if a sort condition is specified
        if (isset($sortFunctions[$sort])) {
            $attendeesWithReviews = $attendeesWithReviews->sortByDesc($sortFunctions[$sort]);
        }

        $currentDateTime = Carbon::now();
        
        return view('users.events.modals.attendees-list', compact('event', 'attendeesWithReviews', 'currentDateTime'));
    }

    public function edit($id)
    {
        $event = $this->event->findOrFail($id);

        # if the Auth user is NOT the host of the event, redirect to show page.
        if(Auth::user()->id != $event->host_id){
            return redirect()->route('event.show', $id);
        }

        $startTime = Carbon::parse($event->start_time)->format('H:i');
        $endTime = Carbon::parse($event->end_time)->format('H:i');

        return view('users.events.edit', compact('event', 'startTime', 'endTime'));
    }

    public function update(Request $request, $id)
    {
        # 1. Validate the request
        $request->validate([
            'title'        => 'required|string|max:255',
            'date'         => 'required|date',
            'start_time'   => 'required|date_format:H:i',
            'end_time'     => 'required|date_format:H:i|after:start_time',
            'address'      => 'required|string|max:255',
            'price'        => 'required|string|max:255',
            'description'  => 'required|string',
            'image'        => 'mimes:jpeg,jpg,png,gif|max:1048'
        ]);

        # 2. Update the event
        $event = $this->event->findOrFail($id);
        $event->title        = $request->title;
        $event->date         = $request->date;
        $event->start_time   = $request->start_time;
        $event->end_time     = $request->end_time;
        $event->address      = $request->address;
        $event->price        = $request->price;
        $event->description  = $request->description;
        //  if there is a new image
        if($request->image){
            $event->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        }
        $event->save();

        # 3. Redirect to Show Event page (to confirm the update)
        return redirect()->route('event.show', $id);
    }

    public function destroy($id)
    {
        $event = $this->event->findOrFail($id);
        $community_id = $event->community->id;
        $event->delete();

        return redirect()->route('communities.show', $community_id);
    }
}
