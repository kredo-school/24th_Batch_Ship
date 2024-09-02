@extends('layouts.app')

@section('title', 'Show Event')
    
@section('content')
    
    <div class="container-fluid bg-yellow rounded p-3">
        <div class="row py-3">
            {{-- Title --}}
            <div class="col-10">
                <h1 class="h1">Event Title</h1>
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
                <img src="https://images.pexels.com/photos/225224/pexels-photo-225224.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="#" class="grid-img" >
                <br>
                {{-- Date --}}
                <p class="d-inline me-4 mt-2">
                    <i class="fa-regular fa-calendar"></i> 2024/12/25  18:30-20:30
                </p>
                {{-- Price --}}
                <p class="d-inline mt-2">
                    <i class="fa-solid fa-money-check-dollar"></i> JPY 3,000
                </p>
                {{-- Location --}}
                <p class="mt-2">
                    <i class="fa-solid fa-location-dot"></i> <a href="#">SHIBUYA CAST</a> <span class="text-secondary">ADDRESS</span>
                </p>
                {{-- Description --}}
                <h1 class="h4">Event Description</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat sed quibusdam aliquam excepturi repellat vel exercitationem soluta nihil voluptas. Ipsam inventore eum recusandae dolorem omnis cupiditate itaque quidem tenetur eos?</p>
            </div>

            {{-- Right Side of Contents --}}
            <div class="col-4">
                {{-- Community this event belongs to --}}
                <div class="row">
                    <a href="#" class="text-decoration-none">
                        <div class="card border-0 w-auto mx-auto">
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
                {{-- Atendees --}}
                <div class="row mt-3">
                    <div class="col">
                        <h1 class="h6">Attendees (12)</h1>
                    </div>
                    <div class="col text-end">
                        <a href="#" class="fw-bold text-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#atendees">see all</a>
                    </div>
                </div>
                <div class="row mt-1 d-inline">
                    <a href="#">
                        <i class="fa-solid fa-circle-user text-dark icon-sm"></i>
                    </a>
                </div>
                {{-- Review form --}}
                <div class="row mt-3">
                    <h1 class="h6">Review Event</h1>
                    <form action="#" method="post">
                        @csrf

                        <input type="number" name="#" id="#" class="form-control w-30">
                    </form>
                </div>
                {{-- Edit/Delete Button --}}
                <div class="row mt-3">

                </div>
            </div>
        </div>
    </div>
@endsection
