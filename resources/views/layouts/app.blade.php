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
    @yield('styles')

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="cont">
    <div id="app" class="container-main">
        <nav class="navbar navbar-expand-md navbar-light bg-turquoise shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('users.profile.index') }}">
                    <img src="/assets/image/SHIPlogo_blue.png" alt="" width="40" height="30">
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
                 {{-- Notification icon --}}
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{-- @if(Auth::user()->unreadNotifications->count()) --}}
                                        {{-- icon for new message --}}
                                        <i class="fa-solid fa-face-laugh"></i> 
                      {{-- Display unread notification count as a badge --}}
                                        <span class="badge bg-danger rounded-circle p-1">
                                            {{-- {{ Auth::user()->unreadNotifications->count() }} --}}
                                        </span>
                                    {{-- @else --}}
                         {{-- icon for no message --}}
                                        <i class="fa-solid fa-anchor"></i>
                                    {{-- @endif --}}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><h1 class="h6 text-center text-dark">any news?</h1></li>
                                    {{-- @if(Auth::user()->unreadNotifications->isEmpty()) --}}
                          {{-- Message when there are no notifications --}}
                                         <li><p class="text-center"><i class="fa-regular fa-face-meh"></i> not yet</p></li>
                                    {{-- @else --}}
                                        <li>
                                            {{-- Link to mark all as read --}}
                                            <a href="{{ route('mark-as-read') }}" class="dropdown-item text-turquoise"><i class="fa-solid fa-circle-dot"></i> Mark all as read</a>
                                        </li>
                                        <li>
                                            <div class="overflow-y-auto" style="max-height: 250px;">
                                                {{-- @foreach (Auth::user()->unreadNotifications as $notification)
                                                    <div class="d-flex flex-row align-items-center justify-content-between border-bottom p-2 {{ $loop->iteration % 2 == 0 ? 'bg-green' : 'bg-white' }}">
                                                        <a href="{{ route('users.posts.show', $notification->data['post_id']) }}" class="font-bold text-decoration-none text-dark">
                                                            "{{ $notification->data['comment'] ?? 'Notification' }}"
                                                        </a>
                                                        <p class="xsmall my-auto">{{ $notification->created_at->diffForHumans() }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </li>

                                    @endif --}}
                                </ul>
                            </li>

                            {{-- Chat icon --}}
                            <li class="nav-item">
                                <a href="{{ route('chat.index') }}" class="nav-link text-white active" type="button"><i class="fa-solid fa-comments"></i></a>
                            </li>
                            {{-- Ship icon --}}
                            <li class="nav-item dropdown">
                                <a href="" class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" area-expanded="false">
                                    <i class="fa-solid fa-ship"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><h1 class="h6 text-center text-dark">Go to...</h1></li>
                                    <li><a href="{{ route('auth.postIndex') }}" class="dropdown-item">Post</a></li>
                                    <li><a href="{{ route('auth.communityIndex') }}" class="dropdown-item">Community</a></li>
                                </ul>
                            </li>
                            {{-- Create icon --}}
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" area-expanded="false">
                                    <i class="fa-solid fa-circle-plus"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><h1 class="h6 text-center text-dark">Create...</h1></li>
                                    <li><a href="{{ route('users.posts.create') }}" class="dropdown-item">Post</a></li>
                                    <li><a href="{{ route('communities.create') }}" class="dropdown-item">Community</a></li>
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
                                <ul class="dropdown-menu dropdown-menu-end">
                                    {{-- ADMIN CONTROLS --}}
                                    @can('admin')
                                        <li>
                                            <a href="{{ route('admin.support') }}" class="dropdown-item text-turquoise">
                                                <i class="fas fa-user-gear"></i> Admin
                                            </a>
                                        </li>

                                        <hr class="dropdown-divider">
                                    @endcan

                                    <li>
                                        <a href="{{ route('users.profile.edit', Auth::user()->id) }}" class="dropdown-item"><i class="fa-solid fa-pen-to-square"></i> Edit Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('inquiry.create') }}" class="dropdown-item"><i class="fa-solid fa-person-circle-question"></i> Support</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
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

        <main class="py-5 content-main">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    {{-- Admin Menu(optional) --}}
                    {{-- put admin menu positioned side by side --}}
                    @if (request()->is('admin/*'))
                        <div class="col-auto">
                            <div class="list-group">
                                <a href="{{ route('admin.support') }}" class="list-group-item btn-turquoise flex-fill {{ request()->is('admin/support') ? 'active' : '' }}">
                                    SUPPORT
                                </a>

                                <a href="{{ route('admin.categories')}}" class="list-group-item btn-turquoise flex-fill {{ request()->is('admin/categories') ? 'active' : '' }}">
                                    CATEGORIES
                                </a>

                                <a href="#" class="list-group-item btn-turquoise flex-fill {{ request()->is('admin/users') ? 'active' : '' }}">
                                    USERS
                                </a>

                                <a href="#" class="list-group-item btn-turquoise flex-fill {{ request()->is('admin/posts') ? 'active' : '' }}">
                                    POSTS
                                </a>

                                <a href="#" class="list-group-item btn-turquoise flex-fill {{ request()->is('admin/communities') ? 'active' : '' }}">
                                    COMMUNITIES
                                </a>
                            </div>
                        </div>
                    @endif

                    {{-- Main Content --}}
                    @if (request()->is('admin/*'))
                        <div class="col-9">
                            @yield('content')
                        </div>
                    @else
                        <div class="col-11">
                            @yield('content')
                        </div>
                    @endif
                </div>
            </div>
        </main>

        <div class="footer bg-turquoise">
            <p class="text-white text-center my-auto">&copy; 2024 SHIP, inc</p>
        </div>
    </div>
    @yield('scripts')
</body>
</html>
