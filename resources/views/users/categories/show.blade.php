@extends('layouts.app')

@section('title', 'Show all index for a category')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1 class="fw-bold text-end">Category index:</h1>
        </div>
        <div class="col p-0">
            <button class="fs-2 px-3 bg-turquoise fw-bold text-white rounded border-0">
                {{ $category->name }}
            </button>
        </div>
    </div>

    @if(isset($no_results_message))
    <p class="text-danger text-center">{{ $no_results_message }}</p>
    @endif   

    {{-- User --}}
    <div class="mt-5 bg-green p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">User</h2>
        </div>
        <div class="row row-eq-height">
            @if($users->isNotEmpty())
                @foreach($users as $user)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card rounded border-0 h-100 d-flex flex-column">
                        <div class="card-body d-flex flex-column" style="max-height: 200px; overflow-y: scroll;">
                            {{-- avatar & name --}}
                            <div class="d-flex align-items-center mb-1">
                                @if($user->avatar)
                                <a href="{{ route('users.profile.specificProfile', $user->id) }}" class="me-1">
                                    <img src="{{ $user->avatar }}" alt="avatar" class="rounded avatar-sm" style="border-radius:50%;">
                                </a>
                                @else
                                <a href="{{ route('users.profile.specificProfile', $user->id) }}" class="me-1 text-decoration-none text-dark">
                                    <i class="fa-solid fa-circle-user icon-sm me-2"></i>
                                </a>
                                @endif
                                @if($user->username)
                                <h3 class="ms-1 mb-0">{{ $user->username }}</h3>
                                @endif
                            </div>
                            {{-- introduction --}}
                            <p class="mb-2">{{ $user->introduction }}</p>
                            {{-- interest(categories) --}}
                            <div class="row card-text text-start ms-1 mt-auto">
                                @foreach($user->categories as $category)
                                <a href="{{ route('users.categories.show', $category->id) }}" class="text-decoration-none">
                                    <span class="badge ms-1 bg-turquoise text-white">{{ $category->name }}</span>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <p class="text-center">No users found.</p>
            @endif
        </div>       
        <div class="d-flex justify-content-center mt-4">
            {{ $users->links() }}
        </div>
    </div>        

    {{-- Post --}}
    <div class="mt-5 bg-pink p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Post</h2>
        </div>
        <div class="row row-eq-height">
            @if($posts->isNotEmpty())
                @foreach($posts as $post)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card rounded border-0 h-100 d-flex flex-column">
                        {{-- Post image --}}
                        <div class="mb-2">
                            <img class="w-100 object-fit-fill" src="{{ $post->image }}" alt="">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="row mb-2 ms-1">
                                {{-- avatar & name --}}
                                <h3 class="col card-title mb-0">{{ $post->user->username }}</h3>
                                <div class="col card-text text-end">
                                    created by
                                    <a href="{{ route('users.profile.specificProfile', $post->user->id) }}" class="me-1 text-decoration-none">
                                        @if($post->user->avatar)
                                        <img src="{{ $post->user->avatar }}" alt="Avatar" class="rounded-circle avatar-sm">
                                        @else
                                        <i class="fa-solid fa-circle-user icon-sm me-2"></i>
                                        @endif
                                    </a>
                                </div>                      
                            </div>
                            {{-- Post category --}}
                            <div class="row card-text text-start ms-1 mt-auto">
                                <div class="col">
                                    @foreach($post->categories as $category)
                                    <a href="{{ route('users.categories.show', $category->id) }}" class="text-decoration-none">
                                        <span class="badge ms-1 bg-turquoise text-white">{{ $category->name }}</span>
                                    </a>
                                    @endforeach                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <p class="text-center">No posts found.</p>
            @endif
        </div>
        {{-- Pagination for posts --}}
        <div class="d-flex justify-content-center">
            {{ $posts->links('pagination::bootstrap-4') }}
        </div>  
    </div>

    {{-- Community --}}
    <div class="mt-5 bg-blue p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Community</h2>
        </div>
        <div class="row row-eq-height">
            @if($communities->isNotEmpty())
                @foreach($communities as $community)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card rounded border-0 h-100 d-flex flex-column">
                        {{-- Community cover image --}}
                        <div class="mb-2">
                            <a href="{{ route('communities.show', $community->id) }}">
                                <img src="{{ $community->image }}" alt="Community ID {{ $community->id }}" class="fixed-size-img rounded card-img-top">
                            </a>
                        </div>
                        <div class="card-body d-flex flex-column">
                            {{-- Community title & owner --}}
                            <div class="row mb-2 ms-1">
                                <h3 class="col card-title">{{ $community->title }}</h3>
                                <p class="col card-text text-end">
                                    created by
                                    <a href="{{ route('users.profile.specificProfile', $community->owner_id) }}">
                                        @if ($community->user->avatar)
                                        <img src="{{ $community->user->avatar }}" alt="#" class="rounded-circle avatar-sm">
                                        @else
                                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                        @endif
                                    </a>
                                </p>
                            </div>
                            {{-- category --}}
                            <div class="row card-text text-start ms-1 mt-auto">
                                <div class="col">
                                    @foreach ($community->categories as $category)
                                    <a href="{{ route('users.categories.show', $category->id) }}" class="badge me-1 bg-turquoise text-decoration-none">{{ $category->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <p class="text-center">No communities found.</p>
            @endif
        </div>
        {{-- Pagination for communities --}}
        <div class="d-flex justify-content-center">
            {{ $communities->links('pagination::bootstrap-4') }}
        </div>  
    </div>

    {{-- Event --}}
    <div class="mt-5 bg-yellow p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Event</h2>
        </div>
        <div class="row row-eq-height">
            @if($events->isNotEmpty())
                @foreach($events as $event)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card rounded border-0 h-100 d-flex flex-column">
                        <div class="card-body d-flex flex-column p-0">
                            {{-- Event image --}}
                            <div class="mb-2">
                                <a href="{{ route('event.show', $event->id) }}">
                                    <img src="{{ $event->image }}" alt="Event ID {{ $event->id }}" class="fixed-size-img rounded card-img-top">
                                </a>
                            </div>
                            {{-- Event title & date --}}
                            <div class="row mb-2 ms-1">
                                <h3 class="col card-title mb-0">{{ $event->title }}</h3>
                                <div class="col card-text text-end">
                                    <p class="me-3">{{ $event->date }}</p>
                                </div>
                            </div>
                            {{-- category --}}
                            <div class="row card-text text-start ms-1 mt-auto">
                                <div class="col">
                                    @foreach ($event->categories as $category)
                                    <a href="{{ route('users.categories.show', $category->id) }}" class="badge me-1 bg-turquoise text-decoration-none">{{ $category->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <p class="text-center">No events found.</p>
            @endif
        </div>
        {{-- Pagination for events --}}
        <div class="d-flex justify-content-center">
            {{ $events->links('pagination::bootstrap-4') }}
        </div>  
    </div>
</div>
@endsection
