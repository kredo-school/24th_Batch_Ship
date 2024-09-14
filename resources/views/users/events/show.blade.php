@extends('layouts.app')

@section('title', 'Show Event')
    
@section('content')
    
    <div class="container-fluid bg-yellow rounded p-3">
        <div class="row py-3">
            {{-- Title --}}
            <div class="col-10">
                <h1 class="h1">{{ $event->title }}</h1>
            </div>
            {{-- Join Button --}}
            @if (Auth::user()->id !== $event->host_id)
                <div class="col-2">
                    @if ($event->isJoining())
                        <form action="{{ route('event.unjoin', $event->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                
                            <button type="submit" class="btn btn-lg text-turquoise float-end">Unjoin</button>
                        </form>
                    @else
                        <form action="{{ route('event.join', $event->id) }}" method="post">
                            @csrf

                            <button type="submit" class="btn btn-turquoise btn-lg text-white float-end">Join</button>
                        </form>
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
                <p class="mt-2">
                    <i class="fa-solid fa-location-dot"></i> <a href="#">location</a> <span class="text-secondary">{{ $event->address }}</span>
                </p>
                {{-- Description --}}
                <h1 class="h4">Event Description</h1>
                <p>{{ $event->description }}</p>
            </div>

            {{-- Right Side of Contents --}}
            <div class="col-4">
                {{-- Community this event belongs to --}}
                <div class="row">
                    <a href="{{ route('communities.show', $event->community->id) }}" class="text-decoration-none">
                        <div class="card border-0 w-auto mx-auto bg-transparent">
                            <img src="{{ $event->community->image }}" alt="{{ $event->community->title }}" class="card-img-top">
                            <div class="card-body">
                                <div class="row">
                                    <h5 class="h5 card-title">{{ $event->community->title }}</h5>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        @foreach ($all_categories as $category)
                                            <a href="#" class="badge bg-turquoise text-white text-decoration-none">{{ $category->category->name }}</a>
                                        @endforeach
                                    </div>
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
                {{-- Created by --}}
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

                {{-- Attendees --}}
                <div class="row mt-3">
                    {{-- Number of attendees --}}
                    <div class="col">
                        <h1 class="h6">Attendees ({{ $event->attendees->count() }})</h1>
                    </div>
                    {{-- More than 11 users, "see all" button will appear --}}
                    @if ($event->attendees->count() >10)
                        <div class="col text-end">
                            <a href="#" class="fw-bold text-decoration-none" data-bs-toggle="modal" data-bs-target="#attendees-{{ $event->id }}">see all</a>
                            @include('users.events.modals.attendees-list')
                        </div>
                    @endif
                </div>
                {{-- Attendees list up to 10 --}}
                @if (count($event->attendees) > 0)
                    <div class="d-flex">
                        @foreach (collect($all_attendees)->take(10) as $attendee)
                            <div class="me-2">
                                <a href="{{ route('users.profile.specificProfile', $attendee->user_id) }}" class="text-decoration-none">
                                    @if ($attendee->user->avatar)
                                        <img src="{{ $attendee->user->avatar }}" alt="{{ $attendee->user->username }}" class="rounded-circle avatar-sm">
                                    @else
                                        <i class="fa-solid fa-circle-user text-dark icon-sm"></i>
                                    @endif
                                </a> 
                            </div>
                        @endforeach
                    </div>
                @endif


                {{-- Review form will appear after the event --}}
                @if ($currentDateTime->greaterThan($event->date . ' ' . $event->end_time))
                    <div class="row mt-3">
                        <div class="col-8">
                            <form action="#" method="post">
                                @csrf
                                <h1 class="h6">Review Event</h1>
                                <div class="input-group d-line">
                                    <input type="number" name="interest%" id="" class="form-control bg-white border-0 text-end">
                                    <span class="input-group-text bg-white border-0">%</span>
                                    <button class="btn bg-turquoise text-white rounded fw-bold px-2 py-0">Send review <i class="fa-solid fa-face-grin-wide"></i> </button>      
                                </div>
                            </form>                        
                        </div>
                    </div>  
                @endif

                {{-- Edit/Delete Button --}}
                @if (Auth::user()->id === $event->host_id)
                    <div class="row mt-5 d-flex justify-content-end">
                        <div class="col text-end">
                            <a href="{{ route('event.edit', $event->id) }}" class="btn bg-gold text-white py-1">
                                <i class="fa-solid fa-pen-to-square"></i>
                                Edit event
                            </a>
                            <button type="button" class="btn bg-white text-danger py-1 ms-2" data-bs-toggle="modal" data-bs-target="#delete-event-{{ $event->id }}">
                                <i class="fa-solid fa-trash-can"></i> 
                                Delete event
                            </button>
                        </div>
                    </div>
                    @include('users.events.modals.delete') 
                @endif
            </div>
        </div>
    </div>
@endsection
