<div class="container">
  @if ($community->comments->isNotEmpty())
      @foreach ($community->comments as $comment)
        <div class="row mb-4">
            {{-- avatar & name  --}}
            <div class="col-1 d-flex flex-column">
              <div class="d-flex align-items-center mx-auto">
                <a href="{{ route('users.profile.specificProfile', $comment->user->id ) }}" class="text-decoration-none text-dark d-flex align-items-center">
                    <span class="d-flex align-items-center">
                        @if ($comment->user->avatar)
                          <img src="{{ $comment->user->avatar }}" alt="{{ $comment->user->username }}" class="rounded-circle avatar-md border border-gray"> 
                        @else
                          <i class="fa-solid fa-circle-user icon-sm"></i>   
                        @endif    
                    </span>
                </a>
              </div>
            </div>

            {{-- <div class="col-1 m-0 p-0"></div> --}}

            <div class="col-8 mt-2">
              <div class="row">
                <a class="text-decoration-none text-dark" href="{{ route('users.profile.specificProfile', $comment->user->id ) }}"><h6 class="">{{ $comment->user->username }}</h6></a>
              </div>
              <div class="row">
                <div class="small fw-light lh-sm community-comment">
                  {{ $comment->body }}
                </div>
              </div>
              <div class="row mt-2">
                @if ($comment->image)
                  <img src="{{ $comment->image }}" class="w-25 h-50 object-fit-cover border border-gray" alt="">
                @endif
              </div>
            </div>

            <div class="col-2 p-0 text-center my-auto mx-0">
              <form action="{{ route('boardcomment.destroy', $comment->id) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="xsmall pt-1">
                  {{-- created date --}}
                  <p class="text-muted fw-light mb-1">{{ date('M d, Y', strtotime($comment->created_at)) }}{{ date('H:i', strtotime($comment->created_at)) }}</p> 
                  @if ($comment->user_id == Auth::user()->id)
                  &nbsp;

                    {{-- edit button
                      <button class="bg-white border border-0 bg-transparent">
                        <i class="fa-regular fa-pen-to-square text-dark"></i>
                      </button> --}}

                    {{-- delete button  --}}
                      <button type="submit" class="bg-white border border-0 bg-transparent">
                        <i class="fa-regular fa-trash-can"></i>
                      </button>
                  @endif
                </div>
              </form>
            </div>  
        </div>
      @endforeach 
  @endif
  
</div>
<hr class="my-2">
