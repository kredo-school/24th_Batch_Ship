<div class="container-fluid">
  <div class="row">
    @foreach ($community->events()->get() as $event)
      <div class="col-md-6">
        <div class="card m-2 p-0 bg-transparent border-0 rounded-top">
          <div class="card-body m-0 p-0 border-0 bg-white">
            <a href="{{ route('event.show', $event->id) }}">
              <img src="{{ $event->image }}" class="w-100 rounded-top" alt="{{ $event->name }}" style="height: 100px; object-fit: cover;">            
            </a>
            <div class="row p-2">
              {{-- event title --}}
              <h6><a href="{{ route('event.show', $event->id) }}" class="text-black text-decoration-none">{{ $event->title }}</a></h6>
              <div class="d-flex justify-content-between xsmall">
                {{-- event date --}}
                <p class="text-muted mb-0">{{ $event->date }}</p>
                {{-- event owner avatar --}}
                <p class="text-end fw-bold mb-0">
                  organized by
                  <a href="{{ route('users.profile.specificProfile', $event->host_id) }}">
                    @if ($event->host->avatar)
                      <img src="{{ $event->host->avatar }}" alt="{{ $event->host->username }}" class="rounded-circle avatar-sm"> 
                    @else
                      <i class="fa-solid fa-circle-user icon icon-sm text-black"></i>
                    @endif
                  </a> 
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
