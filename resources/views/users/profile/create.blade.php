@extends('layouts.app')

@section('title', 'Create Profile')
@section('styles')
  <link rel="stylesheet" href="{{ asset('css/style_postshow.css') }}">
@endsection

@section('content')
  <div class="container bg-blue">
    <div class="row p-3">
      <form action="{{ route('users.profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
  
        <div class="col-8 mx-auto">
  
          <div class="mb-3 text-center">
            <h4>Create your profile!</h4>
          </div>
  
          <div class="mb-3 text-center">
            {{-- avatar & upload image --}}
              <img id="image-preview" src="/assets/image/avatar1.png" alt="preview image" class="img-thumbnail border rounded-circle d-block mx-auto avatar-lg mb-2">

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
            <textarea class="border-0 p-2" name="introduction" id="introduction" cols="57" rows="5" class="p-2" placeholder="Feel free to write about your interest & hobbies :)"></textarea>
            {{-- Error message area --}}
            @error('introduction')
              <div class="text-danger small">{{ $message }}</div>
            @enderror
          </div>
  
          {{-- select interest --}}
          <div class="mb-3">
            <p class="text-center fw-bold mb-0">
              <i class="fa-solid fa-caret-down"></i> Select your interests
            </p>
  
            {{-- category foreach? --}}
            <div class="border bg-white w-100 scroll-container">
              <div class="category">
                <table>
                 <tr>
                   <td>
                      @foreach($all_categories as $category)
                        <input type="checkbox" name="category[]" id="{{ $category->name }}" name="{{ $category->id }}" autocomplete="off" value="{{ $category->id }}">
                        <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
                      @endforeach
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

@section('scripts')
    <script src="{{ asset('js/profile/form.js') }}"></script>
@endsection