@extends('layouts.adminlayout')

@section('content')
<div class="container-fluid main-area">
  <div class="index-card">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="text-center">All Buses</h2>
      <a href="{{ route('admin.buses.create') }}" class="btn btn-info">Add New Bus</a>
    </div>

    <table class="table table-bordered table-hover" id="table-same">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Coach</th>
          <th>License</th>
          <th>Company</th>
          <th>Bus type</th>
          <th>Route</th>
          <th>Seat layout</th>
          <th>Seat capacity</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($buses as $bus)
        <tr>
          <th scope="row">{{ $loop->iteration }}</th>
          <td>{{ $bus->name }}</td>
          <td>{{ $bus->coach_no }}</td>
          <td>{{ $bus->license }}</td>
          <td>{{ $bus->company }}</td>
          <td>{{ $bus->bus_type }}</td>
          <td>{{ $bus->route }}</td>
          <td>{{ $bus->seat_layout }}</td>
          <td>{{ $bus->seat_capacity }}</td>
          <td>
            <a href="{{ route('admin.buses.show', $bus) }}" class="btn btn-sm btn-info">View</a>
            <a href="{{ route('admin.buses.edit', $bus) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('admin.buses.destroy', $bus) }}" method="POST" class="d-inline"
              onsubmit="return confirm('Are you sure you want to delete this bus?')">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="text-center text-muted">No records found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>

    <div class="d-flex justify-content-center">

    </div>
  </div>
</div>
@endsection