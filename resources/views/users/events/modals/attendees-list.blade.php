<div class="modal fade" id="attendees-{{ $event->id }}">
  <div class="modal-dialog">

    {{-- visible part --}}
    <div class="modal-content border border-3 border-turquoise"> 
      <div class="modal-header text-center border-0 d-block pb-0">
        <div class="container">
          <h6 class="text-center pb-2">All attendees</h6>
          {{-- Review sort button will appear after the event --}}
          @if ($currentDateTime->greaterThan($event->date . ' ' . $event->end_time))
            <p class="mt-4">
              Sort by 
              <button class="btn btn-turquoise text-white mx-2" type="button" id="sort-compatibility">review %</button>
              or
              <button class="btn btn-turquoise text-white mx-2" type="button" id="sort-date">date (newest list)</button>
            </p> 
          @endif
          <div class="row text-start">
            <div class="col-1">
              <div class="col-2">
                <a href="{{ route('users.profile.specificProfile', $event->host_id) }}" class="me-auto">
                  @if ($event->host->avatar)
                    <img src="{{ $event->host->avatar }}" alt="{{ $event->host->username }}" class="rounded-circle avatar-sm">
                  @else
                    <i class="fa-solid fa-circle-user text-dark icon-sm"></i>
                  @endif
                </a> 
              </div>
            </div>
            <div class="col-auto">
              <p class="badge bg-gold text-white py-1 m-0">Host</p>
              <h6 class="underline">
                <a href="{{ route('users.profile.specificProfile', $event->host_id) }}" class="text-decoration-none text-black">
                  {{ $event->host->username }}
                </a>
              </h6>
            </div>
         </div>       
       </div> 
     </div>  {{-- end of modal-header --}}

      <div class="modal-body border-0 my-1 pt-0" style="max-height: 400px; overflow-y: scroll;">
        @foreach ($all_attendees as $attendee)
          <hr>
          <div class="row mb-1">
            <div class="col-2 p-0 text-center">
              <a href="{{ route('users.profile.specificProfile', $attendee->user_id) }}" class="me-auto">
                @if ($attendee->user->avatar)
                  <img src="{{ $attendee->user->avatar }}" alt="{{ $attendee->user->username }}" class="rounded-circle avatar-sm">
                @else
                  <i class="fa-solid fa-circle-user text-dark icon-sm"></i>
                @endif
              </a>
            </div>
            <div class="col-6 text-start">
              <h6>
                <a href="{{ route('users.profile.specificProfile', $attendee->user_id) }}" class="text-decoration-none text-black d-flex align-items-center">
                  {{ $attendee->user->username }}
                </a>
              </h6>
            </div>
            <div class="col-2">
              <i class="fa-solid fa-face-grin-wide text-turquoise fs-2"></i>
            </div>
            <div class="col-2 text-start fw-bold">
              {{-- @if ($attendee->review) --}}
                <p>{{-- $attendee->review->rate --}} %</p>                 
              {{-- @endif --}}
            </div>
          </div>
        @endforeach
        <hr class="my-2">
      </div> {{-- end of modal-body --}}

    </div>
  </div>
</div>

