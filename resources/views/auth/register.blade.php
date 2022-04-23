@extends('layouts.welcome')

@section('content')
<main class="form bg-white">
<form novalidate method="POST" action="{{ route('register') }}">
    @csrf
        <h1 class="display-6 pt-5">REGISTER</h1>

        <div class="row justify-content-center pt-4">
            <div class="col-sm-9">
            <input id="name" placeholder="Full Name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row justify-content-center pt-3">
            <div class="col-sm-9">
                <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row justify-content-center pt-3">
            <div class="col-sm-9">
                <input id="username" placeholder="Username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username">
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row justify-content-center pt-3">
            <div class="col-sm-9">
                <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row justify-content-center pt-3">
            <div class="col-sm-9">
                <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation">
            </div>
        </div>

        <div class="row justify-content-center pt-3">
            <div class="col-sm-9">
                <input id="invite-code" placeholder="Invite Code" type="text" class="form-control @error('invite-code') is-invalid @enderror" value="{{ old('invite-code') }}" name="invite-code">
                @error('invite-code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <!-- <div class="row justify-content-md-center pt-3">
            <button class="w-50 mt-4 border border-1 shadow" type="submit" variant="purpleButton" size="lg">Submit </button>
        </div> -->
        <div class="row justify-content-center">
            <button type="submit" class="btn btn-outline-secondary btn-lg w-50 mx-5 my-5 border border-1 shadow">Submit </button>
        </div>
    </form>
</main>
@endsection
