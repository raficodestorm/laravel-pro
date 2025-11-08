@extends('layouts.adminlayout')

@section('content')
<div class="container-fluid main-area">
  <div class="index-card shadow">
    <div class="card-header text-white fw-bold p-2 mb-3 text-center py-3 rounded-top-4"
      style="background-color: #ff0000">
      <h4 class="mb-0">🚌 Edit Bus information</h4>
    </div>


    {{-- Form --}}
    <form action="{{ route('admin.buses.update', $bus) }}" method="POST">
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
            value="{{  old('company', $bus->company) }}">
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="bus_type" class="form-label">Bus type</label>
          <select class="form-control" name="bus_type" id="bus_type">
            <option value="{{ old('bus_type' , $bus->bus_type) }}">{{ old('bus_type' , $bus->bus_type) }}</option>
            @foreach($types as $type)
            <option value="{{$type->type}}">{{$type->type}}</option>
            @endforeach
          </select>
        </div>

        <div class=" col-md-6">
          <label for="route" class="form-label">Route</label>
          <select class="form-control" name="route" id="route">
            <option value="{{ old('route', $bus->route) }}">{{ old('route', $bus->route) }}</option>
            @foreach($routes as $route)
            <option value="{{$route->route_code}}">{{$route->route_code}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col-md-6 ">
          <label for="seat_layout" class="form-label">Seat layout</label>
          <input type="text" name="seat_layout" id="seat_layout" class="form-control" placeholder="2:2" required
            value="{{ old('seat_layout', $bus->seat_layout) }}">
        </div>

        <div class="col-md-6 ">
          <label for="seat_layout" class="form-label">Seat capacity</label>
          <input type="text" name="seat_capacity" id="seat_capacity" class="form-control" placeholder="36/40" required
            value="{{ old('seat_capacity', $bus->seat_capacity) }}">
        </div>
      </div>
  </div>



  <div class="text-end">
    <button type="submit" class="btn btn-success px-4">Update</button>
  </div>
  </form>
</div>
</div>
</div>
@endsection