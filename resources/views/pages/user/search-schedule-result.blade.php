@extends('layouts.userlayout')

@section('content')
<div class="container mt-5 mb-5" style="min-height: 100vh;">
  <h3 class="fw-bold text-center mb-4" style="color:#780116;">
    Available Buses on {{ date('d M, Y', strtotime($date)) }}
  </h3>

  @if ($schedules->isEmpty())
  <div class="text-center mt-5">
    <h5 class="text-muted">😔 No buses found for your search.</h5>
    <a href="{{ route('main.portal') }}" class="btn btn-danger mt-3">Search Again</a>
  </div>
  @else
  <div class="row justify-content-center">
    @foreach ($schedules as $schedule)
    <div class="col-md-10 mb-4">
      <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body d-flex flex-column flex-md-row align-items-md-center justify-content-between">
          <div>
            <h5 class="fw-bold mb-1" style="color:#780116;">{{ $schedule->bus_type }} - Coach {{ $schedule->coach_no }}
            </h5>
            <p class="mb-1 text-muted">
              {{ $schedule->start_location }} → {{ $schedule->end_location }}
            </p>
            <p class="small mb-0 text-secondary">
              Distance: {{ $schedule->distance ?? 'N/A' }} | Duration: {{ $schedule->duration ?? 'N/A' }}
            </p>
          </div>

          <div class="text-center my-3 my-md-0">
            <h6 class="fw-bold mb-1">🕒 {{ date('h:i A', strtotime($schedule->set_time)) }}</h6>
            <p class="small text-secondary mb-0">Departure Time</p>
          </div>

          <div class="text-center">
            <h5 class="fw-bold mb-1 text-danger">৳ {{ number_format($schedule->price, 2) }}</h5>
            <a href="{{ route('seat.reservation', ['id' => $schedule->id]) }}">
              <button class="btn btn-outline-danger btn-sm rounded-3 mt-1">View Seats</button>
            </a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @endif
</div>
@endsection