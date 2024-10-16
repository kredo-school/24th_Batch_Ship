<head>
    <link rel="stylesheet" href="{{ asset('css/style_profile_show.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style_postshow.css') }}">
</head>

<div class="container-fluid">
    <div class="row p-3">
        <div class="col-3 d-flex justify-content-center align-items-center">

            {{-- avatar --}}
            @if ($user->avatar)
                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle avatar-lg">
            @else
                <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
            @endif
        </div>

        <div class="col-9">
            {{-- user name --}}
            <p class="h1 display-6 p-3 fw-bold">{{ $user->username }}</p>

            <div class="row mb-3 d-flex justify-content-between align-items-center">
                {{-- reaction modal --}}
                <div class="d-flex flex-lg-fill">
                    <button type="button" class="text-danger btn btn-lg " data-bs-toggle="modal" data-bs-target="#reacted-profile">
                        <i class="fa-solid fa-heart text-danger"></i>
                    </button>
                    <button type="button" class="text-primary btn btn-lg " data-bs-toggle="modal" data-bs-target="#reacting-profile">
                        <i class="fa-solid fa-heart"></i>
                    </button>

                    @include('users.profile.modal.compatibility')
                </div>

                <div class="d-flex align-items-center">
                    {{-- compatibility form --}}
                    @if (Auth::user()->id !== $user->id)
                        <form action="{{ route('compatibility.store', $user->id) }}" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                            @csrf

                                <div class="range-slider me-3">
                                    <input type="hidden" name="send_user_id" value="{{ $user->id }}">
                                    <label for="compatibility" class="form-label mx-3 ">Compatibility:</label>
                                    
                                    
                                    @foreach ($reactedCompatibilities as $compatibility)
                                        @if ($compatibility->send_user_id === Auth::user()->id)
                                            <input type="range" id="compatibility" name="compatibility" value="{{ $compatibility->compatibility }}"
                                                min="60" max="100" step="1" class=""
                                                oninput="document.getElementById('output1').value=this.value">
                                            <output id="output1" class="mx-2">{{ $compatibility->compatibility }}</output>
                                            <span>%</span>
                                        @else
                                            <input type="range" id="compatibility" name="compatibility" value="60"
                                                min="60" max="100" step="1" class=""
                                                oninput="document.getElementById('output1').value=this.value">
                                            <output id="output1" class="mx-2">60</output>
                                            <span>%</span>
                                        @endif
                                    @endforeach
                                </div>

                                <div class="me-3">
                                    <button type="submit" class="btn btn-gold text-white">Send</button>
                                </div>
                        </form>
                    @endif
                </div>

                <div class="d-flex align-items-center ms-3">
                    {{-- Message button --}}
                    @if (Auth::user()->id !== $user->id)
                        <form action="{{ route('chat.show', $user->id) }}" method="get" class="row row-cols lg auto g-3 align-items-center">
                            @csrf

                            <button type="submit" class="btn btn-outline-secondary"><i class="fa-solid fa-envelope "></i> &nbsp;  Message</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- introduction --}}
    <div class="mb-3 mx-3">
        <h4>{{ $user->introduction }}</h4>
    </div>

    {{-- display all selected categories --}}
    <div class="mb-2  ">
        @forelse ($user->categoryUser as $category_user)
            <a href="{{ route('users.categories.show', $category_user->category_id) }}" class="badge bg-turquoise text-decoration-none category-name mx-2 mb-1">
                {{ $category_user->category->name }}
            </a>
        @empty
            <a href="" class="badge bg-dark text-decoration-none mb-1">Uncategorized</a>
        @endforelse
    </div>
</div>
