<div class="modal fade" id="inquiry-message-{{ $inquiry->id }}">
  <div class="modal-dialog">
    <div class="modal-content border-warning">
      <div class="modal-header border-warning">
        {{-- Inquiry Subject --}}
        <div class="h5 modal-title text-bold mx-auto">
          <i class="fa-solid fa-person-circle-question"></i> {{ $inquiry->subject }}
        </div>
      </div>

      {{-- Inquiry Message --}}
      <div class="modal-body mt-3">
        <p class="text-center">{{ $inquiry->message }}</p>
      </div>

      {{-- Status control --}}
      <div class="modal-footer border-0">
        <button type="button" class="btn" data-bs-dismiss="modal">
          <i class="fa-regular fa-rectangle-xmark"></i> Cancel
        </button>
        @if ($inquiry->trashed())
          {{-- To Pending --}}
          <form action="{{ route('admin.support.pending', $inquiry->id) }}" method="post">
            @csrf
            @method('PATCH')

            <button type="submit" class="btn btn-gold">
              <i class="fa-solid fa-check text-turquoise"></i>&nbsp; Return to Pending
            </button>
          </form>
        @else
          {{-- To Completed --}}
          <form action="{{ route('admin.support.completed', $inquiry->id) }}" method="post">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-gold">
              <i class="fa-regular fa-circle-check text-turquoise"></i>&nbsp; Mark as Completed
            </button>
          </form>
        @endif    
      </div>
    </div>
  </div>
</div>