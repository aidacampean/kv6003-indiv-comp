@extends('layouts.main')

@section('content')
@include('partials/alerts')
<div class="p-5 container-fluid collaborate">
    <h2>Manage Collaboration for {{ $trip['name'] }}</h2>
    <hr>
    <div class="row">
        <div class="col-lg-8 col-sm-12 mb-sm-3">
            <div class="collaborate-users border p-3">
                <h3><i class="fa-solid fa-user fa-sm mr-3"></i>Users</h3>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="lg-5 col-sm-2">Name</th>
                            <th class="lg-6 col-sm-2">Email</th>
                            <th class="lg-1 col-sm-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @empty($trip['trip_collaborators'])
                            <tr>
                                <td colspan="3">
                                    There are no collaborators for this trip
                                </td>
                            </tr>
                        @else
                            @foreach($trip['trip_collaborators'] as $userTrip)
                                <tr>
                                    <td class="col-5 align-middle">@php echo $userTrip['user']['name'] @endphp</td>
                                    <td class="col-5 align-middle">@php echo $userTrip['user']['email'] @endphp</td>
                                    <td class="col-2 align-middle">
                                        <a
                                            class="text-white btn btn-secondary"
                                            href="{{ route('destroy-collaborator', ['id' => $userTrip['trip_id'], 'ut_id' => $userTrip['id']] ) }}"
                                            onclick="return confirm('Are you sure?')"
                                        >
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12">
            <div class="collaborate-invites border shadow-sm p-3">
                <h3><i class="fa-solid fa-envelope fa-sm mr-2"></i>Invitations</h3>
                <hr class="shadow">
                <div class="content">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="col">Email</th>
                                <th class="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @empty($trip['user_invites'])
                                <tr>
                                    <td colspan="2">
                                        There are no pending invites
                                    </td>
                                </tr>
                            @else
                                @foreach($trip['user_invites'] as $invite)
                                <tr>
                                    <td class="col align-middle">@php echo $invite['email_address'] @endphp</td>
                                    <td class="col align-middle">
                                    <a
                                        class="text-white btn btn-secondary"
                                        href="{{ route('destroy-invite', ['id' => $trip['id'], 'invite_id' => $invite['id']] ) }}"
                                        onclick="return confirm('Are you sure?')"
                                    >
                                        Delete
                                    </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="footer">
                    <a class="text-white btn btn-secondary" href="{{ route('invite', ['id' => $trip['id']] ) }}">

                        <!-- add edit icon -->
                        <i class="fa-solid fa-paper-plane-top"></i>
                        Invite
                    </a>
                </div>
            </div>
        </div>
    </div>
    <assign-tasks />
</div>
@endsection