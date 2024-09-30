<body>

    <div class="modal fade" id="see-all-reactions">
        <div class="modal-dialog">
            <div class="modal-content border-turquoise pe-1 modal-with">
                <div class="modal-header text-center border-0 d-block">
                    <p class="mt-4 mb-0">
                        Sort by
                        <button class="btn btn-turquoise mx-2" type="button" id="sort-enpathy">Enpathy %</button>
                        or
                        <button class="btn btn-turquoise mx-2" type="button" id="sort-date">date (newest list)</button>
                    </p>
                </div>
                <hr>
                <div class="modal-body" style="max-height: 400px; overflow-y: scroll;" id="comments-container">
                    @if ($comments->isNotEmpty())
                        @foreach ($comments as $postcomment)
                            <div class="comment-item" data-percentage="{{ $postcomment->percentage }}"
                                data-date="{{ $postcomment->created_at }}">
                                <div class="row align-items-center ">
                                    <div class="col-1 text-start m-2">
                                        @if ($postcomment->user_id !== $post->user_id)
                                            {{ $postcomment->percentage }}<span>%</span>
                                        @endif
                                    </div>
                                    <div class="col-2 text-start">
                                        <a href="{{ route('users.profile.specificProfile', $postcomment->user_id) }}">
                                            <img src="{{ $postcomment->user->avatar ?? 'default-avatar.png' }}"
                                                alt="" class="rounded-circle avatar-sm">
                                        </a>
                                        <a href="{{ route('users.profile.specificProfile', $postcomment->user_id) }}"
                                            class="text-decoration-none text-dark fw-bold mx-2">{{ $postcomment->user->username }}</a>
                                    </div>
                                    <div class="col-5 text-start">
                                        <strong class="d-inline fw-light">{{ $postcomment->comment }}</strong>
                                    </div>

                                    {{-- If you are the owner of the post, or the owner of the comment, you can  delete this comment  --}}
                                    <div class="col-2 text-end">
                                        @if ($post->user->id === Auth::user()->id || $postcomment->user_id === Auth::user()->id)
                                            <form action="{{ route('comment.destroy', $postcomment->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="border-0 bg-transparent text-danger p-0 xsmall">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <span
                                            class="text-uppercase text-muted xsmall text-end">{{ date('M d, Y', strtotime($postcomment->created_at)) }}</span>
                                    </div>
                                </div>

                                <!-- 返信ボタン -->
                                <div class="row mx-3">
                                    <button
                                        class="btn btn-link reply-button text-turquoise text-decoration-none text-start"
                                        data-comment-id="{{ $postcomment->id }}">Reply</button>

                                    <div class="reply-form" id="reply-form-{{ $postcomment->id }}"
                                        style="display:none;">
                                        <form action="{{ route('comment.reply', $postcomment->id) }}" method="post">
                                            @csrf
                                            <textarea name="reply" rows="1" class="form-control form-control-sm " placeholder="Type your reply..." required></textarea>
                                            <button type="submit" class="btn btn-gold mt-2">Send</button>
                                        </form>
                                    </div>
                                </div>

                                <!-- リプライを表示するボタン -->
                                <button
                                    class="btn btn-link show-replies-button text-turquoise text-decoration-none text-start"
                                    data-comment-id="{{ $postcomment->id }}">
                                    Show Replies ({{ $postcomment->replies->count() }})
                                </button>

                                <!-- リプライの表示部分 -->
                                <div class="replies-container" id="replies-container-{{ $postcomment->id }}"
                                    style="display:none;">
                                    @foreach ($postcomment->replies as $reply)
                                        <div class="row reply-item align-items-center my-2 ">
                                            <div class="col-3 text-end ">
                                                <a
                                                    href="{{ route('users.profile.specificProfile', $reply->user_id) }}">
                                                    <img src="{{ $reply->user->avatar ?? 'default-avatar.png' }}"
                                                        alt=""
                                                        class="rounded-circle avatar-sm text-decoration-none">
                                                </a>
                                                <strong>{{ $reply->user->username }}</strong>
                                            </div>
                                            <div class="col-5 text-start">
                                                {{ $reply->content }}
                                            </div>
                                            <div class="col-2 text-end">
                                                @if ($post->user->id === Auth::user()->id || $reply->user_id === Auth::user()->id)
                                                    <form
                                                        action="{{ route('reply.destroy', ['comment_id' => $postcomment->id, 'reply_id' => $reply->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="border-0 bg-transparent text-danger p-0 xsmall">Delete</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>


                                <hr>

                            </div>
                        @endforeach
                    @else
                        <p class="text-center">No comments yet.</p>
                    @endif
                </div>

            </div>


            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    function sortComments(sortType) {
                        const commentsContainer = document.getElementById('comments-container');
                        const comments = Array.from(commentsContainer.querySelectorAll('.comment-item'));

                        const validComments = comments.filter(comment => {
                            const percentage = comment.dataset.percentage;
                            return percentage !== '' && percentage !== null;
                        });

                        validComments.sort((a, b) => {
                            if (sortType === 'percentage') {
                                return parseInt(b.dataset.percentage) - parseInt(a.dataset.percentage);
                            } else if (sortType === 'date') {
                                return new Date(b.dataset.date) - new Date(a.dataset.date);
                            }
                            return 0;
                        });

                        commentsContainer.innerHTML = ''; // コンテナを空にする

                        validComments.forEach((comment) => {
                            commentsContainer.appendChild(comment.cloneNode(true)); // コメントを複製して追加
                        });

                        // 最後に<hr>が残るのを防ぐ
                        if (commentsContainer.lastChild && commentsContainer.lastChild.tagName === 'HR') {
                            commentsContainer.removeChild(commentsContainer.lastChild);
                        }

                        // ここでイベントリスナーを再設定
                        attachReplyButtons();
                        attachShowRepliesButtons();
                    }

                    document.getElementById('sort-enpathy').addEventListener('click', function() {
                        sortComments('percentage');
                    });

                    document.getElementById('sort-date').addEventListener('click', function() {
                        sortComments('date');
                    });

                    function attachReplyButtons() {
                        const replyButtons = document.querySelectorAll('.reply-button');
                        replyButtons.forEach(button => {
                            button.removeEventListener('click', toggleReplyForm); // 既存のリスナーを削除
                            button.addEventListener('click', toggleReplyForm);
                        });
                    }

                    function toggleReplyForm() {
                        const commentId = this.getAttribute('data-comment-id');
                        const replyForm = document.getElementById(`reply-form-${commentId}`);
                        replyForm.style.display = replyForm.style.display === 'none' || replyForm.style.display === '' ?
                            'block' : 'none';
                    }

                    function attachShowRepliesButtons() {
                        const showReplyButtons = document.querySelectorAll('.show-replies-button');
                        showReplyButtons.forEach(button => {
                            button.removeEventListener('click', toggleReplies); // 既存のリスナーを削除
                            button.addEventListener('click', toggleReplies);
                        });
                    }

                    function toggleReplies() {
                        const commentId = this.getAttribute('data-comment-id');
                        const repliesContainer = document.getElementById(`replies-container-${commentId}`);
                        if (repliesContainer.style.display === 'none' || repliesContainer.style.display === '') {
                            repliesContainer.style.display = 'block';
                            this.textContent = 'Hide Replies'; // ボタンのテキストを更新
                        } else {
                            repliesContainer.style.display = 'none';
                            this.textContent = `Show Replies (${repliesContainer.children.length})`; // ボタンのテキストを更新
                        }
                    }

                    // 初期設定
                    attachReplyButtons();
                    attachShowRepliesButtons();
                });
            </script>


</body>
