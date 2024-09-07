@extends('layouts.app')

@section('title','community')
@section('content')
    
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
            
            
            <div class="d-flex justify-content-between">
                <div class="row">
                    <div class="col">

                        {{-- gonna repeat --}}
                        <div class="card border-0 rounded">
                            @foreach ($all_communities as $community)
                                
                            
                                <div class="card-body">
                                    {{-- image --}}
                                    <div>
                                        <a href="{{route('communities.show',$community->id)}}"><img class="img-fluid rounded" src="https://cdn.pixabay.com/photo/2020/11/05/02/38/fairy-5714032_1280.jpg" alt=""></a>
                                    </div>
                                    {{-- community name & owner --}}
                                    <div class="row">
                                        <h3 class="col">{{ $community->title }}</h3> 
                                        <p class="col text-end">created by <i class="fa-solid fa-circle-user"></i></p>
                                    </div>
                                    {{-- category --}}
                                    <div class="row text-start">
                                        <div class="col">
                                            <span class="badge me-1 bg-turquoise text-white">Anime</span> 
                                            <span class="badge me-1 bg-turquoise text-white">Culture</span> 
                                        </div>
                                        
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        
                    </div>

                   
                </div>
                

                


            </div>
            

        </div>
        



            
        </div>
    
@endsection