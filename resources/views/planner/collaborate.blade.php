@extends('layouts.main')

@section('content')
<div class="p-5 container-fluid collaborate">

    <a href="{{  route('itinerary', ['id' => $trips->id]) }}" class="btn btn-dark mb-3">
        <i class="fa-solid fa-circle-left mr-2"></i>
        Back to Itinerary
    </a>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page">Home</li>
            <li class="breadcrumb-item active" aria-current="page">Tester</li>
        </ol>
    </nav>
    <h2>Manage Collaboration for {{ $trips['name'] }}</h2>
    <hr>
    <div class="row">
        <div class="col-8">
            <div class="collaborate-users border p-3">
                <h3 style="background-color: #61970b; padding: 15px; color: #FFF;"><i class="fa-solid fa-user fa-sm mr-3"></i>Users</h3>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Status</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($trips->collaborators->count() == 0)
                            <tr>
                                <td colspan="3">
                                    There are no collaborators for this trip
                                </td>
                            </tr>
                        @else
                            @foreach($trips['collaborators'] as $collaborator)
                            <tr>
                                <td>{{ $collaborator['username'] }}</td>
                                <td>{{ $collaborator['status'] }}</td>
                                <td><a class="btn btn-danger" href="{{ route('destroy-collaborator', $collaborator['id']) }}">Remove</a></td>
                            </tr>
                            @endforeach
                        @endif

                        @if (session()->has('success')) 
                            <div role="alert alert-dismissible alert-danger" role="alert" aria-live="polite" aria-atomic="true">
                                {{ session('success') }}
                            </div>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-3 ml-auto">
            <div class="collaborate-invites border shadow-sm p-3">
                <h3><i class="fa-solid fa-envelope fa-sm mr-2"></i>Invitations</h3>
                <hr class="shadow">
                <div class="content">
                    There are no pending invites
                </div>
                <div class="footer">
                    <a class="text-white btn btn-secondary" href="{{ route('invite', ['id' => $trips['id']] ) }}">

                        <!-- add edit icon -->
                        <i class="fa-solid fa-paper-plane-top"></i>
                        Invite
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection