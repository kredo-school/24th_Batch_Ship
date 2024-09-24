@extends('layouts.app')

@section('title', 'User Related Communities')

@section('content')
    <div class="container">
        <h1 class="fw-bold my-2 text-center">Communities with your interests</h1>
         {{-- display all selected categories --}}
        <div class="row mb-3">
            <div class="col text-center">
                @forelse ($user->categories as $category)
                    <a href="{{ route('users.categories.show', $category->id) }}" class="badge bg-turquoise text-decoration-none me-1 mt-2">
                        {{ $category->name }}
                    </a>
                @empty
                    <a href="#" class="badge bg-dark text-decoration-none mt-1">Uncategorized</a>
                @endforelse
            </div>
        </div>

        @if ($relatedCommunities && $relatedCommunities->isNotEmpty())
            <div id="masonry-grid" class="row g-2 align-items-start masonry" data-masonry='{"percentPosition": true}'>
                @foreach ($relatedCommunities as $community)
                    <div class="col-lg-3 col-md-6 mb-2 masonry-item">
                        <a href="{{ route('communities.show', $community->id) }}" class="text-decoration-none">
                            <div class="card shadow rounded border-0 bg-pink d-flex flex-column">
                                <div class="card-body d-flex flex-column">
                                    {{-- post description --}}
                                    <div class="mb-3 card-text large-text text-dark">{{ Str::limit($community->description, 100) }}</div>

                                    {{-- post image --}}
                                    @if (!empty($community->image))
                                        <div>
                                            <img src="{{ $community->image }}" alt="Post ID {{ $community->id }}" class="fixed-size-img rounded">
                                        </div>
                                    @endif

                                    {{-- post category --}}
                                    <div class="row card-text text-start ms-1 mt-auto">
                                        <div class="col">
                                            @if ($community->categoryCommunity)
                                                @foreach ($community->categoryCommunity as $category_community)
                                                    <a href="{{ route('users.categories.show', $category_community->category_id) }}" class="badge me-1 bg-turquoise text-decoration-none">{{ $category_community->category->name }}</a>
                                                @endforeach
                                            @else
                                                <span class="badge bg-turquoise mt-1">Uncategorized</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <h3 class="text-secondary text-center">No communities found</h3>
        @endif    
    </div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/style_postshow.css') }}">
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" async></script>
@endsection
