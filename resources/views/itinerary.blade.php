@extends('layouts.main')

@section('content')
<create-itinerary :data='@json($data)' >

</create-itinerary>
<days-itinerary :options='@json($data)':days='@json($total_days)'/>


@endsection
