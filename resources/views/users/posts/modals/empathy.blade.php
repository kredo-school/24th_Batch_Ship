<body>

    <div class="modal fade" id="see-all-reactions">
        <div class="modal-dialog">
            <div class="modal-content border-turquoise pe-1 modal-with">
                <div class="modal-header text-center border-0 d-block">
                    <p class="mt-4 mb-0">
                        Sort by
                        <button class="btn btn-turquoise mx-2" type="button" id="sort-empathy">Empathy %</button>
                        or
                        <button class="btn btn-turquoise mx-2" type="button" id="sort-date">date (newest list)</button>
                    </p>
                </div>
                <hr>
                <div class="modal-body" style="max-height: 400px; overflow-y: scroll;" id="comments-container">
                    @foreach ($comments as $postcomment)
                        <div class="comment-item" data-percentage="{{ $postcomment->percentage }}" data-date="{{ $postcomment->created_at }}">
                            <div class="row align-items-center ">
                                <div class="col-1 text-start m-2">
                                    @if ($postcomment->user_id !== $post->user_id)
                                        {{ $postcomment->percentage }}<span>%</span>
                                    @endif
                                </div>
                                <div class="col-2 text-start">
                                    <a class="text-decoration-none" href="{{ route('users.profile.specificProfile', $postcomment->user_id) }}">
                                        @if ($postcomment->user->avatar)
                                            <img src="{{ $postcomment->user->avatar }}" alt="{{ $postcomment->user->name }}" class=" rounded-circle avatar-sm no-underline">
                                        @else
                                            <i class="fa-solid fa-circle-user text-secondary text-center icon-sm no-underline"></i>
                                        @endif
                                    </a>
                                    <a href="{{ route('users.profile.specificProfile', $postcomment->user_id) }}" class="text-decoration-none text-dark fw-bold mx-2">{{ $postcomment->user->username }}</a>
                                </div>
                                <div class="col-5 text-start">
                                    <strong class="d-inline fw-light">{{ $postcomment->comment }}</strong>
                                </div>
                                <div class="col-2 text-end">
                                    @if ($post->user->id === Auth::user()->id || $postcomment->user_id === Auth::user()->id)
                                        <form action="{{ route('comment.destroy', $postcomment->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 bg-transparent text-danger p-0 xsmall">Delete</button>
                                        </form>
                                    @endif
                                </div>
                                <div class="col">
                                    <span class="text-uppercase text-muted xsmall text-end">{{ date('M d, Y', strtotime($postcomment->created_at)) }}</span>
                                </div>
                            </div>

                            <!-- 返信ボタン -->
                            <div class="row mx-3">
                                <button class="btn btn-link reply-button text-turquoise text-decoration-none text-start" data-comment-id="{{ $postcomment->id }}">Reply</button>

                                <div class="reply-form" id="reply-form-{{ $postcomment->id }}" style="display:none;" data-comment-id="{{ $postcomment->id }}">
                                    <form action="{{ route('reply.store', $postcomment->id) }}" method="post">
                                        @csrf
                                        <textarea name="reply" rows="1" class="form-control form-control-sm" placeholder="Type your reply..." required></textarea>
                                        <button type="submit" class="btn btn-gold mt-2">Send</button>
                                    </form>
                                </div>
                            </div>

                            <!-- リプライを表示するボタン -->
                            <button class="btn btn-link show-replies-button text-turquoise text-decoration-none text-start" data-comment-id="{{ $postcomment->id }}">
                                Show Replies ({{ $postcomment->replies->count() }})
                            </button>

                            <!-- リプライの表示部分 -->
                            <div class="replies-container" id="replies-container-{{ $postcomment->id }}" style="display:none;">
                                @foreach ($postcomment->replies as $reply)
                                    <div class="row reply-item align-items-center my-2 ">
                                        <div class="col-3 text-end">
                                            <a class="text-decoration-none" href="{{ route('users.profile.specificProfile', $reply->user_id) }}">
                                                @if ($reply->user->avatar)
                                                <img src="{{ $reply->user->avatar }}" alt="{{ $reply->user->name }}" class="rounded-circle avatar-sm no-underline">
                                            @else
                                                <i class="fa-solid fa-circle-user text-secondary  text-center icon-sm no-underline"></i>
                                            @endif

                                            </a>
                                            <strong>{{ $reply->user->username }}</strong>
                                        </div>
                                        <div class="col-5 text-start">
                                            {{ $reply->content }}
                                        </div>
                                        <div class="col-2 text-end">
                                            @if ($post->user->id === Auth::user()->id || $reply->user_id === Auth::user()->id)
                                                <form action="{{ route('reply.destroy', $reply->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="border-0 bg-transparent text-danger p-0 xsmall">Delete</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <hr>

                        </div>
                    @endforeach
                </div>
            </div>





</body>

