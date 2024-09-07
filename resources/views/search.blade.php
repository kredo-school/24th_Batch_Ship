@extends('layouts.app')

@section('title', 'Search')

@section('content')

<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<div class="container-fluid search-bg">
  <h1 class="fw-bold text-center">Your Key word is: "{{ $search }}"</h1>
  
  @if(isset($no_results_message))
  <p class="text-danger text-center">{{ $no_results_message }}</p>
  @endif   

  {{-- User --}}
  <div class="mt-5 bg-green p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="mb-0">User</h2>
      {{-- @if(!empty($result_users)) --}}
      <p class="h5 text-decoration-underline text-primary mb-0">
        <a href="#">see more</a>
      </p>
      {{-- @endif --}}
    </div>
    <div class="row">
      {{-- @foreach($result_users as $user) --}}
      <div class="col-md-4 mb-3">
        <div class="card border-0">
          <div class="card-body border border-2 p-2 mb-0">
            <div class="d-flex align-items-center">
              {{-- avatar & name --}}
              {{-- <div class="me-2">{{ $user->avatar }}</div> --}}
              {{-- <h6>{{ $user->username }}</h6> --}}
              <i class="fa-solid fa-circle-user icon-sm me-2"></i>
              <h6 class="mb-0">Username</h6>                        
            </div>
            {{-- introduction --}}
            <p class="xsmall mb-2">
              {{-- {{ $user->introduction }} --}}
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque a maxime libero accusantium placeat necessitatibus provident nemo earum ratione ad! Iste tempora consectetur.
            </p>
            {{-- interest(categories) --}}
            <div>
              {{-- @foreach($post->categories as $category) --}}
              {{-- <span class="badge me-1 bg-turquoise text-white">{{ $category->name }}</span> --}}
              <span class="badge me-1 bg-turquoise text-white">Category 1</span>
              {{-- @endforeach --}}
            </div>
          </div>
        </div>
      </div>
      {{-- @endforeach --}}
    </div>
  </div>
  
  {{-- Post --}}
  <div class="mt-5 bg-pink p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="mb-0">Post</h2>
      {{-- @if(!empty($result_posts)) --}}
      <p class="h5 text-decoration-underline text-primary mb-0">
        <a href="#">see more</a>
      </p>
      {{-- @endif --}}
    </div>
    <div class="row">
      {{-- @foreach($result_posts as $post) --}}
      <div class="col-md-4 mb-3">
        <div class="card border-0">
          <div class="card-body p-0 pb-1 border border-2">
            {{-- Post image --}}
            <div class="mb-1">
              {{-- <img class="w-100" src="{{ $post->image }}" alt=""> --}}
              <img src="https://img.freepik.com/free-vector/flat-design-tweet-mockup_23-2149200431.jpg?size=338&ext=jpg&ga=GA1.1.2008272138.1724803200&semt=ais_hybrid" alt="" class="w-100 object-fit-cover">
            </div>
            {{-- avatar & name --}}
            <div class="d-flex align-items-center p-2">
              {{-- <div class="me-2">{{ $user->avatar }}</div> --}}
              {{-- <h6>{{ $user->username }}</h6> --}}
              <i class="fa-solid fa-circle-user icon-sm me-2"></i>
              <h6 class="mb-0">Username</h6>                        
            </div>
            {{-- Post category --}}
            <div>
              {{-- @foreach($post->categories as $category) --}}
              {{-- <span class="badge me-1 bg-turquoise text-white">{{ $category->name }}</span> --}}
              <span class="badge m-2 bg-turquoise text-white">Category 1</span>
              {{-- @endforeach --}}
            </div>
          </div>
        </div>
      </div>
      {{-- @endforeach --}}
    </div>
  </div>

  {{-- Community --}}
  <div class="mt-5 bg-blue p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="mb-0">Community</h2>
      {{-- @if(!empty($result_communities)) --}}
      <p class="h5 text-decoration-underline text-primary mb-0">
        <a href="#">see more</a>
      </p>
      {{-- @endif --}}
    </div>
    <div class="row">
      {{-- @foreach($result_communities as $community) --}}
      <div class="col-md-4 mb-3">
        <div class="card border-0">
          <div class="card-body p-0 border border-2">
            {{-- Community cover image --}}
            <div class="mb-">
              {{-- <img src="{{ $community->image }}" alt=""> --}}
              {{-- <h6>{{ $community->title }}</h6> --}}
              <img src="https://images.pexels.com/photos/3408354/pexels-photo-3408354.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="" class="img-fluid">
            </div>
            {{-- Community title & owner --}}
            <div class="card-body p-2 pb-1">
              {{-- <h6>{{ $community->title }}</h6> --}}
              <h6>Community Title</h6>
              <div class="d-flex align-items-center justify-content-end">
                <p class="m-0 pe-2">Created by Username</p>
                <i class="fa-solid fa-circle-user icon-sm"></i>
              {{-- <div class="me-2">{{ $user->avatar }}</div> --}}                
              </div>                                         
            </div>
          </div>
        </div>
      </div>
      {{-- @endforeach --}}
    </div>
  </div>
  
  {{-- Event --}}
  <div class="mt-5 bg-yellow p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="mb-0">Event</h2>
      {{-- @if(!empty($result_events)) --}}
      <p class="h5 text-decoration-underline text-primary mb-0">
        <a href="#">see more</a>
      </p>
      {{-- @endif --}}
    </div>
    <div class="row">
      {{-- @foreach($result_events as $event) --}}
      <div class="col-md-4 mb-3">
        <div class="card border-0">
          <div class="card-body p-0 border border-2">
            {{-- Event image --}}
            <div class="mb-2">
              {{-- <img src="{{ $event->image }}" alt=""> --}}
              {{-- <h6>{{ $event->title }}</h6> --}}
              <img src="https://img.freepik.com/free-vector/hand-drawn-english-book-background_23-2149483336.jpg?size=626&ext=jpg" alt="" class="img-fluid">
            </div>
            {{-- Event title & owner --}}
            <div class="card-body p-2 pb-1">
              {{-- <h6>{{ $event->title }}</h6> --}}
              <h6>Event Title</h6>
              <div class="d-flex align-items-center justify-content-end">
                <p class="m-0 pe-2">Created by Username</p>
              {{-- <p> created by {{ eventowner }}</p> --}}
                <i class="fa-solid fa-circle-user icon-sm"></i>
              {{-- <div class="me-2">{{ $user->avatar }}</div> --}}                
              </div>                                         
            </div>
          </div>
        </div>
      </div>
      {{-- @endforeach --}}
    </div>
  </div>

</div> {{-- end of container-fluid --}}
@endsection
