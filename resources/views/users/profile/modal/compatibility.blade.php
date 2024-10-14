
<style>
    a, a:visited {
     text-decoration: none !important;

 }
 </style>

 {{-- Reacted --}}
<div class="modal fade" id="reacted-profile">
    <div class="modal-dialog">
        <div class="modal-content pe-1">
            <div class="modal-header text-center border-0 d-block">
                <h1 class="h5 modal-title">
                    Someone who feels good compatibility with me
                </h1>
                <p class="mt-4 mb-0">
                    Sort by
                    <button class="btn btn-turquoise text-white mx-2" type="button" id="sort-compatibility">compatibility %</button>
                    or
                    <button class="btn btn-turquoise text-white mx-2" type="button" id="sort-date">date (newest list)</button>
                </p>
            </div>
            <hr>
            <div class="modal-body" style="max-height: 400px; overflow-y: scroll;" id="compatibility-container">
                @foreach ($reactedCompatibilities as $compatibility)
                <div class="compatibility-item" data-percentage="{{ $compatibility->compatibility }}" data-date="{{ $compatibility->created_at }}">
                    <div class="row align-items-center">
                        <div class="col-2 text-start m-2">
                            {{ $compatibility->compatibility }}<span>%</span>
                        </div>
                        <div class="col-5 text-start">
                            <a href="{{ route('users.profile.specificProfile', $compatibility->send_user_id) }}">
                                @if($compatibility->sender->avatar)
                                <img src="{{ $compatibility->sender->avatar }}" alt="" class="rounded-circle avatar-sm">
                                @else
                                <i class="fa-solid fa-circle-user text-secondary  icon-sm"></i>
                            @endif
                            </a>
                            <a href="{{ route('users.profile.specificProfile', $compatibility->send_user_id) }}" class="text-decoration-none text-dark fw-bold mx-2 ">{{ $compatibility->sender->username }}</a>
                        </div>
                        <div class="col-2 text-end">
                            @if ($compatibility->send_user_id === Auth::user()->id)
                        <form action="{{ route('compatibility.destroy', $compatibility->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="border-0 bg-transparent text-danger p-0 xsmall">Delete</button>
                        </form>
                    @endif
                </div>
                        <div class="col text-end">
                            <span class="text-uppercase text-muted xsmall">{{ date('M d, Y', strtotime($compatibility->created_at)) }}</span>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach

            </div>
        </div>
    </div>
</div>



{{-- Reacting --}}

<div class="modal fade" id="reacting-profile">
  <div class="modal-dialog">
    <div class="modal-content pe-1">
      <div class="modal-header text-center border-0 d-block">
        <h1 class="h5 modal-title">
          Someone I feel good compatibility with
        </h1>
        <p class="mt-4 mb-0">
          Sort by
          <button class="btn btn-turquoise text-white mx-2" type="button" id="sort-reacting-compatibility">compatibility %</button>
          or
          <button class="btn btn-turquoise text-white mx-2" type="button" id="sort-reacting-date">date (newest list)</button>
      </div>
      <div class="modal-body" style="max-height: 400px; overflow-y: scroll;">

        <hr>
        <div class="modal-body" style="max-height: 400px; overflow-y: scroll;" id="reacting-compatibility-container">
            @foreach ($reactingCompatibilities as $compatibility)
                <div class="compatibility-item" data-percentage="{{ $compatibility->compatibility }}" data-date="{{ $compatibility->created_at }}">
                    <div class="row align-items-center">
                        <div class="col-2 text-start m-2">
                            {{ $compatibility->compatibility }}<span>%</span>
                        </div>
                        <div class="col-5 text-start">
                            <a href="{{ route('users.profile.specificProfile', $compatibility->user_id) }}">

                            @if( $compatibility->user->avatar)
                             <img src="{{ $compatibility->user->avatar }}" alt="" class="rounded-circle avatar-sm">
                                @else
                                <i class="fa-solid fa-circle-user text-secondary icon-sm "></i>
                            @endif
                            </a>
                            <a href="{{ route('users.profile.specificProfile', $compatibility->send_user_id) }}" class="text-decoration-none text-dark fw-bold mx-2">{{ $compatibility->user->username }}</a>
                        </div>

                        <div class="col-2 text-end">
                            @if ($compatibility->send_user_id === Auth::user()->id )
                        <form action="{{ route('compatibility.destroy', $compatibility->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="border-0 bg-transparent text-danger p-0 xsmall">Delete</button>
                        </form>
                    @endif
                </div>
                        <div class="col text-end">
                            <span class="text-uppercase text-muted xsmall">{{ date('M d, Y', strtotime($compatibility->created_at)) }}</span>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
   </div>
</div>
</div>
