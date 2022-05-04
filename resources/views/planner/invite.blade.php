@extends('layouts.main')

@section('content')

@include('partials/alerts')

@foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible" role="alert" aria-live="polite" aria-atomic="true">
    {{ $error }}
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span>&times;</span>
    </button>
</div>
@endforeach 
    <div class="p-5 container">
        <h2>
            Invite a user
            <span style="font-size: 18px; color: Dodgerblue;" v-b-tooltip.hover title="Send an invitation to collaborate">
                <i class="fa-solid fa-circle-info"></i>
            </span>
        </h2>
        <hr>
        <div class="card p-2">
            <div class="card-body">
                <form novalidate name="invite" class="form-inline justify-content-md-center" method="POST" action="{{ route('store-invite', ['id' => $trip['id']]) }}">
                    @csrf
    
                    <input
                        id="email"
                        type="text"
                        name="email"
                        placeholder="Enter email address"
                        required="required"
                        style="width: 500px;"
                        aria-required="true"
                        class="form-control form-control-lg mx-3"
                        value="{{old('email')}}"
                    />
                    @if (count($trip['collaborators']) < 5)
                        <button type="submit" class="btn btn-dark">
                            Send Invite
                            <i class="fa-solid fa-paper-plane ml-2"></i>
                        </button>
                    @elseif (count($trip['collaborators']) >= 5)
                        <button
                        type="submit"
                        class="btn btn-dark disabled"
                        aria-disabled="true"
                        disabled="true"
                        >
                            Send Invite
                            <i class="fa-solid fa-paper-plane ml-2"></i>
                        </button>
                        <span style="font-size: 18px; color: Dodgerblue;" v-b-tooltip.hover title="This is the maximum number of collaborators you can invite">
                            <i class="mx-2 fa-solid fa-circle-info"></i>
                        </span>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection