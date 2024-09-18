<div class="container">
  @if ($community->comments->isNotEmpty())
    <ul class="list-group">
      @foreach ($community->comments as $comment)
        <div class="row">
              {{-- avatar & name  --}}
            <div class="col d-flex flex-column p-0">
                <div class="d-flex align-items-center mb-2">
                  <a href="{{-- route('profile.show', $comment->user_id) --}}" class="text-decoration-none text-dark d-flex align-items-center">
                      <span class="d-flex align-items-center">
                        <a href="{{-- {{ route('users.profile.specificProfile', $comment->owner_id) }} --}}">
                          @if ($comment->user->avatar)
                            <img src="{{ $comment->user->avatar }}" alt="{{ $comment->user->username }}" class="rounded-circle avatar-sm"> 
                          @else
                            <i class="fa-solid fa-circle-user icon-sm"></i>   
                          @endif    
                        </a>  
                          <h6 class="mb-0 ms-2">{{ $comment->user->name }}</h6>
                      </span>
                  </a>
                </div>
          </div>
      
          {{-- comment --}}    
          <div class="row">
          <div class="col-10 ms-4">
            <p class="small fw-light lh-sm">
              {{ $comment->body }}
            </p>
              {{-- {{ $comment->image }} --}}
              @if ($comment->image)
                <img src="{{ $comment->image }}" class="w-25 h-50 object-fit-cover" alt="">
              @endif
          </div>
        
      
            {{-- created date --}}
            <div class="col p-0 text-center my-auto">
              <form action="{{ route('boardcomment.destroy', $comment->id) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="xsmall pt-1">
                  <p class="text-muted fw-light mb-1">{{ date('M d, Y', strtotime($comment->created_at)) }}<br>{{ date('H:i', strtotime($comment->created_at)) }}</p> 
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
    </ul>    
  @endif
  
</div>
<hr class="my-2">
