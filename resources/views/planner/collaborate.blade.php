@extends('layouts.main')

@section('content')
<div class="p-5 container-fluid collaborate">
    <h2>Manage Collaboration for {{ $trip['name'] }}</h2>
    <hr>
    @include('partials/alerts')

    <div class="row">
        <div class="col-lg-8 col-sm-12 mb-sm-3">
            <div class="collaborate-users border p-3">
                <h3>
                    <i class="fa-solid fa-user fa-sm mr-3"></i>
                    Users
                </h3>
                <tasks :users='@json($trip["trip_collaborators"])' />
            </div>
        </div>
        <div class="col-lg-3 col-sm-12 ml-auto">
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
                                    <td class="col align-middle">@php echo $invite['email'] @endphp</td>
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
</div>
@endsection