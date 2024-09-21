<div class="modal fade" id="unjoin-warning-{{ $community->id }}">
  <div class="modal-dialog">
    <div class="modal-content border-danger">
      <div class="modal-header border-danger">
        <div class="h5 modal-title text-bold mx-auto">
          <i class="fa-solid fa-circle-exclamation"></i> Do you want to UNJOIN this community?
        </div>
      </div>

      <div class="modal-body mt-3">
        <p class="text-center">
          As the host of upcoming events in this community, <br>
          <span class="text-danger fw-bold">you need to delete all scheduled events within this community</span><br> 
          before you can unjoin.
        </p>
      </div>

      <div class="modal-footer border-0">
        <div class="row text-center">   
          <div class="col">
            <button type="button" class="btn btn-sm" data-bs-dismiss="modal">
              <i class="fa-regular fa-rectangle-xmark"></i> Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>