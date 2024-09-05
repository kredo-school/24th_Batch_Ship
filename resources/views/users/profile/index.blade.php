@extends('layouts.app')

@section('title', '$user->username')
    
@section('content')

  <body class="bg-light">

    @include('users.profile.contents.header')

    {{-- List of User's Posts --}}
    @include('users.profile.contents.posts')

    {{-- List of User's Communities --}}
    @include('users.profile.contents.communities')

    {{-- List of User's Communities --}}
    @include('users.profile.contents.events')

  </body>
@endsection
