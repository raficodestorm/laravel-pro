@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>All Drivers</h3>
            <a href="{{ route('admin.drivers.create') }}" class="btn btn-info">+ Add driver</a>
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
                    <th>License no</th>
                    <th>Address</th>
                    <th>Route</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @forelse($drivers as $driver)
                <tr class="text-center">
                    <td>{{ $driver->id }}</td>
                    <td>{{ $driver->name }}</td>
                    <td>{{ $driver->phone }}</td>
                    <td>{{ $driver->license }}</td>
                    <td>{{ $driver->address }}</td>
                    <td>{{ $driver->routeinfo->route_code }}</td>
                    <td>

                        <a href="{{ route('admin.drivers.show', $driver->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')"
                                class="btn btn-danger btn-sm">Delete</button>

                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">No drivers found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection