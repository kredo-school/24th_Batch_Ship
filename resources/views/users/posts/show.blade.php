@extends('layouts.app')

@section('title', 'Post:show')

@section('content')
<head>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style_postshow.css') }}">

</head>
    <div class="card border-0 bg-pink">
        <div class="card-body">
            <div class="row">
                {{-- Left side of the Post--}}
                <div class="col-7">
                    <div class="row">
                        <div class="col-2 px-0 avatar-show text-center">
                            {{-- <a href="{{ route('profile.show', $post->user->id) }}">
                                @if ($post->user->avatar)
                                    <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}"
                                        class="rounded-circle avatar-sm">
                                @else
                                    <i class="fas fa-circle-user text-secondary icon-sm"></i>
                                @endif
                            </a> --}}
                        </div>

                        <div class="col-10 my-auto">
                            <div class="row mt-3">
                                <div class="col fw-bold h4">
                                    {{-- Name of user who posted this post--}}
                                    {{-- <p>Freddie Mercury</p> --}}
                                    {{-- <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-dark">
                                        {{ $post->user->name }}
                                    </a> --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mt-3">
                                    {{-- it will be used loop--}}
                                    <div class="category">
                                        <table>
                                         <tr>
                                           <td>
                                               {{-- @foreach($all_categories as $category)


                                               <span class="badge me-1 bg-turquoise text-white" name="category[]" id="{{ $category->name }}" name="{{ $category->id }}">
                                               {{ $category->name }}</span>

                                               @endforeach --}}
                                           </td>
                                        </tr>
                                      </table>
             　　　　　　　            </div>
                                    {{-- <span class="badge me-1 bg-turquoise text-white">Anime</span>
                                    <span class="badge me-1 bg-turquoise text-white">Anime</span>
                                    <span class="badge me-1 bg-turquoise text-white">Anime</span>  --}}
                                </div>

                                {{-- <div class="col-3 text-end pe-0 mt-4">
                                    <p class="text-uppercase text-muted xsmall">{{ date('M d, Y', strtotime($comment->created_at)) }}August 14 2024{{-- date('M d, Y', strtotime($post->created_at))</p>--}}
                                </div>

                                <div class="col-3 text-center mt-2">
                                    {{-- If you are the owner of the post, you can edit or delete this post --}}
                                        @if ($post->user->id === Auth::user()->id)
                                        <div class="">
                                            {{-- edit --}}
                                            <a href="#" class="post-edit btn edit-icon pe-0">
                                                <i class="fa-regular fa-pen-to-square show-icon"></i>
                                            </a>

                                            {{-- delete --}}
                                            <span class="btn post-delete show-icon ps-2" data-bs-toggle="modal" data-bs-target="#delete{{-- #delete-post-{{ $post->id }} --}}">
                                                <i class="fa-regular fa-trash-can fw-bold"></i>
                                                @include('users.posts.modals.delete')
                                            </span>
                                        </div>
                                    @else

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0">

                    {{-- Post content--}}
                    <div class="row py-5 px-3">
                        {{-- <a href="{{ route('profile.show', $post->user->id) }}"
                            class="text-decoration-none text-dark fw-bold">{{ $post->user->name }}</a> --}}
                        &nbsp;
                        <p class="d-inline fw-light">{{ $post->description }}</p>
                        <p class="text-uppercase text-muted xsmall">{{ date('M d, Y', strtotime($post->created_at)) }}</p>

                        {{-- Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil ad sint porro odit, illum neque blanditiis, maxime quis tempora voluptatem velit deserunt. Corporis perferendis deleniti, quisquam sint ipsum tenetur. Vitae!

                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil ad sint porro odit, illum neque blanditiis, maxime quis tempora voluptatem velit deserunt. Corporis perferendis deleniti, quisquam sint ipsum tenetur. Vitae!

                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil ad sint porro odit, illum neque blanditiis, maxime quis tempora voluptatem velit deserunt. Corporis perferendis deleniti, quisquam sint ipsum tenetur. Vitae! --}}
                    </div>
                </div>

                {{-- Right side of the Post--}}
                <div class="col-5">
                    <div class="row position-center mx-0">
                        {{-- will use pagenation or scroll bar to see multiple image of post--}}
                        <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="w-100">
                        {{-- <img class="img-show" src="https://images.pexels.com/photos/27637374/pexels-photo-27637374.jpeg?auto=compress&cs=tinysrgb&w=1200&lazy=load" alt=""> --}}
                    </div>
                </div>
            </div>

            <div class="row pt-6">
                <form class="" action="" method="post">
                    {{-- Enpathy %  -> choose 1 from 2 patterns --}}
                        {{-- use javascript and show current value--}}
                        {{-- <div class="form-group mb-2">
                            <label for="enpathy">Enpathy:</label>
                            <input type="range" id="enpathy" class="form-control-range" min="60" max="100">
                        </div> --}}

                        {{-- input type --}}
                        {{-- <div class="input-group mb-2 w-25" rows="1"  >
                            <input type="number" class="form-control form-control-sm form-group" placeholder="empathy" aria-label="empathy" aria-describedby="empathy">
                            <span class="input-group-text" id="empathy">%</span>
                        </div> --}}


                    {{-- show all the comments --}}
                    {{-- @if ($post->comments->isNotEmpty())
                    <ul class="list-group mt-2">
                        @foreach ($post->comments as $comment)
                            <li class="list-group-item border-0 p-0 mb-2">
                                <a href="{{ route('profile.show', $comment->user->id) }}"
                                    class="text-decoration-none text-dark fw-bold">{{ $comment->user->name }}</a>
                                &nbsp;
                                <p class="d-inline fw-light">{{ $comment->body }}</p>

                                <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                                    @csrf
                                    @method('DELETE') --}}

                    {{-- comment for post --}}
                        <textarea name="postcomment" rows="1" placeholder="comment" class="form-control form-control-sm form-group mb-2"></textarea>

                    {{-- submit --}}
                        <button type="submit" class="btn btn-sm btn-gold form-group">Post</button>
                </form>
            </div>

            <div class="text-end">
                {{-- you can see all reaction witch post owner get here --}}
                <button class="shadow-none p-0 border-0 text-turquoise bg-pink" data-bs-toggle="modal" data-bs-target="#see-all-reactions{{-- #delete-post-{{ $post->id }} --}}">
                    {{-- use modal to show all reaction --}}
                    see all reactions
                </button>
                @include('users.posts.modals.empathy')
            </div>
        </div>
    </div>


@endsection
