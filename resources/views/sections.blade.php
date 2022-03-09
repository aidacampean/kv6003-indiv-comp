@extends('layouts.main')

@section('content')
<sections-itinerary :sections='@json($data)' /></sections-itinerary>

@endsection
