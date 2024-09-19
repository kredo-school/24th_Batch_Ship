@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/style_postshow.css') }}">


</head>
 <div class="bg-pink px-5 py-4">   {{-- Container  bg-pink div--}}
<form action="{{ route('users.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

        <h3 class="d-block fw-bold text-center mb-4">
            Changed your mind? Go ahead and edit your post.
        </h3>

        <form action="{{ route('users.posts.store' )}}" method="post" enctype="multipart/form-data">
         @csrf
            {{-- Description  --}}
            <div class="row bg-white">   {{-- white background div --}}

                <div class="col-7 mt-2 right-border"> {{-- left side div--}}

             {{--Current Image  --}}
            <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class=" img-thumbnail w-25 m-2 align-items-center">

           <textarea name="description" id="description" rows="3" class="form-control mt-2" placeholder="What's on your mind?">{{ old('description', $post->description) }}</textarea>
               @error('description')
                 <div class="text-danger small">{{ $message }}</div>
                @enderror

          {{-- New Image  --}}
                    <div class="row">
                        <div class="col-8">
                         <label for="image" class="form-label fw-bold mt-2">Image</label>
                            <input type="file" name="image" id="image" class="form-control"
                              aria-describedby="image-info">
                            <div id="image-info" class="form-text p-2">
                              The acceptable formats are jpeg, jpg, png, and gif only.<br>
                              Max file size is 1048kB.
                            </div>
                            @error('image')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
                        </div>
                        {{-- PostButton  --}}
                        <div class="col">
                            <button type="submit" class="btn btn-gold mt-5 w-50">Edit</button>
                        </div>

                   </div>

            </div> {{-- end of left side div--}}

                {{-- Category  --}}
                 <div class="col">  {{-- right side div--}}
                     <p class=" text-center mt-3 ">▼ Select your Interests ! (at least one) </p>
                       <div class="m-3 scroll-container ">
                          <div class="category">
                                   @foreach($all_categories as $category)


                                    <input type="checkbox" name="category[]" id="{{ $category->name }}" name="{{ $category->id }}" autocomplete="off" value="{{ $category->id }}">
                                   <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>

                                   @endforeach
 　　　　　　　            </div>
                       </div>

                </div> {{-- end of right side div--}}
         </form>
    </div>  {{-- end of white background div --}}
</div>  {{-- end of container bg-pink div --}}
@endsection


