@extends('layouts.app')

@section('content')
<div class="container-fluid h-100">
    <div class="row justify-content-center border border-1 h-100">
        
        {{-- left side --}}
     <div class="col-md bg-turquoise d-flex justify-content-center align-items-center">
        <div class="logo text-center">
            <img src="assets/image/logo.png" class="w-50" alt="">
            <h1 class="text-white display-4 fw-bold">SHIP {{ Auth::user()->id ?? '' }}</h1>

        </div>
     </div>

        {{-- right side --}}
     <div class="col-md w-100 py-3">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h3 class="fw-bold mt-3 text-center py-3" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Welcome back to SHIP!</h1>

            <div class="mb-3">
                <label for="email" class="col-form-label text-md-end text-muted">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control bg-yellow @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                
                @error('email')
                 <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                 </span>
                @enderror
             </div>

            <div class="mb-5">
                <label for="password" class="col-form-label text-md-end text-muted">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control bg-yellow  @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
            <div class="my-3 pt-5">
                <button type="submit" class="btn bg-turquoise text-white w-100">
                        {{ __('Login') }}
                </button>
            </div>
        </form>
     </div>
    </div>{{-- row --}}
</div> {{-- container --}}

@endsection
