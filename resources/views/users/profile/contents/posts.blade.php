<div class="d-flex justify-content-between align-items-center mx-3 mt-4">
    <h2>My Post</h2>
    <h4><a href="#" class="text-end">See more</a></h4>
</div>

<div class="bg-pink mx-2">
    {{-- @if ($user->posts->isNotEmpty())
        <div class="row"> --}}
            {{-- @foreach 4 posts --}}
            {{-- @foreach ($user->posts as $post)
                <div class="col-3">
                    <div class="container bg-white m-3">
                        <div class="row">
                            <div class="col-5 d-flex justify-content-center mt-2">
                                <p class="mb-0">{{ $post->description }}</p>
                            </div>
                            <div class="col-7 d-flex justify-content-center mt-2">
                                <img src="{{ $post->image }}" alt="Post ID" class="d-block w-100" style="height: auto;">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col d-flex align-items-center"> --}}
                                {{-- @foreach selected categories --}}
                                {{-- @forelse ($post->categoryPost as $category_post)
                                    <div class="badge bg-turquoise me-1">
                                        {{ $category_post->category->name }}
                                    </div>
                                @empty
                                    <div class="badge bg-turquoise me-1">Uncategorized</div>
                                @endforelse
                            </div>
                        </div>
            
                        <div class="row text-end">
                            <a href="#" class="text-decoration-none">see all reactions</a>
                        </div>
                        <hr>
                        <div class="row mb-2"> --}}
                            {{-- @foreach 2 reactions --}}
                            {{-- <div class="col-5 d-flex align-items-center">
                                <p class="mb-0 me-2">93%</p>
                                <a href="#" class="me-1 d-flex align-items-center text-decoration-none text-black">
                                    <i class="fa-solid fa-circle-user icon-sm"></i>
                                    <span class="fw-bold mx-1">Tim Simpson</span>
                                </a>
                            </div>
                            <div class="col-7 d-flex align-items-center">
                                <p class="mb-0 me-1">How Cute!</p>
                                <p class="mb-0 text-muted ms-auto xsmall">Aug.18.2024</p>
                            </div>   
                            <div class="col-5 d-flex align-items-center">
                                <p class="mb-0 me-2">99%</p>
                                <a href="#" class="me-1 d-flex align-items-center text-decoration-none text-black">
                                    <i class="fa-solid fa-circle-user icon-sm"></i>
                                    <span class="fw-bold mx-1">Keiko Watanabe</span>
                                </a>
                            </div>
                            <div class="col-7 d-flex align-items-center">
                                <p class="mb-0 me-1">I love your cat!</p>
                                <p class="mb-0 text-muted ms-auto xsmall">Aug.18.2024</p>
                            </div>   
                        </div>     
                    </div>
                </div>
            @endforeach
        </div>
    @else --}}
        <h3 class="text-secondary text-center">No Posts Yet</h3>
    {{-- @endif --}}
</div>