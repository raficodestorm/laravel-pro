@extends('layouts.userlayout')
@section('content')

<div class="card shadow border-0 rounded-4">
    <div class="card-header bg-info text-white fw-bold">Location Details</div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $location->id }}</p>
        <p><strong>District:</strong> {{ $location->district }}</p>
        <p><strong>Division:</strong> {{ $location->division ?? '-' }}</p>
        <p><strong>Created at:</strong> {{ $location->created_at->format('d M, Y h:i A') }}</p>

        <a href="{{ route('locations.index') }}" class="btn btn-secondary mt-3 px-4">Back</a>
    </div>
</div>

@endsection
