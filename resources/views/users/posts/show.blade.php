Post  show.blade.php

@extends('layouts.app')

@section('title', 'Post:show')

@section('content')
<head>
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('css/style_postshow.css') }}">
</head>

<div class="card border-0 bg-pink">
    <div class="card-body">
        <div class="row">
            {{-- Left side of the Post --}}
            <div class="col-6">
                <div class="row">
                    <div class="col-2 px-0">
                        @if ($post->user->avatar)
                            <a href="{{ route('users.profile.specificProfile', $post->user->id) }}">
                                <img src="{{ $post->user->avatar }}" alt="" class="rounded-circle avatar-profile">
                            </a>
                        @else
                            <a href="{{ route('users.profile.specificProfile', $post->user->id) }}">
                                <i class="fas fa-circle-user text-secondary icon"></i>
                            </a>
                        @endif
                    </div>

                    <div class="col my-auto">
                        <div class="row mt-1">
                            <div class="col profile-name">
                                {{-- Name of user who posted this post --}}
                                <a href="{{ route('users.profile.specificProfile', $post->user->id) }}" class="text-decoration-none text-dark mx-2">
                                    <span class="p-3">{{ $post->user->first_name }}</span>
                                    <span class="p-3">{{ $post->user->last_name }}</span>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 m-3">
                                <div class="category">
                                    @foreach ($post->categoryPost as $category_post)
                                        <a href="{{ route('users.categories.show', $category_post->category_id) }}" class="badge bg-turquoise text-decoration-none me-1 mt-2">
                                            {{ $category_post->category->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col text-end mt-2">
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
                <hr class="my-0">

                {{-- Post content --}}
                <div class="row px-3 position-relative">
                    @if ($post->images->isNotEmpty())
                    &nbsp;
                    <p class="d-inline fw-light">{{ $post->description }}</p>
                    @endif
                </div>
            </div>

            {{-- Right side of the Post --}}
            <div class="col-6 mt-5">
                {{-- images or description --}}
                @if ($post->images->isNotEmpty())
                    <div id="carouselExample" class="carousel slide" data-interval="false">
                        <div class="carousel-indicators">
                            {{-- if there is more than 1 image, button will show up --}}
                            @if ($post->images->count() > 1)
                            @foreach ($post->images as $index => $image)
                                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="{{ $index }}" class="@if($index == 0) active @endif" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                            @endforeach
                            @endif
                        </div>
                        <div class="carousel-inner px-auto">
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
                        <p class="display-4">{{ $post->description }}</p>
                    </div>
                @endif
            </div>

            <div class="row pt-6">
                <div class="col-6 pt-6">
                    {{-- Comment form --}}
                    <form action="{{ route('comment.store', $post->id) }}" method="post">
                        @csrf

               {{-- Enpathy Slider for non-owners --}}
                        @if (!($post->user->id === Auth::user()->id))
                            <div class="form-group mb-2 mx-3">
                                <label for="enpathy">Empathy:</label>
                                <div class="range-slider">
                                    <input type="range" id="percentage" name="percentage" value="60"
                                        min="60" max="100" step="1" list="my-datalist"
                                        class="bg-turquoise"
                                        oninput="document.getElementById('output1').value=this.value">
                                    <output id="output1" class="m-2">60</output><span>%</span>
                                </div>
                            </div>
                        @endif

                        {{-- Comment for post --}}
                        <textarea name="comment" id="{{ $post->id }}" rows="1" class="form-control form-control-sm"
                            placeholder="Add a comment...">{{ old('comment' . $post->id) }}</textarea>

                        @error('comment')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="btn btn-gold form-group mt-3 ml-1 btn-lg">Send</button>
                    </form>
                </div>
                <div class="text-end">
                    {{-- you can see all reaction witch post owner get here --}}
                    <button class="shadow-none p-0 border-0 text-turquoise bg-pink" data-bs-toggle="modal"
                        data-bs-target="#see-all-reactions{{-- #delete-post-{{ $post->id }} --}}">
                        {{-- use modal to show all reaction --}}
                        see all reactions
                    </button>
                    @include('users.posts.modals.empathy')
                </div>
            </div>
        </div>

