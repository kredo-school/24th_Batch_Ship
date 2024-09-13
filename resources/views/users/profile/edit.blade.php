@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<head>
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('css/style_postshow.css') }}">
  
</head>
<div class="conteiner bg-blue">
  <div class="row p-3">
    <form action="{{ route('users.profile.profileUpdate') }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PATCH')

        <div class="col-8 mx-auto">

            <div class="mb-3 text-center">
                <h4>Edit your profile!</h4>
            </div>

            <div class="mb-3 text-center">
                {{-- avatar & upload image --}}
                @if ($user->avatar)
                    <img id="image-preview" src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle d-block mx-auto avatar-lg mb-3">
                @else
                    <p id="image-preview" class="display-1 mb-0"><i class="fa-solid fa-circle-user text-turquoise"></i></p>
                @endif

                <label class="mb-3">
                    <span class="btn btn-sm btn-turquoise2">
                        Choose your avatar
                        <input type="file" name="avatar" id="avatar" class="form-control avatar-display" aria-describedby="avatar-info">
                    </span>
                    <div class="form-text" id="avatar-info">
                    Acceptable formats: jpeg, jpg, png, gif only<br>
                    Max file size is 1048kb
                    </div>
                    {{-- Error --}}
                    @error('avatar')
                    <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </label>
            </div>

            {{-- username --}}
            <div class="mb-3 text-center">
                <p class="text-center fw-bold mb-1">
                    <i class="fa-solid fa-caret-down"></i> Username
                </p>
                <input type="text" name="username" id="" class="form-control w-50 mx-auto" placeholder="{{ old('username', $user->username) }}" autofocus>
                {{-- Error --}}
                @error('username')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>

            {{-- introduction --}}
            <div class="mb-3 text-center">
                <p class="text-center fw-bold mb-1">
                    <i class="fa-solid fa-caret-down"></i> Self-introduction
                </p>
                <textarea class="border-0 p-2" name="introduction" id="introduction" cols="57" rows="5" class="p-2" placeholder="{{ old('introduction', $user->introduction) }}"></textarea>
            </div>

            {{-- select interest --}}
            <div class="mb-3">
            <p class="text-center fw-bold mb-1">
                <i class="fa-solid fa-caret-down"></i> Select your interests
            </p>

            {{-- category foreach? --}}
            <div class="border bg-white p-2 w-100 scroll-container">
                <div class="category">
                <table>
                <tr>
                    <td>
                        @foreach($all_categories as $category)
                            @if (in_array($category->id, $selected_categories))
                                <input type="checkbox" name="category[]" id="{{ $category->name }}" name="{{ $category->id }}" autocomplete="off" value="{{ $category->id }}" checked>
                            @else
                                <input type="checkbox" name="category[]" id="{{ $category->name }}" name="{{ $category->id }}" autocomplete="off" value="{{ $category->id }}">
                            @endif
                            <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>

                        @endforeach
                        {{-- Error message area --}}
                        @error('category')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </td>
                    </tr>
                </table>
                </div>
                
            </div>
            </div>

            {{-- button --}}
            <div class="mb-3 text-center fw-bold">
            <button type="submit" class="btn w-50 btn-turquoise2">
                SAVE IT !
            </button>          
            </div>
        </div>
    </form>
  </div>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('js/profile/form.js') }}"></script>
@endsection