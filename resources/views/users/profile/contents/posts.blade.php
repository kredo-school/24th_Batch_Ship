<div class="row mt-5">
    <h2>My Post</h2>
</div>

<div class="row row-eq-height bg-pink">
    @if ($user->posts->isNotEmpty())
        {{-- loop 4 posts --}}
        @foreach ($user->posts as $post)
            <div class="col-sm-3 mb-3 mb-sm-0">
                <a href="{{ route('users.posts.show', $post->id )}}" class="text-decoration-none text-black">
                    <div class="card border-0 rounded m-3">
                        <div class="card-body m-3">
                            <p class="card-title">{{ $post->description }}</p>
                            <img src="{{ $post->image }}" alt="Post ID" class="card-text d-block w-25 h-25 mt-2">
                            {{-- loop selected categories --}}
                            @forelse ($post->categoryPost as $category_post)
                                <a href="#" class="badge bg-turquoise text-decoration-none me-1 mt-2">
                                    {{ $category_post->category->name }}
                                </a>
                            @empty
                                <a href="#" class="badge bg-turquoise mt-1">Uncategorized</div>
                            @endforelse
                        </div>
                
                        <div class="card-footer bg-light">
                            @if (Auth::user()->id == $user->id)
                                {{-- loop 2 reactions --}}
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
                                            <input type="number" cname="empathy" id="empathy" class="form-control" placeholder="empathy" aria-label="empathy">
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
        <h3 class="text-secondary text-center">No Posts Yet</h3>
    @endif
</div>
