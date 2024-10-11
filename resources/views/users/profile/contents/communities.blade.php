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
                                        <a href="{{ route('users.categories.show', $category_community->category_id) }}" class="badge me-1 bg-turquoise text-decoration-none">{{ $category_community->category->name }}</a>
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

    <div class="d-flex justify-content-center mt-4">
        @if($own_communities instanceof \Illuminate\Pagination\LengthAwarePaginator && $own_communities->total() > 0)
            {{ $own_communities->appends(request()->query())->links('pagination::bootstrap-4') }}
        @endif
    </div>

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
        @forelse ($join_communities as $community_user)
            <div class="col-sm-3 mb-3 mb-sm-0">
                <a href="#" class="text-decoration-none text-black">
                    <div class="card border-0 rounded h-100 d-flex flex-column mb-3">
                        {{-- image --}}
                        <div class="mb-2">
                            <a href="{{ route('communities.show', ['id' => $community_user->community->id]) }}">
                                <img src="{{ $community_user->community->image }}" alt="Community ID {{ $community_user->community->id }}" class="fixed-size-img rounded card-img-top">
                            </a>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="row mb-2-2 ms-1">
                                {{-- title --}}
                                <h3 class="col card-title">{{ $community_user->community->title }}</h3>
                                {{-- owner --}}
                                <p class="col card-text text-end">Created by
                                    <a href="{{ route('users.profile.specificProfile', $community_user->community->owner_id )}}">
                                        @if ($community_user->community->user->avatar)
                                            <img src="{{ $community_user->community->user->avatar }}" alt="{{ $community_user->community->user->name }}" class="img-thumbnail rounded-circle avatar-sm">
                                        @else
                                            <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                        @endif   
                                    </a>
                                </p>
                            </div>
                            <div class="row card-text text-start ms-1 mt-auto">
                                {{-- category --}}
                                <div class="col">
                                    @foreach ($community_user->community->categoryCommunity as $category_community)
                                        <a href="#" class="badge me-1 bg-turquoise text-decoration-none">{{ $category_community->category->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <h3 class="text-secondary text-center"> No joined community yet.</h3>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        @if($join_communities instanceof \Illuminate\Pagination\LengthAwarePaginator && $join_communities->total() > 0)
            {{ $join_communities->appends(request()->query())->links('pagination::bootstrap-4') }}
        @endif
    </div>

</div>
