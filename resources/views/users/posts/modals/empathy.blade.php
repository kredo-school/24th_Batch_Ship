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
                        <div class="comment-item" data-percentage="{{ $postcomment->percentage }}" data-date="{{ $postcomment->created_at }}">
                            <div class="row align-items-center">
                                <div class="col-1 text-start">
                                    @if ($postcomment->user_id !== $post->user_id)
                                        {{ $postcomment->percentage }}<span>%</span>
                                    @endif
                                </div>
                                <div class="col-2 text-start">
                                    @if ($postcomment->user->avatar)
                                        <a href="{{ route('users.profile.specificProfile', $postcomment->user_id) }}">
                                            <img src="{{ $postcomment->user->avatar }}" alt="" class="rounded-circle avatar-sm">
                                        </a>
                                    @else
                                        <a href="{{ route('users.profile.specificProfile', $postcomment->user_id) }}">
                                            <i class="fas fa-circle-user text-secondary icon-sm"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('users.profile.specificProfile', $postcomment->user_id) }}" class="text-decoration-none text-dark fw-bold mx-2">{{ $postcomment->user->username }}</a>
                                </div>
                                <div class="col-6 text-start">
                                    <p class="d-inline fw-light">{{ $postcomment->comment }}</p>
                                </div>
                                <div class="col-1 text-end">
                                    @if (Auth::user()->id === $postcomment->user_id)
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
                        </div>
                        <hr>
                    @endforeach
                @else
                    <p class="text-center">No comments yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>


<script src="your-script.js" defer></script>
<script>
 document.addEventListener('DOMContentLoaded', function() {
    function sortComments(sortType) {
        const commentsContainer = document.getElementById('comments-container');
        const comments = Array.from(commentsContainer.querySelectorAll('.comment-item'));

        // 空のpercentageを持つコメントを除外
        const validComments = comments.filter(comment => {
            const percentage = comment.dataset.percentage;
            return percentage !== '' && percentage !== null; // nullまたは空のものを除外
        });

        console.log('Before sorting:', validComments.map(comment => ({
            percentage: comment.dataset.percentage,
            date: comment.dataset.date
        })));

        validComments.sort((a, b) => {
            if (sortType === 'percentage') {
                return parseInt(b.dataset.percentage) - parseInt(a.dataset.percentage);
            } else if (sortType === 'date') {
                return new Date(b.dataset.date) - new Date(a.dataset.date);
            }
            return 0;
        });

        console.log('After sorting:', validComments.map(comment => ({
            percentage: comment.dataset.percentage,
            date: comment.dataset.date
        })));

        commentsContainer.innerHTML = ''; // コンテナを空にする

        validComments.forEach(comment => {
            commentsContainer.appendChild(comment.cloneNode(true)); // コメントを複製して追加
            const hr = document.createElement('hr');
            commentsContainer.appendChild(hr);
        });

        // 元のコメントを再追加する
        comments.forEach(comment => {
            if (!validComments.includes(comment)) {
                commentsContainer.appendChild(comment.cloneNode(true));
                const hr = document.createElement('hr');
                commentsContainer.appendChild(hr);
            }
        });
    }

    document.getElementById('sort-enpathy').addEventListener('click', function() {
        console.log('Enpathy % button clicked');
        sortComments('percentage');
    });

    document.getElementById('sort-date').addEventListener('click', function() {
        console.log('Date button clicked');
        sortComments('date');
    });
});

</script>
</body>
