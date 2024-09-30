@extends('layouts.app')

@section('title', 'Create Post')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/style_postshow.css') }}">
@endsection

@section('content')
    <div class="bg-pink px-5 py-4">   {{-- Container  bg-pink div--}}
        <h3 class="d-block fw-bold text-center mb-4">
            Share what you like !
        </h3>

        <form action="{{ route('users.posts.store' )}}" method="post" enctype="multipart/form-data">
        @csrf
            {{-- Description  --}}
            <div class="row bg-white">   {{-- white background div --}}
                <div class="col-7 mt-4 right-border "> {{-- left side div--}}
                    {{-- description of post --}}
                    <textarea name="description" id="description" rows="10" class="form-control " placeholder="Tell us what you got !">{{ old('description') }}</textarea>
                    {{-- Error message area --}}
                    @error('description')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror

                    {{-- Image  --}}
                    <div class="row">
                        <div class="col-8">
                            <label for="image" class="form-label fw-bold mt-2">Image</label>
                            <input type="file" name="images[]" id="images" class="form-control" aria-describedby="image-info" multiple>
                            <div id="image-info" class="form-text p-2">
                              The acceptable formats are jpeg, jpg, png, and gif only.<br>
                              Max file size is 1048kB.
                            </div>
                            {{-- Error --}}
                            @error('images.*')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- PostButton  --}}
                        <div class="col">
                            <button type="submit" class="btn btn-gold mt-5 mx-5 w-50">Post</button>
                        </div>
                    </div>
                </div> {{-- end of left side div--}}


                {{-- Category  --}}
                <div class="col">  {{-- right side div--}}
                    <p class="text-center mt-3 ">▼ Select your Interests ! (at least one)</p>
                    <div class="m-3 scroll-container ">
                        <div class="category">
                            @foreach($all_categories as $category)
                                <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}">
                                <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
                            @endforeach
                            {{-- Error message area --}}
                            @error('category')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div> {{-- end of right side div--}}
            </div>  {{-- end of white background div --}}
        </form>
    </div>  {{-- end of container bg-pink div --}}
@endsection
