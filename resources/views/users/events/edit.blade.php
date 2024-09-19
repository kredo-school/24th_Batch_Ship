@extends('layouts.app')

@section('title', 'Edit Event')
    
@section('content')

<form action="{{ route('event.update', $event->id) }}" method="post" enctype="multipart/form-data">
  @csrf
  @method('PATCH')
    
  <div class="container-fluid bg-yellow rounded p-3">
    <div class="row mt-3">
      {{-- Title --}}
      <div class="col-6">
        <label for="event-title" class="form-label">Event title</label>
        <input type="text" name="title" id="event-title" value="{{ old('title', $event->title) }}" class="form-control">
        @error('title')
          <div class="text-danger small">{{ $message }}</div> 
        @enderror
      </div>
    </div>

    <div class="row py-3">
      {{-- Left Side of Contents --}}
      <div class="col-8">
        {{-- Display Cover Photo --}}
        <label for="image" class="form-label">Image</label>
        <img src="{{ $event->image }}" alt="{{ $event->title }}" class="grid-img" id="preview">

        {{-- Date --}}
        <div class="row mt-3 gx-5">
          <div class="col">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" value="{{ old('date', $event->date) }}" class="form-control">
            @error('date')
              <div class="text-danger small">{{ $message }}</div> 
            @enderror
          </div>
        {{-- start time --}}
          <div class="col">
            <label for="start-time" class="form-label">Start time</label>
            <input type="time" name="start_time" id="start-time" value="{{ old('start_time', $startTime) }}" class="form-control">
            @error('start_time')
              <div class="text-danger small">{{ $message }}</div> 
            @enderror
          </div>
        {{-- end time --}}
          <div class="col">
            <label for="end-time" class="form-label">End time</label>
            <input type="time" name="end_time" id="end-time" value="{{ old('end_time', $endTime) }}" class="form-control">
            @error('end_time')
              <div class="text-danger small">{{ $message }}</div> 
            @enderror
          </div>
        </div>
       
        {{-- Price --}}
        <div class="mt-3">
          <label for="price" class="form-label">Price</label>
          <input type="text" name="price" id="price" value="{{ old('price') }}" class="form-control" placeholder="e.g. Host : JPY 500.00  Guest : Free...">
          @error('price')
            <div class="text-danger small">{{ $message }}</div> 
          @enderror
        </div>

        {{-- Location --}}
        <div class="mt-3">
          <label for="address" class="form-label">Location</label>
          <input type="text" name="address" id="autocomplete" value="{{ old('address', $event->address) }}" class="form-control">
          @error('address')
            <div class="text-danger small">{{ $message }}</div> 
          @enderror

          <input type="hidden" name="latitude" id="latitude">
          <input type="hidden" name="longitude" id="longitude">

        </div>


      </div>

      {{-- rith side of contents --}}

      <div class="col-4 mt-2">
        <br>
        {{-- Update Cover Photo --}}
        <input type="file" name="image" id="image" class="form-control">
        @error('image')
          <div class="text-danger small">{{ $message }}</div> 
        @enderror

        {{-- Description --}}
        <div class="mt-5">
          <label for="description" class="form-label">Description</label>
          <textarea name="description" id="description" cols="30" rows="18" class="form-control">{{ old('description', $event->description) }}</textarea>
          @error('description')
            <div class="text-danger small">{{ $message }}</div> 
          @enderror
        </div>
      </div>
    </div>

    {{-- Edit/Delete Button --}}
    <div class="row justify-content-end my-3">
      <div class="col-auto">
        <a href="{{ route('event.show', $event->id) }}" class="btn text-turquoise me-2">Cancel</a>
        <button type="submit" class="btn btn-turquoise text-white">Save</button>
      </div>
    </div>
  </div>
</form>
@endsection

@section('scripts')
<!-- Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>

<!-- JavaScript -->
<script src="{{ asset('js/events/google-map.js') }}"></script>

@endsection
