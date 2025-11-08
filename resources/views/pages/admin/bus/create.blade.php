@extends('layouts.adminlayout')

@section('content')
<div class="container-fluid main-area">
  <div class="index-card shadow">
    <div class="card-header text-white fw-bold p-2 mb-3 text-center py-3 rounded-top-4"
      style="background-color: #ff0000">
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
      <form action="{{ route('admin.buses.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="name" class="form-label">Bus Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter bus name" required>
          </div>

          <div class="col-md-6">
            <label for="coach_no" class="form-label">Coach Number</label>
            <input type="number" name="coach_no" id="coach_no" class="form-control" placeholder="e.g. 101" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="license" class="form-label">License Number</label>
            <input type="text" name="license" id="license" class="form-control" placeholder="e.g. DHA-12345" required>
          </div>

          <div class="col-md-6">
            <label for="company" class="form-label">Company Name</label>
            <input type="text" name="company" id="company" class="form-control" placeholder="e.g. Green Line" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="bus_type" class="form-label">Bus type</label>
            <select class="form-control" name="bus_type" id="bus_type">
              <option value="">--select bus type--</option>
              @foreach($types as $type)
              <option value="{{$type->type}}">{{$type->type}}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-6">
            <label for="route" class="form-label">Route</label>
            <select class="form-control" name="route" id="route">
              <option value="">--select route--</option>
              @foreach($routes as $route)
              <option value="{{$route->route_code}}">{{$route->route_code}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-6 ">
            <label for="seat_layout" class="form-label">Seat layout</label>
            <input type="text" name="seat_layout" id="seat_layout" class="form-control" placeholder="2:2" required>
          </div>

          <div class="col-md-6">
            <label for="seat_layout" class="form-label">Seat capacity</label>
            <input type="text" name="seat_capacity" id="seat_capacity" class="form-control" placeholder="36/40"
              required>
          </div>
        </div>
    </div>



    <div class="text-end">
      <button type="submit" class="btn btn-success px-4">Save Bus</button>
      <a href="{{ route('admin.buses.index') }}" class="btn btn-secondary px-4">Cancel</a>
    </div>
    </form>
  </div>
</div>
</div>

@endsection