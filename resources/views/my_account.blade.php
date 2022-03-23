@extends('layouts.main')

@section('content')
<div class="row justify-content-center">
    <i class="mt-5 fa-regular fa-circle-user fa-5x"></i>
</div>

<div class="card mt-5 center">
<form method="POST" class="text-center" action="{{ route('store-details') }}">
    @csrf
        <h1 class="display-6">My Details</h1>

        <div class="row justify-content-md-center pt-4">
            <div class="col-sm-9">
                <label for="email">Current email address: {{ $email }}</label><br>
                <label for="email">Change email address</label>
                <i class="fa-solid fa-pen" type="submit"></i>
                <input id="email" placeholder="New email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row justify-content-md-center pt-3">
            <div class="col-sm-9">
                <label for="password" type="submit">Change password</label>
                <i class="fa-solid fa-pen" type="submit"></i>
                <input id="password" placeholder="New password" type="password" class="form-control @error('password') is-invalid @enderror" value="" name="password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row justify-content-md-center pt-3">
            <div class="col-sm-9">
                <input id="password-confirm" placeholder="Confirm New Password" type="password" class="form-control" name="password_confirmation">
            </div>
        </div>   
        <!-- <div class="row justify-content-md-center pt-3">
            <button class="w-50 mt-4 border border-1 shadow" type="submit" variant="purpleButton" size="lg">Submit </button>
        </div> -->
        <div class="row justify-content-md-center">
            <button type="submit" class="btn btn-outline-secondary btn-lg w-50 mt-5 border border-1 shadow">Submit </button>        
        </div>
    </form>
</div>
@endsection