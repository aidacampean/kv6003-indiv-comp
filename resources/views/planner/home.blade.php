@extends('layouts.main')

@section('content')
  @include('partials/alerts')
    
  <h1 class="mt-5">My Trips</h1>
  <hr>

  <div class="row mt-5">
    @empty ($trips)
      <div class="col-md-3 my-2">
        <div class="card add-trip-card text-center" >
          <div class="card-body">
            <div class="card-text">
              This looks empty. Add your trip so it will appear here!
            </div>
            <a class="mt-4 btn btn-secondary" href="{{ route('create-trip') }}">Add Trip</a>
          </div>
        </div>
      </div>

    @else
      @foreach($trips as $trip)

        @php
          $isOwner = ($trip['user_id'] == $user_id);
          $showTasks = count($trip['tasks']) > 0;
        @endphp

        <div class="col-md-3 my-2 h-100">
          <div class="card existing-trip">
            <div class="card-body">
              <h4 class="card-title">
                {{ $trip['name'] }}
                <div class="badge badge-<?= $isOwner ? 'success' : 'warning';?> float-right p-2">
                  {{ $isOwner ? 'admin' : 'collaborator' }}
                </div>
              </h4>
                <h5 class="card-text">
                  Depart: {{ $trip['date_from'] }} </br>
                  Arrive: {{ $trip['date_to'] }}
                </h5>
                @if ($isOwner && $showTasks)
                <h5>Tasks: <span class="badge badge-warning">{{ $trip['tasks'][0]['task1'] }}</span> <span class="badge badge-info">{{ $trip['tasks'][0]['task2'] }}</span></h5>
                @endif
            </div>

            <div class="card-footer text-center">
              <a class="mt-2 text-white btn btn-dark" href="{{ route('itinerary', ['id' => $trip['id']]) }}" v-b-tooltip.hover title="Plan your trip">
                  <i class="fas fa-edit"></i>
                  Plan
              </a>

              @if ($isOwner)
                <a class="mt-2 text-white btn btn-primary" href="{{ route('collaborate', ['id' => $trip['id']]) }}" v-b-tooltip.hover title="Manage collaboration">
                    <i class="fa-solid fa-user-group"></i>
                    Manage
                </a>
                <a class="mt-2 text-white btn btn-dark" href="{{ route('delete-trip', ['id' => $trip['id']]) }}" onclick="return confirm('Are you sure?')" v-b-tooltip.hover title="Attention: You're about to delete the trip with its associated itinerary">
                  <i class="fas fa-trash"></i>
                  Delete
                </a>
              @endif
            </div>
          </div>
        </div>
      @endforeach
    @endif
  </div>
@endsection