<div class="modal fade" id="delete-comment-{{ $comment->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <div class="h5 modal-title text-danger">
                    <i class="fa-solid fa-circle-exclamation"></i> Delete Comment
                </div>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to delete this?</p>
                <div class="mt-3 text-bold">
                    {{ old('body', $comment->body) }}
                </div>
                @if ($comment->image)
                &nbsp;
                <div>
                    <img src="{{ $comment->image }}" alt="comment id {{ $comment->id }}" class="image-lg">
                </div>
                @endif
            </div>

            <div class="modal-footer border-0">
                <form action="{{ route('boardcomment.destroy', $comment->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>