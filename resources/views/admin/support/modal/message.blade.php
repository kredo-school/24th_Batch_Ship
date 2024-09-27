<div class="modal fade" id="inquiry-message-{{ $inquiry->id }}">
  <div class="modal-dialog">
    <div class="modal-content border-warning">
      <div class="modal-header border-warning">
        <div class="h5 modal-title text-bold mx-auto">
          <i class="fa-solid fa-person-circle-question"></i> {{ $inquiry->subject }}
        </div>
      </div>

      <div class="modal-body mt-3">
        <p class="text-center">{{ $inquiry->message }}</p>
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