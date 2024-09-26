@extends('layouts.app')

@section('title', 'Post:show')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/style_postshow.css') }}">
@endsection

@section('content')

    <head>
        <link rel="stylesheet" href="{{ asset('css/style_postshow.css') }}">



    </head>
    <div class="card border-0 bg-pink">
        <div class="card-body">
            <div class="row">
                {{-- Left side of the Post --}}
                <div class="col-7">
                    <div class="row ">
                        <div class="col-2 px-0">
                            @if ($post->user->avatar)
                                <a href="{{ route('users.profile.specificProfile', $post->user->id) }}">

                                    <img src="{{ $post->user->avatar }}" alt=""
                                        class="rounded-circle avatar-profile "></a>
                            @else
                                <a href="{{ route('users.profile.specificProfile', $post->user->id) }}">
                                    <i class="fas fa-circle-user text-secondary icon "></i></a>
                            @endif


                        </div>

                        <div class="col my-auto">
                            <div class="row mt-3">
                                <div class="col  profile-name">
          {{-- Name of user who posted this post --}}
                                    <a href="{{ route('users.profile.specificProfile', $post->user->id) }}"
                                        class="text-decoration-none text-dark mx-2"><span
                                            class="p-3">{{ $post->user->first_name }}</span><span
                                            class="p-3">{{ $post->user->last_name }}</span></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5 m-3">
                                    <div class="category">

                                        @foreach ($post->categoryPost as $category_post)
                                            <span
                                                class="badge category-badge me-2 bg-turquoise text-white"name="category[]">
                                                {{ $category_post->category->name }}</span>
                                        @endforeach


                                    </div>
                                </div>
                                <div class="col text-end  mt-2">
                                    {{-- If you are the owner of the post, you can edit or delete this post --}}

                                    @if ($post->user->id === Auth::user()->id)
                                        {{-- edit --}}
                                        <a href="{{ route('users.posts.edit', $post->id) }}"
                                            class="post-edit btn edit-icon pe-0">
                                            <i class="fa-regular fa-pen-to-square show-icon"></i>
                                        </a>
                                        {{-- delete --}}
                                        <span class="btn post-delete show-icon ps-2" data-bs-toggle="modal"
                                            data-bs-target="#delete">
                                            <i class="fa-regular fa-trash-can fw-bold"></i>
                                            @include('users.posts.modals.delete')
                                        </span>
                                    @else
                                    @endif
                                    <p class="text-uppercase text-muted text-end ">
                                        {{ date('M d, Y', strtotime($post->created_at)) }}</p>

                                </div>
                   <div class="col-2 px-0">
                        @if ($post->user->avatar)
                            <a href="{{ route('users.profile.specificProfile', $post->user->id) }}">
                                <img src="{{ $post->user->avatar }}" alt=""class="rounded-circle avatar-profile ">
                            </a>
                        @else
                            <a href="{{ route('users.profile.specificProfile', $post->user->id) }}">
                            <i class="fas fa-circle-user text-secondary icon " ></i></a>
                        @endif
                    </div>

                    <div class="col my-auto">
                        <div class="row mt-1">
                            <div class="col  profile-name">
                                {{-- Name of user who posted this post--}}
                                <a href="{{ route('users.profile.specificProfile', $post->user->id) }}" class="text-decoration-none text-dark mx-2">
                                    <span class="p-3">{{ $post->user->first_name }}</span><span class="p-3">{{ $post->user->last_name }}</span>
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
                         </div>
                            <div class="col text-end  mt-2">
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
                                    <p class="text-uppercase text-muted text-end ">{{ date('M d, Y', strtotime($post->created_at)) }}</p>
                            </div>
                        </div>
                    </div>

                    </div>
                    <hr class="my-0">

                    {{-- Post content --}}
                    <div class="row py-5 px-3 post-content ">

                    {{-- Post content--}}
                    <div class="row py-5 px-3">
                        &nbsp;
                        <p class="d-inline fw-light">{{ $post->description }}</p>
                    </div>
                </div>

                {{-- Right side of the Post --}}
                <div class="col-5">
                    <div class="row position-center mx-0">
                        @if ($post->image)
                            <img width="25" src="{{ $post->image }}" alt="post id {{ $post->id }}"
                                class="img-postshow mb-4">
                        @endif
                    </div>
                </div>

                <hr class="col-7 mt-5">
                <div class="row pt-6">
                    <div class="row pt-6">
       {{-- Comment form --}}
                        <form action="{{ route('comment.store', $post->id) }}" method="post">
                            @csrf

           {{-- Enpathy Slider for non-owners --}}
                            @if (!($post->user->id === Auth::user()->id))
                                <div class="form-group mb-2 mx-3">
                                    <label for="enpathy">Enpathy:</label>
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

                            <button type="submit" class="btn btn-gold form-group mt-3 ml-1 btn-lg">Send</button>
                        </form>
                    </div>

               {{-- use modal to show all reaction --}}
                    <div class="text-end">
                        <button class="shadow-none p-0 border-0 text-turquoise bg-pink" data-bs-toggle="modal"
                            data-bs-target="#see-all-reactions{{-- #delete-post-{{ $post->id }} --}}">

                            see all reactions
                        </button>
                        @include('users.posts.modals.empathy')
                    </div>
                </div>
            </div>


        @endsection
            <hr class="col-7 mt-5">
            <div class="row pt-6">
                <form class="" action="" method="post">
                    {{-- If you are not the owner of the post, you can put empathy on this post --}}
                    @if (!($post->user->id === Auth::user()->id))
                        <div class="form-group mb-2 mx-3">
                            <label for="enpathy">Enpathy:</label>
                            <div class="range-slider ">
                                <input type="range" id="range" value="60" min="60" max="100" step="1" list="my-datalist" class="bg-turquoise" oninput="document.getElementById('output1').value=this.value">
                                <output id="output1" class="m-2">60</output><span>%</span>
                            </div>
                        </div>
                    @endif

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
                                    @method('DELETE')

                                    <span class="text-uppercase text-muted xsmall">{{ date('M d, Y', strtotime($comment->created_at)) }}</span>

                         @endforeach
                         @endif --}}

         {{-- comment for post --}}
                        <textarea name="postcomment" rows="2" placeholder="comment" class="form-control form-control-sm form-group mt-5"></textarea>
          {{-- If you are not the owner of the post, you can delete comment on this post --}}
                        {{-- @if (Auth::user()->id === $comment->user->id)
                         &middot;
                       <button type="submit" class="border-0 bg-transparent text-danger p-0 xsmall">Delete</button>

                     @endif --}}

                    {{-- submit --}}
                        <button type="submit" class="btn btn-gold form-group m-3 btn-lg">Post</button>
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
