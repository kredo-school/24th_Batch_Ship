{{-- User's Own Community --}}
<div class="container-fluid bg-blue p-3 mt-5">
    <div class="row m-3">
        @if (Auth::user()->id == $user->id)
            <h2>My own community</h2>
        @else
            <h2>{{$user->username}}'s own community</h2>
        @endif
    </div>

    <div class="row row-eq-height">
        {{-- Get 4 communities --}}
            @forelse ($own_communities as $community)
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <a href="#" class="text-decoration-none text-black">
                        <div class="card border-0 rounded h-100 d-flex flex-column mb-3">
                            {{-- image --}}
                            <div class="mb-2">
                                <a href="{{ route('communities.show', $community->id) }}">
                                    <img src="{{ $community->image }}" alt="Community ID {{ $community->id }}" class="fixed-size-img rounded card-img-top">
                                </a>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="row mb-2-2 ms-1">
                                    {{-- title --}}
                                    <h3 class="col card-title">{{ $community->title }}</h3>
                                    {{-- owner --}}
                                    <p class="col card-text text-end">Created by
                                        <a href="{{ route('users.profile.specificProfile', $community->owner_id )}}">
                                            @if ($community->user->avatar)
                                                <img src="{{ $community->user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle avatar-sm">
                                            @else
                                                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                            @endif   
                                        </a>
                                    </p>
                                </div>
                                <div class="row card-text text-start ms-1 mt-auto">
                                    {{-- category --}}
                                    <div class="col">
                                        @foreach ($community->categoryCommunity as $category_community)
                                            <a href="#" class="badge me-1 bg-turquoise text-decoration-none">{{ $category_community->category->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <h3 class="text-secondary text-center"> No own community yet.</h3>
            @endforelse
    </div>

    {{-- {{ $all_communities->links() }} --}}

</div>


{{-- User's Joined Community --}}
<div class="div container-fluid bg-blue p-3 mt-5">
    <div class="row m-3">
        @if (Auth::user()->id == $user->id)
            <h2>My joined community</h2>
        @else
            <h2>{{$user->username}}'s joined community</h2>
        @endif
    </div>

    <div class="row row-eq-height">
        {{-- Get 4 communities --}}
        {{-- @if ($user->communities->isNotEmpty()) --}}
            {{-- @foreach ($user->communities as $community) --}}
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <a href="#" class="text-decoration-none text-black">
                        <div class="card border-0 rounded h-100 d-flex flex-column mb-3">
                            {{-- image --}}
                            <div class="mb-2">
                                <a href="{{ route('communities.show', $community->id) }}">
                                    <img src="{{ $community->image }}" alt="Community ID {{ $community->id }}" class="fixed-size-img rounded card-img-top">
                                </a>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="row mb-2-2 ms-1">
                                    {{-- title --}}
                                    <h3 class="col card-title">{{ $community->title }}</h3>
                                    {{-- owner --}}
                                    <p class="col card-text text-end">Created by
                                        <a href="{{ route('users.profile.specificProfile', $community->owner_id )}}">
                                            @if ($community->user->avatar)
                                                <img src="{{ $community->user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle avatar-sm">
                                            @else
                                                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                            @endif   
                                        </a>
                                    </p>
                                </div>
                                <div class="row card-text text-start ms-1 mt-auto">
                                    {{-- category --}}
                                    <div class="col">
                                        @foreach ($community->categoryCommunity as $category_community)
                                            <a href="#" class="badge me-1 bg-turquoise text-decoration-none">{{ $category_community->category->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            {{-- @endforeach --}}
        {{-- @else --}}
            <h3 class="text-secondary text-center"> No joined community yet.</h3>
        {{-- @endif --}}
    </div>

    {{-- {{ $all_communities->links() }} --}}

</div>
