@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>All Locations</h3>
            <a href="{{ route('admin.bustypes.create') }}" class="btn btn-info">+ Add Bustype</a>
        </div>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered align-middle" id="table-same">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($types as $type)
                <tr class="text-center">
                    <td>{{ $type->id }}</td>
                    <td>{{ $type->type }}</td>
                    <td>
                        <a href="{{ route('admin.bustypes.edit', $type->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.bustypes.destroy', $type->id) }}" method="POST" class="d-inline">
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

    </div>
</div>

@endsection