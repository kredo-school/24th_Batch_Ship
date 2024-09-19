@extends('layouts.app')

@section('title', 'Chat')
    
@section('content')
    <h1>Chat</h1>
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">
                                <div class="p-3">
                                    <div class="input-group rounded mb-3">
                                        <input type="search" name="chat-search" id="chat_search" class="form-control rounded" placeholder="Search">
                                        <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection