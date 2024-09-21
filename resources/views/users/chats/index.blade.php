@extends('layouts.app')

@section('title', 'Chat')
    
@section('content')
    <h1>Chat</h1>
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-md-12">
                {{-- outline --}}
                <div class="card" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="row">
                            {{-- LEFT SIDE --}}
                            <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">
                                <div class="p-3">

                                    {{-- search form --}}
                                    <div class="input-group rounded mb-3">
                                        <input type="search" name="chat-search" id="chat_search" class="form-control rounded" placeholder="Search">
                                        <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
                                    </div>

                                    {{-- user list --}}
                                    <div data-mdb-perfect-scrollbar-init="true" style="position: relative; height: 400px;">
                                        <ul class="list-unstyled mb-0">
                                            <li class="p-2 border-bottom">
                                                <a href="#" class="d-flex justify-content-between text-decoration-none">
                                                    <div class="d-flex flex-row">
                                                        <div class="div">
                                                            {{-- <img src="#" alt="#" class="d-flex align-self-center me-3" width="60"> --}}
                                                            <i class="fa-solid fa-circle-user text-secondary d-flex align-self-center me-3" width="60"></i>
                                                        </div>
                                                        <div class="pt-1">
                                                            <p class="fw-bold mb-0">UserName</p>
                                                            <p class="small text-muted">Message</p>
                                                        </div>
                                                    </div>
                                                    <div class="pt-1">
                                                        <p class="small text-muted mb-1">Time</p>
                                                        <span class="badge bg-danger rounded-pill float-end">1</span>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>

                            {{-- RIGHT SIDE --}}
                            <div class="col-md-6 col-lg-7 col-xl-8">
                                <div class="pt-3 pe-3" data-mdb-perfect-scrollbar-init="true" style="position: relative; height: 400px;">
                                    {{-- recieved message --}}
                                    <div class="d-flex flex-row justify-content-start">
                                        {{-- <img src="#" alt="#" style="width: 45px; height: 100%;"> --}}
                                        <i class="fa-solid fa-circle-user text-secondary d-flex align-self-center me-3" width="60"></i>
                                        <div class="div">
                                            <p class="small p-2 ms-3 mb-1 text-white rounded-3 bg-secondary">text</p>
                                            <p class="small ms-3 mb-3 rounded-3 text-muted float-end">12:00 PM | Sep 20</p>
                                        </div>
                                    </div>

                                    {{-- sent message --}}
                                    <div class="d-flex flex-row justify-content-end">
                                        <div class="div">
                                            <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">text</p>
                                            <p class="small me-3 mb-3 rounded-3 text-muted ">13:00 PM | Sep 20</p>
                                        </div>
                                        {{-- <img src="#" alt="#" style="width: 45px; height: 100%;"> --}}
                                        <i class="fa-solid fa-circle-user text-secondary d-flex align-self-center me-3" width="60"></i>
                                    </div>
                                </div>

                                {{-- input message  --}}
                                <div class="text-muted d-flex justify-content-start align-items-center pe-3 pt-3 mt-2">
                                    {{-- <img src="#" alt="#" style="width: 40px: height: 100%;"> --}}
                                    <i class="fa-solid fa-circle-user text-secondary d-flex align-self-center me-3" width="60"></i>
                                    <input type="text" name="chattext" id="chattext" class="form-control form-control-lg" placeholder="Type message.">
                                    <a href="#" class="ms-2 text-muted"><i class="fas fa-paperclip"></i></a>
                                    <a href="#" class="ms-3 text-muted"><i class="fas fa-smile"></i></a>
                                    <a href="#" class="ms-3"><i class="fas fa-paper-plane"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection