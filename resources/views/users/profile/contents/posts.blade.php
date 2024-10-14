
<head>
    <link rel="stylesheet" href="{{ asset('css/style_profileindex.css') }}">
</head>

<div class="container-fluid bg-pink p-3">
    <div class="row m-3">
        @if (Auth::user()->id == $user->id)
            <h2>My post</h2>
        @else
            <h2>{{ $user->username }}'s post</h2>
        @endif
    </div>

    <div class="row row-eq-height">
        @if ($posts->isNotEmpty())
            {{-- loop through posts --}}
            @foreach ($posts as $post)
                <div class="col-sm-3 mb-3">
                    <a href="{{ route('users.posts.show', $post->id) }}" class="text-decoration-none text-black">
                        <div class="card border-0 rounded h-100 mb-3">
                            <div class="card-body">
                                {{-- description --}}
                                <p class="card-title">{{ $post->description }}</p>

                                {{-- images --}}
                                @if ($post->images->isNotEmpty())
                                    <div id="carousel-{{ $post->id }}" class="carousel slide" data-bs-ride="false">
                                        <div class="carousel-inner">
                                            @foreach ($post->images->chunk(2) as $index => $imagesChunk)
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                    <div class="d-flex justify-content-center">
                                                        @foreach ($imagesChunk as $image)
                                                            <div class="mx-1" style="overflow: hidden;">
                                                                <img src="data:image/png;base64,{{ $image->image_data }}" alt="Post ID {{ $post->id }}" class="img-fluid img-profile-index">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        @if ($post->images->count() > 2)
                                            <button class="carousel-control-prev btn-profile-post-prev" type="button" data-bs-target="#carousel-{{ $post->id }}" data-bs-slide="prev">
                                                <i class="fa-solid fa-caret-left fs-1 text-turquoise">
                                                    <span class="visually-hidden">Previous</span>
                                                </i>
                                            </button>
                                            <button class="carousel-control-next btn-profile-post-next" type="button" data-bs-target="#carousel-{{ $post->id }}" data-bs-slide="next">
                                                <i class="fa-solid fa-caret-right fs-1 text-turquoise">
                                                    <span class="visually-hidden">Next</span>
                                                </i>
                                            </button>
                                        @endif
                                    </div>
                                @endif

                                {{-- loop selected categories --}}
                                <div class="row">
                                    <div class="col">
                                        @forelse ($post->categoryPost as $category_post)
                                            <a href="{{ route('users.categories.show', $category_post->category_id) }}" class="badge bg-turquoise text-decoration-none me-1 mt-2">
                                                {{ $category_post->category->name }}
                                            </a>
                                        @empty
                                            <a href="#" class="badge bg-turquoise mt-1 text-decoration-none">Uncategorized</a>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-light">
                                @if (Auth::user()->id == $user->id)
                                    <div class="container">
                                        @if ($comments->isNotEmpty())
                                             @php
                                    // コメントを作成日でソートして最新のものを取得
                                    $latestComment = $comments->sortByDesc('created_at')->first();
                                @endphp

                             <div class="comment-item" data-percentage="{{ $latestComment->percentage }}" data-date="{{ $latestComment->created_at }}">
                                    <div class="row align-items-center">
                                        <div class="col-7 text-start">
                                            {{ $latestComment->percentage }}<span>%</span>

                                            <a href="{{ route('users.profile.specificProfile', $latestComment->user_id) }}">
                                                @if ($latestComment->user->avatar)
                                                    <img src="{{ $latestComment->user->avatar }}" alt="{{ $latestComment->user->name }}" class="rounded-circle avatar-sm no-underline">
                                                @else
                                                    <i class="fa-solid fa-circle-user text-secondary text-center icon-sm no-underline"></i>
                                                @endif
                                            </a>
                                            <a href="{{ route('users.profile.specificProfile', $latestComment->user_id) }}" class="text-decoration-none text-dark fw-bold">{{ $latestComment->user->username }}</a>
                                        </div>
                                        <div class="col-4 text-start">
                                            <strong class="d-inline fw-light">{{ $latestComment->comment }}</strong>
                                        </div>
                                        <div class="text-end">
                                            <span class="text-uppercase text-muted xsmall text-end">{{ date('M d, Y', strtotime($latestComment->created_at)) }}</span>

                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="text-end">
                                        <button class="shadow-none p-0 border-0 text-turquoise bg-light" data-bs-toggle="modal"
                                            data-bs-target="#see-all-reactions">

                                            see all reactions
                                        </button>
                                        @include('users.posts.modals.empathy')
                                    </div>

                                        @endif
                                    </div>
                                @else
                                    <div class="row">
                                        <form action="{{ route('empathy.store', $post->id) }}" method="post">
                                            @csrf
                                            {{-- Empathy Slider for non-owners --}}
                                            @if (!($post->user->id === Auth::user()->id))
                                                <div class="form-group">
                                                    <div class="range-slider"> Empathy:&nbsp;
                                                        <input type="range" id="percentage" name="percentage" value="60" min="60" max="100" step="1" list="my-datalist" class="bg-turquoise" oninput="document.getElementById('output2').value=this.value">
                                                        <output id="output2" class="m-2">60</output><span>%</span>
                                                    </div>
                                                </div>
                                            @endif
                                            {{-- Comment for post --}}
                                            <div class="form-group d-flex align-items-center">
                                                <textarea name="comment" id="{{ $post->id }}" rows="1" class="form-control form-control-sm comment-post" placeholder="Add a comment...">{{ old('comment' . $post->id) }}</textarea>
                                                @error('comment')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                                <button type="submit" class="btn btn-gold form-group btn-sm d-flex mx-4">Send</button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @else

            <h3 class="text-secondary text-center">No post yet.</h3>
        @endif
    </div>

    <div class="d-flex justify-content-center mt-2">
        @if($posts instanceof \Illuminate\Pagination\LengthAwarePaginator && $posts->total() > 0)
            {{ $posts->appends(request()->query())->links('pagination::bootstrap-4') }}
        @endif
    </div>
</div>


