@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="card-header p-2 mb-3 text-white fw-bold" style="background-color: #ff0000">Location Details</div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $location->id }}</p>
            <p><strong>District:</strong> {{ $location->district }}</p>
            <p><strong>Division:</strong> {{ $location->division ?? '-' }}</p>
            <p><strong>Created at:</strong> first time</p>

            <a href="{{ route('admin.locations.index') }}" class="btn btn-secondary mt-3 px-4">Back</a>
        </div>
    </div>
</div>

@endsection