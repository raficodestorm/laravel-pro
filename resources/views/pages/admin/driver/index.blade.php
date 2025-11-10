@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>All Locations</h3>
            <a href="{{ route('admin.counters.create') }}" class="btn btn-info">+ Add Counter</a>
        </div>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered align-middle" id="table-same">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Counter name</th>
                    <th>Manager name</th>
                    <th>District</th>
                    <th>Distance</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @forelse($counters as $counter)
                <tr class="text-center">
                    <td>{{ $counter->id }}</td>
                    <td>{{ $counter->name }}</td>
                    <td>{{ $counter->manager }}</td>
                    <td>{{ $counter->locationinfo->district ?? 'N/A' }}</td>
                    <td>{{ $counter->distance }}</td>
                    <td>

                        <a href="{{ route('admin.counters.show', $counter->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.counters.edit', $counter->id) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.counters.destroy', $counter->id) }}" method="POST"
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

        {{ $counters->links() }}
    </div>
</div>

@endsection