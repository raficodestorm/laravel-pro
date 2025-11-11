@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="card-header p-2 mb-3 text-white fw-bold" style="background-color: #ff0000">Details of {{
            $driver->name }}</div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $driver->id }}</p>
            <p><strong>Name:</strong> {{ $driver->name }}</p>
            <p><strong>Father:</strong> {{ $driver->father }}</p>
            <p><strong>Phone:</strong> {{ $driver->phone }}</p>
            <p><strong>License:</strong> {{ $driver->license }}</p>
            <p><strong>Address:</strong> {{ $driver->address }}</p>
            <p><strong>Route:</strong> {{ $driver->routeinfo->route_code }}</p>
            <p><strong>Created at:</strong> {{ $driver->created_at }} </p>

            <a href="{{ route('admin.drivers.index') }}" class="btn btn-secondary mt-3 px-4">Back</a>
        </div>
    </div>
</div>

@endsection