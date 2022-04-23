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
                <tasks :users='@json($trip["collaborators"])' />
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
                @if (count($trip['collaborators']) <= 5)
                <div class="footer">
                    <a
                      type="button"
                      class="btn btn-secondary"
                      href="{{ route('invite', ['id' => $trip['id']] ) }}"
                      data-toggle="tooltip"
                      data-placement="bottom"
                      title="Send an invitation to collaborate">
                        <!-- add edit icon -->
                        Invite
                        <i class="fa-solid fa-paper-plane-top"></i>
                    </a>
                    <div>Resend invitation code and have an invitation code column. Notifications: if user is registered, send a notification instead of email</div>
                </div>
                @elseif (count($trip['collaborators']) > 5)
                <div class="footer">
                    <button
                      type="submit"
                      class="text-white btn btn-secondary disabled"
                      href="{{ route('invite', ['id' => $trip['id']] ) }}"
                      aria-disabled="true"
                    >
                        <!-- add edit icon -->
                        Invite
                        <i class="fa-solid fa-paper-plane-top"></i>
                    </button>
                    <span style="font-size: 18px; color: Dodgerblue;" v-b-tooltip.hover title="This is the maximum number of collaborators you can invite">
                        <i class="fa-solid fa-circle-info"></i>
                    </span>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection