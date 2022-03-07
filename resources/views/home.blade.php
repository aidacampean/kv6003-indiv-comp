@extends('layouts.main')

@section('content')

@if (session()->has('success')) 
<div role="alert alert-dismissible alert-danger" role="alert" aria-live="polite" aria-atomic="true">
  {{ session('success') }}
</div>
@endif

<div>
  <h1 class="mt-5">My Trips</h1>

  <div class="row mt-5">
    @if ($trips->isEmpty())
    <div class="col">
          <div class="card custom-card text-center" >
            <div class="card-text">This looks empty. Add your trip so it will appear here!</div>
            <a class="btn btn-secondary" href="{{ route('create-trip') }}">Add Trip</a>
          </div>
    </div>

    @else
        @foreach($trips as $trip)
          <div class="col-md-3 my-2">
            <div class="bootstrap-card">
              <div class="card-body">
                <h4 class="card-title">{{ $trip->name }}</h4>
                  <!-- <template #header>
                    <h6 class="mb-0">{{ $trip->name }}</h6>
                  </template> -->
                  
                  <div class="card-text">
                    Depart: {{ $trip->date_from->format('d/m/Y') }} </br>
                    Arrive: {{ $trip->date_to->format('d/m/Y') }}
                  </div>

                  <div class="pull-right mb-1">
                    <a class="btn btn-secondary" href="{{ route('itinerary', ['id' => $trip->id]) }}">

                      <!-- add edit icon -->
                        <i class="fas fa-edit"></i>
                        Edit
                    </a>

                    <a class="btn btn-danger" href="{{ route('delete-trip', ['id' => $trip->id]) }}" onclick="return confirm('Are you sure?')">
                      
                      <!-- add trash icon -->
                      <i class="fas fa-trash"></i>
                        {!! 'Delete' !!}
                    </a>
                  </div>
              </div>
            </div>
          </div>
        @endforeach
    @endif

  </div>
</div>
@endsection