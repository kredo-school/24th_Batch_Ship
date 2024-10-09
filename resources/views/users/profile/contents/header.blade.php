<head>
    <link rel="stylesheet" href="{{ asset('css/style_profile_show.css') }}">
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

                <strong class="h1 display-6 p-3 ">{{ $user->username }}</strong>


            <div class="row mb-3">

 {{-- reaction modal --}}
                <div class="col-4 mt-5">
                    <button type="button" class="text-danger btn btn-lg " data-bs-toggle="modal" data-bs-target="#reacted-profile">
                        <i class="fa-solid fa-heart text-danger"></i>
                    </button>
                    <button type="button" class="text-primary btn btn-lg " data-bs-toggle="modal" data-bs-target="#reacting-profile">
                        <i class="fa-solid fa-heart"></i>
                    </button>


                @include('users.profile.modal.compatibility')
               </div>
            </div>

 {{-- compatibility form and message from  --}}
                @if (Auth::user()->id !== $user->id)
                    <div class="col-4">
                    <form action="{{ route('compatibility.store', $user->id) }}" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                            @csrf
                            <input type="hidden" name="send_user_id" value="{{ $user->id }}">
                                <div class="range-slider mb-5 ml-3">
                                     <label for="compatibility" class="form-label mx-3 ">Compatibility:</label>
                                    <input type="range" id="compatibility" name="compatibility" value="60"
                                        min="60" max="100" step="1" class=""
                                        oninput="document.getElementById('output1').value=this.value">
                                    <output id="output1" class="mx-2">60</output>
                                    <span>%</span>
                                </div>
                            </div>    
                        <div class="col-2 mt-4">
                                <button type="submit" class="btn btn-gold text-white">Send</button>
                            </div>
                        </form>

                    <div class="col-2 mt-4">
                        <form action="{{ route('chat.show', $user->id) }}" method="get" class="row row-cols lg auto g-3 align-items-center">
                            @csrf

                            <button type="submit" class="btn btn-outline-secondary"><i class="fa-solid fa-envelope "></i> &nbsp;  Message</button>

                        </form>
                        </div>
                @endif
            </div>
        </div>

{{-- introduction --}}

            <div class="mb-3 mx-3">
                <h4>{{ $user->introduction }}</h4>
            </div>

 {{-- display all selected categories --}}
                  <div class="mb-2  ">
                    @forelse ($user->categoryUser as $category_user)
                        <a href="{{ route('users.categories.show', $category_user->category_id) }}" class="badge bg-turquoise text-decoration-none category-name mx-2 ">
                            {{ $category_user->category->name }}
                        </a>
                    @empty
                        <a href="" class="badge bg-dark text-decoration-none ">Uncategorized</a>
                    @endforelse

            </div>
        </div>
</div>
