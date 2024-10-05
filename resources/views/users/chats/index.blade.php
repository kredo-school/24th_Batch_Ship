@extends('layouts.app')

@section('title', 'Chat')

@section('scripts')
    {{-- JAVA SCRIPT --}}
    <script src="{{ asset('js/chat/scroll.js') }}"></script>
@endsection
    
@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('css/style_chat.css') }}">
</head>

    <h1>Chat</h1>

    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-md-12">
                {{-- outline --}}
                <div class="card chat-card">
                    <div class="card-body">
                        <div class="row">
                            {{-- LEFT SIDE --}}
                            <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">
                                <div class="p-3">

                                    {{-- search form --}}
                                    {{-- <div class="input-group rounded mb-3">
                                        <input type="search" name="chat-search" id="chat_search" class="form-control rounded" placeholder="Search">
                                        <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
                                    </div> --}}

                                    {{-- user list --}}
                                    <div class="overflow-auto  chat-outline">
                                        <ul class="list-unstyled mb-0">
                                            @forelse ($all_chats as $chat)
                                                <li class="p-2 border-bottom">
                                                    @if ($chat->sender_id == Auth::user()->id)
                                                        {{-- when Auth user is a sender --}}
                                                        <a href="{{ route('chat.show', $chat->recipient->id) }}" class="d-flex justify-content-between text-decoration-none">
                                                            <div class="d-flex flex-row">
                                                                @if ($chat->recipient->avatar)
                                                                    <img src="{{ $chat->recipient->avatar }}" alt="{{ $chat->recipient->name }}" class="d-flex align-self-center me-3 rounded-circle avatar-sm">
                                                                @else
                                                                    <i class="fa-solid fa-circle-user text-secondary d-flex align-self-center me-3 icon-sm"></i>
                                                                @endif

                                                                <div class="pt-1">
                                                                    <p class="fw-bold mb-0 text-black">{{ $chat->recipient->username}}</p>
                                                                    <p class="small text-muted">{{$chat->latestMessage->text}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="pt-1">
                                                                <p class="small text-muted mb-1">{{ date('Y-m-d H:i', strtotime($chat->latestMessage->updated_at))}}</p>
                                                                @if ($chat->unread_count > 0)
                                                                    <span class="badge bg-danger rounded-pill float-end">{{ $chat->unread_count }}</span>
                                                                @endif
                                                            </div>
                                                        </a>
                                                    @else
                                                        {{-- when auth user is a recipient --}}
                                                        <a href="{{ route('chat.show', $chat->sender->id) }}" class="d-flex justify-content-between text-decoration-none">
                                                            <div class="d-flex flex-row">
                                                                @if ($chat->sender->avatar)
                                                                    <img src="{{ $chat->sender->avatar }}" alt="{{ $chat->sender->name }}" class="d-flex align-self-center me-3 rounded-circle avatar-sm">
                                                                @else
                                                                    <i class="fa-solid fa-circle-user text-secondary d-flex align-self-center me-3 icon-sm"></i>
                                                                @endif
                                                
                                                                <div class="pt-1">
                                                                    <p class="fw-bold mb-0 text-black">{{ $chat->sender->username}}</p>
                                                                    <p class="small text-muted">{{$chat->latestMessage->text}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="pt-1">
                                                                <p class="small text-muted mb-1">{{ date('Y-m-d H:i', strtotime($chat->latestMessage->updated_at))}}</p>
                                                                @if ($chat->unread_count > 0)
                                                                    <span class="badge bg-danger rounded-pill float-end">{{ $chat->unread_count }}</span>
                                                                @endif
                                                            </div>
                                                        </a>
                                                    @endif
                                                </li>
                                            @empty
                                                <h3 class="text-secondary text-center"> No chats yet.</h3>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            {{-- RIGHT SIDE --}}
                            <div class="col-md-6 col-lg-7 col-xl-8">

                                {{-- recipient's avatar and name --}}
                                <div class="d-flex justify-content-start align-items-center pe-3 pt-3 my-2">
                                    <a href="{{ route('users.profile.specificProfile', $profile_id) }}" class="d-flex justify-content-between text-decoration-none">
                                        @if ($recipientData->avatar)
                                            <img src="{{ $recipientData->avatar }}" alt="{{ $recipientData->name }}" class="d-flex align-self-center me-3 rounded-circle avatar-sm" width="60">
                                        @else
                                            <i class="fa-solid fa-circle-user text-secondary d-flex align-self-center me-3 icon-sm" width="60"></i>
                                        @endif
                                    </a>
                                    <p class="h4 fw-bold text-black">{{ $recipientData->username }}</p>
                                </div>

                                <hr>

                                <div class="pt-3 pe-3 chat-outline overflow-auto" id="scroll-inner">
                                    @foreach ($all_messages as $chat_messages)
                                        {{-- sent message --}}
                                        @if ($chat_messages->user_id == Auth::user()->id)
                                            <div class="d-flex flex-row justify-content-end">
                                                @if ($chat_messages->user->avatar)
                                                    <img src="{{ $chat_messages->user->avatar }}" alt="{{ $chat_messages->user->name }}" class="d-flex align-self-center me-3 rounded-circle avatar-sm">
                                                @else
                                                    <i class="fa-solid fa-circle-user text-secondary d-flex align-self-center me-3 icon-sm"></i>
                                                @endif
                                                <div class="div">
                                                    <p class="small p-2 ms-3 mb-1 text-white rounded-3 bg-success">{{ $chat_messages->text }}</p>
                                                    <p class="small ms-3 mb-3 rounded-3 text-muted float-end">{{ date('Y-m-d H:i', strtotime($chat_messages->created_at))}}</p>
                                                </div>
                                            </div>
                                        @else
                                            {{-- recieved message --}}
                                            <div class="d-flex flex-row justify-content-start">
                                                @if ($chat_messages->user->avatar)
                                                    <img src="{{ $chat_messages->user->avatar }}" alt="{{ $chat_messages->user->name }}" class="d-flex align-self-center me-3 rounded-circle avatar-sm">
                                                @else
                                                    <i class="fa-solid fa-circle-user text-secondary d-flex align-self-center me-3 icon-sm"></i>
                                                @endif
                                                <div class="div">
                                                    <p class="small p-2 ms-3 mb-1 text-white rounded-3 bg-secondary">{{ $chat_messages->text }}</p>
                                                    <p class="small ms-3 mb-3 rounded-3 text-muted float-end">{{ date('Y-m-d H:i', strtotime($chat_messages->created_at))}}</p>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <hr>

                                {{-- input message  --}}
                                <div class="text-muted d-flex justify-content-start align-items-center pe-3 pt-3 mt-2">

                                    {{-- recipient's avatar --}}
                                    {{-- <a href="{{ route('users.profile.specificProfile', $profile_id) }}" class="d-flex justify-content-between text-decoration-none">
                                        @if ($recipientData->avatar)
                                            <img src="{{ $recipientData->avatar }}" alt="{{ $recipientData->name }}" class="d-flex align-self-center me-3 rounded-circle avatar-sm" width="60">
                                        @else
                                            <i class="fa-solid fa-circle-user text-secondary d-flex align-self-center me-3 icon-sm" width="60"></i>
                                        @endif
                                    </a> --}}

                                    <form action="{{ route('chat.store', $profile_id) }}" method="post" class="row align-items-center w-100">
                                        @csrf

                                        <div class="col-9">
                                            <input type="text" name="text" id="text" class="form-control form-control-lg" placeholder="Type message.">
                                        </div>
                                        <div class="col-3">
                                            <a href="#" class="ms-2 text-muted"><i class="fas fa-paperclip"></i></a>
                                            <a href="#" class="ms-3 text-muted"><i class="fas fa-smile"></i></a>
                                            <button type="submit" class="btn btn-outline-none text-secondary"><i class="fas fa-paper-plane"></i></button>
                                            {{-- <a href="#" class="ms-3"><i class="fas fa-paper-plane"></i></a> --}}
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection