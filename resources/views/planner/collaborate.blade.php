@extends('layouts.main')

@section('content')
<div class="p-5 container-fluid collaborate">
    <h2>Manage Collaboration for {{ $trips['name'] }}</h2>
    <hr>
    <div class="row">
        <div class="col-8">
            <div class="collaborate-users border p-3">
                <h3 style="background-color: #61970b; padding: 15px; color: #FFF;"><i class="fa-solid fa-user fa-sm mr-3"></i>Users</h3>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        @empty($trips['collaborators'])
                            <tr>
                                <td colspan="3">
                                    There are no collaborators for this trip
                                </td>
                            </tr>
                        @else
                            @foreach($trips['collaborators'] as $collaborator)
                            <?php print_r($collaborator);?>

                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ $collaborator['status'] }}</td>
                            </tr>

                            @endforeach
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

    <p>
        Manage Users - can see the users associated with the trip, assign tasks, revoke access
    </p>

    <p>
        Send notification to users?
    </p>
</div>
@endsection