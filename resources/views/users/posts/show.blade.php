@extends('layouts.app')

@section('title', 'Post:show')

@section('content')
<head>

    <link rel="stylesheet" href="{{ asset('css/style_postshow.css') }}">
</head>

<div class="container-fulid bg-pink p-3">
    <div class="row">
       <div class="row">
            {{-- Left side of the Post --}}
            <div class="col-lg-6">
                <div class="row">
                    {{-- avatar --}}
                    <div class="col-md-4 post-show-avatar">
                              @if ($post->user->avatar)
                            <a href="{{ route('users.profile.specificProfile', $post->user->id) }}">
                                <img src="{{ $post->user->avatar }}" alt="" class="my-auto rounded-circle avatar-profile">
                            </a>
                        @else
                            <a href="{{ route('users.profile.specificProfile', $post->user->id) }}">
                                <i class="fas fa-circle-user text-secondary icon"></i>
                            </a>
                        @endif
                    </div>
                    {{-- name --}}
                    <div class="col my-auto">
                        <div class="row p-0">
                            <div class="col ms-0 profile-name">
                                {{-- Name of user who posted this post --}}
                                <a href="{{ route('users.profile.specificProfile', $post->user->id) }}" class="text-decoration-none text-dark mx-2">
                                    <p class="h1 fw-bold d-inline">{{ $post->user->username }}</p> </a>
                            </div>
                        </div>
                        <div class="row">
                                <div class="category">
                                    @foreach ($post->categoryPost as $category_post)
                                        <a href="{{ route('users.categories.show', $category_post->category_id) }}" class="badge bg-turquoise text-decoration-none d-inline-block me-1 mt-2">
                                            {{ $category_post->category->name }}
                                        </a>
                                    @endforeach
                                </div>
                        </div>
                            <div class="row">
                                <div class="col-md text-end mt-2">
                                    {{-- If you are the owner of the post, you can edit or delete this post --}}
                                    @if ($post->user->id === Auth::user()->id)
                                        {{-- edit --}}
                                        <a href="{{ route('users.posts.edit', $post->id) }}" class="post-edit btn edit-icon pe-0">
                                            <i class="fa-regular fa-pen-to-square show-icon"></i>
                                        </a>
                                        {{-- delete --}}
                                        <span class="btn post-delete show-icon ps-2" data-bs-toggle="modal" data-bs-target="#delete">
                                            <i class="fa-regular fa-trash-can fw-bold"></i>
                                            @include('users.posts.modals.delete')
                                        </span>
                                    @else
                                    @endif
                                    <p class="text-uppercase text-muted text-end">{{ date('M d, Y', strtotime($post->created_at)) }}</p>
                                </div>
                            </div>
                    </div>


                </div>
                <hr class="mt-2">
            </div>

          </div>
          <div class="row">
                    {{-- Post content --}}
                    <div class="col-6 px-3 position-relative">
                        @if ($post->images->isNotEmpty())
                        <p class="d-inline fw-light">{{ $post->description }}</p>
                        @endif
                    </div>

                                {{-- Right side of the Post --}}
            <div class="col-lg-6">
                {{-- images or description --}}
                @if ($post->images->isNotEmpty())
                    <div id="carouselExample" class="carousel slide" data-interval="false">
                        <div class="carousel-indicators mt-0">
                            {{-- if there is more than 1 image, button will show up --}}
                            @if ($post->images->count() > 1)
                            @foreach ($post->images as $index => $image)
                                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="{{ $index }}" class="@if($index == 0) active @endif" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                            @endforeach
                            @endif
                        </div>
                        <div class="carousel-inner px-2">
                            @foreach ($post->images as $index => $image)
                                <div class="carousel-item @if($index == 0) active @endif">
                                    <img class="d-block img-postshow mx-auto justify-content-center" src="data:image/png;base64,{{ $image->image_data }}" alt="post id {{ $post->id }}" data-index="{{ $index }}">
                                </div>
                            @endforeach
                        </div>
                        @if ($post->images->count() > 1)
                            <button class="carousel-control-prev display-2" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                <i class="fa-solid fa-caret-left text-gold">
                                    <span class="visually-hidden">Previous</span>
                                </i>
                            </button>
                            <button class="carousel-control-next display-2" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                <i class="fa-solid fa-caret-right text-gold">
                                    <span class="visually-hidden">Next</span>
                                </i>
                            </button>
                        @endif
                    </div>
                @else
                    {{-- If there are no images, show description on the right --}}
                    <div class="py-5 px-2 text-center">
                        <p class="">{{ $post->description }}</p>
                    </div>
                @endif

            </div>

            </div>

            <div class="row">
                <div class="col-lg-6">
                    {{-- Comment form --}}
                    <form action="{{ route('comment.store', $post->id) }}" method="post">
                        @csrf

                        {{-- Check if the user has already commented on this post --}}
                        @php
                            $existingComment = $post->comments->where('user_id', Auth::id())->first();
                        @endphp

                        {{-- Empathy Slider --}}
                        <div class="form-group mb-2 mx-3">
                            <label for="empathy" class="my-2">Empathy:</label>
                            <div class="range-slider">
                                <input type="range" id="percentage" name="percentage"
                                    value="{{ $existingComment ? $existingComment->percentage : 60 }}"
                                    min="60" max="100" step="1"
                                    class="bg-turquoise w-50"
                                    oninput="document.getElementById('output1').value=this.value">
                                <output id="output1" class="m-2">
                                    {{ $existingComment ? $existingComment->percentage : 60 }}
                                </output><span>%</span>
                            </div>
                        </div>

                        {{-- Comment for post --}}
                        <textarea name="comment" id="{{ $post->id }}" rows="1" class="form-control form-control-sm"
                            placeholder="Add a comment...">{{ $existingComment->comment ?? old('comment' . $post->id) }}</textarea>

                        @error('comment')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="btn btn-gold form-group mt-3 ml-1 btn-lg">Send</button>
                    </form>
                </div>
                    <div class="text-end">
                        <button class="shadow-none p-0 border-0 text-turquoise bg-pink" data-bs-toggle="modal"
                            data-bs-target="#see-all-reactions">
                            see all reactions
                        </button>
                        @include('users.posts.modals.empathy')
                    </div>
                </div>
            </div>



</div>


@endsection


