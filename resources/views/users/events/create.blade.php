@extends('layouts.app')

@section('title', 'Create Event')
    
@section('content')
<body class="bg-yellow">
  <h1>Create new event</h1>
  <div class="container my-3 p-3" style="background-color: #F5F5F5">
    <form action="{{ route('event.store') }}" method="post" enctype="multipart/form-data">
      @csrf

      <div class="row m-3 gx-5">
        <div class="col">
          <label for="community-title" class="form-label">Community title</label>
          <select name="community_id" id="community-title" class="form-select" autofocus>
            <option value="">Select your community</option>
            {{-- @foreach belongsTo communities --}}
            <option value="1"{{-- community_id --}}>Travel in Japan</option>
          </select>
          @error('community_id')
            <div class="text-danger small">{{ $message }}</div> 
          @enderror
        </div>

        <div class="col">
          <label for="event-title" class="form-label">Event title</label>
          <input type="text" name="title" id="event-title" value="{{ old('title') }}" class="form-control">
          @error('title')
            <div class="text-danger small">{{ $message }}</div> 
          @enderror
        </div>
      </div>

      <div class="row m-3 gx-5">
        <div class="col">
          <label for="date" class="form-label">Date</label>
          <input type="date" name="date" id="date" value="{{ old('date') }}" class="form-control">
          @error('date')
            <div class="text-danger small">{{ $message }}</div> 
          @enderror
        </div>

        <div class="col">
          <label for="start-time" class="form-label">Start time</label>
          <input type="time" name="start_time" id="start-time" value="{{ old('start_time') }}" class="form-control">
          @error('start_time')
            <div class="text-danger small">{{ $message }}</div> 
          @enderror
        </div>
        <div class="col">
          <label for="end-time" class="form-label">End time</label>
          <input type="time" name="end_time" id="end-time" value="{{ old('end_time') }}" class="form-control">
          @error('end_time')
            <div class="text-danger small">{{ $message }}</div> 
          @enderror
        </div>

        <div class="col-6">
          <label for="location" class="form-label">Location</label>
          <input type="text" name="location" id="location" value="{{ old('location') }}" class="form-control">
          @error('location')
            <div class="text-danger small">{{ $message }}</div> 
          @enderror
        </div>
      </div>

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
          <input type="file" name="image" id="image" class="form-control">
          @error('image')
            <div class="text-danger small">{{ $message }}</div> 
          @enderror
        </div>
      </div>

      <div class="row m-3 gx-5">
        <div class="col">
          <label for="description" class="form-label">Description</label>
          <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description') }}</textarea>
        </div>
        @error('description')
          <div class="text-danger small">{{ $message }}</div> 
        @enderror
      </div>

      <div class="container">
        <div class="row">
          <div class="col d-flex justify-content-between">
            <a href="{{ route('community.index') }}" class="btn btn-gold text-white">Cancel</a>
            <button type="submit" class="btn btn-turquoise text-white">Save</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</body>
@endsection