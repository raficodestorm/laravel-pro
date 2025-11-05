@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="card-header p-2 mb-3 text-white fw-bold" style="background-color: #ff0000">Route Details</div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $route->id }}</p>
            <p><strong>Route code:</strong> {{ $route->route_code }}</p>
            <p><strong>Start location:</strong> {{ $route->start_location }}</p>
            <p><strong>End location:</strong> {{ $route->End_location }}</p>
            <p><strong>Distance:</strong> {{ $route->distance }}</p>
            <p><strong>duration:</strong> {{ $route->duration }}</p>
            <p><strong>Created at:</strong> {{ $route->created_at }}</p>

            <a href="{{ route('admin.routes.index') }}" class="btn btn-secondary mt-3 px-4">Back</a>
        </div>
    </div>
</div>

@endsection