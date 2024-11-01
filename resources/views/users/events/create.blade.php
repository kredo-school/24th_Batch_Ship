@extends('layouts.app')

@section('title', 'Create Event')
    
@section('content')
<div class="bg-yellow p-5">
  <h1>Create new event</h1>
  <div class="container bg-green my-3 p-3">
    <form action="{{ route('event.store') }}" method="post" enctype="multipart/form-data">
      @csrf

      <div class="row m-3 gx-5">

        {{-- community title --}}
        <div class="col">
          <label for="community-title" class="form-label">Community title</label>
          {{-- Community title to be displayed --}}
          <input type="text" id="community-title" value="{{ $community->title }}" class="form-control" readonly>
          {{-- ID to send to server --}}
          <input type="hidden" name="community_id" value="{{ $community->id }}">
        </div>

        {{-- event title --}}
        <div class="col">
          <label for="event-title" class="form-label">Event title</label>
          <input type="text" name="event_title" id="event-title" value="{{ old('event_title') }}" class="form-control" autofocus>
          @error('event_title')
            <div class="text-danger small">{{ $message }}</div> 
          @enderror
        </div>
      </div>

      <div class="row m-3 gx-5">

        {{-- date --}}
        <div class="col">
          <label for="date" class="form-label">Date</label>
          <input type="date" name="date" id="date" value="{{ old('date') }}" class="form-control">
          @error('date')
            <div class="text-danger small">{{ $message }}</div> 
          @enderror
        </div>

        {{-- start time --}}
        <div class="col">
          <label for="start-time" class="form-label">Start time</label>
          <input type="time" name="start_time" id="start-time" value="{{ old('start_time') }}" class="form-control">
          @error('start_time')
            <div class="text-danger small">{{ $message }}</div> 
          @enderror
        </div>

        {{-- end time --}}
        <div class="col">
          <label for="end-time" class="form-label">End time</label>
          <input type="time" name="end_time" id="end-time" value="{{ old('end_time') }}" class="form-control">
          @error('end_time')
            <div class="text-danger small">{{ $message }}</div> 
          @enderror
        </div>

        {{-- location --}}
        <div class="col-6">
          <label for="address" class="form-label">Location</label>
          <input type="text" name="address" id="autocomplete" class="form-control" value="{{ old('address') }}">
          @error('address')
              <div class="text-danger small">{{ $message }}</div>
          @enderror
        </div>
      
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">

      </div>
      
      {{-- price --}}
      <div class="row m-3 gx-5">
        <div class="col">
          <label for="price" class="form-label">Price</label>
          <input type="text" name="price" id="price" value="{{ old('price') }}" class="form-control" placeholder="e.g. Host : JPY 500.00  Guest : Free...">
          @error('price')
            <div class="text-danger small">{{ $message }}</div> 
          @enderror
        </div>

        <div class="col">
          <label for="image" class="form-label">Image</label>
          <input type="file" name="image" id="image" class="form-control" aria-describedby="image-info">
          <div id="image-info" class="form-text">
            Acceptable formats: jpeg, jpg, png, gif only. Max file size is 1048kb.            
          </div>
          @error('image')
            <div class="text-danger small">{{ $message }}</div> 
          @enderror
        </div>
      </div>

      <div class="row m-3 gx-5">

        {{-- description --}}
        <div class="col">
          <label for="description" class="form-label">Description</label>
          <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description') }}</textarea>
        </div>
        @error('description')
          <div class="text-danger small">{{ $message }}</div> 
        @enderror
      </div>

      {{-- button --}}
      <div class="container">
        <div class="row">
          <div class="col d-flex justify-content-between">
            <a href="{{ route('communities.show', $community->id) }}" class="btn text-turquoise">Cancel</a>
            <button type="submit" class="btn btn-turquoise text-white">Save</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<!-- Google Maps API -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgnnNXBIrWe7BxLsZufXeD9kxHb91U7Bk&libraries=places&callback=initMap"></script>

<!-- JavaScript -->
<script src="{{ asset('js/events/google-map.js') }}"></script>
@endsection
