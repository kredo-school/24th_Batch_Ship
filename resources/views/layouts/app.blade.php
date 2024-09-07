<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>{{ config('app.name', 'SHIP') }} | @yield('title')</title>

    {{-- <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-turquoise shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('users.profile.index') }}">
                    <img src="" alt="" width="30" height="24">
                </a>
                <a href="{{ route('users.profile.index') }}" class="nav-link me-auto mb-2 mb-lg-0 text-white"><h1 class="h5 mb-0">{{ config('app.name', 'SHIP') }}</h1></a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            {{-- Ship icon --}}
                            <li class="nav-item dropdown">
                                <a href="" class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" area-expanded="false">
                                    <i class="fa-solid fa-ship"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><h1 class="h6 text-center text-dark">Go to...</h1></li>
                                    <li><a href="{{ route('users.posts.index') }}" class="dropdown-item">Post</a></li>
                                    <li><a href="{{ route('community.index') }}" class="dropdown-item">Community</a></li>
                                </ul>
                            </li>
                            {{-- Create icon --}}
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" area-expanded="false">
                                    <i class="fa-solid fa-circle-plus"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><h1 class="h6 text-center text-dark">Create...</h1></li>
                                    <li><a href="{{ route('users.posts.create') }}" class="dropdown-item">Post</a></li>
                                    <li><a href="{{ route('community.create') }}" class="dropdown-item">Community</a></li>
                                </ul>
                            </li>
                            {{-- Search icon (open modal)--}}
                            <li class="nav-item">
                                <a href="#" class="nav-link text-white" data-bs-toggle="modal" data-bs-target="#search"><i class="fa-solid fa-magnifying-glass"></i></a>
                                @include('layouts.modals.search')
                            </li>
                            {{-- Dropdown --}}
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('users.profile.edit', Auth::user()->id) }}" class="dropdown-item"><i class="fa-solid fa-pen-to-square"></i> Edit Profile</a>
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown-item"><i class="fa-solid fa-person-circle-question"></i> Support</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item dropdown-item-end" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-5">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    {{-- Admin Menu(optional) --}}
                    {{-- put admin manu positioned side by side --}}

                    {{-- Main Content --}}
                    <div class="col-11">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>

        <div class="footer bg-turquoise">
            <p class="text-white text-center my-auto">&copy; 2024 SHIP, inc</p>
        </div>
    </div>
</body>
</html>
