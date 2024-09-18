{{-- Reacted --}}
<div class="modal fade" id="see-all-reactions">  {{--modal div---}}
  <div class="modal-dialog">                {{--modal dialog div---}}
    <div class="modal-content border-turquoise pe-1 modal-with">  {{--modal content div---}}
      <div class="modal-header text-center border-0 d-block">    {{--modal header div---}}
        <p class="mt-4 mb-0">
          Sort by
          <button class="btn btn-turquoise mx-2" type="button" id="sort-enpathy">Enpathy %</button>
          or
          <button class="btn btn-turquoise mx-2" type="button" id="sort-date">date (newest list)</button>
        </p>
    </div>         {{--modal header end div---}}
      <div class="modal-body" style="max-height: 400px; overflow-y: scroll;">    {{--modal body div---}}
        <hr>
    <div class="row align-items-center">     {{--modal body start div---}}
          <div class="col-2">
            <p class="text-center me-1 mb-0">100%</p>
          </div>
 {{-- show all the comments --}}
       @if ($post->comments->isNotEmpty())
         <div class="col-3">
           <ul class="list-group mt-2 text-start">
             @foreach ($post->comments as $comment)
              <li class="list-group-item border-0  mb-2">

               @if ($comment->user->avatar)
                  <a href="{{ route('users.profile.specificProfile', $comment->user->id) }}">
                    <img src="{{ $comment->user->avatar }}" alt="" class="rounded-circle avatar-sm "></a>

            @else
                <a href="{{ route('users.profile.specificProfile', $comment->user->id) }}">
                <i class="fas fa-circle-user text-secondary icon-sm " ></i></a>
            @endif
             </div>
             <div class="col-5 text-start">
             <a href="{{ route('users.profile.specificProfile', $comment->user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $comment->user->name }}</a>
             &nbsp;
             <p class="d-inline fw-light">{{ $comment->body }}</p>

             </div>
             <div class="col-2 text-end">
             <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                 @csrf
                 @method('DELETE')

                 <span class="text-uppercase text-muted xsmall">{{ date('M d, Y', strtotime($comment->created_at)) }}</span>

 {{-- if the auth user is the owner of the coment, show a delete button. --}}
                 @if (Auth::user()->id === $comment->user->id)
                     &middot;
                     <button type="submit" class="border-0 bg-transparent text-danger p-0 xsmall">Delete</button>

                 @endif

          </div>

              <hr>
              @endforeach
               </form>
         </li>

   </ul>

@endif
</div>
</div>

</div>   {{--modal body start div---}}
     </div>{{--modal body end div---}}

    </div>    {{--modal content end div---}}
  </div>    {{--modal dialog end div---}}
</div>  {{--modal end div---}}
