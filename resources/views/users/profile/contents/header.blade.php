<div class="container-fluid">
    <div class="row">
        <div class="col-3 d-flex justify-content-center align-items-center">
            {{-- avatar --}}
            @if ($user->avatar)
                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle avatar-lg">
            @else
                <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
            @endif
        </div>

        <div class="col-9 p-5">
            {{-- user name --}}
            <div class="row mb-3">
                <h2 class="display-6 mb-0">{{ $user->username }}</h2><br>
            </div>

            <div class="row mb-3">
                {{-- reaction modal --}}
                <div class="col-auto">
                    <button type="button" class="text-danger btn btn-lg" data-bs-toggle="modal" data-bs-target="#reacted-profile">
                        <i class="fa-solid fa-heart text-danger"></i>
                    </button>
                </div>
                <div class="col-auto">
                    <button type="button" class="text-primary btn btn-lg" data-bs-toggle="modal" data-bs-target="#reacting-profile">
                        <i class="fa-solid fa-heart"></i>
                    </button>
                </div>
                @include('users.profile.modal.compatibility')

                {{-- form for compatibility --}}
                @if (Auth::user()->id !== $user->id)
                    <div class="col-auto">
                        <form action="#" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                            @csrf

                            <div class="col">
                                <div class="input-group">
                                    <input type="number" name="compatibility" id="compatibility" class="form-control" placeholder="compatibility" aria-label="compatibility">
                                    <span class="input-group-text" id="percentage">%</span>
                                </div>
                            </div>

                            <div class="col">
                                <button type="submit" class="btn btn-gold text-white">Send</button>
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        <a href="{{ route('chat.index', $user->id) }}" class="btn btn-outline-secondary">Message</a>
                    </div>    
                @endif
            </div>

            {{-- introduction --}}
            <div class="row mb-3">
                <p>{{ $user->introduction }}</p>
            </div>

            {{-- categories --}}
            <div class="row">
                <div class="col">
                    {{-- display all selected categories --}}
                    @forelse ($user->CategoryUser as $category_user)
                        <a href="#" class="badge bg-turquoise text-decoration-none me-1 mt-2">
                            {{ $category_user->category->name }}
                        </a>
                    @empty
                        <a href="#" class="badge bg-dark text-decoration-none mt-1">Uncategorized</a>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>