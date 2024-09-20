@extends('layouts.app')

@section('title', 'Show Community')

@section('content')

  <div class="container-fluid">
    <div class="row bg-blue rounded justify-content-center">
      {{-- left side --}}
      <div class="col-md-8 px-4">
        {{-- cover img & description --}}
        <div class="mt-3 text-center">
          <img src="{{ $community->image }}" class="object-fit-cover border image-community rounded bg-white w-100" alt="{{ $community->title }}">
          <h2 class="my-2">{{ $community->title }}</h2>
          <p class="lh-sm">
            {{ $community->description }}
          </p>
        </div>

          {{-- bulletin board --}}
          <div class="container bg-white p-3 w-100">
            <form action="{{ route('boardcomment.store', $community->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- input for comments --}}
                <div class="row">
                  <div class="col-1"></div>
                  <div class="col-10">
                    <div class="mb-2 input-group">
                      <textarea name="comment_body{{ $community->id }}" rows="1" class="form-control form-control-sm rounded shadow-sm" placeholder="write a comment"></textarea>
                      @error('comment_body' . $community->id)
                      <p class="mb-0 text-danger samll">{{ $message }}</p>
                      @enderror
                      <button type="submit" value="send" class="btn btn-turquoise rounded fw-bold mx-2 px-4 py-0 w-25">Post</button>  
                    </div>              
                  </div>
                  <div class="col"></div>
                </div>
                <div class="row">
                  <div class="col-1"></div>
                  <div class="col-7">
                    {{-- input to uploard img --}}
                    <input type="file" class="form-control form-control-sm"  name="image" id="image" >
                    {{-- Error message area --}}
                    @error('image')
                      <div class="text-danger small">{{ $message }}</div>
                    @enderror
                  </div>
                </div>        
            </form>
                
            <hr class="my-3">

            {{-- comments list --}}
            <div class="overflow-scroll boardheight">
              @include('users.communities.comments.list-item')
            </div>
            
          </div>
      </div>{{-- end of left side --}}
    
      {{-- right side --}}
      <div class="col-md-4">
        {{-- Distinguish by user[JOIN/UNJOIN] or community owner[EDIT] --}}
        @if (Auth::user()->id !== $community->owner_id)
          {{-- JOIN/UNJOIN button for user --}}
          @if ($community->isJoining())
            {{-- UNJOIN --}}
            <form action="{{ $community->eventHost() ? '#' : route('community.unjoin', $community->id) }}" method="POST">
              @csrf
              @if (!$community->eventHost())
                @method('DELETE')
              @endif

              <div class="mb-3 d-flex justify-content-end">
                <button class="btn btn-gold m-3" 
                  {!! $community->eventHost() ? 'type="button" data-bs-toggle="modal" data-bs-target="#unjoin-warning-' . $community->id . '"' : '' !!}>
                  UNJOIN
                </button>
              </div>
            </form>
            @if ($community->eventHost())
              {{-- WARNING for event host --}}
              @include('users.communities.modals.unjoin-warning')
            @endif
          @else
           {{-- JOIN --}}
            <form action="{{ route('community.join', $community->id) }}" method="POST">
              @csrf

              <div class="mb-3 d-flex justify-content-end">
                <button class="btn btn-gold m-3">JOIN</button>
              </div> 
            </form>    
          @endif
        @else
          {{-- EDIT button for community owner --}}
          <div class="mb-3 d-flex justify-content-end">
            <a href="{{ route('communities.edit', $community->id) }}" class="btn btn-gold m-3">EDIT</a>
          </div>   
        @endif

        {{-- Community owner --}}
        <div class="mb-3">
          <h6>Created by</h6>
          <a href="{{ route('users.profile.specificProfile', $community->owner_id) }}">
            @if ($community->user->avatar)
              <img src="{{ $community->user->avatar }}" alt="{{ $community->user->username }}" class="rounded-circle avatar-sm"> 
            @else
              <i class="fa-solid fa-circle-user icon-sm"></i>   
            @endif    
          </a>   
        </div>

        {{-- Members --}}
        <div class="row mb-3">
          <div class="col">
            {{-- Number of members --}}
            <h6>Members({{ $community->members->count() }})</h6>
          </div>
          @if (count($community->members) > 0)
            <div class="col text-end">
              <a href="#" class="text-decoration-none fw-bold me-4" data-bs-toggle="modal" data-bs-target="#community-members-{{ $community->id }}">See all</a>
              @include('users.communities.modals.members-list')
            </div>
            {{-- Attendees list up to 10 --}}
            <div class="d-flex">
              @foreach (collect($all_members)->take(10) as $member)
                <div class="me-2">
                  <a href="{{ route('users.profile.specificProfile', $member->user_id) }}" class="text-decoration-none">
                    @if ($member->user->avatar)
                      <img src="{{ $member->user->avatar }}" alt="{{ $member->user->username }}" class="rounded-circle avatar-sm">
                    @else
                      <i class="fa-solid fa-circle-user text-dark icon-sm"></i>
                    @endif
                  </a> 
                </div>
              @endforeach
            </div>
          @endif
        </div>

        {{-- Interets --}}
        <div class="row mb-3">
          <form action="" method="post">
            @csrf
            <h6>Interest</h6>
            <div class="col-6">
              <div class="input-group">
                <input type="number" name="interest%" id="" class="form-control border-0 text-end">
                <span class="input-group-text bg-white border-0">%</span>
                <button class="btn bg-turquoise text-white rounded fw-bold px-3 py-0">Send</button>      
              </div>
            </div>     
          </form>
        </div>
      
        {{-- Category --}}
        <div class="mb-3 ">
          <h6>Category</h6>
          @foreach ($all_categories as $category)
            <div class="badge border-0 bg-turquoise text-white px-2">
              {{ $category->category->name }}
            </div>   
          @endforeach
        </div>
      
        {{-- Events --}}
        <div class="mb-3 d-flex justify-content-between align-items-center">
          <h6 class="align-items-center">Events({{ $community->events->count() }})</h6>
          @if (Auth::user()->id === $community->owner_id || $community->isJoining())
            <a href="{{ route('event.create', $community->id) }}" class="btn btn-gold me-4">
              NEW <i class="fa-solid fa-plus"></i>
            </a>  
          @endif
        </div>
        @include('users.communities.events.list-item')

      </div> {{-- end of right side --}}
    </div> {{-- end of row --}}
  </div> {{-- end of container --}}
@endsection