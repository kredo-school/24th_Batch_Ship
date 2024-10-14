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
          <h2 class="my-2 break-word">{{ $community->title }}</h2>
          <p class="lh-sm">
            {{ $community->description }}
          </p>
        </div>

          {{-- bulletin board --}}
          <div class="container bg-white p-3 w-100">
            @if (Auth::user()->id === $community->owner_id || $community->isJoining())
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
        <div class="row d-flex align-items-center mb-2">
          <div class="row">
            <div class="col-6">
              {{-- Number of members --}}
              <h6>Members({{ $community->members->count() }})</h6>
            </div>
            <div class="col-6">
              @if ($community->members->isNotEmpty())
                <div class="text-end">
                  <a href="#" class="text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#community-members">See all</a>
                  @include('users.communities.modals.members-list')
                </div>
              @endif
            </div>
          </div>
          @if ($community->members->isNotEmpty())
            {{-- Show up to 12 members --}}
            <div class="d-flex flex-wrap mt-2">
              @foreach ($community->members->take(12) as $member)
                <div class="me-2 mb-1">
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
          <div class="col-12">
            @if (Auth::user()->id === $community->owner_id || $community->isJoining())
            <label for="enpathy" class="fw-bold mb-2 h6">Interest:</label>
              @if (!($community->user->id === Auth::user()->id))
                @if (in_array(strval(Auth::user()->id), $all_interestrate_users))
                  <form action="{{ route('interest.update',  $interests_id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                      <div class="range-slider">
                        <input type="range" id="percentage" name="percentage" value="60"
                            min="60" max="100" step="1" list="my-datalist"
                            class="bg-turquoise"
                            oninput="document.getElementById('output1').value=this.value">
                        <output id="output1" class="m-2">{{ $user_percentage }}</output><span>%</span>
                        <button type="submit" class="btn btn-gold ms-4 form-group ml-1 btn-sm">Send</button>
                      </div>
                  </form>
                @else
                  <form action="{{ route('interest.store', $community->id)}}" method="post">
                    @csrf
                      <div class="range-slider">
                        <input type="range" id="percentage" name="percentage" value="60"
                            min="60" max="100" step="1" list="my-datalist"
                            class="bg-turquoise"
                            oninput="document.getElementById('output1').value=this.value">
                        <output id="output1" class="m-2">60</output><span>%</span>
                        <button type="submit" class="btn btn-gold ms-4 form-group ml-1 btn-sm">Send</button>
                      </div>
                  </form>  
                @endif
              @else

              @endif
            @else

            @endif
          </div>
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
        <div class="mt-4 mb-1 d-flex justify-content-between align-items-center">
          <h6 class="align-items-center">Incoming Events({{ $community->events()->where('date', '>=', \Carbon\Carbon::now())->count() }})</h6>
          @if (Auth::user()->id === $community->owner_id || $community->isJoining())
            <a href="{{ route('event.create', $community->id) }}" class="btn btn-gold me-4 btn-sm">
              NEW <i class="fa-solid fa-plus"></i>
            </a>  
          @endif
        </div>
        <div>
          @include('users.communities.events.list-item')
        </div>
        <div class="mt-5 mb-1 d-flex justify-content-between align-items-center">
          <h6 class="align-items-center mt-6">Past Events({{ $community->events()->where('date', '<', \Carbon\Carbon::now())->count() }})</h6>
        </div>
        <div>
          @include('users.communities.events.list-pastitem')
        </div>

        

      </div> {{-- end of right side --}}
    </div> {{-- end of row --}}
  </div> {{-- end of container --}}
@endsection

@section('scripts')
<!-- JavaScript -->
<script src="{{ asset('js/community/sort-interest.js') }}"></script>

@endsection

