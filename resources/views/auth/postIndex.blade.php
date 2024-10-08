@extends('layouts.app')

@section('title', 'User Related Posts')

@section('content')
    <div class="container">
        <h1 class="fw-bold my-2 text-center">Posts with your interests</h1>
         {{-- display all selected categories --}}
        <div class="row mb-3">
            <div class="col text-center">
                @foreach ($user->categoryUser as $category_user)
                    <a href="{{ route('users.categories.show', $category_user->category_id) }}" class="fs-5 badge bg-turquoise text-white ms-1 px-2 text-decoration-none">
                        {{ $category_user->category->name }}
                    </a>
            @endforeach

            </div>
        </div>

        <hr>

        @if ($relatedPosts && $relatedPosts->isNotEmpty())
            <div id="masonry-grid" class="row g-2 align-items-start masonry" data-masonry='{"percentPosition": true}'>
                @foreach ($relatedPosts as $post)
                    <div class="col-lg-3 col-md-6 mb-2 masonry-item">
                        <a href="{{ route('users.posts.show', $post->id) }}" class="text-decoration-none">
                            <div class="card shadow rounded border-0 bg-pink d-flex flex-column">
                                <div class="card-body d-flex flex-column">
                                    {{-- post description --}}
                                    <div class="mb-3 card-text large-text text-dark">{{ Str::limit($post->description, 100) }}</div>

                                    {{-- post image --}}
                                    @if ($post->images->isNotEmpty())
                                    <div id="carousel-{{ $post->id }}" class="carousel slide" data-bs-ride="false">
                                        <div class="carousel-inner">
                                            @foreach ($post->images->chunk(2) as $index => $imagesChunk)
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                    <div class="d-flex justify-content-center">
                                                        @foreach ($imagesChunk as $image)
                                                            <div class="mx-1" style="overflow: hidden;">
                                                                <img src="data:image/png;base64,{{ $image->image_data }}" alt="Post ID {{ $post->id }}" class="img-fluid img-profile-index">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        @if ($post->images->count() > 2)
                                            <button class="carousel-control-prev btn-profile-post-prev" type="button" data-bs-target="#carousel-{{ $post->id }}" data-bs-slide="prev">
                                                <i class="fa-solid fa-caret-left fs-1 text-turquoise">
                                                    <span class="visually-hidden">Previous</span>
                                                </i>
                                            </button>
                                            <button class="carousel-control-next btn-profile-post-next" type="button" data-bs-target="#carousel-{{ $post->id }}" data-bs-slide="next">
                                                <i class="fa-solid fa-caret-right fs-1 text-turquoise">
                                                    <span class="visually-hidden">Next</span>
                                                </i>
                                            </button>
                                        @endif
                                    </div>
                                @endif

                                    {{-- post category --}}
                                    <div class="row card-text text-start ms-1 mt-auto">
                                        <div class="col">
                                            @foreach ($post->categoryPost as $category_post)
                                                <a href="{{ route('users.categories.show', $category_post->category_id) }}" class="badge me-1 bg-turquoise text-decoration-none">{{ $category_post->category->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <h3 class="text-secondary text-center">No related posts found</h3>
        @endif    
    </div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/style_postshow.css') }}">
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" async></script>
@endsection
