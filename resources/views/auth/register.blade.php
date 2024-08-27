@extends('layouts.app')

@section('content')
<div class="container-fluid h-100">
    <div class="row justify-content-center border border-2">
     <div class="col-md bg-turquoise d-flex justify-content-center align-items-center">
        <div class="logo">logo</div>
     </div>
     <div class="col-md w-100">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h1 class="fw-bold mt-3" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Create an accoungt</h1>
            <div class="row">
                <div class="col-md mb-3">
                    <input id="first_name" type="text" class="form-control bg-yellow @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('name') }}" required autocomplete="first_name"  placeholder="First Name" autofocus >

                             @error('first_name')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                 </div>
                 <div class="col-md mb-3">
                    <input id="last_name" type="text" class="form-control bg-yellow @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name"  placeholder="Last Name" autofocus >

                             @error('last_name')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                 </div>
            </div>
            <div class="mb-3">
                <input type="text" name="username" id="" class="form-control @error('username') is-invalid @enderror" placeholder="Username" autofocus>
                @error('username')
                 <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                 </span>
                @enderror
            </div>
            <div class="mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                @error('email')
                 <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                 </span>
                @enderror
             </div>

            <div class="mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter your password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success w-100 bg-turquoise">Create</button>
            </div>
            <div class="mb-3 text-center fw-bold">
                <p>Already have an account? <a href="#" class="text-decoration-none text-success">Log in</a> </p>
            </div>
        </form>
     </div>
    </div>{{-- row --}}
</div> {{-- container --}}
@endsection
