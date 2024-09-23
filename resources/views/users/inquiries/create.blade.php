@extends('layouts.app')

@section('title', 'Inquiry Form')
    
@section('content')
<div class="bg-blue container p-5">
  <div class="row justify-content-center">
    <div class="row text-center">
      <h1 class="display-5">How can we help you?</h1>
      <h4 class="pt-4">Please write the detail of your inquiry below...</h4>
    </div>

    <div class="row pt-5">
      <label for="subject" class="form-label">Subject</label>
      <input type="text" name="subject" id="subject" class="form-control">
      @error('subject')
        <div class="text-danger small">{{ $message }}</div> 
      @enderror
    </div>

    <div class="row pt-3">
      <label for="message" class="form-label">Message</label>
      <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
      @error('message')
        <div class="text-danger small">{{ $message }}</div> 
      @enderror
    </div>
  
    <div class="row pt-5 w-25">
      <a href="#" class="btn btn-turquoise btn-lg px-3">SEND</a>
    </div>
  </div>
</div>
@endsection