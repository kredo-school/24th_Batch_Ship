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
          {{-- Change message based on user status --}}
          @if ($community->activeEventHost())
            {{-- For event host --}}
            As the host of scheduled events in this community, <br>
            <span class="text-danger fw-bold">you need to Delete all scheduled Events within this community</span><br> 
            before you can unjoin. 
          @else
            {{-- For event attendee --}}
            As an attendee of scheduled events in this community, <br>
            <span class="text-danger fw-bold">you need to UNJOIN from all scheduled Events within this community</span> before you can unjoin.  
          @endif
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