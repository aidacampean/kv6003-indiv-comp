@extends('layouts.main')

@section('content')
    <h2>Plan a Trip</h2>
    <hr>
    <create-trip :options='@json($data)'/>

@endsection