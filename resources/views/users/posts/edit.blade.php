@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/style_postshow.css') }}">
</head>

<div class="bg-pink px-5 py-4"> {{-- Container bg-pink div --}}
    <form action="{{ route('users.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <h3 class="d-block fw-bold text-center mb-4">
            Changed your mind? Go ahead and edit your post.
        </h3>

        <div class="row bg-white"> {{-- white background div --}}
            <div class="col-7 mt-2 right-border"> {{-- left side div --}}
                <div class="row">
                    {{-- Current Image --}}
                    @if ($post->images->isNotEmpty())
                        <div class="d-flex flex-wrap">
                            @foreach ($post->images as $image)
                                <div class="col-3">
                                    <div class="position-relative me-2 mb-2 w-100 image-container" data-key="{{ $image->id }}">
                                        <img src="data:image/png;base64,{{ $image->image_data }}" alt="Post ID {{ $post->id }}" class="w-100 img-thumbnail d-inline-block">
                                        <button type="button" class="position-absolute bg-transparent border-0 bg-light fs-3 delete-image" style="top: -5%; right: -5%;" aria-label="Close">
                                            <i class="fa-solid fa-circle-xmark text-danger"></i>
                                        </button>
                                        <input type="hidden" name="remove_images[]" class="remove-image-input" value="{{ $image->id }}" disabled>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>


                {{-- Description --}}
                <textarea name="description" id="description" rows="3" class="form-control mt-2" placeholder="What's on your mind?">{{ old('description', $post->description) }}</textarea>
                @error('description')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror

                {{-- New images Preview area --}}
                <div class="mt-2 me-2 mb-2 d-flex d-wrap" id="imagePreview"></div>

                {{-- New Image --}}
                <div class="row">
                    <div class="col-8">
                        <label for="image" class="form-label fw-bold mt-2">New Image</label>
                        <input type="file" name="image[]" id="image" class="form-control" aria-describedby="image-info" multiple>
                        <div id="image-info" class="form-text p-2">
                            The acceptable formats are jpeg, jpg, png, and gif only.<br>
                            Max file size is 1048kB.
                        </div>
                        @error('image.*')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror

                    </div>


                <input type="hidden" id="removedImages" name="removedImages" value="">

                    {{-- Post Button --}}
                    <div class="col">
                        <button type="submit" class="btn btn-gold mt-5 w-50">Edit</button>
                    </div>
                </div>
            </div> {{-- end of left side div --}}

            {{-- Category --}}
            <div class="col"> {{-- right side div --}}
                <p class="text-center mt-3">▼ Select your Interests! (at least one)</p>
                {{-- Error message area --}}
                @error('category')
                    <div class="text-danger small text-center">{{ $message }}</div>
                @enderror
                <div class="m-3 scroll-container">
                    <div class="category">
                        @foreach($all_categories as $category)
                            <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}"
                                @if(in_array($category->id, old('category', $post->categories->pluck('id')->toArray()))) checked @endif
                                autocomplete="off">
                            <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
                        @endforeach
                    </div>
                    
                </div>
            </div> {{-- end of right side div --}}
        </div> {{-- end of white background div --}}
    </form>
</div> {{-- end of container bg-pink div --}}
@endsection

@section('scripts')
<script src="{{ asset('js/posts/post_edit.js') }}" async></script>
@endsection
