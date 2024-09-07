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
            <div class="col-2">
                <form action="#" method="post">
                    @csrf

                    <button type="submit" class="btn btn-turquoise btn-lg text-white float-end">Join</button>
                </form>
            </div>
        </div>

        <div class="row py-3">
            {{-- Left Side of Contents --}}
            <div class="col-8">
                {{-- Cover Photo --}}
                <img src="{{ $event->image }}" alt="event id {{ $event->id }}" class="grid-img" >
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
                    <a href="#" class="text-decoration-none">
                        <div class="card border-0 w-auto mx-auto bg-transparent">
                            <img src="https://img.freepik.com/free-vector/hand-drawn-english-book-background_23-2149483336.jpg?size=626&ext=jpg" alt="#" class="card-img-top">
                            <div class="card-body">
                                <div class="row">
                                    <h5 class="h5 card-title">Community Title</h5>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <a href="#" class="badge bg-turquoise text-white text-decoration-none">Category #1</a>
                                    </div>
                                    <div class="col">
                                        <p class="text-end">Created by <a href="#"><i class="fa-solid fa-circle-user text-dark icon-sm"></i></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- Created by --}}
                <div class="row mt-3">
                    <h1 class="h6">Created by</h1>
                    <a href="#">
                        <i class="fa-solid fa-circle-user text-dark icon-sm"></i>
                    </a>
                </div>
                {{-- Attendees --}}
                <div class="row mt-3">
                    <div class="col">
                        <h1 class="h6">Attendees (12)</h1>
                    </div>
                    <div class="col text-end">
                        <a href="#" class="fw-bold text-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#attendees">see all</a>
                        @include('users.events.modals.attendees-list')
                    </div>
                </div>
                <div class="row mt-1 d-inline">
                    <a href="#">
                        <i class="fa-solid fa-circle-user text-dark icon-sm"></i>
                    </a>
                </div>
                {{-- Review form --}}
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
                {{-- Edit/Delete Button --}}
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
            </div>
        </div>
    </div>
@endsection
