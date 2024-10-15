@section('styles')
<link rel="stylesheet" href="{{asset('css/style_postshow.css')}}">
@endsection

<div class="container-fluid bg-pink p-3">
    <div class="row m-3">
        <h2>{{ Auth::user()->id == $user->id ? 'My post' : "{$user->username}'s post" }}</h2>
    </div>

    <div class="row row-eq-height">
        @if ($posts->isNotEmpty())
            {{-- Loop through posts --}}
            @foreach ($posts as $post)
                <div class="col-sm-3 mb-3">
                    <a href="{{ route('users.posts.show', $post->id) }}" class="text-decoration-none text-black">
                        <div class="card border-0 rounded h-100 d-flex flex-column">
                            <div class="card-body p-0 m-0 flex-grow-1">
                                {{-- Images --}}
                                @if ($post->images->isNotEmpty())
                                    <div id="carousel-{{ $post->id }}" class="carousel slide" data-bs-ride="false">
                                        <div class="carousel-inner p-0">
                                            @foreach ($post->images as $index => $image)
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                    <div class="d-flex justify-content-center">
                                                        <img src="data:image/png;base64,{{ $image->image_data }}" alt="Post ID {{ $post->id }}" class="fixed-size-img rounded card-img-top w-100 p-0">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        {{-- Control buttons placed below the carousel --}}
                                        @if ($post->images->count() > 1)
                                            <div class="d-flex justify-content-center mt-2">
                                                <button class="carousel-control-prev custom-carousel-control" type="button" data-bs-target="#carousel-{{ $post->id }}" data-bs-slide="prev">
                                                    <i class="fa-solid fa-caret-left fs-1 bg-white text-turquoise px-2">
                                                        <span class="visually-hidden">Previous</span>
                                                    </i>
                                                </button>
                                                <button class="carousel-control-next custom-carousel-control" type="button" data-bs-target="#carousel-{{ $post->id }}" data-bs-slide="next">
                                                    <i class="fa-solid fa-caret-right fs-1 bg-white text-turquoise px-2">
                                                        <span class="visually-hidden">Next</span>
                                                    </i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                {{-- Description --}}
                                <p class="card-title m-2">
                                    {{ Str::limit($post->description, 140, '...') }}
                                    @if(strlen($post->description) > 140)
                                        <a href="{{ route('users.posts.show', $post->id) }}" class="text-decoration-none">Read More</a>
                                    @endif
                                </p>
                            </div> {{-- card body --}}

                            {{-- Loop selected categories --}}
                            <div class="row p-2">
                                <div class="col">
                                    @forelse ($post->categoryPost as $category_post)
                                        @if(isset($category_post->category->name))
                                            <a href="{{ route('users.categories.show', $category_post->category_id) }}" class="badge bg-turquoise text-decoration-none me-1 mt-2">
                                                {{ $category_post->category->name }}
                                            </a>
                                        @endif
                                    @empty
                                        <a href="#" class="badge bg-turquoise mt-1 text-decoration-none">Uncategorized</a>
                                    @endforelse
                                </div>
                            </div> {{-- row for categories --}}

                            {{-- Card footer --}}
                            <div class="card-footer bg-light p-1 mt-auto">
                                @if (Auth::user()->id == $user->id)
                                    {{-- Auth user の場合 --}}
                                    @if ($comments->isNotEmpty() && $comments->where('post_id', $post->id)->isNotEmpty())
                                        @php
                                            // 最新のコメントを取得
                                            $latestComment = $comments->where('post_id', $post->id)->sortByDesc('created_at')->first();
                                        @endphp
                                        <div class="comment-item" data-percentage="{{ $latestComment->percentage }}" data-date="{{ $latestComment->created_at }}">
                                            <div class="row align-items-center p-2">
                                                <div class="col-3 text-end">
                                                    {{ $latestComment->percentage }}<span>%</span>
                                                </div>
                                                <div class="col-3">
                                                    <a href="{{ route('users.profile.specificProfile', $latestComment->user_id) }}">
                                                        @if ($latestComment->user->avatar)
                                                            <img src="{{ $latestComment->user->avatar }}" alt="{{ $latestComment->user->name }}" class="rounded-circle avatar-sm no-underline">
                                                        @else
                                                            <i class="fa-solid fa-circle-user text-secondary text-center icon-sm no-underline"></i>
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="col-xl-6">
                                                    <a href="{{ route('users.profile.specificProfile', $latestComment->user_id) }}" class="text-decoration-none text-dark fw-bold">{{ $latestComment->user->username }}</a>
                                                </div>
                                                <div class="row mt-2">
                                                    @if ($latestComment)
                                                        <strong class="d-inline fw-light">{{ $latestComment->comment }}</strong>
                                                        <span class="text-muted small ms-2">{{ date('M d, Y', strtotime($latestComment->created_at)) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div> {{-- comment-item --}}
                                    @endif
                                @else
                                    {{-- other user's view --}}
                                    @if ($comments->isNotEmpty() && $comments->where('post_id', $post->id)->isNotEmpty())
                                        @php
                                            // 最新のコメントを取得
                                            $latestComment = $comments->where('post_id', $post->id)->sortByDesc('created_at')->first();
                                        @endphp
                                        <div class="comment-item" data-percentage="{{ $latestComment->percentage }}" data-date="{{ $latestComment->created_at }}">
                                            <div class="row align-items-center p-2">
                                                <div class="col-3 text-end">
                                                    {{ $latestComment->percentage }}<span>%</span>
                                                </div>
                                                <div class="col-3">
                                                    <a href="{{ route('users.profile.specificProfile', $latestComment->user_id) }}">
                                                        @if ($latestComment->user->avatar)
                                                            <img src="{{ $latestComment->user->avatar }}" alt="{{ $latestComment->user->name }}" class="rounded-circle avatar-sm no-underline">
                                                        @else
                                                            <i class="fa-solid fa-circle-user text-secondary text-center icon-sm no-underline"></i>
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="col-xl-6">
                                                    <a href="{{ route('users.profile.specificProfile', $latestComment->user_id) }}" class="text-decoration-none text-dark fw-bold">{{ $latestComment->user->username }}</a>
                                                </div>
                                                <div class="row mt-2">
                                                    @if ($latestComment)
                                                        <strong class="d-inline fw-light">{{ $latestComment->comment }}</strong>
                                                        <span class="text-muted text-end small ms-2">{{ date('M d, Y', strtotime($latestComment->created_at)) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div> {{-- comment-item --}}
                                    @endif

                                    {{-- Empathy Slider and Comment Input for non-owners --}}
                                    <div class="row p-2">
                                        <form action="{{ route('empathy.store', $post->id) }}" method="post">
                                            @csrf
                                            <div class="form-group mb-2">
                                                <div class="range-slider"> 
                                                    <span class="">Empathy:</span>&nbsp;
                                                    <input type="range" id="percentage" name="percentage" value="60" min="60" max="100" step="1" list="my-datalist" class="bg-turquoise w-100 ms-3" oninput="document.getElementById('output2').value=this.value">
                                                    <output id="output2" class="m-2">60</output><span>%</span>
                                                </div>
                                            </div>

                                            {{-- Comment for post --}}
                                            <div class="form-group d-flex align-items-center mx-2">
                                                <div class="col-lg-8">
                                                    <input type="text" name="comment" id="{{ $post->id }}" class="form-control comment-post w-100" placeholder="Add a comment..." oninput="checkCommentLength(this)">
                                                </div>

                                                <button type="submit" class="col-lg-4 btn btn-gold form-group btn-sm">
                                                    <span class="text-center">Send</span>
                                                </button>
                                                @error('comment.' . $post->id)
                                                <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                               
                                            <div class="row text-end">
                                                <a href="{{ route('users.posts.show', $post->id) }}" class="text-decoration-none text-turquoise">see more</a>
                                                {{-- <button class="shadow-none p-0 border-0 text-turquoise bg-transparent" data-bs-toggle="modal"
                                                    data-bs-target="#see-all-reactions">
                                                    see all reactions
                                                </button> --}}
                                                {{-- @include('users.posts.modals.empathy') --}}
                                            </div>
                                        </form>
                                    </div> {{-- Comment Input --}}
                                @endif
                            </div> {{-- Card Footer --}}
                        </div> {{-- Card --}}
                    </a>
                </div> {{-- Post Column --}}
            @endforeach
        @else
            <p class="text-center mt-5">No posts found.</p>
        @endif
    </div> {{-- Row --}}
    
    <div class="d-flex justify-content-center mt-2">
        @if($posts instanceof \Illuminate\Pagination\LengthAwarePaginator && $posts->total() > 0)
            {{ $posts->appends(request()->query())->links('pagination::bootstrap-4') }}
        @endif
    </div>
</div> {{-- Container --}}


@section('scripts')
<script src="{{ asset('js/posts/empathy.js') }}"></script>
<script src="{{ asset('js/profile/compatibility.js') }}"></script>
<script src="{{ asset('js/profile/index.js') }}"></script>
@endsection
