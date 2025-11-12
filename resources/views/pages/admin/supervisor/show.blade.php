@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="card-header p-2 mb-3 text-white fw-bold" style="background-color: #ff0000">Details of {{
            $supervisor->name }}</div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $supervisor->id }}</p>
            <p><strong>Name:</strong> {{ $supervisor->name }}</p>
            <p><strong>Father:</strong> {{ $supervisor->father }}</p>
            <p><strong>Phone:</strong> {{ $supervisor->phone }}</p>
            <p><strong>Address:</strong> {{ $supervisor->address }}</p>
            <p><strong>Route:</strong> {{ $supervisor->routeinfo->route_code }}</p>
            <p><strong>Created at:</strong> {{ $supervisor->created_at }} </p>

            <a href="{{ route('admin.supervisors.index') }}" class="btn btn-secondary mt-3 px-4">Back</a>
        </div>
    </div>
</div>

@endsection