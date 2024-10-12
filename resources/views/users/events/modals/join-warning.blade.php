<div class="modal fade" id="join-warning-{{ $event->id }}">
  <div class="modal-dialog">
    <div class="modal-content border-danger">
      <div class="modal-header border-danger">
        <div class="h5 modal-title text-bold mx-auto">
          <i class="fa-solid fa-circle-exclamation"></i> Do you want to JOIN this event?
        </div>
      </div>

      <div class="modal-body mt-3">
        <p class="text-center mb-0">
          Event attendance is limited to community members only. <br>
          <span class="text-danger fw-bold">You must first JOIN the Community</span> in order to participate.
          <br>
          <br>
          <span class="fw-bold">This event belogns to...</span>
          <br>
          <a href="{{ route('communities.show', $event->community->id) }}" class="text-decoration-none text-black">
            <span class="h4 text-center text-turquoise">{{ $event->community->title }}</span>
          </a>
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