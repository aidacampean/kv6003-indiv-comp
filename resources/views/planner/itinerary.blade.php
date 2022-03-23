@extends('layouts.main')

@section('content')
    <create-itinerary :trip='@json($data)' />
@endsection
