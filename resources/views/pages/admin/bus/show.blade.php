@extends('layouts.adminlayout')

@section('content')
<div class="container-fluid main-area ">
  <div class="justify-center">
    <div class="index-card shadow">
      <h2>Bus Detail</h2>
      <p><strong>Store ID:</strong> {{ $bus->id }}</p>
      <p><strong>Bus Name:</strong> {{ $bus->name }}</p>
      <p><strong>Coach No:</strong> {{ $bus->coach_no }}</p>
      <p><strong>License:</strong> {{ $bus->license }}</p>
      <p><strong>Company:</strong> {{ $bus->company }}</p>
      <p><strong>Bus type:</strong> {{ $bus->bus_type }}</p>
      <p><strong>Route:</strong> {{ $bus->route }}</p>
      <p><strong>Seat layout:</strong> {{ $bus->seat_layout }}</p>
      <p><strong>Seat capacity:</strong> {{ $bus->seat_capacity }}</p>
      <p><strong>added at:</strong> {{ $bus->created_at }}</p>

      <a href="{{ route('admin.buses.index') }}" class="btn btn-secondary">Back</a>
    </div>
  </div>
</div>
@endsection