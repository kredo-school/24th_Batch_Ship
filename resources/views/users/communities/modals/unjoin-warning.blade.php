<div class="modal fade" id="unjoin-warning-{{ $community->id }}">
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
        <div class="row text-center">   
          <div class="col">
            <button type="button" class="btn text-danger btn-sm w-75" data-bs-dismiss="modal">
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>