@extends('layouts.adminlayout')

@section('content')
<div class="container mt-5">
  <div class="card shadow-lg border-0 rounded-4">
    <div class="card-header bg-primary text-white text-center py-3 rounded-top-4">
      <h4 class="mb-0">🚌 Edit Bus information</h4>
    </div>


    {{-- Form --}}
    <form action="{{ route('buses.update', $bus) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="name" class="form-label">Bus Name</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="e.g. Green Line Express" required
            value="{{  old('name', $bus->name) }}">
        </div>

        <div class="col-md-6">
          <label for="coach_no" class="form-label">Coach Number</label>
          <input type="number" name="coach_no" id="coach_no" class="form-control" placeholder="e.g. 101" required
            value="{{  old('coach_no', $bus->coach_no) }}">
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="license" class="form-label">License Number</label>
          <input type="text" name="license" id="license" class="form-control" placeholder="e.g. DHA-12345" required
            value="{{  old('license', $bus->license) }}">
        </div>

        <div class="col-md-6">
          <label for="company" class="form-label">Company Name</label>
          <input type="text" name="company" id="company" class="form-control" placeholder="e.g. Green Line" required
            value="{{  old('company', $bus->company) }}>
          </div>
        </div>

        <div class=" mb-4">
          <label for="route" class="form-label">Route</label>
          <input type="text" name="route" id="route" class="form-control" placeholder="e.g. Dhaka – Chittagong" required
            {{ old('route', $bus->route) }}>
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-success px-4">Update</button>
        </div>
    </form>
  </div>
</div>
</div>
@endsection