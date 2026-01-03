@extends('layouts.counterLayout')

@section('content')

<div class="container mt-4">

  <div class="card counter-search-card">
    <h5 class="card-title text-center mb-4">
      🚌 Find Your Bus
    </h5>

    <form action="{{ route('counter.bus.search') }}" method="POST">
      @csrf

      <!-- INPUT ROW -->
      <div class="row g-3 align-items-end">

        <!-- FROM -->
        <div class="col-md-4">
          <label class="form-label">From</label>
          <select name="from" class="form-control smart-input" required>
            <option value="">Select Location</option>
            @foreach($location as $loc)
            <option value="{{ $loc->district }}">
              {{ $loc->district }}
            </option>
            @endforeach
          </select>
        </div>

        <!-- TO -->
        <div class="col-md-4">
          <label class="form-label">To</label>
          <select name="to" class="form-control smart-input" required>
            <option value="">Select Location</option>
            @foreach($location as $loc)
            <option value="{{ $loc->district }}">
              {{ $loc->district }}
            </option>
            @endforeach
          </select>
        </div>

        <!-- DATE -->
        <div class="col-md-4">
          <label class="form-label">Journey Date</label>
          <input type="date" name="date" class="form-control smart-input" required>
        </div>

      </div>

      <!-- BUTTON -->
      <div class="text-center mt-4">
        <button type="submit" class="btn smart-search-btn">
          Search Buses
        </button>
      </div>

    </form>
  </div>

</div>

@endsection