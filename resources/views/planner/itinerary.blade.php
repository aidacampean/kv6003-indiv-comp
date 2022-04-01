@extends('layouts.main')

@section('content')
    <a class="align btn green" href="{{ route('invite', ['id' => $data['id']]) }}">+ Invite people</a>
    <create-itinerary :trip='@json($data)' />
@endsection
