@extends('layouts.app')

@section('title','Create Community')

@section('content')


    <form action="#" method="community" enctype="multipart/form-data">
        @csrf

        <div class="container-fluid p-4 rounded" style="background-color: #EDFAFD;">
            <h1 class="mb-4">Create New Community</h1>
        
            <div class="container-fluid px-5 py-3 rounded" style="background-color: #f5f5f5;">
                <div class="row mb-3">
                                    {{-- Community Title --}}
        
                    <label for="title" class="form-label d-block fw-bold">Community Title</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                
        
                <div class="row mb-3">
                                    {{-- Description --}}
        
                    <label for="description" class="form-label d-block fw-bold">Description</label>
                    <textarea name="description" id="description" cols="30" rows="3" class="form-control" >{{ old('description')}}</textarea>
                    {{-- Error --}}
                    @error('description')
                        <div class="text-danger small">{{ $message}}</div>
                        
                    @enderror
                </div>
        
                <div class="row mb-3">
                                    {{-- Cover photo --}}
        
                    <label for="image" class="form-label d-block fw-bold">Cover Photo</label>
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
        
                <div>
                                    {{-- Category --}}
        
                    <label for="category" class="form-label d-block fw-bold">
                        Category <span class="fw-normal">(up to 3)</span>
                    </label>
                    
                                    {{-- gonna repeat --}}
                    <div class="rounded bg-white overflow-scroll" style="max-height:80px;" >
                        <div class="row m-1">
                            <div class="col-2">
                                <button class="btn bg-pink btn-sm fw-bold">Anime</button>
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
                        <a href="#" class="btn fw-bold text-turquoise">CANCEL</a>
                    </div>
                    <div class="col text-end">
                        <button type="submit" class="btn btn-turquoise btn-sm px-4">CREATE</button>
                    </div>
                </div>
            </div>    
            
            
        </div>

        
        
        

        
    </form>
@endsection