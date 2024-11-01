@extends('layouts.app')

@section('title', 'Show all index for a category')

@section('content')
<div class="container-fluid"> 
    <div class="row">
        <div class="col">
            <h1 class="fw-bold text-end">Category index:</h1>
        </div>
        <div class="col ps-0">
            <span class="fs-5 mt-2 badge bg-turquoise text-white px-2 text-decoration-none">{{ $category->name }}</span>
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
        <div class="row">
            @if($users->isNotEmpty())
                @foreach($users as $user)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card rounded border-0 h-100 d-flex flex-column">
                        <div class="card-body d-flex flex-column" style="max-height: 200px; overflow-y: auto;">
                            {{-- Avatar & Username --}}
                            <div class="d-flex align-items-center mb-1">
                                <a href="{{ route('users.profile.specificProfile', $user->id) }}" class="me-1">
                                    @if($user->avatar)
                                        <img src="{{ $user->avatar }}" alt="avatar" class="rounded-circle avatar-md" style="border-radius:50%;">
                                    @else
                                        <i class="fa-solid fa-circle-user icon-sm me-2"></i>
                                    @endif
                                </a>
                                @if($user->username)
                                    <h3 class="ms-1 mb-0">{{ $user->username }}</h3>
                                @endif
                            </div>
                            
                            {{-- Introduction --}}
                            <p class="mb-2">{{ $user->introduction }}</p>
                            
                            {{-- Categories (Interests) --}}
                            <div class="d-flex flex-wrap">
                                @foreach($user->categories as $category)
                                    <a href="{{ route('users.categories.show', $category->id) }}" class="text-decoration-none">
                                        <span class="badge bg-turquoise text-white ms-1">{{ $category->name }}</span>
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
    
        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator && $users->total() > 0)
                {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
            @endif
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
                    <a href="{{ route('users.posts.show', $post->id) }}" class="text-decoration-none text-black">
                    <div class="card rounded border-0 h-100 d-flex flex-column">
                        {{-- Post image --}}
                        <div id="carouselExample" class="carousel slide" data-interval="false">
                            <div class="carousel-inner">
                                @foreach ($post->images->chunk(1) as $index => $imagesChunk)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
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
                            @if ($post->images->count() > 2) 
                            <button class="carousel-control-prev btn-category-post-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                <i class="fa-solid fa-caret-left fs-1 text-turquoise">
                                    <span class="visually-hidden">Previous</span>
                                </i>
                            </button>
                            <button class="carousel-control-next btn-category-post-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                <i class="fa-solid fa-caret-right fs-1 text-turquoise">
                                    <span class="visually-hidden">Next</span>
                                </i>
                            </button>
                            @endif
                        </div>   
                        <div class="card-body d-flex flex-column">
                            <div class="row mb-2 ms-1">
                                {{-- avatar & name --}}
                                <p class="col card-title mb-0">{{ $post->description }}</p>
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
</div>
@endsection
