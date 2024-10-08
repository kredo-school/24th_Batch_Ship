@extends('layouts.app')

@section('title', 'Show Event')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/style_event.css') }}">
@endsection

@section('content')
<div class="container-fluid bg-yellow rounded p-3">
    <div class="row py-3">
        {{-- Title --}}
        <div class="col-9">
            <h1 class="h1">{{ $event->title }}</h1>
        </div>
        {{-- Join Button --}}
        @if (Auth::user()->id !== $event->host_id)
            <div class="col-3">
                @if ($currentDate->lessThan($event->date))
                    @php
                        $isJoining = $event->isJoining();
                        $isCommunityOwner = $event->community->owner_id === Auth::user()->id;
                        $isCommunityMember = $event->community->members->contains('user_id', Auth::user()->id);
                    @endphp

                    @if ($isJoining)
                        <form action="{{ route('event.unjoin', $event->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-turquoise float-end">UNJOIN</button>
                        </form>
                    @elseif ($isCommunityOwner || $isCommunityMember)
                        <form action="{{ route('event.join', $event->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-turquoise float-end">JOIN</button>
                        </form>
                    @else
                        {{-- Warning modal for NON community member --}}
                        <button type="button" class="btn btn-turquoise float-end" data-bs-toggle="modal" data-bs-target="#join-warning-{{ $event->id }}">JOIN</button>
                        @include('users.events.modals.join-warning')
                    @endif
                @else
                    <p class="text-danger small mt-2">
                        You can no longer JOIN or UNJOIN this event as it has either reached its deadline or has already occurred.
                    </p>
                @endif
            </div>  
        @endif
    </div>

    <div class="row py-3">
        {{-- Left Side of Contents --}}
        <div class="col-8">
            {{-- Cover Photo --}}
            <img src="{{ $event->image }}" alt="{{ $event->title }}" class="grid-img" >
            <br>
            {{-- Date --}}
            <p class="d-inline me-4 mt-2">
                <i class="fa-regular fa-calendar"></i> {{ $date }} {{ $startTime }} ~ {{ $endTime }}
            </p>
            {{-- Price --}}
            <p class="d-inline mt-2">
                <i class="fa-solid fa-money-check-dollar"></i> {{ $event->price }}
            </p>
            {{-- Location --}}
            <p class="mt-2" data-address="{{ $encodedAddress }}">
                <i class="fa-solid fa-location-dot"></i> 
                <a href="#" onclick="showMap(); return false;" class=" text-decoration-none text-dark">location</a>
                <span class="text-secondary">{{ $event->address }}</span>
                    {{-- to show up the map of location in this page --}}
                <iframe id="mapFrame" class="w-100" frameborder="0" 
                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBgnnNXBIrWe7BxLsZufXeD9kxHb91U7Bk&q={{ urlencode($event->address) }}"></iframe>
            </p>

            {{-- Description --}}
            <h1 class="h4">Event Description</h1>
            <p>{{ $event->description }}</p>
        </div>

        {{-- Right Side of Contents --}}
        <div class="col-4">
            {{-- Community information this event belongs to --}}
            <div class="row">
                <a href="{{ route('communities.show', $event->community->id) }}" class="text-decoration-none text-black">
                    <div class="card border-0 w-auto mx-auto bg-transparent">
                        <img src="{{ $event->community->image }}" alt="{{ $event->community->title }}" class="card-img-top">
                        <div class="card-body">
                            <div class="row">
                                <h5 class="h5 card-title">{{ $event->community->title }}</h5>
                            </div>
                            <div class="row">
                                <div class="col">
                                    @if($event->categories->isNotEmpty())
                                        @foreach ($event->categories as $category)
                                            <a href="{{ route('users.categories.show', $category->id) }}" class="badge me-1 bg-turquoise text-decoration-none">{{ $category->name }}</a>
                                        @endforeach
                                    @else
                                        <span class="badge bg-turquoise mt-1">Uncategorized</span>
                                    @endif
                                </div>

                                {{-- Community owner --}}
                                <div class="col">
                                    <p class="text-end">Created by 
                                        <a href="{{ route('users.profile.specificProfile', $event->community->owner_id) }}">
                                            @if ($event->community->user->avatar)
                                                <img src="{{ $event->community->user->avatar }}" alt="{{ $event->community->user->username }}" class="rounded-circle avatar-sm">  
                                            @else
                                                <i class="fa-solid fa-circle-user text-dark icon-sm"></i>  
                                            @endif
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            
            {{-- Event host --}}
            <div class="row mt-3">
                <h1 class="h6">Created by</h1>
                <a href="{{ route('users.profile.specificProfile', $event->host_id) }}">
                    @if ($event->host->avatar)
                        <img src="{{ $event->host->avatar }}" alt="{{ $event->host->username }}" class="rounded-circle avatar-sm">   
                    @else
                        <i class="fa-solid fa-circle-user text-dark icon-sm"></i>  
                    @endif
                </a>
            </div>

            {{-- Event Attendees --}}
            <div class="row d-flex align-items-center mt-3">
                {{-- Number of attendees --}}
                <div class="col-10">
                    <h1 class="h6">Attendees ({{ $event->attendees->count() }})</h1>
                </div>
                <div class="col-auto">
                    <a href="#" class="fw-bold text-decoration-none" data-bs-toggle="modal" data-bs-target="#attendees-{{ $event->id }}">see all</a>
                    {{-- @include('users.events.modals.attendees-list') --}}
                </div>
            </div>
            {{-- Show up to 12 attendees --}}
            @if ($attendeesWithReviews->isNotEmpty())
                <div class="d-flex flex-wrap">
                    @foreach ($attendeesWithReviews->take(12) as $attendeeWithReview)
                        <div class="me-2 mb-1">
                            <a href="{{ route('users.profile.specificProfile', $attendeeWithReview['attendee']->user_id) }}" class="text-decoration-none">
                                @if ($attendeeWithReview['attendee']->user->avatar)
                                    <img src="{{ $attendeeWithReview['attendee']->user->avatar }}" alt="{{ $attendeeWithReview['attendee']->user->username }}" class="rounded-circle avatar-sm">
                                @else
                                    <i class="fa-solid fa-circle-user text-dark icon-sm"></i>
                                @endif
                            </a>
                            
                            {{-- If user has reviewed this event, retrieve review_rate % --}}
                            @if ($attendeeWithReview['review'])
                                <div class="no-margin">
                                    <p>{{ $attendeeWithReview['review']->review_rate }}%</p>
                                </div> 
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Review form will appear after the event --}}
            @if ($currentDateTime->greaterThan($event->date . ' ' . $event->end_time) && 
                $event->attendees->contains('user_id', Auth::user()->id))
                <div class="row mt-3">
                    <form action="{{ route('event.review', $event->id)}}" method="post">
                        @csrf

                        <h1 class="h6">Review Event</h1>
                        {{-- Review Slider for attendees --}}
                        <div class="row d-flex ms-1">
                            <div class="range-slider d-flex align-items-center">
                                <input type="range" id="percentage" name="review_rate" value="60" min="60" max="100" step="1" list="my-datalist" class="bg-turquoise" oninput="document.getElementById('output1').value=this.value">
                                <output id="output1" class="m-2">60</output><span>%</span>
                                @error('review_rate')
                                    <div class="text-danger small ms-2">{{ $message }}</div> 
                                @enderror
                            </div>
                        </div> 

                        {{-- Comment for event --}}
                        <div class="row d-flex mt-2">
                            <div class="col-9">
                                <textarea name="review_comment" rows="1" class="form-control" placeholder="Add a comment...">{{ old('review_comment') }}</textarea>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-gold px-3">SEND</button>  
                            </div>
                            @error('review_comment')
                                <div class="text-danger small">{{ $message }}</div> 
                            @enderror
                        </div>   
                    </form>
                </div>
            @endif

            {{-- Edit/Delete Button --}}
            @if (Auth::user()->id === $event->host_id)
                @if ($currentDate->lessThan($event->date))
                    <div class="row mt-5 d-flex justify-content-end">
                        <div class="col text-end">
                            <a href="{{ route('event.edit', $event->id) }}" class="btn bg-gold text-white py-1">
                                <i class="fa-solid fa-pen-to-square"></i>
                                Edit Event
                            </a>
                            <button type="button" class="btn bg-white text-danger py-1 ms-2" data-bs-toggle="modal" data-bs-target="#delete-event-{{ $event->id }}">
                                <i class="fa-solid fa-trash-can"></i> 
                                Delete Event
                            </button>
                        </div>
                    </div>
                    @include('users.events.modals.delete') 
                @else
                    <div class="row mt-5 d-flex justify-content-end">
                        <div class="col">
                            <p class="text-danger small">
                                This event can no longer be Edited or Deleted as it has either reached its deadline or has already occurred.
                            </p>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Google Maps API -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgnnNXBIrWe7BxLsZufXeD9kxHb91U7Bk&libraries=places&callback=initMap"></script>

<!-- JavaScript -->
<script src="{{ asset('js/events/google-map.js') }}"></script>
@endsection
