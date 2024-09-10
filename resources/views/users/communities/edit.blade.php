@extends('layouts.app')

@section('title','Edit Community')

@section('content')

<head>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style_postshow.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style_category.css') }}">

</head>

    <form action="{{route('communities.update',['id'=>$community->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="container-fluid p-4 rounded bg-blue">
            <h1 class="mb-4">Edit Community</h1>
        
            <div class="container-fluid px-5 py-3 rounded" style="background-color: #f5f5f5;">
                <div class="row mb-3">
                                    {{-- Community Title --}}
        
                    <label for="title" class="form-label d-block fw-bold">Community Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{old('title',$community->title)}}">
                </div>
                
        
                <div class="row mb-3">
                                    {{-- Description --}}
        
                    <label for="description" class="form-label d-block fw-bold">Description</label>
                    <textarea name="description" id="description" cols="30" rows="3" class="form-control" >{{ old('description', $community->description)}}</textarea>
                    {{-- Error --}}
                    @error('description')
                        <div class="text-danger small">{{ $message}}</div>
                        
                    @enderror
                </div>
        
                <div class="row mb-3">
                                    {{-- Cover photo --}}
                    <div class="col-6">
                        <label for="image" class="form-label d-block fw-bold">Cover Photo</label>
                    <img src="{{ $community->image}}" alt="Community ID {{ $community->id}}" class="w-100 img-thumbnail">
                    <input type="file" name="image" id="image" class="form-control" aria-describedby="image-info">
                        <div id="image-info" class="form-text">
                            Acceptable formats are jpeg, jpg, png, gif only .
                            <br>
                            Max file size is 1048kb.
                        </div>
                        {{-- Error --}}
                        @error('image')
                            <div class="text-danger small">{{ $message}}</div>
                        
                        @enderror
                    </div>
                    
                </div>
        
                <div>
                                    {{-- Category --}}
        
                    <label for="category" class="form-label d-block fw-bold">
                        Category <span class="fw-normal">(up to 3)</span>
                    </label>
                    
                                    {{-- gonna repeat --}}
                    <div class="rounded bg-white overflow-scroll" style="max-height:150px;" >
                        <div class="m-3 scroll-container ">
                            <div class="category">
                                <table>
                                    <tr>
                                        <td>
                                            @foreach($all_categories as $category)
                                                @if (in_array($category->id, $selected_categories))
                                                    <input type="checkbox" name="category[]" value="{{ $category->id }}" id="{{ $category->name }}" name="{{ $category->id }}" autocomplete="off" checked>
                                                @else
                                                    <input type="checkbox" name="category[]" value="{{ $category->id }}" id="{{ $category->name }}" name="{{ $category->id }}" autocomplete="off">
                                                @endif
                                                
                                                <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
        
                                            @endforeach
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    
        
                    {{-- Error --}}
                    @error('category')
                        <div class="text-danger small">{{ $message}}</div>
                        
                    @enderror
                </div>
            </div>
        
            {{-- Submit btn --}}
            <div class="mt-4">
                <div class="row">
                    <div class="col">
                        <a href="{{route('communities.show', ['id'=>$community->id])}}" class="btn fw-bold text-turquoise">CANCEL</a>
                    </div>
                    <div class="col text-end">
                        <button type="submit" class="btn btn-turquoise btn-sm px-4 text-white">EDIT</button>
                    </div>
                </div>
            </div>    
            
            
        </div>

        
        
        

        
    </form>
@endsection