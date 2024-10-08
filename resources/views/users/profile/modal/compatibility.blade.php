
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
                                <img src="{{ $compatibility->sender->avatar ?? 'default-avatar.png' }}" alt="" class="rounded-circle avatar-sm">
                            </a>
                            <a href="{{ route('users.profile.specificProfile', $compatibility->send_user_id) }}" class="text-decoration-none text-dark fw-bold mx-2">{{ $compatibility->sender->username }}</a>
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
                                <img src="{{ $compatibility->user->avatar ?? 'default-avatar.png' }}" alt="" class="rounded-circle avatar-sm">
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


<script>
   document.addEventListener('DOMContentLoaded', function() {
    function sortCompatibility(containerId, sortType) {
        const compatibilityContainer = document.getElementById(containerId);
        const compatibilityItems = Array.from(compatibilityContainer.querySelectorAll('.compatibility-item'));

        compatibilityItems.sort((a, b) => {
            if (sortType === 'compatibility') {
                return parseInt(b.dataset.percentage) - parseInt(a.dataset.percentage);
            } else if (sortType === 'date') {
                return new Date(b.dataset.date) - new Date(a.dataset.date);
            }
            return 0;
        });

        compatibilityContainer.innerHTML = ''; // コンテナを空にする

        compatibilityItems.forEach((item) => {
            compatibilityContainer.appendChild(item);
            compatibilityContainer.appendChild(document.createElement('hr'));
        });
    }

    // Reacted Profile
    document.getElementById('sort-compatibility').addEventListener('click', function() {
        sortCompatibility('compatibility-container', 'compatibility');
    });

    document.getElementById('sort-date').addEventListener('click', function() {
        sortCompatibility('compatibility-container', 'date');
    });

    // Reacting Profile
    document.getElementById('sort-reacting-compatibility').addEventListener('click', function() {
        sortCompatibility('reacting-compatibility-container', 'compatibility');
    });

    document.getElementById('sort-reacting-date').addEventListener('click', function() {
        sortCompatibility('reacting-compatibility-container', 'date');
    });
});

</script>


