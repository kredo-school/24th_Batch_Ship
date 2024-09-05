<div class="row">
    <div class="col-3 p-3 d-flex justify-content-center align-items-center">
        {{-- avatar --}}
        {{-- @if ($user->avatar)
            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle avatar-lg">
        @else --}}
            <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
        {{-- @endif --}}
    </div>

    <div class="col-9 p-5">
        {{-- user name --}}
        <h2 class="display-6 mb-0">{{ $user->username }}</h2><br>

        {{-- reaction modal --}}
        <button type="button" class="text-danger btn btn-lg" data-bs-toggle="modal" data-bs-target="#reacted-profile">
            <i class="fa-solid fa-heart text-danger"></i>
        </button>
        <button type="button" class="text-primary btn btn-lg" data-bs-toggle="modal" data-bs-target="#reacting-profile">
            <i class="fa-solid fa-heart"></i>
        </button>
    </div>
    @include('users.profile.modal.compatibility')
</div>

{{-- introduction --}}
<div class="row mx-2">
    <p>intro</p>
</div>

{{-- categories --}}
<div class="row mx-2">
    <div class="col d-flex">
        {{-- foreach all selected categories --}}
        <div class="badge bg-turquoise fs-6 me-2 px-4">
            
        </div>
    </div>
</div>