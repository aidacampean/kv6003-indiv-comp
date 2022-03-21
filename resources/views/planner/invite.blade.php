@extends('layouts.main')

@section('content')
    <div class="p-5 container">
            <h2>
                Invite a user
                <span style="font-size: 18px; color: Dodgerblue;" v-b-tooltip.hover title="Send an invitation to collaborate">
                    <i class="fa-solid fa-circle-info"></i>
                </span>
            </h2>
            <hr>
            <div class="card p-2">
            @if(Session::has('success'))
                <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    {{Session::get('success')}}
                </div>
            @endif
                 <!-- @if (session()->has('error'))
                <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    {{ session('error') }}
                </div>
                @endif  -->

                @if ($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    {{ session('error') }}
                </div>
                @endif

                <div class="card-body">
                    <form name="invite" class="form-inline justify-content-md-center" method="POST" action="{{ route('store-invite', ['id' => $tripId]) }}">
                        @csrf
     
                        <!-- <div id="input-group-1" role="group" class="form-group mx-3 pt-4"> -->
                            <!-- <label for="email">Email address</label> -->
                            <input id="email" type="text" name="email" placeholder="Enter email address" required="required" style="width: 500px;" aria-required="true" class="form-control form-control-lg mx-3">
                            
                        <button type="submit" class="btn btn-dark">
                            Send Invite
                        </button>
                        
                        <!-- </div> -->

                    </form>
                </div>
            </div>

    </div>
@endsection