@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>All Supervisors</h3>
            <a href="{{ route('admin.supervisors.create') }}" class="btn btn-info">+ Add Supervisor</a>
        </div>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered align-middle" id="table-same">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Father</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Route</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @forelse($supervisors as $supervisor)
                <tr class="text-center">
                    <td>{{ $supervisor->id }}</td>
                    <td>{{ $supervisor->name }}</td>
                    <td>{{ $supervisor->father }}</td>
                    <td>{{ $supervisor->phone }}</td>
                    <td>{{ $supervisor->address }}</td>
                    <td>{{ $supervisor->routeinfo->route_code }}</td>
                    <td>

                        <a href="{{ route('admin.supervisors.show', $supervisor->id) }}"
                            class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.supervisors.edit', $supervisor->id) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.supervisors.destroy', $supervisor->id) }}" method="POST"
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
                    <td colspan="4" class="text-center text-muted">No superviser found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection