@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<head>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style_postshow.css') }}">

</head>

    <div class="bg-pink px-5 py-4">   {{-- Container  bg-pink div--}}

        <h3 class="d-block fw-bold text-center mb-4">
            Share what you like !
        </h3>

        <form action="{{-- {{ route('post.store' )}} --}}" method="post" enctype="multipart/form-data">
         @csrf
            {{-- Description  --}}
            <div class="row bg-white">   {{-- white background div --}}

                <div class="col-7 mt-4 right-border "> {{-- left side div--}}
                    {{-- description of post --}}
                    <textarea name="description" id="description" rows="10" class="form-control " placeholder="Tell us what you got !"></textarea>

                    {{-- Image  --}}
                    <div class="row">
                        <div class="col-8">
                         <label for="image" class="form-label fw-bold mt-2">Image</label>
                            <input type="file" name="image" id="image" class="form-control"
                              aria-describedby="image-info">
                            <div id="image-info" class="form-text p-2">
                              The acceptable formats are jpeg, jpg, png, and gif only.<br>
                              Max file size is 1048kB.
                            </div>
                        </div>
                        {{-- PostButton  --}}
                        <div class="col">
                            <button type="submit" class="btn btn-gold mt-5 mx-5 w-50">Post</button>
                        </div>

                   </div>

                </div> {{-- end of left side div--}}

                {{-- Category  --}}
                <div class="col">  {{-- right side div--}}
                    <p class=" text-center mt-3 ">▼ Select your Interests ! </p>
                    <div class="m-3 scroll-container "> {{-- use foreach to make loop--}}

                        @foreach($all_categories as $category )
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="category[]" class="btn-check" id="category{{ $category->id }}" value="{{ $category->id }}" checked autocomplete="off">
                                <label for="category{{ $category->id }}" class="btn border-0 btn-sm m-2 btn-warning">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach

                    </div>



                     {{-- <div class="form-check form-check-inline">
                         @foreach($all_categories as $category )

                            <input type="checkbox" name="category[]" class="btn-check" id="category{{ $category->name }}" value="{{ $category->id }}" checked autocomplete="off">
                            <label for="category{{ $category->name }}" class="btn border-0 btn-sm m-2 btn-warning">
                                Test{{ $category->name}}
                            </label> --}}

                            {{-- <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input">
                            <label for="{{ $category->name }}" class="form-check-label"{{ $category->name }}></label> --}}

                            {{-- <button name="category[]" class="btn bg-pink btn-sm m-2" value="{{ $category->id }}" id="category{{ $category->name }}"></button>
                            <label class="form-check-label" for="category{{ $category->name }}">{{ $category->name }}</label> --}}


                         {{-- @endforeach
                         </div> --}}
 </div>
                </div>



                        {{-- <button class="btn bg-pink btn-sm m-2">Anime</button>
                        <button class="btn bg-pink btn-sm m-2">Manga</button>
                        <button class="btn bg-pink btn-sm m-2">Game</button>
                        <button class="btn bg-pink btn-sm m-2">Anime</button>
                        <button class="btn bg-pink btn-sm m-2">Manga</button>
                        <button class="btn bg-pink btn-sm m-2">Game</button>
                        <button class="btn bg-pink btn-sm m-2">Anime</button>
                        <button class="btn bg-pink btn-sm m-2">Manga</button>
                        <button class="btn bg-pink btn-sm m-2">Game</button>
                        <button class="btn bg-pink btn-sm m-2">Anime</button>
                        <button class="btn bg-pink btn-sm m-2">Manga</button>
                        <button class="btn bg-pink btn-sm m-2">Game</button>
                        <button class="btn bg-pink btn-sm m-2">Anime</button>
                        <button class="btn bg-pink btn-sm m-2">Manga</button>
                        <button class="btn bg-pink btn-sm m-2">Game</button>
                        <button class="btn bg-pink btn-sm m-2">Anime</button>
                        <button class="btn bg-pink btn-sm m-2">Manga</button>
                        <button class="btn bg-pink btn-sm m-2">Game</button>
                        <button class="btn bg-pink btn-sm m-2">Game</button>
                        <button class="btn bg-pink btn-sm m-2">Anime</button>
                        <button class="btn bg-pink btn-sm m-2">Manga</button>
                        <button class="btn bg-pink btn-sm m-2">Game</button>
                        <button class="btn bg-pink btn-sm m-2">Anime</button>
                        <button class="btn bg-pink btn-sm m-2">Manga</button>
                        <button class="btn bg-pink btn-sm m-2">Game</button>
                        <button class="btn bg-pink btn-sm m-2">Anime</button>
                        <button class="btn bg-pink btn-sm m-2">Manga</button>
                        <button class="btn bg-pink btn-sm m-2">Game</button>
                        <button class="btn bg-pink btn-sm m-2">Anime</button>
                        <button class="btn bg-pink btn-sm m-2">Manga</button>
                        <button class="btn bg-pink btn-sm m-2">Game</button>
                        <button class="btn bg-pink btn-sm m-2">Anime</button>
                        <button class="btn bg-pink btn-sm m-2">Manga</button>
                        <button class="btn bg-pink btn-sm m-2">Game</button>
                        <button class="btn bg-pink btn-sm m-2">Anime</button>
                        <button class="btn bg-pink btn-sm m-2">Manga</button>
                        <button class="btn bg-pink btn-sm m-2">Game</button>
                        <button class="btn bg-pink btn-sm m-2">Anime</button>
                        <button class="btn bg-pink btn-sm m-2">Manga</button>
                        <button class="btn bg-pink btn-sm m-2">Game</button>
                        <button class="btn bg-pink btn-sm m-2">Anime</button>
                        <button class="btn bg-pink btn-sm m-2">Anime</button>
                        <button class="btn bg-pink btn-sm m-2">Manga</button>
                        <button class="btn bg-pink btn-sm m-2">Game</button>
                        <button class="btn bg-pink btn-sm m-2">Anime</button>
                    </div> --}}
                </div> {{-- end of right side div--}}

        </form>

    </div>  {{-- end of white background div --}}
    </div>  {{-- end of container bg-pink div --}}
@endsection
