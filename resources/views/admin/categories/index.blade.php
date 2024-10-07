@extends('layouts.app')

@section('title','Admin: Categories')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection
@section('content')



<div class="bg-blue">
    <div class="container">
        <div class="row justify-content-center p-5">
            <form action="{{ route('admin.categories.store')}}" method="post">
                @csrf
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" value="{{old('name')}}" name="name" placeholder="Add a category" autofocus>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-gold"><i class="fa-solid fa-plus me-1"></i>Add</button>
                    </div>
                </div>
                @error('name')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </form>
            
           
                <div>
                    <table class="table-blue custom-table-hover">
                        
                        <tbody>
                            @foreach ($all_categories as $category)
                                <tr>
                                    <td class="category-id pe-3">{{$category->id}}</td>
                                    <td class="category-name">{{$category->name}}</td>
                                    <td class="extra-space">
                                        <button class="btn btn-outline-gold action-icons" data-bs-toggle="modal" data-bs-target="#update-category-{{$category->id}}">
                                            <i class="fa-solid fa-pencil "></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-gold  action-icons" data-bs-toggle="modal" data-bs-target="#delete-category-{{$category->id}}">
                                            <i class="fa-solid fa-trash-can "></i>
                                        </button>
                                    </td>
                                </tr>
                                @include('admin.categories.modals.action')
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
          
        </div>
        
    </div>
    
</div>

@endsection