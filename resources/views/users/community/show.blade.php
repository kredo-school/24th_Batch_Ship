@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row bg-blue rounded justify-content-center">
    {{-- left side --}}
    <div class="col-md-8 px-4">
      {{-- cover img & description --}}
      <div class="mt-3 text-center">
        <img src="https://images.pexels.com/photos/3408354/pexels-photo-3408354.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="object-fit-cover border rounded w-100 h-25" alt="">
        <h2 class=" my-2">Travel in Japan</h2>
        <p class="lh-sm">
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquid repellat soluta corrupti quibusdam harum eveniet, nemo saepe quas incidunt accusamus eos distinctio culpa ullam. Molestiae qui sapiente quo veritatis? Incidunt harum soluta nulla dolore pariatur eum quidem voluptatibus distinctio dolorum magnam molestias commodi ad, laborum itaque eos blanditiis earum aliquid?
        </p>
      </div>

      {{-- bulletin board --}}
      <div class="container bg-white p-3">
        <form action="#" method="post" enctype="multipart/form-data">
            @csrf
            {{-- input for comments --}}
            <div class="row">
              <div class="col-1"></div>
              <div class="col-10">
                <div class="mb-2 input-group">
                  <textarea name="comment_body" rows="1" class="form-control form-control-sm rounded shadow-sm" placeholder="write a comment"></textarea>
                  @error('comment_body')
                  <p class="mb-0 text-danger samll">{{ $message }}</p>
                  @enderror
                  <input type="submit" value="send" class="btn bg-turquoise rounded text-white fw-bold mx-2 px-4 py-0">
                </div>              
              </div>
              <div class="col"></div>
            </div>
            <div class="row">
              <div class="col-1"></div>
              <div class="col-7">
                {{-- input to uploard img --}}
                <input class="form-control form-control-sm" id="formFileSm" type="file">
              </div>
            </div>              
        </form>
        <hr class="my-3">
        {{-- comments list--}}
        <div class="row bg-white p-2 m-0">
        @include('users.community.comments.list-item')          
        </div>            
      </div>
     </div>
    </div>{{-- end of left side --}}
    
    {{-- right side --}}
    {{-- join button --}}
    <div class="col-md-4">
      <div class="mb-3 d-flex justify-content-end">
        <a href="" class="btn bg-gold text-white m-3 px-4 py-0">JOIN</a>
       </div>

        {{-- Event owner --}}
        <div class="mb-3">
          <h6>Created by</h6>
          <i class="fa-solid fa-circle-user icon-sm"></i>        
        </div>

        {{-- Members --}}
        {{-- @if ($community_members) --}}
        <div class="row mb-3">
          <div class="col">
            <h6>Members(count)</h6>
            {{-- {{ $community->users->count() }} ??????  --}}
          </div>
          <div class="col-auto">
            <a href="{{-- route('community-members') --}}" class="text-decoration-none text-primary fw-bold" data-bs-toggle="modal" data-bs-target="#community_members{{-- #members{{ $post->id }} --}}">See all</a>
            @include('users.community.modals.members-list')
          </div>
        </div>

         {{-- Interets --}}
        <div class="row mb-3">
          <form action="" method="post">
            @csrf
            <h6>Interest</h6>
            <div class="col-6">
              <div class="input-group">
                <input type="number" name="interest%" id="" class="form-control border-0 text-end">
                <span class="input-group-text bg-white border-0">%</span>
                <button class="btn bg-turquoise text-white rounded fw-bold px-3 py-0">Send</button>      
              </div>
            </div>     
            </form>
        </div>
      
        {{-- Category --}}
        <div class="mb-3 ">
          <h6>Category</h6>
          {{-- @forelse $community->category as $community? --}}
          <div class="badge border-0 bg-turquoise text-white px-2">
            $community->category?
          </div>    
        </div>
        {{-- @endforelse --}}
      
        {{-- Events --}}
        <h6>Events(count)</h6>
       @include('users.community.events.list-item')
      {{-- {{ $community->users->count() }} ??????  --}}

    </div> {{-- end of right side --}}
  </div> {{-- end of row --}}
</div> {{-- end of container --}}
@endsection