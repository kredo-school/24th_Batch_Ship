@extends('layouts.app')

@section('title', 'Search')

@section('content')


<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<div class="content search-bg" >
     <h1 class="fw-bold text-center ">Your Key word is...""</h1>
        {{-- <span class="fw-bold">{{ $search }}</span>"</h1> --}}
    {{-- @forelse ($users as $user) --}}


{{-- User --}}
<div class="mt-5">
        <h2 class="mx-3">User</h2>
        <p class="text-end text-decoration-underline text-primary"><a href="#"></a>see more</p>
        <div class="container green">
            {{-- <div class="row justify-content-center align-items-center"> --}}
            <table>
                 {{-- @foreach ($users as users ) --}}

                <tr>
                    <td><img src="assets/image/profile.png" alt="" class="search-img"></td>
                    <td><img src="assets/image/profile.png" alt="" class="search-img"></td>
                    <td><img src="assets/image/profile.png" alt="" class="search-img"></td>

                </tr>

                 {{-- @endforeach --}}
              </table>
        {{-- </div> --}}
    </div>
    </div>
{{-- Post --}}
<div class="mt-5">
        <h2 class="mx-3">Post</h2>
        <p class="text-end text-decoration-underline text-primary"><a href="#"></a>see more</p>
        <div class="container bg-pink ">
                 <table >
                    {{-- @foreach ($posts as posts ) --}}

                    <tr>
                      <td><img src="assets/image/post.png" alt="" class="search-img"></td>
                    </tr>

                    {{-- @endforeach --}}
                  </table>

        </div>
</div>

{{-- Community --}}
<div class="mt-5">
        <h2 class="mx-3">Community</h2>
        <p class="text-end text-decoration-underline text-primary"><a href="#"></a>see more</p>
        <div class="container bg-blue">
                 <table >
                    {{-- @foreach ($communities as communities ) --}}

                    <tr>
                      <td><img src="assets/image/community.png" alt="" class="search-img"></td>
                    </tr>

                    {{-- @endforeach --}}
                  </table>

        </div>
</div>

{{-- Event --}}
      <div class="mt-5">
        <h2 class="mx-3">Event</h2>
        <p class="text-end text-decoration-underline text-primary"><a href="#"></a>see more</p>
        <div class="container bg-yellow">

                 <table >
                    {{-- @foreach ($events as events ) --}}

                    <tr>
                      <td><img src="assets/image/event.png" alt="" class="search-img"></td>
                    </tr>

                    {{-- @endforeach --}}
                  </table>

        </div>

 </div>

{{-- @empty
<h2>No results found</h2>
@endforelse --}}




</div>

</div>
@endsection

