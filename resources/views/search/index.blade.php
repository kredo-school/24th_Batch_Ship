@extends('layouts.app')

@section('title', 'Search index')

@section('content')
<div class="container-fluid">
    <div class="row">
        <p class="text-center text-capitalize pt-1 mb-1">Looking for:
            @if($contentTypes && count($contentTypes) > 0) 
                <span class="">
                    {{ implode(', ', $contentTypes) }} 
                </span>
            @endif
        </p>
        <div class="col-6 pe-0">
            <h1 class="fw-bold text-end">Your Key word is:</h1>
            <h3 class="fw-bold text-end mb-2">with category:</h3>
        </div>
        <div class="col-6">
            {{-- keyword --}}
            <h1 class="fw-bold">
                @if($search)
                    {{ $search }}
                @else
                    <span class="text-turquoise">-</span>
                @endif
            </h1>

            {{-- selected category --}}
            <h3 class="">
                @if($selectedCategoryName)
                    <span class="badge bg-turquoise text-white ms-1 px-2 text-decoration-none">
                        {{ $selectedCategoryName }}
                    </span>
                @else
                    <span class="text-turquoise">No category selected</span>
                @endif
            </h3>
        </div>
    </div>

    {{-- User --}}
    <div class="mt-5 bg-green p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Username</h2>
        </div>
        <div class="row row-eq-height">
            @foreach($result_users as $user)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card rounded border-0 h-100 d-flex flex-column">
                        <div class="card-body d-flex flex-column" style="max-height: 200px; overflow-y: scroll;">
                            {{-- avatar & name --}}
                            <div class="d-flex align-items-center mb-1">
                                @if($user->avatar)
                                    <a href="{{ route('users.profile.specificProfile', $user->id) }}" class="me-1">
                                        <img src="{{ $user->avatar }}" alt="avatar" class="rounded-circle avatar-sm" >
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
                            <div class="card-text text-start ms-1 mt-auto flex-categories">
                                @foreach($user->categories as $category)
                                    <a href="{{ route('users.categories.show', $category->id) }}" class="text-decoration-none">
                                        <span class="badge bg-turquoise text-white">{{ $category->name }}</span>
                                    </a>
                                @endforeach
                            </div>              
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            @if($result_users instanceof \Illuminate\Pagination\LengthAwarePaginator && $result_users->total() > 0)
                {{ $result_users->appends(request()->query())->links('pagination::bootstrap-4') }}
            @else
            <p class="text-turquoise text-center">{{ $no_results_message }}</p>
            @endif
        </div>
    </div>        

    {{-- Post --}}
    <div class="mt-5 bg-pink p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Post</h2>
        </div>
        <div class="row row-eq-height">
            @foreach($result_posts as $post)
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="{{ route('users.posts.show', $post->id) }}" class="text-decoration-none text-black">
                        <div class="card rounded border-0 h-100 d-flex flex-column">
                            {{-- post image --}}
                            @if ($post->images->isNotEmpty())
                            <div id="carousel-{{ $post->id }}" class="carousel slide" data-bs-ride="false">
                                <div class="carousel-inner">
                                    @foreach ($post->images->chunk(1) as $index => $imagesChunk)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }} ">
                                            <div class="d-flex justify-content-center">
                                                @foreach ($imagesChunk as $image)
                                                    <div class="" style="overflow: hidden;">
                                                        <img src="data:image/png;base64,{{ $image->image_data }}" alt="Post ID {{ $post->id }}" class="img-fluid img-profile-index w-100 rounded">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                @if ($post->images->count() > 1)
                                    <button class="carousel-control-prev btn-profile-post-prev" type="button" data-bs-target="#carousel-{{ $post->id }}" data-bs-slide="prev">
                                        <i class="fa-solid fa-caret-left fs-1 text-turquoise bg-white px-1 ms-3">
                                            <span class="visually-hidden">Previous</span>
                                        </i>
                                    </button>
                                    <button class="carousel-control-next btn-profile-post-next" type="button" data-bs-target="#carousel-{{ $post->id }}" data-bs-slide="next">
                                        <i class="fa-solid fa-caret-right fs-1 text-turquoise bg-white px-1 me-3">
                                            <span class="visually-hidden">Next</span>
                                        </i>
                                    </button>
                                @endif
                            </div>

                            @else
                                <div class="justify-content-center" style="height: 160px; overflow-y: scroll;">
                                    <p class="p-3">{{ $post->description }}</p>
                                </div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <div class="row mb-2 ms-1">
                                    {{-- avatar & name --}}
                                    <div class="col card-text text-end">
                                        created by
                                        <a href="{{ route('users.profile.specificProfile', $post->user->id) }}" class="me-1 text-decoration-none">
                                            @if($post->user->avatar)
                                                <img src="{{ $post->user->avatar }}" alt="Avatar" class="rounded rounded-circle avatar-sm">
                                            @else
                                                <i class="fa-solid fa-circle-user icon-sm me-2"></i>
                                            @endif
                                        </a>
                                    </div>                      
                                </div>
                            </a>
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
        </div>
        {{-- Pagination for posts --}}
        <div class="d-flex justify-content-center">
            @if($result_posts instanceof \Illuminate\Pagination\LengthAwarePaginator && $result_posts->total() > 0)
                {{ $result_posts->appends(request()->query())->links('pagination::bootstrap-4') }}
            @else
            <p class="text-turquoise text-center">{{ $no_results_message }}</p>
            @endif
        </div>
    </div>

    {{-- Community --}}
    <div class="mt-5 bg-blue p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Community</h2>
        </div>
        <div class="row row-eq-height">
            @foreach($result_communities as $community)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card rounded border-0 h-100 d-flex flex-column">
                    {{-- Community cover image --}}
                    <div class="mb-2">
                        <a href="{{ route('communities.show',$community->id) }}">
                            <img src="{{ $community->image }}" alt="Community ID {{ $community->id }}" class="fixed-size-img rounded card-img-top">
                        </a>
                    </div>
                    <div class="card-body d-flex flex-column">
                        {{-- Community title & owner --}}
                        <div class="row mb-2 ms-1">
                            {{-- title --}}
                            <h3 class="col card-title">{{ $community->title }}</h3>
                            {{-- owner --}}
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
        </div>
        {{-- Pagination for communities --}}
        <div class="d-flex justify-content-center">
          @if($result_communities instanceof \Illuminate\Pagination\LengthAwarePaginator && $result_communities->total() > 0)
              {{ $result_communities->appends(request()->query())->links('pagination::bootstrap-4') }}
          @else
          <p class="text-turquoise text-center">{{ $no_results_message }}</p>
          @endif
      </div>
    </div>

    {{-- Event --}}
    <div class="mt-5 bg-yellow p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Event</h2>
        </div>
        <p class="my-1">The category is from the community that the event belongs to.</p>
        <div class="row row-eq-height">
            @foreach($result_events as $event)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card rounded border-0 h-100 d-flex flex-column bg-white">
                    <div class="card-body d-flex flex-column p-0">
                        {{-- Event image --}}
                        <div class="">
                            <a href="{{ route('event.show', $event->id) }}">
                                <img src="{{ $event->image }}" alt="Event ID {{ $event->id }}" class="fixed-size-img rounded card-img-top">
                            </a>
                        </div>
                        {{-- Event title & owner --}}
                        <div class="card-body d-flex flex-column">
                            @if($event->host)
                            <div class="row mb-2 ms-1">
                            {{-- title --}}                                
                                <h3 class="col card-title">{{ $event->title }}</h3>
                                <p class="">Date: {{ $event->date }}</p>
                            {{-- host --}}                                    
                                    <p class="col card-text text-end">
                                        organized by
                                        <a href="{{ route('users.profile.specificProfile', $event->host->id) }}">
                                            @if ($event->host->avatar)
                                            <img src="{{ $event->host->avatar }}" alt="#" class="rounded-circle avatar-sm">
                                            @else
                                            <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                            @endif
                                        </a>
                                    </p>
                            </div>
                            <div class="row card-text text-start ms-1 mb-2 mt-auto p-0">
                                <div class="col">
                                    @if($event->communityCategories()->isNotEmpty())
                                        @foreach ($event->communityCategories() as $category)
                                            <a href="{{ route('users.categories.show', $category->id) }}" class="badge me-1 bg-turquoise text-decoration-none">{{ $category->name }}</a>
                                        @endforeach
                                    @else
                                        <span>No categories available.</span>
                                    @endif 
                                </div>
                            </div>                                                   
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{-- Pagination for events --}}
        <div class="d-flex justify-content-center">
          @if($result_events instanceof \Illuminate\Pagination\LengthAwarePaginator && $result_events->total() > 0)
              {{ $result_events->appends(request()->query())->links('pagination::bootstrap-4') }}
          @else
          <p class="text-turquoise text-center">{{ $no_results_message }}</p>
          @endif
      </div>
    </div>

</div>
@endsection