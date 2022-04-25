@extends('layouts.main')

@section('content')
    @if ($data['tasks'])
        <h5>Tasks: <span class="badge badge-primary">{{ $data['tasks'][0]['task1'] }}</span> <span class="badge badge-info">{{ $data['tasks'][0]['task2'] }}</span></h5>
    @endif

    @if ($data['user_id'] == Auth::user()->id)
        <a class="align btn green text-white" href="{{ route('invite', ['id' => $data['id']]) }}">+ INVITE PEOPLE</a>
    @endif
    <create-itinerary :trip='@json($data)' />
    <p>
</p>
@endsection

