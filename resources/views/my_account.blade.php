@extends('layouts.main')

@section('content')
<div class="row justify-content-center">
    <i class="mt-5 fa-regular fa-circle-user fa-5x"></i>
</div>

@foreach ($errors->all() as $error)
    <p class="text-danger">{{ $error }}</p>
@endforeach 

<div class="row">
    <div class="card mt-5 center">
        <form method="POST" class="text-center" action="{{ route('store-email') }}">
        @csrf
            <h1 class="display-6 mt-4">Update Email</h1>
                <div class="row justify-content-md-center pt-4">
                    <div class="col-sm-9">
                        <label for="email">Current email address: {{ $account['email'] }}</label><br>
                        <label for="email">Change email address</label>
                        <i class="fa-solid fa-pen" type="submit"></i>
                        <input id="email" placeholder="New email" type="email" class="form-control" name="email" value="" required autocomplete="email">
                       
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <button type="submit" class="btn btn-outline-secondary btn-lg w-50 mt-5 border border-1 shadow">Save</button>        
                </div>
        </form>
    </div>
    <div class="card mt-5 center">
        <form method="POST" class="text-center" action="{{ route('store-password') }}">
            @csrf
            <h1 class="display-6 mt-4">Update Password</h1>
                <div class="row justify-content-md-center pt-3">
                    <div class="col-sm-9">
                    <label for="password" type="submit">Change password</label>
                    <i class="fa-solid fa-pen" type="submit"></i>
                        <input id="password" placeholder="Current password" type="password" class="form-control" value="" name="current_password" autocomplete="current-password">
                     
                    </div>
                </div>
                <div class="row justify-content-md-center pt-3">
                    <div class="col-sm-9">
                        <input id="password" placeholder="New password" type="password" class="form-control" value="" name="new_password" autocomplete="current-password">
                     
                    </div>
                </div>

                <div class="row justify-content-md-center pt-3">
                    <div class="col-sm-9">
                        <input id="password-confirm" placeholder="Confirm New Password" type="password" class="form-control" name="confirm_new_password" autocomplete="current-password">
                    </div>
                </div>   
                <!-- <div class="row justify-content-md-center pt-3">
                    <button class="w-50 mt-4 border border-1 shadow" type="submit" variant="purpleButton" size="lg">Submit </button>
                </div> -->
                <div class="row justify-content-md-center">
                    <button type="submit" class="btn btn-outline-secondary btn-lg w-50 mt-5 border border-1 shadow">Save</button>        
                </div>
        </form>
    </div>
</div>
@endsection