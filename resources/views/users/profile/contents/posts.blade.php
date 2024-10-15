<div class="container-fluid bg-pink p-3">
    <div class="row m-3">
        <h2>{{ Auth::user()->id == $user->id ? 'My post' : "{$user->username}'s post" }}</h2>
    </div>

    <div class="row row-eq-height">
        @if ($posts->isNotEmpty())
            @foreach ($posts as $post)
                <div class="col-sm-3 mb-3">
                    <a href="{{ route('users.posts.show', $post->id) }}" class="text-decoration-none text-black">
                        <div class="card border-0 rounded h-100 d-flex flex-column">
                            <div class="card-body p-0 m-0 flex-grow-1">
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
                                        @if ($post->images->count() > 1)
                                            <div class="d-flex justify-content-center mt-2">
                                                <button class="carousel-control-prev custom-carousel-control" type="button" data-bs-target="#carousel-{{ $post->id }}" data-bs-slide="prev">
                                                    <i class="fa-solid fa-caret-left fs-1 bg-white text-turquoise px-2"></i>
                                                </button>
                                                <button class="carousel-control-next custom-carousel-control" type="button" data-bs-target="#carousel-{{ $post->id }}" data-bs-slide="next">
                                                    <i class="fa-solid fa-caret-right fs-1 bg-white text-turquoise px-2"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                <p class="card-title m-2">
                                    @if(strlen($post->description) > 140)
                                        {{ substr($post->description, 0, 140) }}...
                                        <a href="{{ route('users.posts.show', $post->id) }}" class="text-decoration-none">Read More</a>
                                    @else
                                        {{ $post->description }}
                                    @endif
                                </p>
                            </div>

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
                            </div>

                            <div class="card-footer bg-light p-1 mt-auto">
                                @if (Auth::user()->id == $user->id)
                                    @if ($comments->isNotEmpty())
                                        @php
                                            $latestComment = $comments->where('post_id', $post->id)->sortByDesc('created_at')->first();
                                        @endphp
                                        @if ($latestComment)
                                        <div class="comment-item">
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
                                                    <strong class="d-inline fw-light">{{ $latestComment->comment }}</strong>
                                                    <span class="text-muted small ms-2">{{ date('M d, Y', strtotime($latestComment->created_at)) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                            <p>No comments yet.</p>
                                        @endif
                                    @endif
                                @else
                                    <div class="row">
                                        <form action="{{ route('empathy.store', $post->id) }}" method="post">
                                            @csrf
                                            <div class="form-group ms-2">
                                                <label for="empathy" class="my-2">Empathy:</label>
                                                @php
                                                    $existingComment = $post->comments->where('user_id', Auth::id())->first();
                                                @endphp

                                                <div class="range-slider">
                                                    <input type="range" id="percentage-{{ $post->id }}" name="percentage"
                                                        value="{{ $existingComment ? $existingComment->percentage : 60 }}"
                                                        min="60" max="100" step="1"
                                                        class="bg-turquoise w-50"
                                                        oninput="document.getElementById('output2-{{ $post->id }}').value=this.value">
                                                    <output id="output2-{{ $post->id }}" class="m-2">
                                                        {{ $existingComment ? $existingComment->percentage : 60 }}
                                                    </output><span>%</span>
                                                </div>
                                            </div>

                                            <div class="form-group d-flex align-items-center mx-2">
                                                <div class="col-lg-8">
                                                    <input type="text" name="comment" class="form-control comment-post w-100" placeholder="Add a comment..."
                                                        oninput="checkCommentLength(this)">
                                                </div>
                                                <button type="submit" class="col-lg-4 btn btn-gold form-group btn-sm">
                                                    <span class="text-center">Send</span>
                                                </button>
                                            </div>
                                            <div class="row">
                                                @error('comment')
                                                <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </form>
                                        @if (isset($latestComment))
                                            <div class="text-end" id="reaction-button-{{ $post->id }}">
                                                <button class="shadow-none p-0 border-0 text-turquoise bg-transparent" data-bs-toggle="modal" data-bs-target="#see-all-reactions">
                                                    see all reactions
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h3 class="text-secondary text-center">No post yet.</h3>
        @endif
    </div>
</div>
