<div class="modal fade" id="community-members-{{ $community->id }}">
  <div class="modal-dialog">

    {{-- visible part --}}
    <div class="modal-content border border-3 border-turquoise"> 
      <div class="modal-header text-center border-0 d-block pb-0">
        <div class="container">
          <h6 class="text-center pb-2">Someone who is interested in this community</h6>
          <div class="d-flex justify-content-center align-items-center mt-3">
            <p class="mx-2 px-2 mb-0">sort by</p>
            <button class="btn btn-turquoise"> interest %</button>
            <p class="mx-2 px-2 mb-0">or</p>
            <button class="btn btn-turquoise"> date(newest first)</button>
          </div> 
        </div> {{-- end of container --}}
      </div>  {{-- end of modal-header --}}

      <div class="modal-body border-0 my-1 pt-0" style="max-height: 400px; overflow-y: auto;">
        @foreach ($all_members as $member)
          <hr>
          <div class="row mb-1">
            <div class="col-2">
              @foreach ($all_interestsrate as $interest)
                @if ($member->user_id == $interest->user_id)
                  <p class="text-end" >{{ $interest->percentage }} %</p>
                @endif
              @endforeach
            </div>
            <div class="col-2 d-flex align-items-center">
              <a href="{{ route('users.profile.specificProfile', $member->user_id) }}" class="me-3">
                @if ($member->user->avatar)
                  <img src="{{ $member->user->avatar }}" alt="{{ $member->user->username }}" class="rounded-circle avatar-sm">
                @else
                  <i class="fa-solid fa-circle-user text-dark icon-sm"></i>
                @endif
              </a>
              <a href="{{ route('users.profile.specificProfile', $member->user_id) }}" class="text-decoration-none text-black ms-0">
                <h6 class="">{{ $member->user->username }}</h6>
              </a>
            </div>
            <div class="col">
              <p class="text-muted fw-light mb-1 ms-auto">{{ date('M d, Y', strtotime($member->created_at)) }}</p>
            </div>
          </div>
        @endforeach
        <hr class="my-2">
      </div> {{-- end of modal-body --}}

    </div>
  </div>
</div>

