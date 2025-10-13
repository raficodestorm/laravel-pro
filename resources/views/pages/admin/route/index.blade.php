@extends('layouts.adminlayout')
@section('content')

<div class="container main-area">
    <div class="index-card shadow">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>All Locations</h3>
            <a href="{{ route('routes.create') }}" class="btn btn-info">+ Add Route</a>
        </div>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered align-middle" id="table-same">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Route code</th>
                    <th>Start location</th>
                    <th>End location</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($routes as $route)
                <tr class="text-center">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $route->route_code }}</td>
                    <td>{{ $route->start_location }}</td>
                    <td>{{ $route->end_location }}</td>
                    
                    <td>
                        <a href="{{ route('routes.show', $route->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('routes.edit', $route->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('routes.destroy', $route->id) }}" method="POST" class="d-inline">
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

        {{ $routes->links() }}
    </div>
</div>

@endsection