@extends('layouts.welcome')

@section('content')
<main class="form bg-white">
<form method="POST" action="{{ route('register') }}">
    @csrf
        <h1 class="display-6 pt-5">REGISTER</h1>

        <div class="row justify-content-md-center pt-4">
            <div class="col-sm-9">
                <input id="name" placeholder="Full Name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

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
                <input id="username" placeholder="Username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
                @error('username')
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
        <div class="row justify-content-md-center pt-3">
            <div class="col-sm-9">
                <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>   

        <!-- <div class="row justify-content-md-center pt-3">
            <button class="w-50 mt-4 border border-1 shadow" type="submit" variant="purpleButton" size="lg">Submit </button>
        </div> -->
        <div class="row justify-content-md-center">
            <button type="submit" class="btn btn-outline-secondary btn-lg w-50 mt-5 border border-1 shadow">Submit </button>        
        </div>
    </form>
</main>
@endsection
