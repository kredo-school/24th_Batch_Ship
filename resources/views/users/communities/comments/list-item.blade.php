<div class="container-">
  @if ($community->comments->isNotEmpty())
      @foreach ($community->comments as $comment)
          <div class="row mb-4">
            {{-- avatar & name  --}}
            <div class="col-1 d-flex flex-column align-items-center">
              <div class="mb-2 mx-auto p-0">
                <a href="{{ route('users.profile.specificProfile', $comment->user->id ) }}" class="text-decoration-none text-dark">
                    <span class="d-flex align-items-center">
                        @if ($comment->user->avatar)
                          <img src="{{ $comment->user->avatar }}" alt="{{ $comment->user->username }}" class="rounded-circle avatar-md border border-gray"> 
                        @else
                          <i class="fa-solid fa-circle-user icon-md"></i>   
                        @endif    
                    </span>
                </a>
              </div>
            </div>

            <div class="col-8 ps-5 mt-2">
              <div class="row">
                  <a class="text-decoration-none text-dark" href="{{ route('users.profile.specificProfile', $comment->user->id ) }}"><h6 class="">{{ $comment->user->username }}</h6></a>
              </div>
              <div class="row">
                <div class="small fw-light lh-sm community-comment">
                  {{ $comment->body }}
                </div>
              </div>
              <div class="row mt-2">
                @if (!empty($comment->image))
                  <img src="{{ $comment->image }}" class="img-boardcomment" alt="">
                @endif
              </div>
            </div>

            <div class="col-3 p-0 text-center my-auto">
                <div class="xsmall pt-1">
                  {{-- created date --}}
                  <p class="text-muted fw-light mb-1">{{ date('M-d-Y', strtotime($comment->created_at)) }}  {{ date('H:i', strtotime($comment->created_at)) }}</p> 
                  @if ($comment->user_id == Auth::user()->id)
                    &nbsp;

                      {{-- delete button  --}}
                      <button type="submit" class="bg-white border border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#delete-comment-{{ $comment->id }}">
                        <i class="fa-regular fa-trash-can"></i>
                      </button>
                      @include('users.communities.modals.delete')

                      {{-- edit button --}} 
                      @if ($comment->body)
                        <button class="bg-white border border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#edit-comment-{{ $comment->id }}">
                          <i class="fa-regular fa-pen-to-square text-dark"></i>
                        </button>
                        @include('users.communities.modals.edit')
                      @endif                 
                  @endif
                </div>
            </div>  
          </div>
      @endforeach 
  @endif
  
</div>
<hr class="my-2">
