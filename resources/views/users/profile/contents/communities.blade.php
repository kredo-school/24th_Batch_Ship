<h2 class="mx-3 mt-4">Community</h2>

{{-- User's Own Community --}}
<div class="d-flex justify-content-between align-items-center mx-4">
    <h3>Own Community</h3>
</div>

<div class="bg-blue mx-2">
    <div class="row">
        {{-- Get 4 communities --}}
        {{-- @foreach 
            @if ($user->id === $community->owner_id)
                <div class="col-3">
                    <div class="container bg-white m-3 p-0">
                        <a href="#" class="d-block">
                            <img src="{{ $community->image }}" class="w-100" style="height: auto;">
                        </a>
                        <div class="row mt-2 mx-auto">
                            <div class="col">
                                <h5><a href="#" class="text-black fw-bold">{{ $community->title }}</a></h5>
                                <p class="text-end">Created by<a href="#" class="ms-2"><img src="{{ $user->avatar }}" class="rounded-circle avatar-md"></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <h3 class="text-secondary text-center"> does not have own community yet.</h3>
            @endif
        @endforeach --}}
    </div>
</div>

{{-- User's Joined Community --}}
<div class="d-flex justify-content-between align-items-center mx-4 mt-2">
    <h3>Joined Community</h3>
</div>

<div class="bg-blue mx-2">
    <div class="row">
        {{-- @foreach 4 join communities --}}
        {{-- @foreach --}}
            {{-- @if ($user->id === )
                <div class="col-3">
                    <div class="container bg-white m-3 p-0">
                        <a href="#" class="d-block">
                            <img src="{{ $community->image }}" class="w-100" style="height: auto;">
                        </a>
                        <div class="row mt-2 mx-auto">
                            <div class="col d-flex align-items-center">     
                            <h5><a href="#" class="text-black fw-bold">Community title</a></h5>
                            </div>
                            <p class="text-end">
                            Created by
                            <a href="#" class="text-black ms-2">
                                <i class="fa-solid fa-circle-user icon-md"></i>
                            </a>
                            </p>
                        </div>
                    </div>
                </div>
            @else --}}
                <h3 class="text-secondary text-center"> does not join any community yet.</h3>
            {{-- @endif --}}
        {{-- @endforeach --}}
    </div>
</div>
