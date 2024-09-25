@extends('layouts.app')

@section('title', 'Inquiry Submitted')
    
@section('content')
<div class="bg-blue container p-5">
  <div class="row justify-content-center">
    <div class="row text-center">
      <h1 class="h2">
        Your inquiry was <span class="text-turquoise">successfully submitted</span> on 
        {{ date('M d, Y g:i a', strtotime($inquiry->created_at)) }}.
      </h1>
      <h3 class="pt-2">We will get back to you shortly.</h3>
    </div>

    <div class="row pt-5">
      <label for="subject" class="form-label">Subject</label>
      <input type="text" name="subject" id="subject" value="{{ $inquiry->subject }}" class="form-control text-muted" readonly>
    </div>

    <div class="row pt-3">
      <label for="message" class="form-label">Message</label>
      <textarea name="message" id="message" cols="30" rows="10" class="form-control text-muted" readonly>{{ $inquiry->message }}</textarea>
    </div>

    <div class="row pt-5">
      <a href="{{ route('users.profile.index') }}" class="btn">
        <i class="fa-regular fa-rectangle-xmark"></i> Close
      </a> 
    </div>   
  </div>
</div>
@endsection