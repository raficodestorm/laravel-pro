@extends('layouts.adminlayout')

@section('content')
<div class="container mt-5 " style="min-height: 100vh;">
  <div class="card shadow-lg border-0 rounded-4">
    <div class="card-header bg-primary text-white text-center py-3 rounded-top-4">
      <h4 class="mb-0">🚌 Add New Bus</h4>
    </div>

    <div class="card-body p-4">
      {{-- Success Message --}}
      @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
      @endif

      {{-- Form --}}
      <form action="{{ route('buses.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="name" class="form-label">Bus Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter bus name" required
              value="{{ old('name') }}">
          </div>

          <div class="col-md-6">
            <label for="coach_no" class="form-label">Coach Number</label>
            <input type="number" name="coach_no" id="coach_no" class="form-control" placeholder="e.g. 101" required
              value="{{ old('coach_no') }}">
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="license" class="form-label">License Number</label>
            <input type="text" name="license" id="license" class="form-control" placeholder="e.g. DHA-12345" required
              value="{{ old('license') }}">
          </div>

          <div class="col-md-6">
            <label for="company" class="form-label">Company Name</label>
            <input type="text" name="company" id="company" class="form-control" placeholder="e.g. Green Line" required
              value="{{ old('company') }}">
          </div>
        </div>

        <div class="mb-4">
          <label for="route" class="form-label">Route</label>
          <input type="text" name="route" id="route" class="form-control" placeholder="e.g. Dhaka – Chittagong" required
            value="{{ old('route') }}">
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-success px-4">Save Bus</button>
          <a href="{{ route('buses.index') }}" class="btn btn-secondary px-4">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection