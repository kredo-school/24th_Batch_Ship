<div class="modal fade" id="join-warning-{{ $event->id }}">
  <div class="modal-dialog">
    <div class="modal-content border-danger">
      <div class="modal-header border-danger">
        <div class="h5 modal-title text-bold mx-auto">
          <i class="fa-solid fa-circle-exclamation"></i> Do you want to JOIN this event?
        </div>
      </div>

      <div class="modal-body mt-3">
        <p class="text-center">
          Event attendance is limited to community members only. <br>
          <span class="text-danger fw-bold">You must first join the community</span> in order to participate.
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