@extends('layouts.app')

@section('title', 'Post:index')

@section('content')

    <div class="container">
        @if ($all_posts->isNotEmpty())
            <div id="masonry-grid" class="row g-2 align-items-start masonry" data-masonry='{"percentPosition": true }'>
                @foreach ($all_posts as $post)
                <div class="col-lg-3 col-md-6 mb-2 masonry-item">
                    <a href="{{ route('users.posts.show', $post->id) }}" class="text-decoration-none">
                        <div class="card shadow rounded border-0 bg-pink d-flex flex-column">
                            <div class="card-body d-flex flex-column">
                                {{-- post description --}}
                                <div class="mb-3 card-text large-text text-dark">{{ Str::limit($post->description, 100) }}</div>
                                
                                {{-- post images (vertical layout) --}}
                                @if($post->images->isNotEmpty())
                                    @foreach ($post->images as $image)
                                        <div class="mb-2">
                                            <img src="data:image/png;base64,{{ $image->image_data }}" alt="Post ID {{ $post->id }}" class="w-100 rounded">
                                        </div>
                                    @endforeach
                                @endif
                
                                {{-- post category --}}
                                <div class="row card-text text-start mt-2">
                                    <div class="col">
                                        @foreach ($post->categoryPost as $category_post)
                                            <a href="{{ route('users.categories.show', $category_post->category_id) }}" class="badge bg-turquoise text-decoration-none me-1 mt-2">
                                                {{ $category_post->category->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>                
                @endforeach
            </div>
        @else
            <h3 class="text-secondary text-center">No Posts Yet</h3>
        @endif
    </div>

@endsection

@section('styles')
<link rel="stylesheet" href="{{asset('css/style_postshow.css')}}">
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" async></script>
@endsection