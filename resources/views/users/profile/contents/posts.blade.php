<div class="container-fluid bg-pink p-3">
    <div class="row m-3">
        @if (Auth::user()->id == $user->id)
            <h2>My post</h2>
        @else
            <h2>{{ $user->username }}'s post</h2>
        @endif
    </div>

    <div class="row row-eq-height">
        @if ($user->posts->isNotEmpty())
            {{-- loop through posts --}}
            @foreach ($user->posts as $post)
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
                                        <p class="h6 xsmall d-inline">93%</p>
                                        <a href="#" class="text-decoration-none text-secondary xsmall d-inline">
                                            <i class="fa-solid fa-circle-user icon-sm"></i>
                                        </a>
                                        <a href="#" class="text-decoration-none text-dark xsmall d-inline">Tim Simpson</a>
                                        <p class="h6 xsmall d-inline">How Cute!</p>
                                        <p class="mb-0 text-muted ms-auto xsmall d-inline">Aug.18.2024</p>
                                    </div>
                                    <a href="#" class="text-decoration-none float-end">see all reactions</a>
                                @else
                                    <form action="#" method="post" class="">
                                        @csrf
                                        <div class="row">
                                            <div class="col input-group input-group-sm">
                                                <input type="number" name="empathy" id="empathy" class="form-control" placeholder="empathy" aria-label="empathy">
                                                <span class="input-group-text" id="percentage">%</span>
                                            </div>
                                            <div class="col-6">
                                                <input type="text" name="comment" id="comment" class="form-control form-control-sm" placeholder="comment...">
                                            </div>
                                            <div class="col-2 me-2">
                                                <button type="submit" class="btn btn-sm btn-gold">Send</button>
                                            </div>
                                        </div>
                                    </form>
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

    {{-- {{ $user->posts->links() }} --}}
</div>
