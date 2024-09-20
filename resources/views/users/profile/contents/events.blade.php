{{-- User's Own Event --}}
<div class="container-fluid bg-yellow p-3 mt-5">
    <div class="row m-3">
        @if (Auth::user()->id == $user->id)
            <h2>My own event</h2>
        @else
            <h2>{{$user->username}}'s own event</h2>
        @endif
    </div>

    <div class="row row-eq-height">
        {{-- Get 4 events --}}
        @forelse ($own_events as $event)
            <div class="col-sm-3 mb-3 mb-sm-0">
                <a href="#" class="text-decoration-none text-black">
                    <div class="card border-0 rounded h-100 d-flex flex-column mb-3">
                        {{-- image --}}
                        <div class="mb-2">
                            <a href="{{ route('event.show', $event->id) }}">
                                <img src="{{ $event->image }}" alt="Event ID {{ $event->id }}" class="fixed-size-img rounded card-img-top">
                            </a>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="row mb-2-2 ms-1">
                                {{-- event title --}}
                                <h3 class="col card-title">{{ $event->title }}</h3>
                                {{-- owner --}}
                                <p class="col card-text text-end">Organized by
                                    <a href="{{ route('users.profile.specificProfile', $event->host_id )}}">
                                        @if ($user->avatar)
                                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle avatar-sm">
                                        @else
                                            <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                        @endif   
                                    </a>
                                </p>

                                <div class="row card-text text-start mt-auto">
                                    {{-- event title this event belongs to --}}
                                    <a href="{{ route('communities.show', $event->community_id) }}" class="text-decoration-none text-secondary">{{ $event->community->title }}</a>
                                    
                                    {{-- date --}}
                                    <p class="text-muted xsmall">{{ $event->date }} {{ $event->start_time }} ~ {{ $event->end_time }}</p>
                                </div>
                            </div>

                            <div class="row card-text text-start ms-1 mt-auto">
                                {{-- category --}}
                                <div class="col">
                                    {{-- @foreach ($event->categoryEvent as $category_event)
                                        <a href="#" class="badge me-1 bg-turquoise text-decoration-none">{{ $category_event->category->name }}</a>
                                    @endforeach --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <h3 class="text-secondary text-center">No own event yet.</h3>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $own_events->links() }}
    </div>

</div>


{{-- User's Joined Event --}}
<div class="div container-fluid bg-yellow p-3 mt-5">
    <div class="row m-3">
        @if (Auth::user()->id == $user->id)
            <h2>My joined event</h2>
        @else
            <h2>{{$user->username}}'s joined event</h2>
        @endif
    </div>

    <div class="row row-eq-height">
        {{-- Get 4 communities --}}
        @forelse ($join_events as $event)
            <div class="col-sm-3 mb-3 mb-sm-0">
                <a href="#" class="text-decoration-none text-black">
                    <div class="card border-0 rounded h-100 d-flex flex-column mb-3">
                        {{-- image --}}
                        <div class="mb-2">
                            <a href="{{ route('event.show', $event->id) }}">
                                <img src="{{ $event->image }}" alt="Event ID{{ $event->id }}" class="fixed-size-img rounded card-img-top">
                            </a>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="row mb-2-2 ms-1">
                                {{-- event title --}}
                                <h3 class="col card-title">{{ $event->title }}</h3>
                                {{-- owner --}}
                                <p class="col card-text text-end">Organized by
                                    <a href="#">
                                        @if ($user->avatar)
                                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle avatar-sm">
                                        @else
                                            <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                        @endif   
                                    </a>
                                </p>

                                <div class="row card-text text-start mt-auto">
                                    {{-- event title this event belongs to --}}
                                    <a href="@" class="text-decoration-none text-secondary">community_title</a>
                                    
                                    {{-- date --}}
                                    <p class="text-muted xsmall">date</p>
                                </div>
                            </div>

                            <div class="row card-text text-start ms-1 mt-auto">
                                {{-- category --}}
                                <div class="col">
                                    {{-- @foreach ($community->categoryCommunity as $category_community)
                                        <a href="#" class="badge me-1 bg-turquoise text-decoration-none">{{ $category_community->category->name }}</a>
                                    @endforeach --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <h3 class="text-secondary text-center">No joined event yet.</h3>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $join_events->links() }}
    </div>

</div>