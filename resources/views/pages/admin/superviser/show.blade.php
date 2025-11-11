@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="card-header p-2 mb-3 text-white fw-bold" style="background-color: #ff0000">Details of {{ $superviser->name }}</div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $superviser->id }}</p>
            <p><strong>Name:</strong> {{ $superviser->name }}</p>
            <p><strong>Father:</strong> {{ $superviser->father }}</p>
            <p><strong>Phone:</strong> {{ $superviser->phone }}</p>
            <p><strong>Address:</strong> {{ $superviser->address }}</p>
            <p><strong>Route:</strong> {{ $superviser->routeinfo->route_code }}</p>
            <p><strong>Created at:</strong> {{ $superviser->created_at }} </p>

            <a href="{{ route('admin.supervisers.index') }}" class="btn btn-secondary mt-3 px-4">Back</a>
        </div>
    </div>
</div>

@endsection