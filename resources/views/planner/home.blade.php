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
                      <div class="card-text">
                        Depart: {{ $trip['date_from'] }} </br>
                        Arrive: {{ $trip['date_to'] }}
                      </div>
                  </div>
                  <div class="card-footer text-center">
                      <a class="mt-2 text-white btn btn-secondary" href="{{ route('itinerary', ['id' => $trip['id']]) }}">
                          <i class="fas fa-edit"></i>
                          Plan
                      </a>

                      @if ($isOwner)
                        <a class="mt-2 text-white btn btn-secondary" href="{{ route('collaborate', ['id' => $trip['id']]) }}">
                            <i class="fa-solid fa-people-group"></i>
                            Manage
                        </a>

                          <a class="mt-2 text-white btn btn-secondary hover" href="{{ route('delete-trip', ['id' => $trip['id']]) }}" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i>
                              {!! 'Delete' !!}
                          </a>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
        @endif

      </div>
    
  </div>
@endsection