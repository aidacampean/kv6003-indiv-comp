@extends('layouts.main')

@section('content')
<create-itinerary :trip='@json($data)' :days='@json($total_days)' /></create-itinerary>
<!-- <days-itinerary :trip='@json($data)' :days='@json($total_days)'></days-itinerary> -->

@endsection
