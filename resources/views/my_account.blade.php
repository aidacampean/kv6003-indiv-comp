@extends('layouts.main')

@section('content')
@include('partials/alerts')
@foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible" role="alert" aria-live="polite" aria-atomic="true">
    {{ $error }}
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span>&times;</span>
    </button>
</div>
@endforeach 
<div class="row justify-content-center">
    <i class="mt-5 fa-regular fa-circle-user fa-5x"></i>
</div>

<div class="row">
    <div class="card mt-5 display-center">
        <form method="POST" class="text-center" action="{{ route('store-email') }}">
        @csrf
            <h1 class="display-6 mt-3">Update Email</h1>
            <div class="row justify-content-sm-center mt-5">
                <div class="col-sm-9">
                    <label for="email">Current email address: {{ $account['email'] }}</label><br>
                </div>
                <div class="col-sm-9 mt-3">
                    <label for="email">Change email address</label>
                    <i class="fa-solid fa-pen" type="submit"></i>
                    <input id="email" placeholder="New email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                </div>
                <div class="col-sm-9 mt-3">
                    <label for="email">Change username</label>
                    <i class="fa-solid fa-pen" type="submit"></i>
                    <input id="username" placeholder="New username" type="text" class="form-control" name="username" value="{{ old('username') }}">
                </div>
            </div>
            <button type="submit" class="btn btn-outline-secondary btn-lg w-75 mt-5 border border-1 shadow">Save</button>        
        </form>
    </div>
    <div class="card mt-5 display-center">
        <form method="POST" class="text-center" action="{{ route('store-password') }}">
            @csrf
            <h1 class="display-6 mt-3">Update Password</h1>
            <div class="row justify-content-sm-center mt-5">
                <div class="col-sm-9 mt-4">
                    <label for="password" type="submit">Change password</label>
                    <i class="fa-solid fa-pen" type="submit"></i>
                    <input id="password" placeholder="Current password" type="password" class="form-control" name="current_password">
                </div>
            
                <div class="col-sm-9 mt-4">
                    <input id="password" placeholder="New password" type="password" class="form-control" name="new_password">
                </div>
            
                <div class="col-sm-9 mt-4">
                    <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation">
                </div>
            </div>
            <button type="submit" class="btn btn-outline-secondary btn-lg w-75 mt-5 border border-1 shadow">Save</button>        
        </form>
    </div>
</div>
@endsection