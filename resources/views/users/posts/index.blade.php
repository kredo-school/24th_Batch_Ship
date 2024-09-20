@extends('layouts.app')

@section('title', 'Post:index')

@section('content')

    <div class="container">
        @if ($all_posts->isNotEmpty())
            <div id="masonry-grid" class="row g-2 align-items-start masonry" data-masonry='{"percentPosition": true }'>
                @foreach ($all_posts as $post)
                    <div class="col-lg-3 col-md-6 mb-2 masonry-item">
                        <a href="{{ route('users.posts.show',$post->id)}}" class="text-decoration-none">
                            <div class="card shadow rounded border-0 bg-pink d-flex flex-column">
                                <div class="card-body d-flex flex-column">
                                    {{-- post description --}}
                                    <div class="mb-3 card-text large-text text-dark">{{ Str::limit($post->description, 100) }}</div>
                                    {{-- post image --}}
                                    @if(!empty($post->image))
                                        <div><img src="{{ $post->image }}" alt="Post ID {{ $post->id }}" class="fixed-size-img rounded"></div>
                                    @endif
                                    {{-- post category --}}
                                    <div class="row card-text text-start ms-1 mt-auto">
                                        <div class="col">
                                            @foreach ($post->categoryPost as $category_post)
                                                <a href="#" class="badge me-1 bg-turquoise text-decoration-none">{{ $category_post->category->name }}</a>
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