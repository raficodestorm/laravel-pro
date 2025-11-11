@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>All Locations</h3>
            <a href="{{ route('admin.locations.create') }}" class="btn btn-info">+ Add Location</a>
        </div>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered align-middle" id="table-same">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>District</th>
                    <th>Division</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($locations as $location)
                <tr class="text-center">
                    <td>{{ $location->id }}</td>
                    <td>{{ $location->district }}</td>
                    <td>{{ $location->division ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.locations.show', $location->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.locations.edit', $location->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.locations.destroy', $location->id) }}" method="POST" class="d-inline">
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
 <!-- {{ $locations->links() }} -->
    </div>
</div>

@endsection