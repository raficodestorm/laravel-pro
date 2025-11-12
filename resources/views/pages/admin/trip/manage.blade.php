@extends('layouts.adminlayout')

@section('content')
<div class="container-fluid main-area">
  <div class="justify-center">
    <div class="index-card shadow">
      <h2>Trip details</h2>

      <p><strong>Trip id:</strong> {{ $schedule->id }}</p>
      <p><strong>Date:</strong> {{ $schedule->set_date }}</p>
      <p><strong>Time:</strong> {{ $schedule->set_time }}</p>
      <p><strong>Route:</strong> {{ $schedule->route_code }}</p>
      <p><strong>Start location:</strong> {{ $schedule->start_location }}</p>
      <p><strong>End location:</strong> {{ $schedule->end_location }}</p>
      <p><strong>Distance:</strong> {{ $schedule->distance }}</p>
      <p><strong>Duration:</strong> {{ $schedule->duration }}</p>
      <p><strong>Bus type:</strong> {{ $schedule->bus_type }}</p>
      <p><strong>Coach no:</strong> {{ $schedule->coach_no }}</p>
      <p><strong>Status:</strong>
        <span class="badge 
          @if($schedule->status == 'pending') bg-warning 
          @elseif($schedule->status == 'running') bg-primary 
          @else bg-success @endif">
          {{ ucfirst($schedule->status) }}
        </span>
      </p>
      <p><strong>Driver:</strong>
        @if($schedule->driver)
        {{ $schedule->driver->name }}
        @else
      <form action="{{ route('admin.schedules.updateDriver', $schedule->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('PATCH')
        <select name="driver_id" required>
          <option value="">Select Driver</option>
          @foreach($drivers as $driver)
          <option value="{{ $driver->id }}">{{ $driver->name }}</option>
          @endforeach
        </select>
        <button type="submit" class="btn btn-sm btn-primary">Assign</button>
      </form>
      @endif
      </p>

      <p><strong>Supervisor:</strong>
        @if($schedule->supervisor)
        {{ $schedule->supervisor->name }}
        @else
      <form action="{{ route('admin.schedules.updateSupervisor', $schedule->id) }}" method="POST"
        style="display:inline;">
        @csrf
        @method('PATCH')
        <select name="supervisor_id" required>
          <option value="">Select Supervisor</option>
          @foreach($supervisors as $supervisor)
          <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
          @endforeach
        </select>
        <button type="submit" class="btn btn-sm btn-primary">Assign</button>
      </form>
      @endif
      </p>


      {{-- Start Trip --}}
      @if($schedule->status == 'pending')
      <form action="{{ route('admin.schedules.start', $schedule->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-success">Start & Generate Report</button>
      </form>
      @endif

      {{-- Finish Trip --}}
      @if($schedule->status == 'running')
      <form action="{{ route('admin.schedules.finish', $schedule->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-danger">Finish</button>
      </form>
      @endif

      @if($schedule->status == ('running'||'finished'))
      <form action="{{ route('admin.schedules.pending', $schedule->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-danger">back to pending</button>
      </form>
      @endif
      <a class="btn btn-secondary" href="{{ route('admin.pendingtrip') }}">back</a>
    </div>
  </div>
</div>
@endsection