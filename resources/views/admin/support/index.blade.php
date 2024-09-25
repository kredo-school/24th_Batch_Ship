@extends('layouts.app')

@section('title', 'Admin: Support')
    
@section('content')
<div class="bg-blue">
  <div class="container">
    <div class="row justify-content-center p-5">
      <h1 class="h3">NEW</h1>
       @forelse ($all_inquiries as $inquiry)
        <div class="row align-items-center bg-green m-3 py-2">
          {{-- User information --}}
          <div class="col-2">
            <a href="{{ route('users.profile.specificProfile', $inquiry->user_id) }}" class="text-black d-flex align-items-center text-decoration-none">
              @if ($inquiry->user->avatar)
                <img src="{{ $inquiry->user->avatar }}" alt="{{ $inquiry->user->username }}" class="rounded-circle avatar-sm">
              @else
                <i class="fa-solid fa-circle-user icon-sm"></i>   
              @endif
              <p class="ms-2 mb-0">{{ $inquiry->user->username }}</p>
            </a>
          </div>

          {{-- Inquiry subject to message --}}
          <div class="col-8">
            <p class="mb-0">{{ $inquiry->subject }}</p>
          </div>

          {{-- date --}}
          <div class="col-2 text-center">
            <p class="mb-0">{{ date('M d, Y', strtotime($inquiry->created_at)) }}</p>
          </div>
        </div>
      @empty
        <h3 class="text-secondary text-center">No Inquiries Yet.</h3>
      @endforelse
      
      <div class="row justify-content-center mt-4">
        {{ $all_inquiries->links() }}
      </div>
    </div>
  </div>
</div>
@endsection