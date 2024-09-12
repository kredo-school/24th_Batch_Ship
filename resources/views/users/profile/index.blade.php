@extends('layouts.app')

@section('title', $user->username)
    
@section('content')

  <head>
    <link rel="stylesheet" href="{{ asset('css/style_profileindex.css') }}">
  </head>

  <body>
    <div class="container-fluid bg-light">
      
      @include('users.profile.contents.header')
      
      {{-- List of User's Posts --}}
      @include('users.profile.contents.posts')
      
      {{-- List of User's Communities --}}
      @include('users.profile.contents.communities')
      
      {{-- List of User's Events --}}
      @include('users.profile.contents.events')
      
    </div>
  </body>
@endsection
