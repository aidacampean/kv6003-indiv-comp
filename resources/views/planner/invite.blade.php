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
    <div class="p-5 container">
        <h2>
            Invite a user
            <span style="font-size: 18px; color: Dodgerblue;" v-b-tooltip.hover title="Send an invitation to collaborate">
                <i class="fa-solid fa-circle-info"></i>
            </span>
        </h2>
        <hr>
        <div class="card p-2">
            <div class="card-body">
                <form name="invite" class="form-inline justify-content-md-center" method="POST" action="{{ route('store-invite', ['id' => $tripId]) }}">
                    @csrf
    
                    <!-- <div id="input-group-1" role="group" class="form-group mx-3 pt-4"> -->
                        <!-- <label for="email">Email address</label> -->
                    <input
                        id="email"
                        type="text"
                        name="email"
                        placeholder="Enter email address"
                        required="required"
                        style="width: 500px;"
                        aria-required="true"
                        class="form-control form-control-lg mx-3"
                        value="{{old('email')}}"
                    />

                    <button type="submit" class="btn btn-dark">
                        Send Invite
                        <i class="fa-solid fa-paper-plane ml-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection