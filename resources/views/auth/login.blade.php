@extends('layouts.welcome')

@section('content')
<main class="form bg-white">
<form method="POST" action="{{ route('login') }}">
    @csrf
        <h1 class="display-6 pt-5">LOGIN</h1>

        <div class="row justify-content-md-center pt-3">
            <div class="col-sm-9">
                <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row justify-content-md-center pt-3">
            <div class="col-sm-9">
                <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="pt-3">
            <div class="col-sm-7">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" value="{{ old('remember') ? 'checked' : '' }}">
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
            </div>
        </div>
    
        <div class="justify-content-md-center">
            <button type="submit" class="btn btn-outline-secondary btn-lg w-50 mt-5 border border-1 shadow">{{ __('Login') }}</button>   
            @if (Route::has('password.request'))
                <a class="btn btn-link mt-3 d-block" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>
    </form>
</main>
@endsection
