<div class="modal fade" id="edit-comment-{{ $comment->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-success">
            <div class="modal-header border-success">
                <div class="h5 modal-title text-success">
                    <i class="fa-regular fa-pen-to-square"></i> Edit Comment
                </div>
            </div>

            <form action="{{ route('boardcomment.update', $comment->id) }}" method="post" class="w-100" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="modal-body">
                    <p class="text-center fw-bold mb-1">
                        Would you like to edit your comment?
                    </p>
                    <textarea name="body" id="body" cols="57" rows="5" class="border-0 p-2">{{ old('body', $comment->body) }}</textarea>
                      @error('body')
                      <p class="mb-0 text-danger samll">{{ $message }}</p>
                      @enderror
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-success btn-sm">
                        Save     
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>