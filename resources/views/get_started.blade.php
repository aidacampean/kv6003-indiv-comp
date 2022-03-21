@extends('layouts.welcome')

@section('content')
    <b-container class="justify-content-md-center">
            <div class="mx-auto text-white">
                <h1 class="display-1">TravelPlanner</h1>
                <p class="display-7 mt-3">A travel planning tool that will guide you to your Romanian destination</p>
                <b-container>
                    <b-row>
                    <b-col>
                        <b-button href ="{{ route('register') }}" pill variant="outline-secondary" size="lg" class=" mt-3 text-white border border-1 shadow button">Get Started</b-button>
                        <b-button href ="{{ route('login') }}" pill variant="outline-secondary" size="lg" class="mx-3 mt-3 text-white border border-1 shadow button">Login</b-button>
                    </b-col>
                    </b-row>
                </b-container>
            </div>
    </b-container>
@endsection
