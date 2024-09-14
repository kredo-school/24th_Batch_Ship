<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content border-red">
            <div class="modal-header border-danger">
                <div class="h5 modal-title text-dark text-bold mx-auto">
                    <i class="fa-solid fa-circle-exclamation"></i> Are you sure?
                </div>
            </div>

            <div class="modal-body text-dark mt-3">
                <p>you want to delete this post?</p>
            </div>

            <div class="modal-footer border-0">
                <form action="{{ route('users.posts.destroy', $post->id) }}" method="post" class="w-100">
                    @csrf
                    @method('DELETE')

                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-gold-cancel w-75 btn-sm" data-bs-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-gold-delete border border-gray bg-yellow post-delete w-75 btn-sm">
                                    <i class="fa-regular fa-trash-can fw-bold me-2"></i>
                                    Delete
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
