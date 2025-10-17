@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="card-header text-white fw-bold p-2 mb-3" style="background-color: #ff0000">Add New Route</div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('routes.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Route code</label>
                    <input type="text" name="route_code" class="form-control" placeholder="Enter route code" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Start location</label>
                    <input type="text" name="start_location" class="form-control" placeholder="Start from">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">End location</label>
                    <input type="text" name="end_location" class="form-control" placeholder="End to">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Distance</label>
                    <input type="text" name="distance" class="form-control" placeholder="distance">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Duration</label>
                    <input type="text" name="duration" class="form-control" placeholder="duration">
                </div>
                <button type="submit" class="btn btn-success px-4">Save</button>
                <a href="{{ route('routes.index') }}" class="btn btn-secondary px-4">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection