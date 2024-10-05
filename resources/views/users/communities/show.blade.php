@extends('layouts.app')

@section('title', 'Show Community')
@section('styles')
  <link rel="stylesheet" href="{{ asset('css/style_postshow.css') }}">
@endsection

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
            @if  (Auth::user()->id === $community->owner_id || $community->isJoining())
              <form action="{{ route('boardcomment.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- input for comments --}}
                <input type="hidden" name="community_id" value="{{ $community->id }}">
                <div class="row">
                  <div class="col-1"></div>
                  <div class="col-10 mb-2">
                    <div class="input-group">
                      <textarea name="comment_body" rows="1" class="form-control form-control-sm rounded shadow-sm" placeholder="write a comment"></textarea>
                      <button type="submit" value="send" class="btn btn-turquoise rounded fw-bold mx-2 px-4 py-0 w-25">Post</button>  
                    </div> 
                    @error('comment_body')
                      <p class="mb-0 text-danger samll">{{ $message }}</p>
                    @enderror             
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
            @else
              <form action="#" method="#" enctype="multipart/form-data">
                @csrf
                {{-- input for comments --}}
                <input type="hidden" name="community_id" value="{{ $community->id }}">
                <div class="row">
                  <div class="col-1"></div>
                  <div class="col-10 mb-2">
                    <div class="input-group">
                      <textarea name="comment_body" rows="1" class="form-control form-control-sm rounded shadow-sm" placeholder="you should join this community to post the comment!"></textarea>
                      <button type="submit" value="send" class="btn btn-turquoise rounded fw-bold mx-2 px-4 py-0 w-25">Post</button>  
                    </div> 
                    @error('comment_body')
                      <p class="mb-0 text-danger samll">{{ $message }}</p>
                    @enderror             
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
            @endif
              
            <hr class="my-3">

            {{-- comments list --}}
            <div class="overflow-scroll boardheight">
              @include('users.communities.comments.list-item')
            </div>
            
          </div>
      </div>{{-- end of left side --}}
    
      {{-- right side --}}
      <div class="col-md-4">
        {{-- Show JOIN/UNJOIN button for user, or EDIT button for community owner --}}
        @if (Auth::user()->id !== $community->owner_id) {{-- Check if the user is not the community owner --}}
          @php
            $isJoining = $community->isJoining(); // Check if the user is currently joined to the community
            $isActiveEvent = $community->activeEventHost() || $community->activeEventAttendee();
            // Check if there are active events hosted or attended by the user
          @endphp

          <form action="{{ $isJoining ? ($isActiveEvent ? '#' : route('community.unjoin', $community->id)) : route('community.join', $community->id) }}" method="POST"> {{-- Set the form action based on the user's join status and active events --}}
            @csrf
            @if ($isJoining && !$isActiveEvent) {{-- If the user is joined and there are no active events --}}
              @method('DELETE') {{-- Use DELETE method to UNJOIN the community --}}
            @endif
            
            <div class="mb-3 d-flex justify-content-end">
              <button class="btn btn-gold m-3" {!! ($isJoining && $isActiveEvent) ? 'type="button" data-bs-toggle="modal" data-bs-target="#unjoin-warning-' . $community->id . '"' : '' !!}>
                {{ $isJoining ? 'UNJOIN' : 'JOIN' }}
              </button>
            </div>
          </form>

          {{-- Warning modal for active event host or attendee --}}
          @if ($isJoining && $isActiveEvent)
            @include('users.communities.modals.unjoin-warning')
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
              <i class="fa-solid fa-circle-user text-dark icon-sm"></i>   
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

        {{-- Interests --}}
        <div class="row mb-3">
          <form action="" method="post">
            @csrf
            <label for="enpathy" class="fw-bold mb-2">Interest:</label>
            <div class="range-slider">
                <input type="range" id="percentage" name="percentage" value="60"
                    min="60" max="100" step="1" list="my-datalist"
                    class="bg-turquoise"
                    oninput="document.getElementById('output1').value=this.value">
                <output id="output1" class="m-2">60</output><span>%</span>
            </div>
            <button type="submit" class="btn btn-gold form-group mt-3 ml-1 btn-sm">Send</button>
          </form>
        </div>
      
        {{-- Category --}}
        <div class="mb-3 ">
          <h6>Category</h6>
            <div class="col">
              @if ($community->categories)
                @foreach ($community->categories as $category)
                <a href="{{ route('users.categories.show', $category->id) }}" class="badge me-1 bg-turquoise text-decoration-none">{{ $category->name }}</a>
                @endforeach
              @else
                  <span class="badge bg-turquoise mt-1">Uncategorized</span>
              @endif
          </div>
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