<div class="modal fade" id="attendees{{-- $user_id? --}}">
  <div class="modal-dialog">

    {{-- visible part --}}
    <div class="modal-content border border-3 border-turquoise"> 
      <div class="modal-header border-0 my-1">
        <div class="container">
          <h6 class="text-center pb-2">All attendees</h6>
          <div class="row text-start">
            <div class="col-1">
              <div class="col-2">
                <a href="{{-- route('profile.index', $user->id ) --}}" class="me-auto">
                  {{-- @if ($user->avatar) --}}
                      <img src="{{-- $user->avatar --}}" alt="" class="rounded-circle avatar-sm">
                  {{-- @else --}}
                    <i class="fa-solid fa-circle-user text-dark icon-sm"></i>
                  {{--@endif --}}
                </a>
              </div>
            </div>
            <div class="col-auto">
              <p class="badge bg-gold text-white py-1 m-0">Host</p>
              <h6 class="underline">Event host name</h6>
            </div>
            <hr>
         </div>       
       </div> 
     </div>  {{-- end of modal-header --}}

      <div class="modal-body border-0 my-1">
         {{-- @foreach  --}}
          <div class="row mb-1">
            <div class="col-2 p-0 text-center">
                <a href="{{-- route('profile.index', $user->id ) --}}" class="me-auto">
                  {{-- @if ($user->avatar) --}}
                      <img src="{{-- $user->avatar --}}" alt="" class="rounded-circle avatar-sm">
                  {{-- @else --}}
                    <i class="fa-solid fa-circle-user text-dark icon-sm"></i>
                  {{--@endif --}}
                </a>
            </div>
            <div class="col-6 text-start">
              <h6>Attendee 1</h6>
            </div>
            <div class="col-2">
              <i class="fa-solid fa-face-grin-wide text-turquoise fs-2"></i>
            </div>
            <div class="col-2 text-start fw-bold">
              {{-- @if ($user->review%? ) --}}
              <p>{{-- $user->interest% --}} %</p>
                {{-- @else --}}                  
                {{-- @endif --}}
            </div>
          </div>
               {{-- @endforeach --}}
               {{-- @endif --}}
          <hr class="my-2">
      </div> {{-- end of modal-body --}}

    </div>
  </div>
</div>

