@extends('layouts.app')

@section('title', 'Create Post')

@section('content')

    <style>

    .right-border
    {
        border-right: 1px solid rgb(181, 179, 176);
    }

    .scroll-container
    {
    overflow-y: auto;
    height: 350px;
     }

    </style>


    <div class="bg-pink p-5">   {{-- Container  bg-pink div--}}

        <form action="#" method="post" enctype="multipart/form-data">
         @csrf
            <h3 class="d-block fw-bold text-center mb-5 ">
                Share what you like !
            </h3>

 {{-- Description  --}}
            <div class="row bg-white">   {{-- white background div --}}

                <div class="col-7 mt-2 right-border ">　 {{-- left side div--}}
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
                             <button type="submit" class="btn bg-gold text-white mt-5 mx-5 w-50">Post</button>
                        </div>

                   </div>

                </div> {{-- end of left side div--}}

 {{-- Category  --}}
                <div class="col ">  {{-- right side div--}}
                    <p class=" text-center mt-3 ">▼ Select your Interests ! </p>
                    <div class="m-3 scroll-container ">
                        @foreach($all_categories as $category)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input">
                    <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
                </div>
            @endforeach
            @error('category')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
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



                    </div>
                </div> {{-- end of right side div--}}

        </form>

    </div>  {{-- end of white background div --}}
    </div>  {{-- end of container bg-pink div --}}
@endsection
