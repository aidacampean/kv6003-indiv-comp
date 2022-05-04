@extends('layouts.welcome')

@section('content')
@include('partials/alerts')
<main class="form-login bg-white">
<form novalidate method="POST" action="{{ route('login') }}">
    @csrf
        <h1 class="display-6 pt-5">LOGIN</h1>

        <div class="row justify-content-md-center pt-3">
            <div class="col-sm-9">
                <input
                    id="username"
                    placeholder="Username or email"
                    type="text"
                    class="form-control {{ $errors->has('username') || $errors->has('email') ? 'is-invalid' : ''}}"
                    name="username"
                    value="{{ old('username') ?: old('email') }}"
                    autocomplete="username"
                >
                @if ($errors->has('username') || $errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                    </span>
                @endif
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
