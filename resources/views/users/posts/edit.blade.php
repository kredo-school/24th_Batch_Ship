@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/style_category.css') }}">


</head>
<form action="#" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="bg-pink px-5 py-4">   {{-- Container  bg-pink div--}}

        <h3 class="d-block fw-bold text-center mb-4">
            Share what you like !
        </h3>

        <form action="{{ route('users.posts.store' )}}" method="post" enctype="multipart/form-data">
         @csrf
            {{-- Description  --}}
            <div class="row bg-white">   {{-- white background div --}}

                <div class="col-7 mt-4 "> {{-- left side div--}}

            <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class=" img-thumbnail w-50 m-2">

        <textarea name="description" id="description" rows="3" class="form-control mt-2" placeholder="What's on your mind?">{{ old('description', $post->description) }}</textarea>
        @error('description')
            <div class="text-danger small">{{ $message }}</div>
        @enderror

                    {{-- <textarea name="description" id="description" rows="10" class="form-control " placeholder="Tell us what you got !">{{ old('description') }}</textarea> --}}

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
                     <p class=" text-center mt-3 ">▼ Select your Interests ! </p>
                       <div class="row-10 m-3 scroll-container ">
                          <div class="category">
                            <table>
                             <tr>
                               <td>
                                   @foreach($all_categories as $category)


                                    <input type="checkbox" name="category[]" id="{{ $category->name }}" name="{{ $category->id }}" autocomplete="off" value="{{ $category->id }}">
                                   <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>

                                   @endforeach
                               </td>
                            </tr>
                          </table>
 　　　　　　　            </div>
                       </div>

                </div> {{-- end of right side div--}}
         </form>
    </div>  {{-- end of white background div --}}
</div>  {{-- end of container bg-pink div --}}
@endsection


    {{-- <div class="mb-3">
        <label for="category" class="form-label d-block fw-bold">
            Category
        </label>

        <div class="category">
        @foreach($all_categories as $category)
        <div class="form-check form-check-inline">
            @if (in_array($category->id, $selected_categories))
                <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input" checked>
            @else
                <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input">
            @endif

            <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
        </div>
        @endforeach
        @error('category')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
</div>
    <div class="mb-3">
        <label for="description" class="form-label fw-bold">Description</label>
        <textarea name="description" id="description" rows="3" class="form-control" placeholder="What's on your mind?">{{ old('description', $post->description) }}</textarea>
        @error('description')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="row mb-4">
        <div class="col-6">
            <label for="image" class="form-label fw-bold">Image</label>
            <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="img-thumbnail w-100">
            <input type="file" name="image" id="image" class="form-control mt-1" aria-describedby="image-info">
            <div id="image-info" class="form-text">
                The acceptable formats are jpeg, jpg, png, and gif only. <br>
                Max file size is 1048kB.
            </div>
            @error('image')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-warning px-5">Save</button>
</form>
@endsection --}}
