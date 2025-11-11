@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>All finished trips</h3>
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
                    <th>Price</th>
                    <th>Bus type</th>
                    <th>Coach no</th>
                    <th>Status</th>
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
                    <td>{{ $schedule->price }}</td>
                    <td>{{ $schedule->bus_type }}</td>
                    <td>{{ $schedule->coach_no }}</td>
                    <td>{{ $schedule->status }}</td>

                    <td>
                        <a href="{{ route('admin.tripmanage', $schedule->id) }}" class="btn btn-info btn-sm">manage</a>
                        <form action="{{ route('admin.tripdelete', $schedule->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')"
                                class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">No records found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $schedules->links() }}
    </div>
</div>

@endsection