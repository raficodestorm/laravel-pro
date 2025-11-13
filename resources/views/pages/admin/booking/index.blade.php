@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>All bookings</h3>
        </div>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered align-middle" id="table-same">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Passenger</th>
                    <th>Schedule id</th>
                    <th>Coach no</th>
                    <th>Route</th>
                    <th>Seats</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reserve)
                <tr class="text-center">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $reserve->name }}</td>
                    <td>{{ $reserve->schedule_id }}</td>
                    <td>{{ $reserve->coach_no }}</td>
                    <td>{{ $reserve->route }}</td>
                    <td>{{ $reserve->selected_seats }}</td>
                    <td>{{ $reserve->total }}</td>
                    <td>{{ $reserve->status }}</td>

                    <td>
                        {{-- <a href="{{ route('admin.schedules.edit', $schedule->id) }}"
                            class="btn btn-warning btn-sm">Edit</a> --}}
                        <form action="{{ route('admin.reservation.delete', $reserve->id) }}" method="POST"
                            class="d-inline">
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

        {{ $reservations->links() }}
    </div>
</div>

@endsection