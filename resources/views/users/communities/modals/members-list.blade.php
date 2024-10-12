<div class="modal fade" id="community-members-{{ $community->id }}">
  <div class="modal-dialog">

    {{-- visible part --}}
    <div class="modal-content border border-3 border-turquoise"> 
      <div class="modal-header text-center border-0 d-block pb-0">
        <div class="container">
          <h6 class="text-center pb-2 mt-3">Someone who is interested in this community</h6>
          <button type="button" class="btn btn-sm position-absolute top-0 end-0" data-bs-dismiss="modal">
            <i class="fa-regular fa-rectangle-xmark"></i> Close
          </button>

          <div class="d-flex justify-content-center align-items-center mt-3">
            <form id="sortForm" action="{{ route('interest.sort', $community->id) }}" method="GET">
              <p class="text-center">
                Sort by
                <button class="btn btn-turquoise mx-2" type="button" onclick="setSortValue('interest_rate')">
                  Interest&nbsp; %
                </button>
                <input type="hidden" name="sort" id="sortValue" value=""> 
                or
                <button class="btn btn-turquoise mx-2" type="button" onclick="setSortValue('created_at')">
                  Date (newest list)
                </button>
              </p>
            </form>
          </div> 
        </div> {{-- end of container --}}
      </div>  {{-- end of modal-header --}}

      <div class="modal-body border-0 my-1 pt-0" style="max-height: 400px; overflow-y: scroll;" id="members-container">
        @foreach ($all_members as $member)
          <hr>
          <div class="row mb-1">
            <div class="col-3">
              @foreach ($all_interestsrate as $interest)
                @if ($member->user_id == $interest->user_id)
                  <p class="text-center" >{{ $interest->percentage }} %</p>
                @endif
              @endforeach
            </div>
            <div class="col-3 d-flex align-items-center">
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
            <div class="col text-center ms-1">
                <p class="text-muted fw-light"> joined: {{ date('M d, Y', strtotime($member->created_at)) }}</p>
            </div>
            <div class="col-1 text-end">
              @foreach ($all_interestsrate as $interest)
                @if ($member->user->id === Auth::user()->id && $member->user_id == $interest->user_id)
                  <form action="{{ route('interest.destroy', $interest->id)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="border-0 bg-transparent text-danger p-0 xsmall" title="Delete interest(%)"><i class="fa-regular fa-trash-can"></i></button>
                  </form>
                @endif
              @endforeach
            </div>
          </div>
        @endforeach
        <hr class="my-2">
      </div> {{-- end of modal-body --}}

    </div>
  </div>
</div>


