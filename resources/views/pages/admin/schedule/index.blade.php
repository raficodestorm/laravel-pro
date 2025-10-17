@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>All Schedules</h3>
            <a href="{{ route('schedules.create') }}" class="btn btn-info">+ Add Shedule</a>
        </div>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered align-middle" id="table-same">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Route</th>
                    <th>Start location</th>
                    <th>End location</th>
                    <th>Distance</th>
                    <th>Duration</th>
                    <th>Price</th>
                    <th>Bus type</th>
                    <th>Coach no</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($schedules as $schedule)
                <tr class="text-center">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $schedule->set_date }}</td>
                    <td>{{ $schedule->set_time }}</td>
                    <td>{{ $schedule->route_code }}</td>
                    <td>{{ $schedule->start_location }}</td>
                    <td>{{ $schedule->end_location }}</td>
                    <td>{{ $schedule->distance }}</td>
                    <td>{{ $schedule->duration }}</td>
                    <td>{{ $schedule->price }}</td>
                    <td>{{ $schedule->bus_type }}</td>
                    <td>{{ $schedule->coach_no }}</td>

                    <td>
                        <a href="{{ route('schedules.show', $schedule->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')"
                                class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">No locations found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $schedules->links() }}
    </div>
</div>

@endsection