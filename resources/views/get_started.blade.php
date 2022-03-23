@extends('layouts.welcome')

@section('content')
        <div class="mx-auto text-white">
            <h1 class="display-1">TravelPlanner</h1>
            <p class="display-7 mt-3">A travel planning tool that will guide you to your Romanian destination</p>
            <div class="row">
		        <div class="col">
                    @auth
                        <a href="{{ route('home') }}" class="btn mt-3 text-white border border-1 shadow button btn-outline-secondary btn-lg rounded-pill">Home</a>
                    @else
                        <a href="{{ route('register') }}" class="btn mt-3 text-white border border-1 shadow button btn-outline-secondary btn-lg rounded-pill">Get Started</a>
                        <a href="{{ route('login') }}" class="btn mx-3 mt-3 text-white border border-1 shadow button btn-outline-secondary btn-lg rounded-pill">Login</a>
                    @endauth
                </div>
            </div>
        </div>
@endsection
