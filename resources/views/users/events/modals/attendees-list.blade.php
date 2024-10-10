<div class="modal fade" id="attendees-{{ $event->id }}">
  <div class="modal-dialog">

    {{-- visible part --}}
    <div class="modal-content border-turquoise">
      <div class="modal-header text-center d-block position-relative border-0">
        <h6>All attendees</h6>
        <button type="button" class="btn btn-sm position-absolute top-0 end-0" data-bs-dismiss="modal">
          <i class="fa-regular fa-rectangle-xmark"></i> Close
        </button>

        {{-- Review sort button will appear after the event --}}
        @if ($currentDateTime->greaterThan($event->date . ' ' . $event->end_time))
          <div class="mt-4">
            <p class="text-center">
              Sort by 
              <button class="btn btn-turquoise mx-2" type="button" id="sort-rate">Review&nbsp; %</button>
              or
              <button class="btn btn-turquoise mx-2" type="button" id="sort-date">Date (newest list)</button>
            </p> 
          </div>
        @endif
      </div>  {{-- end of modal-header --}}

      <div class="modal-body">
        {{-- Host information --}}
        <div class="row">
          <div class="col-2 text-center">
            <p class="badge bg-gold text-white py-1 m-0">Host</p>
          </div>
          <div class="col-2 p-0 text-start">
            <a href="{{ route('users.profile.specificProfile', $event->host_id) }}" class="me-auto">
              @if ($event->host->avatar)
                <img src="{{ $event->host->avatar }}" alt="{{ $event->host->username }}" class="rounded-circle avatar-sm">
              @else
                <i class="fa-solid fa-circle-user text-dark icon-sm"></i>
              @endif
            </a>
            <a href="{{ route('users.profile.specificProfile', $event->host_id) }}" class="text-decoration-none text-black">
              {{ $event->host->username }}
            </a>
          </div>          
        </div>

        @foreach ($attendeesWithReviews as $attendeeWithReview)
          <hr>
          <div class="row">
            {{-- Review rate % --}}
            <div class="col-2 text-center">
              @if ($attendeeWithReview['review'])
                <p>{{ $attendeeWithReview['review']->review_rate }} %</p> 
              @endif
            </div>

            {{-- Attendee information --}}
            <div class="col-2 p-0 text-start">
              <a href="{{ route('users.profile.specificProfile', $attendeeWithReview['attendee']->user_id) }}" class="me-auto">
                @if ($attendeeWithReview['attendee']->user->avatar)
                  <img src="{{ $attendeeWithReview['attendee']->user->avatar }}" alt="{{ $attendeeWithReview['attendee']->user->username }}" class="rounded-circle avatar-sm">
                @else
                  <i class="fa-solid fa-circle-user text-dark icon-sm"></i>
                @endif
              </a>
              <a href="{{ route('users.profile.specificProfile', $attendeeWithReview['attendee']->user_id) }}" class="text-decoration-none text-black d-flex align-items-center">
                {{ $attendeeWithReview['attendee']->user->username }}
              </a>
            </div>

            {{-- Review comment --}}
            <div class="col">
              @if ($attendeeWithReview['review'])
                <p class="text-break">{{ $attendeeWithReview['review']->review_comment }}</p>                                 
              @endif
            </div>

            <div class="d-flex justify-content-end align-items-end">
              {{-- Delete button for reviewer --}}
              @if ($currentDateTime->greaterThan($event->date . ' ' . $event->end_time) && 
                   $attendeeWithReview['review'] &&
                   $attendeeWithReview['attendee']->user_id === Auth::user()->id)
                <form action="{{ route('review.destroy', $attendeeWithReview['review']->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="border-0 bg-transparent text-danger small">Delete</button>
                </form>
              @endif              

              {{-- Review date --}}
              @if ($attendeeWithReview['review'])
                <div class="text-uppercase text-muted xsmall ms-3">
                  {{ date('M d, Y', strtotime($attendeeWithReview['review']->created_at)) }}
                </div>  
              @endif
            </div>
          </div>
        @endforeach
      </div> {{-- end of modal-body --}}
    </div>
  </div>
</div>

