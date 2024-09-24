@extends('layouts.app')

@section('title','community')
@section('content')

<link rel="stylesheet" href="{{asset('css/style-community-show.css')}}">
    
        <div class="container-fluid p-3 rounded" style="background-color: #EDFAFD;">
            <div>
                <div class="row mt-3">
                    <div class="col">
                        <h1>Community</h1>
                    </div>
                    <div class="col">
                        <form action="">
                            <a href="{{route('communities.create')}}" class="btn btn-gold btn-lg fw-bold float-end">NEW <i class="fas fa-plus"></i></a>
                        </form>
                        
                    </div>
                </div>
            </div>
            

            <div style="margin-top: 80px">
                @if ($all_communities->isNotEmpty())
                    <div class="row row-eq-height">
                        @foreach ($all_communities as $community)
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="card rounded border-0 h-100 d-flex flex-column">
                                    {{-- image --}}
                                    <div class="mb-2">
                                        <a href="{{ route('communities.show',$community->id) }}">
                                            <img src="{{ $community->image }}" alt="Community ID {{ $community->id }}" class="fixed-size-img rounded card-img-top">
                                        </a>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        {{-- community name & owner --}}
                                        <div class="row mb-2 ms-1">
                                            {{-- title --}}
                                            <h3 class="col card-title">{{ $community->title }}</h3>
                                            {{-- owner --}}
                                            <p class="col card-text text-end">created by
                                                <a href="{{ route('users.profile.specificProfile',$community->owner_id) }}">
                                                    @if ($community->user->avatar)
                                                        <img src="{{ $community->user->avatar }}" alt="#" class="rounded-circle avatar-sm">
                                                    @else
                                                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                                    @endif
                                                </a>
                                            </p>
                                        </div>
                                        {{-- category --}}
                                        <div class="row card-text text-start ms-1 mt-auto">
                                            <div class="col">
                                                @if ($community->categories)
                                                @foreach ($community->categories as $category)
                                                <a href="{{ route('users.categories.show', $category->id) }}" class="badge me-1 bg-turquoise text-decoration-none">{{ $category->name }}</a>
                                                @endforeach
                                              @else
                                                  <span class="badge bg-turquoise mt-1">Uncategorized</span>
                                              @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        @endforeach
                    </div>
                @else
                    <h3 class="text-secondary text-center">No Posts Yet</h3>
                @endif
            </div>

        </div>
        



            
        </div>
    
@endsection