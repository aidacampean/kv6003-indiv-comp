@extends('layouts.main')

@section('content')
    <a class="align btn green" href="{{ route('invite', ['id' => $data['id']]) }}">+ INVITE PEOPLE</a>
    <create-itinerary :trip='@json($data)' />
@endsection
