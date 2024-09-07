@extends('layouts.app')

@section('content')

@section('title', 'Create Profile')
<head>
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('css/style_postshow.css') }}">
  
</head>
<div class="conteiner bg-blue">
  <div class="row p-3">
    <form action="{{ route('users.profile.store') }}" method="post">
      @csrf
      @method('PATCH')

      <div class="col-8 mx-auto">

        <div class="mb-3 text-center">
          <h4>Create your profile!</h4>
          {{-- avatar & upload image --}}
          {{-- @if ($user->avatar) --}}
          {{-- <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle d-block mx-auto avatar-lg"> --}}
          {{-- @else --}}
          <p class="display-1 mb-0"><i class="fa-solid fa-circle-user text-turquoise"></i></p>
          {{-- @endif --}}

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

        {{-- introduction --}}
        <div class="mb-3 text-center">
          <p class="text-center fw-bold mb-0">
            <i class="fa-solid fa-caret-down"></i> Self-introduction
          </p>
          <textarea class="border-0 p-2" name="self-intro" id="self-intro" cols="57" rows="5" class="p-2" placeholder="Feel free to write about your interest & hobbies :)"></textarea>
        </div>

        {{-- select interest --}}
        <div class="mb-3">
          <p class="text-center fw-bold mb-0">
            <i class="fa-solid fa-caret-down"></i> Select your interests
          </p>

          {{-- category foreach? --}}
          <div class="border bg-white p-2 w-100 scroll-container">
            <div class="category">
              <table>
               <tr>
                 <td>
                    @foreach($all_categories as $category)
                      <input type="checkbox" name="category[]" id="{{ $category->name }}" name="{{ $category->id }}" autocomplete="off" value="{{ $category->id }}">
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
            CREATE !
          </button>          
        </div>

  
      </div>

    </form>
  </div>
</div>

@endsection