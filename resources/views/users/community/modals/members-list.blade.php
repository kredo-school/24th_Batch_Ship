<div class="modal fade" id="community_members{{-- $community->user_id? --}}">
  <div class="modal-dialog">

    {{-- visible part --}}
    <div class="modal-content border border-3 border-turquoise"> 
      <div class="modal-header">
        <div class="container">
          <h6 class="text-center pb-2">Someone who is interested in this community</h6>
          <div class="d-flex justify-content-center">
            <div class="fs-6 pt-1 px-2">sort by</div>
            <div class="mx-0"><button class="btn bg-turquoise text-white py-1 px-5"> interest %</button></div>        
            <p class="pt-1 px-2">or</p>
            <div><button class="btn bg-turquoise text-white py-1 px-3"> date(newest first)</button></div>
            <hr>
         </div>       
       </div> {{-- end of container --}}
     </div>  {{-- end of modal-header --}}

      <div class="modal-body">
         {{-- @foreach ($community as $members)} --}}
          <div class="row mb-1">
            <div class="col-2">
                {{-- @if ($user->interest%? ) --}}
                <p class="text-end" >{{-- $user->interest% --}} %</p>
                {{-- @else --}}                  
                {{-- @endif --}}
            </div>
            <div class="col-2">
              <a href="{{-- route('profile.index', $user->id ) --}}" class="me-auto">
                {{-- @if ($user->avatar) --}}
                    <img src="{{-- $user->avatar --}}" alt="" class="rounded-circle avatar-sm">
                {{-- @else --}}
                  <i class="fa-solid fa-circle-user text-dark icon-sm"></i>
                {{--@endif --}}
              </a>
            </div>
            <div class="col">
              <h6 class="">username</h6>
            </div>
            <div class="col">
              <p class="text-muted fw-light mb-1 ms-auto">{{-- date('M-d--Y', strtotime()) --}} 15-Aug-2024</p>
            </div>

          </div>
               {{-- @endforeach --}}
               {{-- @endif --}}
          <hr class="my-2">
      </div> {{-- end of modal-body --}}

    </div>
  </div>
</div>

