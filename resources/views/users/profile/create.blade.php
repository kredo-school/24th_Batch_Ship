@extends('layouts.app')

@section('content')

@section('title', 'Create Profile')
<div class="conteiner bg-blue">
  <div class="row p-3">
    <form action="" method="post">
      @csrf
      <div class="col-8 mx-auto">

        {{-- avator --}}
        <div class="mb-3 text-center">
          <h4>Create your profile!</h4>
          <p class="display-1 mb-0"><i class="fa-solid fa-circle-user text-turquoise"></i></p>

          <label class="mb-3">
            <span class="btn btn-sm bg-turquoise text-white">
                Choose your avatar
                <input type="file" style="display:none" >
            </span>
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
          <div class="border bg-white p-2 w-100">
            <input type="checkbox" class="btn-check" id="category1" autocomplete="off">
            <label class="btn btn-sm btn-outline-primary m-1" for="category1">category 1</label>         

            <input type="checkbox" class="btn-check" id="category2" autocomplete="off">
            <label class="btn btn-sm btn-outline-primary m-1" for="category2">category 2</label>
            <input type="checkbox" class="btn-check" id="category3" autocomplete="off">
            <label class="btn btn-sm btn-outline-primary m-1" for="category3">category 3</label>
            <input type="checkbox" class="btn-check" id="category4" autocomplete="off">
            <label class="btn btn-sm btn-outline-primary m-1" for="category4">category 4</label>
            
          </div>
        </div>

        {{-- button --}}
        <div class="mb-3 text-center fw-bold">
          <button type="submit" class="btn bg-turquoise w-50 text-white">
            CREATE !
          </button>          
        </div>

  
      </div>

    </form>
  </div>
</div>

@endsection