<div class="container-fluid">
  <div class="row">
       {{-- avatar & name  --}}
      <div class="col d-flex flex-column p-0">
          <div class="d-flex align-items-center mb-2">
            <a href="{{-- route('profile.show', $community->user_id) --}}" class="text-decoration-none text-dark d-flex align-items-center">
                <span class="d-flex align-items-center">
                    <i class="fa-solid fa-circle-user icon-sm"></i>
                    <h6 class="mb-0 ms-2">username</h6>{{-- {{ $communities?->user->name }} ??--}}
                </span>
            </a>
         </div>
    </div>

    {{-- comment --}}    
    <div class="row">
    <div class="col-10 ms-4">
      <p class="small fw-light lh-sm">
        {{-- {{ $comment->body }} --}}
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti soluta vel placeat accusantium facilis, eligendi inventore dolores, sit veritatis saepe accusamus modi distinctio minus iste unde enim perspiciatis nobis autem.
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Suscipit, asperiores.
      </p>
        {{-- {{ $comment->image }}  --}}
      <img src="https://images.pexels.com/photos/1270210/pexels-photo-1270210.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="w-25 h-50 object-fit-cover" alt="">      
    </div>
  

      {{-- created date --}}
      <div class="col p-0 text-center my-auto">
          <div class="xsmall pt-1">
            <p class="text-muted fw-light mb-1">{{-- date('H:i:s M-d--Y', strtotime()) --}} 00:00:00 <br> 15-Aug-2024</p>
            {{-- @if ()$post->user_id == Auth::user()->id --}}
            &nbsp;
              {{-- edit button --}}
              <a href="{{-- route('community.comments.edit?', $   ->id) --}}" class="text-decoration-none">
                <i class="fa-regular fa-pen-to-square text-dark"></i>
              </a>
              {{-- delete button  --}}
              <button class="bg-white border border-0 bg-transparent">
                <i class="fa-regular fa-trash-can"></i>
              </button>
              {{-- include('users.community.comments.modals.delete?') --}}
            {{-- @endif --}}
        </div>
      </div>
  </div>
</div>
<hr class="my-2">
