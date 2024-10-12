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
          <div class="col-3 d-flex align-items-center">
            <a href="{{ route('users.profile.specificProfile', $inquiry->user_id) }}" class="text-black d-flex align-items-center text-decoration-none">
              @if ($inquiry->user->avatar)
                <img src="{{ $inquiry->user->avatar }}" alt="{{ $inquiry->user->username }}" class="rounded-circle avatar-sm">
              @else
                <i class="fa-solid fa-circle-user icon-sm"></i>   
              @endif
              <p class="ms-2 mb-0">{{ $inquiry->user->username }}</p>
            </a>
            <a href="mailto:{{ $inquiry->user->email }}" class="ms-3">{{ $inquiry->user->email }}</a>
          </div>

          {{-- Inquiry content --}}
          <div class="col-5">
            {{-- Subject --}}
            <a href="#" class="text-decoration-none text-black mb-0" data-bs-toggle="modal" data-bs-target="#inquiry-message-{{ $inquiry->id }}">
              {{ $inquiry->subject }}
            </a>
            {{-- Message modal --}}
            @include('admin.support.modal.message')
          </div>

          {{-- Date --}}
          <div class="col-2 text-end">
            <p class="mb-0">{{ date('M d, Y', strtotime($inquiry->created_at)) }}</p>
          </div>

          {{-- Status --}}
          <div class="col-2 text-end">
            @if ($inquiry->trashed())
              <i class="fa-regular fa-circle-check text-turquoise"></i>&nbsp; Completed
            @else
              <i class="fa-solid fa-check text-turquoise"></i>&nbsp; Pending
            @endif    
          </div>  
        </div>
      @empty
        <h3 class="bg-green text-secondary text-center py-3">No Inquiries Yet.</h3>
      @endforelse

      {{-- Pagination links --}}
      <div class="mt-4">
        {{ $all_inquiries->links() }}
      </div>
    </div>
  </div>
</div>
@endsection