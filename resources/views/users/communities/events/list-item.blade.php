<div class="container-fluid d-flex justify-content-arountd">
  <div class="card m-0 p-0 bg-transparent border-0">
    @foreach ($community->events as $event)
       {{-- @if(events->community_id)????  --}}
    <div class="card-body m-0 p-0 border-0 bg-white w-50">
      <a href="{{ route('event.show', $event->id) }}">
        <img src="{{ $event->image }}" class="w-100" alt="{{ $event->name }}">
      </a>
      <div class="row p-2">
        {{-- event title --}}
          <h6><a href="{{ route('event.show', $event->id) }}" class="text-black text-decoration-none">{{ $event->title }}</a></h6>
          {{-- event date --}}
        <div class="d-flex justify-content-between xsmall">
          <p class="text-muted mb-0">{{ $event->date }}</p>
          {{-- event owner avatar --}}
          <p class="text-end fw-bold mb-0">
            organized by
            <a href="{{ route('users.profile.specificProfile', $event->host_id) }}">
              @if ($event->host->avatar)
                <img src="{{ $event->host->avatar }}" alt="{{ $event->host->username }}" class="rounded-circle avatar-sm"> 
              @else
                <i class="fa-solid fa-circle-user icon"></i>
              @endif
            </a> 
          </p>
        </div>
      </div>
    </div>
    @endforeach 
  </div>
</div>
