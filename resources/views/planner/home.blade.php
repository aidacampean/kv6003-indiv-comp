@extends('layouts.main')

@section('content')

@if (session()->has('success')) 
<div role="alert alert-dismissible alert-danger" role="alert" aria-live="polite" aria-atomic="true">
  {{ session('success') }}
</div>
@endif

<div>
  <h1 class="mt-5">My Trips</h1>
  <hr>

  <div class="row mt-5">
    @if ($trips->isEmpty())
    <div class="col-md-3 my-2">
      <div class="card custom-card text-center" >
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
          <div class="col-md-3 my-2">
            <div class="bootstrap-card">
              <div class="card-body">
                <h4 class="card-title">{{ $trip->name }}</h4>
                  <!-- <template #header>7
                    <h6 class="mb-0">{{ $trip->name }}</h6>
                  </template> -->
                  
                  <div class="card-text">
                    Depart: {{ $trip->date_from->format('d/m/Y') }} </br>
                    Arrive: {{ $trip->date_to->format('d/m/Y') }}
                  </div>

                  <div class="pull-right mb-1">
                    <a class="mt-2 text-white btn btn-secondary" href="{{ route('itinerary', ['id' => $trip->id]) }}">

                      <!-- add edit icon -->
                        <i class="fas fa-edit"></i>
                        Edit
                    </a>

                    <a class="mt-2 text-white btn green hover" href="{{ route('delete-trip', ['id' => $trip->id]) }}" onclick="return confirm('Are you sure?')">
                      
                      <!-- add trash icon -->
                      <i class="fas fa-trash"></i>
                        {!! 'Delete' !!}
                    </a>

                    <a class="mt-2 btn btn-primary" href="{{ route('collaborate', ['id' => $trip->id]) }}">+ Invite people</a>
                  </div>
              </div>
            </div>
          </div>
        @endforeach
    @endif

  </div>
</div>
@endsection