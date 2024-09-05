<div class="modal fade" id="delete-event">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <div class="h5 modal-title text-bold mx-auto">
                  <i class="fa-solid fa-circle-exclamation"></i> Are you sure?
                </div>
            </div>

            <div class="modal-body mt-3">
              <p>you want to delete this event?</p>
            </div>

            <div class="modal-footer border-0">
                <form action="#" method="post" class="w-100">
                    @csrf
                    @method('DELETE')

                    <div class="row text-center">   
                        <div class="col">
                            <button type="button" class="btn text-danger btn-sm w-75" data-bs-dismiss="modal">
                              Cancel
                            </button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-danger btn-sm w-75">
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